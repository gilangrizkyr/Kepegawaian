<?php

namespace App\Controllers;

use App\Models\CutiModel;
use App\Models\HistoriCutiModel;

class Cuti extends BaseController
{
    protected $cutiModel;
    protected $historiCutiModel;

    public function __construct()
    {
        $this->cutiModel = new CutiModel();
        $this->historiCutiModel = new HistoriCutiModel();
    }

    public function index()
    {
        $data['title'] = 'Informasi Cuti';
        $role = session()->get('role');
        $data['users'] = [];
        $data['users'] = $this->cutiModel->findAll();

        if ($this->request->getGet('search_name') || $this->request->getGet('search_nip')) {
            $searchName = $this->request->getGet('search_name');
            $searchNip = $this->request->getGet('search_nip');
            $data['users'] = $this->cutiModel->searchUsers($searchName, $searchNip);
        }

        $today = date('Y-m-d');
        foreach ($data['users'] as &$user) {
            if ($today == $user['tanggal_mulai_cuti']) {
                $user['status_cuti'] = 'Sedang Cuti';
            } elseif ($today > $user['tanggal_mulai_cuti'] && $today <= $user['tanggal_cuti_terakhir']) {
                $user['status_cuti'] = 'Sedang Cuti';
            } elseif ($today > $user['tanggal_cuti_terakhir']) {
                $user['status_cuti'] = 'Tidak Cuti';
            } else {
                $user['status_cuti'] = 'Tidak Cuti';
            }
        }

        if ($role === 'user') {
            return view('TemplateDashboard/header', $data) .
                view('users/cuti', $data) .
                view('TemplateDashboard/sidebar', $data) .
                view('TemplateDashboard/footer', $data);
        } else {
            return view('TemplateDashboard/header', $data) .
                view('dashboard/cuti', $data) .
                view('TemplateDashboard/sidebar', $data) .
                view('TemplateDashboard/footer', $data);
        }
    }

    public function view($id)
    {
        $user = $this->cutiModel->find($id);
        if (!$user) {
            return $this->response->setJSON(['error' => 'Karyawan tidak ditemukan']);
        }

        $historiCuti = $this->historiCutiModel->getHistoriByKaryawanId($id);

        return $this->response->setJSON([
            'name' => $user['name'],
            'nip' => $user['nip'],
            'sisa_cuti' => $user['sisa_cuti'],
            'histori_cuti' => $historiCuti
        ]);
    }

    public function error()
    {
        $data['title'] = 'Cannot Access This Page';

        return view('TemplateDashboard/header', $data) .
            view('dashboard/404', $data) .
            view('TemplateDashboard/sidebar') .
            view('TemplateDashboard/footer');
    }

    public function updateCuti()
    {
        try {
            $id = $this->request->getPost('id');
            $jumlahCutiDiminta = $this->request->getPost('jumlah_hari_cuti');
            $keterangan = $this->request->getPost('keterangan_cuti');
            $tanggalMulai = $this->request->getPost('tanggal_mulai_cuti');
            $tanggalAkhir = $this->request->getPost('tanggal_cuti_terakhir');

            log_message('debug', "ID: $id, Jumlah Cuti: $jumlahCutiDiminta, keterangan: $keterangan");

            if (empty($id) || empty($jumlahCutiDiminta) || empty($keterangan) || empty($tanggalMulai) || empty($tanggalAkhir)) {
                log_message('error', 'Data tidak lengkap');
                return $this->response->setJSON(['status' => 'error', 'error' => 'Data tidak lengkap']);
            }

            $karyawan = $this->cutiModel->find($id);
            if (!$karyawan) {
                return $this->response->setJSON(['status' => 'error', 'error' => 'Karyawan tidak ditemukan']);
            }

            $sisaCuti = (int)$karyawan['sisa_cuti'];
            if ($jumlahCutiDiminta > $sisaCuti) {
                return $this->response->setJSON(['status' => 'error', 'error' => 'Cuti melebihi sisa cuti']);
            }

            $sisaCuti -= $jumlahCutiDiminta;
            $cutiDiambil = (int)$karyawan['cuti_diambil'] + $jumlahCutiDiminta;

            $this->cutiModel->updateCuti($id, $sisaCuti, $cutiDiambil, $keterangan);

            $this->historiCutiModel->insert([
                'karyawan_id' => $id,
                'tanggal_mulai' => $tanggalMulai,
                'tanggal_akhir' => $tanggalAkhir,
                'jumlah_hari' => $jumlahCutiDiminta,
                'keterangan' => $keterangan,
                'tahun_cuti' => date('Y'),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            return $this->response->setJSON(['status' => 'success']);
        } catch (\Exception $e) {
            log_message('error', 'Error: ' . $e->getMessage());
            return $this->response->setJSON(['status' => 'error', 'error' => 'Terjadi kesalahan di server']);
        }
    }

    public function search()
    {
        $searchName = $this->request->getGet('search_name');
        $searchNip = $this->request->getGet('search_nip');
        $users = $this->cutiModel->like('name', $searchName)->like('nip', $searchNip)->findAll();
        foreach ($users as &$user) {
            $user['histori'] = $this->cutiModel->getHistoriCuti($user['id']);
        }
        return $this->response->setJSON($users);
    }
}
