<?php

namespace App\Controllers;

use App\Models\GolonganModel;

class GolonganController extends BaseController
{
    protected $golonganModel;

    public function __construct()
    {
        $this->golonganModel = new GolonganModel();
    }

    public function golongan()
    {
        $data['title'] = 'Data Golongan';
        $data['golongan'] = $this->golonganModel->findAll(); // Ambil semua data
        return view('TemplateDashboard/header', $data)
            . view('struktural/golongan', $data)
            . view('TemplateDashboard/sidebar')
            . view('TemplateDashboard/footer');
    }

    public function create()
    {
        $this->golonganModel->save([
            'name' => $this->request->getPost('name')
        ]);
        return redirect()->to('/golongan');
    }

    public function edit($id)
    {
        return $this->response->setJSON($this->golonganModel->find($id));
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $this->golonganModel->update($id, [
            'name' => $this->request->getPost('name')
        ]);
        return redirect()->to('/golongan');
    }

    public function delete($id)
    {
        $this->golonganModel->delete($id);
        return redirect()->to('/golongan');
    }
}
