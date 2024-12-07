
<!-- =====================  MOBILE MENU OVERLAY  ===================== -->
<div class="mobile-menu-overlay"></div>

<!-- =====================  MAIN CONTAINER  ===================== -->
<div class="main-container">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			<div class="card-box mb-30">
				<div class="pd-20 d-flex justify-content-between align-items-center">
					<h4 class="text-blue h4">Informasi Pegawai</h4>
					<button class="btn btn-success" onclick="openCreateModal()">
						<i class="icon-copy dw dw-add"></i> Tambah
					</button>
				</div>
				<div class="pb-20">
					<table class="data-table table stripe hover nowrap">
						<thead>
							<tr>
								<th>No</th>
								<th class="table-plus datatable-nosort">Nama Lengkap</th>
								<th>NIP</th>
								<th>Jabatan</th>
								<th>Golongan</th>
								<th>Status</th>
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
										<td>
											<?php
											// Cari nama jabatan berdasarkan ID
											$jabatanName = '';
											foreach ($jabatan_options as $jab) {
												if ($jab['id'] == $user['jabatan_terakhir']) {
													$jabatanName = $jab['name'];
													break;
												}
											}
											echo htmlspecialchars($jabatanName);
											?>
										</td>
										<td>
											<?php
											// Cari nama golongan berdasarkan ID
											$golonganName = '';
											foreach ($golongan_options as $gol) {
												if ($gol['id'] == $user['golongan_terakhir']) {
													$golonganName = $gol['name'];
													break;
												}
											}
											echo htmlspecialchars($golonganName);
											?>
										</td>
										<td style="color: <?=
															$user['status'] == 'Aktif' ? 'green' : ($user['status'] == 'Pensiun' ? 'orange' : ($user['status'] == 'Pindah Dinas' ? 'blue' :
																'red')); ?>">
											<?= htmlspecialchars($user['status']) ?>
										</td>
										<td>
											<div class="table-actions">
												<a href="javascript:void(0);" title="Lihat Detail" onclick="openDetailModal(<?= $user['id'] ?>);">
													<i class="icon-copy dw dw-eye"></i>
												</a>
												<a href="javascript:void(0);" title="Edit" onclick="openEditModal(<?= $user['id'] ?>);">
													<i class="icon-copy dw dw-edit2"></i>
												</a>
												<a href="javascript:void(0);" title="Delete" onclick="deleteKaryawan(<?= $user['id'] ?>);">
													<i class="icon-copy dw dw-delete-3"></i>
												</a>
											</div>
										</td>

									</tr>
								<?php endforeach; ?>
							<?php else: ?>
								<tr>
									<td colspan="7" class="text-center">Belum ada data yang terinput</td>
								</tr>
							<?php endif; ?>
						</tbody>

					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- =====================  MODAL FOR DETAIL  ===================== -->
<div id="detailModal" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detail Karyawan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- Data akan diisi melalui JavaScript -->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<!-- =====================  MODAL FOR CREATE/EDIT  ===================== -->
<div id="karyawanModal" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTitle">Tambah/Edit Karyawan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="karyawanForm" method="POST" action="<?= base_url('karyawan/save') ?>" enctype="multipart/form-data">
					<input type="hidden" id="karyawanId" name="id">
					<div class="form-group text-center">
						<img id="previewFoto" src="<?= base_url('public/upload/default.jpg') ?>" alt="Foto Profil"
							style="width: 150px; height: 150px; border-radius: 4px; border: 1px solid #ccc; margin-bottom: 10px;">
						<input type="file" id="foto_profil" name="foto_profil" class="form-control-file" accept="image/*" onchange="previewImage(event)">
					</div>
					<div class="form-group">
						<label for="name">Nama Lengkap <span class="required">*</span></label>
						<input type="text" class="form-control" id="name" name="name" required>
					</div>
					<div class="form-group">
						<label for="nip">NIP <span class="required">*</span></label>
						<input type="text" class="form-control" id="nip" name="nip" required>
					</div>
					<div class="form-group">
						<label for="jenis_kelamin">Jenis Kelamin <span class="required">*</span></label>
						<select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
							<option value="" disabled selected>Pilih Jenis Kelamin</option>
							<option value="Laki-laki">Laki-laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>

					<div class="form-group">
						<label for="pendidikan_terakhir">Pendidikan Terakhir <span class="required">*</span></label>
						<input type="text" class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" required>
						<small class="form-text text-muted">(-) jika tidak mengetahui</small>
					</div>

					<div class="form-group">
						<label for="golongan_terakhir">Golongan Terakhir <span class="required">*</span></label>
						<select name="golongan_terakhir" id="golongan_terakhir" class="form-control" required>
							<option value="" disabled selected>Pilih Golongan Terakhir</option>
							<?php foreach ($golongan_options as $gol): ?>
								<option value="<?= htmlspecialchars($gol['id']); ?>"><?= htmlspecialchars($gol['name']); ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group">
						<label for="jabatan_terakhir">Jabatan Terakhir <span class="required">*</span></label>
						<select name="jabatan_terakhir" id="jabatan_terakhir" class="form-control" required>
							<option value="" disabled selected>Pilih Jabatan Terakhir</option>
							<?php foreach ($jabatan_options as $jab): ?>
								<option value="<?= htmlspecialchars($jab['id']); ?>"><?= htmlspecialchars($jab['name']); ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group">
						<label for="tanggal_masuk">Tanggal Masuk</label>
						<input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk">
					</div>

					<div class="form-group">
						<label for="status">Status <span class="required">*</span></label>
						<select name="status" id="status" class="form-control" required onchange="toggleExitFields()">
							<option value="" disabled selected>Pilih Status</option>
							<option value="Aktif">Aktif</option>
							<option value="Pensiun">Pensiun</option>
							<option value="Pindah Dinas">Pindah Dinas</option>
							<option value="PHK">PHK</option>
						</select>
					</div>

					<div class="form-group" id="exitDateGroup" style="display: none;">
						<label for="tanggal_keluar">Tanggal Keluar</label>
						<input type="date" class="form-control" id="tanggal_keluar" name="tanggal_keluar">
					</div>

					<div class="form-group" id="notesGroup" style="display: none;">
						<label for="keterangan">Keterangan</label>
						<textarea class="form-control" id="keterangan" name="keterangan"></textarea>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Close</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- ===================== FUNGSI FUNGSI COSTUM JS  ===================== -->
