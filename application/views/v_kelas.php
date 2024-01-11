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
        <li><a href="#"><i class="fa fa-gears"></i> Data Alat</a></li>
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
                        <h1 class="box-title">Tambah Data Kelas</h1>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <form action="" method="POST">
                                    <label for="">Nama Kelas</label>
                                    <input type="text" name="kelas" required placeholder="Nama Kelas" class="form-control">
                                    <div style="margin-top:10px">
                                        <button class="btn btn-primary" type="submit">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h1 class="box-title">Data Kelas</h1>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="t1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="text-align:start">No</th>
                  <th style="text-align:start">Nama Kelas</th>
                  <th style="text-align:start">Jumlah Murid</th>
                  <th style="text-align:start">#</th>
                </tr>
                </thead>
                <tbody>
                <?php if(empty($kelas)){?>
                <tr>
                  <td>Data tidak ditemukan</td>
                  <td>Data tidak ditemukan</td>
                  <td>Data tidak ditemukan</td>
                  <td>Data tidak ditemukan</td>
                </tr>
                <?php } else{
                $no=0;
                foreach($kelas as $row){ $no++;?>
                <tr>
                  <td style="text-align:start"><?php echo $no;?></td>
                  <td style="text-align:start"><b class="text-primary"><?php echo $row->kelas;?></b></td>
                  <?php 
                  $jumlah_murid = $m_admin->count_murid($row->id);
                  ?>
                  <td style="text-align:start"><?php echo $jumlah_murid; ?></td>
                  <td style="text-align:start">
                   <a href="<?=base_url()?>admin/lihat_kelas?id_kelas=<?=$row->id?>" class="btn btn-success btn-sm" title="Lihat Rekap"><i class="fa fa-eye"></i></a>
                   <a href="<?php site_url()?>hapus_kelas?id_kelas=<?=$row->id?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>
                  </td>
                </tr>
                <?php }}?>
                
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
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
<!-- page script -->
<script>
  $(function () {
    $("#t1").DataTable();
  });
</script>

</body>
</html>