<?php
include("./connect.php");
$sql_product = "SELECT tb_product.product_id, tb_product.model, tb_product.store, tb_product.price,tb_image_product.main_image,
    tb_brand.name_brand,tb_type_product.type
    FROM tb_product 
    INNER JOIN tb_image_product ON tb_product.product_id = tb_image_product.product_id
    INNER JOIN tb_type_product ON tb_product.type_id = tb_type_product.id
    INNER JOIN tb_brand ON tb_product.brand_id = tb_brand.id";
    $result_product = $conn->query($sql_product);
$data =  $result_product->fetch_assoc();

// print_r($result_product->num_rows);


if ($result_product->num_rows > 0) {
    $product_fetch = array();
    $i = 1;
    
    $result_product->data_seek(0); // นำ pointer ไปที่แถวแรก
    
    while ($row = $result_product->fetch_assoc()) {
        $product_fetch[] = array(
          'product_id' => $row['product_id'],
          'model' => $row['model'],
          'image' => $row['main_image'],
          'name_brand' => $row['name_brand'],
          'type' => $row['type'],
          'price' => $row['price'],
          'store' => $row['store'],
          'amount' => 0,
        );
    }
} else {
    echo "0 results";
}


?>
<script>
    var productData = <?php echo json_encode($product_fetch); ?>;
    // console.log(productData);
</script>