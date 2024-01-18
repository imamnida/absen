<?php
$this->load->View('include/header.php');

if ($set=="rfid") {
?>
 <div class="page-content-wrapper ">

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Tables</a></li>
                        <li class="breadcrumb-item active">Datatable</li>
                    </ol>
                </div>
                <h4 class="page-title">Datatable</h4>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- end page title end breadcrumb -->
    <?php echo "<br>"; echo $this->session->flashdata('pesan');?>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">            
                    <h4 class="mt-0 header-title">RFID Data</h4>
                               
                    <table id="datatable-buttons" class="table table-striped table-bordered w-100">
                        <thead>
                        <tr>
                        <th>No</th>
                  <th>Nis</th>
                  <th>UID RFID</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Telp</th>
                  <th>Gender</th>
                  <th>Alamat</th>
                  <th>Foto</th>
                  <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if(empty($rfid)){?>
                  <tr>
                    <td colspan="9">Data tidak ditemukan</td>
                  </tr>
                <?php } else {
                  $no = 0;
                  foreach($rfid as $row){ 
                    if ($row->nama != "") {
                      $no++;
                ?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $row->nis;?></td>
                  <td><b class="text-success"><?php echo $row->uid;?></b></td>
                  <td><?php echo $row->nama;?></td>
                  <?php
                    $kelas = $row->kelas;
                  ?>
                  <td><?php echo $kelas;?></td>
                  <td><?php echo $row->telp;?></td>
                  <td><?php echo $row->gender;?></td>
                  <td><?php echo $row->alamat;?></td>
                  <td>
                    <?php
                      if (!empty($row->foto)) {
                        echo '<img src="' . $row->foto . '" alt="Foto Siswa" style="width: 100px; height: auto;">';
                      } else {
                        echo 'Tidak ada foto';
                      }
                    ?>
                  </td>
                  <td>
                    <a href="<?=base_url()?>/admin/edit_rfid/<?=$row->id_rfid?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                  </td>
                </tr>
                <?php }}}?>
                        </tbody>
                    </table>            
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

</div><!-- container -->

</div> <!-- Page content Wrapper -->

</div> <!-- content -->
<?php
} else if ($set=="edit-rfid") {
?>
<div class="page-content-wrapper ">

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">RFID</a></li>
                        <li class="breadcrumb-item active">RFID Edit</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit RFID</h4>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <h4 class="mt-0 header-title">General Form</h4>
                    <div class="general-label">
                    <form role="form" action="<?=base_url();?>admin/save_edit_rfid" method="post">              
              <div class="box-body">
                <div class="form-group">
                  <input type="hidden" name="id" value="<?php if(isset($id)){echo $id;}?>">
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control" placeholder="nama" value="<?php if(isset($nama)){echo $nama;}?>" required>
                </div>
                <div class="form-group">
                  <label>Nis</label>
                  <input type="text" name="nis" class="form-control" placeholder="Nis" value="<?php if(isset($nis)){echo $nis;}?>" required>
                </div>
                <div class="form-group">
                  <label>Telp</label>
                  <input type="text" name="telp" class="form-control" placeholder="telp" value="<?php if(isset($telp)){echo $telp;}?>" required>
                </div>
                <div class="form-group">
                  <label>Gender</label>
                  <input type="text" name="gender" class="form-control" placeholder="gender" value="<?php if(isset($gender)){echo $gender;}?>" required>
                </div>
                <div class="form-group">
                  <label>Kelas</label>
                  <select name="kelas_id" class="form-control">
                    <?php
                      foreach ($list_kelas as $kls) {
                    ?>
                      <option <?php if($kelas != null && $kls->id == $kelas->id){ ?> selected <?php } ?> value="<?php echo $kls->id; ?>"><?php echo $kls->kelas; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <input type="text" name="alamat" class="form-control" placeholder="alamat" value="<?php if(isset($alamat)){echo $alamat;}?>" required>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>              
            </form>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <?php
} else if ($set=="new") {
?>
 <div class="page-content-wrapper ">

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">RFID</a></li>
                        <li class="breadcrumb-item active">New</li>
                    </ol>
                </div>
                <h4 class="page-title">RFID</h4>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">            
                    <h4 class="mt-0 header-title">Buttons example</h4>
                               
                    <table id="datatable-buttons" class="table table-striped table-bordered w-100">
                        <thead>
                        <tr>
                        <th>No</th>
                  <th>UID RFID</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Telp</th>
                  <th>Gender</th>
                  <th>Alamat</th>
                  <th>#</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if(empty($rfid)){?>
                  <tr>
                    <td colspan="8">Data tidak ditemukan</td>
                  </tr>
                <?php } else {
                  $no = 0;
                  foreach($rfid as $row){ 
                    if ($row->nama == "") {
                      $no++;
                ?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><b class="text-success"><?php echo $row->uid;?></b></td>
                  <td><?php echo $row->nama;?></td>
                  <?php
                    $kelas = $row->kelas;
                  ?>
                  <td><?php echo $kelas;?></td>
                  <td><?php echo $row->telp;?></td>
                  <td><?php echo $row->gender;?></td>
                  <td><?php echo $row->alamat;?></td>
                  <td>
                    <a href="<?=base_url()?>admin/edit_rfid/<?=$row->id_rfid?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                    <a href="<?=base_url()?>admin/hapus_rfid/<?=$row->id_rfid?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>
                  </td>
                </tr>
                <?php }}}?>
                        </tr>
                        </tbody>
                    </table>            
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

</div><!-- container -->

</div> <!-- Page content Wrapper -->

</div> <!-- content -->
<?php
}

$this->load->view('include/footer.php');
?>
