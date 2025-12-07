<?php
 
  error_reporting(0);
  session_start();
  if (!isset($_SESSION['email'])){
        header("location:../index.php");
  }

  if( $_SESSION['role'] !="pembeli"){
        header("location:../Home/index.php");
  }
    $role = $_SESSION['role'] ;
    $email = $_SESSION['email'] ;
    $id_user = $_SESSION['id'] ;
    $nama_lengkap =  $_SESSION['nama_lengkap'];
    $alamat_blok = $_SESSION['alamat_blok'];


   
?>

<!-- alertt -->

<?php if (isset($_GET['status']) && $_GET['status'] === "ok"): ?>

    <div id="success-alert" 
         class="fixed z-50 flex items-center gap-4 p-4 bg-white rounded-2xl shadow-2xl border border-gray-100 
                transition-all duration-500 ease-in-out transform translate-y-0 opacity-100
                /* Responsif HP: Posisi atas tengah, lebar menyesuaikan */
                top-4 left-4 right-4 
                /* Responsif Laptop/Tablet: Posisi pojok kanan atas, lebar otomatis */
                md:top-8 md:right-8 md:left-auto md:w-auto md:min-w-[320px]">
        
        <div class="flex-shrink-0 flex items-center justify-center w-10 h-10 rounded-full bg-[#00A651]/10">
            <svg class="w-6 h-6 text-[#00A651]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <div class="flex-1">
            <h4 class="text-sm font-bold text-gray-900">Berhasil!</h4>
            <p class="text-sm text-gray-500 mt-0.5">Pesanan Anda berhasil di buat</p>
        </div>

        <button onclick="closeAlert()" class="text-gray-400 hover:text-gray-600 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <div class="absolute bottom-0 left-4 right-4 h-1 bg-gray-100 rounded-full overflow-hidden">
             <div id="progress-bar" class="h-full bg-[#00A651] w-full transition-all duration-[2000ms] ease-linear"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alertBox = document.getElementById('success-alert');
            const progressBar = document.getElementById('progress-bar');
            
            // 1. Mulai animasi progress bar berkurang
            setTimeout(() => {
                progressBar.style.width = '0%';
            }, 100);

            // 2. Hilangkan alert setelah 2 detik (2000ms)
            setTimeout(() => {
                closeAlert();
            }, 2000);
        });

        function closeAlert() {
            const alertBox = document.getElementById('success-alert');
            if (alertBox) {
                // Efek fade out dan geser ke atas
                alertBox.classList.remove('translate-y-0', 'opacity-100');
                alertBox.classList.add('-translate-y-10', 'opacity-0');
                
                // Hapus elemen dari DOM setelah animasi selesai (500ms)
                setTimeout(() => {
                    alertBox.remove();
                }, 500);
            }
        }
    </script>

