<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Absensi | Barcode</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/gi.png">
    <link href="<?= base_url(); ?>assets/plugins/animate/animate.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets/css/bootstrap-material-design.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Absensi Barcode V2</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item">
    <span class="nav-link">Safety</span>
</li>
<li class="nav-item">
    <span class="nav-link">Fast</span>
</li>
<li class="nav-item">
    <span class="nav-link">Accurate</span>
</li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="col-md-12 text-center mb-3">
        <h2>Welcome To Attendance System Barcode V2</h2>
    </div>

    <div class="wrapper-page">
        <div class="display-table">
            <div class="display-table-cell">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center pt-3">
                                        <img src="<?= base_url(); ?>assets/images/logo.png" alt="Logo" height="150">
                                    </div>
                                    <?php if (isset($message) && !empty($message)) : ?>
                                        <div class="alert alert-dismissible fade show mt-3 <?= $message_type == 'success' ? 'alert-primary' : 'alert-danger'; ?>" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <strong><?= $message_type == 'success' ? 'Well done!' : 'Oh snap!'; ?></strong> <?php echo $message; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="px-3 pb-3">
                                        <form id="absensiForm" action="<?php echo site_url('absensi/absen'); ?>" method="post" onsubmit="return validateForm();">
                                            <div class="form-group">
                                                <label for="action">Pilih Tindakan:</label>
                                                <select class="form-control" id="action" name="action" required>
                                                    <option value="masuk">Absen Masuk</option>
                                                    <option value="keluar">Absen Keluar</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nisn">nisn:</label>
                                                <input type="text" class="form-control" name="nisn" id="nisn" required style="color: black;">
                                            </div>
                                            <input type="hidden" name="id_devices" value="1">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap-material-design.js"></script>
    <script src="<?= base_url(); ?>assets/js/modernizr.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/detect.js"></script>
    <script src="<?= base_url(); ?>assets/js/fastclick.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.slimscroll.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.blockUI.js"></script>
    <script src="<?= base_url(); ?>assets/js/waves.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.nicescroll.js"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.scrollTo.min.js"></script>

<script>
        // Menyimpan nilai nisn sebelum refresh
        var nisnInput = document.getElementById("nisn");
        var nisnValue = nisnInput.value;

        // Menjalankan fungsi untuk mengembalikan fokus ke input nisn setelah halaman dimuat kembali
        window.onload = function() {
            nisnInput.value = nisnValue; // Mengembalikan nilai nisn yang tersimpan
            nisnInput.focus(); // Mengembalikan fokus ke input nisn
        };

        // Mendengarkan acara penekanan tombol pada input nisn
        nisnInput.addEventListener("keypress", function(event) {
            if (event.keyCode === 13) { // Jika tombol Enter ditekan
                event.preventDefault(); // Mencegah perilaku default dari tombol Enter
                submitForm(); // Menjalankan fungsi untuk mengirim formulir
            }
        });

        // Fungsi untuk mengirimkan formulir
        function submitForm() {
            document.getElementById("absensiForm").submit();
        }

        // Mengambil elemen action select
        const actionSelect = document.getElementById("action");

        // Fungsi untuk memperbarui opsi tindakan berdasarkan waktu
        function updateTime() {
            const now = new Date();
            const hour = now.getHours();

            // Perbarui opsi tindakan berdasarkan waktu
            if (hour >= 12) {
                actionSelect.selectedIndex = 1; // Pilih opsi "Absen Keluar" ketika jam sudah melewati 12 siang
            }
        }

        // Perbarui waktu saat halaman dimuat
        updateTime();

        // Cegah pengiriman formulir jika waktu tidak valid
        nisnInput.addEventListener("keypress", (event) => {
            const hour = new Date().getHours();
            if (hour < 6 || hour >= 24) {
                event.preventDefault();
                alert("Waktu tidak sesuai untuk absensi!");
            }
        });
    </script></body>

</html>
