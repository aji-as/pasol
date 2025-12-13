<?php 
require_once "config.php";

error_reporting(0);


$keyword = $_POST['keyword'];
if (!empty($keyword)){
    $products = get_all_produk_by_keyword($keyword);

}



if (isset($_POST["pilih_kategori"])) {
    $kategori = $_POST["kategori"];
    $products = get_all_produk_by_category(get_id_kategori($kategori));
}elseif(!empty($keyword)){
    $products = get_all_produk_by_keyword($keyword);
}else{
    $products = get_all_produk();
}


?>

<style>
    /* Hide scrollbar for Chrome, Safari and Opera */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    /* Hide scrollbar for IE, Edge and Firefox */
    .no-scrollbar {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
</style>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="mb-6">
        <h1 class="text-2xl md:text-3xl font-bold text-dark mb-2">Katalog Produk</h1>
        <p class="text-gray-500">Temukan berbagai makanan dan minuman dari warga perumahan</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-2 mb-6">
        <form action="#" method="post">
            <div class="relative w-full">
                <button class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" name="search">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
                <input
                    value="<?php $keyword ?>"
                    name="keyword"
                    type="text" 
                    placeholder="Cari produk lezat..." 
                    class="w-full pl-12 pr-4 py-3 border-none rounded-xl focus:ring-0 text-gray-700 placeholder-gray-400"
                >
            </div>
        </form>
    </div>

    <div class="mb-8">
        <div class="flex space-x-3 overflow-x-auto no-scrollbar pb-2">
            
            <form method="post" class="flex-shrink-0">
                <button type="submit" 
                        name="semua_kategori"
                        class="px-5 py-2.5  lg:px-8 lg:py-3  rounded-full text-sm lg:text-lg font-medium transition-colors duration-200 bg-gray-100 hover:bg-gray-200 text-gray-700">
                    Semua
                </button>
            </form>

            <?php 
            require_once "config.php";
            $catagories = get_all_kategori(); 
            
            foreach($catagories as $kategori){
            ?>
                <form method="post" class="flex-shrink-0 ">
                    <input type="hidden" name="kategori" value="<?php echo $kategori['nama_kategori'] ?>">
                    
                    <button type="submit" name="pilih_kategori"
                            class="px-5 py-2.5 lg:px-16 lg:py-3 rounded-full text-sm lg:text-lg font-medium transition-colors duration-200 whitespace-nowrap bg-white border border-gray-200 text-gray-600 hover:bg-green-50 hover:text-green-600">
                        <?php echo $kategori['nama_kategori'] ?>
                    </button>
                </form>
            <?php } ?>
        </div>
    </div>


    <?php if (empty($products)) { ?>
        
        <div class="text-center py-12">
            <p class="text-gray-500">Belum ada produk di kategori ini.</p>
        </div>

    <?php } else { ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($products as $produk) {

                $rating = $produk['jumlah_perating'] != 0 
                ? get_ratting_by_id($produk['id']) / $produk['jumlah_perating'] 
                : 0;


                ?>
            
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 group">
                    <div class="aspect-[4/3] bg-gray-100 overflow-hidden relative">
                        <img src="../Media/<?php echo $produk['foto_produk']; ?>"
                            alt="Produk"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        
                        <span class="absolute top-3 left-3 px-2.5 py-1 text-xs font-bold bg-white/90 backdrop-blur-sm text-green-700 rounded-lg shadow-sm">
                            <?php echo get_kategori_by_id($produk["kategori_id"]) ?>
                        </span>
                    </div>

                    <div class="p-5">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-lg font-bold text-gray-800 line-clamp-1 group-hover:text-green-600 transition-colors">
                                <?php echo $produk['nama_produk']?>
                            </h3>
                            <div class="flex items-center gap-1 bg-yellow-50 px-2 py-1 rounded-md">
                                <svg class="w-3.5 h-3.5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="text-xs font-bold text-gray-700"><?php echo number_format($rating, 1); ?>/5</span>
                                <p class=" text-xs font-bold text-gray-700 ">(<?php echo $produk['jumlah_perating']  ?>)</p>
                            </div> 
                        </div>
                        <p class="text-gray-500 text-sm mb-4 flex items-center gap-1">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <?php echo get_name_user_by_id($produk['penjual_id']) ?>
                        </p>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-400">Harga</span>
                                <span class="text-lg font-bold text-green-600">
                                    Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?>
                                </span>
                            </div>
                            <a href="login.php" 
                            class="px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-xl hover:bg-green-700 active:scale-95 transition-all shadow-green-200 shadow-lg">
                                Beli Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>

</main>