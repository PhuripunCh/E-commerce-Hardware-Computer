<?php
session_start();
include 'condb.php';

$Cus_Username = $_POST['Cus_Username'];
$Cus_Password = $_POST['Cus_Password'];
$Cus_Email = $_POST['Cus_Email'];
$Cus_tel = $_POST['Cus_tel'];
$Cus_FName = $_POST['Cus_FName'];
$Cus_LName = $_POST['Cus_LName'];

$Cus_Status = 'ADMIN';

// ตรวจสอบว่ามี User ที่ซ้ำกันหรือไม่ (โดยให้เฉพาะคนที่มีสถานะเป็น ADMIN)
$checkDuplicateUserSql = "SELECT COUNT(*) as count_user FROM customer WHERE Cus_Username = '$Cus_Username' AND Cus_Status = 'ADMIN'";
$checkDuplicateUserResult = mysqli_query($conn, $checkDuplicateUserSql);
$row_user = mysqli_fetch_assoc($checkDuplicateUserResult);
$count_user = $row_user['count_user'];

// ตรวจสอบว่ามีเบอร์โทรที่ซ้ำกันหรือไม่ (โดยให้เฉพาะคนที่มีสถานะเป็น ADMIN)
$checkDuplicateTelSql = "SELECT COUNT(*) as count_tel FROM customer WHERE Cus_tel = '$Cus_tel' AND Cus_Status = 'ADMIN'";
$checkDuplicateTelResult = mysqli_query($conn, $checkDuplicateTelSql);
$row_tel = mysqli_fetch_assoc($checkDuplicateTelResult);
$count_tel = $row_tel['count_tel'];

if ($count_user > 0 && $count_tel > 0) {
    // ส่งค่า register_error=user-tel ถ้ามี User และเบอร์โทรที่ซ้ำกัน
    $_SESSION['registerad_error'] = 'user_tel';
    echo "<script> window.location='index_ad.php?C=1&D=3';</script>";
} elseif ($count_user > 0) {
    // ส่งค่า register_error=user ถ้ามีผู้ใช้ที่ซ้ำ
    $_SESSION['registerad_error'] = 'user';
    echo "<script> window.location='index_ad.php?C=1&D=3';</script>";
} elseif ($count_tel > 0) {
    // ส่งค่า register_error=tel ถ้ามีเบอร์โทรที่ซ้ำ
    $_SESSION['registerad_error'] = 'tel';
    echo "<script> window.location='index_ad.php?C=1&D=3';</script>";
} else {
    // ไม่มี User หรือเบอร์โทรที่ซ้ำ ดำเนินการสมัครสมาชิก
    $sql="INSERT INTO customer(Cus_Username,Cus_Password,Cus_Email,Cus_tel,Cus_FName,Cus_LName,Cus_Status)
    VALUES('$Cus_Username','$Cus_Password','$Cus_Email','$Cus_tel','$Cus_FName','$Cus_LName','$Cus_Status')";
    $result=mysqli_query($conn,$sql);

    if ($result) {
        // ส่งค่า register_success เมื่อสมัครสมาชิกสำเร็จ
        $_SESSION['registerad_success'] = 1;
        echo "<script> window.history.back();</script>";
    } else {
        // กรณีอื่นๆ
        echo "<script> alert('ไม่สามารถสมัครสมาชิกได้โปรดตรวจสอบข้อมูลอีกครั้ง'); </script>";
        echo "<script> window.history.back();</script>";
    }
}
?>