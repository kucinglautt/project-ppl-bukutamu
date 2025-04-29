<?php namespace App\Controllers;

use App\Models\VisitModel;

class VisitController extends BaseController
{
    public function index()
    {
        $model = new VisitModel();
        $data['visits'] = $model->findAll();
        
        return view('visits/index', $data);
    }

    public function create()
    {
        return view('visits/create');
    }

    public function store()
    {
        $model = new VisitModel();
        
        $data = [
            'guest_id'  => $this->request->getPost('guest_id'),
            'check_in'  => $this->request->getPost('check_in'),
            'check_out' => $this->request->getPost('check_out'),
            'status'    => $this->request->getPost('status'),
            'handled_by' => $this->request->getPost('handled_by'),
        ];
        
        $model->save($data);
        return redirect()->to('/visits');
    }
}