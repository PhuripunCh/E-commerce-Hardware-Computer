<?php
session_start();
include 'condb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cusID = $_POST["Cus_ID"];
    $Add_Province = $_POST["Add_Province"];
    $Add_Address = $_POST["Add_Address"];
    $Add_District = $_POST["Add_District"];
    $Add_Zip_code = $_POST["Add_Zip_code"];
    $Add_Subdistrict = $_POST["Add_Subdistrict"];
    
    // ทำการปรับปรุงข้อมูลในตาราง addresscus
    $update_sql = "UPDATE addresscus SET Add_Province='$Add_Province', Add_Address='$Add_Address', Add_District='$Add_District', Add_Zip_code='$Add_Zip_code',
    Add_Subdistrict = '$Add_Subdistrict'
     WHERE Cus_ID='$cusID'";
    $update_result = mysqli_query($conn, $update_sql);

    if ($update_result) {
        // สร้าง Session เพื่อบอกให้ JavaScript ทราบว่ามีการอัพเดตข้อมูลสำเร็จ
        $_SESSION['updateadd_success'] = 1;
        echo "<script> window.location='index_log.php?P=1&S=6';</script>";
    } else {
        echo "มีข้อผิดพลาดในการปรับปรุงที่อยู่ส่งจัดส่ง";
    }
}
?>