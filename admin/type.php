<?php
$sql = "SELECT * FROM tb_type_product";
$query = mysqli_query($conn, $sql);
$num_row = mysqli_num_rows($query);

if (isset($_POST) && isset($_POST['submit_edit_type'])) {
  $type_id = $_POST['type_id'];
  $type_new = $_POST['type_new'];

  $update_type = "UPDATE tb_type_product SET type = '$type_new' WHERE id='$type_id'";
  $update_type = $conn->query($update_type);
  if($update_type){
    echo '<script>
    Swal.fire({
      title: "แก้ไขประเภทสำเร็จ!!",
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
if(isset($_GET) && (isset($_GET['type_id']))){
  $type_id =  $_GET['type_id'];
  $delete_type = "DELETE FROM tb_type_product WHERE id = '$type_id'";
  $delete_type = $conn->query($delete_type);
  if($delete_type){
    echo '<script>
    Swal.fire({
      title: "ลบประเภทสำเร็จ!!",
      icon: "success",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "ยืนยัน",
      position: "top",
      timer: 1000
    }).then(function() {
        window.location.href="?page=type";
    });
</script>';
  }

}


?>

<div class="conteiner">
  <h1 class="display-4">ประเภทสินค้า</h1>
  <hr>
  <div class="d-flex justify-content-between">
    <p class="mb-0">ทั้งหมด &nbsp<?= $num_row ?>&nbsp รายการ</p>
    <a class="btn btn-success" type="button" href="?page=add_product">เพิ่มประเภท</a>
  </div>
  <hr>
  <table class="table table-striped" id="table_type" >
    <thead>
      <tr class="text-center">
        <th scope="col" class="h6 col-2">รหัสประเภทสินค้า</th>
        <th scope="col" class="h6 col-4">ชื่อประเภท</th>
        <th scope="col" class="h6">จำนวนรายการสินค้า</th>
        <th scope="col" class="h6">สต๊อกสินค้า</th>
        <th scope="col" class="h6">แก้ไข/ลบ</th>

      </tr>
    </thead>
    <tbody>
      <?php foreach ($query as $row) : ?>

        <tr class="text-center">
          <th class="align-middle" scope="row"><?= $row['id'] ?></th>
          <td class="align-middle"><?= $row['type'] ?></td>
          <?php
          $type_id = $row['id'];
          $sql = "SELECT * FROM tb_product WHERE type_id ='$type_id'";
          $query = mysqli_query($conn, $sql);
          $store = 0;
          $sum =0;
          foreach ($query as $num) {
            $store += $num['store'];
            $sum++;
          }

          ?>
          <td class="align-middle"><?= $sum ?> รายการ</td>
          <td class="align-middle"><?= $store ?> ชิ้น</td>
          <td class="align-middle">
            <button class="btn btn-md btn-warning" onclick="showFormType(<?= $type_id ?>)"><i class="fa-regular fa-pen-to-square"></i></button>
            <button onclick="confirm_delete('ต้องการลบประเภท : <?=$row['type']?> หรือไม่','type','type_id',<?=$type_id?>);" type="button" class="btn btn-md btn-danger <?= $store > 0 ? 'disabled' : '' ?>"><i class="fa-solid fa-trash-can"></i></button>
          </td>
        </tr>
        <div class="box-edit-type" id="box_edit_typeID<?= $type_id ?>">
          <form action="" method="POST" class="from1" onsubmit="return validform2(<?= $type_id ?>)">
            <a href="#" id="closeID<?= $type_id ?>" class="btn_close"><i class="fa-solid fa-circle-xmark"></i></a>
            <h2>แก้ไข <?= $row['type'] ?></h2>
            <input type="hidden" name="type_id" value="<?= $type_id ?>">
            <input type="text" class="form-control mb-2" value="<?= $row['type'] ?>" name="type_new">
            <input type="hidden" value="<?= $row['type'] ?>" name="type_old">
            <button class="btn btn-success" name="submit_edit_type">บันทึก</button>
          </form>
        </div>
      <?php endforeach ?>

    </tbody>
  </table>
</div>