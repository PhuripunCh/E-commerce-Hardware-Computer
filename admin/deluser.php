<?php
session_start();
// delcate.php

// เชื่อมต่อกับฐานข้อมูล
include('condb.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["Cus_ID"])) {
    $Cus_ID = $_GET["Cus_ID"];

 
    $sql = "DELETE FROM customer WHERE Cus_ID = $Cus_ID";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // เมื่อลบเสร็จแล้ว, ทำการ redirect หรือส่งผลลัพธ์กลับไปยังหน้าที่ต้องการ
        $_SESSION['deleteuser_success'] = 1;
    echo "<script> window.history.back();</script>";
       
        exit();
    } else {
        echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . mysqli_error($conn);
    }
}
?>