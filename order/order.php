<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css" rel="stylesheet">
    <title>order</title>
</head>

<body>
</body>

<script>
    async function clear_cart() {
        localStorage.clear();
        await Swal.fire({
            position: "center",
            icon: "success",
            title: "สั่งซื้อสำเร็จ",
            showConfirmButton: false,
            timer: 1500
        });

        if (!localStorage.getItem('cart')) {
            window.location.href = '../order/order_list.php';
        } else {
            alert("don't clear");
        }
    }
</script>

</html>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!empty($_SESSION)) {
    $ss_username = $_SESSION['username'];
    $ss_status = $_SESSION['status'];
}

if (isset($_POST) && !empty($_POST)) {
    include("../connect.php");

    $productIds = $_POST['product_id'];
    $models = $_POST['model'];
    $amounts = $_POST['amount'];
    $prices = $_POST['price'];

    if (!empty($productIds) && !empty($amounts) && !empty($prices)) {
        date_default_timezone_set('Asia/Bangkok');
        $currentDateTime = date('Y-m-d H:i:s');
        $numItems = count($productIds);
        $sql = "SELECT MAX(order_id) AS max_value FROM tb_order";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_assoc();
        $maxValue = $row["max_value"];
        if ($maxValue == '') {
            $maxValue = 1;
        }
        $newValue = $maxValue + 1;

        for ($i = 0; $i < $numItems; $i++) {
            $productId = $productIds[$i];
            $model = $models[$i];
            $amount = $amounts[$i];
            $price = $prices[$i];

            $sqli1 = "SELECT * FROM tb_order WHERE order_id ='$newValue'";
            $consq1 = mysqli_query($conn, $sqli1);
            $num = mysqli_num_rows($consq1);

            $sql_getStore = "SELECT store FROM tb_product WHERE product_id = '$productId'";
            $sql_getStore = $conn->query($sql_getStore);
            $store_feth = $sql_getStore->fetch_assoc();
            $store = $store_feth['store'];
            $new_store = $store-$amount;

            if ($num > 0) {
                continue;
            } else {
                $sqli1 = "INSERT INTO tb_order_product(order_id, product_id, amount) VALUES ('$newValue', '$productId', '$amount')";
                $result1 = mysqli_query($conn, $sqli1);
                $update_store = "UPDATE tb_product SET store = '$new_store' WHERE product_id = '$productId'";
                $update_store = $conn->query($update_store);
                
            }
        }

        $sqli = "INSERT INTO tb_order(order_id, order_Date, username) VALUES ('$newValue', '$currentDateTime', '$ss_username')";
        $result = mysqli_query($conn, $sqli);

        if (!$result) {
            echo "Error: " . mysqli_error($conn);
        } else {
            echo "<script>clear_cart()</script>";

        }
    } else {
        echo 'One or more of the arrays is empty.';
    }
} else {
    echo 'No POST data received.';
}
?>
