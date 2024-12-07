<?php

namespace App\Controllers;

use App\Models\KaryawanModel;
use App\Models\GolonganModel;
use App\Models\JabatanModel;

class Karyawan extends BaseController
{
    protected $karyawanModel;
    protected $golonganModel;
    protected $jabatanModel;
   
    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
        $this->golonganModel = new GolonganModel();
        $this->jabatanModel = new JabatanModel();
    }

    public function index()
    {
        $data['title'] = 'Data Pegawai';
        $data['users'] = $this->karyawanModel->getAllData();
        $data['golongan_options'] = $this->golonganModel->findAll();
        $data['jabatan_options'] = $this->jabatanModel->findAll();
        return view('TemplateDashboard/header', $data)
            . view('dashboard/data_pegawai', $data)
            . view('TemplateDashboard/sidebar')
            . view('TemplateDashboard/footer');
    }

    public function save()
    {
        // Validasi data input
        $this->validate([
            'name' => 'required',
            'nip' => 'required',
            'jenis_kelamin' => 'required',
            'pendidikan_terakhir' => 'required',
            'status' => 'required',
            'tanggal_masuk' => 'required',
            'golongan_terakhir' => 'required',
            'jabatan_terakhir' => 'required'
        ]);

        $id = $this->request->getPost('id');
        $data = [
            'name' => $this->request->getPost('name'),
            'nip' => $this->request->getPost('nip'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'pendidikan_terakhir' => $this->request->getPost('pendidikan_terakhir'),
            'status' => $this->request->getPost('status'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'tanggal_keluar' => $this->request->getPost('tanggal_keluar'),
            'keterangan' => $this->request->getPost('keterangan'),
            'golongan_terakhir' => $this->request->getPost('golongan_terakhir'),
            'jabatan_terakhir' => $this->request->getPost('jabatan_terakhir')
        ];

        $fotoProfil = $this->uploadFoto();
        if ($fotoProfil) {
            $data['foto_profil'] = $fotoProfil;
        } else {
            if ($id) {
                $existingData = $this->karyawanModel->find($id);
                $data['foto_profil'] = $existingData['foto_profil'];
            }
        }

        if ($id) {
            $this->karyawanModel->update($id, $data);
        } else {
            $this->karyawanModel->save($data);
        }

        return redirect()->to('/karyawan');
    }

    public function delete($id)
    {
        $this->karyawanModel->delete($id);
        return redirect()->to('/karyawan');
    }

    // Mengambil data untuk diedit
    public function edit($id)
    {
        return $this->response->setJSON($this->karyawanModel->find($id));
    }

    private function uploadFoto()
    {
        $foto = $this->request->getFile('foto_profil');

        if ($foto->isValid() && !$foto->hasMoved()) {
            $newFileName = $foto->getRandomName();
            $foto->move('public/upload', $newFileName);

            return $newFileName;
        }

        return null;
    }

    public function detail($id)
    {
        $karyawan = $this->karyawanModel->find($id);
        if ($karyawan) {
            return $this->response->setJSON($karyawan);
        } else {
            return $this->response->setStatusCode(404, 'Karyawan tidak ditemukan');
        }
    }
}
