<?php

require_once "../config.php";

$productId = $_GET['id'];
$produk = get_produk_by_id($productId);
$nama_penjual = get_name_user_by_id($produk["penjual_id"]);

// TAMBAHAN: Ambil data user lengkap untuk mengecek status 'store'
// Asumsi $id adalah variabel session ID user yang login (sesuai kode add_order di bawah)
$pembeli = get_user_by_id($id); 

if ($_POST["simpan"]){
    $nama    = $_POST['name'];
    $telepon    = $_POST['phone'];
    $alamat   = $_POST['address'];
    $jumlah      = $_POST['qty'];
    $catatan     = $_POST['notes'];
    $metode_bayar = $_POST['payment_method']; 
    $total_harga = $produk["harga"]*$jumlah;

    $bukti_tf =   $_FILES['bukti_pembayaran']['name'];
    $tmp = $_FILES['bukti_pembayaran']['tmp_name'];
    move_uploaded_file($tmp, "../Media/bukti_tf/".$gambar);
    
    $result = add_order($produk['id'],$nama,$id,$jumlah,$total_harga,$alamat,$catatan,$telepon,$bukti_tf,$metode_bayar);
    if($result){
        if($pembeli['history']) edit_hostori_pebelian(false,$id);
        if($role === "pembeli"){
            header("location:../Pembeli/index.php?status=ok");
            exit;
        }elseif($role === "penjual"){
            header("location:./Penjual/index.php?status=ok");
        }   exit;
    }else{
        echo "<div class=' bg-red-100 text-center w-full mb-5 border border-red-400 text-red-700 px-4 py-3 rounded ' role='alert'>
                        <span class='font-medium'>Pesanan gagal dibuat</span>
                    </div>";
    }
}
?>

<section class="max-w-4xl mx-auto  mt-6  px-3">
    <a href="produk.php" class="inline-flex items-center text-gray-text hover:text-green-600 transition-colors mb-4">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Kembali ke Katalog
    </a>
    <div class=" bg-white shadow-xl rounded-2xl px-4 sm:px-6 lg:px-8 py-8 mt-5">
            <h2 class="text-2xl font-bold text-dark mb-6">Detail Produk</h2>
            <div class="w-full flex justify-center mb-6">
                <img src="../Media/<?php echo $produk['foto_produk']; ?>" 
                    class="w-full max-w-md h-64 rounded-xl shadow-md object-cover">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-4">
                    <p class="text-lg"><span class="font-semibold text-dark">Nama Produk:</span><br><?php echo $produk['nama_produk']; ?></p>
                    <p class="text-lg"><span class="font-semibold text-dark">Penjual:</span><br><?php echo $nama_penjual; ?></p>
                    <p class="text-lg"><span class="font-semibold text-dark">Harga:</span><br>
                        <span class="text-green-600 font-bold text-xl">Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></span>
                    </p>
                    <p class="text-lg"><span class="font-semibold text-dark">Stok:</span><br><?php echo $produk['stok']; ?></p>
                    <p class="text-lg"><span class="font-semibold text-dark">Kategori:</span><br><?php echo get_kategori_by_id($produk['kategori_id']); ?></p>
                </div>
                <div>
                    <p class="font-semibold text-dark text-lg mb-2">Deskripsi Produk:</p>
                    <p class="text-gray-600 leading-relaxed whitespace-pre-line"><?php echo nl2br($produk['deskripsi']); ?></p>
                </div>
            </div>
    </div>
</section>

