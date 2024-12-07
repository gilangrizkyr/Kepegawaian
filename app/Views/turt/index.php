<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="card-box mb-30">
                <div class="pd-20" style="display: flex; justify-content: space-between; align-items: center;">
                    <h4 class="text-blue h4">Daftar Surat</h4>
                    <div>
                        <button class="btn btn-success" data-toggle="modal" data-target="#modalForm" data-action="create">
                            <i class="icon-copy dw dw-add"></i> Tambah Surat
                        </button>
                    </div>
                </div>
                <div class="pb-20">
                    <table id="suratTable" class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">Nomor Surat</th>
                                <th class="datatable-nosort">Kepada</th>
                                <th class="datatable-nosort">Tembusan</th>
                                <th class="datatable-nosort">Tanggal Keluar</th>
                                <th class="datatable-nosort">Perihal</th>
                                <th class="datatable-nosort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($surat)): ?>
                                <?php foreach ($surat as $item): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['nomor_surat']) ?></td>
                                        <td><?= htmlspecialchars($item['kepada']) ?></td>
                                        <td><?= htmlspecialchars($item['tembusan']) ?></td>
                                        <td><?= htmlspecialchars($item['tanggal_keluar']) ?></td>
                                        <td><?= htmlspecialchars($item['perihal']) ?></td>
                                        <td>
                                            <div class="table-actions">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#modalForm"
                                                    data-action="edit"
                                                    data-id="<?= $item['id'] ?>"
                                                    data-nomor_surat="<?= $item['nomor_surat'] ?>"
                                                    data-kepada="<?= $item['kepada'] ?>"
                                                    data-tembusan="<?= $item['tembusan'] ?>"
                                                    data-tanggal_keluar="<?= $item['tanggal_keluar'] ?>"
                                                    data-perihal="<?= $item['perihal'] ?>"
                                                    title="Edit">
                                                    <i class="icon-copy dw dw-edit2"></i>
                                                </a>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#modalForm"
                                                    data-action="delete" data-id="<?= $item['id'] ?>" title="Delete">
                                                    <i class="icon-copy dw dw-delete-3"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">Tidak ada data surat.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Create/Edit -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formSurat" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Tambah Surat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="nomor_surat">Nomor Surat</label>
                        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="<?= $nomor_surat ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kepada">Kepada</label>
                        <input type="text" class="form-control" id="kepada" name="kepada" required>
                    </div>
                    <div class="form-group">
                        <label for="tembusan">Tembusan</label>
                        <input type="text" class="form-control" id="tembusan" name="tembusan" required>
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <input type="text" class="form-control" id="tahun" name="tahun" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_keluar">Tanggal Keluar</label>
                        <input type="date" class="form-control" id="tanggal_keluar" name="tanggal_keluar" required>
                    </div>
                    <div class="form-group">
                        <label for="perihal">Perihal</label>
                        <input type="text" class="form-control" id="perihal" name="perihal" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#modalForm').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var action = button.data('action');

        var modal = $(this);
        modal.find('.modal-title').text(action === 'edit' ? 'Edit Surat' : 'Tambah Surat');

        if (action === 'edit') {
            modal.find('#id').val(button.data('id'));
            modal.find('#nomor_surat').val(button.data('nomor_surat'));
            modal.find('#kepada').val(button.data('kepada'));
            modal.find('#tembusan').val(button.data('tembusan'));
            modal.find('#tanggal_keluar').val(button.data('tanggal_keluar'));
            modal.find('#perihal').val(button.data('perihal'));
            modal.find('#submitBtn').text('Perbarui');
        } else if (action === 'create') {
            modal.find('#formSurat')[0].reset();
            modal.find('#submitBtn').text('Simpan');
        }
    });


    $('#formSurat').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        var action = $('#submitBtn').text().toLowerCase();
        $.ajax({
            url: action === 'simpan' ? '<?= site_url('surat/save') ?>' : '<?= site_url('surat/save') ?>', // method sama untuk simpan dan update
            method: 'POST',
            data: formData,
            success: function(response) {
                alert('Surat berhasil ' + (action === 'simpan' ? 'ditambahkan' : 'diperbarui'));
                location.reload(); // Reload halaman setelah simpan atau update
            }
        });
    });
</script>