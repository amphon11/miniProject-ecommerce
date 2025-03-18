<?php
require('./index.php');
?>
<script type="text/javascript">
  Swal.fire({
    title: "ออกจากระบบใช่หรือไม่?",
    text: "กรุณากดยืนยัน'หากต้องการออกจากระบบ!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "ยืนยัน ออกจากระบบ!",
    cancelButtonText: "ยกเลิก"
  }).then((result) => {
    if (result.isConfirmed) {
      // ยืนยันการออกจากระบบ
      Swal.fire({
        title: "ออกจากระบบสำเร็จ!",
        text: "คุณได้ทำการออกจากระบบสำเร็จ!",
        icon: "success"
      }).then(() => {
        // ใช้ AJAX เรียก clear_session.php
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
          if (xhr.readyState == 4 && xhr.status == 200) {
            // นำผู้ใช้ไปยังหน้าแรกหลังจากออกจากระบบ
            location.href = "../mini_Data";
          }
        };
        xhr.open("GET", "./logout/clear_session.php", true);
        xhr.send();
      });
    }
  });
</script>
