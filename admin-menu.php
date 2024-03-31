<?php
session_start();
include 'config.php';
// product all
$query = mysqli_query($conn, "SELECT * from products order by brand, price desc");
$rows = mysqli_num_rows($query);

// variable for product form
$result = ['id' => '', 'product_name' => '', 'price' => '', 'product_image' => '', 'brand' => ''];

// product select edit
if (!empty($_GET['id'])) {
    $query_product = mysqli_query($conn, "select * from products where id='{$_GET['id']}'");
    $row_product = mysqli_num_rows($query_product);

    if ($row_product == 0) {
        header('location:' . $base_url . '/admin-menu.php');
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

    <?php include 'admin-navbar.php'; ?>

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
    <form action="product-form.php" method="post" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
        <h4 class="pb-2 m-5">Manage Product</h4>
        <!-- product_name -->
        <label class="form-label">
            Product Name:
            <input type="text" name="product_name" class="form-control" value="<?php echo $result['product_name']; ?>" required>
        </label>
        <!-- price -->
        <label class="form-label">
            Price:
            <input type="text" name="price" class="form-control" value="<?php echo $result['price']; ?>" required>
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
                <select name = "brand" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" required>
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
        <a role="button" class="btn btn-secondary" href="<?php echo $base_url; ?>/admin-menu.php">Cancel</a>
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
                    <th>Brand</th>
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
                                <?php echo $product['brand']; ?>
                            </td>
                            <td>
                                <a role="button" href="<?php echo $base_url; ?>/admin-menu.php?id=<?php echo $product['id']; ?>" class="btn btn-outline-dark">Edit</a>
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