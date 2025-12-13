<?php
 
  error_reporting(0);
  session_start();
   if (!isset($_SESSION['email'])){
        header("location:../index.php");
  }

  if( $_SESSION['role'] !="penjual"){
        header("location:../Home/index.php");
  }
    $role = $_SESSION['role'] ;
    $email = $_SESSION['email'] ;
    $id_user = $_SESSION['id'] ;
    $nama_lengkap =  $_SESSION['nama_lengkap'];
    $alamat_blok = $_SESSION['alamat_blok'];


   
?>




<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pembeli - PASOL</title>
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
        <a href="../Home/?page=home">
            <div class="flex items-center justify-center h-20 ">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-linear-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-xl">P</span>
                    </div>
                    <span class="text-2xl font-extrabold text-dark">PASOL</span>
                </div>
             </div>
        </a>
        <nav class="flex-1 p-4 space-y-2"> 
            <a href="./?page=profile" class="flex items-center space-x-3 px-4 py-3 text-dark font-medium rounded-xl hover:bg-gray-50 transition duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Profil</span>
           <a href="./?page=daftar-produk" class="flex items-center space-x-3 px-4 py-3 text-dark font-medium rounded-xl hover:bg-gray-50 transition duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <span>Daftar Produk</span>
            </a>

            <a href="./?page=pesanan-masuk" class="flex items-center space-x-3 px-4 py-3 text-dark font-medium rounded-xl hover:bg-gray-50 transition duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" style="display:none" /> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" style="display:none" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20" />
                </svg>
                <span>Pesanan Masuk</span>
            </a>
            
            <a href="./?page=daftar-pesanan" class="flex items-center space-x-3 px-4 py-3 text-dark font-medium rounded-xl hover:bg-gray-50 transition duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
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
                    <span>Profil</span>
                </a>
                <a href="./?page=daftar-produk" class="flex items-center space-x-3 px-4 py-3 text-dark font-medium rounded-xl hover:bg-gray-50 transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span>Daftar Produk</span>
                </a>

                <a href="./?page=pesanan-masuk" class="flex items-center space-x-3 px-4 py-3 text-dark font-medium rounded-xl hover:bg-gray-50 transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414a1 1 0 00-.707-.293H4" />
                    </svg>
                    <span>Pesanan Masuk</span>
                </a>

                <a href="./?page=daftar-pesanan" class="flex items-center space-x-3 px-4 py-3 text-dark font-medium rounded-xl hover:bg-gray-50 transition duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
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
            <div class="bg-white shadow-lg md:shadow-none md:bg-bg-light px-6 py-4 flex justify-between items-center w-full">
            
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