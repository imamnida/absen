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
        <meta content="Admin Dashboard" name="description" />
        <meta content="Mannatthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="<?=base_url();?>vertical/assets/images/logo.png">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="<?=base_url();?>vertical/assets/plugins/fullcalendar/vanillaCalendar.css"/>
        <link rel="stylesheet" href="<?=base_url();?>vertical/assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css">
        <link rel="stylesheet" href="<?=base_url();?>vertical/assets/plugins/chartist/css/chartist.min.css">
        <link rel="stylesheet" href="<?=base_url();?>vertical/assets/plugins/morris/morris.css">
        <link rel="stylesheet" href="<?=base_url();?>vertical/assets/plugins/metro/MetroJs.min.css">

        <link rel="stylesheet" href="<?=base_url();?>vertical/assets/plugins/carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="<?=base_url();?>vertical/assets/plugins/carousel/owl.theme.default.min.css">
        <link href="<?=base_url();?>vertical/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>vertical/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url();?>vertical/assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?=base_url();?>vertical/assets/plugins/animate/animate.css" type="text/css">
        <link rel="stylesheet" href="<?=base_url();?>vertical/assets/css/bootstrap-material-design.min.css" type="text/css">
        <link rel="stylesheet" href="<?=base_url();?>vertical/assets/css/icons.css" type="text/css">
        <link rel="stylesheet" href="<?=base_url();?>vertical/assets/css/style.css" type="text/css">

   

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
                        <a href="<?=base_url();?>admin/dashboard" class="logo"><i class="mdi mdi-assistant"></i> SMKN 1 TALAGA</a>
                        <!--<a href="<?=base_url();?>admin/dashboard" class="logo">
                            <img src="<?=base_url();?>vertical/<?=base_url();?>vertical/assets/images/smk.png" alt="" class="logo-large">
                        </a-->
                    </div>
                </div>

                <div class="sidebar-inner slimscrollleft" id="sidebar-main">

                    <div id="sidebar-menu">
                        <ul>
                           
                    
                           
                        <li>
                                <a href="<?=base_url();?>admin/dashboard" class="waves-effect">
                                    <i class="mdi mdi-view-dashboard"></i>
                                    <span> Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url();?>absensi" class="waves-effect">
                                    <i class="mdi mdi-qrcode-scan"></i>
                                    <span>Absensi Barcode</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url();?>alfa" class="waves-effect">
                                    <i class="mdi mdi-account-remove"></i>
                                    <span>Alfa 3 Hari</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url();?>admin/absensi" class="waves-effect">
                                    <i class="mdi mdi-account-remove"></i>
                                    <span>Absensi View</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url();?>izin" class="waves-effect">
                                    <i class="mdi mdi-hospital"></i>
                                    <span>Data Perizinan</span>
                                </a>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-school"></i> <span> Data </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="<?=base_url();?>admin/kelas">Data Kelas</a></li>
                                    <li><a href="<?=base_url();?>admin/kampus">Data Kampus</a></li>
                                    <li><a href="<?=base_url();?>admin/list_users">Data User</a></li>
                                    <li><a href="<?=base_url();?>walikelas/list_walikelas">Data Walikelas</a></li>
                                    <li><a href="<?=base_url();?>admin/rfidnew">New RFID</a></li>
                                    <li><a href="<?=base_url();?>admin/datarfid">Data All</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?=base_url();?>admin/devices" class="waves-effect">
                                    <i class="mdi mdi-xaml"></i>
                                    <span> Device </span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url();?>admin/histori" class="waves-effect">
                                    <i class="mdi mdi-history"></i>
                                    <span> Histori Alat </span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url();?>admin/setting" class="waves-effect">
                                    <i class="mdi mdi-camera-timer"></i>
                                    <span> Setting </span>
                                </a>
                            </li>   
                            <li>
                                <a href="<?=base_url();?>sql" class="waves-effect">
                                    <i class="mdi mdi-linux"></i>
                                    <span> SQL Command</span>
                                </a>
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
                                        <img src="<?=base_url();?>vertical/assets/images/logo.png" alt="user" >
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
