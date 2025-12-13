<?php



$koneksi = mysqli_connect("localhost","root","","sawangan_market");
if(isset($koneksi)){
    // echo "Koneksi Berhasil";
} else {
    echo "Koneksi Gagal";
}



// Users
function create_user(string $nama_lengkap, string $email, string $password, string $no_hp,  $role, string $alamat_blok):bool{
    global $koneksi;
    $stmt = $koneksi->prepare("INSERT INTO `users` (`id`, `nama_lengkap`, `email`, `password`, `no_hp`, `alamat_blok`, `role`, `created_at`) VALUES (NULL,?, ?, MD5(?), ?, ?, ?, CURRENT_TIMESTAMP)");
    $stmt->bind_param("ssssss", $nama_lengkap, $email, $password, $no_hp, $alamat_blok, $role, );
    return $stmt->execute();
}








function get_user_by_role(string $role):array|null{
    global $koneksi;
    $stmt = $koneksi->prepare("SELECT * FROM `users` WHERE `role` = ?");
    $stmt->bind_param("s",$role);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return $data ?? null;
}
// var_dump(get_user_by_role("pembeli"));




function get_all_users():array{
    global $koneksi;
    $users = $koneksi->query("SELECT * FROM `users`");
    $data = $users->fetch_all(MYSQLI_ASSOC);
    return $data;
}





