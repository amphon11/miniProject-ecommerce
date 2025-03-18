<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (!empty($_SESSION)) {

  $ss_username = $_SESSION['username'];
  $ss_password = $_SESSION['password'];
  $ss_status = $_SESSION['status'];
}

require_once('./connect.php');
if(isset($_GET) and isset($_GET['type_id'])){
  $type_id= $_GET['type_id'];
}

$sql="SELECT * FROM tb_product 
      INNER JOIN tb_brand ON tb_product.brand_id = tb_brand.id
      INNER JOIN tb_type_product ON tb_product.type_id = tb_type_product.id
       WHERE type_id = '$type_id'"; 
      
$sql = mysqli_query($conn,$sql);

while ($result = mysqli_fetch_assoc($sql)){
  echo $result['type'].$result['model'].$result['name_brand'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="./img/icons8-workstation-gradient/icons8-workstation-64.png">
  <link rel="stylesheet" href="./css/nav.css">
  <link rel="stylesheet" href="./css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <title>Index</title>
</head>

<body>
  <?php
  include('./include/navbar.php');


?>
  
</body>
</html>