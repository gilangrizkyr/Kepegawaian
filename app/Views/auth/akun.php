<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="card-box mb-30">
                <div class="pd-20" style="display: flex; justify-content: space-between; align-items: center;">
                    <h4 class="text-blue h4">Daftar Akun</h4>
                    <div>
                        <button class="btn btn-success" onclick="openModal()">
                            <i class="icon-copy dw dw-add"></i> Tambah Akun
                        </button>
                    </div>
                </div>
                <div class="pb-20">
                    <table id="akunTable" class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">NIP</th>
                                <th>Nama</th>
                                <th class="datatable-nosort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($user['nip']) ?></td>
                                        <td><?= htmlspecialchars($user['name']) ?></td>
                                        <td>
                                            <div class="table-actions" style="display: flex; gap: 10px;">
                                                <a href="javascript:void(0);" title="Edit" onclick="openEditModal(<?= $user['id'] ?>, '<?= htmlspecialchars($user['nip']) ?>', '<?= htmlspecialchars($user['name']) ?>');" style="color: #007bff; text-decoration: none;">
                                                    <i class="icon-copy dw dw-edit2" style="font-size: 20px;"></i>
                                                </a>
                                                <a href="javascript:void(0);" title="Delete" onclick="deleteUser(<?= $user['id'] ?>);" style="color: #dc3545; text-decoration: none;">
                                                    <i class="icon-copy dw dw-delete-3" style="font-size: 20px;"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3">Tidak ada data akun yang ditemukan.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah / Edit Akun -->
<div class="modal fade" id="akunModal" tabindex="-1" aria-labelledby="akunModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('akun/store') ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="akunModalLabel">Tambah Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="akunId" name="id">
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="saveButton">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('akunId').value = '';
        document.getElementById('nip').value = '';
        document.getElementById('name').value = '';
        document.getElementById('akunModalLabel').innerText = 'Tambah Akun';
        $('#akunModal').modal('show');
    }

    function openEditModal(id, nip, name) {
        document.getElementById('akunId').value = id;
        document.getElementById('nip').value = nip;
        document.getElementById('name').value = name;
        document.getElementById('akunModalLabel').innerText = 'Edit Akun';
        $('#akunModal').modal('show');
    }

    function deleteUser(id) {
        if (confirm('Apakah Anda yakin ingin menghapus akun ini?')) {
            window.location.href = '<?= base_url("akun/delete/") ?>' + id;
        }
    }
</script>