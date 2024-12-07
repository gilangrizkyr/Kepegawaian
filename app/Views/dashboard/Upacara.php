<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="card-box mb-30">
                <div class="pd-20" style="display: flex; justify-content: space-between; align-items: center;">
                    <h4 class="text-blue h4">Informasi upacara</h4>
                    <div>
                        <button class="btn btn-success" onclick="openCreateModal()">
                            <i class="icon-copy dw dw-add"></i> Tambah
                        </button>
                        <button class="btn btn-info" onclick="printTable()" title="Cetak">
                            <i class="icon-copy dw dw-print"></i>
                        </button>
                        <button class="btn btn-primary" onclick="downloadTableAsCSV()" title="Unduh CSV">
                            <i class="icon-copy dw dw-download"></i>
                        </button>
                    </div>
                </div>
                <div class="pb-20">
                    <table id="upacaraTable" class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">Agenda</th>
                                <th>Keterangan</th>
                                <th>Tanggal upacara</th>
                                <th class="datatable-nosort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($upacara)): ?>
                                <?php foreach ($upacara as $item): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['name']) ?></td>
                                        <td><?= nl2br(htmlspecialchars($item['keterangan'])) ?></td>
                                        <td><?= htmlspecialchars($item['tanggal_acara']) ?></td>
                                        <td>
                                            <div class="table-actions" style="display: flex; gap: 10px;">
                                                <a href="javascript:void(0);" title="Edit" onclick="openEditModal(<?= $item['id'] ?>);" style="color: #007bff; text-decoration: none;">
                                                    <i class="icon-copy dw dw-edit2" style="font-size: 20px;"></i>
                                                </a>
                                                <a href="javascript:void(0);" title="Delete" onclick="deleteUpacara(<?= $item['id'] ?>);" style="color: #dc3545; text-decoration: none;">
                                                    <i class="icon-copy dw dw-delete-3" style="font-size: 20px;"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4">Saat ini belum terdapat data upacara yang telah diinputkan</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Upacara -->
<div id="upacaraModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah upacara</h5>
                <button type="button" class="close" aria-label="Close" onclick="closeModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="upacaraForm">
                    <input type="hidden" id="upacaraId" name="id">
                    <div class="form-group">
                        <label for="name">Agenda <span class="required">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan <span class="required">*</span></label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_acara">Tanggal Acara <span class="required">*</span></label>
                        <input type="date" class="form-control" id="tanggal_acara" name="tanggal_acara" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="saveUpacara()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#upacaraTable').DataTable();
    });

    function printTable() {
        const rows = document.querySelectorAll('#upacaraTable tbody tr');
        if (rows.length === 0) {
            alert('Tidak ada data untuk dicetak');
            return;
        }

        let printContent = `<div style="text-align: center;">
            <img src="assets/master/vendors/images/ptptk1.png" alt="Logo Perusahaan" style="max-width: 100px; margin-bottom: 20px;"/>
            <h2>Laporan upacara Kepegawaian</h2>
            <h4>Tanggal: ${new Date().toLocaleDateString()}</h4>
        </div>
        <table border="1" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <tr>
                <th>No</th>
                <th>Nama upacara</th>
                <th>Keterangan</th>
                <th>Tanggal upacara</th>
            </tr>`;

        rows.forEach((row, rowIndex) => {
            const cols = row.querySelectorAll('td');
            const no = rowIndex + 1;
            const name = cols[0].innerText;
            const keterangan = cols[1].innerText.replace(/\n/g, '<br>');
            const tanggal = cols[2].innerText;
            printContent += `<tr><td>${no}</td><td>${name}</td><td>${keterangan}</td><td>${tanggal}</td></tr>`;
        });

        printContent += '</table>';
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Print Laporan</title>');
        printWindow.document.write('<style>table { border-collapse: collapse; } th, td { padding: 8px; text-align: left; border: 1px solid #000; }</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(printContent);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.onload = function() {
            printWindow.print();
        };
    }

    function downloadTableAsCSV() {
        const rows = document.querySelectorAll('#upacaraTable tr');
        let csvContent = "data:text/csv;charset=utf-8,";

        const header = Array.from(rows[0].querySelectorAll('th')).map(th => {
            return `"${th.innerText.replace(/"/g, '""')}"`;
        }).join(',');
        csvContent += header + "\r\n";

        // Menambahkan data
        rows.forEach((row, rowIndex) => {
            if (rowIndex === 0) return; // Lewati header
            const cols = row.querySelectorAll('td');
            const rowData = Array.from(cols).map(col => {
                let cellText = col.innerText.replace(/"/g, '""'); // Escape tanda kutip ganda
                cellText = cellText.replace(/\n/g, '\r\n'); // Ganti newline dengan newline yang valid untuk CSV
                return `"${cellText}"`; // Bungkus dengan tanda kutip
            }).join(',');

            csvContent += rowData + "\r\n"; // Tambahkan baris baru
        });

        const encodedUri = encodeURI(csvContent);
        const link = document.createElement('a');
        link.setAttribute('href', encodedUri);
        link.setAttribute('download', 'laporan_upacara.csv');
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function openCreateModal() {
        document.getElementById('upacaraForm').reset();
        document.getElementById('upacaraId').value = '';
        document.getElementById('modalTitle').innerText = 'Tambah upacara';
        $('#upacaraModal').modal('show');
    }

    function openEditModal(id) {
        fetch(`<?= base_url('upacara/edit') ?>/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('upacaraId').value = data.id;
                document.getElementById('name').value = data.name;
                document.getElementById('keterangan').value = data.keterangan;
                document.getElementById('tanggal_acara').value = data.tanggal_acara;
                document.getElementById('modalTitle').innerText = 'Edit upacara';
                $('#upacaraModal').modal('show');
            })
            .catch(error => console.error('Error:', error));
    }

    function saveUpacara() {
        const form = document.getElementById('upacaraForm');
        const formData = new FormData(form);
        const url = document.getElementById('upacaraId').value ?
            `<?= base_url('upacara/update') ?>/${document.getElementById('upacaraId').value}` :
            `<?= base_url('upacara/create') ?>`;

        fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    closeModal();
                    location.reload();
                } else {
                    alert('Error: ' + JSON.stringify(data.errors));
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function deleteUpacara(id) {
        if (confirm('Apakah Anda yakin ingin menghapus upacara ini?')) {
            fetch(`<?= base_url('upacara/delete') ?>/${id}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        location.reload();
                    } else {
                        alert('Gagal menghapus upacara.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }

    function closeModal() {
        $('#upacaraModal').modal('hide');
    }
</script>