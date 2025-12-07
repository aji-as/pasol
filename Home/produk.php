<?php 
require_once "../config.php";

$category = $_POST["category"];
$keyword  = $_POST["keyword"];
if(empty($keyword) and $category ="all" ){
    $products = get_all_produk();
}elseif(!empty($keyword) and empty($category)  ){

}


?>





<!-- MAIN -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-dark mb-2">Katalog Produk</h1>
            <p class="text-gray-text">Temukan berbagai makanan dan minuman dari warga perumahan</p>
        </div>

        <form action="#" method="post">
            <div class="bg-white rounded-2xl shadow-sm p-4 mb-8">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 relative">
                        <button class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" type="submit" >
                            <svg class="" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        </button>
                        
                        <input
                            name="keyword"
                            type="text" 
                            value="<?php echo $keyword ?>"
                            id="searchInput" 
                            placeholder="Cari produk..." 
                            class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        >
                    </div>
                    
                    <div class="md:w-48">
                        <select 
                            name="category"
                            id="categoryFilter" 
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white"
                        >
                            <option value="all">Semua Kategori</option>
                            <?php 
                            require_once "../config.php";
                            $catagories = get_all_kategori();
                            foreach($catagories as $kategori){
                            ?>
                            <option value="<?php echo $kategori["nama_kategori"]  ?>  <?php if ($category== $kategori["nama_kategori"]) echo "selected";?>"><?php echo $kategori["nama_kategori"]  ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </form>
        





        <!-- card produk -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
                <?php 
                require_once "../config.php";
                foreach ($products as $produk) { ?>

                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="aspect-video bg-gray-100 overflow-hidden">
                            <img src="../Media/<?php echo $produk['foto_produk']; ?>"
                                alt="Produk"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>

                        <div class="p-5">
                            <div class="mb-2">
                                <span class="inline-block px-3 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">
                                    <?php echo get_kategori_by_id($produk["kategori_id"]) ?>
                                </span>
                            </div>

                            <h3 class="text-lg font-semibold text-dark mb-1">
                                <?php echo $produk['nama_produk']?>
                            </h3>

                            <p class="text-gray-text text-sm mb-3">
                                <?php echo get_name_user_by_id($produk['penjual_id']) ?>
                            </p>

                            <div class="flex items-center justify-between">
                                <span class="text-xl font-bold text-green-600">
                                    Rp <?php echo number_format($produk['harga']); ?>
                                </span>
                                <div class="flex">
                                    <a href="./?page=chekout&id=<?php echo $produk['id'] ?>" 
                                    class="px-5 py-2 bg-green-600 text-white rounded-xl hover:bg-green-700">
                                        Beli
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>

        <!-- card produk end -->
    </main>
    