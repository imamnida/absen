<?php
if ($set == "dashboard") {
    $this->load->view('include/header.php');

    $jmlrfid = isset($rfid) ? count($rfid) : 0;
    $jmlalat = isset($devices) ? count($devices) : 0;
    $jmlmasuk = isset($masuk) ? count($masuk) : 0;
    $jmlkeluar = isset($keluar) ? count($keluar) : 0;
    $jmlizin = isset($izin) ? count($izin) : 0;
    $jmlsakit = isset($sakit) ? count($sakit) : 0;
    $jumlah_tidak_absensi = isset($jumlah_tidak_absensi) ? $jumlah_tidak_absensi : 0;
?>

<div class="page-content-wrapper dashborad-v">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">admin</a></li>
                            <li class="breadcrumb-item active">Home</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>

        <!-- Welcome Box -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body text-center">
                        <img src="<?=base_url();?>assets/images/logo.png" alt="School Logo" style="max-width: 150px; margin-bottom: 20px;">
                        <h1 class="card-title">SELAMAT DATANG DI APLIKASI ADMINISTRASI DATA SISWA</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="row">
            <!-- Column: RFID Scanner -->
            
            <!-- Column: Jumlah Kelas -->
            <div class="col-sm-12 col-md-6 col-xl-3">
                <div class="card bg-info m-b-30">
                    <div class="card-body">
                        <div class="d-flex row">
                            <div class="col-3 align-self-center">
                                <div class="round">
                                    <i class="mdi mdi-school"></i>
                                </div>
                            </div>
                            <div class="col-8 ml-auto align-self-center text-center">
                                <div class="m-l-10 text-white float-right">
                                    <h5 class="mt-0 round-inner"><?= $kelas; ?></h5>
                                    <p class="mb-0">Jumlah Kelas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
            <!-- Column: Jumlah Siswa -->
            <div class="col-sm-12 col-md-6 col-xl-3">
                <div class="card bg-primary m-b-30">
                    <div class="card-body">
                        <div class="d-flex row">
                            <div class="col-3 align-self-center">
                                <div class="round">
                                    <i class="mdi mdi-account-card-details"></i>
                                </div>
                            </div>
                            <div class="col-8 ml-auto align-self-center text-center">
                                <div class="m-l-10 text-white float-right">
                                    <h5 class="mt-0 round-inner"><?= $jmlrfid; ?></h5>
                                    <p class="mb-0">Jumlah Siswa Yang Sudah Mengisi Data</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- container -->
</div>
<!-- Page content Wrapper -->

<?php
}

$this->load->view('include/footer.php');
?>
