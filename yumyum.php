<?php
session_start();
include 'config.php';
// product all
$query = mysqli_query($conn, "SELECT * from products  where brand='yumyum'");
$rows = mysqli_num_rows($query);

// variable for product form
$result = ['id' => '', 'product_name' => '', 'price' => '', 'product_image' => ''];

// product select edit
if (!empty($_GET['id'])) {
    $query_product = mysqli_query($conn, "select * from products where id='{$_GET['id']}'");
    $row_product = mysqli_num_rows($query_product);

    if ($row_product == 0) {
        header('location:' . $base_url . '/index.php');
    }
    $result = mysqli_fetch_assoc($query_product);
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MamaShop</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    
    <?php include 'navbar.php'; ?>

    <div class="container">
        <!-- Tabs -->
        <h4 class="pb-2 mt-4">Noodles Brand</h4>
        <ul class="nav nav-pills nav-fill mb-5">
            <li class="nav-item">
                <a class="nav-link" href="mama.php"><img src="https://www.thaifranchisecenter.com/links/images/web_link_1361.gif" class="img-thumbnail" width="40px">Mama</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="waiwai.php"><img src="https://www.aurareefood.com/arwp/wp-content/uploads/2016/06/Clients-logo_0015_%E0%B9%84%E0%B8%A7%E0%B9%84%E0%B8%A7.png" class="img-thumbnail" width="40px">Waiwai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="samyung.php"><img src="data:image/jpeg;base64,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" class="img-thumbnail" width="40px">Samyang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="yumyum.php"><img src="data:image/jpeg;base64,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" class="img-thumbnail" width="40px">YumYum</a>
            </li>
        </ul>
        <!-- End Tabs -->

        <!-- Cards -->
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php if ($rows > 0) : ?>
                <?php while ($product = mysqli_fetch_assoc($query)) : ?>
                    <div class="col">
                        <div class="card text-center mb-3 w-55 p-5">
                            <?php if (!empty($product['profile_image'])) : ?>
                                <img src="<?php echo $base_url; ?>/img/<?php echo $product['profile_image']; ?>" class="card-img-top" alt="..." style="width:auto !important; height: 140px !important; margin: 0 auto 1em auto;">
                            <?php else : ?>
                                <img src="https://st3.depositphotos.com/23594922/31822/v/450/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg" class="card-img-top" alt="..." style="width:auto !important; height: 140px !important; margin: 0 auto 1em auto;">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product['product_name']; ?></h5>
                                <h6 class="card-title" style="color: green"><?php echo number_format($product['price'], 2); ?> ฿</h6>
                                <a href="001.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <!-- End Cards -->
    </div>

</body>

</html>