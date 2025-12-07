<?php if (isset($_GET['status'])): ?>

    <?php if ($_GET['status'] === "ok"): ?>
        <div id='success-alert' 
             class='fixed z-50 flex items-center gap-4 p-4 bg-white rounded-2xl shadow-2xl border border-gray-100 
                    transition-all duration-500 ease-in-out transform translate-y-0 opacity-100
                    top-4 left-4 right-4 md:top-8 md:right-8 md:left-auto md:w-auto md:min-w-[320px]'>
            
            <div class='flex-shrink-0 flex items-center justify-center w-10 h-10 rounded-full bg-[#00A651]/10'>
                <svg class='w-6 h-6 text-[#00A651]' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                    <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7'></path>
                </svg>
            </div>

            <div class='flex-1'>
                <h4 class='text-sm font-bold text-gray-900'>Berhasil!</h4>
                <p class='text-sm text-gray-500 mt-0.5'>Penjual berhasil dihapus</p>
            </div>

            <button onclick='closeAlert("success-alert")' class='text-gray-400 hover:text-gray-600 transition'>
                <svg class='w-5 h-5' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                    <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12'></path>
                </svg>
            </button>

            <div class='absolute bottom-0 left-4 right-4 h-1 bg-gray-100 rounded-full overflow-hidden'>
                <div id='progress-bar-success' class='h-full bg-[#00A651] w-full transition-all duration-[2000ms] ease-linear'></div>
            </div>
        </div>

    <?php else: ?>
        <div id='failed-alert' 
             class='fixed z-50 flex items-center gap-4 p-4 bg-white rounded-2xl shadow-2xl border border-gray-100 
                    transition-all duration-500 ease-in-out transform translate-y-0 opacity-100
                    top-4 left-4 right-4 md:top-8 md:right-8 md:left-auto md:w-auto md:min-w-[320px]'>
            
            <div class='flex-shrink-0 flex items-center justify-center w-10 h-10 rounded-full bg-red-100'>
                <svg class='w-6 h-6 text-red-600' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                    <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'></path>
                </svg>
            </div>

            <div class='flex-1'>
                <h4 class='text-sm font-bold text-gray-900'>Gagal!</h4>
                <p class='text-sm text-gray-500 mt-0.5'>Gagal menghapus produk.</p>
            </div>

            <button onclick='closeAlert("failed-alert")' class='text-gray-400 hover:text-gray-600 transition'>
                <svg class='w-5 h-5' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                    <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12'></path>
                </svg>
            </button>

            <div class='absolute bottom-0 left-4 right-4 h-1 bg-gray-100 rounded-full overflow-hidden'>
                <div id='progress-bar-failed' class='h-full bg-red-600 w-full transition-all duration-[2000ms] ease-linear'></div>
            </div>
        </div>
    <?php endif; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tentukan Alert mana yang aktif (Success atau Failed)
            const successAlert = document.getElementById('success-alert');
            const failedAlert = document.getElementById('failed-alert');
            
            // Pilih elemen aktif
            const activeAlert = successAlert || failedAlert;
            
            if (activeAlert) {
                const alertID = activeAlert.id;
                // Pilih progress bar yang sesuai
                const progressBar = document.getElementById(alertID === 'success-alert' ? 'progress-bar-success' : 'progress-bar-failed');

                // 1. Animasi Progress Bar
                if(progressBar) {
                    setTimeout(() => {
                        progressBar.style.width = '0%';
                    }, 100);
                }

                // 2. Hilangkan otomatis setelah 2 detik
                setTimeout(() => {
                    closeAlert(alertID);
                }, 2000);
            }
        });

        function closeAlert(elementId) {
            const alertBox = document.getElementById(elementId);
            if (alertBox) {
                // Efek animasi keluar (naik ke atas & fade out)
                alertBox.classList.remove('translate-y-0', 'opacity-100');
                alertBox.classList.add('-translate-y-10', 'opacity-0');
                
                // Hapus elemen dari DOM
                setTimeout(() => {
                    alertBox.remove();
                }, 500);
            }
        }
    </script>

<?php endif; ?>
<!-- alert end -->










