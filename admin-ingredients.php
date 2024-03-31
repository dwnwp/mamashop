<?php
session_start();
include 'config.php';
// product all
$query = mysqli_query($conn, "SELECT * from ingredients ORDER BY type");
$rows = mysqli_num_rows($query);

// variable for product form
$ingredients = ['id' => '', 'name' => '', 'quantity' => '', 'type' => ''];

// product select edit
if (!empty($_GET['id'])) {
    $query = mysqli_query($conn, "select * from ingredients where id='{$_GET['id']}'");
    $rows = mysqli_num_rows($query);

    if ($rows == 0) {
        header('location:' . $base_url . '/admin-ingredients.php');
    }
    $ingredients = mysqli_fetch_assoc($query);
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
    <form action="ingredients-form.php" method="post" autocomplete="off">
        <input type="hidden" name="id" value="<?php echo $ingredients['id']; ?>">
        <h4 class="pb-2 m-5">Manage Ingredients</h4>
        <!-- _name -->
        <label class="form-label">
            Name:
            <input type="text" name="name" class="form-control" value="<?php echo $ingredients['name']; ?>" required>
        </label>
        <!-- quantity -->
        <label class="form-label">
            Quantity:
            <input type="number" name="quantity" class="form-control" value="<?php echo $ingredients['quantity']; ?>" required>
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
    </form>
    <!-- End Form -->

    <!-- Table -->
    <div class="container">
        <table class="table table-border border-info">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
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
                                <?php echo $product['quantity']; ?>
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