<?php
session_start();
include 'condb.php';

// รับค่าที่ส่งมาจากฟอร์ม
$Cate_ID = $_POST['Cate_ID'];
$Cate_Name = $_POST['Cate_Name'];

// ตรวจสอบว่ามีการอัปโหลดไฟล์รูปภาพหรือไม่
if(isset($_FILES['Cate_Icon']) && $_FILES['Cate_Icon']['error'] == 0) {
    // รับไฟล์รูปภาพที่อัปโหลด
    $Cate_Icon = $_FILES['Cate_Icon']['name'];
    $temp_name = $_FILES['Cate_Icon']['tmp_name'];

    // อัพโหลดไฟล์ไปยังโฟลเดอร์ที่กำหนด
    $target_path = "../uploads/";
    move_uploaded_file($temp_name, $target_path . $Cate_Icon);
} else {
    // หากไม่มีการอัปโหลดไฟล์ ใช้ค่าเดิมที่อยู่ในฐานข้อมูล
    $sql_get_old_icon = "SELECT Cate_Icon FROM category WHERE Cate_ID=$Cate_ID";
    $result_get_old_icon = mysqli_query($conn, $sql_get_old_icon);
    $row_get_old_icon = mysqli_fetch_assoc($result_get_old_icon);
    $Cate_Icon = $row_get_old_icon['Cate_Icon'];
}

// ดำเนินการอัพเดทข้อมูลหมวดหมู่
$sql = "UPDATE category
        SET Cate_Name='$Cate_Name', Cate_Icon='$Cate_Icon'
        WHERE Cate_ID=$Cate_ID";

$result = mysqli_query($conn, $sql);

if ($result) {
    $_SESSION['updatecate_success'] = 1;
    echo "<script> window.history.back();</script>";
    
} else {
    // กรณีอื่นๆ
    echo "<script> alert('ไม่สามารถอัพเดทข้อมูลได้ โปรดตรวจสอบข้อมูลอีกครั้ง'); </script>";
}
?>
