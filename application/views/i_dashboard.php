<?php
if ($set == "dashboard") {
  $this->load->View('include/header.php');
  

  $jmlrfid = 0;
  $jmlalat = 0;
  $jmlmasuk = 0;
  $jmlkeluar = 0;


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
        <!-- Column -->
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
                                <h5 class="mt-0 round-inner"><?=$jmlalat;?></h5>
                                <p class="mb-0 ">RFID Scaner</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
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
                                <i class="mdi mdi-school"></i>
                            </div>
                        </div>
                        <div class="col-8 text-center ml-auto align-self-center">
                            <div class="m-l-10 text-white float-right">
                                <h5 class="mt-0 round-inner"><?=$kelas;?></h5>
                                <p class="mb-0 ">Jumlah Kelas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
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
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-info m-b-30">
                <div class="card-body">
                    <div class="d-flex row">
                        <div class="col-3 align-self-center">
                            <div class="round">
                                <i class="mdi mdi-school"></i>
                            </div>
                        </div>
                        <div class="col-8 text-center ml-auto align-self-center">
                            <div class="m-l-10 text-white float-right">
                                <h5 class="mt-0 round-inner"><?=$jmlmasuk;?></h5>
                                <p class="mb-0 ">Siswa Ijin</p>
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
                                <i class="mdi mdi-seat-individual-suite"></i>
                            </div>
                        </div>
                        <div class="col-8 text-center ml-auto align-self-center">
                            <div class="m-l-10 text-white float-right">
                                <h5 class="mt-0 round-inner"><?=$jmlmasuk;?></h5>
                                <p class="mb-0 ">Siswa Sakit</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-success m-b-30">
                <div class="card-body">
                    <div class="d-flex row">
                        <div class="col-3 align-self-center">
                            <div class="round ">
                                <i class="mdi mdi-minus-circle-outline"></i>
                            </div>
                        </div>
                        <div class="col-8 ml-auto align-self-center text-center">
                            <div class="m-l-10 text-white float-right">
                                <h5 class="mt-0 round-inner"><?=$jmlkeluar;?></h5>
                                <p class="mb-0 ">Siswa Keluar</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
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
                                <h5 class="mt-0 round-inner"><?=$jmlrfid;?></h5>
                                <p class="mb-0">Jumlah Siswa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>



    <div class="row">
                                <div class="col-sm-12 col-md-12 col-xl-5">
                                    <div class="card m-b-30">
                                        <div class="card-body metro-widget">
                                            <h5 class="header-title mt-0 pb-3">Statistics</h5>
                                            <div id="morris-bar-example"></div>
                                            <div class="row text-center d-flex justify-content-around">
                                                
                                                <div class="col-4">
                                                    <p class="mb-0 font-14">New Orders</p>
                                                    <div class="live-tile m-0 w-100" data-mode="carousel" data-direction="horizontal" data-delay="3900" data-height="10">
                                                        <div>
                                                            <small class="text-muted"> today</small>
                                                            <h3 class=" text-dark">1,088
                                                                <small>
                                                                    <i class="mdi mdi-menu-down text-danger"></i>
                                                                </small>
                                                            </h3>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <p class="mb-0 font-14">Visits</p>
                                                    <div class="live-tile m-0 w-100" data-mode="carousel" data-direction="vertical" data-delay="3500" data-height="10">
                                                        <div>
                                                            <small class="text-muted"> today</small>
                                                            <h3 class=" text-dark">1,955</h3>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <p class="mb-0 font-14">Bounce Rate</p>
                                                    <div class="live-tile m-0 w-100" data-mode="carousel" data-direction="vertical" data-delay="4200" data-height="10">
                                                        <div>
                                                            <small class="text-muted">Minmum</small>
                                                            <h3 class=" text-dark">3.8 %
                                                                <small>
                                                                    <i class="mdi mdi-menu-up text-success"></i>
                                                                </small>
                                                            </h3>
                                                        </div>
                                                        <div>
                                                            
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 col-xl-7">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h5 class="header-title mt-0 pb-3">Revenue </h5>
                                            <div id="morris-area-chart"></div>
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
