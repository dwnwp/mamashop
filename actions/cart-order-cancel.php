<?php

session_start();
include '../config.php';

if (!empty($_GET['id'])) {
    $query = mysqli_query($conn, "DELETE FROM orders where id=$_GET[id]");
    $query2 = mysqli_query($conn, "DELETE FROM orders_detail where order_id=$_GET[id]");
    $_SESSION['order']=null;
}

header('location: ' . $base_url . '/pages/cart.php');
