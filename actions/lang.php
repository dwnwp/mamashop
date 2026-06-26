<?php 
    session_start();
    include '../config.php';

    $_SESSION['lang'] = $_GET['lang'];

    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>