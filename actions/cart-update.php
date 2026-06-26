<?php

session_start();
include '../config.php';

// อัพเดทจำนวนและราคาของสินค้า
foreach ($_SESSION['cart'] as $productId => $productQty){
    $_SESSION['cart'][$productId] = $_POST['product'][$productId]['quantity'];
}

header('location: ' . $base_url . '/pages/cart.php');

?>