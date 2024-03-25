<?php
session_start();
include 'condb.php';

// รับค่าที่ส่งมาจากฟอร์ม
$Pro_ID = $_POST['Pro_ID'];
$Pro_Name = $_POST['Pro_Name'];
$Pro_Price = $_POST['Pro_Price'];
$Pro_Description = $_POST['Pro_Description'];
$Pro_Amount = $_POST['Pro_Amount'];

// ตรวจสอบการอัพโหลดไฟล์รูปภาพใหม่
$new_file_name = "";

if (isset($_FILES['Pro_Image']) && $_FILES['Pro_Image']['error'] === UPLOAD_ERR_OK) {
    $new_file_name = basename($_FILES['Pro_Image']['name']);
    $file_upload_path = "../uploads/" . $new_file_name;
    move_uploaded_file($_FILES['Pro_Image']['tmp_name'], $file_upload_path);
}

// ตรวจสอบว่ามีรูปที่อัพโหลดมาหรือไม่
if ($new_file_name !== "") {
    // ดำเนินการอัพเดทข้อมูลสินค้าพร้อม Pro_Image
    $sql = "UPDATE product
            SET Pro_Name='$Pro_Name', Pro_Price='$Pro_Price', Pro_Description='$Pro_Description',
                Pro_Amount='$Pro_Amount', Pro_Image='$new_file_name'
            WHERE Pro_ID=$Pro_ID";
} else {
    // ดำเนินการอัพเดทข้อมูลสินค้าโดยไม่รวม Pro_Image
    $sql = "UPDATE product
            SET Pro_Name='$Pro_Name', Pro_Price='$Pro_Price', Pro_Description='$Pro_Description',
                Pro_Amount='$Pro_Amount'
            WHERE Pro_ID=$Pro_ID";
}

$result = mysqli_query($conn, $sql);

if ($result) {
    // ส่งค่า update_success เมื่ออัพเดทสินค้าสำเร็จ
    $_SESSION['update_success'] = 1;
    echo "<script> window.history.back();</script>";
} else {
    // กรณีอื่นๆ
    echo "<script> alert('ไม่สามารถอัพเดทสินค้าได้ โปรดตรวจสอบข้อมูลอีกครั้ง'); </script>";
}
?>