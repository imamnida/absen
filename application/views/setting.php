<?php
$this->load->View('include/atas.php');

if ($set=="setting") {
  $skey = "";
  $waktumasuk = "";
  $waktukeluar = "";
  if (isset($waktuoperasional)) {
    foreach ($waktuoperasional as $d => $value) {
      if ($value->id_waktu_operasional == 1) {
        $waktumasuk = $value->waktu_operasional;
      }
      if ($value->id_waktu_operasional == 2) {
        $waktukeluar= $value->waktu_operasional;
      }
    }
  }
?>
<main id="main" class="main">
<div class="pagetitle">
  <h1>Setting</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url();?>admin/dashboard">Home</a></li>
      <li class="breadcrumb-item">setting</li>
      <li class="breadcrumb-item active">Waktu Oprasional</li>
    </ol>
  </nav>
</div>


<section class="section">
      <div class="row">
        <div class="col-mg-auto">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Setting Waktu Oprasional Absensi</h5>

              <!-- General Form Elements -->
              <?php echo $this->session->flashdata('pesan');?>
              <form action="<?=base_url();?>admin/setwaktuoperasional" method="post">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Waktu Masuk</label>
                  <div class="col-sm-10">
                  <input class="form-control" type="text" name="masuk" value="<?=$waktumasuk;?>" style="text-align:center;" placeholder="jam:menit-jam:menit">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Waktu Keluar</label>
                  <div class="col-sm-10">
                  <input class="form-control" type="text" name="keluar" value="<?=$waktukeluar;?>" style="text-align:center;" placeholder="jam:menit-jam:menit">
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                  <input class="btn btn-success"class="bi bi-check-circle" type="submit" value="set waktu operasional">
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>
    <!-- Main content -->
    
</main>
            <!-- /.box-header -->
            <?php
} 

$this->load->view('include/bawah.php');
?>