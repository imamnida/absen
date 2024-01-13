<?php
$this->load->view('include/atas.php');

if ($set == "absensi") {
    ?>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Absensi</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url();?>admin/dashboard">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">Data</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<?php
            $dataSets = [
                'Absensi Masuk' => $absensimasuk,
                'Absensi Keluar' => $absensikeluar
            ];

            foreach ($dataSets as $title => $data) :
            ?>
            <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><b><?= $title; ?></b> <b class="text-danger"><?= date("d M Y",time());?></b></h5>
              
              <div class="box-body table-responsive">
              <table class="table datatable">
                <thead>
                <tr>
                                    <th>No</th>
                                    <th>Alat</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Keterangan</th>
                                    <th>Waktu</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($data)):?>
                                    <tr>
                                        <td colspan="7">Data tidak ditemukan</td>
                                    </tr>
                                <?php else:
                                    $no = 0;
                                    foreach($data as $row): $no++;?>
                                        <tr>
                                            <td><b class="text-success"><?= $no;?></b></td>
                                            <td><?= $row->nama_devices;?> (<?= $row->id_devices;?>)</td>
                                            <td><?= $row->nama;?></td>
                                            <?php
                                            $kelas = ($row->id_kelas != null) ? $m_admin->find_kelas($row->id_kelas) : ["kelas" => "-"];
                                            ?>
                                            <td><?= $kelas->kelas;?></td>
                                            <td><?= $row->keterangan;?></td>
                                            <td><?= date("H:i:s - d M Y", $row->created_at);?></td>
                                            <td><img src="<?= $row->foto;?>" width="150" height="auto" alt="img not found" /></td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                                </div>
                </div>
            <?php endforeach;?>
        </section>
    </div>
    </main><!-- End #main -->
<?php
}
$this->load->view('include/bawah.php');
?>
</div>
 