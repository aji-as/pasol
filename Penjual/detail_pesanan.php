<?php

$id_order = $_GET['id'];
require_once "../config.php";
$order = get_order_by_id($id_order); 

$status = get_order_by_id($id_order)['status_pesanan'];



if ($_POST['proses']){
    if($status == "menunggu"){
        update_status($id_order,"diproses");
    }elseif($status == "diproses"){
        update_status($id_order,"diantar");
    }

}


if($status == "menunggu"){
    $status_ = "Proses";
   
}elseif($status == "diproses"){
        $status_ = "Kirim";
        
}elseif($status == "diantar"){
        $status_ = "Diantar";
    }
elseif($status == "selesai"){
        $status_ = "Pesanan selesai";
    }


// Helper untuk warna status (Sama seperti di card dashboard)
$status = strtolower($order['status_pesanan']);
$badgeColor = 'bg-yellow-100 text-yellow-800 border-yellow-200'; 
if($status == 'diproses') $badgeColor = 'bg-blue-100 text-blue-800 border-blue-200';
if($status == 'diantar') $badgeColor = 'bg-indigo-100 text-indigo-800 border-indigo-200';
if($status == 'selesai') $badgeColor = 'bg-green-100 text-green-800 border-green-200';
if($status == 'menunggu') $badgeColor = 'bg-red-100 text-red-800 border-red-200';
?>

<div class="max-w-6xl mx-auto p-4 md:p-8 bg-gray-50 min-h-screen font-sans">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-3">
            <a href="./?page=pesanan-masuk" class="p-2 rounded-lg bg-white border border-gray-200 text-gray-600 hover:bg-gray-100 transition shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Detail Pesanan</h2>
              <span class="text-gray-400"><?php echo date('d F Y, H:i', strtotime($order['tanggal_pesan'])); ?></span></p>
            </div>
        </div>
        
        <div class="self-start md:self-auto">
            <span class="px-4 py-2 rounded-full text-sm font-bold border <?php echo $badgeColor; ?> shadow-sm">
                Status: <?php echo ucfirst($order['status_pesanan']); ?>
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
        
        <div class="lg:col-span-2 space-y-6">
            
            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Item Dibeli
                    </h3>
                </div>
                
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row gap-6">
                        <div class="w-full sm:w-1/3">
                            <img src="../Media/<?php echo get_produk_by_id($order["product_id"])["foto_produk"] ?>" 
                                 alt="<?php echo $order['nama_produk']; ?>" 
                                 class="w-full h-48 sm:h-40 object-cover rounded-lg shadow-sm border border-gray-200">
                        </div>
                        
                        <div class="w-full sm:w-2/3 flex flex-col justify-between">
                            <div>
                                <h4 class="text-xl font-bold text-gray-800 mb-2"><?php echo $order['nama_produk']; ?></h4>
                                <p class="text-gray-500 text-sm mb-4 line-clamp-2"><?php echo $order['deskripsi']; ?></p>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                <div class="flex justify-between text-sm text-gray-600 mb-2">
                                    <span>Harga Satuan</span>
                                    <span>Rp <?php echo number_format($order['harga']); ?></span>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600 mb-2">
                                    <span>Jumlah</span>
                                    <span>x <?php echo $order['jumlah']; ?></span>
                                </div>
                                <div class="flex justify-between items-center pt-2 border-t border-gray-200">
                                    <span class="font-bold text-gray-800">Total Harga</span>
                                    <span class="text-xl font-extrabold text-green-600">Rp <?php echo number_format($order['total_harga']); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if(!empty($order['catatan'])): ?>
            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                <div class="p-4 bg-yellow-50 border-b border-yellow-100 flex items-center gap-2">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    <h3 class="font-bold text-yellow-800">Catatan dari Pembeli</h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 italic">"<?php echo $order['catatan']; ?>"</p>
                </div>
            </div>
            <?php endif; ?>

        </div>

        <div class="lg:col-span-1 space-y-6">
            
            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                <div class="p-4 bg-gray-50 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800 text-sm uppercase tracking-wide">Informasi Pengiriman</h3>
                </div>
                
                <div class="p-6 space-y-5">
                    <div class="flex items-start gap-3">
                        <div class="mt-1 bg-green-100 p-1.5 rounded-full">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase">Nama Pembeli</p>
                            <p class="text-gray-800 font-semibold"><?php echo $order['nama']; ?></p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="mt-1 bg-green-100 p-1.5 rounded-full">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase">No. WhatsApp/HP</p>
                            <p class="text-gray-800 font-medium"><?php echo $order['nomor_hp']; ?></p>
                            <a href="https://wa.me/62<?php echo ltrim($order['nomor_hp'], '0'); ?>" target="_blank" class="text-xs text-green-600 hover:underline mt-1 inline-block">Hubungi via WhatsApp</a>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="mt-1 bg-green-100 p-1.5 rounded-full">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase">Alamat Tujuan</p>
                            <p class="text-gray-800 text-sm leading-relaxed"><?php echo $order['alamat']; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
                <h3 class="font-bold text-gray-800 mb-4 text-sm">Update Status Pesanan</h3>
                <div class="flex flex-col gap-3">
                    <form method="POST" >
                        <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
                        <input value="<?php echo $status_?>" name="proses"    type="submit" class="flex items-center justify-center px-4 py-2 text-white bg-green-500 text-sm font-semibold rounded-lg hover:bg-green-700 transition shadow-md hover:shadow-lg focus:ring-2 focus:ring-green-500 focus:ring-offset-1">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>