<?php
require_once '../config.php';

$id = $_GET['id'];
$produk = get_produk_by_id($id);

// 2. Logika Update Data
if (isset($_POST['simpan'])) {
    $nama_produk    = $_POST['nama_produk'];
    $harga          = $_POST['harga'];
    $kategori_id    = $_POST['kategori_id'];
    $stok           = $_POST['stok'];
    $deskripsi      = $_POST['deskripsi'];
    $foto_lama      = $_POST['foto_lama'];
    $foto_baru      =$_FILES['foto_produk'];
  
    if ($foto_baru['error'] === 4) {
        // Jika error 4 artinya tidak ada file yang diupload, pakai foto lama
        $gambar = $foto_lama;
    } else {
        $gambar = $_FILES['foto_produk']['name'];
        $tmp = $_FILES['foto_produk']['tmp_name'];
        move_uploaded_file($tmp, "../Media/" . $gambar);
    }

   
    $result = edit_produk($id, $kategori_id, $nama_produk, $deskripsi, $harga, $stok, $gambar);
 
    

    if ($result) {
      
        echo "<div id='success-alert' class='fixed z-50 flex items-center gap-4 p-4 bg-white rounded-2xl shadow-2xl border border-gray-100 transition-all duration-500 ease-in-out transform translate-y-0 opacity-100 top-4 left-4 right-4 md:top-8 md:right-8 md:left-auto md:w-auto md:min-w-[320px]'>
                <div class='flex-shrink-0 flex items-center justify-center w-10 h-10 rounded-full bg-[#00A651]/10'>
                    <svg class='w-6 h-6 text-[#00A651]' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7'></path></svg>
                </div>
                <div class='flex-1'>
                    <h4 class='text-sm font-bold text-gray-900'>Berhasil!</h4>
                    <p class='text-sm text-gray-500 mt-0.5'>Data produk di perbarui</p>
                </div>
                <button onclick='closeAlert()' class='text-gray-400 hover:text-gray-600 transition'><svg class='w-5 h-5' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12'></path></svg></button>
                <div class='absolute bottom-0 left-4 right-4 h-1 bg-gray-100 rounded-full overflow-hidden'><div id='progress-bar' class='h-full bg-[#00A651] w-full transition-all duration-[2000ms] ease-linear'></div></div>
              </div>
              <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const progressBar = document.getElementById('progress-bar');
                    setTimeout(() => { progressBar.style.width = '0%'; }, 100);
                    setTimeout(() => { closeAlert(); }, 2000);
                });
                function closeAlert() {
                    const alertBox = document.getElementById('success-alert');
                    if (alertBox) {
                        alertBox.classList.remove('translate-y-0', 'opacity-100');
                        alertBox.classList.add('-translate-y-10', 'opacity-0');
                        setTimeout(() => { alertBox.remove(); }, 500);
                    }
                }
              </script>";
    } else {
      
        echo "<div id='failed-alert' class='fixed z-50 flex items-center gap-4 p-4 bg-white rounded-2xl shadow-2xl border border-gray-100 transition-all duration-500 ease-in-out transform translate-y-0 opacity-100 top-4 left-4 right-4 md:top-8 md:right-8 md:left-auto md:w-auto md:min-w-[320px]'>
                <div class='flex-shrink-0 flex items-center justify-center w-10 h-10 rounded-full bg-red-100'>
                    <svg class='w-6 h-6 text-red-600' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'></path></svg>
                </div>
                <div class='flex-1'>
                    <h4 class='text-sm font-bold text-gray-900'>Gagal!</h4>
                    <p class='text-sm text-gray-500 mt-0.5'>Gagal memperbarui data.</p>
                </div>
                <button onclick='closeFailedAlert()' class='text-gray-400 hover:text-gray-600 transition'><svg class='w-5 h-5' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12'></path></svg></button>
                <div class='absolute bottom-0 left-4 right-4 h-1 bg-gray-100 rounded-full overflow-hidden'><div id='progress-bar-failed' class='h-full bg-red-600 w-full transition-all duration-[2000ms] ease-linear'></div></div>
              </div>
              <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const progressBar = document.getElementById('progress-bar-failed');
                    if(progressBar) { setTimeout(() => { progressBar.style.width = '0%'; }, 100); }
                    setTimeout(() => { closeFailedAlert(); }, 2000);
                });
                function closeFailedAlert() {
                    const alertBox = document.getElementById('failed-alert');
                    if (alertBox) {
                        alertBox.classList.remove('translate-y-0', 'opacity-100');
                        alertBox.classList.add('-translate-y-10', 'opacity-0');
                        setTimeout(() => { alertBox.remove(); }, 500);
                    }
                }
              </script>";
    }
}
?>

