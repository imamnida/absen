<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Absensi | Gisaka Media</title>
  <!-- -------- anime css ------ -->
  <link rel="stylesheet" href="<?php base_url()?>promo/css/animate.css">
  <!-- --------- tiny slider css ------ -->
  <link rel="stylesheet" href="<?php base_url()?>promo/css/tiny-slider.css">
  <link rel="icon" href="<?php base_url()?>promo/img/header/logo/gi.png" type="image/x-icon">
  

  <!-- --------- font awsome css ------ -->
  <link rel="stylesheet" href="<?php base_url()?>promo/css/all.css">
  <!-- -------- venobox css ------- -->
  <link rel="stylesheet" href="<?php base_url()?>promo/css/venobox.css" type="text/css" media="screen" />
  <!-- ---- Bootstrap css--- -->
  <link rel="stylesheet" href="<?php base_url()?>promo/css/bootstrap.min.css">
  <!-- ---------- default css --------- -->
  <link rel="stylesheet" href="<?php base_url()?>promo/css/default.css">
  <!-- --- style css -->
  <link rel="stylesheet" href="<?php base_url()?>promo/css/style.css">
  
</head>

<body>
  <style>
.partners-logo {
  display: flex;
  flex-wrap: wrap; /* Membuat logo membungkus ke baris berikutnya */
  justify-content: center; /* Menempatkan logo di tengah */
}

.partner-logo {
  width: 80px; /* Sesuaikan ukuran logo */
  margin: 50px; /* Ruang antar logo */
  max-width: 150%; /* Membatasi ukuran logo agar responsif */
}

</style>

  <!-- --------- preloader ------------ -->
  <div class="preloader">
    <div class="loader">
      <div class="spinner">
        <div class="spinner-container">
          <div class="spinner-rotator">
            <div class="spinner-left">
              <div class="spinner-circle"></div>
            </div>
            <div class="spinner-right">
              <div class="spinner-circle"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-------   Header star ------>
  <header class="header-area">
    <div class="navbar-area">
      <!---- navbar star--->
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">
              <img class="image" src="<?php base_url()?>promo/img/header/logo/landapp-logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                  <a class="nav-link active" data-scroll-nav="0" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-scroll-nav="1" href="#">Features</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-scroll-nav="2" href="#">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-scroll-nav="3" href="#">Testimonial</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-scroll-nav="4" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-scroll-nav="5" href="#">FAQ</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-scroll-nav="6" href="#">Download</a>
                </li>


              </ul>
              <a href="<?php echo base_url('login'); ?>" class="btn btn-primary ms-lg-3">Login</a>

            </div>
          </div>
        </nav>
      </div>
    </div>
    <!---- navbar end--->
    <div class="header-hero" data-scroll-index="0">
  <!-- Home star -->
  <div class="shape shape-1"></div>
  <div class="shape shape-2"></div>
  <div class="shape shape-3"></div>
  <div class="shape shape-4"></div>
  <div class="shape shape-5"></div>
  <div class="shape shape-6"></div>
  
  <div class="container">
    <div class="row align-items-center justify-content-center justify-content-lg-between">
      <div class="col-lg-6 col-md-10">
        <div class="header-hero-content">
          <h1 class="header-title wow fadeInLeftBig" data-wow-duration="3s" data-wow-delay="0.2s">
            <span>Absensi Sekolah SI ATA</span> Sistem Informasi Absensi Tepat Akurat
          </h1>
          <p class="text wow fadeInLeftBig" data-wow-duration="3s" data-wow-delay="0.4s">
            Dapatkan sistem absensi modern yang akurat dan efisien untuk sekolah Anda. 
            Dengan Teknologi Terkini Yaitu RFID, GPS, Barcode Dan Metode Absensi Lainnya.
          </p>
          <ul class="d-flex">
          <li>
          <a href="<?php echo base_url('assets/app-release (1).apk'); ?>" download class="main-btn wow fadeInLeftBig" data-wow-duration="3s" data-wow-delay="0.8s">Download Now</a>

