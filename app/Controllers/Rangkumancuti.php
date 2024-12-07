<?php

namespace App\Controllers;

use App\Models\RangkumancutiModel; // Gunakan nama model yang baru

class Rangkumancuti extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Rangkuman Cuti';
        $model = new RangkumancutiModel(); // Pastikan ini menggunakan model yang benar
        $data['rangkuman'] = $model->getRangkumanCuti();

        return view('TemplateDashboard/header', $data) .
               view('dashboard/laporan_cuti', $data) .
               view('TemplateDashboard/sidebar', $data) .
               view('TemplateDashboard/footer', $data);
    }
}
