
<?php 
if ($_POST['simpan']) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $no_hp        = $_POST['no_hp'];
    $alamat_blok  = $_POST['alamat_blok'];
    $email        = $_POST['email'];
    $password     = $_POST['password'];

    require_once "../config.php";

    $result = create_user($nama_lengkap,$no_hp,$password,$email,"pembeli",$alamat_blok);
    if($result){
        echo "<div id='success-alert' 
         class='fixed z-50 flex items-center gap-4 p-4 bg-white rounded-2xl shadow-2xl border border-gray-100 
                transition-all duration-500 ease-in-out transform translate-y-0 opacity-100
                /* Responsif HP: Posisi atas tengah, lebar menyesuaikan */
                top-4 left-4 right-4 
                /* Responsif Laptop/Tablet: Posisi pojok kanan atas, lebar otomatis */
                md:top-8 md:right-8 md:left-auto md:w-auto md:min-w-[320px]'>
        
        <div class='flex-shrink-0 flex items-center justify-center w-10 h-10 rounded-full bg-[#00A651]/10'>
            <svg class='w-6 h-6 text-[#00A651]' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7'></path>
            </svg>
        </div>

        <div class='flex-1'>
            <h4 class='text-sm font-bold text-gray-900'>Berhasil!</h4>
            <p class='text-sm text-gray-500 mt-0.5'>Berhasil menambahkan pembeli</p>
        </div>

        <button onclick='closeAlert()' class='text-gray-400 hover:text-gray-600 transition'>
            <svg class='w-5 h-5' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12'></path>
            </svg>
        </button>

        <div class='absolute bottom-0 left-4 right-4 h-1 bg-gray-100 rounded-full overflow-hidden'>
             <div id='progress-bar' class='h-full bg-[#00A651] w-full transition-all duration-[2000ms] ease-linear'></div>
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
";
       
    }else{
        echo "<div class=' bg-red-100 text-center w-full mb-5 border border-red-400 text-red-700 px-4 py-3 rounded ' role='alert'>
                        <span class='font-medium'>Pesanan gagal dibuat</span>
                    </div>"
                    ;
    }

}


?>






<div class="max-w-5xl mx-auto p-4 md:p-8 bg-gray-50 min-h-screen font-sans">
    
    <div class="flex items-center gap-4 mb-8">
        <a href="./?page=daftar-pembeli" class="p-2 bg-white rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-100 transition shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Tambah Pengguna Baru</h2>
            <p class="text-sm text-gray-500">Buat akun baru untuk Penjual</p>
        </div>
    </div>

    <form action="#" method="post">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
            
            <div class="space-y-6">
                <div class="bg-white p-6 md:p-8 rounded-xl shadow-md border border-gray-100 h-full">
                    <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                        <div class="p-2 bg-green-100 rounded-lg text-green-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">Informasi Pribadi</h3>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" placeholder="Contoh: Alfiana Putri" required
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition text-gray-700 bg-gray-50 focus:bg-white">
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">No. Handphone</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </span>
                            <input type="number" name="no_hp" placeholder="0812..." required
                                   class="w-full pl-11 pr-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition text-gray-700 bg-gray-50 focus:bg-white">
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Alamat / Blok Rumah</label>
                        <textarea name="alamat_blok" rows="4" placeholder="Contoh: Blok A5 No. 12, Perumahan Griya Indah" required
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition text-gray-700 resize-none bg-gray-50 focus:bg-white"></textarea>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white p-6 md:p-8 rounded-xl shadow-md border border-gray-100 h-full flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                            <div class="p-2 bg-blue-100 rounded-lg text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Akun & Keamanan</h3>
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </span>
                                <input type="email" name="email" placeholder="nama@email.com" required
                                       class="w-full pl-11 pr-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition text-gray-700 bg-gray-50 focus:bg-white">
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Role Pengguna</label>
                            <div class="relative">
                                 <div class="relative">
                                <input readonly value="pembeli"
                                    class="w-full pl-11 pr-12 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition text-gray-700 bg-gray-50 focus:bg-white">
                            </div>
                                <!-- <select name="role" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 appearance-none bg-gray-50 focus:bg-white text-gray-700 cursor-pointer">
                                    <option value="" disabled selected>Pilih Role...</option>
                                    <option value="pembeli">Pembeli</option>
                                    <option value="penjual">Penjual</option>
                                    <option value="admin">Admin</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div> -->
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </span>
                                <input type="password" name="password" id="passwordInput" placeholder="••••••••" required
                                       class="w-full pl-11 pr-12 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition text-gray-700 bg-gray-50 focus:bg-white">
                                
                                <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                                    <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                            </div>
                            <p class="text-xs text-gray-400 mt-1 ml-1">Minimal 6 karakter kombinasi huruf dan angka.</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-8 mt-4 border-t border-gray-100">
                        <a href="./?page=daftar-pembeli" class="px-6 py-3 rounded-lg text-gray-600 font-semibold hover:bg-gray-100 transition">
                            Batal
                        </a>
                        <input value="Simpan" name="simpan" type="submit" class="px-8 py-3 bg-green-600 text-white rounded-lg font-bold shadow-lg hover:bg-green-700 hover:shadow-xl transform hover:-translate-y-0.5 transition duration-200 flex items-center gap-2">
                           
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('passwordInput');
        const eyeIcon = document.getElementById('eyeIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            // Icon mata tertutup (Slash)
            eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>';
        } else {
            passwordInput.type = 'password';
            // Icon mata terbuka (Normal)
            eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
        }
    }
</script>