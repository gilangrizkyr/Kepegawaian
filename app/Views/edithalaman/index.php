<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>
<div class="mobile-menu-overlay"></div>
<div class="main-container">
    <div class="pd-ltr-20">
        <div class="form-group">
            <label for="deskripsi">Edit Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
            <input type="hidden" id="deskripsiId" name="deskripsiId" value="<?= isset($deskripsi['id']) ? esc($deskripsi['id']) : ''; ?>">
            <small>Apapun yang tersimpan disini otomatis deskripsi tampilan halaman awal akan mengikuti</small>
            </div>
            <button type="button" class="btn btn-primary" id="saveBtn">Simpan</button>
        </div>
    </div>

    <script>
        let editor;
        ClassicEditor.create(document.querySelector('#deskripsi'))
            .then(newEditor => {
                editor = newEditor;
                <?php if (isset($deskripsi['deskripsi'])): ?>
                editor.setData('<?= $deskripsi['deskripsi']; ?>');
            <?php endif; ?>
        })
        .catch(error => {
            console.error(error);
        });
    $('#saveBtn').on('click', function() {
        let id = $('#deskripsiId').val();
        let deskripsi = editor.getData();
        $.ajax({
            url: '/deskripsi/save',
            type: 'POST',
            data: {
                id: id,
                deskripsi: deskripsi
            },
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("Terjadi kesalahan. Silakan coba lagi.");
            }
        });
    });
</script>