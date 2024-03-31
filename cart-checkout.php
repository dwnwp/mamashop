<?php

session_start();
include 'config.php';

$now = date('Y-m-d H:i:s');
$query = mysqli_query($conn, "INSERT INTO orders(date_time, grand_total) VALUES('{$now}','{$_POST['grand_total']}');") or die("query unsuccessful");

if($query){
    $last_id = mysqli_insert_id($conn);
    foreach($_SESSION['cart'] as $productId => $productQty){
        mysqli_query($conn, "INSERT INTO orders_detail(order_id, product_id, product_name, product_price, product_image, product_quantity, product_total) 
                             VALUES('{$last_id}','{$_POST['grand_total']}');") or die("query unsuccessful");
    }
}

?>