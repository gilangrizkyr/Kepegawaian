<?php

namespace App\Controllers;

use App\Models\DeskripsiModel;

class DeskripsiController extends BaseController
{
    protected $deskripsiModel;

    public function __construct()
    {
        $this->deskripsiModel = new DeskripsiModel();
    }
    public function deskripsi()
    {
        $data['title'] = 'Informasi Deskripsi';
        $data['deskripsi'] = $this->deskripsiModel->getDeskripsi();
        return view('Templatedashboard/header', $data)
            . view('edithalaman/index', $data)
            . view('Templatedashboard/sidebar', $data)
            . view('Templatedashboard/footer');
    }
    public function save()
    {
        $id = $this->request->getPost('id');
        $deskripsi = $this->request->getPost('deskripsi');
        if (!$this->validate([
            'deskripsi' => 'required|min_length[3]'
        ])) {
            return redirect()->to('/deskripsi')->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = ['deskripsi' => $deskripsi];

        if ($id) {
            $this->deskripsiModel->update($id, $data);
            $message = 'Deskripsi berhasil diperbarui.';
        } else {
            if ($this->deskripsiModel->countAll() > 0) {
                return redirect()->to('/deskripsi')->with('message', 'Deskripsi sudah ada. Tidak bisa menambah data baru.');
            }
            $this->deskripsiModel->save($data);
            $message = 'Deskripsi berhasil ditambahkan.';
        }
        return redirect()->to('/deskripsi')->with('message', $message);
    }
    public function delete($id)
    {
        $this->deskripsiModel->delete($id);
        return redirect()->to('/deskripsi')->with('message', 'Deskripsi berhasil dihapus.');
    }
}
