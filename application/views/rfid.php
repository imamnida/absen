<?php
$this->load->View('include/atas.php');

if ($set=="rfid") {
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Data Tables</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url();?>admin/dashboard">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">Data</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
 <section class="section">
      <div class="row">
        <div class="col-lg-12">
        <?php echo "<br>"; echo $this->session->flashdata('pesan');?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">RFID Data</h5>
             
              <div class="box-body table-responsive">
              <table class="table datatable">
              <thead>
                <tr>
                  <th style="text-align:center">No</th>
                  <th style="text-align:center">Nis</th>
                  <th style="text-align:center">UID RFID</th>
                  <th style="text-align:center">Nama</th>
                  <th style="text-align:center">Kelas</th>
                  <th style="text-align:center">Telp</th>
                  <th style="text-align:center">Gender</th>
                  <th style="text-align:center">Alamat</th>
                  <th style="text-align:center">Foto</th>
                  <th style="text-align:center">#</th>
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
                  <td style="text-align:center"><?php echo $no;?></td>
                  <td style="text-align:center"><?php echo $row->nis;?></td>
                  <td style="text-align:center"><b class="text-success"><?php echo $row->uid;?></b></td>
                  <td style="text-align:center"><?php echo $row->nama;?></td>
                  <?php
                    $kelas = "-";
                    if ($row->id_kelas != null) {
                      $kelas = $m_admin->find_kelas($row->id_kelas);
                      $kelas = $kelas->kelas;
                    }
                  ?>
                  <td style="text-align:center"><?php echo $kelas;?></td>
                  <td style="text-align:center"><?php echo $row->telp;?></td>
                  <td style="text-align:center"><?php echo $row->gender;?></td>
                  <td style="text-align:center"><?php echo $row->alamat;?></td>
                  <td style="text-align:center">
                    <?php
                      if (!empty($row->foto)) {
                        echo '<img src="' . $row->foto . '" alt="Foto Siswa" style="width: 100px; height: auto;">';
                      } else {
                        echo 'Tidak ada foto';
                      }
                    ?>
                  </td>
                  <td style="text-align:center">
                    <a href="<?=base_url()?>/admin/edit_rfid/<?=$row->id_rfid?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                  </td>
                </tr>
                <?php }}}?>
                </tbody>
              </table>
            </div>
          </div>
                    </div>
        </div>
      </div>
    </section>
  </div>
                    </main>
  <?php
} else if ($set=="edit-rfid") {
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Edit RFID</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url();?>admin/dashboard">Home</a></li>
      <li class="breadcrumb-item">RFID</li>
      <li class="breadcrumb-item active">RFID Edit</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
 <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <?php echo $this->session->flashdata('pesan');?>
              <h1 class="box-title"></h1>
            </div>
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
    </section>
  </div>
                    </main>
<?php
} else if ($set=="new") {
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Data Tables</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url();?>admin/dashboard">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">Data</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section">
      <div class="row">
        <div class="col-lg-12">
        <?php echo "<br>"; echo $this->session->flashdata('pesan');?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">RFID New</h5>
              <div class="box-body table-responsive">
              <table class="table datatable">
              <thead>
                <tr>
                  <th style="text-align:center">No</th>
                  <th style="text-align:center">UID RFID</th>
                  <th style="text-align:center">Nama</th>
                  <th style="text-align:center">Kelas</th>
                  <th style="text-align:center">Telp</th>
                  <th style="text-align:center">Gender</th>
                  <th style="text-align:center">Alamat</th>
                  <th style="text-align:center">#</th>
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
                  <td style="text-align:center"><?php echo $no;?></td>
                  <td style="text-align:center"><b class="text-success"><?php echo $row->uid;?></b></td>
                  <td style="text-align:center"><?php echo $row->nama;?></td>
                  <?php
                    $kelas = "-";
                    if ($row->id_kelas != null) {
                      $kelas = $m_admin->find_kelas($row->id_kelas);
                      $kelas = $kelas->kelas;
                    }
                  ?>
                  <td style="text-align:center"><?php echo $kelas;?></td>
                  <td style="text-align:center"><?php echo $row->telp;?></td>
                  <td style="text-align:center"><?php echo $row->gender;?></td>
                  <td style="text-align:center"><?php echo $row->alamat;?></td>
                  <td style="text-align:center">
                    <a href="<?=base_url()?>admin/edit_rfid/<?=$row->id_rfid?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                    <a href="<?=base_url()?>admin/hapus_rfid/<?=$row->id_rfid?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="glyphicon glyphicon-trash"></i></a>
                  </td>
                </tr>
                <?php }}}?>
                </tbody>
              </table>
            </div>
          </div>
                </div>
        </div>
      </div>
    </section>
  </div>
<?php
}

$this->load->view('include/bawah.php');
?>

