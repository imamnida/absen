<?php
$this->load->view('include/header.php');

// Inisialisasi array hari tanpa Minggu
$days = ['Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];

// Inisialisasi array untuk menyimpan waktu operasional
$waktuOperasionalHari = [];

// Proses data waktu operasional berdasarkan hari
foreach ($days as $englishDay => $hari) {
    $waktuOperasionalHari[$englishDay] = ['masuk' => '', 'keluar' => ''];
    
    if (isset($waktuoperasional)) {
        foreach ($waktuoperasional as $value) {
            if ($value->day == $englishDay) {
                if ($value->keterangan == 'masuk') {
                    $waktuOperasionalHari[$englishDay]['masuk'] = $value->waktu_operasional;
                } else if ($value->keterangan == 'keluar') {
                    $waktuOperasionalHari[$englishDay]['keluar'] = $value->waktu_operasional;
                }
            }
        }
    }
}
?>
<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Device</a></li>
                            <li class="breadcrumb-item active">Setting Waktu Operasional</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Setting Waktu Operasional</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <!-- Mulai menampilkan form per hari -->
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card mb-30">
                    <div class="card-body">
                      
                        <div class="general-label">
                            <?php echo $this->session->flashdata('pesan'); ?>
                            <form action="<?= base_url(); ?>setting/updateWaktuOperasional" method="post" id="settingsForm">

                                <!-- Loop untuk menampilkan form untuk setiap hari -->
                                <?php foreach ($days as $englishDay => $hari): ?>
                                    <div class="day-section">
                                        <h5> <?php echo $hari; ?></h5>
                                        
                                        <!-- Input Waktu Masuk -->
                                        <div class="row mb-3">
                                            <label for="inputMasuk_<?php echo $englishDay; ?>" class="col-sm-2 col-form-label">Waktu Masuk (<?php echo $hari; ?>)</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="masuk[<?php echo $englishDay; ?>]" value="<?= $waktuOperasionalHari[$englishDay]['masuk']; ?>" style="text-align:center;" placeholder="jam:menit-jam:menit" id="inputMasuk_<?php echo $englishDay; ?>">
                                            </div>
                                        </div>

                                        <!-- Input Waktu Keluar -->
                                        <div class="row mb-3">
                                            <label for="inputKeluar_<?php echo $englishDay; ?>" class="col-sm-2 col-form-label">Waktu Keluar (<?php echo $hari; ?>)</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="keluar[<?php echo $englishDay; ?>]" value="<?= $waktuOperasionalHari[$englishDay]['keluar']; ?>" style="text-align:center;" placeholder="jam:menit-jam:menit" id="inputKeluar_<?php echo $englishDay; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                <?php endforeach; ?>

                                <!-- Submit Button -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <input class="btn btn-success" type="submit" value="Set Semua Waktu Operasional">
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- End Col -->
        </div> <!-- End Row -->
    </div> <!-- End Container -->
</div> <!-- End Page Content Wrapper -->

<?php
$this->load->view('include/footer.php');
?>

<!-- Konfirmasi Modal HTML -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Tindakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin melanjutkan tindakan ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmButton">Lanjutkan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Function to show confirmation modal
        function showConfirmationModal(actionUrl) {
            $('#confirmationModal').modal('show');
            $('#confirmButton').attr('data-action-url', actionUrl);
        }

        // Handle form submission with confirmation
        $('#settingsForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting immediately
            showConfirmationModal($(this).attr('action'));
        });

        // Handle confirmation button click
        $('#confirmButton').click(function() {
            var actionUrl = $(this).attr('data-action-url');
            $('#settingsForm').attr('action', actionUrl).off('submit').submit();
        });
    });
</script>
