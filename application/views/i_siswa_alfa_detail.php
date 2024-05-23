<?php $this->load->view('include/header.php'); ?>
<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('absensi') ?>">Daftar Kelas</a></li>
                            <li class="breadcrumb-item active">Detail Murid</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Detail Murid</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            <?php if(!empty($siswa)): ?>
                <?php foreach($siswa as $murid): ?>
                    <div class="col-md-3 col-xl-3">
                        <img src="<?= $murid->foto ?>" style="max-width:100%; margin:auto;" alt="Foto Murid">
                    </div>
                    <div class="col-md-9 col-xl-9">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h1 class="mt-0 header-title"><?= $murid->nama; ?></h1>
                                <hr>
                                <div class="table-responsive">
                                    <p>NIS : <?= $murid->nis; ?></p>
                                    <p>Kampus : <?= $murid->kampus; ?></p>
                                    <p>Kelas : <?= $murid->kelas; ?></p>
                                    <p>Telp. : <?= $murid->telp; ?></p>
                                    <p>RFID UID : <?= $murid->uid; ?></p>
                                    <p>Alamat : <?= $murid->alamat; ?></p>
                                </div>
                            </div>
                        </div>
                    </div> 
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h1 class="mt-0 header-title">Tidak ada murid yang tidak hadir selama 3 hari di kelas ini.</h1>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $this->load->view('include/footer.php'); ?>
