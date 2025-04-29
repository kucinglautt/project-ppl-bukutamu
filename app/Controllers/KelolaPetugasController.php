<?php

namespace App\Controllers;

use App\Models\UserModel;

class KelolaPetugasController extends BaseController
{  
    public function index()
    {
        $model = new UserModel();
        $activeUsers = $model->getActiveUsers(); // Ambil data yang is_deleted = 0 (aktif)
        return view('admin/kelolaPetugas', ['activeUsers' => $activeUsers]); // Pastikan data dikirim ke view dengan key 'activeUsers'
    }

    public function add()
    {
        return view('/admin/addPetugas'); // Tampilkan form untuk menambah petugas baru
    }

    public function create()
    {
        $model = new UserModel();
        
         // Lakukan validasi
        $validation =  \Config\Services::validation();
    
        // Menambahkan aturan validasi dan pesan error untuk username
        $validation->setRules([
            'username' => [
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
                'errors' => [
                    'required' => 'Username harus diisi.',
                    'min_length' => 'Panjang username minimal 3 karakter',
                    'max_length' => 'Panjang username maksimal 50 karakter',
                    'is_unique' => 'Username sudah ada'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password harus diisi.',
                    'min_length' => 'Panjang password minimal 6 karakter'
                ]
            ],
            'role' => 'required'
        ]);
    
    // Jika validasi gagal
    if ($validation->withRequest($this->request)->run() === false) {
        return redirect()->back()
                         ->withInput()
                         ->with('errors', $validation->getErrors()); // Kirim error jika validasi gagal
    }
        
        // Simpan data petugas baru
        $model->save([
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
        ]);

        log_activity('Tambah Petugas', 'Tambah Petugas Berhasil');
        return redirect()->to('/kelola-petugas')->with('Pesan', 'Petugas berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $model = new UserModel();
        $data['user'] = $model->find($id); // Ambil data user berdasarkan id
        return view('/admin/editPetugas', $data); // Tampilkan form edit petugas
    }

    public function update($id)
    {
        $model = new UserModel();
        $validation = \Config\Services::validation();
    
        // Cari user lama
        $userLama = $model->find($id);
    
        // Kalau username berubah, validasi harus unik
        $usernameRule = 'required|min_length[3]|max_length[50]';
        if ($this->request->getPost('username') !== $userLama['username']) {
            $usernameRule .= '|is_unique[users.username]';
        }
    
        $validation->setRules([
            'username' => [
                'rules' => $usernameRule,
                'errors' => [
                    'required' => 'Username harus diisi.',
                    'min_length' => 'Panjang username minimal 3 karakter',
                    'max_length' => 'Panjang username maksimal 50 karakter',
                    'is_unique' => 'Username sudah ada'
                ]
            ],
            'password' => [
                'rules' => 'permit_empty|min_length[6]', // password optional saat edit
                'errors' => [
                    'min_length' => 'Panjang password minimal 6 karakter'
                ]
            ],
            'role' => 'required'
        ]);
    
        if ($validation->withRequest($this->request)->run() === false) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    
        $data = [
            'username' => $this->request->getPost('username'),
            'role' => $this->request->getPost('role'),
        ];
    
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
    
        $model->update($id, $data);
    
        log_activity('Edit Petugas', 'Edit Petugas Berhasil');
        return redirect()->to('/kelola-petugas')->with('Pesan', 'Petugas berhasil diperbarui!');
    }

    public function delete($id)
    {
        // Validasi jika ID tidak ditemukan
        $userModel = new UserModel();

        $user = $userModel->find($id);
    
        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("User not found");
        }

        // Soft delete data dengan menandai is_deleted = 1
        $userModel->softDelete($id);
    
        // Redirect dengan pesan sukses
        log_activity('Hapus Petugas', 'Hapus Petugas Berhasil');
        return redirect()->to('/kelola-petugas')->with('Pesan', 'Petugas berhasil dihapus');
    }
}
