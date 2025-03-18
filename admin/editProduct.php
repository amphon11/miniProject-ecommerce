<?php
$sql = "SELECT * FROM tb_product";
$sql = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($sql);

$sql_brand = "SELECT * FROM tb_brand";
$sql_brand = mysqli_query($conn, $sql_brand);

$sql_type = "SELECT * FROM tb_type_product";
$sql_type = mysqli_query($conn, $sql_type);

if (isset($_GET['product_id']) and !empty($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    //get data from tb_product
    $sql = "SELECT *,tb_image_product.main_image FROM tb_product 
            INNER JOIN tb_image_product ON tb_product.product_id = tb_image_product.product_id 
            WHERE tb_product.product_id = '$product_id'";
    $query = mysqli_query($conn, $sql);
    $tuple = mysqli_fetch_assoc($query);
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

    $brand_id = $_POST['brand_id'];
    $type_id = $_POST['type_id'];
    $model = $_POST['model'];
    $connector = "";
    $battery =  $_POST['battery'];
    $frequency = $_POST['frequency'];
    $impedance = $_POST['impedance'];
    $sentivity = $_POST['sentivity'];
    $bluetoothVer = $_POST['bluetoothVer'];
    $resolution = $_POST['resolution'];
    $feature = $_POST['feature'];
    $cableL = $_POST['cableL'];
    $battery = $_POST['battery'];
    $grossweight = $_POST['grossweight'];
    $volume = $_POST['volume'];
    $color = $_POST['color'];
    $store = $_POST['store'];
    $price = $_POST['price'];

    $old_main_img = $_POST['old_main_img'];


    foreach ($_POST['connector'] as $key => $value) {
        $connector = $connector . " " . $value;
    }

    // echo "<pre>";
    // print_r($_POST);
    // print_r($_FILES);
    // echo "</pre>";

    // เพิ่มรูปลงไฟล์
    $ck = 0;
    if (isset($_FILES["main_img"]["name"]) && !empty($_FILES["main_img"]["name"])) {
        $dir = "../img/main_img/";
        $filename = basename($_FILES["main_img"]["name"]);
        $file_path = $dir . $filename;

        // Clear stat cache
        clearstatcache(true, $file_path);

        // Check if the file exists
        if (file_exists($file_path)) {
            // Attempt to unlink the file
            if (unlink($file_path)) {
                // echo 'File deleted successfully.';

                move_uploaded_file($_FILES["main_img"]["tmp_name"], $file_path);
                echo 'upload success';
                $sql2 = "UPDATE tb_image_product SET main_image = '$filename' WHERE product_id = '$product_id'";
                $sql2 =  mysqli_query($conn, $sql2);
            } else {
                $error = error_get_last();
                echo 'Unable to delete the file. Error: ' . $error['message'];
            }
        } else {
            move_uploaded_file($_FILES["main_img"]["tmp_name"], $file_path);
            echo 'upload success';
            $sql2 = "UPDATE tb_image_product SET main_image = '$filename' WHERE product_id = '$product_id'";
            $sql2 =  mysqli_query($conn, $sql2);
        }
    } else {
        $filename = $old_main_img;
        // echo 'ไม่เปลี่ยนรูป';
    }
    $model_q = "SELECT model FROM tb_product WHERE model = '$model'";
    $model_q = $conn->query($model_q);
    $num_model = $model_q->num_rows;



    $sql = "UPDATE tb_product SET brand_id='$brand_id',type_id='$type_id',model='$model',frequency='$frequency',
        impedance='$impedance',sentivity='$sentivity',connector='$connector',cableLenght='$cableL',feature='$feature',
        bluetoothVer='$bluetoothVer',battery='$battery',grossweight='$grossweight',volume='$volume',color='$color',
        store='$store',price='$price' WHERE product_id = '$product_id'";
    $query = mysqli_query($conn, $sql);
    if ($query) {

        $alert = '<script>';
        $alert .= ' Swal.fire({
                        title: "บันทึกข้อมูลสำเร็จ!!",
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
} else {
    // echo 'no POST';
}


?>


<div class="container mb-3">
    <div class="row">

        <div class="col-7">

            <form action="" id="form_edit" method="POST" enctype="multipart/form-data" onsubmit="return validform_edit();">
                <fieldset class="border p-2">
                    <legend class="float-none w-auto p-2">
                        <h1>เพิ่มสินค้า</h1>
                    </legend>

                    <div class="form-inline ">
                        <h4 class="mb-0">Brand</h4>
                        <select class="custom-select col-2 ml-3 mr-3" id="inputGroupSelect01" name="brand_id">
                            <?php
                            $row = mysqli_num_rows($sql_brand);
                            if ($row > 0) : ?>
                                <?php foreach ($sql_brand as $brand) : ?>
                                    <option value="<?= $brand['id'] ?>" <?= $brand['id'] == $tuple['brand_id'] ? "selected" : "" ?>>
                                        <p><?= $brand['name_brand'] ?></p>
                                    </option>
                                <?php endforeach ?>
                            <?php else : ?>
                                <option value="None">None</option>
                            <?php endif ?>

                        </select>

                        <h4 class="mb-0">type</h4>
                        <select class="custom-select col-3 ml-3 mr-3" id="inputGroupSelect01" name="type_id">
                            <?php foreach ($sql_type as $type) : ?>
                                <option value="<?= $type['id']; ?>" <?= $type['id'] == $tuple['type_id'] ? "selected" : "" ?>>
                                    <?= $type['type']; ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-inline mt-3 ">
                        <h4 class="mb-0">Model</h4>
                        <input type="text" value="<?= $tuple['model'] ?>" required class="form-control ml-3 " style="width:365px;" name="model">
                    </div>
                    <div class="form-inline mt-3 ">
                        <?php
                        $text =  $tuple['connector'];
                        $connect =  explode(" ", $text);
                        ?>
                        <h4 class="input-group mb-0">Connector</h4>
                        <div class="form-check form-check-inline ml-5">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="USB" <?php if (in_array("USB", $connect)) {
                                                                                                                    echo "checked";
                                                                                                                } ?> checked name="connector[]">
                            <label class="form-check-label" for="inlineCheckbox1">USB</label>
                        </div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Wireless" <?php if (in_array("USB3.0", $connect)) {
                                                                                                                    echo "checked";
                                                                                                                } ?> name="connector[]">
                            <label class="form-check-label" for="inlineCheckbox1">Wireless</label>
                        </div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="AUX3.5" <?php if (in_array("AUX3.5", $connect)) {
                                                                                                                    echo "checked";
                                                                                                                } ?> name="connector[]">
                            <label class="form-check-label" for="inlineCheckbox2">AUX3.5</label>
                        </div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="Bluetooth" <?php if (in_array("Bluetooth", $connect)) {
                                                                                                                        echo "checked";
                                                                                                                    } ?> name="connector[] ">
                            <label class="form-check-label" for="inlineCheckbox2">Bluetooth</label>
                        </div>


                    </div>
                    <div class="form-inline mt-3 ">
                        <h4 class="mb-0">Frequency</h4>
                        <input type="text" value="<?= $tuple['frequency'] ?>" class="form-control ml-3 mr-3" style="width:150px;" name="frequency">
                        <h4 class="mb-0">Impedance</h4>
                        <input type="text" value="<?= $tuple['impedance'] ?>" class="form-control ml-3" style="width:170px;" name="impedance">
                    </div>

                    <div class="form-inline mt-3">
                        <h4>sentivity</h4>
                        <input type="text" value="<?= $tuple['sentivity'] ?>" class="form-control ml-3 mr-3" name="sentivity" style="width:170px;">

                        <h4>BlutoothVersion</h4>
                        <select class="custom-select col-md-2 ml-3" id="inputGroupSelect01" name="bluetoothVer">

                            <option value="none" <?= "none" == $tuple['bluetoothVer'] ? "selected" : "" ?>>none</option>
                            <option value="4.2" <?= "4.2" == $tuple['bluetoothVer'] ? "selected" : "" ?>>4.2</option>
                            <option value="5.0" <?= "5.0" == $tuple['bluetoothVer'] ? "selected" : "" ?>>5.0</option>
                            <option value="5.1" <?= "5.1" == $tuple['bluetoothVer'] ? "selected" : "" ?>>5.1</option>

                        </select>
                    </div>
                    <div class="form-inline mt-3 ">
                        <h4 class="mb-0">Resolution</h4>
                        <input type="text" value="<?= $tuple['resolution'] ?>" class="form-control ml-3 " style="width:480px;" name="resolution">
                    </div>

                    <h4 class="mb-0">Feature</h4>
                    <textarea class="form-control ml-3" name="feature" id="" rows="4" style="width: 600px;"><?= $tuple['feature'] ?></textarea>



                    <div class="form-inline mt-3 ">
                        <h4 class="mb-0">Cable Lenght</h4>
                        <input type="text" value="<?= $tuple['cableLenght'] ?>" class="form-control ml-3 mr-3" style="width:120px;" name="cableL">
                        <h4 class="mb-0">Battery</h4>
                        <input type="text" value="<?= $tuple['battery'] ?>" class="form-control ml-3" style="width:210px;" name="battery">
                    </div>

                    <div class="form-inline mt-3">
                        <h4>grossweight</h4>
                        <input type="text" value="<?= $tuple['grossweight'] ?>" class="form-control ml-3 mr-3" name="grossweight" style="width:130px;">
                        <h4>Volume</h4>
                        <input type="text" value="<?= $tuple['volume'] ?>" class="form-control ml-3" name="volume" style="width:210px;">
                    </div>
                    <div class="form-inline mt-3 ">
                        <h4 class="mb-0">Color</h4>
                        <input type="text" value="<?= $tuple['color'] ?>" class="form-control ml-3 " style="width:400px;" name="color">
                    </div>
                    <div class="form-inline mt-3">
                        <h4>store</h4>
                        <input type="number" value="<?= $tuple['store'] ?>" required class="form-control ml-3 mr-3 col-2" name="store">
                        <h4>price</h4>
                        <input type="number" value="<?= $tuple['price'] ?>" required class="form-control ml-3 col-3" name="price">
                    </div>

                    <div class="card-img card p-2 mt-3 text-center">
                        <h4>เลือกรูปภาพ
                            <h4 />
                            <img id="image-preview" src="../img/main_img/<?= $tuple['main_image'] ?>" style="width:250px;height:220px; border:solid 1px;" class="rounded-2" alt="placeholder">
                            <input type="file" name="main_img" class="form-control mt-2" accept="image/*" onchange="updatePreview(this, 'image-preview')">
                            <input type="hidden" name="old_main_img" value="<?= $tuple['main_image'] ?>">
                    </div>

                    <div class="card-btn mt-3 text-center">
                        <a class="btn btn-warning col-4" href="../admin/">ย้อนกลับ</a>
                        <button type="submit" class="btn btn-primary col-4">บันทึก</button>
                        <!-- <a href="../admin/">home</a> -->
                    </div>


                </fieldset>
            </form>
        </div>


        <div class="col-4">
            <form action="" method="POST">
                <fieldset class="border p-2">
                    <legend class="float-none w-auto p-2">
                        <h1>เพิ่มชื่อแบรนด์</h1>
                    </legend>
                    <input type="text" class="form-control col-12 mb-2" placeholder="brandname" name="brand" required>
                    <button type="submit" class="btn btn-success col-6">เพิ่ม</button>
                </fieldset>
            </form>
            <form action="" method="POST">
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