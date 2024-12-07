<?php

namespace App\Controllers;

use App\Models\UpacaraModel;

class Upacara extends BaseController
{
    protected $upacaraModel;

    public function __construct()
    {
        $this->upacaraModel = new UpacaraModel();
    }

    public function index()
    {
        $data['title'] = 'Upacara';
        $data['upacara'] = $this->upacaraModel->getAllUpacara();

        return view('TemplateDashboard/header', $data) .
            view('dashboard/upacara', $data) .
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

        $this->upacaraModel->createUpacara($data);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function edit($id)
    {
        $data = $this->upacaraModel->getUpacaraById($id);
        return $this->response->setJSON($data);
    }

    public function update($id)
    {
        $data = $this->request->getPost();

        // Validasi input
        if (!$this->validate([
            'name' => 'required',
            'keterangan' => 'required',
            'tanggal_acara' => 'required|valid_date'
        ])) {
            return $this->response->setJSON(['status' => 'error', 'errors' => $this->validator->getErrors()]);
        }

        $this->upacaraModel->updateUpacara($id, $data);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function delete($id)
    {
        $this->upacaraModel->deleteUpacara($id);
        return $this->response->setJSON(['status' => 'success']);
    }
}
