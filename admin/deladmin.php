<?php
session_start();
// delcate.php

// เชื่อมต่อกับฐานข้อมูล
include('condb.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["Cus_ID"])) {
    $Cus_ID = $_GET["Cus_ID"];

    // ตรวจสอบว่า ID ของผู้ใช้ที่กำลังลบไม่ตรงกับ ID ของผู้ใช้ที่เข้าสู่ระบบ
    if ($Cus_ID != $_SESSION['Cus_ID']) {
        $sql = "DELETE FROM customer WHERE Cus_ID = $Cus_ID";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // เมื่อลบเสร็จแล้ว, ทำการ redirect หรือส่งผลลัพธ์กลับไปยังหน้าที่ต้องการ
            $_SESSION['deleteadmin_success'] = 1;
            echo "<script> window.history.back();</script>";
        } else {
            echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . mysqli_error($conn);
        }
    } else {
        $_SESSION['deleteadmin_error'] = 1;
        echo "<script> window.history.back();</script>";
    }
}
?>