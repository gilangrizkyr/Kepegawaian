<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title><?= $title; ?></title>


    <!-- Site favicon -->
    <link
        rel="apple-touch-icon"
        sizes="180x180"
        href="<?= base_url(); ?>assets/master/vendors/images/ptptk1.png" />
    <link
        rel="icon"
        type="image/png"
        sizes="32x32"
        href="<?= base_url(); ?>assets/master/vendors/images/ptptk1.png" />
    <link
        rel="icon"
        type="image/png"
        sizes="16x16"
        href="<?= base_url(); ?>assets/master/vendors/images/ptptk1.png" />

    <!-- Mobile Specific Metas -->
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/master/vendors/styles/core.css" />
    <link
        rel="stylesheet"
        type="text/css"
        href="<?= base_url(); ?>assets/master/vendors/styles/icon-font.min.css" />
    <link
        rel="stylesheet"
        type="text/css"
        href="<?= base_url(); ?>assets/master/src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
    <link
        rel="stylesheet"
        type="text/css"
        href="<?= base_url(); ?>assets/master/src/plugins/datatables/css/responsive.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/master/vendors/styles/style.css" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script
        async
        src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
    <script
        async
        src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258"
        crossorigin="anonymous"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-GBZ3SGGX85");
    </script>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                "gtm.start": new Date().getTime(),
                event: "gtm.js"
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != "dataLayer" ? "&l=" + l : "";
            j.async = true;
            j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, "script", "dataLayer", "GTM-NXZMQSS");
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- End Google Tag Manager -->
    <script src="<?= base_url('auth/app.js') ?>"></script>
    <div class="header">
        <div class="header-left">
            <div class="menu-icon bi bi-list"></div>

        </div>
        <div class="header-right">

            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a
                        class="dropdown-toggle"
                        href="#"
                        role="button"
                        data-toggle="dropdown">
                        <span class="user-name"><?= session()->get('name') ?: 'Guest' ?></span>
                    </a>
                    <div
                        class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item" data-toggle="modal" data-target="#faqModal"><i class="icon-copy dw dw-chat-21"></i> FAQ</a>
                        <a class="dropdown-item" data-toggle="right-sidebar"><i class="dw dw-user1"></i>Edit Tampilan</a>
                        <!-- <a class="dropdown-item" href="<?= base_url('/faq'); ?>"><i class="icon-copy dw dw-chat-21"></i></i>FAQ</a> -->
                        <form action="<?= base_url('auth/logout') ?>" method="post" style="display:inline;">
                            <button type="submit" class="dropdown-item"><i class="dw dw-logout"></i> Log Out</button>
                        </form>

                    </div>
                </div>
            </div>
            <!-- <div class="dashboard-setting user-notification">
                <div class="dropdown">
                    <a
                        class="dropdown-toggle no-arrow"
                        href="javascript:;"
                        data-toggle="right-sidebar">
                        <i class="dw dw-settings2"></i>
                    </a>
                </div>
            </div> -->
        </div>
    </div>

    <!-- Modal FAQ -->
    <div class="modal fade" id="faqModal" tabindex="-1" role="dialog" aria-labelledby="faqModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="faqModalLabel">FAQ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="accordion" id="faqAccordion">
                        <!-- FAQ Item 1 -->
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Apa itu FAQ dan kenapa harus membaca FAQ?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#faqAccordion">
                                <div class="card-body">
                                    "FAQ (Frequently Asked Questions) adalah bagian yang berisi kumpulan pertanyaan yang sering
                                    diajukan beserta jawabannya. Membaca FAQ dapat membantu Anda menemukan solusi atas pertanyaan
                                    umum seputar aplikasi ini, sehingga Anda tidak perlu menghubungi tim pengelola aplikasi."
                                </div>
                            </div>
                        </div>
                        <!-- <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        Apa perbedaan HrprogresAPI & HrprogresNonAPI?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#faqAccordion">
                                <div class="card-body">
                                    <strong>HrprogresAPI</strong>
                                    <br>
                                    1. Tersedia fitur token untuk akun yang selalu diperbarui setiap kali digunakan.
                                    <br>
                                    2. Menyediakan pemberitahuan responsif apabila tidak ada interaksi dari pengguna dalam aplikasi untuk jangka waktu tertentu.
                                    <br>
                                    3. Memerlukan penyesuaian pada transisi antara sistem lokal dan server.
                                    <br>
                                    4. Fitur autentikasi menggunakan token sudah diterapkan untuk meningkatkan keamanan.
                                    <br><br>

                                    <strong>HrprogresNonAPI</strong>
                                    <br>
                                    1. Belum ada fitur token yang diperbarui secara otomatis setiap kali penggunaannya.
                                    <br>
                                    2. Belum dilengkapi dengan pemberitahuan responsif terkait kurangnya interaksi dari pengguna dalam aplikasi.
                                    <br>
                                    3. Dipastikan berjalan dengan normal tanpa adanya kendala yang diketahui.
                                    <br><br>

                                    <hr>
                                    <p>Database pengguna untuk HrprogresAPI dan HrprogresNonAPI adalah terpisah dan berbeda.</p>
                                </div>
                            </div>
                        </div> -->

                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Bagaimana cara mengubah deskripsi?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqAccordion">
                                <div class="card-body">
                                    1. Pilih menu "Edit Deskripsi", lalu masukkan deskripsi baru yang Anda inginkan.
                                    <br>
                                    2. Tampilan akan diperbarui secara otomatis sesuai dengan deskripsi yang Anda masukkan.
                                    <br>
                                    3. Klik tombol "Simpan" untuk menyimpan perubahan yang telah Anda buat.
                                    <br>
                                    4. Jika Anda ingin mengubah deskripsi lagi, pilih menu "Edit Deskripsi" dan ulangi langkah-langkah tersebut.
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Bagaimana cara mendaftarkan akun baru?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqAccordion">
                                <div class="card-body">
                                    Fitur untuk pembuatan akun baru hanya dapat diakses oleh pemegang akun khusus yang memiliki akses untuk itu.
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingFour">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Perbaikan atau Penambahan Fitur
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#faqAccordion">
                                <div class="card-body">
                                    Jika Anda membutuhkan perbaikan aplikasi atau ingin mengajukan penambahan fitur baru, Anda dapat menghubungi kami melalui nomor kontak +6289694156005 atau mengirimkan email ke ikyappmastering@gmail.com.
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="right-sidebar">
        <div class="sidebar-title">
            <h3 class="weight-600 font-16 text-blue">
                Layout Settings
                <span class="btn-block font-weight-400 font-12">User Interface Settings</span>
            </h3>
            <div class="close-sidebar" data-toggle="right-sidebar-close">
                <i class="icon-copy ion-close-round"></i>
            </div>
        </div>
        <div class="right-sidebar-body customscroll">
            <div class="right-sidebar-body-content">
                <h4 class="weight-600 font-18 pb-10">Header Background</h4>
                <div class="sidebar-btn-group pb-30 mb-10">
                    <a
                        href="javascript:void(0);"
                        class="btn btn-outline-primary header-white active">White</a>
                    <a
                        href="javascript:void(0);"
                        class="btn btn-outline-primary header-dark">Dark</a>
                </div>

                <h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
                <div class="sidebar-btn-group pb-30 mb-10">
                    <a
                        href="javascript:void(0);"
                        class="btn btn-outline-primary sidebar-light">White</a>
                    <a
                        href="javascript:void(0);"
                        class="btn btn-outline-primary sidebar-dark active">Dark</a>
                </div>

                <h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
                <div class="sidebar-radio-group pb-10 mb-10">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input
                            type="radio"
                            id="sidebaricon-1"
                            name="menu-dropdown-icon"
                            class="custom-control-input"
                            value="icon-style-1"
                            checked="" />
                        <label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input
                            type="radio"
                            id="sidebaricon-2"
                            name="menu-dropdown-icon"
                            class="custom-control-input"
                            value="icon-style-2" />
                        <label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input
                            type="radio"
                            id="sidebaricon-3"
                            name="menu-dropdown-icon"
                            class="custom-control-input"
                            value="icon-style-3" />
                        <label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
                    </div>
                </div>

                <h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
                <div class="sidebar-radio-group pb-30 mb-10">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input
                            type="radio"
                            id="sidebariconlist-1"
                            name="menu-list-icon"
                            class="custom-control-input"
                            value="icon-list-style-1"
                            checked="" />
                        <label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input
                            type="radio"
                            id="sidebariconlist-2"
                            name="menu-list-icon"
                            class="custom-control-input"
                            value="icon-list-style-2" />
                        <label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input
                            type="radio"
                            id="sidebariconlist-3"
                            name="menu-list-icon"
                            class="custom-control-input"
                            value="icon-list-style-3" />
                        <label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input
                            type="radio"
                            id="sidebariconlist-4"
                            name="menu-list-icon"
                            class="custom-control-input"
                            value="icon-list-style-4"
                            checked="" />
                        <label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input
                            type="radio"
                            id="sidebariconlist-5"
                            name="menu-list-icon"
                            class="custom-control-input"
                            value="icon-list-style-5" />
                        <label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input
                            type="radio"
                            id="sidebariconlist-6"
                            name="menu-list-icon"
                            class="custom-control-input"
                            value="icon-list-style-6" />
                        <label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
                    </div>
                </div>

                <div class="reset-options pt-30 text-center">
                    <button class="btn btn-danger" id="reset-settings">
                        Reset Settings
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- <script>
        inactivityTime();
    </script> -->