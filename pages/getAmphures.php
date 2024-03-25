<?php
include 'condb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $provinceId = $_POST["provinceId"];

    $sql = "SELECT amphures_id, amphures_name_th FROM amphures WHERE provinces_id = $provinceId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $options = '<option value="">กรุณาเลือกอำเภอ</option>';
        while ($row = $result->fetch_assoc()) {
            $options .= '<option value="' . $row['amphures_id'] . '">' . $row['amphures_name_th'] . '</option>';
        }
        echo $options;
    } else {
        echo '<option value="">ไม่พบข้อมูลอำเภอ</option>';
    }
}

?>