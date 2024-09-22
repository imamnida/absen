<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Absensi</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/logo.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .bg-custom-pink { background-color: #FF4D6D; }
        .text-custom-pink { color: #FF4D6D; }
        .bg-custom-green { background-color: #4CAF50; }
    </style>
</head>

<body class="bg-gray-100">
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-3xl overflow-hidden mt-8">
        <div class="p-6 bg-custom-pink text-white flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">Selamat Siang</h1>
                <p class="text-3xl font-bold mt-2"><?= $this->session->userdata('nama'); ?></p>
            </div>
           
        </div>
        
        <div class="p-6">
            <div id="coordinates" class="text-center mb-4 font-bold"></div>
            <div id="range-message" class="text-center mb-4 font-bold text-green-600 hidden">
                Anda sedang berada pada jangkauan absensi
            </div>

            <div class="mb-6">
                <?php if (isset($message) && !empty($message)) : ?>
                    <div class="alert alert-dismissible fade show mt-3 <?= $message_type == 'success' ? 'bg-green-100 text-green-800' : ($message_type == 'warning' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800'); ?> p-4 rounded-lg" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong><?= $message_type == 'success' ? 'Well done!' : ($message_type == 'warning' ? 'Warning!' : 'Oh snap!'); ?></strong> <?= $message; ?>
                    </div>
                <?php endif; ?>
                <img src="<?= base_url(); ?>assets/images/logo.png" alt="Logo" class="h-30" style="display: block; margin: auto;">

                <form id="absensiForm" action="<?= site_url('absensi_hp/absen'); ?>" method="post" class="mt-4">
                    <div class="mb-4">
                        <label for="nisn" class="block text-gray-700 text-sm font-bold mb-2">NISN:</label>
                        <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="nisn" id="nisn" required value="<?= $this->session->userdata('nisn'); ?>" readonly>
                    </div>
                    <input type="hidden" name="id_devices" value="1">
                    <div class="grid grid-cols-2 gap-4">
                        <button type="button" class="w-full bg-custom-green text-white font-bold py-3 px-4 rounded-lg flex items-center justify-center" onclick="submitForm('masuk')">
                            <i class="fas fa-arrow-left mr-2"></i> Absen Masuk
                        </button>
                        <button type="button" class="w-full bg-custom-pink text-white font-bold py-3 px-4 rounded-lg flex items-center justify-center" onclick="submitForm('keluar')">
                            Absen Pulang <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div id="error-message" class="hidden bg-red-100 text-red-800 p-4 rounded-lg mt-3" role="alert"></div>

            <div class="mt-6">
                <h3 class="font-bold mb-2">Absensi Bulan Ini</h3>
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-purple-100 p-3 rounded-lg">
                        <i class="fas fa-calendar-check text-purple-500 mb-1"></i>
                        <p class="text-sm">Masuk</p>
                        <p class="font-bold"><?= $attendance_data['masuk'] ?> hari</p>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-lg">
                        <i class="fas fa-user-clock text-yellow-500 mb-1"></i>
                        <p class="text-sm">Izin</p>
                        <p class="font-bold"><?= $attendance_data['izin'] ?> hari</p>
                    </div>
                    <div class="bg-red-100 p-3 rounded-lg">
                        <i class="fas fa-procedures text-red-500 mb-1"></i>
                        <p class="text-sm">Sakit</p>
                        <p class="font-bold"><?= $attendance_data['sakit'] ?> hari</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function submitForm(action) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;

                const form = document.getElementById('absensiForm');
                
                ['latitude', 'longitude', 'action'].forEach(name => {
                    const existingInput = document.querySelector(`input[name="${name}"]`);
                    if (existingInput) {
                        existingInput.remove();
                    }
                });

                let latInput = document.createElement('input');
                latInput.type = 'hidden';
                latInput.name = 'latitude';
                latInput.value = userLat;
                form.appendChild(latInput);

                let lngInput = document.createElement('input');
                lngInput.type = 'hidden';
                lngInput.name = 'longitude';
                lngInput.value = userLng;
                form.appendChild(lngInput);

                let actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = 'action';
                actionInput.value = action;
                form.appendChild(actionInput);

                form.submit();
            }, () => {
                alert('Gagal mendapatkan lokasi Anda.');
            });
        } else {
            alert('Geolokasi tidak didukung oleh browser ini.');
        }
    }

    function updateCoordinates() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const lat = position.coords.latitude.toFixed(6);
                const lng = position.coords.longitude.toFixed(6);
                document.getElementById('coordinates').textContent = `Koordinat: ${lat}, ${lng}`;

                // Send coordinates to server to check if in range
                fetch('<?= site_url('absensi_hp/check_range'); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ latitude: lat, longitude: lng }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.inRange) {
                        document.getElementById('range-message').classList.remove('hidden');
                    } else {
                        document.getElementById('range-message').classList.add('hidden');
                    }
                });
            }, () => {
                document.getElementById('coordinates').textContent = 'Gagal mendapatkan koordinat';
            });
        } else {
            document.getElementById('coordinates').textContent = 'Geolokasi tidak didukung';
        }
    }

    // Update coordinates every 5 seconds
    updateCoordinates();
    setInterval(updateCoordinates, 5000);
    </script>

</body>

</html>