</li>

            <li>
              <a href="#" class="header-video venobox wow fadeInLeftBig" data-autoplay="true" data-vbtype="video" data-wow-duration="3s" data-wow-delay="1.2s">
                <i class="fas fa-play"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
      
      <div class="col-lg-5 col-md-6">
        <div class="header-image" style="margin-top: 70px;"> <!-- Menambahkan margin-top untuk menurunkan gambar -->
          <img src="<?php echo base_url(); ?>promo/img/header/header-app.png" alt="Header App Image" class="image-1 wow fadeInRightBig" data-wow-duration="2s" data-wow-delay="0.5s" style="width: 1000px; height: auto;">
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="header-shape-1"></div>
    <div class="header-shape-2">
      <img src="<?php echo base_url(); ?>promo/img/header/header-shape-2.svg" alt="Header Shape 2">
    </div>
  </div>
</div>
<!-- End of Home star -->
</header>

  <!--------   Header End ----  -->
<!-- ------- Feature Section Start ---------- -->
<section class="feature-section pt-80" data-scroll-index="1">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-7">
        <div class="section-title text-center mb-30">
          <h1 class="mb-25 wow fadeInUp" data-wow-delay=".2s">Fitur Lengkap SI ATA</h1>
          <p class="wow fadeInUp" data-wow-delay=".4s">Sistem absensi kami menyediakan berbagai metode modern untuk memudahkan proses pencatatan kehadiran siswa dengan akurasi dan keamanan yang terjamin.</p>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-4">
        <div class="single-feature wow fadeInUp" data-wow-duration="3s" data-wow-delay="0.6s" style="height: 400px;">
          <div class="icon color-6">
            <i class="fas fa-tachometer-alt"></i>
          </div>
          <div class="content">
            <h3>Dashboard</h3>
            <p>Menampilkan data singkat, statistik, dan laporan real-time yang mudah dipahami oleh guru dan admin.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="single-feature wow fadeInUp" data-wow-duration="3s" data-wow-delay="0.2s" style="height: 400px;">
          <div class="icon color-1">
            <i class="fas fa-map-marker-alt"></i>
          </div>
          <div class="content">
            <h3>Rekapitulasi</h3>
            <p>Rekapitulasi kehadiran per kelas secara akurat dan otomatis, memberikan gambaran lengkap kepada guru dan admin.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="single-feature wow fadeInUp" data-wow-duration="3s" data-wow-delay="0.2s" style="height: 400px;">
          <div class="icon color-1">
            <i class="fas fa-user"></i>
          </div>
          <div class="content">
            <h3>Login Guru</h3>
            <p>Memudahkan guru untuk merekapitulasi dan memonitor kehadiran siswa dengan efisiensi tinggi.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="single-feature wow fadeInUp" data-wow-duration="3s" data-wow-delay="0.2s" style="height: 400px;">
          <div class="icon color-1">
            <i class="fas fa-clock"></i>
          </div>
          <div class="content">
            <h3>Pengaturan Waktu Operasional</h3>
            <p>Admin memiliki kontrol penuh untuk mengatur waktu kehadiran, termasuk jam masuk dan pulang secara fleksibel dan presisi.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="single-feature wow fadeInUp" data-wow-duration="3s" data-wow-delay="0.2s" style="height: 400px;">
          <div class="icon color-1">
            <i class="fas fa-map-marked-alt"></i>
          </div>
          <div class="content">
            <h3>Metode Absensi GPS</h3>
            <p>Menggunakan teknologi GPS berakurasi tinggi untuk memastikan kehadiran siswa hanya dapat dicatat di lokasi yang sudah ditentukan. Sistem ini memastikan absensi tidak dapat dilakukan di luar titik koordinat yang telah diatur, menjamin keaslian dan validitas data kehadiran.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="single-feature wow fadeInUp" data-wow-duration="3s" data-wow-delay="0.4s" style="height: 400px;">
          <div class="icon color-2">
            <i class="fas fa-id-card"></i>
          </div>
          <div class="content">
            <h3>Metode Absensi RFID</h3>
            <p>Kartu siswa elektronik yang praktis dan efisien memudahkan absensi harian dengan sekali tap.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="single-feature wow fadeInUp" data-wow-duration="3s" data-wow-delay="0.6s" style="height: 400px;">
          <div class="icon color-3">
            <i class="fas fa-qrcode"></i>
          </div>
          <div class="content">
            <h3>Metode Absensi Barcode</h3>
            <p>Memanfaatkan barcode unik yang terintegrasi dengan kartu siswa, memungkinkan proses absensi menjadi lebih cepat dan mudah diterapkan.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="single-feature wow fadeInUp" data-wow-duration="3s" data-wow-delay="0.4s" style="height: 400px;">
          <div class="icon color-4">
            <i class="fas fa-exclamation-triangle"></i>
          </div>
          <div class="content">
            <h3>Deteksi Alfa 3 Hari</h3>
            <p>Sistem otomatis yang langsung memberikan notifikasi jika siswa tidak hadir selama 3 hari berturut-turut tanpa keterangan, memudahkan tindakan lebih lanjut dari pihak sekolah.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="single-feature wow fadeInUp" data-wow-duration="3s" data-wow-delay="0.4s" style="height: 400px;">
          <div class="icon color-5">
            <i class="fas fa-pencil-alt"></i>
          </div>
          <div class="content">
            <h3>Fitur Perijinan</h3>
            <p>Guru dan admin dapat dengan mudah mencatat izin siswa yang absen karena sakit atau keperluan mendesak lainnya dengan proses yang cepat dan terdokumentasi.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ------- Feature Section End ---------- -->





  <!-- ----------- About Section Start --------- -->
