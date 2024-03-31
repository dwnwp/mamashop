<?php
session_start();
include 'config.php';

$name = trim($_POST['name']);
$quantity = $_POST['quantity'] ?: 0;
$type = $_POST['type'];

// For create new product
if (empty($_POST['id'])) {
    $query = mysqli_query($conn, "INSERT INTO ingredients(name, quantity, type) VALUES('{$name}','{$quantity}','{$type}');") or die("Query Failed");
}
 // For update product
else {
    $query_ing = mysqli_query($conn, "SELECT * from ingredients where id='{$_POST['id']}'");
    $ingredients = mysqli_fetch_assoc($query_ing);

    $query = mysqli_query($conn, "UPDATE ingredients SET name='{$name}', quantity='{$quantity}', type='{$type}' WHERE id='{$_POST['id']}'") or die("Query Failed");
}
mysqli_close($conn);

if ($query) {
    $_SESSION['message'] = "Ingredients saved success";
    header('location: ' . $base_url . '/admin-ingredients.php');
} else {
    $_SESSION['message'] = "Ingredients could not be saved";
    header('location: ' . $base_url . '/admin-ingredients.php');
}
?>