<?php
require_once "../config.php";
$id = $_GET['id'];
$status = get_user_by_id($id)['role'];

$result = delete_user($id);


if($status=="penjual"){
     if ($result){
    header("Location: ./?page=daftar-penjual&status=ok");
    exit;
    }else{
        header("Location: ./?page=daftar-penjual&status=error");
        exit;
    }
}else{
    if ($result){
    header("Location: ./?page=daftar-pembeli&status=ok");
    exit;
    }else{
        header("Location: ./?page=daftar-pembeli&status=error");
        exit;
    }
   
}
