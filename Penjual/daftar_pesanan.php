<div class="p-4 md:p-8 bg-gray-50 min-h-screen">
    <h2 class="text-md md:text-xl font-bold text-gray-900 mb-6 border-b-4 border-green-600 pb-2 inline-block tracking-tight">
        Daftar  Pesanan Anda
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php
            require_once "../config.php";
            $orders = get_order_by_user($id_user);
            foreach($orders as $order){
    
        ?>
        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-1 overflow-hidden border border-gray-100 flex flex-col">
            <div class="relative">
                <img src="../Media/<?php echo get_produk_by_id($order["product_id"])["foto_produk"] ?>" alt="Nasi Goreng Spesial" class="w-full h-40 md:h-48 object-cover object-center">
                <span class="absolute top-3 left-3 text-green-700 text-[10px] md:text-xs font-bold bg-green-100 px-2 py-1 rounded-full shadow-sm">
                    <?php echo $order["status_pesanan"] ?>
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
                    
                    <a href="./page=detail-produk&id=<?php $order['id']?>" class="bg-green-600 text-white font-medium text-sm px-4 py-2 rounded-lg hover:bg-green-700 transition shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        <?php } ?>
        
        
        <?php if($order ==null){
            echo"<div class='col-span-full text-center py-10'>
                <p class=   'text-gray-500 text-lg'>Belum ada pemesanan yang anda lakukan</p>
                </div>" ;
        }?>
            
            

    </div>
</div>