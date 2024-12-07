<?php

namespace App\Controllers;

use App\Models\SuratModel;
use App\Models\NomorDibatalkanModel;
use CodeIgniter\Controller;

class SuratController extends Controller
{
    protected $suratModel;
    protected $nomorDibatalkanModel;

    public function __construct()
    {
        $this->suratModel = new SuratModel();
        $this->nomorDibatalkanModel = new NomorDibatalkanModel();
    }

    // Menampilkan semua surat
    public function index()
    {
        $data = [
            'title' => 'Daftar Surat',
            'surat' => $this->suratModel->findAll(), // Ambil semua surat
            'nomor_surat' => $this->getNomorSurat(), // Ambil nomor surat otomatis
        ];

        return view('TemplateDashboard/header', $data) .
            view('turt/index', $data) .
            view('TemplateDashboard/sidebar', $data) .
            view('TemplateDashboard/footer', $data);
    }

    // Menyimpan surat baru atau memperbarui
    public function save()
    {
        $id = $this->request->getPost('id');
        $data = [
            'nomor_surat' => $this->request->getPost('nomor_surat'),
            'kepada' => $this->request->getPost('kepada'),
            'tembusan' => $this->request->getPost('tembusan'),
            'tahun' => $this->request->getPost('tahun'),
            'tanggal_keluar' => $this->request->getPost('tanggal_keluar'),
            'perihal' => $this->request->getPost('perihal'),
        ];

        if ($id) {
            // Update
            $data['id'] = $id;
            $this->suratModel->save($data);
        } else {
            // Create
            $this->suratModel->save($data);
        }

        return $this->response->setJSON(['status' => 'success']);
    }

    public function batalkan()
    {
        $id = $this->request->getPost('id');
        // Periksa apakah id valid
        if ($id) {
            // Tandai surat sebagai dibatalkan (misalnya dengan mengubah status)
            $this->suratModel->update($id, ['status' => 'dibatalkan']);

            // Simpan nomor yang dibatalkan
            $nomorSurat = $this->suratModel->find($id)['nomor_surat'];
            $this->nomorDibatalkanModel->save(['nomor_surat' => $nomorSurat]);

            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'ID tidak ditemukan']);
        }
    }


    private function getNomorSurat()
    {
        $nomorDibatalkan = $this->nomorDibatalkanModel->findAll();

        if (count($nomorDibatalkan) > 0) {
            // Jika ada nomor yang dibatalkan, ambil nomor terkecil yang dibatalkan
            $nomor_surat = min(array_column($nomorDibatalkan, 'nomor_surat'));
            return $nomor_surat;
        }

        // Jika tidak ada nomor yang dibatalkan, ambil nomor surat terakhir dan tambahkan 1
        $nomorTerakhir = $this->suratModel->selectMax('nomor_surat')->first();
        $nomor_surat = ($nomorTerakhir['nomor_surat'] ?? 0) + 1;

        return $nomor_surat;
    }
}
