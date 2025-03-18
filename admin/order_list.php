<?php
$order_qr = "SELECT * FROM order_list";
$order_qr = $conn->query($order_qr);
$i = 1;

// foreach(){
//     echo '<pre>';
//     print_r($row);
//     echo '</pre>';
// }


?>
<div class="container">
  <div class="title">
    <h1 class="display-4">
      รายการคำสั่งซื้อ
    </h1>
  </div>
  <hr>
  <table class="table table-striped" id="table_brand">
    <thead>
      <tr class="text-center">
        <th scope="col" class="h6 col-1">รายการ</th>
        <th scope="col" class="h6 col-1">รหัสคำสั่งซื้อ</th>
        <th scope="col" class="h6 col-1">username</th>
        <th scope="col" class="h6 col-1">ชื่อผู้สั่ง</th>
        <th scope="col" class="h6 col-1">วันที่สั่ง</th>
        <th scope="col" class="h6 col-1">จำนวนสินค้า</th>
        <th scope="col" class="h6 col-1">ราคา</th>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($order_qr as $row) : ?>
        <tr class="text-center">
          <td class="h6 col-1"><?= $i ?></td>
          <td class="col-1"><?= $row['order_id'] ?></td>
          <td class="col-1"><?= $row['username'] ?></td>
          <td class="col-1"><?= $row['order_name'] ?></td>
          <td class="col-1"><?= $row['order_Date'] ?></td>
          <td class="h6 col-1">
            <div class="td-amount">
              <p><?= number_format($row['sum_amount']) ?> ชิ้น</p>
              <button class="view_order_product" index="<?= $row['order_id'] ?>">ดู</button>
            </div>
          </td>
          <td class="h6 col-1"><?= number_format($row['sum_price']) ?> บาท</td>

        </tr>
        <?php $i++ ?>

        <div class="box-order-product" index="<?= $row['order_id'] ?>">
          <div class="thead">
            <button class="close_amount_order"><i class="fa-solid fa-rectangle-xmark"></i></button>
            <div class="col1">
              รายการสินค้า
            </div>
            <div class="col2">
              จำนวนสินค้า
            </div>
            <div class="col2">
              ราคาสินค้า/ชิ้น
            </div>
          </div>

          <?php
          $order_id = $row['order_id'];
          $sql_amount_order = "SELECT order_id,tb_product.product_id,concat(type,' ',name_brand,' ',model) as name,tb_order_product.amount,tb_product.price
                FROM tb_order_product,tb_product,tb_brand,tb_type_product
                WHERE tb_order_product.product_id = tb_product.product_id
                and tb_brand.id = tb_product.brand_id
                and tb_type_product.id = tb_product.type_id
                and order_id = '$order_id'";
          $sql_amount_order = $conn->query($sql_amount_order);
          ?>
          <?php foreach ($sql_amount_order as $data) : ?>
            <div class="tbody">
              <div class="col1">
                <?= $data['name']?>
              </div>
              <div class="col2">
                <?= $data['amount'] ?> ชิ้น
              </div>
              <div class="col2">
                <?= number_format($data['price']) ?> บาท
              </div>
            </div>
          <?php endforeach; ?>

        </div>
      <?php endforeach ?>
    </tbody>


  </table>

</div>