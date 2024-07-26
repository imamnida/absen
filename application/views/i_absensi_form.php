<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Absensi | Barcode</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <link rel="shortcut icon" href="<?= base_url(); ?>vertical/assets/images/logo.png">
    <link href="<?= base_url(); ?>vertical/assets/plugins/animate/animate.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>vertical/assets/css/bootstrap-material-design.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>vertical/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>vertical/assets/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Absensi Barcode V2</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item">
    <span class="nav-link">Safety</span>
</li>
<li class="nav-item">
    <span class="nav-link">Fast</span>
</li>
<li class="nav-item">
    <span class="nav-link">Accurate</span>
</li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="col-md-12 text-center mb-3">
        <h2>Welcome To Attendance System Barcode V2</h2>
    </div>

    <div class="wrapper-page">
        <div class="display-table">
            <div class="display-table-cell">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center pt-3">
                                        <img src="<?= base_url(); ?>vertical/assets/images/logo.png" alt="Logo" height="150">
                                    </div>
                                    <?php if (isset($message) && !empty($message)) : ?>
                                        <div class="alert alert-dismissible fade show mt-3 <?= $message_type == 'success' ? 'alert-primary' : 'alert-danger'; ?>" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <strong><?= $message_type == 'success' ? 'Well done!' : 'Oh snap!'; ?></strong> <?php echo $message; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="px-3 pb-3">
                                        <form id="absensiForm" action="<?php echo site_url('absensi/absen'); ?>" method="post" onsubmit="return validateForm();">
                                            <div class="form-group">
                                                <label for="action">Pilih Tindakan:</label>
                                                <select class="form-control" id="action" name="action" required>
                                                    <option value="masuk">Absen Masuk</option>
                                                    <option value="keluar">Absen Keluar</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="uid">NIS:</label>
                                                <input type="text" class="form-control" name="uid" id="uid" required style="color: black;">
                                            </div>
                                            <input type="hidden" name="id_devices" value="1">
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

    <script>
        // Restore UID input value and focus after page reload
        var uidInput = document.getElementById("uid");
        var uidValue = uidInput.value;

        window.onload = function() {
            uidInput.value = uidValue;
            uidInput.focus();
            updateTime();
        };

        // Submit form on Enter key press
        uidInput.addEventListener("keypress", function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById("absensiForm").submit();
            }
        });

        // Update time every second
        function updateTime() {
            var currentTimeElement = document.getElementById("currentTime");
            if (currentTimeElement) {
                setInterval(function() {
                    var now = new Date();
                    currentTimeElement.textContent = now.toLocaleTimeString();
                }, 1000);
            }
        }
    </script>
</body>

</html>
