<?php

session_start();
include 'config.php';

$query = mysqli_query($conn, "SELECT * FROM products WHERE id='{$_POST['id']}'");
$result = mysqli_fetch_assoc($query);
$values = '';

// เมื่อมีการเลือกวัตถุดิบเข้ามา
if (!empty($_POST['add'])) {
    $_SESSION['detail'][$_POST['id']] = implode(", ", $_POST['add']);
    // details ของวัตถุดิบ
    for($i=0; $i<count($_POST['add']); $i++){
        if ($i==count($_POST['add'])-1){
            $values .= "'" . $_POST['add'][$i] . "'";
            break;
        }
        $values .= "'" . $_POST['add'][$i] . "',";
    }
    $add = $_POST['add'];
} 
else {
    $values = '-';
    $add = '-';
    $_SESSION['cart'][$_POST['id']] = 1;
    $_SESSION['details'][$_POST['id']] = '-';
    $_SESSION['price'][$_POST['id']] = (int)$result['price'];
}

if (!empty($_POST['id'])) {

    // update ราคาจากวัตถุดิบที่เลือกมา
    if ($add != '-') {
        $_SESSION['cart'][$_POST['id']] = 1;
        $_SESSION['details'][$_POST['id']] = $values;
        $_SESSION['price'][$_POST['id']] = (int)$result['price'];

        if ($_SESSION['lang']=='th'){
            $query1 = mysqli_query($conn, "SELECT price from ingredients where name in ($values);");
        } else {
            $query1 = mysqli_query($conn, "SELECT price from ingredients where name_en in ($values);");
        }
        while($result1 = mysqli_fetch_assoc($query1)){
            $_SESSION['price'][$_POST['id']] += $result1['price'];
        }
    }
}

header('location: ' . $base_url . '/' . $result['brand'] . '.php');