<section class="about-area pt-70 pb-120" data-scroll-index="2">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="foto" data-wow-duration="3s" data-wow-delay="0.5s">
                    <!-- about-shape jika kosong, mungkin bisa dihapus jika tidak digunakan -->
                    <div class="about-shape"></div>
                    <img src="<?php echo base_url(); ?>promo/img/about/about-app.png" alt="Sistem Absensi Modern" class="app" style="width:100%; height:auto;">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content mt-50 wow fadeInRightBig" data-wow-duration="3s" data-wow-delay="0.5s">
                    <div class="section-title">
                        <h1 class="title">Sistem Absensi yang Modern</h1>
                        <p class="text">
                            Kami menawarkan solusi absensi yang lengkap dengan berbagai metode, termasuk GPS, RFID, dan barcode. 
                            Dengan teknologi terkini, kehadiran siswa dapat dicatat dengan akurat dan efisien, memastikan tidak ada yang terlewatkan.
                        </p>
                    </div>
                    <a href="#contact" class="main-btn">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ----------- About Section End --------- -->


 <!-- ----------- Testimonial Section Start ------- -->
<section class="testimonial-section" data-scroll-index="3">
  <div class="container">
    <div class="row justify-content-center testimonial-active-wrapper">
      <div class="col-xl-6 col-lg-7">
        <div class="section-title text-center mb-60">
          <h1 class="mb-25 text-white wow fadeInUp" data-wow-delay=".2s">Apa Kata Klien Kami</h1>
          <p class="text-white wow fadeInUp" data-wow-delay=".4s">Para pengguna kami merasa puas dengan sistem absensi modern yang kami sediakan untuk sekolah dan lembaga pendidikan.</p>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-8">
          <div class="testimonial-active">
            <div class="testimonial-wrapper">
              <div class="single-testimonial">
                <div class="info">
                  <div class="image-2">
                    <img src="<?php echo base_url()?>promo/img/testemonial/test-1.jpg" alt="">
                  </div>
                  <h4>Budi Santoso</h4>
                  <p>Kepala Sekolah, SMA Harapan Bangsa</p>
                  <div class="quote">
                    <i class="fas fa-quote-right"></i>
                  </div>
                  <div class="content">
                    <p>Sistem absensi ini sangat membantu dalam memonitor kehadiran siswa. Dengan fitur GPS dan RFID, kami bisa memastikan kehadiran siswa secara akurat dan efisien. Sistem ini memudahkan kami dalam mengelola absensi harian.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testimonial-wrapper">
              <div class="single-testimonial">
                <div class="info">
                  <div class="image-2">
                    <img src="<?php echo base_url()?>promo/img/testemonial/test-2.jpg" alt="">
                  </div>
                  <h4>Siti Nurhaliza</h4>
                  <p>Guru, SMP Cerdas Bangsa</p>
                  <div class="quote">
                    <i class="fas fa-quote-right"></i>
                  </div>
                  <div class="content">
                    <p>Dengan adanya sistem barcode dan RFID pada absensi siswa, kami dapat melacak kehadiran siswa dengan cepat dan mudah. Sistem ini sangat modern dan sangat memudahkan dalam pengelolaan data kehadiran.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="testimonial-wrapper">
              <div class="single-testimonial">
                <div class="info">
                  <div class="image-2">
                    <img src="<?php echo base_url()?>promo/img/testemonial/test-3.jpg" alt="">
                  </div>
                  <h4>Ahmad Fauzi</h4>
                  <p>Wali Kelas, SD Bina Cendekia</p>
                  <div class="quote">
                    <i class="fas fa-quote-right"></i>
                  </div>
                  <div class="content">
                    <p>Sistem absensi ini sangat membantu kami dalam memantau siswa yang hadir atau tidak hadir. Fitur GPS dan RFID memberikan akurasi yang sangat baik, sehingga pengelolaan absensi menjadi lebih efektif dan efisien.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</section>
