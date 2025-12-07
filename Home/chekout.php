<?php

require_once "../config.php";

$productId = $_GET['id'];
$currentProduct = get_produk_by_id($productId);
$nama_penjual = get_name_user_by_id($currentProduct["penjual_id"]);
if ($_POST["simpan"]){
    $nama    = $_POST['name'];
    $telepon    = $_POST['phone'];
    $alamat   = $_POST['address'];
    $jumlah      = $_POST['qty'];
    $catatan     = $_POST['notes'];
    $total_harga = $currentProduct["harga"]*$jumlah;
    $result = add_order($currentProduct['id'],$nama,$id,$jumlah,$total_harga,$alamat,$catatan,$telepon);
    if($result){
        if($role === "pembeli"){
            header("location:../Pembeli/index.php?status=ok");
            exit;
        }elseif($role === "penjual"){
            header("location:./Penjual/index.php?status=ok");
        }   exit;
    }else{
        echo "<div class=' bg-red-100 text-center w-full mb-5 border border-red-400 text-red-700 px-4 py-3 rounded ' role='alert'>
                        <span class='font-medium'>Pesanan gagal dibuat</span>
                    </div>"
                    ;
    }
}



?>

    


<!-- =======================
    DETAIL PRODUK SECTION
======================= -->

<section class="max-w-4xl mx-auto  mt-6  px-3">
    <a href="produk.php" class="inline-flex items-center text-gray-text hover:text-green-600 transition-colors mb-4">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Kembali ke Katalog
    </a>
    <div class=" bg-white shadow-xl rounded-2xl px-4 sm:px-6 lg:px-8 py-8 mt-5">
            <h2 class="text-2xl font-bold text-dark mb-6">Detail Produk</h2>

            <!-- Foto Produk (kecil & di atas) -->
            <div class="w-full flex justify-center mb-6">
                <img src="../Media/<?php echo $currentProduct['foto_produk']; ?>" 
                    class="w-full max-w-md h-64 rounded-xl shadow-md object-cover">
            </div>

            <!-- Informasi produk di bawah gambar -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- =======================
                    Kolom Kiri
                    ======================= -->
                <div class="space-y-4">

                    <p class="text-lg">
                        <span class="font-semibold text-dark">Nama Produk:</span><br>
                        <?php echo $currentProduct['nama_produk']; ?>
                    </p>

                    <p class="text-lg">
                        <span class="font-semibold text-dark">Penjual:</span><br>
                        <?php echo $nama_penjual; ?>
                    </p>

                    <p class="text-lg">
                        <span class="font-semibold text-dark">Harga:</span><br>
                        <span class="text-green-600 font-bold text-xl">
                            Rp <?php echo number_format($currentProduct['harga'], 0, ',', '.'); ?>
                        </span>
                    </p>

                    <p class="text-lg">
                        <span class="font-semibold text-dark">Stok:</span><br>
                        <?php echo $currentProduct['stok']; ?>
                    </p>

                    <p class="text-lg">
                        <span class="font-semibold text-dark">Kategori:</span><br>
                        <?php echo get_kategori_by_id($currentProduct['kategori_id']); ?>
                    </p>

                </div>

                <!-- =======================
                    Kolom Kanan (Deskripsi)
                    ======================= -->
                <div>
                    <p class="font-semibold text-dark text-lg mb-2">Deskripsi Produk:</p>
                    <p class="text-gray-600 leading-relaxed whitespace-pre-line">
                        <?php echo nl2br($currentProduct['deskripsi']); ?>
                    </p>
                </div>

            </div>
    </div>


</section>




    
    
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-dark">Checkout</h1>
        </div>
        <form id="checkoutForm" class="space-y-4" method="post">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
                        <h2 class="text-lg font-semibold text-dark mb-4">Informasi Pembeli</h2>
                            <div>
                                <label for="name" class="block text-sm font-medium text-dark mb-2">Nama Lengkap *</label>
                                <input type="text" id="name" name="name" required placeholder="Masukkan nama lengkap Anda" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="phone" class="block text-sm font-medium text-dark mb-2">Nomor Telepon *</label>
                                <input type="tel" id="phone" name="phone" required placeholder="Contoh: 081234567890" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="address" class="block text-sm font-medium text-dark mb-2">Alamat Lengkap *</label>
                                <textarea id="address" name="address" rows="3" required placeholder="Contoh: Blok A5 No. 10, Perumahan Griya Indah" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none"></textarea>
                            </div>

                            <div>
                                <label for="qty" class="block text-sm font-medium text-dark mb-2">Jumlah *</label>
                                <input type="number" id="qty" name="qty" min="1" value="1"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>

                            
                            <div>
                                <label for="notes" class="block text-sm font-medium text-dark mb-2">Catatan Pesanan (Opsional)</label>
                                <textarea id="notes" name="notes" rows="2" placeholder="Contoh: Extra pedas, tanpa sayur, dll" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none"></textarea>
                            </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm p-6 sticky top-24">
                        <h2 class="text-lg font-semibold text-dark mb-4">Ringkasan Pesanan</h2>
                        
                        <div id="productSummary" class="mb-6">
                            <!-- Produk akan ditampilkan di sini -->
                        </div>
                        
                        <div class="border-t border-gray-100 pt-4 mb-6">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-text">Total</span>
                                <span id="totalPrice" class="text-xl font-bold text-green-600"></span>
                            </div>
                        </div>
                        
                        <input value="Chekout" type="submit" name="simpan" class="w-full flex items-center justify-center px-6 py-4 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition-all duration-300 shadow-md hover:shadow-lg">
                        <p class="text-xs text-gray-text text-center mt-4">
                            Dengan menekan tombol di atas, Pesanan anda akan di buat
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </main>







<script>
    const currentProduct = <?php echo json_encode($currentProduct); ?>;
    const namaPenjual = <?php echo json_encode($nama_penjual); ?>;

    const productSummary = document.getElementById('productSummary');
    const totalPrice = document.getElementById('totalPrice');
    const qtyInput = document.getElementById("qty");

    if (currentProduct) {
        productSummary.innerHTML = `
            <div class="flex items-start space-x-4">
                <div class="w-20 h-full bg-gray-100 rounded-xl overflow-hidden flex-shrink-0">
                    <img src="../Media/${currentProduct.foto_produk}" class="w-full h-full object-cover">
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-dark">${currentProduct.nama_produk}</h3>
                    <p class="text-sm text-gray-text">${namaPenjual}</p>
                    <p class="text-green-600 font-medium mt-1">Rp ${new Intl.NumberFormat().format(currentProduct.harga)}</p>
                </div>
            </div>
        `;

        updateTotal();
    } else {
        productSummary.innerHTML = `
            <div class="text-center py-8">
                <p class="text-gray-text">Produk tidak ditemukan</p>
                <a href="produk.php" class="text-green-600 hover:underline text-sm">Kembali ke katalog</a>
            </div>
        `;
        totalPrice.textContent = 0;
    }

    function updateTotal() {
        const qty = parseInt(qtyInput.value) || 1;
        const total = currentProduct.harga * qty;
        totalPrice.textContent = "Rp " + new Intl.NumberFormat().format(total);
    }

    qtyInput.addEventListener("input", updateTotal);
</script>



