<?php
session_start();
include 'condb.php';

$Pro_Name = $_POST['Pro_Name'];
$Pro_Price = $_POST['Pro_Price'];
$Pro_Description = $_POST['Pro_Description'];
$Pro_Amount = $_POST['Pro_Amount'];
$Cate_ID = $_POST['Cate_ID'];

if (isset($_FILES['Pro_Image']) && $_FILES['Pro_Image']['error'] === UPLOAD_ERR_OK) {
    $new_file_name = basename($_FILES['Pro_Image']['name']);
    $file_upload_path = "../uploads/" . $new_file_name;
    move_uploaded_file($_FILES['Pro_Image']['tmp_name'], $file_upload_path);
} else {
    $new_file_name = "";
}

// ดำเนินการเพิ่มข้อมูลสินค้า
$sql = "INSERT INTO product(Pro_Name, Pro_Price, Pro_Description, Pro_Amount, Pro_Image, Cate_ID)
        VALUES('$Pro_Name', '$Pro_Price', '$Pro_Description', '$Pro_Amount', '$new_file_name', '$Cate_ID')";
    
$result = mysqli_query($conn, $sql);

if ($result) {
    // ส่งค่า insert_success เมื่อเพิ่มสินค้าสำเร็จ
    $_SESSION['insert_success'] = 1;
    echo "<script> window.history.back();</script>";
} else {
    // กรณีอื่นๆ
    echo "<script> alert('ไม่สามารถเพิ่มสินค้าได้ โปรดตรวจสอบข้อมูลอีกครั้ง'); </script>";
}
?>
