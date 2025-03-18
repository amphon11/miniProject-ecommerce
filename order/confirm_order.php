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
    <link rel="icon" type="image/x-icon" href="./img/icons8-workstation-gradient/icons8-workstation-64.png">
    <!-- เรียกใช้ไฟล์ CSS ของ SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- เรียกใช้ไฟล์ CSS ของ SweetAlert2 -->
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/eb9b16e6b0.js" crossorigin="anonymous"></script>
    <title>Order</title>
</head>

<body>

    <!---< navbar >------------>
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
       
    }else{
        $ss_username = $_SESSION['username'];
        $ss_status = $_SESSION['status'];
        require_once('../connect.php');
        $sq_user = "SELECT * FROM tb_users,address WHERE tb_users.username=address.username AND  tb_users.username = '$ss_username'";
        $sq_user = $conn->query($sq_user);
        $user_fetch = $sq_user->fetch_assoc();

    }
    include('../include/navbar.php');
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
        <div class="container-confirm">
            <div class="btn-prev">
                <a href="../cart.php"><i class="fa-solid fa-chevron-left"></i> ย้อนกลับ</a>
            </div>
            <div class="box">
                <div class="box-left">
                    <div class="box-product">
                        <div class="title">
                            <h2>รายการสินค้า</h2>
                        </div>
                        <div class="thead">
                            <p>สินค้า</p>
                            <p>ราคา</p>
                        </div>
                        <form id="Form_order" action="./order.php" method="POST" enctype="multipart/form-data">
                            <div class="box-items" id="box_items">
                                <!-- <div class="item">
                                    <div class="image">
                                        <img src="../img/main_img/A0142431OK_BIG_1.webp" alt="">
                                    </div>
                                    <div class="name">
                                        <p>MOUSE AULA S2000 series RGB BLACK</p>
                                    </div>
                                    <div class="amout">
                                        <p>x 4</p>
                                    </div>
                                    <div class="price">
                                        <h4>฿ 200</h4>
                                    </div>
                                </div> -->

                            </div>
                        </form>
                    </div>
                    <div class="box-address">
                        <div class="title">
                            <h2>รายละเอียดการรับสินค้า</h2>
                        </div>
                        <div class="box">
                            <div class="head">
                                <p>ชื่อผู้รับ :</p>
                                <p>โทรศัพท์ :</p>
                                <p>ที่อยู่ในการจัดส่ง :</p>
                            </div>
                            <div class="body">
                                <p><?=$user_fetch['firstname']." ".$user_fetch['lastname']?></p>
                                <p><?=$user_fetch['phone']?></p>
                                <p><?=$user_fetch['houseNumber']?> ตำบล <?=$user_fetch['tambon']?> อำเภอ <?=$user_fetch['amphure']?> 
                                จังหวัด <?=$user_fetch['province']." ".$user_fetch['postelCode']?></p>
                            </div>
                        </div>
                    </div>
                    <div class="box-payment">
                        <div class="title">
                            <h2>ช่องทางการชำระเงิน</h2>
                        </div>
                        <div class="bank-pay">
                            <p><i class="fa-solid fa-building-columns"></i><span> โอน/ชำระผ่านบัญชีธนาคาร</span></p>
                        </div>

                    </div>
                </div>
                <div class="box-right">
                    <div class="title">
                        <h2>สรุปรายการสั่งซื้อ</h2>
                        <hr>
                    </div>
                    <div class="box-user">
                        <p><i class="fa-regular fa-circle-user"></i> ข้อมูลลูกค้า</p>
                    </div>
                    <div class="box-detail">
                        <p>ชื่อผู้ใช้ : <span><?=$ss_username?></span></p>
                        <p>อีเมล : <span><?=$user_fetch['email']?></span></p>
                        <p>โทรศัพท์ : <span><?=$user_fetch['phone']?></span></p>
                    </div>
                    <div class="box-sum">
                        <p>คำสั่งซื้อทั้งหมด <span id="total"></span></p>
                        <p>ยอดรวมสินค้า <span class="total_price"> ฿800</span></p>
                    </div>
                    <div class="confirm-btn" id="btn_confirm">
                        <p>ยืนยันคำสั่งซื้อ</p>
                        <span class="total_price"> ฿800</span>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <script>
        var cart_store = <?php echo json_encode($cart); ?>;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script src="../script/dropdownCart2.js"></script>
    <script src="../script/confirmOrder.js"></script>
</body>

</html>