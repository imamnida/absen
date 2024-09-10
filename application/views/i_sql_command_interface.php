<?php
$this->load->view('include/header.php');

if ($set == "sql_interface") {
?>
<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Database</a></li>
                            <li class="breadcrumb-item active">SQL Interface</li>
                        </ol>
                    </div>
                    <h4 class="page-title">SQL Command Interface</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">SQL Command Interface</h4>

                        <form id="sqlForm" action="<?= base_url(); ?>sql" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <textarea class="form-control" name="sql_query" rows="5" placeholder="Masukkan perintah SQL di sini"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="file" name="sql_file" class="form-control-file">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" onclick="confirmAction('execute_sql')">Execute</button>
                                <button type="button" class="btn btn-danger" onclick="confirmAction('drop_all_tables')">Drop All Tables</button>
                                <button type="button" class="btn btn-warning" onclick="confirmAction('truncate_all_tables')">Truncate All Tables</button>
                                <button type="button" class="btn btn-success" onclick="confirmAction('upload_database')">Upload Database</button>
                                <button type="button" class="btn btn-info" onclick="confirmAction('backup_database')">Backup Database</button>
                            </div>
                        </form>

                        <div class="output mt-4">
                            <?php echo $output; ?>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div><!-- container -->
</div> <!-- Page content Wrapper -->

<!-- Modal -->
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
                Apakah Anda yakin ingin <span id="confirmationMessage"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmButton">Lanjutkan</button>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmAction(actionName) {
        var actionDescription = {
            'execute_sql': 'Jalankan Perintah SQL',
            'drop_all_tables': 'DROP Semua Tabel',
            'truncate_all_tables': 'Kosongkan Semua Tabel',
            'upload_database': 'Unggah Database',
            'backup_database': 'Backup Database'
        };

        var confirmationMessage = (actionDescription[actionName] || 'melakukan tindakan ini');
        document.getElementById('confirmationMessage').innerText = confirmationMessage;
        $('#confirmationModal').modal('show');

        document.getElementById('confirmButton').onclick = function() {
            var form = document.getElementById('sqlForm');
            var hiddenField = document.createElement('input');
            hiddenField.type = 'hidden';
            hiddenField.name = actionName;
            hiddenField.value = 'true';
            form.appendChild(hiddenField);
            form.submit();
        };
    }
</script>

<?php
}

$this->load->view('include/footer.php');
?>
