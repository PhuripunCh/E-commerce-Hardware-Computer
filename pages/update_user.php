<?php
session_start();
include 'condb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cusID = $_POST["Cus_ID"];

    $newCus_Password = mysqli_real_escape_string($conn, $_POST["Cus_Password"]);
    $newCus_FName = mysqli_real_escape_string($conn, $_POST["Cus_FName"]);
    $newCus_LName = mysqli_real_escape_string($conn, $_POST["Cus_LName"]);
    $newCus_Email = mysqli_real_escape_string($conn, $_POST["Cus_Email"]);
    $newCus_tel = mysqli_real_escape_string($conn, $_POST["Cus_tel"]);
    
    // ทำการปรับปรุงข้อมูลในตาราง customer
    $update_sql = "UPDATE customer SET  Cus_Password='$newCus_Password', Cus_FName='$newCus_FName', Cus_LName='$newCus_LName',
    Cus_Email = '$newCus_Email', Cus_tel='$newCus_tel'
     WHERE Cus_ID='$cusID'";
    $update_result = mysqli_query($conn, $update_sql);

    if ($update_result) {
        // สร้าง Session เพื่อบอกให้ JavaScript ทราบว่ามีการอัพเดตข้อมูลสำเร็จ
        $_SESSION['updateadd_success'] = 1;
        echo "<script> window.location='index_log.php?P=1&S=2';</script>";
    } else {
        echo "มีข้อผิดพลาดในการปรับปรุงข้อมูล";
    }
}
?>