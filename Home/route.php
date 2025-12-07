<?php 
$page = $_GET['page'];


switch ($page){
    case 'produk':
        require_once 'produk.php';
        break;
    case 'chekout':
        require_once 'chekout.php';
        break;
    case 'profile-pembeli':
        header("location:../Pembeli/index.php");
        exit; 
    case 'profile-penjual':
        header("location:../Penjual/index.php");
        exit; 
    case 'profile-admin':
        header("location:../Admin/index.php");
        exit; 
    case 'logout':
        require_once '../logout.php';
        break;
    default:
        require_once 'home.php';
        break;
}


?>