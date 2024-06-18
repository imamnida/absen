<?php
if ($set == "dashboard") {
    $this->load->view('include/header.php');

    $jmlrfid = isset($rfid) ? count($rfid) : 0;
    $jmlalat = isset($devices) ? count($devices) : 0;
    $jmlmasuk = isset($masuk) ? count($masuk) : 0;
    $jmlkeluar = isset($keluar) ? count($keluar) : 0;
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

        <!-- end page title end breadcrumb -->
        <div class="row">
            <!-- Column: RFID Scanner -->
            <div class="col-sm-12 col-md-6 col-xl-3">
                <div class="card bg-danger m-b-30">
                    <div class="card-body">
                        <div class="d-flex row">
                            <div class="col-3 align-self-center">
                                <div class="round">
                                    <i class="mdi mdi-blinds"></i>
                                </div>
                            </div>
                            <div class="col-8 ml-auto align-self-center text-center">
                                <div class="m-l-10 text-white float-right">
                                    <h5 class="mt-0 round-inner"><?= $jmlalat; ?></h5>
                                    <p class="mb-0">RFID Scanner</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column: Siswa Masuk -->
            <div class="col-sm-12 col-md-6 col-xl-3">
                <div class="card bg-info m-b-30">
                    <div class="card-body">
                        <div class="d-flex row">
                            <div class="col-3 align-self-center">
                                <div class="round">
                                    <i class="mdi mdi-account-multiple-plus"></i>
                                </div>
                            </div>
                            <div class="col-8 ml-auto align-self-center text-center">
                                <div class="m-l-10 text-white float-right">
                                    <h5 class="mt-0 round-inner"><?= $jmlmasuk; ?></h5>
                                    <p class="mb-0">Siswa Masuk</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            <!-- Column: Siswa Alfa -->
            <div class="col-sm-12 col-md-6 col-xl-3">
                <div class="card bg-danger m-b-30">
                    <div class="card-body">
                        <div class="d-flex row">
                            <div class="col-3 align-self-center">
                                <div class="round">
                                    <i class="mdi mdi-link-variant-off"></i>
                                </div>
                            </div>
                            <div class="col-8 ml-auto align-self-center text-center">
                                <div class="m-l-10 text-white float-right">
                                    <h5 class="mt-0 round-inner"><?= $jumlah_tidak_absensi; ?></h5>
                                    <p class="mb-0">Siswa Alfa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column: Siswa Ijin -->
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
                                    <h5 class="mt-0 round-inner">0</h5>
                                    <p class="mb-0">Siswa Ijin</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column: Siswa Sakit -->
            <div class="col-sm-12 col-md-6 col-xl-3">
                <div class="card bg-info m-b-30">
                    <div class="card-body">
                        <div class="d-flex row">
                            <div class="col-3 align-self-center">
                                <div class="round">
                                    <i class="mdi mdi-seat-individual-suite"></i>
                                </div>
                            </div>
                            <div class="col-8 ml-auto align-self-center text-center">
                                <div class="m-l-10 text-white float-right">
                                    <h5 class="mt-0 round-inner">0</h5>
                                    <p class="mb-0">Siswa Sakit</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column: Siswa Keluar -->
            <div class="col-sm-12 col-md-6 col-xl-3">
                <div class="card bg-success m-b-30">
                    <div class="card-body">
                        <div class="d-flex row">
                            <div class="col-3 align-self-center">
                                <div class="round">
                                    <i class="mdi mdi-minus-circle-outline"></i>
                                </div>
                            </div>
                            <div class="col-8 ml-auto align-self-center text-center">
                                <div class="m-l-10 text-white float-right">
                                    <h5 class="mt-0 round-inner"><?= $jmlkeluar; ?></h5>
                                    <p class="mb-0">Siswa Keluar</p>
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
                                    <p class="mb-0">Jumlah Siswa</p>
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
</div>
<!-- content -->

<?php
} 

$this->load->view('include/footer.php');
?>