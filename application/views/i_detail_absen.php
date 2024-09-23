<?php

if($this->session->userdata('userlogin'))     // mencegah akses langsung tanpa login
{ 
  $users = $this->session->userdata('userlogin');
  $avatar = $this->session->userdata('avatar');
}else{
  //masuk tanpa login
  $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> Mohon Login terlebih dahulu</div>");
  redirect(base_url().'login');
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Rekapitulasi Absensi  <?php echo $kelas->kelas; ?></title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Mannatthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="<?=base_url();?>assets/images/gi.png">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="<?=base_url();?>assets/plugins/fullcalendar/vanillaCalendar.css"/>
        <link rel="stylesheet" href="<?=base_url();?>assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css">
        <link rel="stylesheet" href="<?=base_url();?>assets/plugins/chartist/css/chartist.min.css">
        <link rel="stylesheet" href="<?=base_url();?>assets/plugins/morris/morris.css">
        <link rel="stylesheet" href="<?=base_url();?>assets/plugins/metro/MetroJs.min.css">

        <link rel="stylesheet" href="<?=base_url();?>assets/plugins/carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="<?=base_url();?>assets/plugins/carousel/owl.theme.default.min.css">
        <link href="<?=base_url();?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?=base_url();?>assets/plugins/animate/animate.css" type="text/css">
        <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap-material-design.min.css" type="text/css">
        <link rel="stylesheet" href="<?=base_url();?>assets/css/icons.css" type="text/css">
        <link rel="stylesheet" href="<?=base_url();?>assets/css/style.css" type="text/css">

   

    </head>


    <body class="fixed-left">

        <!-- Loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner"></div>
            </div>
        </div>

        <!-- Begin page -->
        <div id="wrapper">

           <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                    <i class="mdi mdi-close"></i>
                </button>

               <!-- LOGO -->
<div class="topbar-left">
    <div class="text-center">
        <a href="<?= base_url(); ?>dashboard" class="logo">
            <img src="<?php echo base_url(); ?>assets/images/logogisaka.png" alt="Logo" style="height: 40px;"> 
           
        </a>
    </div>
</div>


                <div class="sidebar-inner slimscrollleft" id="sidebar-main">

                    <div id="sidebar-menu">
                        <ul>
                           
                    
                           
                        <li>
                                <a href="<?=base_url();?>dashboard" class="waves-effect">
                                    <i class="mdi mdi-view-dashboard"></i>
                                    <span> Dashboard</span>
                                </a>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-file"></i> <span> Data </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="<?=base_url();?>kelas" class="waves-effect">
                                            <i class="ti-home"></i>
                                            <span>Kelas</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url();?>walikelas/list_walikelas" class="waves-effect">
                                            <i class="mdi mdi-account-box"></i>
                                            <span>Wali Kelas</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url();?>datarfid" class="waves-effect">
                                            <i class="mdi mdi-account"></i>
                                            <span>Siswa</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url();?>rfidnew" class="waves-effect">
                                            <i class="mdi mdi-access-point"></i>
                                            <span>RFID</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-calendar"></i> <span> Absensi </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                            <li>
                                <a href="<?=base_url();?>absensi" class="waves-effect">
                                    <i class="mdi mdi-account-check"></i>
                                    <span>Riwayat Kehadiran</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url();?>alfa" class="waves-effect">
                                    <i class="mdi mdi-account-remove"></i>
                                    <span>Alpa</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url();?>izin" class="waves-effect">
                                    <i class="mdi mdi-hospital"></i>
                                    <span>Perizinan</span>
                                </a>
                            </li>


                                </ul>
                            </li>
                            <li>
                                <a href="<?=base_url();?>absensi" class="waves-effect">
                                    <i class="mdi mdi-qrcode-scan"></i>
                                    <span>Absensi Barcode</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url();?>histori" class="waves-effect">
                                    <i class="mdi mdi-history"></i>
                                    <span> Histori Alat </span>
                                </a>
                           
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cog"></i> <span> Pengaturan </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                            <li>
                                <a href="<?=base_url();?>list_users" class="waves-effect">
                                    <i class="mdi mdi-account-key"></i>
                                    <span> Admin </span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url();?>devices" class="waves-effect">
                                    <i class="mdi mdi-xaml"></i>
                                    <span> Device </span>
                                </a>
                            <li>
                                <a href="<?=base_url();?>kampus" class="waves-effect">
                                    <i class="mdi mdi-access-point"></i>
                                    <span> Access Point </span>
                                </a>
                            </li>
                                <a href="<?=base_url();?>setting" class="waves-effect">
                                    <i class="mdi mdi-camera-timer"></i>
                                    <span> Waktu Oprasional </span>
                                </a>
                            </li>   
                            <li>
                                <a href="<?=base_url();?>sql" class="waves-effect">
                                    <i class="mdi mdi-linux"></i>
                                    <span> SQL Command</span>
                                </a>
                            </li>

                                </ul>
                            </li>

                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->
            

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    <div class="topbar">

                        <nav class="navbar-custom">
                            <div class="dropdown notification-list nav-pro-img">

                                <div class="list-inline-item hide-phone app-search">
                                    <form role="search" class="">
                                        <div class="form-group pt-1">
                                            <input type="text" class="form-control" placeholder="Search..">
                                            <a href="">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <ul class="list-inline float-right mb-0 mr-3">
                                <!-- language-->
                               
                                   

                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                        aria-expanded="false">
                                        <img src="<?=base_url();?>assets/images/<?=$avatar;?>" alt="user" >
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                        <!-- item-->
                                        <div class="dropdown-item noti-title">
                                            <h5><?=$this->session->userdata('userlogin');?></h5>
                                        </div>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?=base_url();?>login/logout">
                                            <i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                                    </div>
                                </li>
                            </ul>

                            <ul class="list-inline menu-left mb-0">
                                <li class="float-left">
                                    <button class="button-menu-mobile open-left waves-light waves-effect">
                                        <i class="mdi mdi-menu"></i>
                                    </button>
                                </li>
                            </ul>

                           

                        </nav>

                    </div>
                    <!-- Top Bar End -->

<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Daftar Kelas</a></li>
                            <li class="breadcrumb-item"><?= $kelas->kelas; ?></li>
                            <li class="breadcrumb-item active">Rekap Absen</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Rekap Absen</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Rekapitulasi Absensi Kelas : <?php echo $kelas->kelas; ?></h4>
                        <div class="general-label">
                            <form action="" method="get">
                                <div class="row mb-3">
                                    <label for="tanggalMulai" class="col-sm-2 col-form-label">Tanggal Mulai</label>
                                    <div class="col-sm-4">
                                        <input type="date" name="tanggalMulai" value="<?php if(isset($_GET['tanggalMulai'])){echo $_GET['tanggalMulai'];}  ?>" class="form-control" required>
                                    </div>
                                    <label for="tanggalSelesai" class="col-sm-2 col-form-label">Tanggal Selesai</label>
                                    <div class="col-sm-4">
                                        <input type="date" name="tanggalSelesai" value="<?php if(isset($_GET['tanggalSelesai'])){echo $_GET['tanggalSelesai'];}  ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <input type="hidden" name="id_kelas" value="<?php echo $kelas->id; ?>">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Ambil Data</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
        </div>           
        <?php if (!empty($_GET['tanggalMulai']) && !empty($_GET['tanggalSelesai'])) { ?>
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Rekapitulasi Absensi Kelas : <?php echo $kelas->kelas; ?></h4>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                   
                                    <th>Nama</th>
                                    <?php
                                  
                                    $date = strtotime($_GET['tanggalMulai']);
                                    $end_date = strtotime($_GET['tanggalSelesai']);
                                    while ($date <= $end_date) {
                                    ?>
                                        <th><?= date('Y-m-d', $date); ?></th>
                                    <?php
                                        $date = strtotime("+1 day", $date);
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
    <?php
    if (!empty($rekap_absen)) {
        $no = 0;

        foreach ($rekap_absen as $row) {
            $no++;
    ?>
            <tr>
                <td><?php echo $no; ?></td>
               
                <td><?php echo $row->nama; ?></td>
                <?php

                $date = strtotime($_GET['tanggalMulai']);
                $end_date = strtotime($_GET['tanggalSelesai']);
                while ($date <= $end_date) {
                  
                    if (date("D", $date) != "Sun") {
                        $formatted_date = date('Y-m-d', $date);
                        $absen_found = false;
                        $tulisan_absen = "";
                        foreach ($row->absensi as $absen) {
                            if (date('Y-m-d', $absen->created_at) == $formatted_date) {
                                if ($absen->keterangan == "masuk") {
                                    $tulisan_absen = "masuk";
                                } elseif ($absen->keterangan == "keluar") {
                                    $tulisan_absen = "masuk-keluar";
                                } elseif ($absen->keterangan == "izin") {
                                    $tulisan_absen = "izin";
                                } elseif ($absen->keterangan == "sakit") {
                                    $tulisan_absen = "sakit";
                                }
                                $absen_found = true;
                            }
                        }
                        if (!$absen_found) {
                            $tulisan_absen = '-';
                        }
                        echo '<td>' . $tulisan_absen . '</td>';
                    } else {
                        echo '<td>Libur</td>';
                    }
                    $date = strtotime("+1 day", $date);
                }
                ?>
            </tr>
    <?php
        }
    } else {
    ?>
        <tr>
            <td colspan="<?php echo isset($rekap_absen) ? (count($rekap_absen) + 3) : 0; ?>">Tidak ada data kehadiran dalam rentang tanggal yang diminta.</td>
        </tr>
    <?php
    }}
    ?>
</tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>

<?php $this->load->view('include/footer.php'); ?>
