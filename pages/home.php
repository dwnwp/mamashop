<?php
session_start();
include '../config.php';

$query = mysqli_query($conn, "SELECT * from products where stock>5 order by rand(product_name) limit 4");
$rows = mysqli_num_rows($query);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <title>MamaShop</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/carousel.css">
    <link rel="stylesheet" href="../css/feature.css">
    <link rel="stylesheet" href="../css/font.css">
</head>

<header>
    <?php include '../navbar.php'; ?>
</header>

<body>

    <!-- Carousel -->
    <div class="carousel-inner mb-5">
        <div class="carousel-item active">
            <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect>
            </svg>
            <div class="container">
                <div class="carousel-caption">
                    <h1><?php if ($_SESSION['lang'] == 'th') {
                            echo "โฆษณา";
                        } else {
                            echo "Advertisement";
                        } ?></h1>
                    <p><?php if ($_SESSION['lang'] == 'th') {
                            echo "โปรดติดต่อมาที่ 08X-XXX-XXXX";
                        } else {
                            echo "Please Contract 08X-XXX-XXXX";
                        } ?></p>
                    <p><a href="product-detail.php?id=<?php echo $product['id']; ?>" class="btn btn-primary bg-dark border-dark btn-lg"><span style="color:white"><?php if ($_SESSION['lang'] == 'th') {
                                                                                                                                                            echo "กดเลย";
                                                                                                                                                        } else {
                                                                                                                                                            echo "Click Here";
                                                                                                                                                        } ?></span></a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- End Carousel -->

    <!-- Recommand -->
    <h4 class="text-center fw-bold"><?php if ($_SESSION['lang'] == 'th') {
                                        echo "เมนูแนะนำประจำวัน";
                                    } elseif ($_SESSION['lang'] == 'en') {
                                        echo "Recommend Menu";
                                    } ?></h4>
    <!-- Cards -->
    <div class="container my-5">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php if ($rows > 0) : ?>
                <?php while ($product = mysqli_fetch_assoc($query)) : ?>
                    <div class="col">
                        <div class="card text-center mb-3 w-55 p-4 h-100">
                            <a href="product-detail.php?id=<?php echo $product['id']; ?>">
                                <?php if (!empty($product['profile_image'])) : ?>
                                    <img src="<?php echo $base_url; ?>/img/<?php echo $product['profile_image']; ?>" class="card-img-top" alt="..." style="width:auto !important; height: 140px !important; margin: 0 auto 1em auto;">
                                <?php else : ?>
                                    <img src="https://st3.depositphotos.com/23594922/31822/v/450/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg" class="card-img-top" alt="..." style="width:auto !important; height: 140px !important; margin: 0 auto 1em auto;">
                                <?php endif; ?>
                            </a>
                            <div class="card-body">
                                <h5 class="card-title"><?php if ($_SESSION['lang'] == 'th') {
                                                            echo $product['product_name'];
                                                        } else {
                                                            echo $product['product_name_en'];
                                                        } ?></h5>
                                <h5 class="card-title mt-4" style="color: green"><?php echo number_format($product['price'], 2); ?> ฿</h5>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
    <!-- End Cards -->
    <!-- End Recommand -->


    <script src="../js/bootstrap.min.js"></script>
</body>

<?php include '../footer.php'; ?>

</html>