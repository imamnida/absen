<?php
$this->load->view('include/header.php');

if ($set == "absensi") {
    ?>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Absensi
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?=base_url();?>admin/absensi"><i class="fa fa-book"></i> Absensi</a></li>
            </ol>
        </section>
        <section class="content">
            <?php
            $dataSets = [
                'Absensi Masuk' => $absensimasuk,
                'Absensi Keluar' => $absensikeluar
            ];

            foreach ($dataSets as $title => $data) :
            ?>
                <div class="box">
                    <div class="box-header">
                        <?php echo "<br>"; echo $this->session->flashdata('pesan');?>
                        <h1 class="box-title"><b><?= $title; ?></b> <b class="text-danger"><?= date("d M Y",time());?></b></h1>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped">
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
            <?php endforeach;?>
        </section>
    </div>
<?php
}

$this->load->view('include/footer.php');
?>
</div>

<!-- Scripts (beberapa bagian telah dihapus untuk kesingkatan) -->
<script src="<?=base_url();?>components/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?=base_url();?>components/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>components/dist/js/adminlte.min.js"></script>
<script src="<?=base_url();?>components/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>components/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url();?>components/bower_components/moment/min/moment.min.js"></script>
<script src="<?=base_url();?>components/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script>
    $(function () {
        $("table").DataTable();
    });
    $(function () {
        $('#reservation').daterangepicker()
    });
</script>
</body>
</html>
