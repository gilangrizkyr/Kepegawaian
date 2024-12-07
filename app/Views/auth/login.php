<form action="<?= site_url('/login') ?>" method="post">
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="<?= base_url(); ?>assets/master/vendors/images/login-page-img.png" alt="" />
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Login</h2>
                        </div>
                        <form method="post" action="<?= site_url('auth/login'); ?>">
                            <div class="input-group custom">
                                <input type="text" name="nip" class="form-control form-control-lg" placeholder="NIP" required />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="text" name="name" class="form-control form-control-lg" placeholder="Name" required />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Login">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal untuk Lupa Password -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forgotPasswordModalLabel">Lupa Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/auth/validateForgotPassword" method="post" id="forgotPasswordForm">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Huruf besar dan kecil harus sesuai yang terdaftar" required>
                    </div>
                    <div class=" form-group">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" placeholder="Huruf besar dan kecil harus sesuai yang terdaftar." required>
                    </div>

                    <button type="submit" class="btn btn-primary">Verifikasi</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Reset Password -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetPasswordModalLabel">Reset Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/auth/updatePassword" method="post" id="resetPasswordForm" onsubmit="return validatePassword();">
                    <input type="hidden" id="userId" name="userId">
                    <div class="form-group">
                        <label for="new_password">Password Baru</label>
                        <input type="password" id="new_password" name="new_password" class="form-control" placeholder="********" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Konfirmasi Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="********" required>
                    </div>
                    <p>Ingatlah password yang telah diperbarui!</p>
                    <div class="form-group">
                        <?php if (session()->get('success')): ?>
                            <div class="alert alert-success">
                                <?= session()->get('success') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Ganti Password</button>
                    <button type="button" class="btn btn-secondary" onclick="$('#resetPasswordModal').modal('hide'); $('#forgotPasswordModal').modal('show');">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </button>
                </form>
            </div>

            <script>
                function validatePassword() {
                    const newPassword = document.getElementById('new_password').value;
                    const confirmPassword = document.getElementById('confirm_password').value;

                    if (newPassword !== confirmPassword) {
                        alert("Password baru dan konfirmasi password tidak cocok!");
                        return false;
                    }
                    return true;
                }
            </script>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (session()->getFlashdata('userId')): ?>
            $('#resetPasswordModal').modal('show');
            $('#userId').val('<?= session()->getFlashdata('userId'); ?>');
        <?php endif; ?>
    });
</script>

<?php if (session()->getFlashdata('success')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '<?= session()->getFlashdata('success') ?>',
            confirmButtonText: 'OK'
        });
    </script>
<?php endif; ?>

<?php if (session()->getFlashdata('error_users')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan!',
            text: '<?= session()->getFlashdata('error_users') ?>',
            confirmButtonText: 'OK'
        });
    </script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan!',
            text: '<?= session()->getFlashdata('error') ?>',
            confirmButtonText: 'OK'
        });
    </script>
<?php endif; ?>