<!-- ----------- Testimonial Section End ------- -->


<!-- ------------ Pricing Section Start --------- -->
<div class="pricing-area pt-110" data-scroll-index="4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-7">
        <div class="section-title text-center pb-30">
          <h1 class="wow fadeInUp" data-wow-delay=".2s">Choose <span> a plan</span></h1>
          <p class="wow fadeInUp" data-wow-delay=".4s">Pilih paket yang sesuai untuk kebutuhan absensi Anda. Setiap paket dirancang untuk memudahkan pengelolaan kehadiran siswa.</p>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <!-- Paket Starter -->
      <div class="col-lg-3 col-md-6 col-sm-9">
        <div class="single-pricing text-left wow fadeInUp" data-wow-duration="3s" data-wow-delay="0s" style="min-height: 500px;">
          <div class="pricing-title">
            <h4 class="title">Starter</h4>
          </div>
          <div class="pricing-price">
            <span class="pricing">Rp 6.000 / Siswa.</span>
            <p class="text">Tahunan</p>
          </div>
          <div class="pricing-list">
            <ul class="list">
              <li><i class="fas fa-check"></i> Software Pengelolaan Data</li>
              <li><i class="fas fa-check"></i> Pelatihan Siswa dan Guru</li>
            </ul>
          </div>
          <div class="pricing-btn">
            <a href="https://wa.me/6282295844039?text=Haloo%20Gisaka%20Media%2C%20saya%20ingin%20berkonsultasi%20terkait%20aplikasi%20absensi%20dengan%20paket%20Starter" class="main-btn main-btn-2" target="_blank">Hubungi Kami</a>
          </div>
        </div>
      </div>

      <!-- Paket Basic -->
      <div class="col-lg-3 col-md-6 col-sm-9">
        <div class="single-pricing text-left wow fadeInUp" data-wow-duration="3s" data-wow-delay="0.2s" style="min-height: 500px;">
          <div class="pricing-title">
            <h4 class="title">Basic</h4>
          </div>
          <div class="pricing-price">
            <span class="pricing">Rp 10.000 / Siswa.</span>
            <p class="text">Tahunan</p>
          </div>
          <div class="pricing-list">
            <ul class="list">
              <li><i class="fas fa-check"></i> Software Only</li>
              <li><i class="fas fa-check"></i> Gratis Pengelolaan Data</li>
              <li><i class="fas fa-check"></i> Gratis Pelatihan Siswa Dan Guru</li>
              <li><i class="fas fa-check"></i> Gratis Perfotoan Siswa</li>
              <li><i class="fas fa-check"></i> Kartu Pelajar</li>
            </ul>
          </div>
          <div class="pricing-btn">
            <a href="https://wa.me/6282295844039?text=Haloo%20Gisaka%20Media%2C%20saya%20ingin%20berkonsultasi%20terkait%20aplikasi%20absensi%20dengan%20paket%20Basic" class="main-btn main-btn-2" target="_blank">Hubungi Kami</a>
          </div>
        </div>
      </div>

      <!-- Paket Standard -->
      <div class="col-lg-3 col-md-6 col-sm-9">
        <div class="single-pricing text-left wow fadeInUp" data-wow-duration="3s" data-wow-delay="0.4s" style="min-height: 500px;">
          <div class="pricing-title">
            <h4 class="title">Standard</h4>
          </div>
          <div class="pricing-price">
            <span class="pricing">Rp 27.000 / Siswa.</span>
            <p class="text">Permanen <small><a href="#syarat-ketentuan" style="font-size: 12px;">(S&K berlaku)</a></small></p>
          </div>
          <div class="pricing-list">
            <ul class="list">
              <li><i class="fas fa-check"></i> Semua fitur Basic</li>
              <li><i class="fas fa-check"></i> Percetakan Kartu Siswa Otomatis</li>
              <li><i class="fas fa-check"></i> Kartu E-Pelajar</li>
              <li><i class="fas fa-check"></i> Foto Siswa</li>
              <li><i class="fas fa-check"></i> Gratis 1 Device Reader Rfid</li>
              <li><i class="fas fa-check"></i> Logo Custom</li>
            </ul>
          </div>
          <div class="pricing-btn">
            <a href="https://wa.me/6282295844039?text=Haloo%20Gisaka%20Media%2C%20saya%20ingin%20berkonsultasi%20terkait%20aplikasi%20absensi%20dengan%20paket%20Standard" class="main-btn main-btn-2" target="_blank">Hubungi Kami</a>
          </div>
        </div>
      </div>

      <!-- Paket Professional -->
      <div class="col-lg-3 col-md-6 col-sm-9">
        <div class="single-pricing text-left wow fadeInUp" data-wow-duration="3s" data-wow-delay="0.6s" style="min-height: 500px;">
          <div class="pricing-title">
            <h4 class="title">Professional</h4>
          </div>
          <div class="pricing-price">
            <span class="pricing">Rp 33.000 / Siswa</span>
            <p class="text">Permanent <small><a href="#syarat-ketentuan" style="font-size: 12px;">(S&K berlaku)</a></small></p>
          </div>
          <div class="pricing-list">
            <ul class="list">
              <li><i class="fas fa-check"></i> Semua fitur Standard</li>
              <li><i class="fas fa-check"></i> Bisa Di Instal di Server Sekolah</li>
              <li><i class="fas fa-check"></i> Gratis 5 Device Reader Rfid</li>
              <li><i class="fas fa-check"></i> Support prioritas</li>
            </ul>
          </div>
          <div class="pricing-btn">
            <a href="https://wa.me/6282295844039?text=Haloo%20Gisaka%20Media%2C%20saya%20ingin%20berkonsultasi%20terkait%20aplikasi%20absensi%20dengan%20paket%20Professional" class="main-btn main-btn-2" target="_blank">Hubungi Kami</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Syarat dan Ketentuan -->
    <div id="syarat-ketentuan" style="margin-top: 30px;">
      <h3>Syarat dan Ketentuan</h3>
      <p>Dalam paket Professional, "Permanent" hanya merujuk pada hardware, yaitu RFID reader yang disediakan dengan garansi 6 bulan terhitung sejak tanggal penerimaan.</p>
    </div>
  </div>
