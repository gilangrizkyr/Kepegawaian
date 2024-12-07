<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{
    protected $AuthModel;

    public function __construct()
    {
        $this->AuthModel = new AuthModel();
    }

    public function index()
    {
        $data['users'] = $this->AuthModel->findAll();
        return view('template/header') .
            view('auth/login', $data) .
            view('template/footer');
    }

    public function login()
    {
        $nip = $this->request->getPost('nip');
        $name = $this->request->getPost('name');

        log_message('info', 'Attempting to login with NIP: ' . $nip . ' and Name: ' . $name);

        $client = \Config\Services::curlrequest();

        try {
            $response = $client->post('http://localhost:3000/login', [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => ['nip' => $nip, 'name' => $name]
            ]);
        } catch (\CodeIgniter\HTTP\Exceptions\HTTPException $e) {
            log_message('error', 'HTTP error: ' . $e->getMessage());
            session()->setFlashdata('error_users', 'NIP atau nama salah.');
            return redirect()->back();
        }

        $responseData = json_decode($response->getBody(), true);
        log_message('info', 'Response Data: ' . print_r($responseData, true));

        if ($responseData['status'] === 'success' && isset($responseData['data'])) {
            session()->set('user_id', $responseData['data']['id']);
            session()->set('nip', $nip);
            session()->set('role', $responseData['data']['role']);
            session()->set('name', $responseData['data']['name']);
            session()->set('token', $responseData['data']['token']);

            log_message('info', 'User logged in: ' . $nip);
            return redirect()->to('/dashboard');
        } else {
            session()->setFlashdata('error_users', $responseData['message'] ?? 'Unexpected error');
            return redirect()->back();
        }
    }

    public function logout()
    {
        // Ambil token dari session
        $token = session()->get('token');

        if (!$token) {
            return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu.');
        }
        $client = \Config\Services::curlrequest();
        $response = $client->post('http://localhost:3000/logout', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ]
        ]);

        if ($response->getStatusCode() === 200) {
            session()->remove('token');
            return redirect()->to('/')->with('success', 'Logout berhasil.');
        } else {
            log_message('error', 'Logout failed: ' . $response->getBody());
            return redirect()->to('/dashboard')->with('error', 'Logout gagal, silakan coba lagi.');
        }
    }

    public function create()
    {
        $AuthModel = new AuthModel();
        // $AuthModel = new AuthModel();
        $data['jenis_kelamin'] = $AuthModel->getEnumValues('users', 'jenis_kelamin');

        return view('template/header') .
            view('auth/register', $data) .
            view('template/footer');
    }

    public function store()
    {
        $nip = $this->request->getPost('nip');
        if ($this->AuthModel->where('nip', $nip)->first()) {
            return redirect()->back()->withInput()->with('error', 'NIP sudah terdaftar. Silahkan login.');
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'nip' => $nip,
            'username' => $this->request->getPost('username'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role' => 'user',
            'jabatan' => $this->request->getPost('jabatan'),
            'created_at' => date('Y-m-d')
        ];
        $this->AuthModel->insert($data);
        return redirect()->to('/')->with('success', 'Pendaftaran berhasil!');
    }

    public function edit($id)
    {
        $data['user'] = $this->AuthModel->find($id);
        return view('user/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'role' => $this->request->getPost('role'),
            'jabatan' => $this->request->getPost('jabatan')
        ];

        $this->AuthModel->update($id, $data);
        return redirect()->to('UserController/index');
    }

    public function delete($id)
    {
        $this->AuthModel->delete($id);
        return redirect()->to('UserController/index');
    }

    public function validateForgotPassword()
    {
        $username = $this->request->getPost('username');
        $jabatan = $this->request->getPost('jabatan');

        $user = $this->AuthModel->where('username', $username)
            ->where('jabatan', $jabatan)
            ->first();

        if ($user) {
            session()->setFlashdata('userId', $user['id']);
            return redirect()->to('/');
        } else {
            return redirect()->back()->with('error', 'Username atau Jabatan tidak valid. Silahkan Hubungi Pengelola');
        }
    }

    public function updatePassword()
    {
        $userId = $this->request->getPost('userId');
        $newPassword = password_hash($this->request->getPost('new_password'), PASSWORD_BCRYPT);

        $this->AuthModel->update($userId, ['password' => $newPassword]);

        return redirect()->to('/')->with('success', 'Password berhasil diubah!');
    }

    public function resetPassword()
    {
        return view('template/header') .
            view('auth/reset_password') .
            view('template/footer');
    }
}
