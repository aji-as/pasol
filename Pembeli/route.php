<?php

$page = $_GET['page'];

switch($page){
    case 'profile':
        require_once 'profile.php';
        break;
    case 'daftar-pesanan':
        require_once 'daftar_pesanan.php';
        break;
    default:
        require_once 'daftar_pesanan.php';
        break;
}