function get_user_by_username(string $email, string $password):array|null{
    global $koneksi;
    $stmt = $koneksi->prepare("SELECT * FROM `users` WHERE `email` = ? AND `password` = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    return $data ?: null;
}

// var_dump(get_user_by_username("admin@gmail.com","admin@gmail.com"));

function get_user_by_id(int $id):array|null{
    global $koneksi;
    $stmt = $koneksi->prepare("SELECT * FROM `users` WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    return $data ?? null;
}

// var_dump(get_user_by_id(6)["nama_lengkap"]);

function get_name_user_by_id(int $id):string|null{
    global $koneksi;
    $stmt = $koneksi->prepare("SELECT * FROM `users` WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    return $data["nama_lengkap"] ?? null;
}

// var_dump(get_name_user_by_id(5));


function edit_user(int $id, string $nama_lengkap, string $no_hp, string $password, string $email, string $role, string $alamat_blok):bool{
    global $koneksi;
    $stmt = $koneksi->prepare("UPDATE `users` SET 
    `nama_lengkap` = ?, 
    `email` = ?, 
    `password` = MD5(?), 
    `no_hp` = ?, 
    `alamat_blok` = ?, 
    `role` = ?
    WHERE `users`.`id` = ?;");
    $stmt->bind_param("ssssssi",$nama_lengkap, $email, $password,$no_hp, $alamat_blok, $role,$id);
    return $stmt->execute();
}


function delete_user($id):bool{
    global $koneksi;
    $stmt = $koneksi->prepare("DELETE FROM `users` WHERE id = ?");
    $stmt->bind_param("i",$id);
    return $stmt->execute();
}


function edit_hostori_pebelian(int $history,int $id):bool{
    global $koneksi;
    $stmt = $koneksi->prepare("UPDATE `users` SET 
    `history` = ?
    WHERE `users`.`id` = ?;");
    $stmt->bind_param("ii",$history, $id);
    return $stmt->execute();
}

// var_dump(edit_hostori_pebelian(0,85));





// Produk
function get_all_produk():array|null{
    global $koneksi;
    $produk = $koneksi->query("SELECT * FROM `products` ORDER BY  `rating` DESC");
    $data = $produk->fetch_all(MYSQLI_ASSOC);
    return $data ?:null;
}

// var_dump(get_all_produk());


function get_all_produk_by_category(int $category_id):array|null{
    global $koneksi;
    $produk = $koneksi->query("SELECT * FROM `products` WHERE `kategori_id` = $category_id");
    $data = $produk->fetch_all(MYSQLI_ASSOC);
    return $data ?:null;
}



function add_produk(int $penjual_id, int $kategori_id, string $nama_produk, string $deskripsi, int $harga, int $stok, string $foto_produk,):bool{
    global $koneksi;
    $stmt = $koneksi->prepare("INSERT INTO `products` (`id`, `penjual_id`, `kategori_id`, `nama_produk`, `deskripsi`, `harga`, `stok`, `foto_produk`, `is_active`, `created_at`) VALUES (NULL, ?, ?, ?,?, ?, ?, ?, '1', CURRENT_TIMESTAMP);");
    $stmt->bind_param("iisssss",$penjual_id, $kategori_id, $nama_produk, $deskripsi, $harga, $stok, $foto_produk);
    return $stmt->execute();
}


// var_dump(add_produk(1,1,"aa","akakaka",9000,9,"a.jpg"));

function get_produk_by_id(int $id):array{
    global $koneksi;
    $stmt = $koneksi->prepare("SELECT * FROM `products` WHERE `id`= ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    return $data;
}

function get_produk_by_id_seller(int $id_penjual):array|null{
    global $koneksi;
    $stmt = $koneksi->prepare("SELECT * FROM `products` WHERE `penjual_id`= ?");
    $stmt->bind_param("i", $id_penjual);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return $data ?? null;
}

function get_produk_by_id_seller_and_kategori(int $id_penjual,  int $id_ketegori):array|null{
    global $koneksi;
    $stmt = $koneksi->prepare("SELECT * FROM `products` WHERE `penjual_id`= ? AND `kategori_id` = ? ");
    $stmt->bind_param("ii", $id_penjual,$id_ketegori);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return $data ?? null;
}

// var_export(get_produk_by_id_seller_and_kategori(42,1));



function get_name_produk_by_id(int $id):string|null{
    global $koneksi;
    $stmt = $koneksi->prepare("SELECT * FROM `products` WHERE `id`= ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    return $data['nama_produk']  ?? null;
}

function get_all_produk_by_keyword(string $keyword):array{
    global $koneksi;
    $stmt = $koneksi->prepare("SELECT * FROM `products` WHERE `nama_produk` LIKE ?");
    $search = "%".$keyword."%";  
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all();
    return $data  ?? null;
}

// var_dump(get_all_produk_by_keyword("m"));



function edit_produk(int $id, int $kategori_id, string $nama_produk, string $deskripsi, int $harga, int $stok, string $foto_produk):bool{
    global $koneksi;
    $stmt = $koneksi->prepare("UPDATE `products` SET
    `kategori_id` = ?,
    `nama_produk`= ?, 
    `deskripsi`=?, 
    `harga`=?, 
    `stok`=?, 
    `foto_produk`=?
    WHERE  `id` = ?;");
    $stmt->bind_param("issdisi",$kategori_id, $nama_produk , $deskripsi, $harga, $stok, $foto_produk,$id);
    return $stmt->execute();
}

function delete_produk(int $id):bool{
    global $koneksi;
    $stmt = $koneksi->prepare("DELETE FROM `products` WHERE id = ?");
    $stmt->bind_param("i",$id);
    return $stmt->execute();
}

// var_dump(edit_produk(1,1,"pisang","hhhh",3000,100,"a.jpg",1));














// Kategori
function get_all_kategori():array{
    global $koneksi;
    $kategori = $koneksi->query("SELECT * FROM `categories`");
    $data = $kategori->fetch_all(MYSQLI_ASSOC);
    return $data;
}

// var_dump(get_all_kategori());

function get_kategori_by_id (int $id_produk):string{
    global $koneksi;
    $stmt = $koneksi->prepare("SELECT * FROM `categories` WHERE `id` = ?");
    $stmt->bind_param("i",$id_produk);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    return $data["nama_kategori"];
}


function get_id_kategori (string $kategori ):int{
    global $koneksi;
    $stmt = $koneksi->prepare("SELECT * FROM `categories` WHERE `nama_kategori` = ?");
    $stmt->bind_param("s",$kategori);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    return $data["id"];
}
// var_dump(get_id_kategori('minuman'));

// var_dump(get_all_produk_by_category(get_id_kategori('minuman')));



// Order 
function get_all_order():array{
    global $koneksi;
    $order = $koneksi->query("SELECT * FROM `orders`");
    $data = $order->fetch_all(MYSQLI_ASSOC);
    return $data;
}


function get_order_by_user(int $id_pembeli):array|null{
    global $koneksi;
    $stmt = $koneksi->prepare("SELECT * FROM `orders` WHERE `pembeli_id` = ?");
    $stmt->bind_param("i", $id_pembeli);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return $data ?: null;
}

function get_order_by_user_and_status(int $id_pembeli, string $status):array | null{
    global $koneksi;
    $stmt = $koneksi->prepare("SELECT * FROM `orders` WHERE `pembeli_id` = ? AND `status_pesanan` = ?");
    $stmt->bind_param("is", $id_pembeli,$status);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return $data ?: null;
}

function get_order_by_id(int $id):array|null{
    global $koneksi;
    $stmt = $koneksi->prepare("SELECT * FROM `orders` WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    return $data ?: null;
}

// var_dump(get_order_by_id(4));



function get_order_from_produk(int $penjual_id):array|null{
    global $koneksi;
    $stmt = $koneksi->prepare("SELECT * FROM `products`,`users`,`orders` WHERE `orders`.`product_id`=`products`.`id` AND `products`.`penjual_id` = `users`.`id` AND `users`.`id` =?;");
    $stmt->bind_param("i", $penjual_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return $data ?: null;

}

// var_dump($orders = get_order_from_produk(1));
// foreach($orders = get_order_by_user(6) as $order){
//     echo $order["product_id"];
// }

// var_dump(get_order_by_user(6));



function get_order_from_produk_by_status(int $penjual_id,string $status):array|null{
    global $koneksi;
    $stmt = $koneksi->prepare("SELECT * FROM `products`,`users`,`orders` WHERE `orders`.`status_pesanan`= ? AND `orders`.`product_id`=`products`.`id` AND `products`.`penjual_id` = `users`.`id` AND `users`.`id` =?;");
    $stmt->bind_param("si",$status, $penjual_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return $data ?: null;

}

// var_dump(get_order_from_produk_by_status(42,"diproses"));

function add_order(int $product_id, string $nama, int $pembeli_id, int $jumlah, int $total_harga, string $alamat, string $catatan, string $nomor_hp, string $bukti_tf, string $janis_pemebayaran):bool{
    global $koneksi;
    $stmt = $koneksi->prepare("INSERT INTO `orders` (`id`, `product_id`, `nama`, `pembeli_id`, `jumlah`, `total_harga`, `alamat`, `catatan`, `status_pesanan`, `tanggal_pesan`, `nomor_hp`,`jenis_pembayaran`, `bukti_tf`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, 'menunggu', CURRENT_TIMESTAMP, ?,?,?);");
    $stmt->bind_param("isiiisssss",$product_id, $nama, $pembeli_id, $jumlah, $total_harga, $alamat, $catatan, $nomor_hp, $janis_pemebayaran, $bukti_tf);
    return $stmt->execute();
}

// var_dump(add_order(19,"aku",44,"3",200,"jajaja","ajaja","ajahashasx","a.jpg","tf"));


function update_status($id, $status):bool{
    global $koneksi;
    $stmt = $koneksi->prepare("UPDATE `orders` SET 
            `status_pesanan`= ?
        WHERE id = ?;
    ");
    $stmt->bind_param("si" ,$status, $id);
    return $stmt->execute();
}
// var_dump(update_status(10,""));

function get_all_status():array{
    global $koneksi;
    $order = $koneksi->query("SELECT `status_pesanan` FROM `orders`");
    $data = $order->fetch_all(MYSQLI_ASSOC);
    return $data;
}

// var_dump(get_all_status());


// rating di ambil dari tabel produk


// $status = get_order_by_id(10)['status_pesanan'];
// var_dump($status);


function update_rating(int $rating , int $id_produk){
    global $koneksi;

    $stmt = $koneksi->prepare("
        UPDATE products SET 
            rating = ?,
            jumlah_perating = jumlah_perating + 1
        WHERE id = ?;
    ");

    $stmt->bind_param("ii", $rating, $id_produk);
    return $stmt->execute();
}


function update_is_rating(int $id_order , bool $is_rating){
      global $koneksi;

    $stmt = $koneksi->prepare(" UPDATE `orders` SET 
            is_rating = ?
        WHERE id = ?;
    ");

    $stmt->bind_param("ii", $is_rating ,$id_order );
    return $stmt->execute();
}

// var_dump(update_rating(7,19));

function get_ratting_by_id($id_produk):float{
    global $koneksi;
    $stmt = $koneksi->prepare("SELECT `rating` FROM `products` WHERE `id` = ?");
    $stmt->bind_param("i",$id_produk);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    return $data['rating'];
}


// var_dump(get_ratting_by_id(19));

function get_jumlah_perating($id_produk){
    global $koneksi;
    $stmt = $koneksi->prepare("SELECT `jumlah_perating` FROM `products` WHERE `id` = ?");
    $stmt->bind_param("i",$id_produk);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    return $data['jumlah_perating'];
}



// var_dump(add_ratting(5,1,1,1,"ajaja"));


// ambil nama file
    // $gambar = $_FILES['img']['name'];

    // pindahkan file ke folder uploads/
    // $tmp = $_FILES['img']['tmp_name'];
    // move_uploaded_file($tmp, "uploads/".$gambar);




// edit & tambah pembeli
// eift & tambah penjual 
 