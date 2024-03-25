<style>
.row {
    margin-left: 100px;
}

.col-sm-2 {
    background-color: #ffffff;
    border-radius: 5px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    height: 500px;
    display: flex;
    flex-direction: column;
    padding-top: 20px;
}

.col-sm-2 a {
    text-decoration: none;
    padding: 15px 30px;
    font-size: 24px;
    transition: background-color 0.3s;
    display: flex;
    align-items: center;
    /* ให้เนื้อหาอยู่ตรงกลางตามทั้งตั้งและนอน */
}

.col-sm-2 a:hover {
    background-color: #f2f2f2;
    text-align: center;
    /* ให้ข้อความอยู่ตรงกลางทั้งตัวนอนและตัวตั้ง */
    align-items: center;
    /* ให้เนื้อหาอยู่ตรงกลางตามทั้งตั้งและนอน */
}

.col-sm-2 a.active {
    font-weight: bold;
    color: red;
}

.col-sm-8 {
    margin-left: 50px;
    background-color: #ffffff;
    border-radius: 5px;
}

.col-sm-8 h1,
label,
input {
    margin-left: 120px;
    margin-top: 40px;

}

.active {
    color: #dc3545;
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

.imgbuy {
    width: 20%;
    height: auto;
}



#demo1 {
    margin-left: 25px;
}

#demo1 a {
    padding-top: 0px;
    font-size: 18px;
}

.col-sm-2 a i {
    margin-right: 5px;
    /* ปรับค่าตามที่คุณต้องการ */
}
</style>

