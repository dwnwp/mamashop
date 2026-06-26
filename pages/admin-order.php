<?php
session_start();
include '../config.php';

// Check if login
if(empty($_SESSION['login'])){
    header("Location: " . $base_url . "/pages/login.php");
}
// All orders
$query = mysqli_query($conn, "SELECT * from orders order by id desc");
$rows = mysqli_num_rows($query);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Orders</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font.css">
</head>

<body>

    <?php include '../admin-navbar.php'; ?>

    <!-- Table -->
    <div class="container mt-5">
        <h4 class="pb-2 m-5">คำสั่งซื้อทั้งหมด</h4>
        <table class="table table-border border-info table-striped table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Date And Time</th>
                    <th>Grand Total</th>
                    <th>Action</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;
                if ($rows > 0) : ?>
                    <?php while ($orders = mysqli_fetch_assoc($query)) : ?>
                        <!-- Each Order -->
                        <tr>
                            <td data-bs-toggle="collapse" href="#collapseExample<?php echo $i; ?>" aria-expanded="false" aria-controls="collapseExample" style="cursor: pointer;">
                                <?php echo $orders['id']; ?>
                            </td>
                            <td data-bs-toggle="collapse" href="#collapseExample<?php echo $i; ?>" aria-expanded="false" aria-controls="collapseExample" style="cursor: pointer;">
                                <?php echo $orders['date_time']; ?>
                            </td>
                            <td data-bs-toggle="collapse" href="#collapseExample<?php echo $i; ?>" aria-expanded="false" aria-controls="collapseExample" style="cursor: pointer;">
                                <?php echo $orders['grand_total']; ?> ฿
                            </td>
                            <td>
                                <a onclick="return confirm('Are you sure you want to delete?');" role="button" href="../actions/admin-order-delete.php?id=<?php echo $orders['id']; ?>" class="btn btn-outline-dark">Delete</a>
                            </td>
                            <td>
                                <div class="btn-group ms-2">
                                    <a href="admin-order-status.php?status=ไม่สมบูรณ์&id=<?php echo $orders['id']; ?>" class="btn btn-outline-dark<?php if ($orders['status'] == "ไม่สมบูรณ์") {
                                                                                                                                                        echo " active";
                                                                                                                                                    } ?>">ไม่สมบูรณ์</a>
                                    <a href="admin-order-status.php?status=จ่ายแล้ว&id=<?php echo $orders['id']; ?>" class="btn btn-outline-dark<?php if ($orders['status'] == "จ่ายแล้ว") {
                                                                                                                                                    echo " active";
                                                                                                                                                } ?>">จ่ายแล้ว</a>
                                    <a href="admin-order-status.php?status=เสริฟแล้ว&id=<?php echo $orders['id']; ?>" class="btn btn-outline-dark<?php if ($orders['status'] == "เสริฟแล้ว") {
                                                                                                                                                    echo " active";
                                                                                                                                                } ?>">เสริฟแล้ว</a>
                                </div>
                            </td>
                        </tr>
                        <!-- End Each Order -->
                        <!-- Collapse -->
                        <div class="collapse" id="collapseExample<?php echo $i; ?>">
                            <?php $rows2 = mysqli_num_rows(mysqli_query($conn, "SELECT * from orders_detail WHERE order_id=$orders[id]")); ?>
                            <?php $orders_detail = mysqli_fetch_all(mysqli_query($conn, "SELECT * from orders_detail WHERE order_id=$orders[id]")); ?>
                            <div class="card card-body">
                                <p class="fw-bold">ID: <?php echo $orders['id']; ?></p>
                                <?php for ($j = 0; $j < $rows2; $j++) { ?>
                                    Name: <?php echo $orders_detail[$j][2]; ?>
                                    Details: <?php echo $orders_detail[$j][3]; ?>
                                    Price: <?php echo $orders_detail[$j][4]; ?>฿
                                    Quantity: <?php echo $orders_detail[$j][5]; ?>
                                    Total: <?php echo $orders_detail[$j][6]; ?>฿<br>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- End Collapse -->
                    <?php $i++;
                    endwhile; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- End Table -->
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>