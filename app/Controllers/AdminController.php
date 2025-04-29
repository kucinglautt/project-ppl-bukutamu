<?php
// File: app/Controllers/AdminController.php

namespace App\Controllers;

use DateTimeImmutable;
use App\Models\GuestModel;
use App\Models\UserModel;

class AdminController extends BaseController
{
    public function index()
    {
        $guestModel = new GuestModel();
        $userModel = new UserModel();
        $db = \Config\Database::connect();

        $today = date('Y-m-d');
        $currentMonth = date('m');
        $currentYear = date('Y');

        $jumlahTamuHariIni = $guestModel->where('DATE(created_at)', $today)->countAllResults();
        $jumlahPetugas = $userModel->where('role', 'petugas')->countAllResults();
        $kunjunganBulanIni = $guestModel
            ->where('MONTH(created_at)', $currentMonth)
            ->where('YEAR(created_at)', $currentYear)
            ->countAllResults();
        $totalInstansi = $guestModel
            ->select('institution')
            ->groupBy('institution')
            ->countAllResults();

        // Bar chart: kunjungan 5 bulan terakhir
        $barLabels = [];
        $barData = [];
        
        $now = new DateTimeImmutable('first day of this month');
        for ($i = 4; $i >= 0; $i--) {
            $target = $now->modify("-$i months");
            $label = $target->format('M Y');
            $ym = $target->format('Y-m');
        
            $barLabels[] = $label;
            $barData[] = $db->query("SELECT COUNT(*) AS total FROM guests WHERE DATE_FORMAT(created_at, '%Y-%m') = '$ym'")
                            ->getRow()->total;
        }

        // Pie chart: top 4 instansi + lainnya
        $instansiCounts = $guestModel
            ->select('institution, COUNT(*) as total')
            ->groupBy('institution')
            ->orderBy('total', 'DESC')
            ->findAll();

        $top4 = array_slice($instansiCounts, 0, 4);
        $others = array_slice($instansiCounts, 4);

        $pieLabels = [];
        $pieData = [];

        foreach ($top4 as $row) {
            $pieLabels[] = $row['institution'] ?: 'Tidak Diketahui';
            $pieData[] = $row['total'];
        }

        if (!empty($others)) {
            $pieLabels[] = 'Lainnya';
            $pieData[] = array_sum(array_column($others, 'total'));
        }

        return view('admin/index', [
            'jumlahTamuHariIni' => $jumlahTamuHariIni,
            'jumlahPetugas' => $jumlahPetugas,
            'kunjunganBulanIni' => $kunjunganBulanIni,
            'totalInstansi' => $totalInstansi,
            'barLabels' => $barLabels,
            'barData' => $barData,
            'pieLabels' => $pieLabels,
            'pieData' => $pieData
        ]);
    }

    public function activityLog()
{
    $model = new \App\Models\ActivityLogModel();
    $logs = $model->orderBy('created_at', 'DESC')->findAll();

    return view('/admin/activityLog', ['logs' => $logs]);
}

}
