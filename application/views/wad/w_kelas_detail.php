<?php $this->load->view('include/w_header.php'); ?>
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
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="d-flex">
                            <h4 class="mt-0 header-title">Data Murid Kelas: <?= $kelas->kelas; ?></h4>
                            <a class="ml-auto" href="<?= base_url() ?>/wad/rekap_absen/<?= $kelas->id; ?>">
                                <button class="btn btn-primary">Rekap Absen</button>
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NISN</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Alamat</th>
                                        <th>Foto</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($murid)) { ?>
                                        <tr>
                                            <td colspan="7">Data tidak ditemukan</td>
                                        </tr>
                                    <?php } else {
                                        $no = 0;
                                        foreach ($murid as $row) {
                                            if (!empty($row->nama)) {
                                                $no++; ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $row->nisn; ?></td>
                                                    <td style="min-width:250px;"><?= $row->nama; ?></td>
                                                    <td><?= $row->kelas; ?></td>
                                                    <td style="min-width:250px;"><?= $row->alamat; ?></td>
                                                    <td>
                                                        <img src="<?= base_url(); ?>./uploads/<?= $row->foto; ?>" class="img-circle" width="auto" height="100px" alt="User Image">
                                                    </td>
                                                    <td style="min-width:100px;">
                                                        <a href="<?= base_url() ?>/wad/detail_murid/<?= $row->id_siswa; ?>" class="btn btn-success btn-sm">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                    <?php }
                                        }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('include/footer.php'); ?>
