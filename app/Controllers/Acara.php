<?php

namespace App\Controllers;

use App\Models\AcaraModel;

class Acara extends BaseController
{
    protected $acaraModel;

    public function __construct()
    {
        $this->acaraModel = new AcaraModel();
    }

    public function index()
    {
        $data['title'] = 'Zoom';
        $data['acara'] = $this->acaraModel->getAllAcara();

        return view('TemplateDashboard/header', $data) .
            view('dashboard/acara', $data) .
            view('TemplateDashboard/sidebar') .
            view('TemplateDashboard/footer');
    }


    public function create()
    {
        $data = $this->request->getPost();
        log_message('info', 'Data received: ' . json_encode($data));

        if (!$this->validate([
            'name' => 'required',
            'keterangan' => 'required',
            'tanggal_acara' => 'required|valid_date'
        ])) {
            return $this->response->setJSON(['status' => 'error', 'errors' => $this->validator->getErrors()]);
        }

        $this->acaraModel->createAcara($data);
        return $this->response->setJSON(['status' => 'success']);
    }


    public function edit($id)
    {
        $data = $this->acaraModel->getAcaraById($id);
        return $this->response->setJSON($data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();

        if (!$this->validate([
            'name' => 'required',
            'keterangan' => 'required',
            'tanggal_acara' => 'required|valid_date'
        ])) {
            return $this->response->setJSON(['status' => 'error', 'errors' => $this->validator->getErrors()]);
        }

        $this->acaraModel->updateAcara($id, $data);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function delete($id)
    {
        $this->acaraModel->deleteAcara($id);
        return $this->response->setJSON(['status' => 'success']);
    }
}