</div>
<!-- --------------Pricing Section End ------------ -->




 <!-- ----------- FAQ Section Start --------- -->
<section class="faq-section pt-120" data-scroll-index="5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-7">
        <div class="section-title text-center mb-60">
          <h1 class="mb-25 wow fadeInUp" data-wow-delay=".2s">Pertanyaan <span> yang Sering Diajukan</span></h1>
          <p class="mb-25 wow fadeInUp" data-wow-delay=".4s">Temukan jawaban untuk pertanyaan umum tentang sistem absensi kami.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="accordion wow fadeInLeftBig" id="accordionExample" data-wow-duration="3s" data-wow-delay="0.5s">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                  aria-expanded="true" aria-controls="collapseOne">
                  Apa metode absensi yang tersedia?
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Kami menawarkan berbagai metode absensi, termasuk GPS, RFID, dan barcode, untuk memastikan kehadiran siswa tercatat dengan akurat.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Bagaimana cara siswa melaporkan izin sakit?
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Siswa dapat melaporkan izin atau keperluan lain nya melalui walikelas lalu walikelas akan menginputkan perizinan tersebut melalui aplikasi absensi ini
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Seberapa akurat sistem absensi ini?
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Sistem kami dirancang dengan teknologi canggih, seperti GPS yang memiliki akurasi tinggi, sehingga memastikan pencatatan kehadiran yang tepat.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  Bagaimana cara mengakses rekapitulasi absensi?
                </button>
              </h2>
              <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Pengguna dapat mengakses rekapitulasi absensi melalui aplikasi dengan login ke akun mereka dan memilih opsi rekapitulasi di menu.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                  Apakah data absensi aman dan terjamin?
                </button>
              </h2>
              <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Ya, kami menggunakan enkripsi dan protokol keamanan untuk melindungi data absensi dan informasi pribadi siswa.
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="faq-image wow fadeInRightBig" data-wow-duration="3s" data-wow-delay="0.5s">
          <img src="<?php base_url()?>promo/img/faq/faq-img.svg" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>
 <!-- ----------- Partner Kami Section Start ------- -->