<div class="p-4 md:p-8 bg-gray-50 min-h-screen font-sans">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Daftar Pembeli</h2>
            <p class="text-sm text-gray-500">Kelola data pelanggan</p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
            <div class="relative w-full sm:w-64">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" placeholder="Cari pembeli..." class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 text-sm shadow-sm">
            </div>

            <select class="w-full sm:w-auto px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 text-sm shadow-sm bg-white">
                <option value="">Semua Status</option>
                <option value="active">Aktif</option>
                <option value="inactive">Non-Aktif</option>
            </select>

            <a href="./?page=tambah-penjual" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-green-600 text-white px-5 py-2.5 rounded-lg font-semibold text-sm hover:bg-green-700 transition shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Tambah</span>
            </a>
        </div>
    </div>

    <?php
    require_once '../config.php';
    $sellers = get_user_by_role("penjual");
    ?>

    <div class="grid grid-cols-1 gap-4 md:hidden">
        <?php foreach($sellers as $seller) {
            // Persiapan Data
            $namaUrl = urlencode($seller['nama_lengkap']); 
            $avatarSrc = "https://ui-avatars.com/api/?name={$namaUrl}&background=00A651&color=fff&size=128";
            $tanggalGabung = date('d M Y', strtotime($seller['created_at'])); // Format Tanggal
        ?>
        
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-200 transition-shadow hover:shadow-md">
            
            <div class="flex items-start gap-4 mb-4">
                <img class="w-12 h-12 rounded-full border-2 border-gray-100 shadow-sm object-cover flex-shrink-0" 
                    src="<?php echo $avatarSrc; ?>" 
                    alt="Profile">
                
                <div class="flex-1 min-w-0"> <div class="flex justify-between items-start">
                        <h3 class="font-bold text-gray-900 text-lg leading-tight truncate">
                            <?php echo $seller['nama_lengkap']; ?>
                        </h3>
                        <span class="text-[10px] font-mono bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full">
                            #<?php echo $seller['id']; ?>
                        </span>
                    </div>
                    <p class="text-sm text-gray-500 truncate"><?php echo $seller['email']; ?></p>
                </div>
            </div>

            <div class="bg-gray-50 rounded-lg p-3 mb-4 space-y-2 border border-gray-100">
                <div class="flex items-center text-sm text-gray-700">
                    <svg class="w-4 h-4 mr-2.5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    <span class="font-medium"><?php echo $seller['no_hp']; ?></span>
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-2.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>Bergabung: <?php echo $tanggalGabung; ?></span>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-2 border-t border-gray-100 pt-3">
                <a href="./?page=detail-user&id=<?php echo $seller['id']; ?>" class="flex items-center justify-center gap-1 py-2 text-blue-600 bg-blue-50 rounded-lg text-xs font-bold hover:bg-blue-100 transition group">
                    <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    Detail
                </a>
                
                <a href="./?page=edit-user&id=<?php echo $seller['id']; ?>" class="flex items-center justify-center gap-1 py-2 text-yellow-700 bg-yellow-50 rounded-lg text-xs font-bold hover:bg-yellow-100 transition group">
                    <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Edit
                </a>
                
                <button onclick="confirmDelete(<?php echo $seller['id']; ?>, '<?php echo $seller['nama_lengkap']; ?>')" class="flex items-center justify-center gap-1 py-2 text-red-600 bg-red-50 rounded-lg text-xs font-bold hover:bg-red-100 transition group">
                    <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    Hapus
                </button>
            </div>
        </div>
        <?php } ?>
    </div>

    <div class="hidden md:block bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                    <th class="px-6 py-4 font-semibold">Nama</th>
                    <th class="px-6 py-4 font-semibold">Email</th>
                    <th class="px-6 py-4 font-semibold">Kontak</th>
                    <th class="px-6 py-4 font-semibold ">Tgl Gabung</th>
                    <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php foreach($sellers as $seller): ?>
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            <div>
                                <div class="text-sm font-bold text-gray-900"><?php echo $seller['nama_lengkap']; ?></div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        <?php echo $seller['email']; ?>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">
                        <?php echo $seller['no_hp']; ?>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">
                        <?php echo $seller['created_at']; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="./?page=detail-user&id=<?php echo $seller['id']; ?>" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></a>
                            <a href="./?page=edit-user&id=<?php echo $seller['id']; ?>" class="p-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-100 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></a>
                            <button onclick="confirmDelete(<?php echo $seller['id']; ?>, '<?php echo $seller['nama']; ?>')" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id, nama) {
        Swal.fire({
            title: 'Hapus Pembeli?',
            text: "Data " + nama + " akan dihapus permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'rounded-xl',
                confirmButton: 'px-5 py-2.5 rounded-lg',
                cancelButton: 'px-5 py-2.5 rounded-lg'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'hapus_user.php?id=' + id;
            }
        })
    }
</script>