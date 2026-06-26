<?php

session_start();
include 'config.php';

if(!empty($_GET['id'])){
    unset($_SESSION['cart'][$_GET['id']]); // สินค้าออกจาก session
}

header('location: ' . $base_url . '/cart.php');

?>