<div class="col-lg-12">
  <div class="footer-partners mt-50 text-center">
    <h4 class="title">Partner Kami</h4>
    <div class="partners-logo d-flex flex-wrap justify-content-center">
      <div class="p-2">
        <img src="<?php echo base_url()?>promo/img/header/logo/landapp-logo.png" alt="Partner Logo" class="img-fluid" style="max-width: 150px; margin: 10px;">
      </div>
      <div class="p-2">
        <img src="<?php echo base_url()?>promo/img/header/logo/lintasarta.jpeg" alt="Partner 1" class="img-fluid" style="max-width: 150px; margin: 10px;">
      </div>
      <div class="p-2">
        <img src="<?php echo base_url()?>promo/img/header/logo/megadata.png" alt="Partner 2" class="img-fluid" style="max-width: 150px; margin: 10px;">
      </div>
      <div class="p-2">
        <img src="<?php echo base_url()?>promo/img/header/logo/rsplumbon.png" alt="Partner 3" class="img-fluid" style="max-width: 150px; margin: 10px;">
      </div>
      <div class="p-2">
        <img src="<?php echo base_url()?>promo/img/header/logo/maangsari.png" alt="Partner 4" class="img-fluid" style="max-width: 150px; margin: 10px;">
      </div>
      <div class="p-2">
        <img src="<?php echo base_url()?>promo/img/header/logo/rancamulya.png" alt="Partner 5" class="img-fluid" style="max-width: 150px; margin: 10px;">
      </div>
      <div class="p-2">
        <img src="<?php echo base_url()?>promo/img/header/logo/supercoridor.png" alt="Partner 6" class="img-fluid" style="max-width: 150px; margin: 10px;">
      </div>
    </div>
  </div>
</div>
<!-- ----------- Partner Kami Section End ------- -->

<!-- ----------- Sekolah Kami Section Start ------- -->
<div class="col-lg-12">
  <div class="footer-partners mt-50 text-center">
    <h4 class="title">Sekolah Yang Sudah Memakai</h4>
    <div class="school-logo d-flex flex-wrap justify-content-center">
      <div class="p-2">
        <img src="<?php echo base_url()?>promo/img/sekolah/smkn1talaga.png" alt="SMKN 1 TALAGA" class="img-fluid" style="max-width: 150px; margin: 10px;">
      </div>
      <div class="p-2">
        <img src="<?php echo base_url()?>promo/img/sekolah/mts11majalengka.png" alt="MTSN 11 MAJALENGKA" class="img-fluid" style="max-width: 150px; margin: 10px;">
      </div>
      <!-- Tambahkan logo sekolah lain sesuai kebutuhan -->
    </div>
  </div>
</div>
<!-- ----------- Sekolah Kami Section End ------- -->


  <!-- ----------- Download Section Start ------- -->
  <section class="download-area pt-70 pb-40" data-scroll-index="6">
    <div class="container">
      <div class="row justify-content-center align-items-center">
        <div class="col-lg-6 col-md-9">
          <div class="download-image mt-50 wow fadeInLeftBig" data-wow-duration="3s" data-wow-delay="0.5s">
            <div class="download-shape-1"></div>
            <img src="<?php base_url()?>promo/img/download/download-app.png" alt="" class="image-3">
          </div>
        </div>
        <div class="col-lg-6">
  <div class="download-content mt-45 wow fadeInRightBig" data-wow-duration="3s" data-wow-delay="0.5s">
    <h1 class="title">Unduh dan Mulai Menggunakan!</h1>
    <p class="text">Dengan sistem absensi kami, Anda dapat memantau kehadiran siswa dengan mudah dan efisien. Unduh aplikasi sekarang dan nikmati fitur-fitur canggih yang kami tawarkan, termasuk absensi berbasis GPS, RFID, dan barcode.</p>
   
  </div>
</div>

      </div>
    </div>
  </section>
  <!-- ----------- Download Section End ------- -->
