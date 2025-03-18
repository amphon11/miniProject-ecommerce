<?php
if (isset($_GET)) {
  $product_id = $_GET['product_id'];
  $sql = "SELECT model FROM tb_product WHERE product_id = '$product_id'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // ตรวจสอบว่ามีไฟล์ถูกอัปโหลดหรือไม่
  $image_name = array();
  $state = true;
  if (isset($_FILES['image_preview'])) {
    // ตรวจสอบว่ามีข้อผิดพลาดที่เกิดขึ้นระหว่างการอัปโหลด
    if ($_FILES['image_preview']['error'][0] === UPLOAD_ERR_OK) {
      $uploadDir = "../img/preview_img/"; // ตำแหน่งที่คุณต้องการบันทึกไฟล์

      // อัปโหลดไฟล์ทุกไฟล์ที่ถูกเลือก
      foreach ($_FILES['image_preview']['tmp_name'] as $index => $tmpName) {
        $fileName = $_FILES['image_preview']['name'][$index];
        array_push($image_name, $fileName);
        $targetPath = $uploadDir . $fileName;

        // ย้ายไฟล์ไปยังตำแหน่งที่คุณต้องการบันทึก
        if (move_uploaded_file($tmpName, $targetPath)) {
          // echo "ไฟล์ $fileName ถูกบันทึกแล้ว.";
        } else {
          echo "มีข้อผิดพลาดในการบันทึกไฟล์ $fileName.";
          $state = false;
        }
      }
    } else {
      echo "มีข้อผิดพลาดในการอัปโหลดไฟล์.";
    }

    if ($state) {
      $sql = "UPDATE tb_image_product 
        SET preview_image1 = '$image_name[0]', 
            preview_image2 = '$image_name[1]', 
            preview_image3 = '$image_name[2]'
        WHERE product_id = '$product_id'";
      $result = $conn->query($sql);
      echo "<script>
      Swal.fire({
        title: 'เพิ่มรูปภาพสำเร็จ!!',
        icon: 'success',
        confirmButtonText: 'ตกลง',
        showConfirmButton: false, // ไม่แสดงปุ่มตกลง
        timer: 1000, // กำหนดเวลาในการแสดงเป็นมิลลิวินาที
      }).then(() => {
        window.location.href = './index.php'; // กำหนด URL หรือ path ไปยังหน้าถัดไป
      });
      </script>";


    }
  }
}



?>
<div class="container">
  <h1 class="text-center">เพิ่มรูปภาพ รายละเอียด <?= $row['model'] ?></h1>
  
  <?php
  $exits_img = "SELECT * FROM tb_image_product WHERE product_id = '$product_id' AND preview_image1 IS NOT NULL";
  $exits_img = $conn->query($exits_img);
  $num_exits = $exits_img->num_rows;
  $exits_img_fetch = $exits_img->fetch_assoc();
  ?>
  <?php if($num_exits>0):?>
  <div class="show-exits-image">
    <h2>รูปภาพเดิม</h2>
    <div class="box-image">
      <img src="../img/preview_img/<?=$exits_img_fetch["preview_image1"]?>" alt="">
      <img src="../img/preview_img/<?=$exits_img_fetch["preview_image2"]?>" alt="">
      <img src="../img/preview_img/<?=$exits_img_fetch["preview_image3"]?>" alt="">
    </div>
    <h2>แก้ไข</h2>
  </div>
  <?php endif; ?>
  <form action="" method="POST" enctype="multipart/form-data" onsubmit="return valid_prview()">
    <div class="box-preview-image">
      <div class="card-image">
        <div class="title">
          <p>รูปภาพ 1</p>
        </div>
        <div class="image-show">
          <label for="image_select1" class="label1"> Click เลือกไฟล์..</label>
        </div>
        <input type="file" name="image_preview[]" id="image_select1" class="img_select">
        <div class="image-name">
          <label for="image_select1" class="image-select">เลือกไฟล์</label>
          <p class="tag_name"></p>
        </div>

      </div>
      <div class="card-image">
        <div class="title">
          <p>รูปภาพ 2</p>
        </div>
        <div class="image-show">
          <label for="image_select2" class="label1"> Click เลือกไฟล์..</label>
        </div>
        <input type="file" name="image_preview[]" id="image_select2" class="img_select">
        <div class="image-name">
          <label for="image_select2" class="image-select">เลือกไฟล์</label>
          <p class="tag_name"></p>
        </div>

      </div>
      <div class="card-image">
        <div class="title">
          <p>รูปภาพ 3</p>
        </div>
        <div class="image-show">
          <label for="image_select3" class="label1"> Click เลือกไฟล์..</label>
        </div>
        <input type="file" name="image_preview[]" id="image_select3" class="img_select">
        <div class="image-name">
          <label for="image_select3" class="image-select">เลือกไฟล์</label>
          <p class="tag_name"></p>
        </div>

      </div>
    </div>
    <div class="box-menu d-flex justify-content-center gap-3">
      <button type="submit" class="btn btn-success btn-lg">บันทึก</button>
      <a type="button" class="btn btn-outline-warning btn-lg" href="../admin/">ย้อนกลับ</a>
    </div>
  </form>
</div>

<script>
  function valid_prview() {
    // Validate each file input
    const fileInputs = document.querySelectorAll('.img_select');
    let isValid = true;
    let check_full = true;
    let check_duplicate = true;


    fileInputs.forEach((fileInput, index) => {
      const fileName = fileInput.value.split('\\').pop(); // Get the filename
      const tagElement = document.querySelectorAll('.tag_name')[index];

      if (fileName.trim() === '') {
        isValid = false;
        check_full = false;
        // return false; // ป้องกันการ submit หากไม่ผ่านเงื่อนไข
      } else {
        // Display the filename
        tagElement.innerText = `${fileName}`;
      }
    });
    if (check_full) {
      if (fileInputs[0].value === fileInputs[1].value || fileInputs[1].value === fileInputs[2].value ||
        fileInputs[0].value === fileInputs[2].value) {
        check_duplicate = false;
        isValid = false;
      }
    }

    // Additional validation logic can be added here

    if (isValid) {

      return true;

      // If the form is valid, you can submit the form
    } else {

      if (!check_full) {

        Swal.fire({
          title: "เกิดข้อผิดพลาด!!",
          text: "กรุณาเพิ่มรูปภาพให้ครบ 3 รูป",
          icon: "error",
          confirmButtonText: "ตกลง"
        });
      } else if (!check_duplicate) {
        Swal.fire({
          title: "เกิดข้อผิดพลาด!!",
          text: "มีรูปภาพซ้ำ กรุณาเลือกใหม่",
          icon: "error",
          confirmButtonText: "ตกลง"
        });
      }
      return false;

    }
  }
</script>