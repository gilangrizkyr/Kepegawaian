<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay"></div>

<!-- Main Container -->
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Informasi Karyawan</h4>
                    <?php if (session()->get('role') !== 'user'): ?>
                        <button class="btn btn-success" onclick="openCreateModal()">Tambah Karyawan</button>
                    <?php endif; ?>
                </div>
                <div class="pb-20">
                    <table class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="table-plus datatable-nosort">Nama Lengkap</th>
                                <th>Jabatan</th>
                                <th>NIP</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)): ?>
                                <?php $no = 1; // Inisialisasi nomor urut 
                                ?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                    <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($user['name']) ?></td>
                                        <td><?= htmlspecialchars($user['jabatan_terakhir']) ?></td>
                                        <td><?= htmlspecialchars($user['nip']) ?></td>
                                        <td>
                                            <?php
                                            $status = htmlspecialchars($user['status']);
                                            $buttonStyle = '';
                                            switch ($status) {
                                                case 'Aktif':
                                                    $buttonStyle = 'background-color: green; color: white;';
                                                    break;
                                                case 'Pensiun':
                                                    $buttonStyle = 'background-color: blue; color: white;';
                                                    break;
                                                case 'Pindah Dinas':
                                                    $buttonStyle = 'background-color: orange; color: white;';
                                                    break;
                                                case 'PHK':
                                                    $buttonStyle = 'background-color: red; color: white;';
                                                    break;
                                            }
                                            ?>
                                            <span style="<?= $buttonStyle ?> padding: 5px 10px; border-radius: 5px;"><?= $status ?></span>
                                        </td>
                                        <?php if (session()->get('role') !== 'user'): ?>
                                            <td><?= htmlspecialchars($user['golongan_terakhir']) ?></td>
                                        <?php endif; ?>
                                        <?php if (session()->get('role') !== 'user'): ?>
                                            <td>
                                                <button class="btn btn-primary" onclick="openEditModal(<?= $user['id'] ?>)">Edit</button>
                                                <button class="btn btn-danger" onclick="deleteKaryawan(<?= $user['id'] ?>)">Delete</button>
                                                <button class="btn btn-info" onclick="openViewModal(<?= $user['id'] ?>)">View</button>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">Belum ada data yang terinput</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>