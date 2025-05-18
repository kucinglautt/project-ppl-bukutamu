<?php

namespace App\Controllers;

use App\Models\GuestModel;

class AdminStatistikController extends BaseController
{
    public function index()
    {
        log_activity('View', 'Admin Berhasil Melihat Statistik');

        $startDate = $this->request->getVar('start_date');
        $endDate = $this->request->getVar('end_date');
        $range = $this->request->getVar('range') ?? 'week';
    
        // Validasi tanggal
        $error_message = null;
    
        if (($startDate && !$endDate) || (!$startDate && $endDate)) {
            $error_message = "Silakan isi kedua tanggal dengan benar.";
        } elseif ($startDate && $endDate && strtotime($startDate) > strtotime($endDate)) {
            $error_message = "\"Dari Tanggal\" tidak boleh lebih lama dari \"Sampai Tanggal\".";
            return view('admin/adminStatistik');
        }
    
        $GuestModel = new GuestModel();
        $builder = $GuestModel->select('created_at, institution');
    
        $useCustomRange = $startDate && $endDate;
    
        if ($useCustomRange) {
            $builder->where('created_at >=', $startDate . ' 00:00:00')
                    ->where('created_at <=', $endDate . ' 23:59:59');
        }
    
        $allGuests = $builder->findAll();
    
        // Pie Chart Data
        $institutionCount = [];
        foreach ($allGuests as $guest) {
            $instansi = $guest['institution'] ?? 'Tidak Diketahui';
            $institutionCount[$instansi] = ($institutionCount[$instansi] ?? 0) + 1;
        }
    
        $pieLabels = array_keys($institutionCount);
        $pieData = array_values($institutionCount);
    
        // Statistik Tamu Berdasarkan Range
        $labels = [];
        $data = [];
    
        if ($useCustomRange) {
            $period = new \DatePeriod(
                new \DateTime($startDate),
                new \DateInterval('P1D'),
                (new \DateTime($endDate))->modify('+1 day')
            );
    
            foreach ($period as $day) {
                $tanggal = $day->format('Y-m-d');
                $labels[] = $day->format('d/m/Y');
    
                $count = array_reduce($allGuests, function($carry, $g) use ($tanggal) {
                    return $carry + (date('Y-m-d', strtotime($g['created_at'])) === $tanggal ? 1 : 0);
                }, 0);
    
                $data[] = $count;
            }
        } else {
            $now = new \DateTime();
            $guestsFiltered = array_filter($allGuests, function($g) {
                $day = date('N', strtotime($g['created_at']));
                return $day >= 1 && $day <= 5;
            });
    
            switch ($range) {
                case 'week':
                    $monday = (clone $now)->modify('monday this week');
                    $friday = (clone $now)->modify('friday this week');
    
                    $period = new \DatePeriod($monday, new \DateInterval('P1D'), (clone $friday)->modify('+1 day'));
                    foreach ($period as $day) {
                        $tanggal = $day->format('Y-m-d');
                        $labels[] = $day->format('l');
                        $count = array_reduce($guestsFiltered, function($carry, $g) use ($tanggal) {
                            return $carry + (date('Y-m-d', strtotime($g['created_at'])) === $tanggal ? 1 : 0);
                        }, 0);
                        $data[] = $count;
                    }
                    break;
    
                case 'month':
                    $weeks = ['Minggu 1' => [1, 7], 'Minggu 2' => [8, 14], 'Minggu 3' => [15, 21], 'Minggu 4' => [22, 31]];
                    foreach ($weeks as $label => [$start, $end]) {
                        $labels[] = $label;
                        $data[] = array_reduce($guestsFiltered, function($carry, $g) use ($start, $end) {
                            $d = (int)date('d', strtotime($g['created_at']));
                            return $carry + ($d >= $start && $d <= $end ? 1 : 0);
                        }, 0);
                    }
                    break;
    
                case 'year':
                    for ($m = 1; $m <= 12; $m++) {
                        $labels[] = date('F', mktime(0, 0, 0, $m, 1));
                        $data[] = array_reduce($guestsFiltered, function($carry, $g) use ($m) {
                            return $carry + ((int)date('n', strtotime($g['created_at'])) === $m ? 1 : 0);
                        }, 0);
                    }
                    break;
            }
        }
    
        return view('admin/adminStatistik', [
            'labels' => $labels,
            'data' => $data,
            'range' => $range,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'pieLabels' => $pieLabels,
            'pieData' => $pieData,
            'error_message' => $error_message, // Tambahkan error_message untuk dikirim ke view
        ]);
    }
}
