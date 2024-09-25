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
                            <li class="breadcrumb-item active">Detail Alfa</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Siswa 3 Hari Tidak Hadir</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            <?php if(!empty($siswa)): ?>
                <?php foreach($siswa as $murid): ?>
                    <div class="col-md-12 col-xl-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <img src="<?= base_url(); ?>./uploads/<?= $murid->foto ?>" class="foto-siswa" alt="Foto Murid">
                                    <div class="ml-3">
                                        <h1 class="mt-0 header-title"><?= $murid->nama; ?></h1>
                                        <hr>
                                        <div class="table-responsive">
                                            <p>NISN : <?= $murid->nisn; ?></p>
                                            <p>Kelas : <?= $murid->kelas; ?></p>
                                            <p>siswa UID : <?= $murid->uid; ?></p>
                                            <p>Alamat : <?= $murid->alamat; ?></p>
                                        </div>
                                    </div>
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

<style>
    .foto-siswa {
        max-width: 100px; /* Atur ukuran foto sesuai kebutuhan */
        height: auto;
        border-radius: 50%; /* Membuat foto bulat */
        border: 2px solid #000; /* Tambahkan border jika diinginkan */
    }

    .d-flex {
        display: flex;
        align-items: center;
    }

    .ml-3 {
        margin-left: 1rem;
    }
</style>
