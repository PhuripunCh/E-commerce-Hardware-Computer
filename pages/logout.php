<?php
session_start();

session_destroy();
?>

<script>
    // สร้าง Object XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // กำหนด URL ที่ต้องการ redirect ไป
    
    var redirectURL = '../index.php?logout_success=1';

    // เรียกใช้ method GET ในการโหลด URL
    xhr.open('GET', redirectURL, true);

    // กำหนด callback function เมื่อ request เสร็จสิ้น
    xhr.onload = function () {
        // ให้ทำการ redirect ไปยัง URL ที่กำหนด
  window.location.href = redirectURL;
       console.log(redirectURL)
    };

    // ส่ง request
    xhr.send();
</script>