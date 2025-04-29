<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\GuestModel; // Model data tamu kunjungan


class RiwayatTamuController extends BaseController
{  
    public function index()
    {
        $GuestModel = new GuestModel();
        
        // Ambil semua data tamu dari tabel
        $guest = $GuestModel->orderBy('created_at', 'DESC')->findAll();
        
        // Kirim data tamu ke view
        return view('admin/riwayatTamu', [
            'users' => $guest
        ]);
    }

    public function exportPdf()
{
    $GuestModel = new GuestModel();
    $guests = $GuestModel->orderBy('created_at', 'DESC')->findAll();

    $html = view('admin/pdfTemplate', ['users' => $guests]);

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream('riwayat-tamu.pdf', ['Attachment' => false]);

    log_activity('Export PDF Riwayat Tamu', 'Admin Mengekspor Riwayat Tamu ke PDF.');
}

public function exportExcel()
{
    $GuestModel = new GuestModel();
    $guests = $GuestModel->orderBy('created_at', 'DESC')->findAll();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header
    $sheet->fromArray(['No', 'Tanggal', 'Nama', 'Institusi', 'Tujuan', 'No Telp'], NULL, 'A1');

    $row = 2;
    $no = 1;
    foreach ($guests as $guest) {
        $sheet->fromArray([
            $no++,
            date('d-m-Y', strtotime($guest['created_at'])),
            $guest['name'],
            $guest['institution'],
            $guest['purpose'],
            $guest['phone_number']
        ], NULL, "A$row");
        $row++;
    }

    $writer = new Xlsx($spreadsheet);
    $filename = 'riwayat-tamu.xlsx';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    exit;

    log_activity('Export Excel Riwayat Tamu', 'Admin Mengekspor Riwayat Tamu ke Excel.');
}
}
