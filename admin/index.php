<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Admin</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- เรียกใช้ไฟล์ CSS ของ SweetAlert2 -->
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.all.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css
" rel="stylesheet">
    <!-- เรียกใช้ไฟล์ CSS ของ SweetAlert2 -->

    <link rel="stylesheet" href="./css/style.css">
    <!-- Bootstrap CSS v5.2.1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- Bootstrap CSS v5.2.1 -->

</head>

<body>

    <?php
    if (empty($_SESSION) || $_SESSION['status'] != "admin") {
        echo '<script type="text/javascript">
                    Swal.fire({
                        title: "กรุณาเข้าสู่ระบบ!",
                        text: "พื้นที่เฉพาะผู้ดูแลระบบ admin!",
                        icon: "error",
                        confirmButtonText: "ตกลง"
                    });
                        // ระบุเวลาในมิลลิวินาที (ตัวอย่างเช่น 3000 คือ 3 วินาที)
                        setTimeout(function() {
                            location.href = "../Login/Form_Login.php";
                        }, 2000);
           
                </script>';
    } else {
        $username = $_SESSION['username'];
    }
    ?>



    <main>
        <!-- place navbar here -->
        <div class="container-fluid">
            <div class="row flex-nowrap" style="min-height:100dvh">
                <div class="col-auto col-md-3 col-xl-2 box-left">
                    <div class="box-nav">
                        <a href="../admin/" class="d-flex align-items-center  text-decoration-none mb-4">
                            <span class="menu-title">เมนู</span>
                        </a>
                        <ul class="nav nav-pills flex-column" id="menu">
                            <li class="nav-item <?php if(empty($_GET['page'])){echo "active";}?>">
                                <a href="../admin/" class="nav-link  align-middle px-0">
                                    <span class="ms-1 d-none d-sm-inline">สินค้า</span>
                                </a>
                            </li>
                            <li class="nav-item <?php if(isset($_GET['page']) && $_GET['page'] == "brand"){echo "active";}?>">
                                <a href="?page=brand" class="nav-link  align-middle px-0">
                                    <span class="ms-1 d-none d-sm-inline">แบรนด์</span>
                                </a>
                            </li>
                            <li class="nav-item <?php if(isset($_GET['page']) && $_GET['page'] == "type"){echo "active";}?>">
                                <a href="?page=type" class="nav-link  align-middle px-0">
                                    <span class="ms-1 d-none d-sm-inline">ประเภท</span>
                                </a>
                            </li>
                            <li class="nav-item <?php if(isset($_GET['page']) && $_GET['page'] == "order_list"){echo "active";}?>">
                                <a href="?page=order_list" class="nav-link  align-middle px-0">
                                    <span class="ms-1 d-none d-sm-inline">คำสั่งซื้อ</span>
                                </a>
                            </li>
                            
                        </ul>

                        <hr>
                        <div class="dropdown pb-4">
                            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                                <span class="d-none d-sm-inline mx-1"><?=!empty($_SESSION) ? $username : '' ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="?page=logout">ออกจากระบบ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col py-3">
                    <!-- -----------------------------------------------------------------------####>
                --------------------------#####[<CONTENT>]######-------------------------------- -->
                    <?php

                    require_once("../connect.php");
                    if (!isset($_GET['page']) && empty($_GET['page'])) {
                        if (isset($_GET['function']) && $_GET['function'] == 'edit') {
                            // include('./editProduct.php');
                            include('./editProduct.php');
                        }  else if (isset($_GET['function']) && $_GET['function'] == 'add_preview') {
                            include('./add_preview.php');
                        } else {
                            include('./home.php');
                        }
                    } else if (isset($_GET['page']) && $_GET['page'] == 'add_product') {
                        include('./addProduct.php');
                    } else if (isset($_GET['page']) && $_GET['page'] == 'brand') {
                        include('./brand.php');
                    } else if (isset($_GET['page']) && $_GET['page'] == 'order_list') {
                        include('./order_list.php');
                    } else if (isset($_GET['page']) && $_GET['page'] == 'type') {
                            include('./type.php');
                    } else if (isset($_GET['page']) && $_GET['page'] == 'logout') {
                        ?>
                        <script type="text/javascript">
                            Swal.fire({
                                title: "ออกจากระบบใช่หรือไม่?",
                                text: "กรุณากดยืนยัน'หากต้องการออกจากระบบ!",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "ยืนยัน ออกจากระบบ!",
                                cancelButtonText: "ยกเลิก"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                // ยืนยันการออกจากระบบ
                                Swal.fire({
                                    title: "ออกจากระบบสำเร็จ!",
                                    text: "คุณได้ทำการออกจากระบบสำเร็จ!",
                                    icon: "success"
                                }).then(() => {
                                    // ใช้ AJAX เรียก clear_session.php
                                    var xhr = new XMLHttpRequest();
                                    xhr.onreadystatechange = function() {
                                    if (xhr.readyState == 4 && xhr.status == 200) {
                                        // นำผู้ใช้ไปยังหน้าแรกหลังจากออกจากระบบ
                                        location.href = "../";
                                    }
                                    };
                                    xhr.open("GET", "../logout/clear_session.php", true);
                                    xhr.send();
                                });
                                }else{
                                    location.href = "../admin";
                                }
                            });
                        </script>
                        <?php
                    }
                        
                    ?>

                    <!-- -----------------------------------------------------------------------####>
                --------------------------#####[</CONTENT>]######-------------------------------- -->
                </div>
            </div>
        </div>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>

    <!-- data table -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
    <script type="text/javascript">
        // เพิ่มส่วนนี้เข้าไปจะถือว่าเป็นการตั้งค่าให้ Datatable เป็น Default ใหม่เลย

        $.extend(true, $.fn.dataTable.defaults, {
            "language": {
                "sProcessing": "กำลังดำเนินการ...",
                "sLengthMenu": "แสดง_MENU_ แถว",
                "sZeroRecords": "ไม่พบข้อมูล",
                "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
                "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                "sInfoPostFix": "",
                "sSearch": "ค้นหา:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "เิริ่มต้น",
                    "sPrevious": "ก่อนหน้า",
                    "sNext": "ถัดไป",
                    "sLast": "สุดท้าย"
                }
            }
        });

        // เรียกใช้งาน Datatable function
    </script>
    <script>
        $(document).ready(function() {
            $("#myTable").DataTable();
        });
    </script>

    <!-- /data table -->
    <!-- img-preview  -->
    <script type="text/javascript">
        const image_select = document.querySelectorAll(".img_select");
        const image_show = document.querySelectorAll(".image-show");
        const tag_name = document.querySelectorAll(".tag_name");
        image_select.forEach((element,i)=>{
            element.addEventListener('change',function(even){
                const file = event.target.files[0];
                if (file) {
                // สร้าง Object URL จากไฟล์ที่เลือก
                const imageUrl = URL.createObjectURL(file);

                // แสดงรูปภาพใน div ที่มี id เป็น 'imageShow1'
                image_show[i].innerHTML = `<img src="${imageUrl}" alt="รูปภาพ">`;
                tag_name[i].innerHTML = `${file.name}`;
            }

            });
        });
        // document.getElementById('image_selectlect1').addEventListener('change', function(event) {
        //     // รับข้อมูลไฟล์ที่เลือก
        //     const file = event.target.files[0];

        //     // ตรวจสอบว่ามีไฟล์ถูกเลือกหรือไม่
        //     if (file) {
        //         // สร้าง Object URL จากไฟล์ที่เลือก
        //         const imageUrl = URL.createObjectURL(file);

        //         // แสดงรูปภาพใน div ที่มี id เป็น 'imageShow1'
        //         document.getElementById('image_show').innerHTML = `<img src="${imageUrl}" alt="รูปภาพ">`;
        //         document.querySelector(".tag_name").innerHTML = `${file.name}`;
        //     }
        // });



        function updatePreview(input, target) {
            let file = input.files[0];
            let reader = new FileReader();

            reader.readAsDataURL(file);
            reader.onload = function() {
                let img = document.getElementById(target);
                // can also use "this.result"
                img.src = reader.result;
            }
        }
    </script>
    <!-- img-preview -->
    <script src="./script/script.js"></script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
    <!-- font awesome icon -->
    <script src="https://kit.fontawesome.com/eb9b16e6b0.js" crossorigin="anonymous"></script>
    <!-- font awesome icon -->
</body>

</html>