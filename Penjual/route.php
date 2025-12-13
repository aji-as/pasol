<?php

$page = $_GET['page'];

switch($page){
    case 'profile':
        require_once 'profile.php';
        break;
    case 'pesanan-masuk':
        require_once 'pasanan_masuk.php';
        break;
    case 'daftar-produk':
        require_once 'daftar_produk.php';
        break;
    case 'tambah-produk':
        require_once 'tambah_produk.php';
        break;
    case 'detail-pesanan':
        require_once 'detail_pesanan.php';
        break;
    case 'edit-produk':
        require_once 'edit_produk.php';
        break;
    case 'daftar-pesanan':
        require_once 'daftar_pesanan.php';
        break;
    case 'detail-order':
        require_once 'detail_order.php';
        break;
    case 'home':
        header("location:../Home/index.php");
        exit;
    case 'logout':
        require_once '../logout.php';
        break;
    default:
        require_once 'daftar_pesanan.php';
        break;
}