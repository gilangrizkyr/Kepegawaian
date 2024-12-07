<?php

use CodeIgniter\HTTP\RedirectResponse;
?>
<div class="left-side-bar">
    <div class="brand-logo">
        <a>
            <img src="<?= base_url(); ?>assets/master/vendors/images/br.png" alt="" class="dark-logo" />
            <img
                src="vendors/images/deskapp-logo-white.svg"
                alt=""
                class="light-logo" />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="<?= base_url('/dashboard'); ?>" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-house"></span>
                        <span class="mtext">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('/karyawan'); ?>" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-file-earmark-text"></span>
                        <span class="mtext">Data Pegawai</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-calendar-event"></span>
                        <span class="mtext">Agenda Kepegawaian</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="<?= base_url('/acara') ?>">Zoom</a></li>
                        <li><a href="<?= base_url('/upacara') ?>">Upacara</a></li>
                        <li><a href="<?= base_url('/instruksi') ?>">Instruksi Pimpinan</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-diagram-3"></span>
                        <span class="mtext">Struktural</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="<?= base_url('/golongan') ?>">Golongan</a></li>
                        <li><a href="<?= base_url('/jabatan') ?>">Jabatan</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?= base_url('/deskripsi'); ?>" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-pencil-square"></span>
                        <span class="mtext">Edit Deskripsi</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="<?= base_url('/surat'); ?>" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-file-earmark-text"></span>
                        <span class="mtext">Nomor Document</span>
                    </a>
                </li> -->
                <?php
                $role = $_SESSION['role'];
                ?>
                <?php if ($role === 'super_admin'): ?>
                    <li>
                        <a href="<?= base_url('/akun'); ?>" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-person-plus"></span>
                            <span class="mtext">Tambah Pengguna</span>
                        </a>
                    </li>
                <?php endif; ?>
                <!-- <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-calendar-event"></span>
                        <span class="mtext">Cuti Pegawai</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="<?= base_url('/cuti') ?>">Informasi Cuti Pegawai</a></li>
                        <li><a href="<?= base_url('/rangkumancuti'); ?>">Rangkuman Cuti</a></li>
                    </ul>
                </li> -->
            </ul>
        </div>
    </div>
</div>