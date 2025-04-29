<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class GantiPasswordAdminController extends Controller
{
    public function index()
    {
        return view('admin/gantiPassword');
    }

    public function update()
    {
        $validation = \Config\Services::validation();

        // Validasi input
        $validation->setRules([
            'old_password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password lama harus diisi.'
                ]
            ],
            'new_password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password baru harus diisi.',
                    'min_length' => 'Password baru minimal 6 karakter.'
                ]
            ],
            'confirm_password' => [
                'rules' => 'required|matches[new_password]',
                'errors' => [
                    'required' => 'Konfirmasi password harus diisi.',
                    'matches' => 'Konfirmasi password tidak sama dengan password baru.'
                ]
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil data dari form
        $oldPassword = $this->request->getPost('old_password');
        $newPassword = $this->request->getPost('new_password');

        // Ambil data pengguna yang sedang login
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('id'));  // Sesuaikan dengan session login

        if (!$user) {
            log_activity('Ganti Password', 'Ganti Password Gagal, User Tidak Ditemukan');
            return redirect()->back()->with('errors', ['Pengguna tidak ditemukan.']);
        }

        // Periksa apakah password lama cocok
        if (!password_verify($oldPassword, $user['password'])) {
            log_activity('Ganti Password', 'Ganti Password Gagal, Password Lama Tidak Cocok');
            return redirect()->back()->with('errors', ['Password lama tidak cocok.']);
        }

        // Update password baru
        $userModel->update($user['id'], [
            'password' => password_hash($newPassword, PASSWORD_BCRYPT)
        ]);

        log_activity('Ganti Password', 'Ganti Password Berhasil');
        return redirect()->to('/dashboard-admin')->with('Pesan', 'Password berhasil diubah.');
    }
}
