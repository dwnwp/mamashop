<?php

session_start();

$username = "admin";
$password = "admin123";

if ($_POST['username']==$username  && $_POST['password']==$password){
    $_SESSION['login'] = "Login Successful";
    $_SESSION['loginMessage'] = null;
    header('location: http://localhost/MamaShop/admin-menu.php');
} else {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

?>