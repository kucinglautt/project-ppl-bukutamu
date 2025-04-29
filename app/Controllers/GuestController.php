<?php namespace App\Controllers;

use App\Models\GuestModel;
use App\Models\VisitModel;


class GuestController extends BaseController
{

    // Menampilkan form buku tamu
    public function index()
    {
        return view('/tamu/form'); // Tampilkan form input tamu
    }

// Menyimpan data buku tamu
public function store()
{
    $guestModel = new GuestModel();
    $visitModel = new VisitModel();

    $validation = \Config\Services::validation();

    $validation->setRules([
        'name' => [
            'rules' => 'required|min_length[2]|max_length[100]',
            'errors' => [
                'required' => 'Nama harus diisi.',
                'min_length' => 'Nama harus memiliki minimal 2 karakter.',
                'max_length' => 'Nama tidak boleh lebih dari 100 karakter.',
            ]
        ],
        'institution' => [
            'rules' => 'required|min_length[2]|max_length[100]',
            'errors' => [
                'required' => 'Institusi harus diisi.',
                'min_length' => 'Institusi harus memiliki minimal 2 karakter.',
                'max_length' => 'Institusi tidak boleh lebih dari 100 karakter.',
            ]
        ],
        'purpose' => [
            'rules' => 'required|min_length[1]|max_length[100]',
            'errors' => [
                'required' => 'Tujuan harus diisi.',
                'min_length' => 'Tujuan harus memiliki minimal 1 karakter.',
                'max_length' => 'Tujuan tidak boleh lebih dari 100 karakter.',
            ]
        ],
        'phone_number' => [
            'rules' => 'permit_empty|min_length[10]|max_length[12]|numeric',
            'errors' => [
                'min_length' => 'Nomor telepon harus memiliki minimal 10 karakter.',
                'max_length' => 'Nomor telepon tidak boleh lebih dari 12 karakter.',
                'numeric' => 'Nomor telepon hanya boleh berisi angka.',
            ]
        ],
    ]);

    if ($validation->withRequest($this->request)->run() === false) {
        return redirect()->back()
                         ->withInput()
                         ->with('errors', $validation->getErrors());
    }

    // Data tamu
    $guestData = [
        'name'          => $this->request->getPost('name'),
        'institution'   => $this->request->getPost('institution'),
        'purpose'       => $this->request->getPost('purpose'),
        'phone_number'  => $this->request->getPost('phone_number'),
    ];

    // Simpan tamu
    $guestModel->save($guestData);

    // Ambil id dan created_at tamu yang baru disimpan
    $guestId = $guestModel->insertID();
    $createdAt = $guestModel->find($guestId)['created_at'];

    // Tentukan apakah ini dari /form (handled_by = NULL) atau dari /input-tamu (handled_by = id petugas)
    $redirectTo = $this->request->getPost('redirectTo');

    $handledBy = null;
    if ($redirectTo !== 'thankyou') { 
        $handledBy = session()->get('id'); // ID petugas dari session
    }

    // Simpan ke tabel visits
    $visitModel->save([
        'guest_id'   => $guestId,
        'check_in'   => $createdAt,
        'status'     => 'hadir',
        'handled_by' => $handledBy,
    ]);

    // Redirect
    if ($redirectTo === 'thankyou') {
        return redirect()->to('/thankyou');
    }

    session()->setFlashdata('Pesan', 'Tamu berhasil ditambahkan!');
    log_activity('Input Tamu', 'Input Tamu Berhasil');
    return redirect()->to('/input-tamu')->with('Pesan', 'Tamu berhasil ditambahkan!');
}

    // Halaman terima kasih setelah submit
    public function thankYou()
    {
        return view('/tamu/thankyouPage');
    }
}