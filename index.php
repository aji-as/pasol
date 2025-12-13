<?php



session_start();
if (!empty($_SESSION['id'])) {
    header("Location: Home/index.php");
    exit;
}

?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PASOL - Pasar Online Lingkungan</title>
    <link rel="stylesheet" href="../Assets/css/output.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#FFFFFF',
                        'secondary': '#F7F7F7',
                        'dark': '#000000',
                        'gray-text': '#6B7280',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-primary text-dark">
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
               <div class="flex items-center">
                    <a href="index.php" class="flex items-center space-x-2">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                            <span class="text-white font-bold text-lg">P</span>
                        </div>

                        <div class="flex flex-col leading-tight">
                            <span class="text-xl font-bold text-dark">PASOL</span>
                            <span class="inline-block px-3 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">
                            
                            </span>
                        </div>
                    </a>
                </div>

                <p class="text-green-500 font-bold text-sm md:text-lg"></p>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="login.php" class="text-gray-text hover:text-green-600 transition-colors">Masuk</a>
                    
                </div>

                <button id="mobileMenuBtn" class="md:hidden p-2 rounded-lg hover:bg-secondary">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobileMenu" class="hidden md:hidden bg-white border-t">
            <div class="px-4 py-3 space-y-2">
                <a href="logoin.php" class="block py-2 text-gray-text">Masuk</a>
            </div>
        </div>
    </nav>

    <?php require_once 'route.php'  ?>
  

    <footer id="kontak" class="bg-white border-t border-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                            <span class="text-white font-bold text-lg">P</span>
                        </div>
                        <span class="text-xl font-bold text-dark">PASOL</span>
                    </div>
                    <p class="text-gray-text">Pasar Online Lingkungan - Platform belanja online untuk warga perumahan.</p>
                </div>
                
                <div>
                    <h4 class="font-semibold text-dark mb-4">Menu</h4>
                    <ul class="space-y-2">
                        <li><a href="index.php" class="text-gray-text hover:text-green-600 transition-colors">Beranda</a></li>
                        <li><a href="produk.php" class="text-gray-text hover:text-green-600 transition-colors">Produk</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold text-dark mb-4">Kontak</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center space-x-2 text-gray-text">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>info@pasol.id</span>
                        </li>
                        <li class="flex items-center space-x-2 text-gray-text">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span>+62 812-3456-7890</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-100 mt-8 pt-8 text-center">
                <p class="text-gray-text text-sm">&copy; 2024 PASOL - Pasar Online Lingkungan. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>

