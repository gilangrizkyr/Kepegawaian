<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Config\View;

class Admin extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function pendingRegistrations()
    {
        $data['title'] = 'Verfikasi Pengguna';
        $kabag_id = session()->get('kabag_id');

        $data['pending_users'] = $this->userModel->getPendingUsers($kabag_id);

        return view('Templatedashboard/header', $data) .
            view('admin/pending', $data) .
            view('Templatedashboard/sidebar') .
            view('Templatedashboard/footer');
    }

    public function verify($id)
    {
        if ($this->userModel->update($id, ['is_verified' => true])) {
            return redirect()->to('/admin/pending')->with('success', 'User verified successfully!');
        } else {
            return redirect()->to('/admin/pending')->with('error', 'Failed to verify user.');
        }
    }

    public function reject($id)
    {
        return redirect()->to('/admin/pending')->with('success', 'User rejected successfully!');
    }
}
