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
    width: 100%;
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
                <h1>รายงานการขาย<span style="color: green;"> (ชำระเงินเสร็จสิน)</span></h1>

                <!-- Dropdown button for report options -->
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="reportOptions"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        รายงาน
                    </button>
                    <div class="dropdown-menu" aria-labelledby="reportOptions">
                        <a class="dropdown-item" href="index_ad.php?C=1&D=4">ยังไม่ชำระเงิน</a>
                        <a class="dropdown-item" href="index_ad.php?C=1&D=5">ชำระเงินเสร็จสิน</a>
                        <a class="dropdown-item" href="index_ad.php?C=1&D=6">ยกเลิกรายการ</a>
                    </div>
                </div>

                <div style="margin-top: 10px; display: flex; align-items: center;">
                    <i class="fi fi-rr-search" style="font-size: 20px; margin-right: 10px;"></i>
                    <form action="index_ad.php?C=1&D=15" method="post">
                        <input type="date" name="start_date" class="custom-input2" placeholder="วว/ดด/ปปปป"
                            style="width: 290px; margin-right: 10px;">
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
                    <th>ชื่อลูกค้า</th>
                    <th>ที่อยู่จัดส่ง</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>ราคารวม</th>
                    <th>วันที่สั่งซื้อ</th>
                    <th>สถานะการชำระเงิน</th>
                    <th>รายละเอียด</th>
                    <th>ปรับสถานะ</th>

                </tr>
            </thead>
            <tbody>
                <?php
                include 'condb.php';
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $start_date = $_POST['start_date'];
                    $end_date = $_POST['end_date'];
               
                $sql_pagination = "SELECT o.List_ID, o.Cus_ID, c.Cus_FName, c.Cus_tel, c.Cus_LName, 
                                           o.List_total, o.List_status, o.List_date, o.Pay_img
                                    FROM orderlist o
                                    JOIN customer c ON o.Cus_ID = c.Cus_ID
                                    WHERE o.List_status = 'PAY'  
                                    AND o.List_date BETWEEN '$start_date' AND '$end_date'
                                    ";
                $result_pagination = mysqli_query($conn, $sql_pagination);
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
                    <td><?php echo $row['List_ID']; ?></td>
                    <td style="width: 15%;"><?php echo $row['Cus_FName']; ?>-<?php echo $row['Cus_LName']; ?></td>
                    <td style="width: 25%;">
                        <?php echo $row_address['Add_Address']; ?><br>จังหวัด<?php echo $row_address['Add_Province']; ?>,
                        อำเภอ<?php echo $row_address['Add_District']; ?>,รหัสไปรษณีย์<?php echo $row_address['Add_Zip_code']; ?>
                    </td>
                    <td><?php echo $row['Cus_tel']; ?></td>
                    <td><?php echo number_format($row['List_total']);?></td>
                    <td><?php echo $row['List_date']; ?></td>
                    <td><?php
           
                   // ตรวจสอบค่า List_status
                   if ($row['List_status'] == 'PAY') {
                    echo 'ชำระเงินเสร็จสิน';
                } else {
                    echo $row['List_status'];
                }
                    ?></td>
                    <td style="width: 8%;">
                        <center><a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                style="display: flex; width: 105px; "
                                data-bs-target="#<?php echo $modalID1; ?>">รายละเอียด</a>
                        </center>
                    </td>
                    <td style="width: 8%;">
                        <center><a href="#" class="btn btn-warning" data-bs-toggle="modal"
                                style="display: flex; width: 100px;"
                                data-bs-target="#<?php echo $modalID; ?>">ปรับสถานะ</a>
                        </center>
                    </td>

                </tr>
                <div class="modal fade" id="<?php echo $modalID; ?>">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">เลขที่สั่งซื้อ <?php echo $row['List_ID']; ?></h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Add other details as needed -->
                                <form action="adjuststatus.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="List_ID" value="<?php echo $row['List_ID']; ?>">
                                    <div style="margin-top: 10px;">
                                        <div>
                                            <label>ปรับสถานะ:</label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="radio" name="List_status" value="NOTPAY"
                                                    <?php echo ($row['List_status'] == 'NOTPAY') ? 'checked' : ''; ?>>
                                                ยังไม่ชำระเงิน
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="radio" name="List_status" value="PAY"
                                                    <?php echo ($row['List_status'] == 'PAY') ? 'checked' : ''; ?>>
                                                ชำระเงินเสร็จสิน
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="radio" name="List_status" value="CANCEL"
                                                    <?php echo ($row['List_status'] == 'CANCEL') ? 'checked' : ''; ?>>
                                                ยกเลิกรายการ
                                            </label>
                                        </div>
                                    </div>

                                    <div style="margin-top: 10px;">
                                        <button type="submit" class="btn btn-success"
                                            style="width: 30%; margin-left: 300px;">บันทึก</button>

                                    </div>
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="<?php echo $modalID1; ?>">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">เลขที่สั่งซื้อ <?php echo $row['List_ID']; ?></h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <p>ยอดรวมราคาสินค้า <?php echo number_format($row['List_total']);?> บาท</p>
                                    <center><img src="../PayImage/<?php echo $row['Pay_img']; ?>" alt=""
                                            style="width: 70%; "></center>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
            }
                ?>
            </tbody>
        </table>
       
    </div><br>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า updatestat_success ใน Session หรือไม่
        const updatestat_successParam =
            <?php echo isset($_SESSION['updatestat_success']) ? $_SESSION['updatestat_success'] : '0'; ?>;

        // ถ้ามีค่า updatestat_success, ให้แสดง SweetAlert2
        if (updatestat_successParam === 1) {
            Swal.fire({
                icon: 'success',
                title: 'อัพเดทสถานะสำเร็จ',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า updatestat_success ใน Session
            <?php unset($_SESSION['updatestat_success']); ?>
        }
    });
    </script>
</body>