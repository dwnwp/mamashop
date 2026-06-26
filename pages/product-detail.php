<?php
session_start();
include '../config.php';

$result = ['id' => '', 'product_name' => '', 'price' => '', 'profile_image' => '', 'brand' => ''];
$query_product = mysqli_query($conn, "SELECT * from products where id='{$_GET['id']}'");
$query_meat = mysqli_query($conn, "SELECT * from ingredients where type='meat';");
$query_vegetable = mysqli_query($conn, "SELECT * from ingredients where type='vegetable';");
$query_topping = mysqli_query($conn, "SELECT * from ingredients where type='topping';");
$result = mysqli_fetch_assoc($query_product);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <title><?php if($_SESSION['lang']=='th'){echo $result['product_name'];}elseif($_SESSION['lang']=='en'){echo $result['product_name_en'];} ?></title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font.css">
</head>

<body>

    <?php include '../navbar.php'; ?>

    <!-- Info -->
    <div class="container">
        <div class="container text-center">
            <h2 class="text-center m-5"><?php if ($_SESSION['lang'] == 'th') {
                                            echo "โปรดเลือกส่วนประกอบ";
                                        } else if ($_SESSION['lang'] == 'en') {
                                            echo "Please Choose Ingredients";
                                        } ?></h2>
            <script>
                var price = <?php echo $result['price']; ?>;
            </script>
            <div class="row" style="border: 3px solid black; border-radius: 1em;">
                <div class="col">
                    <div class="container">
                        <?php if (!empty($result['profile_image'])) : ?>
                            <img src="<?php echo $base_url; ?>/img/<?php echo $result['profile_image']; ?>" class="img-fluid" alt="..." style="width:auto; height: 500px; margin: 20px auto 1em auto;">
                        <?php else : ?>
                            <img src="https://st3.depositphotos.com/23594922/31822/v/450/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg" class="card-img-top" alt="..." style="width:auto; height: 500px; margin: 0 auto 1em auto;">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col">
                    <!-- Form -->
                    <form action="../actions/cart-add.php" method="post" autocomplete="off">
                        <div class="container">
                            <p class="text-center mt-5 fs-2 fw-semibold"><?php if ($_SESSION['lang'] == 'th') {
                                                                                echo $result['product_name'];
                                                                            } else {
                                                                                echo $result['product_name_en'];
                                                                            } ?></p>
                            <input value="<?php echo $result['id']; ?>" hidden name="id">
                            <?php //if ($_SESSION['lang'] == 'th') : ?>
                                <div class="container mt-5">
                                    <!-- Select Meat -->    
                                    <div class="row p-2" style="border: 1px solid black; border-radius: 1em;">
                                        <div class="col-12">
                                            <h5 class="text-start"><?php if($_SESSION['lang']=='th'){echo "เลือกเนื้อสัตว์";}else{echo "Select Meat";}?></h5>
                                            <?php while($meat=mysqli_fetch_assoc($query_meat)): ?>
                                                <?php if($meat['quantity']>0): ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="add[]" value="<?php if($_SESSION['lang']=='th'){echo $meat['name'];}else{echo $meat['name_en'];}?>">
                                                        <label class="form-check-label" for="inlineCheckbox1"><?php if($_SESSION['lang']=='th'){echo $meat['name'];}else{echo $meat['name_en'];}?><?php echo '+'.$meat['price'].'฿';?></label>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="add[]" value="<?php echo $meat['name'] ?>" disabled>
                                                        <label class="form-check-label" for="inlineCheckbox1"><?php if($_SESSION['lang']=='th'){echo $meat['name'];}else{echo $meat['name_en'];}?><?php echo '+'.$meat['price'].'฿';?></label>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>
                                    <!-- End Select Meat -->
                                    <!-- Select Vegetable -->
                                    <div class="row mt-3 p-2" style="border: 1px solid black; border-radius: 1em;">
                                        <div class="col-11">
                                            <h5 class="text-start"><?php if($_SESSION['lang']=='th'){echo "เลือกผัก";}else{echo "Select Vegetable";}?></h5>
                                            <?php while($vegetable=mysqli_fetch_assoc($query_vegetable)): ?>
                                                <?php if($vegetable['quantity']>0): ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="add[]" value="<?php if($_SESSION['lang']=='th'){echo $vegetable['name'];}else{echo $vegetable['name_en'];}?>">
                                                        <label class="form-check-label" for="inlineCheckbox1"><?php if($_SESSION['lang']=='th'){echo $vegetable['name'];}else{echo $vegetable['name_en'];}?><?php echo '+'.$vegetable['price'].'฿';?></label>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="add[]" value="<?php if($_SESSION['lang']=='th'){echo $vegetable['name'];}else{echo $vegetable['name_en'];}?>" disabled>
                                                        <label class="form-check-label" for="inlineCheckbox1"><?php if($_SESSION['lang']=='th'){echo $vegetable['name'];}else{echo $vegetable['name_en'];}?><?php echo '+'.$vegetable['price'].'฿';?></label>
                                                    </div>
                                            <?php endif; ?>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>
                                    <!-- End Select Vegetable -->
                                    <!-- Select Topping -->
                                    <div class="row mt-3 p-2" style="border: 1px solid black; border-radius: 1em;">
                                        <div class="col-12">
                                            <h5 class="text-start"><?php if($_SESSION['lang']=='th'){echo "เลือกท็อปปิ้ง";}else{echo "Select Topping";}?></h5>
                                            <?php while($topping=mysqli_fetch_assoc($query_topping)): ?>
                                                <?php if($topping['quantity']>0): ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="add[]" value="<?php if($_SESSION['lang']=='th'){echo $topping['name'];}else{echo $topping['name_en'];}?>">
                                                        <label class="form-check-label" for="inlineCheckbox1"><?php if($_SESSION['lang']=='th'){echo $topping['name'];}else{echo $topping['name_en'];}?><?php echo '+'.$topping['price'].'฿';?></label>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="add[]" value="<?php if($_SESSION['lang']=='th'){echo $vegetable['name'];}else{echo $vegetable['name_en'];}?>" disabled>
                                                        <label class="form-check-label" for="inlineCheckbox1"><?php if($_SESSION['lang']=='th'){echo $topping['name'];}else{echo $topping['name_en'];}?><?php echo '+'.$topping['price'].'฿';?></label>
                                                    </div>
                                            <?php endif; ?>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>
                                    <!-- End Select Topping -->
                                    <p class="text-center fs-4 fw-semibold mt-5 text-success"><?php if($_SESSION['lang']=='th'){echo "ราคาเริ่มต้น";}else{echo "Starting Price";}?> <?php echo $result['price']; ?> ฿</p>
                                    <div class="d-grid gap-2 col-6 mx-auto mb-5">
                                        <button class="btn btn-dark shadow" type="submit" onclick="location.href='../actions/cart-add.php?id=<?php echo $result['id']; ?>';" name="submit"><?php if ($_SESSION['lang'] == 'th') {
                                                                                                                                                                                            echo "ใส่ตะกร้า";
                                                                                                                                                                                        } else {
                                                                                                                                                                                            echo "Add To Cart";
                                                                                                                                                                                        } ?></button>
                                    </div>
                                </div>
                        </div>
                </div>
            </div>
        </div>
        </form>
        <!-- End Form -->
    </div>
    <!-- End Info -->

</body>

<?php include '../footer.php'; ?>

</html>