<div class="max-w-5xl mx-auto p-4 md:p-8 bg-gray-50 min-h-screen">
    <div class="flex items-center gap-4 mb-8">
        <a href="./?page=daftar-produk" class="p-2 bg-white rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-100 transition shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Edit Produk</h2>
            <p class="text-sm text-gray-500">Perbarui informasi produk Anda</p>
        </div>
    </div>

    <form method="post" action="#" enctype="multipart/form-data">
        
        <input type="hidden" name="foto_lama" value="<?php echo $produk['foto_produk']; ?>">
        <div class="grid grid-cols-1 gap-4">
            
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 sticky top-8">
                    <label class="block text-sm font-bold text-gray-700 mb-4">Foto Produk</label>
                    
                    <div class="relative w-full h-64 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300 hover:border-green-500 hover:bg-green-50 transition-colors cursor-pointer group overflow-hidden flex items-center justify-center">
                        
                        <input type="file" name="foto_produk" id="foto_produk" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="previewImage(event)">
                        
                        <?php $hasImage = !empty($produk['foto_produk']); ?>
                        <div id="upload-placeholder" class="text-center p-6 group-hover:scale-105 transition-transform duration-300 <?php echo $hasImage ? 'hidden' : ''; ?>">
                            <div class="w-16 h-16 mx-auto bg-green-100 text-green-600 rounded-full flex items-center justify-center mb-3">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <p class="text-sm font-medium text-gray-900">Klik untuk ganti foto</p>
                            <p class="text-xs text-gray-500 mt-1">Format JPG, PNG (Max. 2MB)</p>
                        </div>

                        <img id="image-preview" 
                             src="<?php echo $hasImage ? '../Media/' . $produk['foto_produk'] : '#'; ?>" 
                             alt="Preview" 
                             class="<?php echo $hasImage ? '' : 'hidden'; ?> w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                
                <div class="bg-white p-6 md:p-8 rounded-xl shadow-md border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 border-b border-gray-100 pb-3">Informasi Dasar</h3>
                    
                    <div class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 space-x-3">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Produk</label>
                                <input type="text" name="nama_produk" required
                                       value="<?php echo htmlspecialchars($produk['nama_produk']); ?>"
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition text-gray-700">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Harga Satuan</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 pl-4 flex items-center text-gray-500 font-bold left-2">Rp</span>
                                    <input type="number" name="harga" min="100" required
                                           value="<?php echo $produk['harga']; ?>"
                                           class="w-full pl-12 pr-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition text-gray-700 font-semibold text-lg">
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 space-x-3">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                                <div class="relative">
                                    <select name="kategori_id" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 appearance-none bg-white text-gray-700 cursor-pointer">
                                        <option value="" disabled>Pilih Kategori</option>
                                        <?php 
                                        require_once '../config.php';
                                        // Pastikan fungsi ini ada atau ganti dengan array dummy jika perlu
                                        $categories = get_all_kategori(); 
                                        foreach($categories as $kategori){
                                            // Cek apakah ID kategori sama dengan produk, jika ya tambahkan 'selected'
                                            $selected = ($kategori['id'] == $produk['kategori_id']) ? 'selected' : '';
                                        ?>
                                        <option value="<?php echo $kategori['id'] ?>" <?php echo $selected; ?>>
                                            <?php echo $kategori['nama_kategori'] ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Stok</label>
                                <input type="number" name="stok" min="0" required
                                       value="<?php echo $produk['stok']; ?>"
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition text-gray-700">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Produk</label>
                            <textarea name="deskripsi" rows="4" placeholder="Jelaskan detail produk..." required
                                      class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 transition text-gray-700 resize-none"><?php echo htmlspecialchars($produk['deskripsi']); ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pt-4">
                    <a href="./?page=daftar-produk" class="px-8 py-3 bg-white text-green-600 rounded-lg font-bold shadow-lg hover:bg-slate-100 hover:shadow-xl transform hover:-translate-y-0.5 transition duration-200 flex items-center gap-2">
                        Batal
                    </a>
                    <input type="submit"  name="simpan" value="Simpan" class="px-8 py-3 bg-green-600 text-white rounded-lg font-bold shadow-lg hover:bg-green-700 hover:shadow-xl transform hover:-translate-y-0.5 transition duration-200 flex items-center gap-2">
                </div>

            </div>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        const imageField = document.getElementById("image-preview");
        const placeholder = document.getElementById("upload-placeholder");
        
        reader.onload = function(){
            if(reader.readyState == 2){
                imageField.src = reader.result;
                imageField.classList.remove("hidden");
                placeholder.classList.add("hidden");
            }
        }
        
        if(event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>