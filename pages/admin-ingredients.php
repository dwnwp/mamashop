<?php
session_start();
include 'config.php';
// Check if login
if(empty($_SESSION['login'])){
    header("Location: " . $base_url . "/login.php");
}
// All Ingredients
$query = mysqli_query($conn, "SELECT * from ingredients ORDER BY type");
$rows = mysqli_num_rows($query);

// variable
$ingredients = ['id' => '', 'name' => '', 'name_en' => '', 'quantity' => '', 'price' => '', 'type' => ''];

// When press edit ingredients
if (!empty($_GET['id'])) {
    $query2 = mysqli_query($conn, "SELECT * from ingredients where id='{$_GET['id']}'");
    $rows = mysqli_num_rows($query2);

    if ($rows == 0) {
        header('location:' . $base_url . '/admin-ingredients.php');
    }
    $ingredients = mysqli_fetch_assoc($query2);
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Ingredients</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font.css">
</head>

<body>

    <?php include 'admin-navbar.php'; ?>

    <!-- Form -->
    <form action="ingredients-form.php" method="post" autocomplete="off">
        <div class="container">
        <input type="hidden" name="id" value="<?php echo $ingredients['id']; ?>">
        <h4 class="pb-2 m-5">จัดการวัตถุดิบ</h4>
        <!-- _name -->
        <label class="form-label">
            Name:
            <input type="text" name="name" class="form-control" value="<?php echo $ingredients['name']; ?>" required>
        </label>
        <!-- _name en -->
        <label class="form-label">
            Name_en:
            <input type="text" name="name_en" class="form-control" value="<?php echo $ingredients['name_en']; ?>" required>
        </label>
        <!-- quantity -->
        <label class="form-label">
            Quantity:
            <input type="number" min=0 name="quantity" class="form-control" value="<?php echo $ingredients['quantity']; ?>" required>
        </label>
        <!-- price -->
        <label class="form-label">
            Price:
            <input type="number" name="price" min=0 class="form-control" value="<?php echo $ingredients['price']; ?>" required>
        </label>
        <!-- type -->
        <label class="form-label">
            Type:
            <div class="dropdown">
                <select name = "type" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" required>
                    <option value="" selected hidden>Select Type</option>
                    <option value="meat">meat</option>
                    <option value="vegetable">vegetable</option>
                    <option value="topping">topping</option>
                </select>
            </div>
        </label>
        <!-- Submit -->
        <?php if (empty($ingredients['id'])) : ?>
            <button class="btn btn-primary" type="submit">Create</button>
        <?php else : ?>
            <button class="btn btn-primary" type="submit">Update</button>
        <?php endif; ?>
        <a role="button" class="btn btn-secondary" href="admin-ingredients.php">Cancel</a>
        <hr class="my-4">
        </div>
    </form>
    <!-- End Form -->

    <!-- Table -->
    <div class="container">
        <table class="table table-border border-info">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Name_en</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($rows > 0) : ?>
                    <?php while ($product = mysqli_fetch_assoc($query)) : ?>
                        <tr>
                            <td>
                                <?php echo $product['name']; ?>
                            </td>
                            <td>
                                <?php echo $product['name_en']; ?>
                            </td>
                            <td>
                                <?php echo $product['quantity']; ?>
                            </td>
                            <td>
                                <?php echo $product['price']; ?>
                            </td>
                            <td>
                                <?php echo $product['type']; ?>
                            </td>
                            <td>
                                <a role="button" href="admin-ingredients.php?id=<?php echo $product['id']; ?>" class="btn btn-outline-dark">Edit</a>
                                <a onclick="return confirm('Are you sure you want to delete?');" role="button" href="ingredients-delete.php?id=<?php echo $product['id']; ?>" class="btn btn-outline-dark">Delete</a>
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