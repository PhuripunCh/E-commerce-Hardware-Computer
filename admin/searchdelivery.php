<style>
.col-sm-10 {
    margin-left: 170px;
    background-color: #ffffff;
    border-radius: 10px;
    padding: 30px;
}

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

table {
    width: 90%;
    border-collapse: collapse;
    border-radius: 15px;
    /* ความโค้งของมุม */
    overflow: hidden;
    /* ทำให้มุมโค้งไม่ถูกตัดตอนแสดงผล */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* เงาที่เพิ่มความลึก */
    margin: 20px 0;
    /* ระยะห่างของตารางจากขอบบนและล่าง */
    margin-right: auto;
    margin-left: auto;
}

th,
td {
    padding: 15px;
    text-align: center;
    border-bottom: 1px solid #ddd;
    /* เส้นขอบระหว่างแถว */
    border: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
    /* สีพื้นหลังของหัวตาราง */
}
</style>
<body>
    <div class="col-sm-10">
        <div style="display: flex; align-items: center;">
            <div style="margin-left: 40px;">
                <h1>ข้อมูลการจัดส่งสินค้า</h1>
                <div style=" margin-top: 10px;">
                    <form method="post" action="index_ad.php?C=1&D=17">
                        <i class="fi fi-rr-search" style="font-size: 20px; margin-top: 20px;"></i>
                        <input type="date" name="start_date" class="custom-input2"
                            style="margin-left: 10px; width: 290px; margin-right: 10px;" required>
                        ถึงวันที่
                        <input type="date" name="end_date" class="custom-input2"
                            style="margin-left: 10px; width: 290px;" required>
                        <button type="submit" class="btn btn-primary">ค้นหา</button>
                    </form>
                </div>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>เลขที่สั่งซื้อ</th>
                    <th style="width: 13%;">ชื่อลูกค้า</th>
                    <th style="width: 25%;">ที่อยู่จัดส่ง</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>วันที่จัดส่ง</th>
                    <th>ปรับสถานะการจัดส่ง</th>
                    <th>สถานะการจัดส่ง</th>
                    <th style="width: 13%;">เลขพัสดุ</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                include 'condb.php';

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $start_date = $_POST['start_date'];
                    $end_date = $_POST['end_date'];

                    $sql_pagination = "SELECT o.List_ID, o.Cus_ID, c.Cus_FName, c.Cus_LName, c.Cus_tel, s.Ship_status, s.Ship_tag, s.Ship_date, s.Ship_ID
                    FROM orderlist o
                    JOIN customer c ON o.Cus_ID = c.Cus_ID
                    JOIN shipping s ON o.List_ID = s.List_ID
                    WHERE s.Ship_date BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59'
                    ORDER BY o.List_ID DESC";
                    $result_pagination = mysqli_query($conn, $sql_pagination);

                    // Loop through the retrieved data
                    while ($row = mysqli_fetch_assoc($result_pagination)) {
                        $modalID = "myModal" . $row['List_ID'];
                                    $modalID1 = "detailModal" . $row['List_ID'];
                                    $sql_address = "SELECT Add_Address, Add_Province, Add_District, Add_Zip_code
                                                    FROM addresscus
                                                    WHERE Cus_ID = {$row['Cus_ID']} AND Add_Status = 'DEFAULT'";
                                    $result_address = mysqli_query($conn, $sql_address);
                                    $row_address = mysqli_fetch_assoc($result_address);
                        ?>
                <tr>
                    <td><?= $row['List_ID'] ?></td>
                    <td><?= $row['Cus_FName'] . " " . $row['Cus_LName'] ?></td>
                    <td><?= $row_address['Add_Address'] . " " . $row_address['Add_Province'] . " " . $row_address['Add_District'] . " " . $row_address['Add_Zip_code'] ?>
                    </td>
                    <td><?= $row['Cus_tel'] ?></td>
                    <td><?= $row['Ship_date'] ?></td>
                    <td><a href='#statusModal' data-bs-toggle='modal'
                            data-bs-target='#<?php echo $modalID; ?>'>ปรับสถานะ</a></td>
                    <td><?= $shipStatusText ?></td>
                    <td><?= $row['Ship_tag'] ?></td>
                </tr>

                <!-- The Modal -->
                <div class="modal fade" id="<?php echo $modalID; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">ปรับสถานะ</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal Body -->
                            <div class="modal-body">
                                <!-- สร้าง form สำหรับการเลือกปรับสถานะ -->
                                <form action="editship.php" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="Ship_status" class="form-label">ปรับสถานะใหม่:</label>
                                        <select class="form-select" id="Ship_status" name="Ship_status" required>
                                            <option value="PREPARE"
                                                <?php echo ($row['Ship_status'] == 'PREPARE') ? 'selected' : ''; ?>>
                                                กำลังเตรียมสินค้า</option>
                                            <option value="SHIPPING"
                                                <?php echo ($row['Ship_status'] == 'SHIPPING') ? 'selected' : ''; ?>>
                                                กำลังจัดส่ง</option>
                                            <option value="SUCCESS"
                                                <?php echo ($row['Ship_status'] == 'SUCCESS') ? 'selected' : ''; ?>>
                                                จัดส่งสำเร็จ</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="Ship_status" class="form-label">เพิ่มเลขพัสดุ:</label>
                                        <input type="text" class="custom-input2" id="Ship_tag" placeholder="เลขพัสดุ"
                                            name="Ship_tag" value="<?php echo $row['Ship_tag']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Ship_date" class="form-label">วันที่และเวลา:</label>
                                        <input type="datetime-local" class="form-control" id="Ship_date"
                                            name="Ship_date"
                                            value="<?php echo date('Y-m-d\TH:i', strtotime($row['Ship_date'])); ?>">
                                    </div>

                                    <input type="hidden" id="Ship_ID" name="Ship_ID"
                                        value="<?php echo $row['Ship_ID']; ?>">

                                    <button type="submit" class="btn btn-primary"
                                        style="margin-left: 370px;">บันทึก</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <?php
                        }
                    } else {
                        ?>
                <tr>
                    <td colspan='9'>ไม่พบข้อมูล</td>
                </tr>
                <?php
                    }
                    // Free result set
                    mysqli_free_result($result_pagination);
                ?>
            </tbody>
        </table>
        


    </div><br>
</body>