<?php
session_start();
include 'config.php';

$name = trim($_POST['name']);
$name_en = trim($_POST['name_en']);
$quantity = $_POST['quantity'] ?: 0;
$price = $_POST['price'] ?: 0;
$type = $_POST['type'];

// For create new product
if (empty($_POST['id'])) {
    $query = mysqli_query($conn, "INSERT INTO ingredients(name,name_en, quantity,price, type) VALUES('{$name}','{$name_en}','{$quantity}','{$price}','{$type}');") or die("Query Failed");
}
 // For update product
else {
    $query_ing = mysqli_query($conn, "SELECT * from ingredients where id='{$_POST['id']}'");
    $ingredients = mysqli_fetch_assoc($query_ing);

    $query = mysqli_query($conn, "UPDATE ingredients SET name='{$name}', name_en='{$name_en}', quantity='{$quantity}', price='{$price}', type='{$type}' WHERE id='{$_POST['id']}'") or die("Query Failed");
}
mysqli_close($conn);

if ($query) {

    header('location: ' . $base_url . '/admin-ingredients.php');
} else {
    
    header('location: ' . $base_url . '/admin-ingredients.php');
}
?>