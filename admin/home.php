<?php
$sql = $sql =   "SELECT *, tb_type_product.type, tb_brand.name_brand
                FROM tb_product
                INNER JOIN tb_type_product ON tb_product.type_id = tb_type_product.id
                INNER JOIN tb_brand ON tb_product.brand_id = tb_brand.id
                INNER JOIN tb_image_product ON tb_product.product_id = tb_image_product.product_id
                ";

$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows($query);

if(isset($_GET) && isset($_GET['product_id'])){
    $product_id =  $_GET['product_id'];
    $del_product = "DELETE FROM tb_product WHERE product_id='$product_id'";
    $del_img = "DELETE FROM tb_image_product WHERE product_id='$product_id'";

    $main_img = "SELECT main_image FROM tb_image_product WHERE product_id='$product_id'";
    $main_img = $conn->query($main_img);
    $result_img = $main_img->fetch_assoc();
    $filename = $result_img['main_image'];
    $dir = "../img/main_img/";
    $file_path = $dir . $filename;
    clearstatcache(true, $file_path);
    if (unlink($file_path)) {
        // echo 'delete from file success';
    }
    if($conn->query($del_product) && $conn->query($del_img)){
        $alert = '<script>';
        $alert .= ' Swal.fire({
            title: "ลบสินค้าสำเร็จ!!",
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

?>
<div class="container-home">
    <h1 class="display-4">รายการสินค้า</h1>
    <hr>
    <div class="d-flex justify-content-end">
        <a class="btn btn-success" type="button" href="?page=add_product">เพิ่มสินค้า</a>
    </div>
    <hr>
    <div class="container" style="min-height:600px;">

        <table class="table table-striped" id="myTable" class="display" style="width: 100%; border:1px solid #ddd">
            <thead>
                <tr class="text-center">
                    <th scope="col" class="h6 col-1">รหัสสินค้า</th>
                    <th scope="col" class="h6 col-2">รูปภาพ</th>
                    <th scope="col" class="h6 col-1">แบรนด์</th>
                    <th scope="col" class="h6 col-1">ประเภท</th>
                    <th scope="col" class="h6 col-2">model</th>
                    <th scope="col" class="h6 col-1">คลัง</th>
                    <th scope="col" class="h6 col-1">ราคา</th>
                    <th scope="col" class="h6 col-2">เมนู</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($query as $row) : ?>
                    <tr scope="row" class="text-center">
                        <?php 
                        $product_id = $row['product_id'];
                        $sql_order_product = "SELECT product_id FROM tb_order_product WHERE product_id = '$product_id'";
                        $sql_order_product = $conn->query($sql_order_product);
                        $num_fk_order = $sql_order_product->num_rows;
                        ?>
                        <th scope="col" class="align-middle"><?= $row['product_id'] ?></th>
                        <th scope="col" class="align-middle">
                            <img src="../img/main_img/<?= $row['main_image'] ?>" class="img-thumbnail" alt="" style="width:120px;">
                        </th>
                        <td scope="col" class="align-middle"><?= $row['name_brand'] ?></td>
                        <td scope="col" class="align-middle"><?= $row['type'] ?></td>
                        <td scope="col" class="align-middle"><?= $row['model'] ?></td>
                        <td scope="col" class="align-middle"><?= $row['store'] ?> ชิ้น</td>
                        <td scope="col" class="align-middle"><?= $row['price'] ?></td>
                        <td scope="col" class="align-middle">
                            <div class="row-btn">
                                <div class="btn-edit">
                                    <div class="tool-tip">
                                        แก้ไข
                                    </div>
                                    <a href="?function=edit&product_id=<?= $row['product_id'] ?>" class="btn btn-md btn-warning"><i class="fa-regular fa-pen-to-square"></i></a>
                                </div>
                                <div class="btn-remove">
                                    <div class="tool-tip">
                                        ลบ
                                    </div>
                                    <button onclick="confirm_delete_product('ต้องการลบสินค้า : <?=$row['model']?> หรือไม่',<?=$row['product_id']?>);" type="button" class="btn btn-md btn-danger <?=$num_fk_order>0 ? 'disabled':''?>"><i class="fa-solid fa-trash-can"></i></button>
                                </div>
                                <div class="btn-add-img">
                                    <div class="tool-tip">
                                        เพิ่มรูปภาพรายละเอียด
                                    </div>
                                    <a href="?function=add_preview&product_id=<?= $row['product_id'] ?>" class="btn btn-md btn-primary"><i class="fa-regular fa-image"></i></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>
</div>