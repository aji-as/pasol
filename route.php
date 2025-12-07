<?php

$page = $_GET['page'] ?? 'login';


switch ($page) {
    case 'login':
        require_once 'login.php';
        break;
    default:
        echo "Halaman tidak ditemukan.";
        break;
}