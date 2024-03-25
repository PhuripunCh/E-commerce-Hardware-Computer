<?php
session_start();
include 'condb.php';

$Cus_Username = $_POST['Cus_Username'];
$Cus_Password = $_POST['Cus_Password'];
$Cus_Email = $_POST['Cus_Email'];
$Cus_tel = $_POST['Cus_tel'];
$Cus_FName = $_POST['Cus_FName'];
$Cus_LName = $_POST['Cus_LName'];
$Cus_Status = 'USER';

// เพิ่มข้อมูลที่อยู่
$provinceID = $_POST["provinces"];
    $amphureID = $_POST["amphures"];
    $districtID = $_POST["districts"];
    $zipcode = $_POST["zipcode"];
    $address = $_POST["Add_Address"];
$Add_Status = 'DEFAULT'; // สามารถเปลี่ยนตามความต้องการ

// ตรวจสอบว่ามี User ที่ซ้ำกันหรือไม่
$checkDuplicateUserSql = "SELECT COUNT(*) as count_user FROM customer WHERE Cus_Username = '$Cus_Username'";
$checkDuplicateUserResult = mysqli_query($conn, $checkDuplicateUserSql);
$row_user = mysqli_fetch_assoc($checkDuplicateUserResult);
$count_user = $row_user['count_user'];

// ตรวจสอบว่ามีเบอร์โทรที่ซ้ำกันหรือไม่
$checkDuplicateTelSql = "SELECT COUNT(*) as count_tel FROM customer WHERE Cus_tel = '$Cus_tel'";
$checkDuplicateTelResult = mysqli_query($conn, $checkDuplicateTelSql);
$row_tel = mysqli_fetch_assoc($checkDuplicateTelResult);
$count_tel = $row_tel['count_tel'];

if ($count_user > 0 && $count_tel > 0) {
    // ส่งค่า register_error=user-tel ถ้ามี User และเบอร์โทรที่ซ้ำกัน
    $_SESSION['register_error'] = 'user_tel';
    echo "<script> window.location='../index.php';</script>";
} elseif ($count_user > 0) {
    // ส่งค่า register_error=user ถ้ามีผู้ใช้ที่ซ้ำ
    $_SESSION['register_error'] = 'user';
    echo "<script> window.location='../index.php';</script>";
} elseif ($count_tel > 0) {
    // ส่งค่า register_error=tel ถ้ามีเบอร์โทรที่ซ้ำ
    $_SESSION['register_error'] = 'tel';
    echo "<script> window.location='../index.php';</script>";
} else {
    // ไม่มี User หรือเบอร์โทรที่ซ้ำ ดำเนินการสมัครสมาชิก
    $sql = "INSERT INTO customer(Cus_Username,Cus_Password,Cus_Email,Cus_tel,Cus_FName,Cus_LName,Cus_Status)
            VALUES('$Cus_Username','$Cus_Password','$Cus_Email','$Cus_tel','$Cus_FName','$Cus_LName','$Cus_Status')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // ดึง ID ล่าสุดที่เพิ่งเพิ่มเข้าไป
        $customer_id = mysqli_insert_id($conn);
// ดึงชื่อจังหวัดจาก provinces_name_th
$sqlProvince = "SELECT provinces_name_th FROM provinces WHERE provinces_id = $provinceID";
$resultProvince = $conn->query($sqlProvince);
$rowProvince = $resultProvince->fetch_assoc();
$provinceName = $rowProvince['provinces_name_th'];

// ดึงชื่ออำเภอจาก amphures_name_th
$sqlAmphure = "SELECT amphures_name_th FROM amphures WHERE amphures_id = $amphureID";
$resultAmphure = $conn->query($sqlAmphure);
$rowAmphure = $resultAmphure->fetch_assoc();
$amphureName = $rowAmphure['amphures_name_th'];

// ดึงชื่อตำบลจาก districts_name_th
$sqlDistrict = "SELECT districts_name_th FROM districts WHERE id = $districtID";
$resultDistrict = $conn->query($sqlDistrict);
$rowDistrict = $resultDistrict->fetch_assoc();
$districtName = $rowDistrict['districts_name_th'];
        // เพิ่มข้อมูลที่อยู่ลงในตาราง addresscus
        $sql_address = "INSERT INTO addresscus(Cus_ID, Add_Province, Add_District, Add_Subdistrict, Add_Zip_code, Add_Address, Add_Status)
                        VALUES('$customer_id', '$provinceName', '$amphureName', '$districtName', '$zipcode', '$address', '$Add_Status')";
        $result_address = mysqli_query($conn, $sql_address);

        if ($result_address) {
            // ส่งค่า register_success เมื่อสมัครสมาชิกสำเร็จ
            $_SESSION['register_success'] = 1;
            echo "<script> window.location='../index.php';</script>";
        } else {
            // กรณีเกิดข้อผิดพลาดในการเพิ่มข้อมูลที่อยู่
            echo "<script> alert('ไม่สามารถสมัครสมาชิกได้ โปรดตรวจสอบข้อมูลอีกครั้ง'); </script>";
        }
    } else {
        // กรณีอื่นๆ
        echo "<script> alert('ไม่สามารถสมัครสมาชิกได้ โปรดตรวจสอบข้อมูลอีกครั้ง'); </script>";
    }
}
?>