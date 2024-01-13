<?php
if ($set == "dashboard") {
  $this->load->View('include/atas.php');
  

  $jmlrfid = 0;
  $jmlalat = 0;
  $jmlmasuk = 0;
  $jmlkeluar = 0;
  $jmlkelas = 0;

  if (isset($rfid)) {
    foreach ($rfid as $key => $value) {
      $jmlrfid++;
    }
  }
  if (isset($kelas)) {
    foreach ($kelas as $key => $value) {
      $kelas++;
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


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=base_url();?>admin/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-auto">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">RFID CARD </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?=$jmlrfid;?></h6>
                      <span class="text-success small pt-1 fw-bold">100%</span> <span class="text-muted small pt-2 ps-1">Active</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                

                <div class="card-body">
                  <h5 class="card-title">RFID Reader</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?=$jmlalat;?></h6>
                      <span class="text-success small pt-1 fw-bold">100%</span> <span class="text-muted small pt-2 ps-1">Active</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                

                <div class="card-body">
                  <h5 class="card-title">Siswa Masuk Hari Ini</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?=$jmlmasuk?></h6>
                      <span class="text-success small pt-1 fw-bold">65%</span> <span class="text-muted small pt-2 ps-1">Tidak Masuk</span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->
            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                

                <div class="card-body">
                  <h5 class="card-title">Data Kelas</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>ini di isi kelas</h6>
                     

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->
            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Barcode Scaner</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>2</h6>
                      <span class="text-success small pt-1 fw-bold">100%</span> <span class="text-muted small pt-2 ps-1">Active</span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->
            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">



                <div class="card-body">
                  <h5 class="card-title">Siswa Keluar Hari Ini<h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?=$jmlkeluar?></h6>
                      <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">Belum Pulang</span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->


           

            <!-- Recent Sales -->
           
<!-- Recent Sales -->
<div class="col-12">
  <div class="card recent-sales overflow-auto">
    <div class="card-body">
      <h5 class="card-title">Absensi Masuk Hari Ini</h5>

      <table class="table table-borderless datatable">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Alat</th>
            <th scope="col">Nama</th>
            <th scope="col">Kelas</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Waktu</th>
            <th scope="col">Foto</th>
          </tr>
        </thead>
        <tbody>
          <?php if(empty($absensimasuk)): ?>
            <tr>
              <td colspan="7">Data absensi masuk tidak ditemukan</td>
            </tr>
          <?php else: ?>
            <?php foreach($absensimasuk as $key => $row): ?>
              <tr>
                <td><?= $key + 1; ?></td>
                <td><?= $row->nama_devices; ?> (<?= $row->id_devices; ?>)</td>
                <td><?= $row->nama; ?></td>
                <?php
                $kelas = ($row->id_kelas != null) ? $m_admin->find_kelas($row->id_kelas) : ["kelas" => "-"];
                ?>
                <td><?= $kelas->kelas; ?></td>
                <td><?= $row->keterangan; ?></td>
                <td><?= date("H:i:s - d M Y", $row->created_at); ?></td>
                <td><img src="<?= $row->foto; ?>" width="150" height="auto" alt="img not found" /></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>

    </div>
  </div>
</div><!-- End Recent Sales -->



            
          </div>
        </div><!-- End Left side columns -->

        

      </div>
    </section>

  </main><!-- End #main -->

  
<?php
} 

$this->load->view('include/bawah.php');
?>
