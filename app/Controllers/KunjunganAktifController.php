<?php

namespace App\Controllers;

use App\Models\VisitModel;
use CodeIgniter\Controller;

class KunjunganAktifController extends Controller
{
    public function index()
{
    $visitModel = new VisitModel();

    // Data untuk tabel Kunjungan Aktif
    $kunjunganAktif = $visitModel
        ->select('visits.*, guests.name as guest_name, guests.purpose, guests.institution, guests.phone_number')
        ->join('guests', 'guests.id = visits.guest_id')
        ->where('visits.status', 'hadir')
        ->orderBy('visits.check_in', 'ASC')
        ->findAll();

    // Data untuk tabel Kunjungan Terbaru (ambil 5 terakhir)
    $kunjunganTerbaru = $visitModel
        ->select('visits.*, guests.name as guest_name, guests.purpose, guests.institution, guests.phone_number, users.username as handled_by')
        ->join('guests', 'guests.id = visits.guest_id')
        ->join('users', 'users.id = visits.handled_by', 'left')
        ->whereIn('visits.status', ['selesai', 'batal'])
        ->orderBy('visits.check_in', 'DESC')
        ->limit(5)
        ->findAll();

    return view('petugas/kunjunganAktif', [
        'kunjunganAktif' => $kunjunganAktif,
        'kunjunganTerbaru' => $kunjunganTerbaru
    ]);
}

    public function checkOut($id)
    {
        $visitModel = new VisitModel();

        $visitModel->update($id, [
            'check_out' => date('Y-m-d H:i:s'),
            'status' => 'selesai'
        ]);

        log_activity('Check Out Tamu', 'Check Out Tamu Berhasil');
        return redirect()->back()->with('Pesan', 'Check Out berhasil.');
    }

    public function batal($id)
{
    $visitModel = new VisitModel();
    $visit = $visitModel->find($id);

    if (!$visit) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Kunjungan tidak ditemukan.');
    }

    if ($visit['status'] !== 'hadir') {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Status tamu tidak valid untuk dibatalkan.');
    }

    $visitModel->update($id, [
        'check_out' => date('Y-m-d H:i:s'),
        'status'    => 'batal'
    ]);

    session()->setFlashdata('Pesan', 'Kunjungan tamu berhasil dibatalkan.');
    log_activity('Check Out Tamu', 'Status Tamu Batal');
    return redirect()->to('/kunjungan-aktif');
}

    public function updateStatus($id)
{
    $visitModel = new VisitModel();

    $status = $this->request->getPost('status');

    $dataUpdate = [
        'status' => $status,
    ];

    // Kalau statusnya jadi 'selesai' atau 'batal', isi kolom check_out
    if (in_array($status, ['selesai', 'batal'])) {
        $dataUpdate['check_out'] = date('Y-m-d H:i:s'); // Current datetime format SQL
    } else {
        // Kalau status dipilih 'hadir', check_out jangan diubah.
        $dataUpdate['check_out'] = null;
    }

    $visitModel->update($id, $dataUpdate);

    log_activity('Check Out Tamu', 'Status Kunjungan Diperbarui');
    return redirect()->to('/kunjungan-aktif')->with('Pesan', 'Status kunjungan berhasil diperbarui.');
}


    // Otomatis membatalkan kunjungan yang melebihi waktu
    public function autoCancel()
    {
        $visitModel = new VisitModel();

        $limitHours = 3; // contoh: batal otomatis kalau 3 jam lebih
        $expiredVisits = $visitModel
            ->where('status', 'aktif')
            ->where('check_in <', date('Y-m-d H:i:s', strtotime("-{$limitHours} hours")))
            ->findAll();

        foreach ($expiredVisits as $visit) {
            $visitModel->update($visit['id'], [
                'status' => 'batal'
            ]);
        }
    }
}