<main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-dark">Checkout</h1>
    </div>
    
    <form id="checkoutForm" class="space-y-4" method="post" enctype="multipart/form-data">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                
                <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
                    <h2 class="text-lg font-semibold text-dark mb-4">Informasi Pembeli</h2>
                        <div>
                            <label for="name" class="block text-sm font-medium text-dark mb-2">Nama Lengkap *</label>
                            <input type="text" id="name" name="name" required placeholder="Masukkan nama lengkap Anda" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>
                        <div class="mt-4">
                            <label for="phone" class="block text-sm font-medium text-dark mb-2">Nomor Telepon *</label>
                            <input type="tel" id="phone" name="phone" required placeholder="Contoh: 081234567890" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>
                        <div class="mt-4">
                            <label for="address" class="block text-sm font-medium text-dark mb-2">Alamat Lengkap *</label>
                            <textarea id="address" name="address" rows="3" required placeholder="Contoh: Blok A5 No. 10, Perumahan Griya Indah" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none"></textarea>
                        </div>
                        <div class="mt-4">
                            <label for="qty" class="block text-sm font-medium text-dark mb-2">Jumlah *</label>
                            <input type="number" id="qty" name="qty" min="1" value="1" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>
                        <div class="mt-4">
                            <label for="notes" class="block text-sm font-medium text-dark mb-2">Catatan Pesanan (Opsional)</label>
                            <textarea id="notes" name="notes" rows="2" placeholder="Contoh: Extra pedas, tanpa sayur, dll" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none"></textarea>
                        </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
                    <h2 class="text-lg font-semibold text-dark mb-4">Metode Pembayaran</h2>

                    <div class="flex flex-col sm:flex-row gap-4 mb-6">
                        
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="payment_method" value="tf" class="peer sr-only" checked onchange="togglePaymentMethod()">
                            <div class="rounded-xl border-2 border-gray-200 peer-checked:border-green-600 peer-checked:bg-green-50 p-4 transition-all">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="font-semibold text-dark">Transfer Bank</span>
                                    <svg class="w-5 h-5 text-green-600 opacity-0 peer-checked:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <p class="text-sm text-gray-500">BCA, Mandiri, BRI</p>
                            </div>
                        </label>

                        <?php if ($pembeli['history'] === 0): ?>
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="payment_method" value="cod" class="peer sr-only" onchange="togglePaymentMethod()">
                            <div class="rounded-xl border-2 border-gray-200 peer-checked:border-green-600 peer-checked:bg-green-50 p-4 transition-all">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="font-semibold text-dark">COD (Bayar di Tempat)</span>
                                    <svg class="w-5 h-5 text-green-600 opacity-0 peer-checked:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <p class="text-sm text-gray-500">Bayar tunai saat barang sampai</p>
                            </div>
                        </label>
                        <?php endif; ?>

                    </div>
                    
                    <div id="transferArea">
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-5 flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">Rekening Tujuan:</h3>
                                <div class="mt-1 text-sm text-blue-700">
                                    <p class="font-bold text-lg">BCA: 123-456-7890</p>
                                    <p>A.N. Nama Penjual / Toko</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="bukti_pembayaran" class="block text-sm font-medium text-dark mb-2">Upload Bukti Pembayaran *</label>
                            
                            <div class="flex flex-col items-center justify-center w-full">
                                <label for="bukti_pembayaran" class="flex flex-col items-center justify-center w-full h-auto min-h-[128px] border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors relative overflow-hidden p-4">
                                    
                                    <div id="upload-placeholder" class="flex flex-col items-center justify-center">
                                        <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> bukti transfer</p>
                                        <p class="text-xs text-gray-500">PNG, JPG or JPEG (Max. 2MB)</p>
                                    </div>

                                    <img id="img-preview" class="hidden w-full max-h-64 object-contain rounded-lg shadow-sm z-10" />

                                    <input id="bukti_pembayaran" name="bukti_pembayaran" type="file" class="hidden" required accept="image/png, image/jpeg, image/jpg" />
                                </label>
                            </div>
                            
                            <div id="file-preview-name" class="mt-2 text-sm text-green-600 font-medium hidden text-center"></div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm p-6 sticky top-24">
                    <h2 class="text-lg font-semibold text-dark mb-4">Ringkasan Pesanan</h2>
                    <div id="productSummary" class="mb-6"></div>
                    <div class="border-t border-gray-100 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-text">Total</span>
                            <span id="totalPrice" class="text-xl font-bold text-green-600"></span>
                        </div>
                    </div>
                    
                    <input value="Buat Pesanan" type="submit" name="simpan" class="w-full flex items-center justify-center px-6 py-4 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer">
                    <p class="text-xs text-gray-text text-center mt-4">
                        Pastikan data pesanan sudah benar.
                    </p>
                </div>
            </div>
        </div>
    </form>
