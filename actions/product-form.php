<?php
session_start();
include '../config.php';

$product_name = trim($_POST['product_name']);
$product_name_en = trim($_POST['product_name_en']);
$price = $_POST['price'] ?: 0;
$stock = $_POST['stock'] ?: 0;
$image_name = $_FILES['profile_image']['name'];
$brand = $_POST['brand'];

$image_tmp = $_FILES['profile_image']['tmp_name'];
$folder = 'img/';
$image_location = $folder . $image_name;

// For create new product
if (empty($_POST['id'])) {
    $query = mysqli_query($conn, "INSERT INTO products(product_name, price, stock, profile_image, brand, product_name_en) VALUES('{$product_name}','{$price}','{$stock}','{$image_name}','{$brand}', '{$product_name_en}');") or die("Query Failed");
}
 // For update product
else {
    $query_product = mysqli_query($conn, "select * from products where id='{$_POST['id']}'");
    $result = mysqli_fetch_assoc($query_product);

    if(empty($image_name)) {
        $image_name = $result['profile_image'];
    } else {
        @unlink($folder . $result['profile_image']);
    }
    $query = mysqli_query($conn, "UPDATE products SET product_name='{$product_name}', price='{$price}', stock='{$stock}', profile_image='{$image_name}', brand='{$brand}', product_name_en='{$product_name_en}' WHERE id='{$_POST['id']}'") or die("Query Failed");
}
mysqli_close($conn);

if ($query) {
    move_uploaded_file($image_tmp, $image_location);

    $_SESSION['message'] = "Product saved success";
    header('location: ' . $base_url . '/pages/admin-menu.php');
} else {
    $_SESSION['message'] = "Product could not be saved";
    header('location: ' . $base_url . '/pages/admin-menu.php');
}
?>