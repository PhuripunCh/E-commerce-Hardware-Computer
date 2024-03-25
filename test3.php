<?php
include 'pages/condb.php';
$sql = "SELECT * FROM provinces";
$query = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .custom-input2 {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 2px solid #ccc;
        border-radius: 10px;
        box-sizing: border-box;
        transition: border-color 0.3s;
        margin-left: 0;
        /* เพิ่มคุณสมบัติ margin-left เพื่อลบช่องว่างทางซ้าย */
    }

    .custom-input2:hover,
    .custom-input2:focus {
        border-color: #ff9800;
    }

    .custom-input2::placeholder {
        position: absolute;
        top: 8px;
        left: 10px;
        font-size: 16px;
        color: #888;
        opacity: 1;
        transition: transform 0.3s, opacity 0.3s;
    }

    .custom-input2:hover::placeholder,
    .custom-input2:focus::placeholder {
        transform: translateY(-20px);
        opacity: 0;
    }
    </style>
</head>

<body>
<label for="" style=" align-items: center; margin-left: 0px; margin-top: 0px;"><i
                                    class="fi fi-rr-earth-asia" style="margin-right: 5px;"></i>จังหวัด</label>
    <section name="provinces" id="provinces">
        <select name="provinces" class="custom-input2">
            <option value="">กรุณาเลือกจังหวัด</option>
            <?php
    // สร้างคำสั่ง SQL เพื่อดึงข้อมูลจากตาราง provinces
$sql = "SELECT provinces_id, provinces_name_th FROM  provinces";
// ทำการ query ข้อมูล
$result = $conn->query($sql);
    // ตรวจสอบว่ามีข้อมูลจากการ query หรือไม่
    if ($result->num_rows > 0) {
        // Loop เพื่อเข้าถึงแต่ละแถวของข้อมูล
        while ($row = $result->fetch_assoc()) {
            // สร้าง option สำหรับแต่ละจังหวัด
            echo "<option value='" . $row['provinces_id'] . "'>" . $row['provinces_name_th'] . "</option>";
        }
    } else {
        echo "0 results";
    }

    // ปิดการเชื่อมต่อฐานข้อมูล

    ?>
        </select>
    </section>

    <label for="" style=" align-items: center; margin-left: 0px; margin-top: 0px;"><i
                                    class="fi fi-rr-map" style="margin-right: 5px;"></i>อำเภอ</label>
    <section name="amphures" id="amphures">
        <select name="amphures" class="custom-input2">
            <option value="">กรุณาเลือกอำเภอ</option>
            <?php
                // สร้างคำสั่ง SQL เพื่อดึงข้อมูลจากตาราง amphures
                $sql2 = "SELECT  amphures_id, amphures_name_th FROM  amphures";
                // ทำการ query ข้อมูล
                $result2 = $conn->query($sql2);

                // ตรวจสอบว่ามีข้อมูลจากการ query หรือไม่
                if ($result2->num_rows > 0) {
                    // Loop เพื่อเข้าถึงแต่ละแถวของข้อมูล
                    while ($row2 = $result2->fetch_assoc()) {
                        // สร้าง option สำหรับแต่ละอำเภอ
                        echo "<option value='" . $row2['amphures_id'] . "'>" . $row2['amphures_name_th'] . "</option>";
                    }
                } else {
                    echo "0 results";
                }

                // ปิดการเชื่อมต่อฐานข้อมูล
            
                ?>
        </select>
    </section>
    <label for="" style=" align-items: center; margin-left: 0px; margin-top: 0px;"><i
                                    class="fi fi-rr-hastag" style="margin-right: 5px;"></i>ตำบล</label>
    <section name="districts" id="districts">
        <select name="districts" class="custom-input2">
            <option value="">กรุณาเลือกตำบล</option>
            <?php
                // สร้างคำสั่ง SQL เพื่อดึงข้อมูลจากตาราง districts
                $sql3 = "SELECT id,districts_name_th FROM  districts";
                // ทำการ query ข้อมูล
                $result3 = $conn->query($sql3);

                // ตรวจสอบว่ามีข้อมูลจากการ query หรือไม่
                if ($result3->num_rows > 0) {
                    // Loop เพื่อเข้าถึงแต่ละแถวของข้อมูล
                    while ($row3 = $result3->fetch_assoc()) {
                        // สร้าง option สำหรับแต่ละอำเภอ
                        echo "<option value='" . $row3['id'] . "'>" . $row3['districts_name_th'] . "</option>";
                    }
                } else {
                    echo "0 results";
                }

                // ปิดการเชื่อมต่อฐานข้อมูล
            
                ?>
        </select>
    </section>
    <label for="" style=" align-items: center; margin-left: 0px; margin-top: 0px;"><i
                                    class="fi fi-rr-hastag" style="margin-right: 5px;"></i>รหัสไปรษณีย์</label>
    <input type="text" name="zipcode" id="zipcode" class="custom-input2" style="margin-top: 0px;">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // เมื่อมีการเลือกจังหวัด
            $('select[name="provinces"]').change(function () {
                var provinceId = $(this).val();

                // โหลดข้อมูลอำเภอ
                $.ajax({
                    url: 'getAmphures.php',
                    type: 'POST',
                    data: {provinceId: provinceId},
                    success: function (data) {
                        $('select[name="amphures"]').html(data);
                        $('select[name="districts"]').html('<option value="">กรุณาเลือกตำบล</option>');
                        $('#zipcode').val('');
                    }
                });
            });

            // เมื่อมีการเลือกอำเภอ
            $('select[name="amphures"]').change(function () {
                var amphureId = $(this).val();

                // โหลดข้อมูลตำบล
                $.ajax({
                    url: 'getDistricts.php',
                    type: 'POST',
                    data: {amphureId: amphureId},
                    success: function (data) {
                        $('select[name="districts"]').html(data);
                        $('#zipcode').val('');
                    }
                });
            });

            // เมื่อมีการเลือกตำบล
            $('select[name="districts"]').change(function () {
                var districtId = $(this).val();

                // โหลดข้อมูล zip code
                $.ajax({
                    url: 'getZipCode.php',
                    type: 'POST',
                    data: {districtId: districtId},
                    success: function (data) {
                        $('#zipcode').val(data);
                    }
                });
            });
        });
    </script>

</body>

</html>