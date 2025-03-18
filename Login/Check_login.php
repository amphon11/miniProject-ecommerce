<?php
include('../connect.php');
require('./Form_Login.php');

if (isset($_POST) && !empty($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sqli = "SELECT * FROM tb_users WHERE username ='$username'";
    $consq = mysqli_query($conn, $sqli);

    if ($consq) {
        $user = mysqli_fetch_assoc($consq);

        // ตรวจสอบรหัสผ่าน
        if ($user && password_verify($password, $user['password'])) {
            // รหัสผ่านถูกต้อง
            session_start();
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['username'] = $username;
            $_SESSION['status'] = $user['status'];
            $status = $user['status'];


            if ($status == "member") {
                echo '<script type="text/javascript">
                Swal.fire({
                    title: "เข้าสู่ระบบสำเร็จ!",
                    text: "ยินดีต้อนรับ สถานะคุณคือ member!",
                    icon: "success",
                    confirmButtonText: "ตกลง"
                });
                    // ระบุเวลาในมิลลิวินาที (ตัวอย่างเช่น 3000 คือ 3 วินาที)
                    setTimeout(function() {
                        location.href = "../";
                    }, 1500);
               
                </script>';
            } elseif ($status == "admin") {
                echo '<script type="text/javascript">
                    Swal.fire({
                        title: "เข้าสู่ระบบสำเร็จ!",
                        text: "ยินดีต้อนรับ สถานะคุณคือ admin!",
                        icon: "success",
                        confirmButtonText: "ตกลง"
                    });
                        // ระบุเวลาในมิลลิวินาที (ตัวอย่างเช่น 3000 คือ 3 วินาที)
                        setTimeout(function() {
                            location.href = "../admin/";
                        }, 1500);
           
                </script>';
            }
            exit();
        } else {
            // รหัสผ่านไม่ถูกต้อง
            echo '<script type="text/javascript">
            Swal.fire({
                title: "เข้าสู่ระบบไม่สำเร็จ!",
                text: "ชื่อผู้ใช้ หรือรหัสผ่านไม่ถูกต้อง!",
                icon: "error"
              });</script>';
        }
    } else {
        echo 'Error querying database.';
    }
}
