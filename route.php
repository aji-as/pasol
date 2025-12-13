<?php

$page = $_GET['page']?? 'home';


switch ($page) {

    case 'home':
        require_once 'home_note_login.php';
        break;
    case 'produk':
        require_once 'produk2.php';
        break;
    default:
        require_once 'home_note_login.php';
        break;
}