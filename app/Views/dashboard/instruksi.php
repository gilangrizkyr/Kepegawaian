<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="card-box mb-30">
                <div class="pd-20" style="display: flex; justify-content: space-between; align-items: center;">
                    <h4 class="text-blue h4">Informasi Instruksi Pimpinan</h4>
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
                    <table id="instruksiTable" class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">Agenda</th>
                                <th>Keterangan</th>
                                <th>Tanggal Instruksi</th>
                                <th class="datatable-nosort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($instruksi)): ?>
                                <?php foreach ($instruksi as $item): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['name']) ?></td>
                                        <td><?= nl2br(htmlspecialchars($item['keterangan'])) ?></td>
                                        <td><?= htmlspecialchars($item['tanggal_acara']) ?></td>
                                        <td>
                                            <div class="table-actions" style="display: flex; gap: 10px;">
                                                <a href="javascript:void(0);" title="Edit" onclick="openEditModal(<?= $item['id'] ?>);" style="color: #007bff; text-decoration: none;">
                                                    <i class="icon-copy dw dw-edit2" style="font-size: 20px;"></i>
                                                </a>
                                                <a href="javascript:void(0);" title="Delete" onclick="deleteInstruksi(<?= $item['id'] ?>);" style="color: #dc3545; text-decoration: none;">
                                                    <i class="icon-copy dw dw-delete-3" style="font-size: 20px;"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4">Saat ini belum terdapat data instruksi yang telah diinputkan</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Instruksi -->
<div id="instruksiModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Instruksi</h5>
                <button type="button" class="close" aria-label="Close" onclick="closeModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="instruksiForm">
                    <input type="hidden" id="instruksiId" name="id">
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
                <button type="button" class="btn btn-primary" onclick="saveInstruksi()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#instruksiTable').DataTable();
    });

    function printTable() {
        const rows = document.querySelectorAll('#instruksiTable tbody tr');
        if (rows.length === 0) {
            alert('Tidak ada data untuk dicetak');
            return;
        }

        let printContent = `<div style="text-align: center;">
            <img src="assets/master/vendors/images/ptptk1.png" alt="Logo Perusahaan" style="max-width: 100px; margin-bottom: 20px;"/>
            <h2>Laporan Instruksi Pimpinan</h2>
            <h4>Tanggal: ${new Date().toLocaleDateString()}</h4>
        </div>
        <table border="1" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <tr>
                <th>No</th>
                <th>Nama Instruksi</th>
                <th>Keterangan</th>
                <th>Tanggal Instruksi</th>
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
        const rows = document.querySelectorAll('#instruksiTable tr');
        let csvContent = "data:text/csv;charset=utf-8,";

        const header = Array.from(rows[0].querySelectorAll('th')).map(th => {
            return `"${th.innerText.replace(/"/g, '""')}"`;
        }).join(',');
        csvContent += header + "\r\n";

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
        link.setAttribute('download', 'laporan_instruksi.csv');
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function openCreateModal() {
        document.getElementById('instruksiForm').reset();
        document.getElementById('instruksiId').value = '';
        document.getElementById('modalTitle').innerText = 'Tambah Instruksi';
        $('#instruksiModal').modal('show');
    }

    function openEditModal(id) {
        fetch(`<?= base_url('instruksi/edit') ?>/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('instruksiId').value = data.id;
                document.getElementById('name').value = data.name;
                document.getElementById('keterangan').value = data.keterangan;
                document.getElementById('tanggal_acara').value = data.tanggal_acara;
                document.getElementById('modalTitle').innerText = 'Edit Instruksi';
                $('#instruksiModal').modal('show');
            })
            .catch(error => console.error('Error:', error));
    }

    function saveInstruksi() {
        const form = document.getElementById('instruksiForm');
        const formData = new FormData(form);
        const url = document.getElementById('instruksiId').value ?
            `<?= base_url('instruksi/update') ?>/${document.getElementById('instruksiId').value}` :
            `<?= base_url('instruksi/create') ?>`;

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

    function deleteInstruksi(id) {
        if (confirm('Apakah Anda yakin ingin menghapus instruksi ini?')) {
            fetch(`<?= base_url('instruksi/delete') ?>/${id}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        location.reload();
                    } else {
                        alert('Gagal menghapus instruksi.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }

    function closeModal() {
        $('#instruksiModal').modal('hide');
    }
</script>