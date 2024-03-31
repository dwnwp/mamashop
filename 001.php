<?php
session_start();
include 'config.php';

$result = ['id' => '', 'product_name' => '', 'price' => '', 'profile_image' => '', 'brand' => ''];
$query_product = mysqli_query($conn, "SELECT * from products where id='{$_GET['id']}'");
$result = mysqli_fetch_assoc($query_product);

$pork = mysqli_fetch_assoc(mysqli_query($conn,"SELECT quantity from ingredients where name='pork';"));
$chicken = mysqli_fetch_assoc(mysqli_query($conn,"SELECT quantity from ingredients where name='chicken';"));
$breef = mysqli_fetch_assoc(mysqli_query($conn,"SELECT quantity from ingredients where name='breef';"));
$shrimp = mysqli_fetch_assoc(mysqli_query($conn,"SELECT quantity from ingredients where name='shrimp';"));
$squid = mysqli_fetch_assoc(mysqli_query($conn,"SELECT quantity from ingredients where name='squid';"));


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

    <!-- Info -->
    <div class="container">
        <div class="container text-center">
            <h2 class="text-center m-5">Choose</h2>
            <div class="row" style="border: 1px solid black; border-radius: 1em;">
                <div class="col">
                    <div class="container">
                        <?php if (!empty($result['profile_image'])) : ?>
                            <img src="<?php echo $base_url; ?>/img/<?php echo $result['profile_image']; ?>" class="img-fluid" alt="..." style="width:auto; height: 500px; margin: 0 auto 1em auto;">
                        <?php else : ?>
                            <img src="https://st3.depositphotos.com/23594922/31822/v/450/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg" class="card-img-top" alt="..." style="width:auto; height: 500px; margin: 0 auto 1em auto;">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col">
                    <!-- Form -->
                    <form action="cart-add.php" method="post" autocomplete="off">
                        <div class="container">
                            <p class="text-center mt-5 mb-2 fs-4 fw-semibold"><?php echo $result['product_name']; ?></p>
                            <p class="text-center">ผัดมาม่า อาหารจานเดียวสุดง่าย วันนี้เราขอแนะนำผัดมาม่าใส่ไข่ ใส่แค่เส้นกับไข่ผัดจนเข้ากัน ใส่ผักลงไปด้วย ทั้งนี้ สามารถใส่เห็ดหรือเต้าหู้เพิ่มได้ ปิดท้ายปรุงรสด้วยพริกป่นเพื่อความแซ่บ</p>
                            <div class="container mt-5">
                                <!-- Select Meat -->
                                <div class="row align-items-start">
                                    <div class="col-12">
                                        <h4 class="text-start">เลือกเนื้อสัตว์</h4>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="add[]" value="หมู">
                                            <label class="form-check-label" for="inlineCheckbox1">หมู</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="add[]" value="ไก่">
                                            <label class="form-check-label" for="inlineCheckbox2">ไก่</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="add[]" value="เนื้อ">
                                            <label class="form-check-label" for="inlineCheckbox3">เนื้อ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="add[]" value="กุ้ง">
                                            <label class="form-check-label" for="inlineCheckbox3">กุ้ง</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="add[]" value="ปลาหมึก">
                                            <label class="form-check-label" for="inlineCheckbox3">ปลาหมึก</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Select Meat -->
                                <!-- Select Meat -->
                                <div class="row align-items-start mt-3">
                                    <div class="col-12">
                                        <h4 class="text-start">เลือกผัก</h4>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="กระหล่ำ">
                                            <label class="form-check-label" for="inlineCheckbox1">กระหล่ำ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="คะน้า">
                                            <label class="form-check-label" for="inlineCheckbox2">คะน้า</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="แครอท">
                                            <label class="form-check-label" for="inlineCheckbox3">แครอท</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="ผักชี">
                                            <label class="form-check-label" for="inlineCheckbox3">ผักชี</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="หัวหอม">
                                            <label class="form-check-label" for="inlineCheckbox3">หัวหอม</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Select Meat -->
                                 <!-- Select Topping -->
                                 <div class="row align-items-start mt-3">
                                    <div class="col-12">
                                        <h4 class="text-start">เลือกท็อปปิ้ง</h4>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="ไข่ลวก">
                                            <label class="form-check-label" for="inlineCheckbox1">ไข่ลวก</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="ชีส">
                                            <label class="form-check-label" for="inlineCheckbox2">ชีส</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="เบคอนกรอบ">
                                            <label class="form-check-label" for="inlineCheckbox3">เบคอนกรอบ</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="ไข่กุ้ง">
                                            <label class="form-check-label" for="inlineCheckbox3">ไข่กุ้ง</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="หมาล่า">
                                            <label class="form-check-label" for="inlineCheckbox3">หมาล่า</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Select Topping -->
                                <p class="text-center fs-4 fw-semibold my-5">Price <?php echo $result['price']; ?> ฿</p>
                            </div>
                        </div>
                    </form>
                    <!-- End Form -->
                </div>
            </div>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
            <a type="submit" id="orderSubmit" href="cart-add.php?id=<?php echo $result['id']; ?>" class="btn btn-primary m-5">Add To Cart</a>
        </div>
    </div>
    <!-- End Info -->
</body>

</html>