<?php

namespace App\Controllers;

use App\Models\GuestModel;

class PetugasController extends BaseController
{
    public function index()
    {
        $GuestModel = new GuestModel();

      // Jumlah tamu hari ini
        $jumlahTamuHariIni = $GuestModel->where('DATE(created_at)', date('Y-m-d'))->countAllResults();
        
        // Instansi yang paling banyak bertamu
        $instansiTerbanyak = $GuestModel->select('institution, COUNT(institution) as count')
                                                ->groupBy('institution')
                                                ->orderBy('count', 'DESC')
                                                ->limit(1)
                                                ->first();
    
        // Mengambil data tamu terbaru dan format tanggal untuk hanya menampilkan tanggalnya
        $data['recentGuests'] = $GuestModel->select('created_at, name, institution, purpose, phone_number')
                                           ->orderBy('created_at', 'DESC')
                                           ->limit(5)
                                           ->findAll();
    
        // Format tanggal agar hanya mengambil bagian tanggal saja
        foreach ($data['recentGuests'] as &$guest) {
            // Format tanggal menggunakan date()
            $guest['created_at'] = date('d-m-Y', strtotime($guest['created_at'])); // Format tanggal menjadi Y-m-d
        }

            // Mengirim data ke view
        $data['jumlahTamuHariIni'] = $jumlahTamuHariIni;
        $data['instansiTerbanyak'] = $instansiTerbanyak;
    
        return view('petugas/index', $data);
    }

    public function inputTamu()
    {
        $model = new GuestModel();
        return view('/petugas/inputTamu');
    }

}