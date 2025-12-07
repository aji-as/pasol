<?php

$page = $_GET['page'] ?? 'home';


switch ($page) {
    case 'login':
        require_once 'login.php';
        break;
    case 'daftar-pembeli':
        require_once 'daftar_pembeli.php';
        break;
    case 'daftar-penjual':
        require_once 'daftar_penjual.php';
        break;
    case 'tambah-pembeli':
        require_once 'tambah_pembeli.php';
        break;
    case 'tambah-penjual':
        require_once 'tambah_penjual.php';
        break;
    case 'edit-user':
        require_once 'edit_user.php';
        break;
    case 'detail-user':
        require_once 'detail_user.php';
        break;
    case 'logout':
        header("Location: ../logout.php");
        exit;
    default:
        require_once "profile.php";
        break;
}