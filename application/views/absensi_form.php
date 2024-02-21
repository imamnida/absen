<?php

if ($this->session->userdata('userlogin')) // mencegah akses langsung tanpa login
{
    $users = $this->session->userdata('userlogin');
    $avatar = $this->session->userdata('avatar');
} else {
    //masuk tanpa login
    $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-remove\"></i> ANDA TERDETEKSI MENGGUNAKAN HP ANDA AKAN DI BERIKAN SANSI YANG BERAT</div>");
    redirect(base_url() . 'login');
}

// Simpan tindakan sebelumnya jika ada
$previousAction = isset($_POST['action']) ? $_POST['action'] : '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Absensi Barcdo</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="<?= base_url(); ?>vertical/assets/images/favicon.ico">
    <link href="<?= base_url(); ?>vertical/assets/plugins/animate/animate.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>vertical/assets/css/bootstrap-material-design.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>vertical/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>vertical/assets/css/style.css" rel="stylesheet" type="text/css">
    <style>
        .centered-alert {
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 90%;
            /* Adjust as needed */
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Absensi Barcode V2</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Begin page -->
    <div class="col-md-12 text-center mb-3">
        <h2>Welcome To Attendance System Barcode V2</h2>
    </div>
    <?php if (isset($message) && !empty($message)) : ?>
        <div class="alert alert-danger mb-1 centered-alert" role="alert">
            <p><?php echo $message; ?></p>
        </div>
    <?php endif; ?>

    <div class="wrapper-page">
        <div class="display-table">
            <div class="display-table-cell">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center pt-3"></div>
                                    <div class="px-3 pb-3">
                                        <form id="absensiForm" action="<?php echo site_url('absensi/absen'); ?>" method="post" onsubmit="submitForm()">
                                            <!-- Logo -->
                                            <div class="text-center">
                                                <img src="<?= base_url(); ?>vertical/assets/images/logo.png" alt="Logo" height="150">
                                            </div>
                                            <!-- Form Inputs -->
                                            <div class="form-group">
                                                <label for="action">Pilih Tindakan:</label>
                                                <select class="form-control" id="action" name="action" required>
                                                    <option value="masuk">Absen Masuk</option>
                                                    <option value="keluar">Absen Keluar</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="uid">UID:</label>
                                                <input type="text" class="form-control" name="uid" id="uid" required>
                                            </div>
                                            <input type="hidden" name="id_devices" value="1">
                                            <button type="submit" class="btn btn-primary">Absen</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery  -->
    <script src="<?= base_url(); ?>vertical/assets/js/jquery.min.js"></script>
    <script src="<?= base_url(); ?>vertical/assets/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>vertical/assets/js/bootstrap-material-design.js"></script>
    <script src="<?= base_url(); ?>vertical/assets/js/modernizr.min.js"></script>
    <script src="<?= base_url(); ?>vertical/assets/js/detect.js"></script>
    <script src="<?= base_url(); ?>vertical/assets/js/fastclick.js"></script>
    <script src="<?= base_url(); ?>vertical/assets/js/jquery.slimscroll.js"></script>
    <script src="<?= base_url(); ?>vertical/assets/js/jquery.blockUI.js"></script>
    <script src="<?= base_url(); ?>vertical/assets/js/waves.js"></script>
    <script src="<?= base_url(); ?>vertical/assets/js/jquery.nicescroll.js"></script>
    <script src="<?= base_url(); ?>vertical/assets/js/jquery.scrollTo.min.js"></script>

    <!-- App js -->
    <script src="<?= base_url(); ?>vertical/assets/js/app.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Function to handle barcode scanning
            function handleBarcodeScan(event) {
                // Check if the Enter key is pressed (key code 13)
                if (event.keyCode === 13) {
                    // Move focus to the UID input field
                    document.getElementById("uid").focus();
                }
            }

            // Add event listener to the document to listen for barcode scans
            document.addEventListener("keydown", handleBarcodeScan);

            // Function to handle form submission
            function submitForm() {
                var action = document.getElementById("action").value;
                // Append the selected action to the form action URL
                document.getElementById("absensiForm").action = "<?php echo site_url('absensi/absen'); ?>/" + action;
                // Submit the form
                document.getElementById("absensiForm").submit();
            }

            // Add event listener to the form submit button
            document.getElementById("absensiForm").addEventListener("submit", function(event) {
                event.preventDefault(); // Prevent default form submission
                submitForm(); // Call the custom submitForm function
            });

            // Function to update action option based on previous action
            function updateActionOption() {
                var previousAction = "<?php echo $previousAction; ?>";
                var actionSelect = document.getElementById("action");
                var currentAction = actionSelect.value;

                // If previous action was "Keluar", set current action to "Masuk" by default
                if (previousAction === "keluar" && currentAction !== "keluar") {
                    actionSelect.value = "masuk";
                }
                // If previous action was "Masuk", set current action to "Keluar" by default
                else if (previousAction === "masuk" && currentAction !== "masuk") {
                    actionSelect.value = "keluar";
                }
            }

            // Call updateActionOption function when document is loaded
            updateActionOption();
        });
    </script>

</body>

</html>
