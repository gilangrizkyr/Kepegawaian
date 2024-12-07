<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="card-box mb-30">
                <div class="pd-20" style="display: flex; justify-content: space-between; align-items: center;">
                    <h4 class="text-blue h4">Data Jabatan</h4>
                    <div>
                        <button class="btn btn-success" onclick="openCreateJabatanModal()">
                            <i class="icon-copy dw dw-add"></i> Tambah Jabatan
                        </button>
                    </div>
                </div>
                <div class="pb-20">
                    <table id="jabatanTable" class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">Jabatan</th>
                                <th class="datatable-nosort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($jabatan)): ?>
                                <?php foreach ($jabatan as $item): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['name']) ?></td>
                                        <td>
                                            <div class="table-actions">
                                                <a href="javascript:void(0);" onclick="openEditJabatanModal(<?= $item['id'] ?>);" title="Edit">
                                                    <i class="icon-copy dw dw-edit2"></i>
                                                </a>
                                                <a href="javascript:void(0);" onclick="deleteJabatan(<?= $item['id'] ?>);" title="Delete">
                                                    <i class="icon-copy dw dw-delete-3"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">Tidak ada data jabatan.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Jabatan -->
<div id="jabatanModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jabatanModalTitle">Tambah Jabatan</h5>
                <button type="button" class="close" aria-label="Close" onclick="closeJabatanModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="jabatanForm" onsubmit="return false;">
                    <input type="hidden" id="jabatanId" name="id">
                    <div class="form-group">
                        <label for="jabatan">Jabatan <span class="required">*</span></label>
                        <input type="text" class="form-control" id="jabatan" name="name" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeJabatanModal()">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="saveJabatan()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    function openCreateJabatanModal() {
        $('#jabatanId').val('');
        $('#jabatan').val('');
        $('#jabatanModalTitle').text('Tambah Jabatan');
        $('#jabatanModal').modal('show');
    }

    function openEditJabatanModal(id) {
        $.get('/jabatan/edit/' + id, function(data) {
            $('#jabatanId').val(data.id);
            $('#jabatan').val(data.name);
            $('#jabatanModalTitle').text('Edit Jabatan');
            $('#jabatanModal').modal('show');
        });
    }

    function saveJabatan() {
        let formData = $('#jabatanForm').serialize();
        let id = $('#jabatanId').val();
        let url = id ? '/jabatan/update' : '/jabatan/create';

        $.post(url, formData, function() {
            location.reload();
        }).fail(function() {
            alert('Gagal menyimpan data.');
        });
    }

    function deleteJabatan(id) {
        if (confirm('Apakah Anda yakin ingin menghapus jabatan ini?')) {
            window.location.href = '/jabatan/delete/' + id;
        }
    }

    function closeJabatanModal() {
        $('#jabatanModal').modal('hide');
    }
</script>
