<?php

session_start();
include '../config.php';

if (!empty($_GET['status'])) {
    mysqli_query($conn, "UPDATE orders set status = '$_GET[status]' where id=$_GET[id];");
}

header('location: ' . $base_url . '/pages/admin-order.php');
