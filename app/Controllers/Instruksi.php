<?php

namespace App\Controllers;

use App\Models\InstruksiModel;

class Instruksi extends BaseController
{
    protected $instruksiModel;

    public function __construct()
    {
        $this->instruksiModel = new InstruksiModel();
    }
    public function index()
    {
        $data['title'] = 'Instruksi Pimpinan';
        $data['instruksi'] = $this->instruksiModel->getAllInstruksi();

        return view('TemplateDashboard/header', $data) .
            view('dashboard/instruksi', $data) .
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
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $this->validator->getErrors()
            ]);
        }
        $this->instruksiModel->createInstruksi($data);
        return $this->response->setJSON(['status' => 'success']);
    }
    public function edit($id)
    {
        $data = $this->instruksiModel->getInstruksiById($id);
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
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $this->instruksiModel->updateInstruksi($id, $data);
        return $this->response->setJSON(['status' => 'success']);
    }
    public function delete($id)
    {
        // Menghapus instruksi berdasarkan ID
        $this->instruksiModel->deleteInstruksi($id);

        // Mengembalikan response sukses
        return $this->response->setJSON(['status' => 'success']);
    }
}
