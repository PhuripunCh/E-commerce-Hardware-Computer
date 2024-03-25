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
                <h1>รายงานการขาย<span style="color: blue;"> (ยังไม่ชำระเงิน)</span></h1>

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
                    <i class="fi fi-rr-search" style="font-size: 20px; margin-right: 10px; margin-top: -5px;"></i>
                    <form action="index_ad.php?C=1&D=14" method="post">
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
                $sql = "SELECT List_ID, Cus_ID, List_total, List_status, List_date
                        FROM orderlist
                        WHERE List_status = 'NOTPAY'";
                $result = mysqli_query($conn, $sql);

                $rows_per_page = 10; // จำนวนรายการต่อหน้า
                $total_rows = mysqli_num_rows($result);
                $total_pages = ceil($total_rows / $rows_per_page); // จำนวนหน้าทั้งหมด

                if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                    $current_page = $_GET['page'];
                } else {
                    $current_page = 1;
                }
                $start_row = ($current_page - 1) * $rows_per_page;
                $sql_pagination = "SELECT o.List_ID, o.Cus_ID, c.Cus_FName, c.Cus_tel, c.Cus_LName,  o.List_total, o.List_status, o.List_date, o.Pay_img
                                    FROM orderlist o
                                    JOIN customer c ON o.Cus_ID = c.Cus_ID
                                    WHERE o.List_status = 'NOTPAY'
                                    ORDER BY o.List_date DESC  -- เพิ่มเงื่อนไขนี้
                                    LIMIT $start_row, $rows_per_page";
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
                    if ($row['List_status'] == 'NOTPAY') {
                        echo 'รอการอนุมัติ';
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
                <style>
                .product-item {
                    border-bottom: 1px solid #ccc;
                    /* เพิ่มเส้นกั้นด้านล่าง */
                    padding-bottom: 20px;
                    /* เพิ่มระยะห่างด้านล่าง */
                    margin-bottom: 20px;
                    /* เพิ่มระยะห่างระหว่างรายการสินค้า */
                    display: flex;
                    /* ให้แสดงผลแบบ flexbox */
                    align-items: center;
                    /* จัดให้ส่วนประกอบอยู่กึ่งกลางแนวตั้ง */
                }

                .product-item img {
                    width: 30%;
                    /* กำหนดขนาดของรูปภาพสินค้า */
                    border-radius: 8px;
                    /* มุมโค้งของรูปภาพ */
                    margin-right: 20px;
                    /* ระยะห่างด้านขวาของรูปภาพ */
                }

                .product-info {
                    flex-grow: 1;
                    /* ขยายขนาดเต็มพื้นที่ที่เหลือของ container */
                }
                </style>

                <div class="modal fade" id="<?php echo $modalID1 ?>">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">เลขที่สั่งซื้อ <?php echo $row['List_ID'] ?></h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <h5>ยอดรวมราคาสินค้าและค่าจัดส่ง <?php echo number_format($row['List_total']) ?> บาท
                                        <h5>
                                            <center><img src="../PayImage/<?php echo $row['Pay_img'] ?>" alt=""
                                                    style="width: 70%; border-radius: 8px;"></center>
                                </div>

                                <?php
                                // ดึงข้อมูลรายการสินค้าใน orderdetail ที่ตรงกับ List_ID
                                $sql_orderdetail = "SELECT p.Pro_Name , p.Pro_Image, od.Total, od.Detail_qty
                                                    FROM orderdetail od
                                                    JOIN product p ON od.Pro_ID = p.Pro_ID
                                                    WHERE od.List_ID = {$row['List_ID']}";
                                $result_orderdetail = mysqli_query($conn, $sql_orderdetail);

                                // แสดงรายการสินค้า
                                if (mysqli_num_rows($result_orderdetail) > 0) { 
                                    ?><br>
                                <h5>รายการสินค้า:</h5>

                                <?php while ($row_orderdetail = mysqli_fetch_assoc($result_orderdetail)) { ?>
                                <div class="product-item">
                                    <!-- เพิ่มคลาสสำหรับรายการสินค้า -->
                                    <img src="../uploads/<?= $row_orderdetail['Pro_Image'] ?>" alt="">
                                    <div class="product-info">
                                        <!-- ส่วนข้อมูลของสินค้า -->
                                        <p><?= $row_orderdetail['Pro_Name'] ?></p>
                                        <p>จำนวน: <?= $row_orderdetail['Detail_qty'] ?> ชิ้น</p>
                                        <p>ราคา: <?php echo number_format($row_orderdetail['Total']) ?> บาท</p>
                                    </div>
                                </div>
                                <?php } ?>

                                <?php } else { ?>
                                <p>ไม่พบรายการสินค้า</p>
                                <?php } ?>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php
                if ($current_page > 1) {
                    $prevPage = $current_page - 1;
                    echo "<li class='page-item'><a class='page-link' href='?page=$prevPage&C=1&D=4'>&#9664; ก่อนหน้า</a></li>";
                }

                for ($page = 1; $page <= $total_pages; $page++) {
                    if ($page == $current_page) {
                        echo "<li class='page-item active'><a class='page-link' href='#'>$page</a></li>";
                    } else {
                        echo "<li class='page-item'><a class='page-link' href='?page=$page&C=1&D=4'>$page</a></li>";
                    }
                }

                if ($current_page < $total_pages) {
                    $nextPage = $current_page + 1;
                    echo "<li class='page-item'><a class='page-link' href='?page=$nextPage&C=1&D=4'>ต่อไป &#9654;</a></li>";
                }
            ?>
        </div>
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