<?php


// ตรวจสอบว่ามีการล็อกอินเข้าสู่ระบบแล้วหรือไม่
if(isset($_SESSION['Cus_Username'])) {
    // หากมีการล็อกอินแล้ว
    $username = $_SESSION['Cus_Username'];

} else {
    // หากยังไม่ได้ล็อกอิน
    // ส่งกลับไปที่หน้า index
    $_SESSION['pls_login'] = 1;
    echo "<script> window.location='../index.php';</script>";

}
?>