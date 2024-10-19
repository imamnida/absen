<?php
$this->load->view('include/header.php');

if ($set == "absensi") {
?>
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#">Absensi</a></li>
                                <li class="breadcrumb-item"><a href="#">Siswa</a></li>
                                <li class="breadcrumb-item active">Absensi Siswa</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Absensi</h4>
                    </div>
                </div>
            </div>

            <!-- Absensi Masuk Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title"><b>Absensi Masuk</b> <b class="text-danger"><?= date("d M Y", time()); ?></b></h4>

                            <table id="absensiMasukTable" class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Oleh</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Keterangan</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($absensimasuk)): ?>
                                        <tr>
                                            <td colspan="6">Data tidak ditemukan</td>
                                        </tr>
                                    <?php else:
                                        $no = 0;
                                        foreach ($absensimasuk as $row): $no++; ?>
                                            <tr>
                                                <td><b class="text-success"><?= $no; ?></b></td>
                                                <td><?= $row->nama_devices; ?> (<?= $row->id_devices; ?>)</td>
                                                <td><?= $row->nama; ?></td>
                                                <td><?= ($row->id_kelas != null) ? $m_data->find_kelas($row->id_kelas)->kelas : "-"; ?></td>
                                                <td><?= $row->keterangan; ?></td>
                                                <td><?= date("H:i:s - d M Y", $row->created_at); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Absensi Keluar Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title"><b>Absensi Keluar</b> <b class="text-danger"><?= date("d M Y", time()); ?></b></h4>

                            <table id="absensiKeluarTable" class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Oleh</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Keterangan</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($absensikeluar)): ?>
                                        <tr>
                                            <td colspan="6">Data tidak ditemukan</td>
                                        </tr>
                                    <?php else:
                                        $no = 0;
                                        foreach ($absensikeluar as $row): $no++; ?>
                                            <tr>
                                                <td><b class="text-success"><?= $no; ?></b></td>
                                                <td><?= $row->nama_devices; ?> (<?= $row->id_devices; ?>)</td>
                                                <td><?= $row->nama; ?></td>
                                                <td><?= ($row->id_kelas != null) ? $m_data->find_kelas($row->id_kelas)->kelas : "-"; ?></td>
                                                <td><?= $row->keterangan; ?></td>
                                                <td><?= date("H:i:s - d M Y", $row->created_at); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div> <!-- page-content-wrapper -->

<?php } ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
// Function to update the table with new data
function updateTable(tableId, data) {
    var table = $(tableId + ' tbody');
    table.empty();
    if (data.length > 0) {
        $.each(data, function (index, item) {
            table.append('<tr>' +
                '<td><b class="text-success">' + (index + 1) + '</b></td>' +
                '<td>' + item.nama_devices + ' (' + item.id_devices + ')</td>' +
                '<td>' + item.nama + '</td>' +
                '<td>' + item.kelas + '</td>' +
                '<td>' + item.keterangan + '</td>' +
                '<td>' + new Date(item.created_at * 1000).toLocaleString() + '</td>' +
                '</tr>');
        });
    } else {
        table.append('<tr><td colspan="6">Data tidak ditemukan</td></tr>');
    }
}

// Set up SSE
var evtSource = new EventSource('<?= site_url("absensi/sse_updates"); ?>');

evtSource.onmessage = function(event) {
    var data = JSON.parse(event.data);
    updateTable('#absensiMasukTable', data.absensimasuk);
    updateTable('#absensiKeluarTable', data.absensikeluar);
};

evtSource.onerror = function(err) {
    console.error("EventSource failed:", err);
};
</script>

<?php
$this->load->view('include/footer.php');
?>