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
                <p class='text-sm text-gray-500 mt-0.5'>Produk berhasil dihapus.</p>
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


<?php 
require_once '../config.php';

$kategori_ = $_POST['kategori'];

if (isset($kategori_) && $kategori_ != "all") {
    $products = get_produk_by_id_seller_and_kategori(
        $id_user,
        get_id_kategori($kategori_)
    );
} else {
    $products = get_produk_by_id_seller($id_user);
}

?>

<div class="p-4 md:p-8 bg-gray-50 min-h-screen">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        
        <div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Daftar Produk</h2>
            <p class="text-sm text-gray-500">Kelola katalog produk toko Anda</p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto"> 
            <form method="post">
                <select 
                    name="kategori" 
                    onchange="this.form.submit()" 
                    class="px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 text-sm shadow-sm text-gray-600 cursor-pointer bg-white"
                >
                    <option value="all">Semua Kategori</option>

                    <?php  
                    require_once "../config.php";
                    $categories = get_all_kategori();
                    foreach ($categories as $kategory){ ?>
                        <option 
                            value="<?php echo $kategory['nama_kategori'] ?>"
                            <?php if($kategori_ == $kategory['nama_kategori']) echo "selected"; ?>
                        >
                            <?php echo $kategory['nama_kategori'] ?>
                        </option>
                    <?php } ?>
                </select>
            </form>

           

            <a href="./?page=tambah-produk" class="flex items-center justify-center gap-2 bg-green-600 text-white px-5 py-2.5 rounded-lg font-semibold text-sm hover:bg-green-700 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Tambah</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3  gap-4">

        <?php 
        foreach($products as $produk) { 
        ?>

        <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col overflow-hidden group">
            
            <div class="relative h-48 overflow-hidden bg-gray-100">
                <img src="../Media/<?php echo $produk['foto_produk']; ?>" 
                     alt="<?php echo $produk['nama_produk']; ?>" 
                     class="w-full h-full object-cover object-center group-hover:scale-110 transition duration-500">
                
                <div class="absolute top-3 left-3">
                    <?php if($produk['is_active']): ?>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200 shadow-sm backdrop-blur-sm bg-opacity-90">
                            <span class="w-1.5 h-1.5 bg-green-600 rounded-full mr-1.5"></span> Aktif
                        </span>
                    <?php else: ?>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200 shadow-sm backdrop-blur-sm bg-opacity-90">
                            <span class="w-1.5 h-1.5 bg-gray-500 rounded-full mr-1.5"></span> Arsip
                        </span>
                    <?php endif; ?>
                </div>

                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-3 pt-8">
                     <p class="text-xs text-white font-medium flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        Stok: <?php echo $produk['stok']; ?>
                     </p>
                </div>
            </div>

            <div class="p-4 flex flex-col flex-grow">
                <p class="text-xs text-gray-400 mb-1"><?php echo get_kategori_by_id($produk['kategori_id']) ?></p>

                <h3 class="font-bold text-gray-800 text-lg leading-tight mb-2 line-clamp-1" title="<?php echo $produk['nama_produk']; ?>">
                    <?php echo $produk['nama_produk']; ?>
                </h3>
                
                <div class="mb-4">
                    <span class="text-sm md:text-md font-bold  text-green-700">
                        Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?>
                    </span>
                    <span class="text-xs text-gray-400">/ pcs</span>
                </div>

                <div class="mt-auto grid grid-cols-2 gap-3 pt-4 border-t border-gray-100">
                    <a href="./?page=edit-produk&id=<?php echo $produk['id']; ?>" 
                       class="flex items-center justify-center gap-2 px-3 py-2 bg-yellow-50 text-yellow-700 text-sm font-semibold rounded-lg border border-yellow-200 hover:bg-yellow-100 hover:border-yellow-300 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Edit
                    </a>

                    <button onclick="confirmDelete(<?php echo $produk['id']; ?>)" 
                            class="flex items-center justify-center gap-2 px-3 py-2 bg-white text-red-600 text-sm font-semibold rounded-lg border border-red-200 hover:bg-red-50 hover:border-red-300 transition group/delete">
                        <svg class="w-4 h-4 group-hover/delete:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Hapus
                    </button>
                </div>
            </div>
        </div>

        <?php 
        } // End foreach
        ?>

        <?php if($products ==null){
            echo"<div class='col-span-full text-center py-10'>
                <p class=   'text-gray-500 text-lg'>Belum ada produk yang anda tambahkan</p>
                </div>" ;
        }?>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Hapus Produk?',
        text: "Produk yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect ke script penghapusan
            window.location.href = 'hapus_produk.php?id=' + id;
        }
    })
}
</script>