<!-- --------------Footer Section Start ------- -->
<footer class="footer-area">
  <div class="footer-shape shape-1"></div>
  <div class="footer-shape shape-2"></div>
  <div class="footer-shape shape-3"></div>
  <div class="footer-shape shape-4"></div>
  <div class="footer-shape shape-5"></div>
  <div class="footer-shape shape-6"></div>
  <div class="footer-widget pt-30 pb-80">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="footer-about mt-50">
            <a href="" class="logo">
              <img src="<?php base_url()?>promo/img/header/logo/landapp-logo.png" alt="">
            </a>
            <p class="text">Sistem absensi canggih kami membantu Anda memantau kehadiran siswa dengan akurasi tinggi.</p>
            <ul class="social">
              <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
              <li><a href="link-twitter"><i class="fab fa-twitter"></i></a></li>
              <li><a href="https://www.instagram.com/gisaka.media/"><i class="fab fa-instagram"></i></a></li>
              <li><a href="link-linkedin"><i class="fab fa-linkedin-in"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-5 col-md-6">
          <div class="footer-link d-flex flex-wrap">
            <div class="footer-link-wrapper mt-45">
              <div class="footer-title">
                <h4 class="title">Tautan Cepat</h4>
              </div>
              <ul class="link">
                <li><a href="">Beranda</a></li>
                <li><a href="">Fitur</a></li>
                <li><a href="">Tentang Kami</a></li>
                <li><a href="">Testimonial</a></li>
                <li><a href="">Harga</a></li>
                <li><a href="">Unduh</a></li>
              </ul>
            </div>
            <div class="footer-link-wrapper mt-45">
              <div class="footer-title">
                <h4 class="title">Dukungan</h4>
              </div>
              <ul class="link">
                <li><a href="">FAQ</a></li>
                <li><a href="">Kebijakan Privasi</a></li>
                <li><a href="">Syarat dan Ketentuan</a></li>
                <li><a href="">Legal</a></li>
                <li><a href="">Peta Situs</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="footer-contact mt-45">
            <div class="footer-title">
              <h4 class="title">Hubungi Gisaka Media</h4>
            </div>
            <ul class="contact-list">
              <li>
                <div class="contact-info">
                  <div class="info-content media-body">
                    <p class="text"><i class="fas fa-phone-alt"></i> 081-324-000-650</p>
                  </div>
                </div>
              </li>
              <li>
                <div class="contact-info">
                  <div class="info-content media-body">
                    <p class="text"><a href="mailto:info@gisaka.net"><i class="far fa-envelope"></i> info@gisaka.net</a></p>
                  </div>
                </div>
              </li>
              <li>
                <div class="contact-info">
                  <div class="info-content media-body">
                    <p class="text"><i class="fas fa-map-marker-alt"></i> Jl. Ahmad Kusumah No.59, Majalengka Wetan, Kec. Majalengka, Kabupaten Majalengka, Jawa Barat 45411</p>
                  </div>
                </div>
              </li>
              <li>
                <div class="contact-info">
                  <div class="info-content media-body">
                    <p class="text">Working Hours: Monday - Thursday: 8:00 - 17:00</p>
                  </div>
                </div>
              </li>
              <li>
                <div class="contact-info">
                  <div class="info-content media-body">
                    <p class="text">Technical Support: 24 Hours</p>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="copyright">
            <div class="copyright-text text-center">
              <p class="text">Copyright &#169; 2024 <a href="">Imam Dienul</a>. Semua hak dilindungi.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- --------------Footer Section End ------- -->






  <!-- ---- jquery Js ---- -->
  <script src="<?php base_url()?>promo/js/jquery-1.12.4.min.js"></script>
  <!-- -------- venobox js ------ -->
  <script type="text/javascript" src="<?php base_url()?>promo/js/venobox.min.js"></script>
  <!-- ---------- wow js ---------- -->
  <script src="<?php base_url()?>promo/js/wow.min.js"></script>
  <!-- ---------- tiny slider js --------- -->
  <script src="<?php base_url()?>promo/js/tiny-slider.js"></script>
  <!-- ---------- scrollit js ---------- -->
  <script src="<?php base_url()?>promo/js/scrollIt.min.js"></script>
  <!-- -------- font awsome js --------- -->
  <script src="<?php base_url()?>promo/js/all.js"></script>
  <!-- ---- Bootstrap Js ---- -->
  <script src="<?php base_url()?>promo/js/bootstrap.min.js"></script>
  <!-- ---- main js --- -->
  <script src="<?php base_url()?>promo/js/main.js"></script>
</body>

</html>