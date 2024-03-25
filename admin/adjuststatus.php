<?php
session_start();
include 'condb.php';

// รับค่าที่ส่งมาจากฟอร์ม
$List_ID = $_POST['List_ID'];
$List_status = $_POST['List_status'];

// ดำเนินการอัพเดทข้อมูลผู้ใช้
$sql = "UPDATE orderlist
        SET List_status='$List_status'
        WHERE List_ID=$List_ID";

$result = mysqli_query($conn, $sql);

if ($result) {
    $_SESSION['updatestat_success'] = 1;
    echo "<script> window.history.back();</script>";
} else {
    // กรณีอื่นๆ
    echo "<script> alert('ไม่สามารถอัพเดทข้อมูลได้ โปรดตรวจสอบข้อมูลอีกครั้ง'); </script>";
    // เพิ่มบรรทัดนี้เพื่อ redirect กลับไปยังหน้าเดิม
    echo "<script> window.history.back(); </script>";
}
?>