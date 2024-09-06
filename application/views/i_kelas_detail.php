<?php $this->load->view('include/header.php'); ?>

<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Daftar Kelas</a></li>
                            <li class="breadcrumb-item active"><?= $kelas->kelas; ?></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Detail Kelas</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mt-0 header-title">Data Murid Kelas: <?= $kelas->kelas; ?></h4>
                            <div>
                                <a href="<?= base_url(); ?>/admin/rekap_absen/<?= $kelas->id; ?>" class="btn btn-primary">Rekap Absen</a>
                                <form method="post" action="<?= base_url('cardcontroller/generate_cards'); ?>" style="display:inline;">
                                    <input type="hidden" name="cetak_semua" value="1">
                                    <input type="hidden" name="kelas_id" value="<?= $kelas->id; ?>">
                                    <button type="submit" class="btn btn-success">Cetak Semua Kartu</button>
                                </form>
                               
                            </div>
                        </div>

                        <form method="post" action="<?= base_url('cardcontroller/generate_cards'); ?>">
                            <table id="datatable-buttons" class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Foto</th>
                                        <th>.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($murid)) { ?>
                                        <tr>
                                            <td colspan="4" class="text-center">Data tidak ditemukan</td>
                                        </tr>
                                    <?php } else {
                                        $no = 1;
                                        foreach ($murid as $row) {
                                            if ($row->nama != "") { ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $row->nama; ?></td>
                                                    <td>
                                                        <img src="<?= base_url(); ?>uploads/<?= $row->foto; ?>" class="img-circle" width="auto" height="80px" alt="Foto Murid">
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url(); ?>/admin/detail_murid/<?= $row->id_rfid; ?>" class="btn btn-success btn-sm">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="<?= base_url(); ?>/admin/hapus_murid/<?= $row->id_rfid; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus murid ini?');">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                    <?php }
                                        }
                                    } ?>
                                </tbody>
                            </table>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php $this->load->view('include/footer.php'); ?>
