<?php
session_start();
include 'condb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["Cus_Username"]);
    $password = mysqli_real_escape_string($conn, $_POST["Cus_Password"]);

    // เพิ่มการตรวจสอบค่าว่าง
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = 1;
        header("Location: ../index.php");
        exit();
    }

    $sql = "SELECT * FROM customer WHERE Cus_Username = '$username' AND Cus_Password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["Cus_ID"] = $row["Cus_ID"];
        $_SESSION["Cus_Username"] = $row["Cus_Username"];

        if ($row["Cus_Status"] == "USER") {
            // ส่งค่า success ไปยังหน้า index_log.php ผ่าน Session
            $_SESSION['success'] = 1;
            header("Location: index_log.php");
        } elseif ($row["Cus_Status"] == "ADMIN") {
            // ส่งค่า success ไปยังหน้า index_ad.php ผ่าน Session
            $_SESSION['success'] = 1;
            header("Location: ../admin/index_ad.php");
        }
        exit();
    } else {
        // ถ้าไม่พบข้อมูลผู้ใช้, ส่งข้อความผิดพลาดกลับไปที่หน้าเข้าสู่ระบบ และเก็บค่า error ใน Session
        $_SESSION['error'] = 1;
        header("Location: ../index.php");
        exit();
    }
}
?>
