<?php
include 'condb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amphureId = $_POST["amphureId"];

    $sql = "SELECT districts.id, districts.districts_name_th FROM districts WHERE districts.amphures_id = $amphureId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $options = '<option value="">กรุณาเลือกตำบล</option>';
        while ($row = $result->fetch_assoc()) {
            $options .= '<option value="' . $row['id'] . '">' . $row['districts_name_th'] . '</option>';
        }
        echo $options;
    } else {
        echo '<option value="">ไม่พบข้อมูลตำบล</option>';
    }
}

?>