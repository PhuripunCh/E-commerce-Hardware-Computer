<?php
session_start();

// เชื่อมต่อกับฐานข้อมูล
include('condb.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["Cate_ID"])) {
    $Cate_ID = $_GET["Cate_ID"];

    // ทำโค้ดลบข้อมูลของหมวดหมู่ที่มี Cate_ID เท่ากับ $Cate_ID จากตาราง category
    $sql = "DELETE FROM category WHERE Cate_ID = $Cate_ID";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['deletecate_success'] = 1;
        echo "<script> window.location='index_ad.php?C=1&D=10';</script>";
    } else {
        echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . mysqli_error($conn);
    }
}
?>