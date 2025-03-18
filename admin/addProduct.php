<?php
$sql = "SELECT * FROM tb_product";
$sql = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($sql);

$sql_brand = "SELECT * FROM tb_brand";
$sql_brand = mysqli_query($conn, $sql_brand);

$sql_type = "SELECT * FROM tb_type_product";
$sql_type = mysqli_query($conn, $sql_type);

function modified_value($input)
{
    // ทำการปรับปรุงค่าตามต้องการ
    // ตัวอย่าง: ในกรณีนี้ให้เพิ่ม "modified_" นำหน้าค่า
    return $input;
}




if (isset($_POST) and isset($_POST['brand'])) {
    $brand = $_POST['brand'];
    $sql_select_brand = "SELECT * FROM tb_brand WHERE name_brand = '$brand'";
    $sql_select_brand = mysqli_query($conn, $sql_select_brand);
    $current_brand = mysqli_num_rows($sql_select_brand);
    if ($current_brand > 0) {
        // header("Refresh:0");
        $alert = '<script>';
        $alert .= ' Swal.fire({
            title: "ชื่อแบรนด์ซ้ำ!!",
            icon: "error",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "ยืนยัน",
            position: "top"
          });';
        $alert .= '</script>';
        echo $alert;
    } else {

        $sql = "INSERT INTO tb_brand (name_brand)VALUES('$brand')";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            $alert = '<script>';
            $alert .= ' Swal.fire({
                title: "เพิ่มแบรนด์สำเร็จ!!",
                icon: "success",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "ยืนยัน",
                position: "top",
                timer: 1000
              }).then(function() {
                  window.location.href="?page=brand";
              });';
            $alert .= '</script>';
            echo $alert;
        }
    }
} elseif (isset($_POST['type'])) {
    echo $_POST['type'];
    $type = $_POST['type'];
    $sql_select_type = "SELECT * FROM tb_type_product WHERE type = '$type'";
    $sql_select_type = mysqli_query($conn, $sql_select_type);
    $current_type = mysqli_num_rows($sql_select_type);
    if ($current_type == 1) {
        $alert = '<script>';
        $alert .= ' Swal.fire({
            title: "ชื่อประเภทสินค้าซ้ำ!!",
            icon: "error",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "ยืนยัน",
            position: "top"
          });';
        $alert .= '</script>';
        echo $alert;
    } else {

        $sql = "INSERT INTO tb_type_product (type)VALUES('$type')";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            $alert = '<script>';
            $alert .= ' Swal.fire({
                title: "เพิ่มประเภทสำเร็จ!!",
                icon: "success",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "ยืนยัน",
                position: "top",
                timer: 1000
              }).then(function() {
                  window.location.href="?page=type";
              });';
            $alert .= '</script>';
            echo $alert;
        }
    }
} elseif (!empty($_POST) and isset($_FILES)) {
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    // สร้างตัวแปรใหม่เพื่อเก็บข้อมูลที่ปรับปรุง
    $modifiedPost = array();

    foreach ($_POST as $key => $value) {
        // ตรวจสอบว่า $value มีค่าว่างหรือไม่
        if ($value == "") {
            // ถ้ามีค่าว่าง ให้ใส่ "none" ลงใน $modifiedPost
            $modifiedPost[$key] = modified_value("none");
        } else {
            // ถ้าไม่มีค่าว่าง ให้ใส่ค่าเดิมลงใน $modifiedPost
            $modifiedPost[$key] = $value;
        }
    }
    // echo '<pre>';
    // print_r($modifiedPost);
    // echo '</pre>';
    // exit();


    $brand_id = $modifiedPost['brand_id'];
    $type_id = $modifiedPost['type_id'];
    $model = $modifiedPost['model'];
    $connector = "";

    $frequency = $modifiedPost['frequency'];
    $impedance = $modifiedPost['impedance'];
    $sentivity = $modifiedPost['sentivity'];
    $bluetoothVer = $modifiedPost['bluetoothVer'];
    $resolution = $modifiedPost['resolution'];
    $feature = $modifiedPost['feature'];
    $cableL = $modifiedPost['cableL'];
    $battery = $modifiedPost['battery'];
    $grossweight = $modifiedPost['grossweight'];
    $volume = $modifiedPost['volume'];
    $color = $modifiedPost['color'];

    $store = $_POST['store'];
    $price = $_POST['price'];

    foreach ($_POST['connector'] as $key => $value) {
        $connector = $connector . " " . $value;
    }
    // เพิ่มรูปลงไฟล์
    $ck = 0;

    $model_q = "SELECT model FROM tb_product WHERE model = '$model'";
    $model_q = $conn->query($model_q);
    $num_model = $model_q->num_rows;

    if ($num_model > 0) {
        echo '<script>
            Swal.fire({
                title: "ชื่อ model ซ้ำ !!",
                text: "model ซ้ำกรุณากรอกใหม่",
                icon: "error",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "ยืนยัน",
                position: "center"
              });
            </script>';
    }
    else {

        if (isset($_FILES["main_img"]["name"]) && !empty($_FILES["main_img"]["name"])) {
            $dir = "../img/main_img/";
            $filename = basename($_FILES["main_img"]["name"]);
            //$name = $_FILES["main_img"]["name"];

            if (!file_exists($dir . $filename)) {
                if (move_uploaded_file($_FILES["main_img"]["tmp_name"], $dir . $filename)) {
                    $filename = $filename;
                    // $alert .= 'alert("เพิ่มรูปสำเร็จ");';
                } else {
                    $alert = '<script>';
                    $alert .= 'alert("เพิ่มรูปล้มเหลว");';
                    $alert .= '</script>';
                    echo $alert;
                    $ck = 1;
                }
            } else {
                $newfilename = time() . $filename;
                if (move_uploaded_file($_FILES["main_img"]["tmp_name"], $dir . $newfilename)) {
                    $filename = $newfilename;
                    // $alert .= 'alert("เพิ่มรูปสำเร็จ ชื่อใหม่");';
                } else {
                    $alert = '<script>';
                    $alert .= 'alert("เกิดข้อผิดพลาด");';
                    $alert .= '</script>';
                    echo $alert;
                    $ck = 1;
                }
            }
        } else {
            $filename = "";
        }
        if ($ck == 0) {


            $sql = "INSERT INTO tb_product (brand_id,type_id,model,frequency,impedance,sentivity,connector
                    ,cableLenght,feature,bluetoothVer,resolution,battery,grossweight,volume,color,
                    store,price)VALUES('$brand_id','$type_id','$model','$frequency','$impedance',
                    '$sentivity','$connector','$cableL','$feature','$bluetoothVer','$resolution','$battery','$grossweight',
                    '$volume','$color','$store','$price')";
            $query = mysqli_query($conn, $sql);

            if ($query) {
                $sql = "SELECT * FROM tb_product WHERE model = '$model'";
                $sql = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($sql);
                $product_id = $row['product_id'];

                $sql2 = "INSERT INTO tb_image_product (product_id,main_image)VALUES ('$product_id','$filename')";
                $sql2 =  mysqli_query($conn, $sql2);
                if ($sql2) {
                    $alert = '<script>';
                    $alert .= ' Swal.fire({
                        title: "เพิ่มสินค้าสำเร็จ!!",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "ยืนยัน",
                        position: "top",
                        timer: 1000
                      }).then(function() {
                          window.location.href="../admin";
                      });';
                    $alert .= '</script>';
                    echo $alert;
                }
            }
        }
    }
} else {
    // echo 'no POST';
}


