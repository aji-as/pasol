




<?php error_reporting(0) ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - PASOL</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
<body class="bg-secondary text-dark min-h-screen flex items-center justify-center">






    <!-- card login mulai -->
    <div class="w-full max-w-md px-4">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <!-- php -->
                <?php
                    require_once 'config.php';

                    // error_reporting(0);
                    if ($_POST['simpan']) {
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $user = get_user_by_username($email, md5($password));
                        if ($user) {    
                            session_start();
                            $_SESSION['role'] = $user['role'];
                            $_SESSION['email'] = $user['email'];
                            $_SESSION['id'] = $user['id'];
                            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
                            $_SESSION['alamat_blok'] = $user['alamat_blok'];
                            
                                if ($_SESSION['role']=="admin"){
                                    header("Location:Admin/index.php");
                                    exit;
                                    // echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded' role='alert'>
                                    //         <span class='font-medium'>Login Berhasil!</span>
                                    //     </div>";
                                }
                                elseif ($_SESSION['role']=="pembeli" or $_SESSION['role']=="penjual" ){
                                    header("location:Home/index.php?status=ok");
                                    exit;
                                    // echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded' role='alert'>
                                    //         <span class='font-medium'>Login Berhasil!</span>
                                    //     </div>";
                                }
                                else {
                                    echo "<div class=' bg-red-100 text-center w-full mb-5 border border-red-400 text-red-700 px-4 py-3 rounded ' role='alert'>
                        <span class='font-medium'>Login Gagal!</span>
                    </div>";
                            }
                        }else {
                            echo "<div class=' bg-red-100 text-center w-full mb-5 border border-red-400 text-red-700 px-4 py-3 rounded ' role='alert'>
                        <span class='font-medium'>Login Gagal!</span>
                    </div>"
                    ;
                        }
                    }
                ?>
            <!-- php end -->
        


          <div class="text-center mb-8">
            <a href="index.php" class="inline-flex items-center space-x-2 mb-6">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                    <span class="text-white font-bold text-xl">P</span>
                </div>
                <span class="text-2xl font-bold text-dark">PASOL</span>
                <h1 class="text-2xl font-bold text-dark">Login</h1>
            </a>
        </div>

            <form id="loginForm" class="space-y-6" method="post">
                <div>
                    <label for="email" class="block text-sm font-medium text-dark mb-2">Email</label>
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            required
                            placeholder="admin@pasol.id"
                            class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        >
                    </div>
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-dark mb-2">Password</label>
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            placeholder="Masukkan password"
                            class="w-full pl-12 pr-12 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        >
                        <button 
                            type="button"
                            id="togglePassword"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                        >
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <input
                    name="simpan"
                    value="Masuk"
                    type="submit"
                    class="w-full py-3 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition-all duration-300 shadow-md hover:shadow-lg"
                >
            </form>
         
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-text">
                    Belum punya akun penjual? 
                    <a href="#" class="text-green-600 hover:underline font-medium">Daftar sekarang</a>
                </p>
            </div>
        </div>
        
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        
        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            if (type === 'text') {
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                `;
            } else {
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                `;
            }
        });

        
    </script>
</body>
</html>

