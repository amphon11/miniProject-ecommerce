<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../img/icons8-workstation-gradient/icons8-workstation-64.png">
    <!-- เรียกใช้ไฟล์ CSS ของ SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- เรียกใช้ไฟล์ CSS ของ SweetAlert2 -->
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <title>Order list</title>
</head>

<body>
    <?php
    if (empty($_SESSION)) {
        echo '<script type="text/javascript">
        Swal.fire({
            title: "กรุณาเข้าสู่ระบบ!",
            text:"กรุณาเข้าสู่ระบบก่อน",
            icon: "error",
            confirmButtonText: "ตกลง"
        });
            // ระบุเวลาในมิลลิวินาที (ตัวอย่างเช่น 3000 คือ 3 วินาที)
            setTimeout(function() {
                location.href = "../Login/Form_Login.php";
            }, 2000);
    
    </script>';
    } else {
        $ss_username = $_SESSION['username'];
        $ss_status = $_SESSION['status'];
        include('../connect.php');
        $query = "SELECT * FROM tb_users
          INNER JOIN address ON tb_users.username = address.username
          WHERE tb_users.username = '$ss_username'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        $order_query = "SELECT * FROM tb_order WHERE username = '$ss_username'";
        $order_result = $conn->query($order_query);
        $numOrder = $order_result->num_rows;
    }

    ?>
    <!---< navbar >------------>
    <?php
    include('../include/navbar.php');
    ?>
    <!--- </ navbar > ------------>
    <div class="content">
        <?php if (!empty($_SESSION)) : ?>
            <div class="container">
                <div class="block-profile">
                    <div class="side-menu">
                        <div class="profile">
                            <div class="icon">
                                <i class="ri-account-circle-fill"></i>
                            </div>
                            <div class="name">
                                <h4><?= $row['username'] ?></h4>
                                <span><?= $row['firstname'] . ' ' . $row['lastname'] ?></span>
                            </div>
                        </div>
                        <div class="menu">
                            <ul>
                                <li><a href="../profile.php"><i class="ri-user-line"></i> ข้อมูลส่วนตัว</a></li>
                                <li><a class="active" href="#"><i class="ri-article-line"></i> รายการคำสั่งซื้อ</a></li>
                                <li><a href="" class="disabled"><i class="ri-money-dollar-box-line"></i> แนบสลิปชำระเงิน</a></li>
                                <li><a href="" class="disabled"><i class="ri-truck-line"></i> เช็คสถานะการจัดส่ง</a></li>
                                <li><a href="../logout.php"><i class="ri-logout-box-r-line"></i> ออกจากระบบ</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- เนื้อหา -->
                    <div class="content-order-list">
                        <div class="box-order-list">
                            <?php if ($numOrder > 0) : ?>
                                <div class="head-order">
                                    <h3>คำสั่งซื้อทั้งหมด <?= $numOrder ?> รายการ</h3>
                                </div>

                                <?php foreach ($order_result as $row) : ?>
                                    <?php
                                    $order_id = $row['order_id'];
                                    $product_qr = "SELECT orProduct.order_id,main_image,model,amount,price FROM tb_order_product as orProduct
                        INNER JOIN tb_image_product AS imgPro
                        ON orProduct.product_id = imgPro.product_id 
                        INNER JOIN tb_product AS P
                        ON P.product_id = imgPro.product_id 
                        WHERE order_id = '$order_id'";
                                    $product_result = $conn->query($product_qr);
                                    $sum = 0;
                                    $i = 1;
                                    ?>
                                    <div class="order-list">
                                        <div class="title">
                                            <h3>คำสั่งซื้อที่ <?= $order_id ?></h3>
                                        </div>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>รายการสินค้า</th>
                                                    <th>รูปภาพ</th>
                                                    <th>ชื่อสินค้า</th>
                                                    <th>จำนวน</th>
                                                    <th>ราคา/ชิ้น</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($product_result as $p) : ?>
                                                    <tr>
                                                        <td><?= $i ?></td>
                                                        <td><img src="../img/main_img/<?= $p['main_image'] ?>" alt=""></td>
                                                        <td><?= $p['model'] ?></td>
                                                        <td><?= $p['amount'] ?></td>
                                                        <td><?= number_format($p['price']); ?> บ.</td>
                                                    </tr>
                                                <?php
                                                    $i++;
                                                    $sum += $p['amount'] * $p['price'];
                                                endforeach;
                                                ?>

                                            </tbody>
                                        </table>
                                        <div class="summary">
                                            <?php
                                            $timestampStr = $row['order_Date'];
                                            $timestamp = strtotime($timestampStr);
                                            $day = date("Y-m-d", $timestamp);
                                            $time = date("H:i", $timestamp);

                                            ?>
                                            <p>วันที่สั่งซื้อ(ป-ด-ว) <span><?= $day ?></span> เวลา <span><?= $time ?></span> น.</p>
                                            <p>รวมเป็นเงิน : <span><?= number_format($sum) ?></span> บาท</p>
                                            <p>สถานะคำสั่งซื้อ : <span class="state_order wait">รอการชำระเงิน</span></p>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            <?php else : ?>
                                <h2 class="no_Order">!! ยังไม่มีรายคำสั่งซื้อ !!</h2>
                            <?php endif ?>
                        </div>

                    </div>
                    <!-- เนื้อหา -->
                </div>
            </div>
        <?php endif ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="../script/dropdownCart2.js"></script>
</body>

</html>