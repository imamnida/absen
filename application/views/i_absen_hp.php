<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Absensi</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/gi.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .bg-custom-purple { background-color: #6A0DAD; }
        .text-custom-purple { color: #6A0DAD; }
        .bg-custom-green { background-color: #4CAF50; }
        .dot {
            display: inline-block;
            height: 10px;
            width: 10px;
            border-radius: 0 0 10px 10px;

            margin-right: 10px;
        }
        .dot-green { background-color: green; }
        .dot-red { background-color: red; }
        .clock {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
        }
        .bottom-menu {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: white;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
        }
        .menu-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
            color: #718096;
        }
        .menu-item.active {
            color: #FF4D6D;
        }
        .page {
            display: none;
        }
        .page.active {
            display: block;
        }
        .hamburger-menu {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 1.5rem;
            color: white;
            cursor: pointer;
            z-index: 1000;
        }
        .back-arrow {
            position: absolute;
            top: 1rem;
            left: 1rem;
            font-size: 1.5rem;
            color: white;
            cursor: pointer;
            z-index: 1000;
            display: none;
        }
        .sidebar {
            position: fixed;
            top: 0;
            right: -300px;
            width: 300px;
            height: 100%;
            background-color: #6A0DAD;
            transition: right 0.3s ease-in-out;
            z-index: 1001;
            padding-top: 60px;
        }
        .sidebar.active {
            right: 0;
        }
        .sidebar-item {
            display: block;
            padding: 1rem 2rem;
            font-size: 1.2rem;
            color: white;
            text-decoration: none;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            transition: background-color 0.3s ease;
        }
        .nida {
            display: block;
            padding: 1rem 2rem;
            font-size: 1.2rem;
            color: white;
            text-decoration: none;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            transition: background-color 0.3s ease;
        }
        .sidebar-item:hover {
            background-color: rgba(255,255,255,0.1);
        }
        .sidebar-item:last-child {
            border-bottom: none;
        }
        .sidebar-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 1.5rem;
            color: white;
            cursor: pointer;
        }

        /* Desktop styles */
        @media (min-width: 1024px) {
            .container {
                max-width: 1200px;
                margin: auto;
            }
            .bg-custom-purple {
                padding: 20px;
                border-radius: 10px;
            }
            .max-w-md {
                max-width: 800px;
            }
            .grid-cols-2 {
                grid-template-columns: repeat(2, 1fr);
            }
            .grid-cols-3 {
                grid-template-columns: repeat(3, 1fr);
            }
            .p-6 {
                padding: 24px;
            }
            .clock {
                font-size: 3rem;
            }
            button {
                transition: all 0.3s ease;
            }
            button:hover {
                transform: scale(1.05);
            }
        }
    </style>
</head>

<body class="bg-gray-100 h-screen flex items-start pb-16">
<div class="container max-w-md mx-auto bg-white shadow-lg rounded-3xl overflow-hidden w-full mb-16 relative" style="border-radius: 0 0 10px 10px;">
        <div id="hamburger-menu" class="hamburger-menu">
            <i class="fas fa-bars"></i>
        </div>
        <div id="back-arrow" class="back-arrow">
            <i class="fas fa-arrow-left"></i>
        </div>

        <!-- Sidebar -->
        <div id="sidebar" class="sidebar">
            <div class="sidebar-close" id="sidebar-close">
                <i class="fas fa-times"></i>
            </div>
            <img src="<?= base_url(); ?>assets/images/logo.png" alt="Logo" class="h-16 lg:h-24" style="position: relative; left:22px;">
            <a href="#" class="sidebar-item" data-page="home">Home</a>
            <a href="#" class="sidebar-item" data-page="tutorial">Tutorial</a>
            <a href="#" class="sidebar-item" data-page="profile">Profile</a>
            <a href="#" class="sidebar-item">Settings</a>
            <a href="<?= base_url(); ?>siswa/logout" class="nida">Logout</a>
        </div>

        <!-- Home Page -->
        <div id="home" class="page active">
            <div class="p-6 bg-custom-purple text-white flex justify-between items-center">
                <div>
                    <h1 class="text-2xl lg:text-3xl font-bold">Selamat Siang</h1>
                    <p class="text-3xl lg:text-4xl font-bold mt-2"><?= $this->session->userdata('nama'); ?></p>
                </div>
                <img src="<?= base_url(); ?>assets/images/logo.png" alt="Logo" class="h-16 lg:h-24" style="position: relative; right: 15px;">


            </div>
            
            <div class="p-6">
                <div class="flex justify-center items-center mb-4">
                    <span id="range-dot" class="dot dot-red"></span>
                    <div id="coordinates" class="text-center font-bold"></div>
                </div>
                <div id="range-message" class="text-center mb-4 font-bold text-green-600 hidden"></div>

                <div class="mb-6">
                    <?php if (isset($message) && !empty($message)) : ?>
                        <div class="alert alert-dismissible fade show mt-3 <?= $message_type == 'success' ? 'bg-green-100 text-green-800' : ($message_type == 'warning' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800'); ?> p-4 rounded-lg" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong><?= $message_type == 'success' ? 'Well done!' : ($message_type == 'warning' ? 'Warning!' : 'Oh snap!'); ?></strong> <?= $message; ?>
                        </div>
                    <?php endif; ?>

                    <div id="clock" class="clock mb-4"></div>
                    <div class="p-6">
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
                                <button type="button" class="w-full bg-custom-purple text-white font-bold py-3 px-4 rounded-lg flex items-center justify-center" onclick="submitForm('keluar')">
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
        </div>

        <!-- Tutorial Page -->
        <div id="tutorial" class="page">
            <div class="p-6 bg-custom-purple text-white">
                <h1 class="text-2xl lg:text-3xl font-bold">Tutorial Absensi</h1>
            </div>
            <div class="p-6">
                <h2 class="text-xl font-bold mb-4">Cara Menggunakan Sistem Absensi</h2>
                <p class="mb-2">Berikut adalah langkah-langkah untuk melakukan absensi:</p>
                <ol class="list-decimal pl-5 mb-4">
                    <li><strong>Buka Aplikasi:</strong> Masuk ke aplikasi absensi menggunakan akun Anda.</li>
                    <li><strong>Pilih Opsi Absen:</strong> Setelah masuk, Anda akan melihat tombol untuk "Absen Masuk" dan "Absen Pulang". Pilih salah satu sesuai kebutuhan.</li>
                    <li><strong>Periksa Koordinat:</strong> Aplikasi akan secara otomatis mengambil lokasi Anda. Pastikan Anda berada dalam jangkauan yang ditentukan.</li>
                    <li><strong>Kirim Formulir:</strong> Setelah memilih opsi absensi, formulir akan secara otomatis mengisi koordinat dan mengirimkan data absensi.</li>
                    <li><strong>Verifikasi:</strong> Anda akan melihat notifikasi yang menunjukkan apakah absensi berhasil dilakukan.</li>
                </ol>
                <p>Jika Anda mengalami kesulitan, silakan hubungi wali kelas atau admin untuk bantuan lebih lanjut.</p>
            </div>
        </div>

        <!-- Profile Page -->
        <div id="profile" class="page">
            <div class="p-6 bg-custom-purple text-white">
                <h1 class="text-2xl lg:text-3xl font-bold">Profil dan Info Sekolah</h1>
            </div>
            <div class="p-6">
                <h2 class="text-xl font-bold mb-4">Info Sekolah</h2>
                <p><strong>Nama Sekolah:</strong> MTsN 11 Majalengka</p>
                <p><strong>Alamat:</strong> Kp. Sindanghurip Desa Maniis Kec. Cingambul Kab. Majalengka</p>
                <p><strong>Telepon:</strong> (0233) 8319182</p>
                <p><strong>Email:</strong> mtsn11majalengka@gmail.com</p>

                <h2 class="text-xl font-bold mt-6 mb-4">Profil Siswa</h2>
                <p><strong>Nama:</strong> <?= $this->session->userdata('nama'); ?></p>
                <p><strong>NISN:</strong> <?= $this->session->userdata('nisn'); ?></p>
                <p><strong>Kelas:</strong> XII IPA 1</p>
                <p><strong>Wali Kelas:</strong> Bpk. Contoh Guru</p>
            </div>
        </div>
    </div>
    <div class="bottom-menu flex justify-around items-center">
        <a href="#" class="menu-item" data-page="tutorial">
            <i class="far fa-calendar-alt text-xl"></i>
            <span class="text-xs mt-1">Tutorial</span>
        </a>
        <a href="#" class="menu-item active" data-page="home">
            <i class="fas fa-home text-xl"></i>
            <span class="text-xs mt-1">Home</span>
        </a>
        <a href="#" class="menu-item" data-page="profile">
            <i class="far fa-user text-xl"></i>
            <span class="text-xs mt-1">Profil</span>
        </a>
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

            fetch('<?= site_url('absensi_hp/check_range'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ latitude: lat, longitude: lng }),
            })
            .then(response => response.json())
            .then(data => {
                const rangeDot = document.getElementById('range-dot');
                if (data.inRange) {
                    document.getElementById('range-message').classList.remove('hidden');
                    rangeDot.classList.remove('dot-red');
                    rangeDot.classList.add('dot-green');
                } else {
                    document.getElementById('range-message').classList.add('hidden');
                    rangeDot.classList.remove('dot-green');
                    rangeDot.classList.add('dot-red');
                }
            });
        }, () => {
            document.getElementById('coordinates').textContent = 'Gagal mendapatkan koordinat';
        });
    } else {
        document.getElementById('coordinates').textContent = 'Geolokasi tidak didukung';
    }
}

function updateClock() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
}

function showPage(pageId) {
        document.querySelectorAll('.page').forEach(page => {
            page.classList.remove('active');
        });
        document.getElementById(pageId).classList.add('active');
        
        document.querySelectorAll('.menu-item').forEach(item => {
            item.classList.remove('active');
        });
        document.querySelector(`.menu-item[data-page="${pageId}"]`).classList.add('active');

        // Close sidebar when a page is selected
        toggleSidebar();
    }

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('active');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const hamburgerMenu = document.getElementById('hamburger-menu');
        const sidebarClose = document.getElementById('sidebar-close');
        const sidebar = document.getElementById('sidebar');

        hamburgerMenu.addEventListener('click', toggleSidebar);
        sidebarClose.addEventListener('click', toggleSidebar);

        document.querySelectorAll('.menu-item, .sidebar-item').forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                const pageId = item.getAttribute('data-page');
                showPage(pageId);
            });
        });

        // Initial setup
        updateClock();
        setInterval(updateClock, 1000);
        updateCoordinates();
        setInterval(updateCoordinates, 5000);
    });
    </script>
</body>
</html>