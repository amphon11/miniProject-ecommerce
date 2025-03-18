<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!empty($_SESSION)) {

    $ss_username = $_SESSION['username'];
    $ss_status = $_SESSION['status'];
}
$sh = false;
include("./connect.php");

if (isset($_POST) && isset($_POST['search'])) {
    $sh = true;
    $searchText = $_POST['search'];
    $search_all = " SELECT *,name_brand, tp.`type`
                  FROM tb_product
                  INNER JOIN tb_brand ON tb_product.brand_id = tb_brand.id 
                  INNER JOIN tb_type_product AS tp ON tb_product.type_id = tp.id
                  WHERE model LIKE '%$searchText%' OR tp.`type` LIKE '%$searchText%' OR tb_brand.name_brand LIKE '%$searchText%'";
    $search_all_result = $conn->query($search_all);
    $num_search = $search_all_result->num_rows;

    // foreach($search_all_result as $row){
    //   echo "<pre>";
    //   print_r($row);
    //   echo "</pre>";
    // }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    //head link
    include('./include/head.php');
    ?>
    <title>page</title>
</head>

<body>

    <!---< navbar >------------>
    <?php
    include('./include/navbar.php');
    ?>
    <!--- </ navbar > ------------>

    <div class="content">
        <?php
        $sql = "SELECT tb_product.product_id, tb_product.model, tb_product.store, tb_product.price,tb_image_product.main_image,
    tb_brand.name_brand,tb_type_product.type
    FROM tb_product 
    INNER JOIN tb_image_product ON tb_product.product_id = tb_image_product.product_id
    INNER JOIN tb_type_product ON tb_product.type_id = tb_type_product.id
    INNER JOIN tb_brand ON tb_product.brand_id = tb_brand.id";
        $result = $conn->query($sql);

        // ตรวจสอบว่ามีข้อมูลหรือไม่
        if ($result->num_rows > 0) {
            // ดึงข้อมูลและเก็บไว้ในตัวแปร PHP
            $product = array();

            while ($row = $result->fetch_assoc()) {
                $product[] = array(
                    'product_id' => $row['product_id'],
                    'model' => $row['model'],
                    'image' => $row['main_image'],
                    'name_brand' => $row['name_brand'],
                    'type' => $row['type'],
                    'price' => $row['price'],
                    'store' => $row['store'],  // ตั้งค่าจำนวนสินค้าเริ่มต้นเป็น 0
                    'amount' => 0,  // ตั้งค่าจำนวนสินค้าเริ่มต้นเป็น 0
                );
            }
        } else {
            echo "0 results";
        }
        $sq_type = "SELECT * FROM tb_type_product";
        $sq_type = $conn->query($sq_type);
        ?>

        <div class="container">
            <?php if ($sh && $num_search == 0) : ?>
                <div class="not_found">
                    <h1>ผลการค้นหาสำหรับ <q><?= $searchText ?></q> ไม่พบสินค้า</h1>
                <?php elseif ($sh && $num_search > 0) : ?>
                    <div class="found_items">
                        <h1> ผลการค้นหาสำหรับ <q><?= $searchText ?></q> พบ <?= $num_search ?> รายการ</h1>
                        <div class="box_items">
                            <?php foreach ($search_all_result as $data) { ?>
                                <!-- box item -->
                                <div class="card_items">
                                    <a href="product_detail.php?productID=<?= $data['product_id'] ?>" class="detail_link"></a>
                                    <div class="image">
                                        <?php
                                        $product_id = $data['product_id'];
                                        $image = "SELECT main_image FROM tb_image_product WHERE product_id = '$product_id'";
                                        $image = $conn->query($image);
                                        $fetch_img = $image->fetch_assoc();
                                        ?>
                                        <img src="./img/main_img/<?= $fetch_img['main_image'] ?>" alt="">
                                    </div>
                                    <div class="title">
                                        <p><?= $data['name_brand'] ?> <?= $data['model'] ?> <br>BLACK</p>
                                    </div>
                                    <div class="detail">
                                        <?php if ($data['type'] == "HEADSET") : ?>
                                            <span><?= $data['connector'] ?> / <?= $data['sentivity'] ?> / <?= $data['frequency'] ?></span>
                                        <?php elseif ($data['type'] == "MOUSE") : ?>
                                            <span><?= $data['connector'] ?> / <?= $data['resolution'] ?> / <?= $data['cableLenght'] ?></span>
                                        <?php elseif ($data['type'] == "KEYBOARD") : ?>
                                            <span><?= $data['connector'] ?> / <?= $data['cableLenght'] ?> / <?= $data['volume'] ?> </span>
                                        <?php else : ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="price">
                                        <span>฿<?= number_format($data['price']) ?>.-</span>
                                    </div>
                                    <div class="action">
                                        <button onclick="addToCartID('<?= $data['product_id'] ?>')">
                                            <i class="ri-shopping-cart-line" onclick=""></i>฿<?= number_format($data['price']) ?>.-</button>
                                    </div>
                                </div>
                                <!-- box item -->
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <!-- all product -->
                <div class="all_product">
                    <div class="container">
                        <div class="wrap">
                            <h2>ประเภท</h2>
                            <div class="box_items">
                                <?php if ($sq_type->num_rows > 0) : ?>
                                    <?php while ($row_type = $sq_type->fetch_assoc()) :
                                        $type_id = $row_type['id'];
                                        $sq_product = "SELECT *,tb_image_product.main_image,tb_brand.name_brand FROM tb_product
                              INNER JOIN tb_image_product ON tb_product.product_id=tb_image_product.product_id
                              INNER JOIN tb_brand ON tb_product.brand_id=tb_brand.id
                              WHERE type_id = '$type_id'";
                                        $qr_product = $conn->query($sq_product);
                                        if ($qr_product->num_rows > 0) { ?>
                                            <?php foreach ($qr_product as $data) { ?>
                                                <!-- box item -->
                                                <div class="card_items">
                                                    <a href="product_detail.php?productID=<?= $data['product_id'] ?>" class="detail_link"></a>
                                                    <div class="image">
                                                        <img src="./img/main_img/<?= $data['main_image'] ?>" alt="">
                                                    </div>
                                                    <div class="title">
                                                        <p><?= $data['name_brand'] ?> <?= $data['model'] ?> <br>BLACK</p>
                                                    </div>
                                                    <div class="detail">
                                                        <?php if ($row_type['type'] == "HEADSET") : ?>
                                                            <span><?= $data['connector'] ?> / <?= $data['sentivity'] ?> / <?= $data['frequency'] ?></span>
                                                        <?php elseif ($row_type['type'] == "MOUSE") : ?>
                                                            <span><?= $data['connector'] ?> / <?= $data['resolution'] ?> / <?= $data['cableLenght'] ?></span>
                                                        <?php elseif ($row_type['type'] == "KEYBOARD") : ?>
                                                            <span><?= $data['connector'] ?> / <?= $data['cableLenght'] ?> / <?= $data['volume'] ?> </span>
                                                        <?php else : ?>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="price">
                                                        <span>฿<?= number_format($data['price']) ?>.-</span>
                                                    </div>
                                                    <div class="action">
                                                        <button onclick="addToCartID('<?= $data['product_id'] ?>')">
                                                            <i class="ri-shopping-cart-line" onclick=""></i>฿<?= number_format($data['price']) ?>.-</button>
                                                    </div>
                                                </div>
                                                <!-- box item -->
                                            <?php
                                            }
                                            ?>
                                        <?php
                                        } else {
                                            echo 'nodata##';
                                        }
                                        ?>

                                    <?php endwhile ?>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="none_data">
                            <h1>ยังไม่มีข้อมูล</h1>
                        </div>
                    <?php endif; ?>

                    <div class="pagination">
                        <button class="prev"><i class="ri-arrow-left-s-line"></i></button>
                        <div class="page-link">
                            
                        </div>
                        <button class="next"><i class="ri-arrow-right-s-line"></i></button>
                    </div>
                    </div>
                </div>
            <?php endif ?>

            <!-- end all product -->

            <script>
                var productData = <?php echo json_encode($product); ?>;
            </script>
            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
            <script src="./script/index.js"></script>
            <script src="./script/dropdownCart.js"></script>

</body>

</html>