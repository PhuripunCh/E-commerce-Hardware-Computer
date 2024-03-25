<?php
include 'pages/condb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $districtId = $_POST["districtId"];

    $sql = "SELECT zip_code FROM districts WHERE id = $districtId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $zipcode = $row['zip_code'];
        echo $zipcode;
    } else {
        echo 'ไม่พบข้อมูล zip code';
    }
}
?>
