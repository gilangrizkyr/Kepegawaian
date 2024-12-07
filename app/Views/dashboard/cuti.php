<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay"></div>

<!-- Main Container -->
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Informasi Cuti Karyawan</h4>
                </div>
                <div class="pb-20">
                    <table class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="table-plus datatable-nosort">Nama Lengkap</th>
                                <th>NIP</th>
                                <!-- <th>Jabatan</th> -->
                                <th>Sisa Cuti</th>
                                <!-- <th>Status Cuti</th> -->
                                <th class="datatable-nosort">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($users)): ?>
								<?php $no = 1; ?>
								<?php foreach ($users as $user): ?>
									<tr>
										<td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($user['name']) ?></td>
                                        <td><?= htmlspecialchars($user['nip']) ?></td>
                                        <!-- <td><?= htmlspecialchars($user['jabatan_terakhir']) ?></td> -->
                                        <td><?= htmlspecialchars($user['sisa_cuti']) ?></td>
                                        <!-- <td>
                                            <?php
                                            $statusCuti = "";
                                            $currentDate = date('Y-m-d');

                                            if ($user['tanggal_mulai_cuti'] <= $currentDate && $user['tanggal_cuti_terakhir'] >= $currentDate) {
                                                $statusCuti = '<span style="background-color: #28a745; color: white; padding: 5px; border-radius: 3px;">Sedang Cuti</span>';
                                            } else {
                                                $statusCuti = '<span style="background-color: #DCDCDC; color: black; padding: 5px; border-radius: 3px;">Tidak Cuti</span>';
                                            }
                                            echo $statusCuti;
                                            ?>
                                        </td> -->
                                        <td>
                                            <button class="btn btn-primary" onclick="openCutiModal(<?= $user['id'] ?>, <?= $user['sisa_cuti'] ?>)">Tambah Cuti</button>
                                            <button class="btn btn-info" onclick="openViewModal(<?= $user['id'] ?>)">View</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">Saat ini belum terdapat data karyawan yang telah diinputkan</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Update Cuti -->
<div id="cutiModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Ubah Data Cuti</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeCutiModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="cutiForm">
                    <input type="hidden" id="karyawanId" name="id">
                    <input type="hidden" id="sisaCuti" name="sisa_cuti">
                    <div class="form-group">
                        <label for="tanggal_mulai_cuti">Tanggal Mulai Cuti <span class="required">*</span></label>
                        <input type="date" class="form-control" id="tanggal_mulai_cuti" name="tanggal_mulai_cuti" required onchange="calculateDays()">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_cuti_terakhir">Tanggal Akhir Cuti <span class="required">*</span></label>
                        <input type="date" class="form-control" id="tanggal_cuti_terakhir" name="tanggal_cuti_terakhir" required onchange="calculateDays()">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_hari_cuti">Jumlah Hari Cuti</label>
                        <input type="text" class="form-control" id="jumlah_hari_cuti" name="jumlah_hari_cuti" readonly>
                    </div>
                    <div class="alert alert-danger" id="cutiAlert" style="display:none;">Jumlah Cuti tidak cukup</div>
                    <div class="form-group">
                        <label for="keterangan_cuti">keterangan</label>
                        <textarea class="form-control" id="keterangan_cuti" name="keterangan_cuti" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeCutiModal()">Tutup</button>
                <button type="submit" class="btn btn-primary" form="cutiForm">Simpan</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal for View Cuti History -->
<div id="viewCutiModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Histori Cuti Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeViewCutiModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Akhir</th>
                            <th>keterangan</th>
                        </tr>
                    </thead>
                    <tbody id="cutiHistoryBody">
                        <!-- Data histori cuti akan dimasukkan di sini -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeViewCutiModal()">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    function openCutiModal(id, sisaCuti) {
        document.getElementById('cutiForm').reset();
        document.getElementById('karyawanId').value = id;
        document.getElementById('sisaCuti').value = sisaCuti;
        document.getElementById('modalTitle').innerText = 'Ubah Data Cuti';
        document.getElementById('cutiAlert').style.display = 'none';
        $('#cutiModal').modal('show');
    }

    function closeCutiModal() {
        $('#cutiModal').modal('hide');
    }

    function openViewModal(id) {
        fetch(`<?= base_url('cuti/view') ?>/${id}`)
            .then(response => response.json())
            .then(data => {
                const cutiHistoryBody = document.getElementById('cutiHistoryBody');
                cutiHistoryBody.innerHTML = '';

                if (data.error) {
                    alert(data.error);
                    return;
                }

                if (!data.histori_cuti || data.histori_cuti.length === 0) {
                    cutiHistoryBody.innerHTML = `
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada histori cuti untuk karyawan ini.</td>
                        </tr>
                    `;
                } else {
                    data.histori_cuti.forEach(cuti => {
                        cutiHistoryBody.innerHTML += `
                            <tr>
                                <td>${cuti.tanggal_mulai}</td>
                                <td>${cuti.tanggal_akhir}</td>
                                <td>${cuti.keterangan}</td>
                            </tr>
                        `;
                    });
                }

                $('#viewCutiModal').modal('show');
            })
            .catch(error => console.error('Error:', error));
    }

    function closeViewCutiModal() {
        $('#viewCutiModal').modal('hide');
    }

    function calculateDays() {
        const startDate = new Date(document.getElementById('tanggal_mulai_cuti').value);
        const endDate = new Date(document.getElementById('tanggal_cuti_terakhir').value);
        const sisaCuti = parseInt(document.getElementById('sisaCuti').value, 10) || 0;

        if (startDate && endDate) {
            if (startDate > endDate) {
                document.getElementById('jumlah_hari_cuti').value = "Tanggal akhir harus setelah tanggal mulai";
                document.getElementById('cutiAlert').style.display = 'none';
                return;
            }

            let validDays = 0;
            for (let d = startDate; d <= endDate; d.setDate(d.getDate() + 1)) {
                const day = d.getDay();
                if (day !== 0 && day !== 6) {
                    validDays++;
                }
            }

            document.getElementById('jumlah_hari_cuti').value = validDays;

            if (validDays > sisaCuti) {
                document.getElementById('cutiAlert').style.display = 'block';
            } else {
                document.getElementById('cutiAlert').style.display = 'none';
            }
        } else {
            document.getElementById('jumlah_hari_cuti').value = '';
            document.getElementById('cutiAlert').style.display = 'none';
        }
    }


    document.getElementById('cutiForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        fetch(`<?= base_url('cuti/update') ?>`, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    closeCutiModal();
                    location.reload();
                } else {
                    alert('Gagal menyimpan data cuti: ' + data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan data cuti.');
            });
    });
</script>

<?php if (session()->getFlashdata('success')): ?>
    <script>
        alert('<?= session()->getFlashdata('success') ?>');
    </script>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <script>
        alert('<?= session()->getFlashdata('error') ?>');
    </script>
<?php endif; ?>