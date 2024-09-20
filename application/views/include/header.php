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
    <title>Admin Dashboard</title>
    <meta name="description" content="Admin Dashboard" />
    <meta name="author" content="Mannatthemes" />

    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/logo.png" />

    <!-- Morris Chart CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fullcalendar/vanillaCalendar.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/chartist/css/chartist.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/morris/morris.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/metro/MetroJs.min.css" />

    <!-- Carousel CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/carousel/owl.theme.default.min.css" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables/buttons.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/datatables/responsive.bootstrap4.min.css" />

    <!-- Other CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/animate/animate.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-material-design.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/icons.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css" />
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
                        <a href="<?=base_url();?>admin/dashboard" class="logo"><i class="mdi mdi-access-point"></i> Absensi Online</a>
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
                                        <a href="<?=base_url();?>rfid" class="waves-effect">
                                            <i class="mdi mdi-account"></i>
                                            <span>Siswa</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url();?>rfid/rfidnew" class="waves-effect">
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
                                <a href="<?=base_url();?>absensi_bc" class="waves-effect">
                                    <i class="mdi mdi-qrcode-scan"></i>
                                    <span>Absensi Barcode</span>
                                </a>
                            </li>
                            <li>
                                
                           
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cog"></i> <span> Pengaturan </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                            <li>
                                <a href="<?=base_url();?>users" class="waves-effect">
                                    <i class="mdi mdi-account-key"></i>
                                    <span> Admin </span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url();?>devices" class="waves-effect">
                                    <i class="mdi mdi-xaml"></i>
                                    <span> Device </span>
                                </a>
                           
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
                    <a href=""><i class="fa fa-search"></i></a>
                </div>
            </form>
        </div>
    </div>

    <ul class="list-inline float-right mb-0 mr-3">
        <!-- language-->
        <li class="list-inline-item dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
                <i class="ti-email noti-icon"></i>
                <span class="badge badge-danger heartbit noti-icon-badge">1</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
                <!-- item-->
                <div class="dropdown-item noti-title align-self-center">
                    <h5><span class="badge badge-danger float-right">1</span>Messages</h5>
                </div>

                <!-- item-->
               

            </div>
        </li>

        <li class="list-inline-item dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
                <i class="ti-bell noti-icon"></i>
                <span class="badge badge-success a-animate-blink noti-icon-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
                <!-- item-->
                <div class="dropdown-item noti-title">
                    <h5><span class="badge badge-danger float-right">3</span>Notification</h5>
                </div>

                <!-- item-->
                <a href="<?=base_url();?>izin" class="dropdown-item notify-item">
                    <div class="notify-icon bg-primary"><i class="mdi mdi-account-remove"></i></div>
                    <p class="notify-details"><b>Banyak siswa yang tidak hadir</b><small class="text-muted">Mohon periksa kenapa siswa tersebut tidak hadir.</small></p>
                </a>

                <!-- item-->
                <a href="<?=base_url();?>admin/kelas" class="dropdown-item notify-item">
                    <div class="notify-icon bg-success"><i class="mdi mdi-message"></i></div>
                    <p class="notify-details"><b>Mohon periksa data siswa</b><small class="text-muted">Jika ada kesalahan maka hubungi admin</small></p>
                </a>

                <!-- item-->
                <a href="https://wa.me/6282295844039?text=Mohon%20perbaiki%20bug%20ini" class="dropdown-item notify-item">
                    <div class="notify-icon bg-warning"><i class="mdi mdi-whatsapp"></i></div>
                    <p class="notify-details"><b>Mohon beritau admin jika ada kesalahan aplikasi</b><small class="text-muted">jika ada kesalahan aplikasi</small></p>
                </a>

                <!-- All-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    View All
                </a>

            </div>
        </li>
        
        <li class="list-inline-item dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="<?=base_url();?>assets/images/logo.png" alt="user" >
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

    <div class="clearfix"></div>

</nav>

</div>
<!-- Top Bar End -->
