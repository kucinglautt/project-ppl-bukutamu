<?php

namespace App\Controllers;

use App\Models\GuestModel;

class StatistikTamuController extends BaseController
{
    public function index()
{
    log_activity('View', 'Petugas Berhasil Melihat Statistik');

    $range = $this->request->getVar('range') ?? 'week';  // Default ke 'week'
    $GuestModel = new GuestModel();

    $allGuests = $GuestModel->select('created_at')->findAll(); // Ambil semua dulu

    $guestsFiltered = array_filter($allGuests, function($g) {
        $day = date('N', strtotime($g['created_at'])); // 1=Senin, 7=Minggu
        return $day >= 1 && $day <= 5; // Ambil Senin-Jumat saja
    });

    $labels = [];
    $data = [];

    switch ($range) {
        case 'week':
            $thisMonday = new \DateTime('monday this week');
            $thisFriday = new \DateTime('friday this week');

            $period = new \DatePeriod(
                $thisMonday,
                new \DateInterval('P1D'),
                (clone $thisFriday)->modify('+1 day') // Supaya include Jumat
            );

            foreach ($period as $day) {
                $tanggal = $day->format('Y-m-d');
                $labels[] = $day->format('l'); // Nama hari

                // Hitung tamu yang created_at pada tanggal ini
                $count = array_reduce($guestsFiltered, function($carry, $g) use ($tanggal) {
                    return $carry + (date('Y-m-d', strtotime($g['created_at'])) === $tanggal ? 1 : 0);
                }, 0);

                $data[] = $count;
            }
            break;

        case 'month':
            $thisMonth = date('Y-m');
            $weeks = [
                'Minggu 1' => [1, 7],
                'Minggu 2' => [8, 14],
                'Minggu 3' => [15, 21],
                'Minggu 4' => [22, 31],
            ];

            foreach ($weeks as $label => [$startDay, $endDay]) {
                $labels[] = $label;

                $count = array_reduce($guestsFiltered, function($carry, $g) use ($thisMonth, $startDay, $endDay) {
                    $date = strtotime($g['created_at']);
                    return $carry + ((date('Y-m', $date) == $thisMonth && date('d', $date) >= $startDay && date('d', $date) <= $endDay) ? 1 : 0);
                }, 0);

                $data[] = $count;
            }
            break;

        case 'year':
            $yearNow = date('Y');
            for ($m = 1; $m <= 12; $m++) {
                $labels[] = date('F', mktime(0, 0, 0, $m, 10)); // Nama bulan

                $count = array_reduce($guestsFiltered, function($carry, $g) use ($yearNow, $m) {
                    $date = strtotime($g['created_at']);
                    return $carry + ((date('Y', $date) == $yearNow && (int)date('n', $date) == $m) ? 1 : 0);
                }, 0);

                $data[] = $count;
            }
            break;
    }

    $rangeDates = $this->getRangeDates($range);

    return view('petugas/statistikTamu', [
        'labels' => $labels,
        'data' => $data,
        'range' => $range,
        'rangeDates' => $rangeDates
    ]);
}

// Fungsi untuk mendapatkan rentang tanggal
private function getRangeDates($range)
{
    $dateNow = new \DateTime();

    switch ($range) {
        case 'day':
            // Jika rentang per hari, hanya tampilkan tanggal hari ini
            $start = $dateNow->format('d/m/Y');
            $end = $start;
            break;
        case 'week':
            // Jika rentang per minggu, ambil tanggal mulai Senin dan Jumat dalam minggu ini
            // Menemukan hari Senin dan Jumat pada minggu yang sama
            $monday = clone $dateNow;
            $monday->modify('this week Monday');
            $friday = clone $dateNow;
            $friday->modify('this week Friday');
            
            $start = $monday->format('d/m/Y');
            $end = $friday->format('d/m/Y');
            break;
        case 'month':
            // Jika rentang per bulan, ambil tanggal pertama dan terakhir bulan ini
            $start = $dateNow->modify('first day of this month')->format('d/m/Y');
            $end = $dateNow->modify('last day of this month')->format('d/m/Y');
            break;
        case 'year':
            // Jika rentang per tahun, ambil tanggal pertama dan terakhir tahun ini
            $start = $dateNow->modify('first day of January this year')->format('d/m/Y');
            $end = $dateNow->modify('last day of December this year')->format('d/m/Y');
            break;
        default:
            $start = $end = $dateNow->format('d/m/Y');
            break;
    }

    return "$start - $end";  // Mengembalikan rentang tanggal
}


}
