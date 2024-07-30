<?php
$this->load->view('include/header.php');

if ($set == "setting") {
    // Initialize variables
    $skey = "";
    $waktumasuk = "";
    $waktukeluar = "";

    // Check and set operational times if available
    if (isset($waktuoperasional)) {
        foreach ($waktuoperasional as $value) {
            if ($value->id_waktu_operasional == 1) {
                $waktumasuk = $value->waktu_operasional;
            }
            if ($value->id_waktu_operasional == 2) {
                $waktukeluar = $value->waktu_operasional;
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
                            <li class="breadcrumb-item active">Setting</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Setting Operational Time</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- End Page Title and Breadcrumb -->
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card mb-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Setting</h4>
                        <div class="general-label">
                            <?php echo $this->session->flashdata('pesan'); ?>
                            <form action="<?= base_url(); ?>admin/setwaktuoperasional" method="post" id="settingsForm">
                                <div class="row mb-3">
                                    <label for="inputMasuk" class="col-sm-2 col-form-label">Waktu Masuk</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="masuk" value="<?= $waktumasuk; ?>" style="text-align:center;" placeholder="jam:menit-jam:menit" id="inputMasuk">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputKeluar" class="col-sm-2 col-form-label">Waktu Keluar</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="keluar" value="<?= $waktukeluar; ?>" style="text-align:center;" placeholder="jam:menit-jam:menit" id="inputKeluar">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <input class="btn btn-success" type="submit" value="Set Waktu Operasional">
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
}

$this->load->view('include/footer.php');
?>

<!-- Confirmation Modal HTML -->
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
