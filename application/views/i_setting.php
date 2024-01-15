<?php
$this->load->View('include/header.php');

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
 <div class="page-content-wrapper ">

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Device</a></li>
                        <li class="breadcrumb-item active">Setiing</li>
                    </ol>
                </div>
                <h4 class="page-title">Setting Oprasional</h4>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- end page title end breadcrumb -->
                                                    <div class="row">
                                                        <div class="col-md-12 col-xl-12">
                                                            <div class="card m-b-30">
                                                                <div class="card-body">
                                                                    <h4 class="mt-0 header-title">Setting</h4>
                                                                    <div class="general-label">
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
                                                        </div> <!-- end col -->
            
                                                                     

                        </div><!-- container -->

                    </div> <!-- Page content Wrapper -->

                </div> <!-- content -->
                <?php
} 

$this->load->view('include/footer.php');
?>