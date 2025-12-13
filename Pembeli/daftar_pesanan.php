
<?php 
 require_once "../config.php";
$status = $_POST['status'];

if (isset($status) && $status != "all") {
    $orders = get_order_by_user_and_status(
        $id_user,
        $status
);
} else {
    $orders = get_order_by_user($id_user);

}
?>



<div class="p-4 md:p-8 bg-gray-50 min-h-screen">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-3">

        <!-- JUDUL -->
        <h2 class="text-lg md:text-xl font-bold text-gray-900">
            Daftar pesanan anda
        </h2>

        <!-- SELECT FILTER KATEGORI -->
        <form method="post" class="w-full md:w-auto">
            <select 
                name="status" 
                onchange="this.form.submit()" 
                class="w-full md:w-56 px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500"
            >
                <option value="all">Semua Status</option>
                    <option value="menunggu" 
                        <?php if($status == "menunguu") echo "selected"; ?>>
                        Menunggu
                    </option>
                    <option value="diproses" 
                        <?php if($status == "diproses") echo "selected"; ?>>
                        Diproses
                    </option>
                    <option value="diantar" 
                        <?php if($status == "diantar") echo "selected"; ?>>
                        Diantar
                    </option>
                    <option value="selesai" 
                        <?php if($status == "selesai") echo "selected"; ?>>
                        Selesai
                    </option>

            </select>
        </form>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php
            foreach($orders as $order){
    
        ?>
        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-1 overflow-hidden border border-gray-100 flex flex-col">
            <div class="relative">
                <img src="../Media/<?php echo get_produk_by_id($order["product_id"])["foto_produk"] ?>" alt="Nasi Goreng Spesial" class="w-full h-40 md:h-48 object-cover object-center">
                <span class="absolute top-3 left-3 text-green-700 text-[10px] md:text-xs font-bold bg-green-100 px-2 py-1 rounded-full shadow-sm">
                    <?php echo ucfirst($order['status_pesanan']) ?>
                </span>
            </div>
            
            <div class="p-4  flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1 leading-tight"><?php echo get_name_produk_by_id($order["product_id"])?></h3>
                    <p class="text-sm text-gray-500 mb-4 line-clamp-2">Penjual: <?php echo get_name_user_by_id(get_produk_by_id($order["product_id"])["penjual_id"] ) ?></p>
                </div>
                
                <div class="flex justify-between items-center pt-3 border-t border-gray-100 mt-auto">
                    <span class="text-sm md:text-md font-bold  text-green-700">
                       Total: Rp <?php echo number_format($order['total_harga'])?>
                    </span>
                    
                    <a href="./?page=detail-pesanan&id=<?php echo $order['id'] ?>" class="bg-green-600 text-white font-medium text-sm px-4 py-2 rounded-lg hover:bg-green-700 transition shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        <?php } ?>
        

     <?php if(empty($orders)): ?>
            <div class="col-span-full text-center py-10">
                <p class="text-gray-500 text-lg">Tidak ada pesanan untuk saat ini silahkan lakukan pembelian</p>
            </div>
     <?php endif; ?>

    </div>
</div>