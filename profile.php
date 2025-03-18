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
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <title>profile</title>
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
                location.href = "./Login/Form_Login.php";
            }, 2000);
    </script>';
    } else {
        $ss_username = $_SESSION['username'];
        $ss_status = $_SESSION['status'];
        include('./connect.php');
        $query = "SELECT * FROM tb_users
              INNER JOIN address ON tb_users.username = address.username
              WHERE tb_users.username = '$ss_username'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
    }


    include('./include/navbar.php');
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
                                <li><a class="active" href="#"><i class="ri-user-line"></i> ข้อมูลส่วนตัว</a></li>
                                <li><a href="./order/order_list.php"><i class="ri-article-line"></i> รายการคำสั่งซื้อ</a></li>
                                <li><a href="" class="disabled"><i class="ri-money-dollar-box-line"></i> แนบสลิปชำระเงิน</a></li>
                                <li><a href="" class="disabled"><i class="ri-truck-line"></i> เช็คสถานะการจัดส่ง</a></li>
                                <li><a href="./logout.php"><i class="ri-logout-box-r-line"></i> ออกจากระบบ</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- เนื้อหา -->
                    <div class="content">
                        <div class="box-profile">
                            <div class="title">
                                <h2>ข้อมูลส่วนตัว</h2>
                                <span><a href="#"><i class="ri-edit-2-fill"></i> แก้ไข</a></span>
                            </div>
                            <div class="row">
                                <div class="colth">
                                    <!-- <p><span>รหัสลูกค้า</span></p> -->
                                    <p><span>E-mail</span></p>
                                    <p><span>ชื่อ-สกุล</span></p>
                                    <p><span>โทรศัพท์มือถือ</span></p>
                                </div>
                                <div class="col-td">
                                    <!-- <p><span>ยังไม่ตั้ง</span></p> -->
                                    <p><span><?= $row['email'] ?></span></p>
                                    <p><span><?= $row['firstname'] . " " . $row['lastname'] ?></span></p>
                                    <p><span><?= $row['phone'] ?></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="box-address">
                            <h2>ที่อยู่ในการจัดส่ง</h2>
                            <div class="row">
                                <div class="colth">
                                    <p><span>บ้านเลขที่ / ซอย</span></p>
                                    <p><span>ตำบล</span></p>
                                    <p><span>อำเภอ</span></p>
                                    <p><span>จังหวัด</span></p>
                                    <p><span>รหัสไปรษณีย์</span></p>

                                </div>
                                <div class="col-td">
                                    <p><span><?= $row['houseNumber'] ?></span></p>
                                    <p><span><?= $row['tambon'] ?></span></p>
                                    <p><span><?= $row['amphure'] ?></span></p>
                                    <p><span><?= $row['province'] ?></span></p>
                                    <p><span><?= $row['postelCode'] ?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- เนื้อหา -->
                </div>
            </div>
        <?php endif ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="./script/dropdownCart.js"></script>
</body>

</html>