<?php
session_start();
include '../config.php';

$result = ['id' => '', 'product_name' => '', 'price' => '', 'profile_image' => '', 'brand' => ''];

// productIds คือ ไอดีของสินค้าที่อยู่ในตะกร้า จัดเก็บ จำนวนสินค้าแต่ละชิ้น
$productIds = [];
foreach (($_SESSION['cart'] ?? []) as $cartId => $cartQty) {
    $productIds[] = $cartId;
}
$ids = 0;
if (count($productIds) > 0) {
    $ids = implode(',', $productIds);
}

$query = mysqli_query($conn, "SELECT * from products where id in ($ids)");
$rows = mysqli_num_rows($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <title>Cart</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font.css">
</head>

<body>

    <?php include '../navbar.php' ?>

    <?php if (!empty($_SESSION['cart'])) : ?>
        <div class="container mt-5">
            <div class="container text-center">
                <div class="row">
                    <form action="../actions/cart-update.php" method="post" name="fromupdate">
                        <?php if ($_SESSION['lang'] == 'th') : ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>รูป</th>
                                        <th>รหัสสินค้า</th>
                                        <th>ชื่อสินค้า</th>
                                        <th>รายละเอียด</th>
                                        <th>ราคาต่อหน่วย</th>
                                        <th>จำนวน</th>
                                        <th>จำนวนเงิน</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $grand_total = 0;
                                    // สินค้าแต่ละชิ้นในตะกร้า
                                    while ($result = mysqli_fetch_assoc($query)) :
                                        $grand_total += $_SESSION['price'][$result['id']] * $_SESSION['cart'][$result['id']] //ลูปหาราคาสิ้นค้าทั้งหมด
                                    ?>
                                        <tr>
                                            <td><img src="<?php echo $base_url; ?>/img/<?php echo $result['profile_image']; ?>" width="100" alt="Product Image"></td>
                                            <td><?php echo $result['id']; ?></td>
                                            <td><?php echo $result['product_name']; ?></td>
                                            <td><?php echo $_SESSION['details'][$result['id']]  ?></td>
                                            <td><?php echo number_format($_SESSION['price'][$result['id']], 2); ?> ฿</td>
                                            <td>
                                                <input type="number" min="1" name="product[<?php echo $result['id']; ?>][quantity]" value="<?php echo $_SESSION['cart'][$result['id']] ?>">
                                            </td>
                                            <td>
                                                <?php echo number_format($_SESSION['price'][$result['id']] * $_SESSION['cart'][$result['id']], 2); ?> ฿
                                            </td>
                                            <td>
                                                <a class="btn btn-danger btn-lg" href="../actions/cart-delete.php?id=<?php echo $result['id']; ?>" role="button" onclick="return confirm('Are you sure you want to delete?');">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                    ลบทิ้ง</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                    <!-- จบสินค้าแต่ละชิ้นในตะกร้า -->
                                </tbody>
                            </table>
                            <!-- ส่วนท้าย -->
                            <h4 class="text-lg-end mt-5">จำนวนเงินรวมทั้งหมด <?php echo number_format($grand_total, 2); ?> บาท</h4>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                                <a href="../actions/cart-clear.php" class="btn btn-danger btn-lg" onclick="return confirm('คุณแน่ใจใช่ไหมว่าจะเคลียร์สินค้าทั้งหมดในตะกร้า')">เคลียร์ตะกร้า</a>
                                <button type="submit" class="btn btn-secondary btn-lg">คำนวณราคาสินค้าใหม่</button>
                                <a href="../actions/cart-order.php" type="button" class="btn btn-success btn-lg">สั่งซื้อสินค้า</a>
                            </div>
                            <!-- จบส่วนท้าย -->
                        <?php elseif ($_SESSION['lang'] == 'en') : ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Details</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $grand_total = 0;
                                    // สินค้าแต่ละชิ้นในตะกร้า
                                    while ($result = mysqli_fetch_assoc($query)) :
                                        $grand_total += $_SESSION['price'][$result['id']] * $_SESSION['cart'][$result['id']] //ลูปหาราคาสิ้นค้าทั้งหมด
                                    ?>
                                        <tr>
                                            <td><img src="<?php echo $base_url; ?>/img/<?php echo $result['profile_image']; ?>" width="100" alt="Product Image"></td>
                                            <td><?php echo $result['id']; ?></td>
                                            <td><?php echo $result['product_name_en']; ?></td>
                                            <td><?php echo $_SESSION['details'][$result['id']]  ?></td>
                                            <td><?php echo number_format($_SESSION['price'][$result['id']], 2); ?> ฿</td>
                                            <td>
                                                <input type="number" min="1" name="product[<?php echo $result['id']; ?>][quantity]" value="<?php echo $_SESSION['cart'][$result['id']] ?>">
                                            </td>
                                            <td>
                                                <?php echo number_format($_SESSION['price'][$result['id']] * $_SESSION['cart'][$result['id']], 2); ?> ฿
                                            </td>
                                            <td>
                                                <a class="btn btn-danger btn-lg" href="../actions/cart-delete.php?id=<?php echo $result['id']; ?>" role="button" onclick="return confirm('Are you sure you want to delete?');">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                    Delete</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                    <!-- จบสินค้าแต่ละชิ้นในตะกร้า -->
                                </tbody>
                            </table>
                            <!-- ส่วนท้าย -->
                            <h4 class="text-lg-end mt-5">Grand Total Price <?php echo number_format($grand_total, 2); ?> Baht</h4>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                                <a href="../actions/cart-clear.php" class="btn btn-danger btn-lg" onclick="return confirm('Are you sure you want to clear the cart?')">Clear</a>
                                <button type="submit" class="btn btn-secondary btn-lg">Recalculate the price</button>
                                <a href="../actions/cart-order.php" type="button" class="btn btn-success btn-lg">Submit Order</a>
                            </div>
                            <!-- จบส่วนท้าย -->
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div> <!-- /container -->
        <!-- เมื่อไม่มีสินค้าในตะกร้า -->
    <?php else : ?>
        <h4 class="text-lg-center mt-5"><?php if ($_SESSION['lang'] == 'en') {
                                            echo "Nothing in the cart";
                                        } else {
                                            echo "ไม่มีสินค้าอยู่ในตะกร้า";
                                        } ?></h4>
    <?php endif; ?>

</body>

</html>