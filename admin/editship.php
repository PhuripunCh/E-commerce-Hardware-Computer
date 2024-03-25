<?php
include 'condb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Ship_status = $_POST['Ship_status'];
    $Ship_tag = $_POST['Ship_tag'];
    $Ship_ID = $_POST['Ship_ID'];

    // ดึงค่า Ship_datetime จาก input และแปลงเป็นรูปแบบที่เหมาะสม
    $Ship_date = date('Y-m-d H:i:s', strtotime($_POST['Ship_date']));

    // ทำการอัปเดตข้อมูลในตาราง shipping ตาม Ship_ID
    $sql = "UPDATE shipping SET Ship_status = '$Ship_status', Ship_tag = '$Ship_tag', Ship_date = '$Ship_date' WHERE Ship_ID = '$Ship_ID' ";

    if (mysqli_query($conn, $sql)) {
        // อัปเดตสถานะสำเร็จ
        header("Location: index_ad.php?C=1&D=7");
        exit();
    } 
}

mysqli_close($conn);
?>
