<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Setting Waktu Operasional</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

       
        <!-- Main Content -->
        <div class="bg-white rounded-lg p-5 mb-6">
            <h2 class="text-2xl font-bold mb-4">Setting Waktu Operasional</h2>
            
            <?php if($this->session->flashdata('pesan')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo $this->session->flashdata('pesan'); ?></span>
                </div>
            <?php endif; ?>

            <form action="<?= base_url(); ?>setting/updateWaktuOperasional" method="post" id="settingsForm" class="space-y-6">
                <?php foreach ($days as $englishDay => $hari): ?>
                    <div class="border-b pb-4">
                        <h3 class="text-lg font-semibold mb-2"> <?php echo $hari; ?></h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="inputMasuk_<?php echo $englishDay; ?>" class="block text-sm font-medium text-gray-700 mb-1">Waktu Masuk (<?php echo $hari; ?>)</label>
                                <input class="w-full p-2 border rounded" type="text" name="masuk[<?php echo $englishDay; ?>]" value="<?= $waktuOperasionalHari[$englishDay]['masuk']; ?>" placeholder="jam:menit-jam:menit" id="inputMasuk_<?php echo $englishDay; ?>">
                            </div>
                            <div>
                                <label for="inputKeluar_<?php echo $englishDay; ?>" class="block text-sm font-medium text-gray-700 mb-1">Waktu Keluar (<?php echo $hari; ?>)</label>
                                <input class="w-full p-2 border rounded" type="text" name="keluar[<?php echo $englishDay; ?>]" value="<?= $waktuOperasionalHari[$englishDay]['keluar']; ?>" placeholder="jam:menit-jam:menit" id="inputKeluar_<?php echo $englishDay; ?>">
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="mt-6">
                    <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Set Semua Waktu Operasional</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bottom Navigation -->
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
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Konfirmasi Tindakan
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Apakah Anda yakin ingin melanjutkan tindakan ini?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="confirmButton" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Lanjutkan
                    </button>
                    <button type="button" id="cancelButton" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function showConfirmationModal(actionUrl) {
                $('#confirmationModal').removeClass('hidden');
                $('#confirmButton').attr('data-action-url', actionUrl);
            }

            $('#settingsForm').on('submit', function(event) {
                event.preventDefault();
                showConfirmationModal($(this).attr('action'));
            });

            $('#confirmButton').click(function() {
                var actionUrl = $(this).attr('data-action-url');
                $('#settingsForm').attr('action', actionUrl).off('submit').submit();
            });

            $('#cancelButton').click(function() {
                $('#confirmationModal').addClass('hidden');
            });
        });
    </script>
</body>
</html>