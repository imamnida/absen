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
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?=base_url();?>imam/assets/img/favicon.png" rel="icon">
  <link href="<?=base_url();?>imam/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?=base_url();?>imam/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=base_url();?>imam/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?=base_url();?>imam/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?=base_url();?>imam/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?=base_url();?>imam/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?=base_url();?>imam/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?=base_url();?>imam/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?=base_url();?>imam/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 09 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="<?=base_url();?>imam/assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">SMKN 1 Talaga</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->
        <li class="nav-item dropdown">

<a class="nav-link nav-icon" href="<?=base_url();?>admin/setting">
  <i class="bi bi-gear"></i>
  
</a><!-- End Notification Icon -->
</li><!-- End Notification Nav -->

       
       
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?=base_url();?>components/dist/img/<?=$avatar;?>" class="img-circle" alt="User Image">
            <span class="d-none d-md-block dropdown-toggle ps-2"> <?=$this->session->userdata('userlogin');?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6> <?=$this->session->userdata('userlogin');?></h6>
              <span>Web Designer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              

            

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?=base_url();?>login/logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="<?=base_url();?>admin/dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=base_url();?>admin/list_users">
          <i class="bi bi-person"></i>
          <span>Daftar User</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=base_url();?>admin/devices">
          <i class="ri-equalizer-line"></i>
          <span>Data Alat</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=base_url();?>admin/kelas">
          <i class="ri-building-2-line"></i>
          <span>Daftar Kelas</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Data RFID</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?=base_url();?>admin/rfid/rfidnew">
              <i class="bi bi-circle"></i><span>RFID NEW</span>
            </a>
          </li>
          <li>
            <a href="<?=base_url();?>admin/rfid/datarfid">
              <i class="bi bi-circle"></i><span>RFID</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=base_url();?>admin/absensi">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Absensi</span>
        </a>
      </li><!-- End Login Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?=base_url();?>admin/histori">
          <i class="ri-compass-2-line"></i>
          <span>Histori Alat</span>
        </a>
      </li><!-- End Error 404 Page Nav -->

      

    </ul>

  </aside>
  <!-- End Sidebar-->
