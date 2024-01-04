<?php
$this->load->View('include/header.php');

?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Kelas
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-gears"></i> Data Kelas</a></li>
        <!-- <li class="active">Dashboard</li> -->
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <?php 
                            if (isset($message))
                            {
                        ?>
                            <div class="alert alert-success"><?php echo $message; ?></div>
                        <?php
                            } 
                        ?>
                        <h1 class="box-title">Rekapitulasi Absensi Kelas : <?php echo $kelas->kelas;?></h1>
                    </div>
                    <div class="box-body">
                      <form action="<?php site_url()?>rekapAbsen2excel" method="get">
                      <input type="hidden" name="id_kelas" value="<?php echo $kelas->id; ?>">
                      
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="tanggal" class="form-control pull-right" id="reservation">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-danger">Ambil Data Absensi </button>
                        </div>
                        </form>
                        <div class="row">
                            <div class="col-xs-6">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<?php
$this->load->view('include/footer.php');
?>

</div>  <!-- penutup header -->

<!-- jQuery 3 -->
<script src="<?=base_url();?>components/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url();?>components/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url();?>components/dist/js/adminlte.min.js"></script>

<!-- DataTables -->
<script src="<?=base_url();?>components/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>components/plugins/datatables/dataTables.bootstrap.min.js"></script>


<!-- date-range-picker -->
<script src="<?=base_url();?>components/bower_components/moment/min/moment.min.js"></script>
<script src="<?=base_url();?>components/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- page script -->
<script>
  $(function () {
    $("#t1").DataTable();
  });

  $(function () {
    //Date range picker
    $('#reservation').daterangepicker({
      maxSPan: {
          "days": 14
      },
    })
  })
</script>

</body>
</html>