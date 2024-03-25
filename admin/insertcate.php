<?php
session_start();
include 'condb.php';

$Cate_Name = $_POST['Cate_Name'];

// ตรวจสอบว่ามีการอัปโหลดไฟล์หรือไม่
if(isset($_FILES['Cate_Icon']) && $_FILES['Cate_Icon']['error'] === UPLOAD_ERR_OK) {
    // เก็บชื่อไฟล์และพาธที่อัปโหลด
    $file_name = $_FILES['Cate_Icon']['name'];
    $file_tmp = $_FILES['Cate_Icon']['tmp_name'];
    $file_dest = '../uploads/' . $file_name;

    // ย้ายไฟล์ไปยังโฟลเดอร์ uploads
    if(move_uploaded_file($file_tmp, $file_dest)) {
        // ดำเนินการเพิ่มข้อมูลหลังจากอัปโหลดไฟล์สำเร็จ
        $sql = "INSERT INTO category(Cate_Name, Cate_Icon) VALUES('$Cate_Name', '$file_name')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $_SESSION['insertcate_success'] = 1;
            echo "<script> window.location='index_ad.php?C=1&D=10';</script>";
        } else {
            echo "<script> alert('ไม่สามารถเพิ่มหมวดหมู่ได้ โปรดตรวจสอบข้อมูลอีกครั้ง'); </script>";
        }
    } else {
        echo "<script> alert('เกิดข้อผิดพลาดในการอัปโหลดไฟล์'); </script>";
    }
} else {
    echo "<script> alert('โปรดเลือกไฟล์ที่ต้องการอัปโหลด'); </script>";
}
?>
