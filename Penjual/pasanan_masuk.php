<div class="p-4 md:p-8 bg-gray-50 min-h-screen">
    <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-6 border-b-4 border-green-600 pb-2 inline-flex items-center gap-2 tracking-tight">
        📦 Daftar Pesanan Masuk
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php
            require_once "../config.php";
            
            // Mengambil pesanan yang masuk ke penjual
            $orders = get_order_from_produk($id_user); 
            
            foreach($orders as $order){
                $produk = get_produk_by_id($order["product_id"]);
                $qty = $order['jumlah'] ?? 1;
                $total = $order['total_harga'];
                $harga_satuan = $total / $qty; 
        ?>
        
        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-1 overflow-hidden border border-gray-100 flex flex-col h-full">
            
            <div class="relative group">
                <img src="../Media/<?php echo $produk["foto_produk"] ?>" 
                     alt="<?php echo $produk["nama_produk"] ?>" 
                     class="w-full h-40 md:h-48 object-cover object-center group-hover:scale-105 transition duration-500">
                
                <?php 
                    $statusColor = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                    if(strtolower($order["status_pesanan"]) == 'dikirim') $statusColor = 'bg-blue-100 text-blue-800 border-blue-200';
                    if(strtolower($order["status_pesanan"]) == 'selesai') $statusColor = 'bg-green-100 text-green-800 border-green-200';
                    if(strtolower($order["status_pesanan"]) == 'batal') $statusColor = 'bg-red-100 text-red-800 border-red-200';
                ?>
                <span class="absolute top-3 left-3 <?php echo $statusColor; ?> text-[10px] md:text-xs font-bold px-3 py-1 rounded-full shadow-sm border backdrop-blur-sm">
                    <?php echo ucfirst($order["status_pesanan"]) ?>
                </span>
            </div>
            
            <div class="p-4 flex flex-col justify-between flex-grow">
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1 leading-tight line-clamp-1" title="<?php echo get_name_produk_by_id($order["product_id"])?>">
                        <?php echo get_name_produk_by_id($order["product_id"])?>
                    </h3>

                    <div class="flex flex-col gap-1 mb-3">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <span class="truncate font-medium"><?php echo get_name_user_by_id($order["pembeli_id"]) ?></span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-gray-400 ml-6">
                            <span>📅 <?php echo date('d M Y', strtotime($order['tanggal_pemesanan'] ?? 'now')); ?></span>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-3 border border-gray-100 mb-4 space-y-2">
                        <div class="flex justify-between text-xs text-gray-500">
                            <span>Harga Satuan</span>
                            <span>Rp <?php echo number_format($harga_satuan) ?></span>
                        </div>
                        <div class="flex justify-between text-xs text-gray-500">
                            <span>Jumlah (Qty)</span>
                            <span class="font-bold text-gray-700">x <?php echo $qty ?></span>
                        </div>
                        <div class="border-t border-gray-200 pt-2 flex justify-between items-center">
                            <span class="text-sm font-semibold text-gray-700">Total</span>
                            <span class="text-md font-bold text-green-700">Rp <?php echo number_format($total)?></span>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-3 pt-2 mt-auto border-t border-gray-100">
                    <a href="./?page=detail-pesanan&id=<?php echo $order['id']; ?>" 
                       class="flex items-center justify-center px-4 py-2 bg-white text-gray-700 text-sm font-semibold rounded-lg border border-gray-300 hover:bg-gray-50 hover:text-gray-900 transition focus:ring-2 focus:ring-gray-200">
                        Detail
                    </a>

                    <a href="proses_pesanan.php?id=<?php echo $order['id_pesanan']; ?>" 
                       class="flex items-center justify-center px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition shadow-md hover:shadow-lg focus:ring-2 focus:ring-green-500 focus:ring-offset-1">
                        Proses
                    </a>
                </div>
            </div>
        </div>

        <?php } ?>
        
        <?php if(empty($orders)): ?>
            <div class="col-span-full flex flex-col items-center justify-center py-12 text-center bg-white rounded-xl border border-dashed border-gray-300">
                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414a1 1 0 00-.707-.293H4"></path></svg>
                <p class="text-gray-500 text-lg font-medium">Belum ada pesanan masuk.</p>
                <p class="text-gray-400 text-sm">Pesanan baru akan muncul di sini.</p>
            </div>
        <?php endif; ?>

    </div>
</div>