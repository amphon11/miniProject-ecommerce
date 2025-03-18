<?php
include('../connect.php');

?>


<!doctype html>
<html lang="en">

<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- เรียกใช้ไฟล์ CSS ของ SweetAlert2 -->
  <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.all.min.js
"></script>
  <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css
" rel="stylesheet">
  <!-- เรียกใช้ไฟล์ CSS ของ SweetAlert2 -->
</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400;500&display=swap');

  * {
    --font-family: 'Prompt', sans-serif;
    font-family: var(--font-family);
    --backgroundColor: #D6EAF8;
  }

  body {
    background-color: var(--backgroundColor);
  }
</style>

<body>
  <div class="container mt-5 pt-5">
    <div class="card mx-auto" style="width: 500px; height: 500px; ">
      <div class="card-body">
        <p style="text-align: center;">
          <img src="https://cdn-icons-png.flaticon.com/512/3899/3899618.png " alt="..." class="img" style="width: 200px; height: 200px; ">
        </p>
        <form action="Check_login.php" method="post" autocomplete="off">
          <p class="h3 text-center">เข้าสู่ระบบ</p>
          <div class="input-group input-group-sm pl-3 pr-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: FAFAFA;">ชื่อผู้ใช้</span>
            </div>
            <input type="text" name="username" class="form-control input1" placeholder="" required oninvalid="this.setCustomValidity('กรุณากรอกชื่อผู้ใช้')" oninput="this.setCustomValidity('')">
          </div>

          <div class="input-group input-group-sm p-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-sm" style="background-color: FAFAFA;">รหัสผ่าน</span>
            </div>
            <input type="password" name="password" class="form-control input2 " placeholder="" required oninvalid="this.setCustomValidity('กรุณากรอกรหัสผ่าน')" oninput="this.setCustomValidity('')">
          </div>

          <a href="../Register/" class="p-3">หากไม่มีบัญชีผู้ใช้งานกรุณาสมัครสมาชิก Click</a>
          <br>
          <a class="btn btn-outline-warning mt-3 ml-3" href="../">ย้อนกลับ</a>
          <button type="submit" class="btn btn-primary mt-3">เข้าสู่ระบบ</button>

      </div>

      </form>
    </div>
  </div>
  </div>
  </div>

</body>

</html>