<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa Tidak Hadir Hari Ini</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body style="background-color: #252F75;" class="font-sans">
    <div class="max-w-4xl mx-auto p-4">
        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center text-xl font-bold mr-2">A</div>
                <div>
                    <h1 class="font-bold text-white">Admin</h1>
                    <p class="text-sm text-white">Sistem Absensi</p>
                </div>
            </div>
            <div class="relative">
                <i class="fas fa-bell text-white"></i>
                <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">3</span>
            </div>
        </div>


        <!-- Breadcrumb -->
        <nav class="text-sm mb-4" aria-label="Breadcrumb">
           
        </nav>

        <h2 class="font-bold text-white">Siswa Tidak Hadir Hari Ini</h2>

        <?php if(isset($notification)): ?>
            <div class="bg-<?php echo $notification['type'] == 'success' ? 'green' : 'red'; ?>-100 border-l-4 border-<?php echo $notification['type'] == 'success' ? 'green' : 'red'; ?>-500 text-<?php echo $notification['type'] == 'success' ? 'green' : 'red'; ?>-700 p-4 mb-4" role="alert">
                <p><?php echo $notification['message']; ?></p>
            </div>
        <?php endif; ?>

        <?php if(!empty($siswa)): ?>
            <?php foreach($siswa as $murid): ?>
                <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                    <div class="flex items-center mb-4">
                        <img src="<?=base_url();?>./uploads/<?= $murid->foto ?>" alt="Foto Murid" class="w-20 h-20 object-cover rounded-full mr-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800"><?= $murid->nama; ?></h3>
                            <p class="text-gray-600">NISN: <?= $murid->nisn; ?></p>
                            <p class="text-gray-600">Kelas: <?= $murid->kelas; ?></p>
                        </div>
                    </div>
                    <form id="absensiForm" action="<?php echo site_url('izin/absen'); ?>" method="post" class="mt-4">
                        <input type="hidden" name="nisn" value="<?= $murid->nisn ?>">
                        <input type="hidden" name="id_devices" value="3">
                        <input type="hidden" name="id_kelas" value="<?= $id_kelas ?>">
                        <input type="date" name="tanggal" class="w-full p-2 mb-2 border rounded" required>
                        <select name="action" class="w-full p-2 mb-2 border rounded">
                            <option value="masuk">Tidak Membawa Kartu Masuk</option>
                            <option value="keluar">Tidak Membawa Kartu Keluar</option>
                            <option value="izin">Izin</option>
                            <option value="sakit">Sakit</option>
                        </select>
                        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Simpan</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-800">Tidak ada siswa yang tidak hadir hari ini di kelas ini.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Navigation Footer -->
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t flex justify-between items-center p-2">
        <a href="<?=base_url();?>dashboard" class="flex flex-col items-center">
            <i class="fas fa-home text-blue-500"></i>
            <span class="text-xs">Home</span>
        </a>
        <a href="<?=base_url();?>setting" class="flex flex-col items-center">
            <i class="fas fa-chart-bar text-gray-500"></i>
            <span class="text-xs">Waktu Oprasional</span>
        </a>
        <a href="<?=base_url();?>izin" class="flex flex-col items-center">
            <i class="fas fa-qrcode text-gray-500"></i>
            <span class="text-xs">Izin</span>
        </a>
        <a href="<?=base_url();?>kelas/manage_holidays" class="flex flex-col items-center">
            <i class="fas fa-cog text-gray-500"></i>
            <span class="text-xs">Hari Libur</span>
        </a>
        <a href="<?=base_url();?>login/logout" class="flex flex-col items-center">
    <i class="fas fa-sign-out-alt text-gray-500"></i> <!-- Change the icon to 'sign-out-alt' for logout -->
    <span class="text-xs">Logout</span>
</a>

    </div>
</body>
</html>