<?php endif; ?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penjual - PASOL</title>
    <link rel="stylesheet" href="../Assets/css/output.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { 'poppins': ['Poppins', 'sans-serif'] },
                    colors: {
                        'bg-light': '#F9FAFB', // Latar belakang utama yang sangat terang
                        'dark': '#1F2937', // Teks/Judul gelap
                        'gray-text': '#6B7280', // Teks sekunder
                        'accent': '#059669', // Hijau solid untuk branding (emerald-600)
                        'accent-light': '#D1FAE5' // Warna hover/background aksen
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-bg-light flex font-poppins">

    <aside class="w-64 bg-sidebar-bg shadow-xl hidden md:flex flex-col fixed top-0 left-0 h-screen z-40">
        <div class="flex items-center justify-center h-20 ">
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-linear-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-xl">P</span>
                </div>
                <span class="text-2xl font-extrabold text-dark">PASOL</span>
            </div>
        </div>
        <nav class="flex-1 p-4 space-y-2"> 
            <a href="./?page=profile" class="flex items-center space-x-3 px-4 py-3 text-dark font-medium rounded-xl hover:bg-gray-50 transition duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Profil</span>
            </a>
            
            <a href="./?page=daftar-pesanan" class="flex items-center space-x-3 px-4 py-3 text-dark font-medium rounded-xl hover:bg-gray-50 transition duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M12 16h.01" />
                </svg>
                <span>Pesanan</span>
            </a>
        </nav>

        <div class="p-4 border-t border-gray-100">
            <a href="../logout.php" class="flex items-center justify-center space-x-2 w-full px-4 py-3 text-red-600 font-medium rounded-xl bg-red-50 hover:bg-red-100 transition duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Logout</span>
            </a>
        </div>
    </aside>
    
    <div id="mobileSidebar" class="fixed inset-0 bg-black/55 bg-opacity-50 z-9999 hidden" aria-modal="true" role="dialog">
        
        <aside id="mobileSidebarPanel" class="w-64 bg-white h-full shadow-2xl p-4 fixed top-0 left-0 transform -translate-x-full transition-transform duration-300 ease-out">
            
            <div class="flex items-center justify-between mb-6 border-b pb-4">
                <span class="text-xl font-bold text-dark">Menu PASOL</span>
                <button id="closeSidebar" class="text-dark text-3xl font-bold p-1 hover:text-red-600 transition duration-150">&times;</button>
            </div>

            <nav class="flex flex-col space-y-2">
                <a href="./?page=profile" class="flex items-center space-x-3 px-4 py-3 text-dark font-medium rounded-xl hover:bg-gray-50 transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Profil Toko</span>
                </a>
                <a href="./?page=daftar-pesanan" class="flex items-center space-x-3 px-4 py-3 text-dark font-medium rounded-xl hover:bg-gray-50 transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M12 16h.01" />
                    </svg>
                    <span>Daftar Pesanan</span>
                </a>
            </nav>
            
            <div class="absolute bottom-4 left-4 right-4 border-t pt-4">
                <a href="../logout.php" class="flex items-center justify-center space-x-2 w-full px-4 py-3 text-red-600 font-medium rounded-xl bg-red-50 hover:bg-red-100 transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Logout</span>
                </a>
            </div>
            
        </aside>
    </div>

    <div class="flex-1 md:ml-64"> 
        
        <header class="sticky top-0 z-30 bg-bg-light/95 backdrop-blur-sm shadow-sm border-b border-gray-200">
            <div class="bg-white shadow-lg md:shadow-none md:bg-bg-light rounded-none md:rounded-2xl px-6 py-4 flex justify-between items-center w-full">
            
                <div class="flex items-center gap-4">
                    <button id="openSidebar" class="text-dark p-2 text-xl md:hidden hover:text-accent transition duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <h1 class="text-2xl font-bold text-dark">
                        Dashboard
                    </h1>
                </div>

                <div class="flex items-center gap-3">
                    <span class="hidden sm:inline text-gray-text text-sm">Halo, <?php echo $nama_lengkap ?></span>
                </div>
            </div>
        </header>

        <main class="">
            <?php
                // Asumsi file route.php ada dan menangani konten
                require_once 'route.php'; 
            ?>
        </main>
    </div>


    <script>
        const mobileSidebar = document.getElementById("mobileSidebar");
        const mobileSidebarPanel = document.getElementById("mobileSidebarPanel");
        const openSidebarBtn = document.getElementById("openSidebar");
        const closeSidebarBtn = document.getElementById("closeSidebar");

        // FUNGSI UNTUK MEMBUKA SIDEBAR
        openSidebarBtn?.addEventListener("click", () => {
            mobileSidebar.classList.remove("hidden");
            // Tunggu sebentar agar browser mengenali perubahan 'hidden' sebelum memulai transisi
            setTimeout(() => {
                mobileSidebarPanel.classList.remove("-translate-x-full");
            }, 10);
        });

        // FUNGSI UNTUK MENUTUP SIDEBAR
        function closeMobileSidebar() {
            mobileSidebarPanel.classList.add("-translate-x-full");
            // Setelah transisi selesai (300ms), sembunyikan overlay
            setTimeout(() => {
                mobileSidebar.classList.add("hidden");
            }, 300); 
        }

        closeSidebarBtn?.addEventListener("click", closeMobileSidebar);

        // TUTUP SIDEBAR JIKA KLIK AREA HITAM (OVERLAY)
        mobileSidebar?.addEventListener("click", (e) => {
            if (e.target === mobileSidebar) {
                closeMobileSidebar();
            }
        });
    </script>

</body>
</html>