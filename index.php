<?php
session_start();
include 'config.php';
// product all
$query = mysqli_query($conn, "SELECT * from products");
$rows = mysqli_num_rows($query);

// variable for product form
$result = ['id' => '', 'product_name' => '', 'price' => '', 'product_image' => '', 'brand' => ''];

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

    <!-- Nav Bar -->
    <div class="px-3 py-2 text-bg-dark border-bottom sticky-top">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="home.html" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                    <img src="https://pngfre.com/wp-content/uploads/troll-face-poster.png" class="img-thumbnail" width="40px">
                </a>
                <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                    <li>
                        <a href="home.html" class="nav-link text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-house-door d-block mx-auto mb-1" viewBox="0 0 16 16">
                                <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z" />
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="mama.php" class="nav-link text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-menu-button-wide d-block mx-auto mb-1" viewBox="0 0 16 16">
                                <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0h13A1.5 1.5 0 0 1 16 1.5v2A1.5 1.5 0 0 1 14.5 5h-13A1.5 1.5 0 0 1 0 3.5zM1.5 1a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5z" />
                                <path d="M2 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m10.823.323-.396-.396A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0M0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5" />
                            </svg>
                            Orders
                        </a>
                    </li>
                    <li>
                        <a href="https://www.7eleven.co.th/" class="nav-link text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart3 d-block mx-auto mb-1" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                            </svg>
                            Carts
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-globe d-block mx-auto mb-1" viewBox="0 0 16 16">
                                <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m7.5-6.923c-.67.204-1.335.82-1.887 1.855A8 8 0 0 0 5.145 4H7.5zM4.09 4a9.3 9.3 0 0 1 .64-1.539 7 7 0 0 1 .597-.933A7.03 7.03 0 0 0 2.255 4zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a7 7 0 0 0-.656 2.5zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5zM8.5 5v2.5h2.99a12.5 12.5 0 0 0-.337-2.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5zM5.145 12q.208.58.468 1.068c.552 1.035 1.218 1.65 1.887 1.855V12zm.182 2.472a7 7 0 0 1-.597-.933A9.3 9.3 0 0 1 4.09 12H2.255a7 7 0 0 0 3.072 2.472M3.82 11a13.7 13.7 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5zm6.853 3.472A7 7 0 0 0 13.745 12H11.91a9.3 9.3 0 0 1-.64 1.539 7 7 0 0 1-.597.933M8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855q.26-.487.468-1.068zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.7 13.7 0 0 1-.312 2.5m2.802-3.5a7 7 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7 7 0 0 0-3.072-2.472c.218.284.418.598.597.933M10.855 4a8 8 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4z" />
                            </svg>
                            English
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Nav Bar -->

    <!-- Form Submit Alert -->
    <?php if (!empty($_SESSION['message'])) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']) ?>
    <?php endif; ?>
    <!-- End Form Submit Alert -->

    <!-- Form -->
    <form action="product-form.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
        <h4 class="pb-2 m-5">Manage Product</h4>
        <!-- product_name -->
        <label class="form-label">
            Product Name:
            <input type="text" name="product_name" class="form-control" value="<?php echo $result['product_name']; ?>">
        </label>
        <!-- price -->
        <label class="form-label">
            Price:
            <input type="text" name="price" class="form-control" value="<?php echo $result['price']; ?>">
        </label>
        <!-- profile_image -->
        <?php if (!empty($result['profile_image'])) : ?>
            <img src="<?php echo $base_url; ?>/img/<?php echo $result['profile_image']; ?>" width="100" alt="Product Image">
        <?php endif; ?>
        <label for="formFile" class="form-label">
            Image:
            <input type="file" name="profile_image" class="form-control" accept="image/png, image/jpg, image/jpeg">
        </label>
        <!-- brand -->
        <label class="form-label">
            Brand:
            <div class="dropdown">
                <select name = "brand" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <option value="" selected hidden>Select Brand</option>
                    <option value="mama">mama</option>
                    <option value="waiwai">waiwai</option>
                    <option value="samyang">samyang</option>
                    <option value="yumyum">yumyum</option>
                </select>
            </div>
        </label>
        <!-- Submit -->
        <?php if (empty($result['id'])) : ?>
            <button class="btn btn-primary" type="submit">Create</button>
        <?php else : ?>
            <button class="btn btn-primary" type="submit">Update</button>
        <?php endif; ?>
        <a role="button" class="btn btn-secondary" href="index.php">Cancel</a>
        <hr class="my-4">
    </form>
    <!-- End Form -->

    <!-- Table -->
    <div class="container">
        <table class="table table-border border-info">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($rows > 0) : ?>
                    <?php while ($product = mysqli_fetch_assoc($query)) : ?>
                        <tr>
                            <td>
                                <?php if (!empty($product['profile_image'])) : ?>
                                    <img src="<?php echo $base_url; ?>/img/<?php echo $product['profile_image']; ?>" width="100" alt="Product Image">
                                <?php else : ?>
                                    <img src="https://st3.depositphotos.com/23594922/31822/v/450/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg" width="100" alt="Product Image">
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo $product['product_name']; ?>
                            </td>
                            <td>
                                <?php echo number_format($product['price'], 2); ?>
                            </td>
                            <td>
                                <a role="button" href="index.php?id=<?php echo $product['id']; ?>" class="btn btn-outline-dark">Edit</a>
                                <a onclick="return confirm('Are you sure you want to delete?');" role="button" href="product-delete.php?id=<?php echo $product['id']; ?>" class="btn btn-outline-dark">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- End Table -->

    <script src="js/bootstrap.min.js"></script>
</body>

</html>