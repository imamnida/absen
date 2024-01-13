<?php
$this->load->View('include/atas.php');

if ($set=="histori") {
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Histori Device</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url();?>admin/dashboard">Home</a></li>
      <li class="breadcrumb-item">Histori</li>
      <li class="breadcrumb-item active">Device</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Histori Device</h5>
          
          <div class="box-body table-responsive">
          <table class="table datatable">
            <thead>
              <tr>
                <th>ID Histori</th>
                <th>UID RFID</th>
                <th>Keterangan</th>
                <th>Nama Device</th>
                <th>Waktu</th>
                
              </tr>
            </thead>
            <tbody>
            <?php if(empty($histori)){?>
                <tr>
                  <td>Data tidak ditemukan</td>
                  <td>Data tidak ditemukan</td>
                  <td>Data tidak ditemukan</td>
                  <td>Data tidak ditemukan</td>
                  <td>Data tidak ditemukan</td>
                </tr>
                <?php } else{
                foreach($histori as $row){ ?>
                <tr>
                  <td><b class="text-success"><?php echo $row->id_histori;?></b></td>
                  <td><?php echo $row->uid;?></td>
                  <td><?php echo $row->keterangan;?></td>
                  <td><?php echo $row->nama_devices;?> (<?php echo $row->id_devices;?>)</td>
                  <td><?php echo date("d M Y, H:i:s",$row->waktu);?></td>
                </tr>
                <?php }}?>
               </tbody>
          </table>
          <!-- End Table with stripped rows -->

        </div>
                </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->
<?php
} 

$this->load->view('include/bawah.php');
?>