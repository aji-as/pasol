<?php
$id_order = $_GET['id'];
require_once "../config.php";
$order = get_order_by_id($id_order); 

// 1. LOGIKA KONFIRMASI SELESAI
if (isset($_POST['selesai'])){
    update_status($id_order,"selesai");

}


if (isset($_POST['kirim_ulasan'])){
    $rating = $_POST['rating'];
    update_is_rating($id_order,false);
    update_rating($rating,$order['product_id']);

}


// Helper warna badge
$status = $order["status_pesanan"];
$badgeColor = 'bg-yellow-100 text-yellow-800 border-yellow-200'; 
if($status == 'diproses') $badgeColor = 'bg-blue-100 text-blue-800 border-blue-200';
if($status == 'diantar') $badgeColor = 'bg-indigo-100 text-indigo-800 border-indigo-200';
if($status == 'selesai') $badgeColor = 'bg-green-100 text-green-800 border-green-200';

?>

<div class="max-w-6xl mx-auto p-4 md:p-8 bg-gray-50 min-h-screen font-sans">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-3">
            <a href="./?page=daftar-pesanan" class="p-2 rounded-lg bg-white border border-gray-200 text-gray-600 hover:bg-gray-100 transition shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Detail Pesanan Saya</h2>
                <p class="text-sm text-gray-400">ID Pesanan: #<?php echo $order['id']; ?> • <?php echo date('d F Y, H:i', strtotime($order['tanggal_pesan'])); ?></p>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
        
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex items-center justify-between bg-gray-50">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Rincian Barang
                    </h3>
                </div>
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row gap-6">
                        <div class="w-full sm:w-1/3">
                            <div class="aspect-w-4 aspect-h-3 rounded-lg overflow-hidden border border-gray-200">
                                <img src="../Media/<?php echo get_produk_by_id($order["product_id"])["foto_produk"] ?>" 
                                    alt="<?php echo $order['nama_produk']; ?>" 
                                    class="w-full h-48 sm:h-40 object-cover hover:scale-105 transition-transform duration-500">
                            </div>
                        </div>
                        <div class="w-full sm:w-2/3 flex flex-col justify-between">
                            <div>
                                <h4 class="text-xl font-bold text-gray-800 mb-2 leading-tight"><?php echo $order['nama_produk']; ?></h4>
                                <p class="text-gray-500 text-sm mb-4 line-clamp-2"><?php echo $order['deskripsi']; ?></p>
                            </div>
                            <div class="bg-white border border-gray-200 p-4 rounded-xl shadow-sm">
                                <div class="flex justify-between text-sm text-gray-600 mb-2">
                                    <span>Harga Satuan</span>
                                    <span>Rp <?php echo number_format($order['harga'], 0, ',', '.'); ?></span>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600 mb-2">
                                    <span>Jumlah</span>
                                    <span>x <?php echo $order['jumlah']; ?></span>
                                </div>
                                <div class="flex justify-between items-center pt-3 border-t border-dashed border-gray-200 mt-2">
                                    <span class="font-bold text-gray-800">Total Pembayaran</span>
                                    <span class="text-xl font-extrabold text-green-600">Rp <?php echo number_format($order['total_harga'], 0, ',', '.'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if(!empty($order['catatan'])): ?>
            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                <div class="p-4 bg-yellow-50 border-b border-yellow-100 flex items-center gap-2">
                    <h3 class="font-bold text-yellow-800 text-sm">Catatan Anda</h3>
                </div>
                <div class="p-6"><p class="text-gray-700 italic">"<?php echo $order['catatan']; ?>"</p></div>
            </div>
            <?php endif; ?>
        </div>

        <div class="lg:col-span-1 space-y-6">
            
            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 flex flex-col h-auto">
                
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 border-b border-gray-100 pb-4">
                    <h3 class="font-bold text-gray-700 text-sm uppercase tracking-wide">Status</h3>
                    <div class="self-start sm:self-auto">
                        <span class="px-4 py-1.5 rounded-full text-xs font-bold border <?php echo $badgeColor; ?> shadow-sm uppercase tracking-wider">
                            <?php echo ucfirst($order['status_pesanan']); ?>
                        </span>
                    </div>
                </div>

                <?php if ($order["status_pesanan"] == "diantar") { ?>
                    
                    <form method="post" action="#" class="mt-auto">
                        <p class="text-sm text-gray-500 mb-4">Apakah barang sudah Anda terima dengan baik?</p>
                        <button type="submit" name="selesai" value="selesai" 
                            class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-green-600 text-white font-bold rounded-lg shadow-md hover:bg-green-700 hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Konfirmasi Pesanan Selesai
                        </button>
                    </form>

                <?php } elseif ($order["status_pesanan"] == "selesai" && $order["is_rating"] == true){ ?>
                    
                    <form method="post" action="#"  class="mt-auto">
                        <h4 class="font-bold text-gray-800 text-center mb-1">Beri Penilaian</h4>
                        <p class="text-xs text-gray-400 text-center mb-4">Bagaimana kualitas produk ini?</p>

                        <div class="flex justify-center gap-3 mb-5">
                            <?php for($i=1; $i<=5; $i++): ?>
                            <label class="cursor-pointer group">
                                <div class="flex flex-col items-center">
                                    <input type="radio" name="rating" value="<?php echo $i; ?>" class="peer w-5 h-5 cursor-pointer text-yellow-400 focus:ring-yellow-400 border-gray-300" required>
                                    
                                    <span class="mt-1 text-xs font-medium text-gray-400 peer-checked:text-yellow-600 peer-checked:font-bold group-hover:text-yellow-500 transition-colors">
                                        <?php echo $i; ?>
                                    </span>
                                    
                                    <svg class="w-3 h-3 text-yellow-400 opacity-0 peer-checked:opacity-100 absolute -mt-4 transition-opacity" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                </div>
                            </label>
                            <?php endfor; ?>
                        </div>

                        <button type="submit" name="kirim_ulasan" 
                            class="w-full py-2 bg-yellow-400 text-yellow-900 font-bold rounded-lg shadow-sm hover:bg-yellow-500 hover:shadow transition-all text-sm">
                            Kirim Penilaian
                        </button>
                    </form>

                <?php }elseif($order["status_pesanan"] == "selesai" && $order["is_rating"] == false){?>
                    <div class="mt-auto text-center py-4 bg-gray-50 rounded-lg border border-gray-100 border-dashed">
                        <p class="text-sm text-gray-500">Pesanan selesai</p>
                        <p class="text-xs text-gray-400">Anda telah mengirimkan peratingan</p>
                    </div>


                <?php } else{ ?>
                    
                    <div class="mt-auto text-center py-4 bg-gray-50 rounded-lg border border-gray-100 border-dashed">
                        <p class="text-sm text-gray-500">Pesanan sedang dalam proses.</p>
                        <p class="text-xs text-gray-400">Mohon menunggu update selanjutnya.</p>
                    </div>

                <?php } ?>

            </div>

            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                <div class="p-4 bg-gray-50 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800 text-sm uppercase tracking-wide">Alamat Pengiriman</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-bold">Penerima</p>
                            <p class="text-gray-800 font-medium"><?php echo $order['nama']; ?></p>
                            <p class="text-gray-500 text-sm"><?php echo $order['nomor_hp']; ?></p>
                        </div>
                    </div>
                     <div class="flex items-start gap-3 pt-4 border-t border-gray-100">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-bold">Alamat</p>
                            <p class="text-gray-800 text-sm leading-relaxed"><?php echo $order['alamat']; ?></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>