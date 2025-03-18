<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (!empty($_SESSION)) {

  $ss_username = $_SESSION['username'];
  $ss_status = $_SESSION['status'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
  //head link
  include('./include/head.php');
  ?>
  <script src="https://kit.fontawesome.com/eb9b16e6b0.js" crossorigin="anonymous"></script>
  <title>Cart</title>
</head>

<body>

  <!---< navbar >------------>
  <?php
  include('./include/navbar.php');
  ?>
  <!--- </ navbar > ------------>
  <div class="content">
    <?php
    require_once('./connect.php');
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

    <div class="block-cart">
      <div class="container">
        <div class="btn-prev" style="margin-bottom: 20px;">
          <a href="../mini_Data/"><i class="fa-solid fa-chevron-left"></i> ย้อนกลับ</a>
        </div>
        <h2>ตะกร้าสินค้า</h2>
        <form action="./order/confirm_order.php" name="cart_Form" method="POST" onsubmit="return validateForm()">
          <div class="wrap">
            <div class="box-cart">

              <div class="menu">
                <p><input type="checkbox" id="check_all"> <label for="check_all">เลือกรายการสินค้าทั้งหมด</label></p>
                <p id="delect_select">ลบรายการที่เลือก</p>
              </div>

              <div class="border-items" id="items-list">
                <!-- items -->
                <!-- loop cart here[] -->
                <!-- /items -->

              </div>
              <h2 class="none-item"></h2>
            </div>
            <div class="box-order">
              <h2>สรุปการสั่งซื้อ</h2>
              <div class="box">
                <p><span>ราคา</span><span id="orderPrice"></span></p>
                <hr>
                <h3><span>ยอดสุทธิ</span><span id="orderPrice2"></h3>
                <p>(ราคานี้รวมภาษีมูลค่าเพิ่มแล้ว)</p>
                <?php if (empty($_SESSION)) : ?>
                  <a class="login" href="./Login/Form_Login.php">เข้าสู่ระบบ</a>
                <?php else : ?>
                  <button type="submit">ดำเนินการต่อ</button>
                <?php endif ?>
                <!-- <a class="shop">เลือกสินค้าต่อ</a> -->
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

  </div>
  <script>
    var cart_store = <?php echo json_encode($cart); ?>;
  </script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="./script/dropdownCart.js"></script>
  <script src="./script/cart.js"></script>
</body>

</html>