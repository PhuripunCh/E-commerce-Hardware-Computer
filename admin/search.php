<?php
include 'condb.php'; // เชื่อมต่อกับฐานข้อมูล

if (isset($_POST['search'])) {
    $searchproduct = $_POST['search'];

    // เขียนคำสั่ง SQL ตามต้องการ
    $query = "SELECT * FROM product WHERE Pro_Name LIKE '%$searchproduct%'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // แสดงข้อมูลที่ค้นหาได้
            echo '<a href="#" class="search-result-item">' . $row['Pro_Name'] . '</a>';
        }
    } else {
        // กรณีเกิดข้อผิดพลาดในการคิวรี
        echo 'Error in query: ' . mysqli_error($conn);
    }
}

$conn->close();
?>

