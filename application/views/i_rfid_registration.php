<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Daftar</title>
    <meta content="Admin Dashboard" name="description">
    <meta content="Mannatthemes" name="author">
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/logo.png">
    <link href="<?= base_url(); ?>assets/plugins/animate/animate.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets/css/bootstrap-material-design.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css">
    <style>
        .wrapper-page {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .card-body {
            padding: 20px;
        }
        .text-center img {
            height: 150px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        video, canvas {
            width: 100%;
            max-width: 400px;
            margin-top: 10px;
        }
    </style>
</head>
<body class="fixed-left">
    <div class="accountbg"></div>
    <div class="wrapper-page">
        <div class="container">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center pt-3">
                            <a href="#">
                                <img src="<?= base_url(); ?>assets/images/logo.png" alt="logo">
                            </a>
                        </div>
                        <div class="p-3">
                            <?php echo validation_errors(); ?>
                            <?php echo form_open_multipart('register/submit'); ?>
                                <div class="form-group">
                                    <label for="nama">Nama:</label>
                                    <small class="form-text text-muted">Contoh: IMAM DIENUL BAYAN</small>
                                    <input class="form-control" type="text" name="nama" id="nama" required placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label for="tempat_tanggal_lahir">Tempat, Tanggal Lahir:</label>
                                    <small class="form-text text-muted">Contoh: Majalengka, 29 Agustus 2005</small>
                                    <input class="form-control" type="text" name="tempat_tanggal_lahir" id="tempat_tanggal_lahir" required placeholder="Tempat, Tanggal Lahir">
                                </div>
                                <div class="form-group">
                                    <label for="kelas">Kelas:</label>
                                    <select class="form-control" id="kelas" name="id_kelas">
                                        <option value="">--Pilih Kelas--</option>
                                        <?php foreach ($kelas as $row): ?>
                                            <option value="<?= $row->id ?>"><?= $row->kelas ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nisn">NISN:</label>
                                    <small class="form-text text-muted">Contoh: 1212838392</small>
                                    <input class="form-control" type="text" name="nisn" id="nisn" required placeholder="NISN">
                                </div>
                                <div class="form-group">
                                    <label for="nisn">NIK:</label>
                                    <small class="form-text text-muted">Contoh: 1212838392</small>
                                    <input class="form-control" type="number" name="nik" id="nik" required placeholder="NIK">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat:</label>
                                    <small class="form-text text-muted">Contoh: Desa Cibeureum, Kec. Talaga, Kab. Majalengka</small>
                                    <input class="form-control" type="text" name="alamat" id="alamat" required placeholder="Alamat">
                                </div>
                                <div class="form-group">
                                    <label for="foto">Foto:</label>
                                    <input class="form-control" type="file" name="foto" id="foto">
                                    <small class="form-text text-muted">Jika tidak ada foto, silakan gunakan kamera</small>
                                    <button type="button" class="btn btn-primary mt-2" id="openCamera">Buka Kamera</button>
                                    <video id="video" autoplay></video>
                                    <button type="button" class="btn btn-success mt-2" id="capturePhoto">Ambil Foto</button>
                                    <canvas id="canvas" style="display:none;"></canvas>
                                    <input type="hidden" name="captured_photo" id="capturedPhotoInput">
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Register</button>
                                </div>
                            <?php echo form_close(); ?>
                            <div class="form-group text-center">
                                <a href="#" class="text-muted">Already have an account?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/bootstrap-material-design.js"></script>
    <script src="<?= base_url(); ?>assets/js/app.js"></script>
    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const capturedPhotoInput = document.getElementById('capturedPhotoInput');

        document.getElementById('openCamera').addEventListener('click', function() {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    video.srcObject = stream;
                    video.style.display = 'block';
                })
                .catch(err => {
                    console.error('Error accessing camera: ', err);
                });
        });

        document.getElementById('capturePhoto').addEventListener('click', function() {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            const dataURL = canvas.toDataURL('image/png');
            capturedPhotoInput.value = dataURL;
            video.srcObject.getTracks().forEach(track => track.stop());
            video.style.display = 'none';
        });
    </script>
</body>
</html>
