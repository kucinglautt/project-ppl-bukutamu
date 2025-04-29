<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class PetugasFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(!session()->get('logged_in')){
            session()->setFlashdata('Pesan', 'Anda Belum Login');
            return redirect()->to('/');
        }

        if(session()->get('role') != 'petugas'){
            session()->setFlashdata('Pesan', 'Akses ditolak');
            return redirect()->back();
        }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}