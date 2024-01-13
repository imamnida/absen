<?php
$this->load->View('include/atas.php');

?>

<main id="main" class="main">
<div class="pagetitle">
  <h1>Data Kelas</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url();?>admin/dashboard">Home</a></li>
      <li class="breadcrumb-item">Data</li>
      <li class="breadcrumb-item active">Kelas</li>
    </ol>
  </nav>
</div>
    
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Data Kelas</h5>
              <div class="row">
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
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Kelas</h5>
              <div class="box-body table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                  <th>No</th>
                  <th>Nama Kelas</th>
                  <th>Jumlah Murid</th>
                  <th>Aksi</th>
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
                   <a href="<?=base_url()?>admin/lihat_kelas?id_kelas=<?=$row->id?>" class="btn btn-success" title="Lihat Rekap"><i class="bi bi-eye"></i></a>
                   <a href="<?php site_url()?>hapus_kelas?id_kelas=<?=$row->id?>" class="btn btn-danger" onclick="return confirm('Anda Yakin menghapus data ini?')"><i class="bi bi-trash"></i></a>
                  </td>
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
$this->load->view('include/bawah.php');
?>
