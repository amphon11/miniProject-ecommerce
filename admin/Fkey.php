<?php
include('../connect.php');

$sql = "SELECT *, tb_type_product.type, tb_brand.name_brand
        FROM tb_product
        INNER JOIN tb_type_product ON tb_product.type_id = tb_type_product.id
        INNER JOIN tb_brand ON tb_product.brand_id = tb_brand.id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "model: " . $row["model"]. " - type: " . $row["type"]." - brand: " . $row["name_brand"]. "<br>";
    }
}

?>