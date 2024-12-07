<?php

namespace App\Controllers;

use App\Models\JabatanModel;

class JabatanController extends BaseController
{
    protected $jabatanModel;

    public function __construct()
    {
        $this->jabatanModel = new JabatanModel();
    }

    public function jabatan()
    {
        $data['title'] = 'Data Jabatan';
        $data['jabatan'] = $this->jabatanModel->findAll(); // Ambil semua data jabatan
        return view('TemplateDashboard/header', $data)
            . view('struktural/jabatan', $data)
            . view('TemplateDashboard/sidebar')
            . view('TemplateDashboard/footer');
    }

    public function create()
    {
        $this->jabatanModel->save([
            'name' => $this->request->getPost('name')
        ]);
        return redirect()->to('/jabatan');
    }

    public function edit($id)
    {
        return $this->response->setJSON($this->jabatanModel->find($id));
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $this->jabatanModel->update($id, [
            'name' => $this->request->getPost('name')
        ]);
        return redirect()->to('/jabatan');
    }

    public function delete($id)
    {
        $this->jabatanModel->delete($id);
        return redirect()->to('/jabatan');
    }
}
