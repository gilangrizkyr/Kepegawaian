<?php

namespace App\Controllers;

use App\Models\userModel;
use App\Models\CutiModel;
use App\Models\DeskripsiModel;

class Dashboard extends BaseController
{
    protected $userModel;
    protected $cutiModel;
    protected $deskripsiModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->cutiModel = new CutiModel();
        $this->deskripsiModel = new DeskripsiModel();

        if (!session()->has('user_id')) { 
            return redirect()->back()->with('error', 'Anda harus login terlebih dahulu');
        }
    }

    public function index(): string
    {
        $data['title'] = 'Dashboard';
        // $data['statusCounts'] = $this->userModel->select('status, COUNT(*) as count')
        //     ->groupBy('status')
        //     ->findAll();
        $deskripsi = $this->deskripsiModel->first();
        $data['deskripsi'] = $deskripsi ? $deskripsi : null;

        return view('Templatedashboard/header', $data) .
            view('dashboard/index') .
            view('Templatedashboard/sidebar', $data) .
            view('Templatedashboard/footer');
        // echo "masuk";
    }

    public function data_pegawai(): string
    {
        $data['title'] = 'Informasi Kepegawaian';
        // $data['karyawan'] = $this->userModel->getAllUsers();

        return view('Templatedashboard/header', $data) .
            view('dashboard/data_pegawai') .
            view('Templatedashboard/sidebar') .
            view('Templatedashboard/footer');
    }
}
