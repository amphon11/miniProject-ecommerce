<?php
$sql = "SELECT * FROM tb_brand";
$query = mysqli_query($conn, $sql);
$num_row = mysqli_num_rows($query);

if (isset($_POST) && isset($_POST['submit_edit_brand'])) {
  $edit_id = $_POST['edit_id'];
  $brand_new = $_POST['brand_new'];

  $update_brand = "UPDATE tb_brand SET name_brand = '$brand_new' WHERE id='$edit_id'";
  $update_brand = $conn->query($update_brand);
  if($update_brand){
    echo '<script>
    Swal.fire({
      title: "แก้ไขแบรนด์สำเร็จ!!",
      icon: "success",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "top",
      timer: 1000
    }).then(function() {
        window.location.href="";
    });
</script>';

  }
}
if(isset($_GET) && (isset($_GET['brand_id']))){
  $brand_id =  $_GET['brand_id'];
  $delete_brand = "DELETE FROM tb_brand WHERE id = '$brand_id'";
  $delete_brand = $conn->query($delete_brand);
  if($delete_brand){
    echo '<script>
    Swal.fire({
      title: "ลบแบรนด์สำเร็จ!!",
      icon: "success",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "top",
      timer: 1000
    }).then(function() {
        window.location.href="?page=brand";
    });
</script>';
  }

}


?>

<div class="conteiner">
  <h1 class="display-4">แบรนด์สินค้า</h1>
  <hr>
  <div class="d-flex justify-content-between">
    <p class="mb-0">ทั้งหมด &nbsp<?= $num_row ?>&nbsp รายการ</p>
    <a class="btn btn-success" type="button" href="?page=add_product">เพิ่มแบรนด์</a>
  </div>
  <hr>
  <table class="table table-striped" id="table_brand">
    <thead>
      <tr class="text-center">
        <th scope="col" class="h6">รหัสแบรนด์</th>
        <th scope="col" class="h6">ชื่อแบรนด์</th>
        <th scope="col" class="h6">จำนวนรายการสินค้า</th>
        <th scope="col" class="h6">สต๊อกสินค้า</th>
        <th scope="col" class="h6">แก้ไข/ลบ</th>

      </tr>
    </thead>
    <tbody>
      <?php foreach ($query as $row) : ?>
        <tr class="text-center">
          <th class="align-middle" scope="row"><?= $row['id'] ?></th>
          <td class="align-middle"><?= $row['name_brand'] ?></td>
          <?php
          $bran_id = $row['id'];
          $sql = "SELECT store FROM tb_product WHERE brand_id ='$bran_id'";
          $query = mysqli_query($conn, $sql);
          $store = 0;
          $sum = 0;
          foreach ($query as $num) {
            $store += $num['store'];
            $sum++;
          }
          ?>
          <td class="align-middle"><?= $sum ?> รายการ</td>
          <td class="align-middle"><?= $store ?> ชิ้น</td>
          <td class="align-middle">
            <a href="#" class="btn btn-md btn-warning btn_edit_brand" id="<?= $bran_id ?>" onclick="showForm(<?= $bran_id ?>)"><i class="fa-regular fa-pen-to-square"></i></a>
            <button onclick="confirm_delete('ต้องการลบแบรนด์ : <?=$row['name_brand']?> หรือไม่','brand','brand_id',<?=$bran_id?>);" type="button" class="btn btn-md btn-danger <?= $store > 0 ? 'disabled' : '' ?>"><i class="fa-solid fa-trash-can"></i></button>
          </td>
        </tr>
        <div class="box-edit-brand" id="box_edit<?= $bran_id ?>">
          <form action="" method="POST" class="from1" onsubmit="return validform1(<?= $bran_id ?>)">
            <a href="#" id="closeID<?= $bran_id ?>" class="btn_close"><i class="fa-solid fa-circle-xmark"></i></a>
            <h2>แก้ไข <?= $row['name_brand'] ?></h2>
            <input type="hidden" name="edit_id" value="<?= $bran_id ?>">
            <input type="text" class="form-control mb-2" value="<?= $row['name_brand'] ?>" name="brand_new">
            <input type="hidden" value="<?= $row['name_brand'] ?>" name="brand_old">
            <button class="btn btn-success" name="submit_edit_brand">บันทึก</button>
          </form>
        </div>
      <?php endforeach ?>

    </tbody>
  </table>
</div>