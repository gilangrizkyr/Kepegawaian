<form action="<?= site_url('auth/store'); ?>" method="post">
<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 col-lg-7">
                <img src="<?= base_url(); ?>assets/master/vendors/images/login-page-img.png" alt="" />
            </div>
            <div class="col-md-6 col-lg-5">
                <div class="login-box bg-white box-shadow border-radius-10">
                    <div class="login-title">
                        <h2 class="text-center text-primary">Register</h2>
                    </div>
                        <div class="input-group custom">
                            <input
                                type="text"
                                name="name"
                                class="form-control form-control-lg"
                                placeholder="Nama Lengkap"
                                value="<?= old('name'); ?>" required />
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                            </div>
                        </div>
                        <div class="input-group custom">
                            <input
                                type="text"
                                name="nip"
                                class="form-control form-control-lg"
                                placeholder="Nomor Identitas Pegawai"
                                value="<?= old('nip'); ?>" required />
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                            </div>
                        </div>
                        <div class="input-group custom">
                            <input
                                type="text"
                                name="username"
                                class="form-control form-control-lg"
                                placeholder="Username"
                                value="<?= old('username'); ?>" required />
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                            </div>
                        </div>
                        <div class="input-group custom">
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control form-control-lg"
                                placeholder="Password" required />
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                            </div>
                        </div>
                        <div class="input-group custom">
                            <input
                                type="password"
                                name="confirm_password"
                                id="confirm_password"
                                class="form-control form-control-lg"
                                placeholder="Confirm Password" required />
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                            </div>
                        </div>
                        <div class="input-group custom">
                            <select name="jenis_kelamin" class="form-control form-control-lg" required>
                                <option value="" disabled selected>Jenis Kelamin</option>
                                <?php foreach ($jenis_kelamin as $jk): ?>
                                    <option value="<?= htmlspecialchars($jk) ?>"><?= htmlspecialchars($jk) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>



                        <div class="input-group custom">
                            <input
                                type="text"
                                name="jabatan"
                                class="form-control form-control-lg"
                                placeholder="Jabatan" required />
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group mb-0">
                                    <input
                                        class="btn btn-primary btn-lg btn-block"
                                        type="submit"
                                        value="Daftar Akun"
                                        onclick="return validatePasswords();" />
                                </div>
                                <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">
                                    ATAU
                                </div>
                                <div class="input-group mb-0">
                                    <a
                                        class="btn btn-outline-primary btn-lg btn-block"
                                        href="<?= site_url('/'); ?>">Sudah punya akun silahkan Login</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function validatePasswords() {
        var password = document.getElementById("password").value;
        var confirm_password = document.getElementById("confirm_password").value;
        if (password !== confirm_password) {
            document.getElementById("error-message").innerText = "Password tidak cocok!";
            document.getElementById("error-message").style.display = "block";
            return false; 
        }
        return true;
    }
</script>


<script>
    function validatePasswords() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        const errorMessage = document.getElementById('error-message');

        if (password !== confirmPassword) {
            errorMessage.textContent = "Password Tidak sesuai";
            errorMessage.style.display = "block";

            setTimeout(() => {
                errorMessage.style.display = "none";
            }, 3000);

            return false;
        } else {
            errorMessage.style.display = "none";
            return true;
        }
    }
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
<?php if (session()->getFlashdata('error')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '<?= session()->getFlashdata('error') ?>',
            confirmButtonText: 'OK'
        });
    </script>
<?php endif; ?>