<?php


 
  

  $jmlrfid = 0;
  $jmlalat = 0;
  $jmlmasuk = 0;
  $jmlkeluar = 0;

  $jumlah_tidak_absensi = 0; // Ini adalah contoh inisialisasi variabel

  if (isset($rfid)) {
    foreach ($rfid as $key => $value) {
      $jmlrfid++;
    }
  }
 

  if (isset($devices)) {
    foreach ($devices as $key => $value) {
      $jmlalat++;
    }
  }

  if (isset($masuk)) {
    foreach ($masuk as $key => $value) {
      $jmlmasuk++;
    }
  }

  if (isset($keluar)) {
    foreach ($keluar as $key => $value) {
      $jmlkeluar++;
    }
  }

if($this->session->userdata('userlogin'))     // mencegah akses langsung tanpa login
{ 
  $users = $this->session->userdata('userlogin');
  $avatar = $this->session->userdata('avatar');
}else{
  //masuk tanpa login
  $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> ANDA MENGGUNAKAN HP ANDA AKAN DI PANGGIL</div>");
  redirect(base_url().'login');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Absensi | Barcode</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="<?= base_url(); ?>vertical/assets/images/logo.png">
    <link href="<?= base_url(); ?>vertical/assets/plugins/animate/animate.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>vertical/assets/css/bootstrap-material-design.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>vertical/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>vertical/assets/css/style.css" rel="stylesheet" type="text/css">
    <style>
        .centered-alert {
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 90%;
        }
    </style>
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
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="col-md-12 text-center mb-3">
        <h2>Welcome To Attendance System Barcode V2</h2>
    </div>
    <?php if (isset($message) && !empty($message)) : ?>
        <div class="alert alert-danger mb-1 centered-alert" role="alert">
            <p><?php echo $message; ?></p>
        </div>
    <?php endif; ?>

    <div class="wrapper-page">
        <div class="display-table">
            <div class="display-table-cell">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center pt-3"></div>
                                    <div class="px-3 pb-3">
                                        <form id="absensiForm" action="<?php echo site_url('absensi/absen'); ?>" method="post" onsubmit="return false;">
                                            <div class="text-center">
                                                <img src="<?= base_url(); ?>vertical/assets/images/logo.png" alt="Logo" height="150">
                                            </div>
                                            <div class="form-group">
                                                <label for="action">Pilih Tindakan:</label>
                                                <select class="form-control" id="action" name="action" required>
                                                    <option value="masuk">Absen Masuk</option>
                                                    <option value="keluar">Absen Keluar</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="uid">NIS:</label>
                                                <input type="text" class="form-control" name="uid" id="uid" required style="color: black;">
                                            </div>
                                            <input type="hidden" name="id_devices" value="1">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            

                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-info m-b-30">
                <div class="card-body">
                    <div class="d-flex row">
                        <div class="col-3 align-self-center">
                            <div class="round">
                                <i class="mdi mdi-account-multiple-plus"></i>
                            </div>
                        </div>
                        <div class="col-8 text-center ml-auto align-self-center">
                            <div class="m-l-10 text-white float-right">
                                <h5 class="mt-0 round-inner"><?=$jmlmasuk;?></h5>
                                <p class="mb-0 ">Siswa Masuk</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-info m-b-30">
                <div class="card-body">
                    <div class="d-flex row">
                        <div class="col-3 align-self-center">
                            <div class="round">
                                <i class="mdi mdi-account-multiple-plus"></i>
                            </div>
                        </div>
                        <div class="col-8 text-center ml-auto align-self-center">
                            <div class="m-l-10 text-white float-right">
                                <h5 class="mt-0 round-inner"><?=$jmlkeluar;?></h5>
                                <p class="mb-0 ">Siswa keluar</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-11 col-md-22 col-lg-6 col-xl-10">
            <div class="card bg-danger m-b-30">
                <div class="card-body">
                    <div class="d-flex row">
                        <div class="col-3 align-self-center">
                            <div class="round">
                                <i class="mdi mdi-link-variant-off"></i>
                            </div>
                        </div>
                        <div class="col-8 text-center ml-auto align-self-center">
                            <div class="m-l-10 text-white float-right">
                                
                                <h5 class="mt-0 round-inner"><?php echo  $jumlah_tidak_absensi ?></h5>
                                <p class="mb-0 ">Siswa Alfa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
   
    <script src="<?= base_url(); ?>vertical/assets/js/jquery.min.js"></script>
    <script src="<?= base_url(); ?>vertical/assets/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>vertical/assets/js/bootstrap-material-design.js"></script>
    <script src="<?= base_url(); ?>vertical/assets/js/modernizr.min.js"></script>
    <script src="<?= base_url(); ?>vertical/assets/js/detect.js"></script>
    <script src="<?= base_url(); ?>vertical/assets/js/fastclick.js"></script>
    <script src="<?= base_url(); ?>vertical/assets/js/jquery.slimscroll.js"></script>
    <script src="<?= base_url(); ?>vertical/assets/js/jquery.blockUI.js"></script>
    <script src="<?= base_url(); ?>vertical/assets/js/waves.js"></script>
    <script src="<?= base_url(); ?>vertical/assets/js/jquery.nicescroll.js"></script>
    <script src="<?= base_url(); ?>vertical/assets/js/jquery.scrollTo.min.js"></script>

    <script>
        // Menyimpan nilai UID sebelum refresh
        var uidInput = document.getElementById("uid");
        var uidValue = uidInput.value;

        // Menjalankan fungsi untuk mengembalikan fokus ke input UID setelah halaman dimuat kembali
        window.onload = function() {
            uidInput.value = uidValue; // Mengembalikan nilai UID yang tersimpan
            uidInput.focus(); // Mengembalikan fokus ke input UID
        };

        // Mendengarkan acara penekanan tombol pada input UID
        uidInput.addEventListener("keypress", function(event) {
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
        uidInput.addEventListener("keypress", (event) => {
            const hour = new Date().getHours();
            if (hour < 6 || hour >= 00) {
                event.preventDefault();
                alert("Waktu tidak sesuai untuk absensi!");
            }
        });
    </script>
</body>
</html>