?>


<div class="container-add mb-3">
    <div class="row">

        <div class="col-7">

            <form action="" id="form_add" method="POST" enctype="multipart/form-data" onsubmit="return validform_add()">
                <fieldset class="border p-2">
                    <legend class="float-none w-auto p-2">
                        <h1>เพิ่มสินค้า</h1>
                    </legend>

                    <div class="form-inline ">
                        <h4 class="mb-0">Brand</h4>
                        <select required class="custom-select col-3 ml-3 mr-2"  name="brand_id">
                            <option value="" selected disabled>เลือกแบรนด์</option>
                            <?php
                            $row = mysqli_num_rows($sql_brand);
                            if ($row > 0) : ?>
                                <?php foreach ($sql_brand as $brand) : ?>
                                    <option value="<?= $brand['id']; ?>"> <?= $brand['name_brand']; ?></option>
                                <?php endforeach ?>
                            <?php else : ?>
                                <option value="none">none</option>
                            <?php endif ?>

                        </select>

                        <h4 class="mb-0">type</h4>
                        <select class="form-control col-3 ml-3 mr-3" required  name="type_id" oninvalid="setCustomValidity('กรุณาเลือกแบรนด์')" oninput="setCustomValidity('')">
                        <option value="" selected disabled>เลือกประเภท</option>
                            <?php foreach ($sql_type as $type) : ?>
                                <option value="<?= $type['id']; ?>"><?= $type['type']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-inline mt-3 ">
                        <h4 class="mb-0">Model</h4>
                        <input type="text" required class="form-control ml-3 " style="width:365px;" name="model" required="required">
                    </div>
                    <div class="form-inline mt-3 ">
                        <h4 class="input-group mb-0">Connector</h4>
                        <div class="form-check form-check-inline ml-5">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="USB" name="connector[]" checked>
                            <label class="form-check-label" for="inlineCheckbox1">USB</label>
                        </div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Wireless" name="connector[] ">
                            <label class="form-check-label" for="inlineCheckbox1">Wireless</label>
                        </div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="AUX3.5" name="connector[]" >
                            <label class="form-check-label" for="inlineCheckbox2">AUX3.5</label>
                        </div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="Bluetooth" name="connector[] ">
                            <label class="form-check-label" for="inlineCheckbox2">Bluetooth</label>
                        </div>


                    </div>
                    <div class="form-inline mt-3 ">
                        <h4 class="mb-0">Frequency</h4>
                        <input type="text" class="form-control ml-3 mr-3" style="width:150px;" name="frequency">
                        <h4 class="mb-0">Impedance</h4>
                        <input type="text" class="form-control ml-3" style="width:170px;" name="impedance">
                    </div>

                    <div class="form-inline mt-3">
                        <h4>sentivity</h4>
                        <input type="text" class="form-control ml-3 mr-3" name="sentivity" style="width:170px;">

                        <h4>BlutoothVersion</h4>
                        <select class="custom-select col-md-2 ml-3" id="inputGroupSelect01" name="bluetoothVer">

                            <option value="none">none</option>
                            <option value="4.2">4.2</option>
                            <option value="5.0">5.0</option>
                            <option value="5.1">5.1</option>

                        </select>
                    </div>
                    <div class="form-inline mt-3 ">
                        <h4 class="mb-0">Resolution</h4>
                        <input type="text" class="form-control ml-3 " style="width:480px;" name="resolution">
                    </div>

                    <h4 class="mb-0">Feature</h4>
                    <textarea class="form-control ml-3" name="feature" id="" rows="4" style="width: 90%;"></textarea>



                    <div class="form-inline mt-3 ">
                        <h4 class="mb-0">Cable Lenght</h4>
                        <input type="text" class="form-control ml-3 mr-3" style="width:120px;" name="cableL">
                        <h4 class="mb-0">Battery</h4>
                        <input type="text" class="form-control ml-3" style="width:210px;" name="battery">
                    </div>

                    <div class="form-inline mt-3">
                        <h4>grossweight</h4>
                        <input type="text" class="form-control ml-3 mr-3" name="grossweight" style="width:130px;">
                        <h4>Volume</h4>
                        <input type="text" class="form-control ml-3" name="volume" style="width:210px;">
                    </div>
                    <div class="form-inline mt-3 ">
                        <h4 class="mb-0">Color</h4>
                        <input type="text" class="form-control ml-3 " style="width:400px;" name="color">
                    </div>
                    <div class="form-inline mt-3">
                        <h4>store</h4>
                        <input type="number" required class="form-control ml-3 mr-3 col-2" name="store">
                        <h4>price</h4>
                        <input type="number" required class="form-control ml-3 col-3" name="price">
                    </div>

                    <div class="container">
                        <div class="Add-artist-popup" id="Add-artist-popup">
                            <h4 class="mt-3">Add main image</h4>

                            <label for="file-img-artist" class="custum-file-upload">
                                <div class="icon">
                                    <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" fill=""></path>
                                        </g>
                                    </svg>
                                </div>
                                <div class="text">
                                    <span>Click to upload image</span>
                                </div>

                            </label>

                            <input id="file-img-artist" class="form-control col-6" type="file" accept="image/*" name="main_img" required />

                        </div>
                    </div>

                    <div class="card-btn mt-3 text-center">
                        <button class="btn btn-warning col-4" onclick="window.history.back()">ย้อนกลับ</button>
                        <button type="submit" class="btn btn-success col-4">เพิ่มสินค้า</button>
                        <!-- <a href="../admin/">home</a> -->
                    </div>


                </fieldset>
            </form>
        </div>


        <div class="col-4">
            <form action="" method="POST" id="form_add_brand" onsubmit="return valid_form_add_brand()">
                <fieldset class="border p-2">
                    <legend class="float-none w-auto p-2">
                        <h1>เพิ่มชื่อแบรนด์</h1>
                    </legend>
                    <input type="text" class="form-control col-12 mb-2" placeholder="brandname" name="brand" required>
                    <button type="submit" class="btn btn-success col-6">เพิ่ม</button>
                </fieldset>
            </form>
            <form action="" method="POST" id="form_add_type" onsubmit="return valid_form_add_type()">
                <fieldset class="border p-2 mt-3">
                    <legend class="float-none w-auto p-2">
                        <h1>เพิ่มประเภทสินค้า</h1>
                    </legend>
                    <input type="text" class="form-control col-12 mb-2" placeholder="type" name="type" required>
                    <button type="submit" class="btn btn-success col-6">เพิ่ม</button>
                </fieldset>
            </form>
        </div>
    </div>


</div>