<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;

class AkunController extends Controller
{
    public function index()
    {
        $client = Services::curlrequest();

        try {
            $response = $client->get('http://localhost:3000/auth', [
                'headers' => [
                    'Authorization' => 'Bearer ' . session()->get('token')
                ]
            ]);

            $responseData = json_decode($response->getBody(), true);

            if ($responseData['status'] == 'success') {
                $data['users'] = $responseData['data'];
            } else {
                $data['users'] = [];
            }
        } catch (\CodeIgniter\HTTP\Exceptions\HTTPException $e) {
            $data['users'] = [];
            $data['error'] = 'Terjadi kesalahan saat mengambil data dari API.';
        }
        $data['title'] = 'Daftar Pengguna';

        return view('TemplateDashboard/header', $data) .
            view('auth/akun', $data) .
            view('TemplateDashboard/sidebar', $data) .
            view('TemplateDashboard/footer', $data);
    }

    // public function create()
    // {
    //     $data['title'] = 'Tambah Pengguna';
    //     return view('TemplateDashboard/header', $data) .
    //         view('auth/create_akun', $data) .
    //         view('TemplateDashboard/sidebar', $data) .
    //         view('TemplateDashboard/footer', $data);
    // }

    public function store()
    {
        $nip = $this->request->getPost('nip');
        $name = $this->request->getPost('name');
        $id = $this->request->getPost('id');
        $client = Services::curlrequest();
        $data = [
            'nip' => $nip,
            'name' => $name
        ];
        try {
            if ($id) {
                $response = $client->put("http://localhost:3000/auth/{$id}", ['json' => $data]);
            } else {
                $response = $client->post('http://localhost:3000/register', ['json' => $data]);
            }

            $responseData = json_decode($response->getBody(), true);

            if ($responseData['status'] == 'success') {
                return redirect()->to('/akun')->with('success', $id ? 'Akun berhasil diperbarui!' : 'Akun berhasil dibuat!');
            } else {
                return redirect()->back()->with('error', $responseData['message']);
            }
        } catch (\CodeIgniter\HTTP\Exceptions\HTTPException $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function delete($id)
    {
        $client = Services::curlrequest();

        try {
            $response = $client->delete("http://localhost:3000/auth/{$id}");
            $responseData = json_decode($response->getBody(), true);
            if ($responseData['status'] == 'success') {
                return redirect()->to('/akun')->with('success', 'Akun berhasil dihapus!');
            } else {
                return redirect()->to('/akun')->with('error', $responseData['message']);
            }
        } catch (\CodeIgniter\HTTP\Exceptions\HTTPException $e) {
            return redirect()->to('/akun')->with('error', 'Terjadi kesalahan saat menghapus akun.');
        }
    }
}
