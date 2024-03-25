<?php
session_start();
include 'condb.php';

// รับค่าที่ส่งมาจากฟอร์ม
$Cus_ID = $_POST['Cus_ID'];
$Cus_Username = $_POST['Cus_Username'];
$Cus_Password = $_POST['Cus_Password'];
$Cus_FName = $_POST['Cus_FName'];
$Cus_LName = $_POST['Cus_LName'];
$Cus_Email = $_POST['Cus_Email'];
$Cus_tel = $_POST['Cus_tel'];
$Cus_Status = $_POST['Cus_Status'];
$Cus_Province = $_POST['Cus_Province'];
$Cus_District = $_POST['Cus_District'];
$Cus_Zip_code = $_POST['Cus_Zip_code'];
$Cus_Address = $_POST['Cus_Address'];
// ดำเนินการอัพเดทข้อมูลผู้ใช้
$sql = "UPDATE customer
        SET Cus_Username='$Cus_Username', Cus_Password='$Cus_Password',
            Cus_FName='$Cus_FName', Cus_LName='$Cus_LName',
            Cus_Email='$Cus_Email', Cus_tel='$Cus_tel' ,Cus_Status='$Cus_Status'
            ,Cus_Province='$Cus_Province',Cus_District='$Cus_District',Cus_Zip_code='$Cus_Zip_code'
            ,Cus_Address='$Cus_Address'
        WHERE Cus_ID=$Cus_ID";

$result = mysqli_query($conn, $sql);

if ($result) {
    // ส่งค่า update_success เมื่ออัพเดทข้อมูลสำเร็จ
    $_SESSION['updateus_success'] = 1;
    echo "<script> window.history.back();</script>";
} else {
    // กรณีอื่นๆ
    echo "<script> alert('ไม่สามารถอัพเดทข้อมูลได้ โปรดตรวจสอบข้อมูลอีกครั้ง'); </script>";
    echo "<script> window.history.back();</script>";
}
?>