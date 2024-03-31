<?php 
    session_start();
    include 'config.php';

    if (!empty($_GET['id'])) {
        $query_ing = mysqli_query($conn, "SELECT * from ingredients where id='{$_GET['id']}'");
        $result = mysqli_fetch_assoc($query_ing);

        $query = mysqli_query($conn, "DELETE FROM ingredients WHERE id = '{$_GET['id']}'") or die ("query failed");
        mysqli_close($conn);

        if ($query) {
            $_SESSION['message'] = "Ingredients deleted success";
            header('location: ' . $base_url . '/admin-ingredients.php');
        } else {
            $_SESSION['message'] = "Ingredients could not be deleted";
            header('location: ' . $base_url . '/admin-ingredients.php');
        }
    } 
?>