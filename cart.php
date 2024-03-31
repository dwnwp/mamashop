<?php
session_start();
include 'config.php';

$result = ['id' => '', 'product_name' => '', 'price' => '', 'profile_image' => '', 'brand' => ''];

$productIds = [];
foreach (($_SESSION['cart'] ?? []) as $cartId => $cartQty) {
    $productIds[] = $cartId;
}

$ids = 0;
if (count($productIds) > 0) {
    $ids = implode(',', $productIds);
}

// product all
$query = mysqli_query($conn, "SELECT * from products where id in ($ids)");
$rows = mysqli_num_rows($query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <?php include 'navbar.php' ?>

    <?php if (!empty($_SESSION['cart'])) : ?>
        <div class="container mt-5">
            <div class="container text-center">
                <div class="row">
                    <form action="cart-update.php" method="post" name="fromupdate">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>รูป</th>
                                    <th>รหัสสินค้า</th> 
                                    <th>ชื่อสินค้า</th>
                                    <th>ราคาต่อหน่วย</th>
                                    <th>จำนวน</th>
                                    <th>จำนวนเงิน</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $grand_total = 0;
                                while ($result = mysqli_fetch_assoc($query)) :
                                    $grand_total += $result['price'] * $_SESSION['cart'][$result['id']]
                                ?>
                                    <tr>
                                        <td><img src="<?php echo $base_url; ?>/img/<?php echo $result['profile_image']; ?>" width="100" alt="Product Image"></td>
                                        <td><?php echo $result['id']; ?></td>
                                        <td><?php echo $result['product_name']; ?></td>
                                        <td><?php echo number_format($result['price'], 2); ?></td>
                                        <td>
                                            <input type="number" min="1" name="product[<?php echo $result['id'];?>][quantity]" value="<?php echo $_SESSION['cart'][$result['id']] ?>">
                                        </td>
                                        <td>
                                            <?php echo number_format($result['price'] * $_SESSION['cart'][$result['id']], 2); ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger btn-lg" href="cart-delete.php?id=<?php echo $result['id']; ?>" role="button" onclick="return confirm('Are you sure you want to delete?');">
                                                <span class="glyphicon glyphicon-trash"></span>
                                                ลบทิ้ง</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>

                        <h4 class="text-lg-end mt-5">จำนวนเงินรวมทั้งหมด <?php echo number_format($grand_total, 2); ?> บาท</h4>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                            <button type="submit" class="btn btn-info btn-lg">คำนวณราคาสินค้าใหม่</button>
                            <a href="order.php" type="button" class="btn btn-primary btn-lg">สังซื้อสินค้า</a>
                        </div>

                    </form>
                </div>
            </div>
        </div> <!-- /container -->
    <?php else: ?>
        <h4 class="text-lg-center mt-5">Nothing in the cart</h4>
    <?php endif; ?>

</body>

</html>