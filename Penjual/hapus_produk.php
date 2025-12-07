<?php
require_once "../config.php";
$id = $_GET['id'];

$result = delete_produk($id);
if ($result){
    header("Location: ./?page=daftar-produk&status=ok");
    exit;
}else{
    header("Location: ./?page=daftar-produk&status=error");
    exit;
}