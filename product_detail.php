<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!empty($_SESSION)) {

    $ss_username = $_SESSION['username'];
    $ss_status = $_SESSION['status'];
}
require_once('./connect.php');
if (isset($_GET) && !empty($_GET)) {
    $product_id = $_GET['productID'];
    $sql = "SELECT *,tb_brand.name_brand,tb_type_product.type FROM tb_product
            INNER JOIN tb_image_product ON tb_product.product_id = tb_image_product.product_id
            INNER JOIN tb_type_product ON tb_product.type_id = tb_type_product.id
            INNER JOIN tb_brand ON tb_product.brand_id = tb_brand.id
            WHERE tb_product.product_id = '$product_id'";
    $query = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($query);
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
    <script src="https://kit.fontawesome.com/eb9b16e6b0.js" crossorigin="anonymous"></script>
    <title>product detail</title>
</head>

<body>

    <!---< navbar >------------>
    <?php
    include('./include/navbar.php');
    ?>
    <!--- </ navbar > ------------>
    <div class="content">
        <?php

        $sql = "SELECT product_id,store FROM tb_product";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // ดึงข้อมูลและเก็บไว้ในตัวแปร PHP
            $cart = array();

            while ($row = $result->fetch_assoc()) {
                $cart[] = array(
                    'product_id' => $row['product_id'],
                    'store' => $row['store'],  // ตั้งค่าจำนวนสินค้าเริ่มต้นเป็น 0
                );
            }
        } else {
            echo "0 results";
        }
        ?>
        <div class="container">
        <div class="btn-prev" style="margin-bottom: 20px;">
          <a href="../mini_Data/"><i class="fa-solid fa-chevron-left"></i> ย้อนกลับ</a>
        </div>
            <div class="product_detail">
                <div class="box-detail">
                    <div class="box-image">
                        <div class="main_img">
                            <img src="./img/main_img/<?= $product['main_image'] ?>" id="main_img" alt="">
                        </div>


                    </div>
                    <div class="box">
                        <div class="box-text">
                            <div class="title">
                                <h2><?= $product['type'] . " " . $product['name_brand'] . " " . $product['model'] ?></h2>
                            </div>
                            <div class="detail">
                                <h4>Feature</h4>
                                <p><?= $product['feature'] ?></p>
                            </div>
                        </div>
                        <div class="preview_img">
                            <?php if($product['preview_image1']):?>
                            <img src="./img/preview_img/<?= $product['preview_image1'] ?>" alt="">
                            <img src="./img/preview_img/<?= $product['preview_image2'] ?>" alt="">
                            <img src="./img/preview_img/<?= $product['preview_image3'] ?>" alt="">
                            <?php else:?>
                            <div class="no-image-show">
                                <h2>ยังไม่มีรูปภาพเพิ่มเติม !!</h2>
                            </div>
                            <?php endif?>
                        </div>

                    </div>
                </div>
                <div class="box-order">
                    <div class="box-title">
                        <h4><?= $product['type'] . " " . $product['name_brand'] . " " . $product['model'] ?></h4>
                        <p>ราคาหน้าร้าน <span><?= number_format($product['price']) ?> บาท</span></p>
                    </div>
                    <div class="box-buy">
                        <span style="color:#0095da"><?= number_format($product['price']) ?> บาท</span>
                        <p>ราคาเฉพาะออนไลน์เท่านั้น</p>
                        <button class="btn-add" onclick="addToCartID('<?= $product['product_id'] ?>')">
                            <i class="ri-shopping-cart-line"></i>ใส่ตระกร้า</button>
                        <!-- <button class="btn-back" onclick="window.history.back()">เลือกสินค้าต่อ</button> -->
                    </div>

                </div>
            </div>

            <div class="product-attribute">
                <h3>
                    คุณสมบัติ <?= $product['type'] . " " . $product['name_brand'] . " " . $product['model'] ?>
                </h3>
                <?php
                $attribute = array(
                    "Brand", "Model", "Frequency", "impedance", "cableLenght", "connector", "bluetoothVer",
                    "resolution", "battery", "sentivity", "grossweight", "volume", "color"
                );
                $value = array();
                array_push($value, $product['name_brand']);
                array_push($value, $product['model']);
                array_push($value, $product['frequency']);
                array_push($value, $product['impedance']);
                array_push($value, $product['cableLenght']);
                array_push($value, $product['connector']);
                array_push($value, $product['bluetoothVer']);
                array_push($value, $product['resolution']);
                array_push($value, $product['battery']);
                array_push($value, $product['sentivity']);
                array_push($value, $product['grossweight']);
                array_push($value, $product['volume']);
                array_push($value, $product['color']);
                $combinedArray = array_combine($attribute, $value);
                ?>
                <table>
                    <?php foreach ($combinedArray as $key => $value) : ?>
                        <tr>
                            <td class="thead"><?= $key ?></td>
                            <td class="tbody"><?= strtolower($value) == "none" ? " - " : $value  ?></td>
                        </tr>
                    <?php endforeach ?>
                </table>

            </div>
        </div>

        <?php
        require_once("./productFetch.php");
        ?>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="./script/dropdownCart.js"></script>
        <script src="./script/image_preview.js"></script>

</body>

</html>