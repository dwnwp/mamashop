<?php
session_start();
include 'config.php';

$product_name = trim($_POST['product_name']);
$price = trim($_POST['price']);
$image_name = $_FILES['profile_image']['name'];

$image_tmp = $_FILES['profile_image']['tmp_name'];
$folder = 'img/';
$image_location = $folder . $image_name;

$query = mysqli_query($conn, "INSERT INTO products(product_name, price, profile_image) VALUES('{$product_name}','{$price}','{$image_name}')") or die("Query Failed");

if ($query) {
    move_uploaded_file($image_tmp, $image_location);

    $_SESSION['message'] = "Product saved success";
    header('location: ' . $base_url . '/index.php');
} else {
    $_SESSION['message'] = "Product could not be saved";
    header('location: ' . $base_url . '/index.php');
}
?>