<script>
	function previewImage(event) {
		const file = event.target.files[0];
		if (file) {
			const reader = new FileReader();
			reader.onload = function(e) {
				document.getElementById('previewFoto').src = e.target.result;
			};
			reader.readAsDataURL(file);
		}
	}

	function openCreateModal() {
		$('#modalTitle').text('Tambah Karyawan');
		$('#karyawanForm')[0].reset();
		$('#previewFoto').attr('src', '<?= base_url("public/upload/default.jpg") ?>');
		$('#karyawanModal').modal('show');
	}

	function closeModal() {
		$('#karyawanModal').modal('hide');
	}

	function openEditModal(id) {
		$.ajax({
			url: '<?= base_url('karyawan/edit/') ?>' + id,
			method: 'GET',
			success: function(data) {
				const fotoProfil = data.foto_profil ?
					`<?= base_url('public/upload/') ?>${data.foto_profil}` :
					`<?= base_url('public/upload/default.jpg') ?>`;
				$('#previewFoto').attr('src', fotoProfil);
				$('#karyawanId').val(data.id);
				$('#name').val(data.name);
				$('#nip').val(data.nip);
				$('#jenis_kelamin').val(data.jenis_kelamin);
				$('#pendidikan_terakhir').val(data.pendidikan_terakhir);
				$('#golongan_terakhir').val(data.golongan_terakhir);
				$('#jabatan_terakhir').val(data.jabatan_terakhir);
				$('#tanggal_masuk').val(data.tanggal_masuk);
				$('#status').val(data.status);
				$('#tanggal_keluar').val(data.tanggal_keluar);
				$('#keterangan').val(data.keterangan);
				$('#modalTitle').text('Edit Karyawan');
				$('#foto_profil').off('change').on('change', function(event) {
					const file = event.target.files[0];
					if (file) {
						const reader = new FileReader();
						reader.onload = function(e) {
							$('#previewFoto').attr('src', e.target.result);
						};
						reader.readAsDataURL(file);
					}
				});
				$('#karyawanModal').modal('show');
				toggleExitFields();
			},
			error: function() {
				alert('Data tidak ditemukan.');
			}
		});
	}

	// Ini tuh untuk Nampilin gambar secara langsung
	$('#foto_profil').on('change', function(event) {
		const file = event.target.files[0];
		if (file) {
			const reader = new FileReader();
			reader.onload = function(e) {
				$('#currentFoto img').attr('src', e.target.result);
			};
			reader.readAsDataURL(file);
		}
	});

	function deleteKaryawan(id) {
		if (confirm('Apakah Anda yakin ingin menghapus karyawan ini?')) {
			window.location.href = '<?= base_url('karyawan/delete/') ?>' + id;
		}
	}

	function toggleExitFields() {
		const status = $('#status').val();
		if (status === 'Aktif') {
			$('#exitDateGroup').hide();
			$('#notesGroup').hide();
		} else {
			$('#exitDateGroup').show();
			$('#notesGroup').show();
		}
	}

	function openDetailModal(id) {
		$.ajax({
			url: '<?= base_url('karyawan/detail/') ?>' + id,
			method: 'GET',
			success: function(data) {
				// Tampilkan foto profil jika ada
				const fotoProfil = data.foto_profil ? `<?= base_url('public/upload/') ?>${data.foto_profil}` : '<?= base_url('path/to/default/image.jpg') ?>';
				const tanggalKeluar = data.status === 'Aktif' ? 'N/A' : (data.tanggal_keluar || 'N/A');
				const keterangan = data.status === 'Aktif' ? 'N/A' : (data.keterangan || 'N/A');

				$('#detailModal .modal-body').html(`
                <div class="text-center mb-3">
                    <img src="${fotoProfil}" alt="Foto Profil" style="max-width: 150px; height: auto; border: 1px solid #ccc; border-radius: 4px;">
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Nama</th>
                            <td>${data.name}</td>
                        </tr>
                        <tr>
                            <th>NIP</th>
                            <td>${data.nip}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>${data.jenis_kelamin}</td>
                        </tr>
                        <tr>
                            <th>Pendidikan Terakhir</th>
                            <td>${data.pendidikan_terakhir}</td>
                        </tr>
                        <tr>
                            <th>Golongan Terakhir</th>
                            <td>${data.golongan_terakhir}</td>
                        </tr>
                        <tr>
                            <th>Jabatan Terakhir</th>
                            <td>${data.jabatan_terakhir}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Masuk</th>
                            <td>${data.tanggal_masuk}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>${data.status}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Keluar</th>
                            <td>${tanggalKeluar}</td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>${keterangan}</td>
                        </tr>
                    </tbody>
                </table>
            `);
				$('#detailModal').modal('show');
			},
			error: function() {
				alert('Data tidak ditemukan.');
			}
		});
	}
</script>