<body>
    <div class="row">
        <div class="col-sm-2">
            <a href="index_log.php?P=1&S=2" data-bs-toggle="collapse" data-bs-target="#demo1">
                <i class="fi fi-rs-user-pen"></i> ข้อมูลส่วนตัว
            </a>

            <div id="demo1" class="collapse">
                <a href="index_log.php?P=1&S=2" style="font-size: 18px; padding-top: 15px; align-items: center;">
                    <i class="fi fi-rs-user-pen"></i> แก้ไขข้อมูลส่วนตัว
                </a>
                <a href="index_log.php?P=1&S=8" style="font-size: 18px; padding-top: 15px; align-items: center;">
                    <i class="fi fi-rr-marker"></i> ที่อยู่ส่งจัดส่ง
                </a>
            </div>

            <a href="index_log.php?P=1&S=3">
                <i class="fi fi-rs-shipping-fast"></i> สถานะการจัดส่ง
            </a>

            <a href="index_log.php?P=1&S=4" class="active">
                <i class="fi fi-rr-time-forward"></i> ประวัติการสั่งซื้อ
            </a>
        </div>

        <div class="col-sm-8" style="width: 75%;">
            <h1>ประวัติการสั่งซื้อ</h1>
            <div>
                <center>
                    <table>
                        <thead>
                            <tr>
                                <th>รายการที่</th>
                                <th>เลขที่สั่งซื้อ</th>
                                <th>ชื่อลูกค้า</th>
                                <th>ที่อยู่จัดส่ง</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th>ราคารวม</th>
                                <th>วันที่สั่งซื้อ</th>
                                <th>สถานะการชำระเงิน</th>
                                <th>รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    include 'condb.php';
                                    $cusID = $_SESSION["Cus_ID"];
                                    $sql = "SELECT List_ID, Cus_ID, List_total, List_status, List_date
                                            FROM orderlist
                                            WHERE Cus_ID = '$cusID'";
                                    $result = mysqli_query($conn, $sql);

                                    $rows_per_page = 5; // จำนวนรายการต่อหน้า
                                    $total_rows = mysqli_num_rows($result);
                                    $total_pages = ceil($total_rows / $rows_per_page); // จำนวนหน้าทั้งหมด

                                    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                                        $current_page = $_GET['page'];
                                    } else {
                                        $current_page = 1;
                                    }

                                    $start_row = ($current_page - 1) * $rows_per_page;
                                    $sql_pagination = "SELECT o.List_ID, o.Cus_ID, c.Cus_FName, c.Cus_tel, c.Cus_LName,
                                                        o.List_total, o.List_status, o.List_date,
                                                        a.Add_Province, a.Add_District, a.Add_Zip_code, a.Add_Address
                                                        FROM orderlist o
                                                        JOIN customer c ON o.Cus_ID = c.Cus_ID
                                                        LEFT JOIN addresscus a ON o.Cus_ID = a.Cus_ID
                                                        WHERE o.Cus_ID = '$cusID' AND a.Add_status = 'DEFAULT'
                                                        ORDER BY o.List_ID DESC
                                                        LIMIT $start_row, $rows_per_page";
                                    $result_pagination = mysqli_query($conn, $sql_pagination);

                                    if (mysqli_num_rows($result_pagination) > 0) {
                                        // คำนวณลำดับเริ่มต้นของหน้านั้น ๆ โดยหักลำดับของข้อมูลที่แสดงออก
                                        $start_order = $total_rows - ($start_row + 1);
                                        $i = $start_order + 1; // เริ่มต้นที่ลำดับที่คำนวณได้
                                        while ($row = mysqli_fetch_assoc($result_pagination)) {
                                            $modalID = "myModal" . $row['List_ID'];
                                            $PayStatusText = '';

                                            switch ($row['List_status']) {
                                                case 'NOTPAY':
                                                    $PayStatusText = 'รอการอนุมัติ';
                                                    break;
                                                case 'PAY':
                                                    $PayStatusText = 'ชำระเงินเสร็จสิ้น';
                                                    break;
                                            }
                                ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['List_ID']; ?></td>
                                <td style="width: 15%;">
                                    <?php echo $row['Cus_FName']; ?>-<?php echo $row['Cus_LName']; ?></td>
                                <td style="width: 25%;">
                                    <?php echo $row['Add_Address']; ?><br>จังหวัด<?php echo $row['Add_Province']; ?>,อำเภอ<?php echo $row['Add_District']; ?>,รหัสไปรษณีย์<?php echo $row['Add_Zip_code']; ?>
                                </td>
                                <td><?php echo $row['Cus_tel']; ?></td>
                                <td><?php echo $row['List_total']; ?></td>
                                <td><?php echo $row['List_date']; ?></td>
                                <td><?php echo $PayStatusText; ?></td>

                                <td><a
                                        href="index_log.php?P=1&S=10&List_ID=<?php echo $row['List_ID']; ?>" class="btn btn-primary">รายละเอียด</a>
                                </td>
                            </tr>
                            <?php
                                    $i--; // ลดค่า $i เพื่อนับลำดับลงมา
                                }
                            } else {
                                echo "<tr><td colspan='8'>ยังไม่มีประวัติการสั่งซื้อ</td></tr>";
                            }
                        ?>
                        </tbody>
                    </table>

                    <div class="pagination">
                        <?php
                            if ($current_page > 1) {
                                echo "<li class='page-item'><a class='page-link' href='index_log.php?P=1&S=4&page=" . ($current_page - 1) . "'>&#9664; ก่อนหน้า</a></li>";
                            }

                            for ($page = 1; $page <= $total_pages; $page++) {
                                if ($page == $current_page) {
                                    echo "<li class='page-item active'><a class='page-link' href='#'>$page</a></li>";
                                } else {
                                    echo "<li class='page-item'><a class='page-link' href='index_log.php?P=1&S=4&page=$page'>$page</a></li>";
                                }
                            }

                            if ($current_page < $total_pages) {
                                echo "<li class='page-item'><a class='page-link' href='index_log.php?P=1&S=4&page=" . ($current_page + 1) . "'>ต่อไป &#9654;</a></li>";
                            }
                        ?>
                    </div>
                    <br>
                </center>

            </div>
        </div>

    </div>
</body><br>