<?php
session_start();
include '../config.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="20">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <title>MamaShop</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font.css">
</head>

<body>

    <?php
    $last_id = $_GET['orderid'];
    $ids = $_GET['ids'];
    $orders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * from orders where id=$last_id"));
    include '../navbar.php';
    ?>

    <!-- ยังไม่ชำระเงิน -->
    <?php if ($orders['status'] == 'ไม่สมบูรณ์') : ?>
        <div class="container mt-5 mb-5">
            <div class="row p-5" style="border: 1px solid black; border-radius: 1em; width:500px; display:block; margin-left: auto; margin-right:auto;">
                <h3 class="text-center fw-semibold"><?php if ($_SESSION['lang'] == 'th') {
                                                        echo "โปรดชำระเงิน";
                                                    } elseif ($_SESSION['lang'] == 'en') {
                                                        echo "Please Make The Payment";
                                                    } ?></h3>
                <img src="https://www.paocloud.co.th/wp-content/uploads/2021/01/Screen-Shot-2564-01-26-at-18.56.53.png" class="img-fluid mt-5" alt="..." style="width:auto; height: 500px; margin-left: auto; margin-right:auto; display:block">
                <div class="d-grid gap-2 col-6 mx-auto mt-4">
                    <a href="../actions/cart-order-cancel.php?id=<?php echo $last_id; ?>" onclick="return confirm('Are you sure you want to cancel?');" class="btn btn-danger"><?php if ($_SESSION['lang'] == 'th') {
                                                                                                                                                                        echo "ยกเลิก";
                                                                                                                                                                    } elseif ($_SESSION['lang'] == 'en') {
                                                                                                                                                                        echo "Cancel";
                                                                                                                                                                    } ?></a>
                </div>
            </div>
        </div>
    <?php $_SESSION['order'] = $last_id;
    elseif ($orders['status'] == 'จ่ายแล้ว') : ?>
        <!-- ชำระเงินแล้ว -->
        <!-- ลดจำนวน ingredients -->
        <?php
        $query1 = mysqli_query($conn, "SELECT id from products where id in ({$ids});");
        while ($result1 = mysqli_fetch_assoc($query1)) {
            mysqli_query($conn, "UPDATE products set stock=stock-{$_SESSION['cart'][$result1['id']]} where id=$result1[id]");
            if($_SESSION['details'][$result1['id']]=='-'){
                continue;
            }
            else {
                if ($_SESSION['lang']=='th'){
                    $query2 = mysqli_query($conn, "SELECT id from ingredients where name in ({$_SESSION['details'][$result1['id']]});");
                }
                else {
                    $query2 = mysqli_query($conn, "SELECT id from ingredients where name_en in ({$_SESSION['details'][$result1['id']]});");
                }
                while ($result2 = mysqli_fetch_assoc($query2)) {
                    mysqli_query($conn, "UPDATE ingredients set quantity=quantity-{$_SESSION['cart'][$result1['id']]} where id='$result2[id]';");
                }
            }
        }
        ?>
        <div class="container mt-5">
            <div class="row" style="border: 1px solid black; border-radius: 1em; width:500px; display:block; margin-left: auto; margin-right:auto;">
                <div class="container mt-4 mb-5">
                    <h3 class="text-center fw-semibold"><?php if ($_SESSION['lang'] == 'th') {
                                                            echo "ชำระเงินเรียบร้อย";
                                                        } elseif ($_SESSION['lang'] == 'en') {
                                                            echo "Payment Successful";
                                                        } ?></h3>
                    <h5 class="text-center"><?php if ($_SESSION['lang'] == 'th') {
                                                echo "กำลังทำอาหาร";
                                            } elseif ($_SESSION['lang'] == 'en') {
                                                echo "We are cooking your order";
                                            } ?></h5>
                </div>
                <lottie-player src="https://lottie.host/b14ad4cc-bb71-4c04-9840-6b1dcdc93b71/NyClvb9TOq.json" background="#ffffff" speed="1" style="width:auto; height: 200px; margin-left: auto; margin-right:auto; display:block" loop autoplay direction="1" mode="normal"></lottie-player>
                <div class="container mt-5 mb-4">
                    <h3 class="text-center"><?php if ($_SESSION['lang'] == 'th') {
                                                echo "หมายเลขคำสั่งซื้อของคุณคือ";
                                            } elseif ($_SESSION['lang'] == 'en') {
                                                echo "Your order is";
                                            } ?></h3>
                    <h4 class="text-center" style="color: green;"><?php echo $last_id; ?></h4>
                </div>
            </div>
        </div>
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <?php $_SESSION['order'] = $last_id;
    else : ?>
        <!-- เสร็จแล้ว -->
        <div class="container mt-5">
            <div class="row" style="border: 1px solid black; border-radius: 1em; width:500px; display:block; margin-left: auto; margin-right:auto;">
                <div class="container mt-4 mb-5">
                    <h3 class="text-center fw-semibold"><?php if ($_SESSION['lang'] == 'th') {
                                                            echo "อาหารพร้อมเสริฟแล้ว";
                                                        } elseif ($_SESSION['lang'] == 'en') {
                                                            echo "Your food is ready";
                                                        } ?></h3>
                    <h5 class="text-center"><?php if ($_SESSION['lang'] == 'th') {
                                                echo "กรุณามารับอาหาร";
                                            } elseif ($_SESSION['lang'] == 'en') {
                                                echo "Please come pick up the food";
                                            } ?></h5>
                </div>
                <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script><lottie-player src="https://lottie.host/364891b0-c862-4665-ad71-cea66657193e/M1MSYheRix.json" background="##ffffff" speed="1" style="width:auto; height: 200px; margin-left: auto; margin-right:auto; display:block" loop autoplay direction="1" mode="normal"></lottie-player>
                <div class="container mt-5 mb-4">
                    <h3 class="text-center"><?php if ($_SESSION['lang'] == 'th') {
                                                echo "หมายเลขคำสั่งซื้อของคุณคือ";
                                            } elseif ($_SESSION['lang'] == 'en') {
                                                echo "Your order is";
                                            } ?></h3>
                    <h4 class="text-center" style="color: green;"><?php echo $last_id; ?></h4>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto my-5">
                    <a href="home.php" type="button" class="btn btn-success"><?php if ($_SESSION['lang'] == 'th') {
                                                                                    echo "เรียบร้อย";
                                                                                } elseif ($_SESSION['lang'] == 'en') {
                                                                                    echo "Success";
                                                                                } ?></a>
                </div>
            </div>
        </div>

    <?php $_SESSION['order'] = null;
        unset($_SESSION['cart']);
    endif; ?>

</body>

</html>