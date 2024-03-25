
<?php
include 'condb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cusID = $_POST["Cus_ID"];
    $provinceID = $_POST["provinces"];
    $amphureID = $_POST["amphures"];
    $districtID = $_POST["districts"];
    $zipcode = $_POST["zipcode"];
    $address = $_POST["Add_Address"];

    // ตรวจสอบว่ามีที่อยู่เดิมหรือไม่
    $checkAddressSql = "SELECT COUNT(*) as count_address FROM addresscus WHERE Cus_ID = '$cusID'";
    $checkAddressResult = mysqli_query($conn, $checkAddressSql);
    $rowAddress = mysqli_fetch_assoc($checkAddressResult);
    $countAddress = $rowAddress['count_address'];

    if ($countAddress > 0) {
        // ถ้ามีที่อยู่เดิม ให้ทำการอัพเดทสถานะเป็น 'RESERVE'
        $updateStatusSql = "UPDATE addresscus SET Add_Status = 'RESERVE' WHERE Cus_ID = '$cusID'";
        $updateStatusResult = mysqli_query($conn, $updateStatusSql);

        if (!$updateStatusResult) {
            echo "Error updating address status: " . mysqli_error($conn);
            exit();
        }
    }

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

    // เพิ่มข้อมูลลงในตาราง addresscus
    $sql = "INSERT INTO addresscus (Cus_ID, Add_Province, Add_District, Add_Subdistrict, Add_Zip_code, Add_Address, provinces_id, amphures_id, id, Add_Status)
            VALUES ('$cusID', '$provinceName', '$amphureName', '$districtName', '$zipcode', '$address', '$provinceID', '$amphureID', '$districtID', 'DEFAULT')";
    $update_result = mysqli_query($conn, $sql);

    if ($update_result) {
        $_SESSION['add_success'] = 1;
        echo "<script> window.location='index_log.php?P=1&S=8';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
