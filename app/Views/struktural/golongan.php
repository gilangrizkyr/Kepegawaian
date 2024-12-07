<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="card-box mb-30">
                <div class="pd-20" style="display: flex; justify-content: space-between; align-items: center;">
                    <h4 class="text-blue h4">Data Golongan</h4>
                    <div>
                        <button class="btn btn-success" onclick="openCreateGolonganModal()">
                            <i class="icon-copy dw dw-add"></i> Tambah Golongan
                        </button>
                    </div>
                </div>
                <div class="pb-20">
                    <table id="golonganTable" class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">Golongan</th>
                                <th class="datatable-nosort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($golongan)): ?>
                                <?php foreach ($golongan as $item): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['name']) ?></td>
                                        <td>
                                            <div class="table-actions">
                                                <a href="javascript:void(0);" onclick="openEditGolonganModal(<?= $item['id'] ?>);" title="Edit">
                                                    <i class="icon-copy dw dw-edit2"></i>
                                                </a>
                                                <a href="javascript:void(0);" onclick="deleteGolongan(<?= $item['id'] ?>);" title="Delete">
                                                    <i class="icon-copy dw dw-delete-3"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">Tidak ada data.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Golongan -->
<div id="golonganModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="golonganModalTitle">Tambah Golongan</h5>
                <button type="button" class="close" aria-label="Close" onclick="closeGolonganModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="golonganForm" onsubmit="return false;">
                    <input type="hidden" id="golonganId" name="id">
                    <div class="form-group">
                        <label for="golongan">Golongan <span class="required">*</span></label>
                        <input type="text" class="form-control" id="golongan" name="name" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeGolonganModal()">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="saveGolongan()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    function openCreateGolonganModal() {
        $('#golonganId').val('');
        $('#golongan').val('');
        $('#golonganModalTitle').text('Tambah Golongan');
        $('#golonganModal').modal('show');
    }

    function openEditGolonganModal(id) {
        $.get('/golongan/edit/' + id, function(data) {
            $('#golonganId').val(data.id);
            $('#golongan').val(data.name);
            $('#golonganModalTitle').text('Edit Golongan');
            $('#golonganModal').modal('show');
        });
    }

    function saveGolongan() {
        let formData = $('#golonganForm').serialize();
        let id = $('#golonganId').val();
        let url = id ? '/golongan/update' : '/golongan/create';

        $.post(url, formData, function() {
            location.reload();
        }).fail(function() {
            alert('Gagal menyimpan data.');
        });
    }

    function deleteGolongan(id) {
        if (confirm('Apakah Anda yakin ingin menghapus golongan ini?')) {
            window.location.href = '/golongan/delete/' + id;
        }
    }

    function closeGolonganModal() {
        $('#golonganModal').modal('hide');
    }
</script>