</main>

<script>
    const currentProduct = <?php echo json_encode($produk); ?>;
    const namaPenjual = <?php echo json_encode($nama_penjual); ?>;

    // Elements
    const productSummary = document.getElementById('productSummary');
    const totalPrice = document.getElementById('totalPrice');
    const qtyInput = document.getElementById("qty");
    
    // Elements Pembayaran
    const transferArea = document.getElementById('transferArea');
    const buktiInput = document.getElementById('bukti_pembayaran');
    const filePreviewName = document.getElementById('file-preview-name');
    const imgPreview = document.getElementById('img-preview');
    const uploadPlaceholder = document.getElementById('upload-placeholder');
    const paymentMethods = document.getElementsByName('payment_method');

    // --- 1. LOGIKA PRODUK & HARGA ---
    if (currentProduct) {
        productSummary.innerHTML = `
            <div class="flex items-start space-x-4">
                <div class="w-20 h-full bg-gray-100 rounded-xl overflow-hidden flex-shrink-0">
                    <img src="../Media/${currentProduct.foto_produk}" class="w-full h-full object-cover">
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-dark">${currentProduct.nama_produk}</h3>
                    <p class="text-sm text-gray-text">${namaPenjual}</p>
                    <p class="text-green-600 font-medium mt-1">Rp ${new Intl.NumberFormat('id-ID').format(currentProduct.harga)}</p>
                </div>
            </div>
        `;
        updateTotal();
    } else {
        totalPrice.textContent = 0;
    }

    function updateTotal() {
        const qty = parseInt(qtyInput.value) || 1;
        const total = currentProduct.harga * qty;
        totalPrice.textContent = "Rp " + new Intl.NumberFormat('id-ID').format(total);
    }
    qtyInput.addEventListener("input", updateTotal);

    // --- 2. LOGIKA PREVIEW GAMBAR (FileReader) ---
    buktiInput.addEventListener('change', function() {
        const file = this.files[0];
        
        if (file) {
            // Tampilkan Nama File
            filePreviewName.textContent = "File terpilih: " + file.name;
            filePreviewName.classList.remove('hidden');

            // Baca File Gambar untuk Preview
            const reader = new FileReader();
            reader.onload = function(e) {
                imgPreview.src = e.target.result;
                imgPreview.classList.remove('hidden'); // Munculkan gambar
                uploadPlaceholder.classList.add('hidden'); // Sembunyikan icon upload text
            }
            reader.readAsDataURL(file);
        } else {
            resetPreview();
        }
    });

    function resetPreview() {
        buktiInput.value = ""; 
        filePreviewName.classList.add('hidden');
        imgPreview.classList.add('hidden');
        imgPreview.src = "";
        uploadPlaceholder.classList.remove('hidden');
    }

    // --- 3. LOGIKA TOGGLE METODE PEMBAYARAN ---
    function togglePaymentMethod() {
        let selectedValue;
        for (const method of paymentMethods) {
            if (method.checked) {
                selectedValue = method.value;
                break;
            }
        }

        if (selectedValue === 'cod') {
            // Mode COD: Sembunyikan area transfer, hapus required, reset file
            transferArea.classList.add('hidden');
            buktiInput.required = false;
            resetPreview(); // Hapus file yang sudah diupload jika pindah ke COD
        } else {
            // Mode Transfer: Tampilkan area transfer, set required
            transferArea.classList.remove('hidden');
            buktiInput.required = true;
        }
    }

    // Pasang listener untuk radio button
    for (const method of paymentMethods) {
        method.addEventListener('change', togglePaymentMethod);
    }

    // Jalankan sekali saat load
    togglePaymentMethod();
</script>