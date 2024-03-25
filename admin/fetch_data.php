<?php
include 'condb.php';

// ตรวจสอบว่ามีการส่งค่า days มาหรือไม่
if (isset($_POST['days'])) {
    $days = $_POST['days'];

    // ดำเนินการดึงข้อมูลจากฐานข้อมูลตามช่วงเวลาที่เลือก
    $sql = "SELECT DATE(List_date) AS List_date, SUM(List_total) AS total_sales
            FROM orderlist
            WHERE List_date >= NOW() - INTERVAL $days DAY
            GROUP BY DATE(List_date)
            ORDER BY DATE(List_date)";
} else {
    // ถ้าไม่มีการส่งค่า days มา ให้ดึงข้อมูลทั้งหมด
    $sql = "SELECT DATE(List_date) AS List_date, SUM(List_total) AS total_sales
            FROM orderlist
            GROUP BY DATE(List_date)
            ORDER BY DATE(List_date)";
}

$result = mysqli_query($conn, $sql);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = array('List_date' => $row['List_date'], 'total_sales' => $row['total_sales']);
}

// ส่งข้อมูลในรูปแบบ JSON กลับไปที่ JavaScript
header('Content-Type: application/json');
echo json_encode($data);
?>