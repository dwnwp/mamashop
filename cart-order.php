<?php
session_start();
include 'config.php';

$result = ['id' => '', 'product_name' => '', 'price' => '', 'profile_image' => '', 'brand' => ''];

// productIds คือ ไอดีของสินค้าที่อยู่ในตะกร้า จัดเก็บ จำนวนสินค้าแต่ละชิ้น
$productIds = [];
foreach (($_SESSION['cart'] ?? []) as $cartId => $cartQty) {
    $productIds[] = $cartId;
}
$ids = 0;
if (count($productIds) > 0) {
    $ids = implode(',', $productIds);
}

// query สินค้าทั้งหมดที่อยู่ในตะกร้า
$query = mysqli_query($conn, "SELECT * from products where id in ($ids)");
$rows = mysqli_num_rows($query);

// ลูปหาราคาสินค้าทั้งหมดรวมกัน
$grand_total = 0;
while ($result = mysqli_fetch_assoc($query)) {
    $grand_total += $_SESSION['price'][$result['id']] * $_SESSION['cart'][$result['id']];
}

// Insert into databases
date_default_timezone_set('Asia/Bangkok');
$now = date("Y-m-d H:i:s");
$query = mysqli_query($conn, "INSERT INTO orders(date_time, grand_total) VALUES('{$now}','{$grand_total}');") or die("query unsuccessful");

$last_id = 0;
if($query){

    $last_id = mysqli_insert_id($conn); //สำหรับเก็บ order id ของลูกค้า

    // ยัดสินค้าที่ลูกค้าสั่งทั้งหมดลงใน database
    foreach($_SESSION['cart'] as $productId => $productQty){
        $product_name =  mysqli_fetch_assoc(mysqli_query($conn, "SELECT product_name from products where id={$productId};"));
        $ingredient_detail = $_SESSION['detail'][$productId];
        $price = $_SESSION['price'][$productId];
        $total = $price * $productQty;
        mysqli_query($conn, "INSERT INTO orders_detail(order_id, product_id, product_name, ingredient_detail, product_price, product_quantity, product_total) 
                    VALUES('$last_id','$productId','$product_name[product_name]', '$ingredient_detail' ,'$price','$productQty','$total');") or die("query unsuccessful");
    }
}

header('location: ' . $base_url . '/checkout.php?orderid=' . $last_id . '&ids=' . $ids);

?>