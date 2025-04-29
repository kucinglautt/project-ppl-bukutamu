<?php namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        helper('activity');

        $session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userCheck = new UserModel();
        $check = $userCheck->where('username',$username)->first();

        if($check){
            // Jika data valid
            $checkPassword = password_verify($password, $check['password']);
                if($checkPassword){
                    // Jika password valid
                    $sessionData = [
                        'id' => $check['id'],
                        'username' => $check['username'],
                        'role' => $check['role'],
                        'logged_in' => TRUE,
                    ];
                    $session->set($sessionData);

                    if (!empty($this->request->getPost('remember_me'))) {
                        // Set cookie untuk username dan password
                        setcookie("loginId", $username, time() + (10 * 365 * 24 * 60 * 60), "/", "",true, true);
                        setcookie("loginPass", $password, time() + (10 * 365 * 24 * 60 * 60), "/", "",true, true); 

                    } else {
                        // Hapus cookie jika tidak di-remember
                        setcookie("loginId", "", time() - 3600, "/");  // Menghapus cookie dengan waktu yang sudah lewat
                        setcookie("loginPass", "", time() - 3600, "/");  // Menghapus cookie dengan waktu yang sudah lewat
                    }

                        log_activity('Login', 'Login berhasil');

                        // Redirect sesuai role
                        if ($check['role'] === 'admin') {
                            return redirect()->to('/dashboard-admin');
                        } elseif ($check['role'] === 'petugas') {
                            return redirect()->to('/dashboard-petugas');
                        } else {
                            log_activity('Login', 'Login Gagal, Akun Belum Terdaftar');
                            return redirect()->to('/')->with('Pesan', 'Login Gagal, Akun Belum Terdaftar');
                        }
                            }else{
                                // Jika password tidak valid
                                log_activity('Login', 'Login Gagal, Password Salah');
                                session()->setFlashdata('Pesan', 'Login Gagal, Password Salah!');
                                return redirect()->to('/');
                            }
                        } else {
                            // Gagal login
                            log_activity('Login', 'Login Gagal, Username Salah');
                            $pesan = $check ? 'Login Gagal, Password Salah!' : 'Login Gagal, Username Salah!';
                            return redirect()->to('/')->with('pesan', $pesan);
                        }
                    }

    public function lupaPassword()
    {
        return view('/auth/lupa_password');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        log_activity('Logout', 'Logout berhasil');
        return redirect()->to('/');
    }
}