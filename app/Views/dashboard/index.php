<div class="mobile-menu-overlay"></div>
<div class="main-container ">
    <div class="pd-ltr-20">
        <div class="card-box pd-20 height-100-p mb-30">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <img src="<?= base_url(); ?>assets/master/vendors/images/banner-img.png" alt="" />
                </div>
                <div class="col-md-8">
                    <h4 class="font-20 weight-500 mb-10 text-capitalize" id="welcome-message"></h4>
                    <script>
                        const welcomeText = "Selamat Datang!";
                        const welcomeElement = document.getElementById('welcome-message');
                        let index = 0;
                        let isReversing = false;

                        function type() {
                            if (!isReversing) {
                                if (index < welcomeText.length) {
                                    welcomeElement.innerHTML += welcomeText.charAt(index);
                                    index++;
                                    setTimeout(type, 100);
                                } else {
                                    setTimeout(reverse, 1000);
                                }
                            }
                        }

                        function reverse() {
                            isReversing = true;
                            let reverseIndex = welcomeText.length - 1;

                            function reverseTyping() {
                                if (reverseIndex > 0) {
                                    welcomeElement.innerHTML = welcomeElement.innerHTML.slice(0, reverseIndex);
                                    reverseIndex--;
                                    setTimeout(reverseTyping, 100);
                                } else {
                                    setTimeout(reset);
                                }
                            }
                            reverseTyping();
                        }

                        function reset() {
                            welcomeElement.innerHTML = "s";
                            index = 0;
                            isReversing = false;
                            setTimeout(() => {
                                welcomeElement.innerHTML = "";
                                type();
                            }, 0);
                        }
                        type();
                    </script>
                    <div class="weight-600 font-30 text-blue"><?= session()->get('name') ?: 'Guest' ?></div>
                    </h4>
                    <p class="font-17 max-width-600">
                        <?= isset($deskripsi['deskripsi']) ? $deskripsi['deskripsi'] : 'Tidak ada deskripsi.'; ?>
                    </p>
                </div>
            </div>
        </div>
    
     