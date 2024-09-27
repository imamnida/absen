<?php
$this->load->view('include/header.php');

if ($set == "siswa") {
?>
  <div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">siswa</a></li>
                            <li class="breadcrumb-item active">Data</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Siswa</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- end page title end breadcrumb -->
        <?php echo "<br>"; echo $this->session->flashdata('pesan'); ?>
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Siswa</h4>
                        <!-- Form to generate all cards -->
                        <form method="post" action="<?= base_url('card/generate_cards'); ?>" style="display:inline;">
                            <input type="hidden" name="cetak_semua" value="1">
                            <!-- Check if $row is set before using it -->
                            <?php if (isset($row)) { ?>
                                <input type="hidden" name="kelas_id" value="<?= $row->kelas ?>">
                            <?php } ?>
                            <button type="submit" class="btn btn-success">Cetak Semua Kartu</button>
                        </form>
                        <table id="datatable-buttons" class="table table-striped table-bordered w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>UID siswa</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Alamat</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($siswa)) { ?>
                                    <tr>
                                        <td colspan="9">Data tidak ditemukan</td>
                                    </tr>
                                <?php } else {
                                    $no = 0;
                                    foreach ($siswa as $item) {
                                        if ($item->nama != "") {
                                            $no++;
                                ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $item->nisn; ?></td>
                                                <td><?php echo $item->uid; ?></td>
                                                <td><?php echo $item->nik; ?></td>
                                                <td><?php echo $item->nama; ?></td>
                                                <td><?php echo $item->kelas; ?></td>
                                                <td><?php echo $item->alamat; ?></td>
                                                <td>
                                                    <img src="<?= base_url(); ?>uploads/<?php echo $item->foto; ?>" class="img-circle" width="auto" height="100px" alt="User Image">
                                                </td>
                                                <td>
                                                    <a href="<?= base_url() ?>/siswa/edit_siswa/<?= $item->id_siswa ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div><!-- container -->
</div> <!-- Page content Wrapper -->


<?php
} else if ($set == "edit-siswa") {
?>
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">siswa</a></li>
                                <li class="breadcrumb-item active">siswa Edit</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit siswa</h4>
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
                                <form role="form" action="<?= base_url(); ?>siswa/save_edit_siswa" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <input type="hidden" name="id" value="<?php if (isset($id)) { echo $id; } ?>">

                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php if (isset($nama)) { echo $nama; } ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label>NISN</label>
                                            <input type="text" name="nisn" class="form-control" placeholder="NISN" value="<?php if (isset($nisn)) { echo $nisn; } ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>NIK</label>
                                            <input type="number" name="nik" class="form-control" placeholder="NIK" value="<?php if (isset($nik)) { echo $nik; } ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Kelas</label>
                                            <select name="kelas_id" class="form-control">
                                                <?php foreach ($list_kelas as $kls) { ?>
                                                    <option <?php if ($kelas != null && $kls->id == $kelas->id) { ?> selected <?php } ?> value="<?php echo $kls->id; ?>"><?php echo $kls->kelas; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="<?php if (isset($alamat)) { echo $alamat; } ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Tempat, Tanggal Lahir</label>
                                            <input type="text" name="tanggal_lahir" class="form-control" placeholder="Tempat, Tanggal Lahir" value="<?php if (isset($tanggal_lahir)) { echo $tanggal_lahir; } ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="foto">Foto:</label>
                                            <input class="form-control" type="file" name="foto" id="foto">
                                            <small class="form-text text-muted">Upload foto Anda di sini. Biarkan kosong jika tidak ingin mengubah foto.</small>
                                            <?php if (!empty($foto)) { ?>
                                                <img src="<?= base_url(); ?>uploads/<?php echo $foto; ?>" alt="Foto Saat Ini" style="width: 100px; height: auto;">
                                            <?php } ?>
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
            </div> <!-- end row -->
        </div><!-- container -->
    </div>
<?php
} else if ($set == "new") { ?>
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">siswa</a></li>
                                <li class="breadcrumb-item active">New</li>
                            </ol>
                        </div>
                        <h4 class="page-title">siswa</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- end page title end breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title"><a href="<?= current_url(); ?>" class="btn btn-info mt-2">
        <i class="fa fa-refresh"></i> Perbarui
    </a></h4>
                            <table id="datatable-buttons" class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>UID siswa</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($siswa)) { ?>
                                        <tr>
                                            <td colspan="9">siswa baru tidak ditemukan</td>
                                        </tr>
                                    <?php } else {
                                        $no = 0;
                                        foreach ($siswa as $row) {
                                            // Check if any required field is empty
                                            if (empty($row->nama) || empty($row->nik) || empty($row->kelas)) {
                                                $no++;
                                    ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $row->uid; ?></td>
                                                    <td>
                                                        <a href="<?= base_url() ?>/siswa/edit_siswa/<?= $row->id_siswa ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> Daftarkan Siswa</a>
                                                    </td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
$this->load->view('include/footer.php');
?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#example').DataTable();
    });
</script>
