<?php

$errors = [];
$data = [];
$emailPattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
$email = $_POST['email'];
$spaceCount = substr_count($_POST['username'],' ');
$char_split_username = str_split($_POST['username']);


if (empty($_POST['username'])) {
    $errors['username'] = 'กรุณาป้อนชื่อผู้ใช้';
}
if (!preg_match('/^[a-z0-9]+$/',$_POST['username'])){
    $errors['username'] = 'อนุญาตให้ ชื่อผู้ใช้ประกอบด้วย A-Z และ ตัวเลข 0-9 เท่านั้น';
}
if(is_numeric($char_split_username[0])){
    $errors['username'] = 'ตัวอักษรด้านหน้าต้องไม่เป็นตัวเลข';
}
if($spaceCount >0){
    $errors['username'] = 'ไม่อนุญาตให้มีช่องว่าง';
}
if (empty($_POST['password'])) {
    $errors['password'] = 'กรุณาป้อนรหัสผ่าน';
}
if (strlen($_POST['password']) >= 5 && strlen($_POST['password']) <= 20) {
    // ตรวจสอบรูปแบบของรหัสผ่าน
    if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['password'])) {
        echo "รหัสผ่านถูกต้อง";
        $errors['password'] = 'รหัสผ่านไม่ถูกต้อง (ต้องเป็น a-z, A-Z, และ 0-9 เท่านั้น)';
    }
}else{
    $errors['password'] = 'ความยาวของรหัสผ่านต้องอยู่ระหว่าง 5 ถึง 20 ตัวอักษร';
}
if (empty($_POST['fname'])) {
    $errors['fname'] = 'กรุณาป้อนชื่อ';
}
if (preg_match('/^[!@#$%^&*(),.?":{}|<>1234567890๑๒๓๔๕๖๗๘๙\-]|[\s]/u', $_POST['fname'])) {
    $errors['fname'] = 'ชื่อ ไม่อนุญาตให้มี อักขระพิเศษหรือตัวเลข หรือช่องว่าง';
}
if (preg_match('/^[!@#$%^&*(),.?":{}|<>1234567890๑๒๓๔๕๖๗๘๙\-]|[\s]/u', $_POST['fname'])) {
    $errors['fname'] = 'ชื่อ ไม่อนุญาตให้มี อักขระพิเศษหรือตัวเลข หรือช่องว่าง';
}
// if (!preg_match('/^[a-zA-Zก-ฮเ-ๆ\s]+$/u', $_POST['fname']) and substr_count($_POST['fname'],' ')>0) {
//     $errors['fname'] = 'ชื่อ ไม่อนุญาตให้มี ตัวอักขระพิเศษ หรือ ช่องว่าง';
// }
// if (!preg_match('/^[a-zA-Zก-ฮเ-ๆ\s]+$/u', $_POST['lname']) and substr_count($_POST['lname'],' ')>0) {
//     $errors['lname'] = 'นามสกุล ไม่อนุญาตให้มี ตัวอักขระพิเศษ หรือ ช่องว่าง';
// }
if (empty($_POST['lname'])) {
    $errors['lname'] = 'กรุณาป้อนนามสกุล';
}
if ($_POST['province'] == 'Select ...') {
    $errors['province'] = 'กรุณาเลือกจังหวัด !!';
}
if ($_POST['district'] == 'Select ...') {
    $errors['district'] = 'กรุณาเลือกอำเภอ !!';
}
if ($_POST['subdistrict'] == 'Select ...') {
    $errors['subdistrict'] = 'กรุณาเลือกตำบล !!';
}

if (empty($_POST['email'])) {
    $errors['email'] = 'กรุณาป้อนอีเมล';
}
elseif (!preg_match($emailPattern, $email)) {
    $errors['email'] = 'อีเมลมีรูปแบบที่ไม่ถูกต้อง.';
}

if (empty($_POST['phone'])) {
    $errors['phone'] = 'กรุณาป้อนเบอร์โทรศัพท์';
}
if (!preg_match('/^0\d{9}$/', $_POST['phone'])) {
    $errors['phone'] = 'เบอร์โทรศัพท์ต้องเป็นตัวเลข 0-9 เท่านั้น และจำนวนมี 10 ตัว';
}
if (!preg_match('/^\d{5}$/', $_POST['postalCode'])) {
    $errors['postalCode'] = 'รหัสไปรษณีย์ รูปแบบไม่ถูกต้อง';
}
if (empty($_POST['postalCode'])) {
    $errors['postalCode'] = 'กรุณาป้อนรหัสไปรษณีย์';
}
if (empty($_POST['houseNumber'])) {
    $errors['houseNumber'] = 'กรุณาป้อน บ้านเลขที่ ซอย ถนน';
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $data['success'] = true;
    $data['message'] = 'Success!';
    $data['state'] = true;
    include ('../connect.php');

    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // แฮชรหัสผ่าน
    
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $province = $_POST['province'];
    $amphure = $_POST['district'];
    $tambon = $_POST['subdistrict'];
    $houseNumber = $_POST['houseNumber'];
    $postalCode = $_POST['postalCode'];
    $status = 'member';

    
    $sqli="SELECT * FROM tb_users WHERE username ='$username'";
    $consq=mysqli_query($conn,$sqli);
    $num = mysqli_num_rows($consq); //เช็คว่ามีข้อมูลในแถมนี่เท่าไหร่
    if($num > 0){
        $data['success'] = true;
        $data['message'] = "ชื่อผู้ใช้ซ้ำ";
        $data['state'] = false;
    }
    else{
        $sqli = "INSERT INTO tb_users(username,password,firstname,lastname,email,phone,status)VALUES
        ('$username','$hashed_password','$firstname','$lastname','$email','$phone','$status')";
         $con1 = mysqli_query($conn ,$sqli);
    
         $sql2 = "INSERT INTO address(username,province,amphure,tambon,houseNumber,postelCode)VALUES
         ('$username','$province','$amphure','$tambon','$houseNumber','$postalCode')";
         $con2 = mysqli_query($conn ,$sql2);
         if($con1 and $con2){
            $data['success'] = true;
            $data['message'] = 'ลงทะเบียนสำเร็จ!';
         }
         else{
            $data['success'] = false;
            $data['message'] = 'เกิดข้อผิดพลาดในการลงทะเบียน!';
         }
    }
    

}


echo json_encode($data);