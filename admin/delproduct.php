<?php
session_start();
// delcate.php

// เชื่อมต่อกับฐานข้อมูล
include('condb.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["Pro_ID"])) {
    $Pro_ID = $_GET["Pro_ID"];

 
    $sql = "DELETE FROM product WHERE Pro_ID = $Pro_ID";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['deletepro_success'] = 1;
        echo "<script> window.history.back();</script>";
        exit();
    } else {
        echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . mysqli_error($conn);
    }
}
?>