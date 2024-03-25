
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

.result-container {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}

.result-table {
    margin-left: 40px;
}
</style>

<body>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST["start_date"]) && isset($_POST["end_date"])) {
    $_SESSION['start_date'] = $_POST["start_date"];
    $_SESSION['end_date'] = $_POST["end_date"];
}

include 'condb.php';

$start_date = isset($_SESSION["start_date"]) ? $_SESSION["start_date"] : null;
$end_date = isset($_SESSION["end_date"]) ? $_SESSION["end_date"] : null;

// ทำคำสั่ง SQL เพื่อนับจำนวนรายการทั้งหมด
$sql_count_all = "SELECT COUNT(*) AS total FROM orderlist WHERE List_date BETWEEN '$start_date' AND '$end_date'";
$result_count_all = $conn->query($sql_count_all);
$row_count_all = $result_count_all->fetch_assoc();
$total_all_rows = $row_count_all['total'];

// ทำคำสั่ง SQL เพื่อคำนวณราคารวมทั้งหมด
$sql_all_data = "SELECT *, SUM(List_total) AS totalSalesAll FROM orderlist WHERE List_date BETWEEN '$start_date' AND '$end_date'";
$result_all_data = $conn->query($sql_all_data);
$row_all_data = $result_all_data->fetch_assoc();
$totalSalesAll = $row_all_data["totalSalesAll"];

$rows_per_page = 10;
$total_pages = ceil($total_all_rows / $rows_per_page);

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = $_GET['page'];
} else {
    $current_page = 1;
}

$start_row = ($current_page - 1) * $rows_per_page;
?>

<div class="col-sm-10">
    <div style="display: flex; align-items: center;">
        <div style="margin-left: 40px;">
            <h1>สรุปรายงานยอดขาย</h1>
            <a href="index_ad.php?C=1&D=8" class="btn btn-outline-primary">รายงานสินค้า</a>
            <a href="index_ad.php?C=1&D=9" class="btn btn-outline-primary active">รายงานยอดขาย</a><br>
            <div style="margin-top: 10px; display: flex; align-items: center;">
                <i class="fi fi-rr-search" style="font-size: 20px;"></i>
                <form method="post" action="index_ad.php?C=1&D=11">
                    <input type="date" name="start_date" class="custom-input2"
                        style="margin-left: 10px; width: 290px; margin-right: 10px;" required
                        value="<?php echo isset($_SESSION['start_date']) ? $_SESSION['start_date'] : ''; ?>">
                    ถึงวันที่
                    <input type="date" name="end_date" class="custom-input2"
                        style="margin-left: 10px; width: 290px;" required
                        value="<?php echo isset($_SESSION['end_date']) ? $_SESSION['end_date'] : ''; ?>">
                    <button type="submit">ค้นหา</button>
                </form>
            </div>
        </div>
    </div>
    <center>
            <div style="width: 1000px;">
                <!-- ส่วนของกราฟแท่ง -->
                <canvas id="salesChart" width="800" height="400"></canvas>
            </div>
        </center>
    <div class="result-table">
        <h2>ผลลัพธ์การค้นหา</h2>
        <?php
    // ทำคำสั่ง SQL เพื่อนับจำนวนรายการทั้งหมด
    $sql_count_all = "SELECT COUNT(*) AS total FROM orderlist WHERE List_date BETWEEN '$start_date' AND '$end_date'";
    $result_count_all = $conn->query($sql_count_all);
    $row_count_all = $result_count_all->fetch_assoc();
    $total_all_rows = $row_count_all['total'];
    
    // แสดงจำนวนรายการทั้งหมด
    echo '<p>พบข้อมูลทั้งหมด: ' . $total_all_rows . ' รายการ</p>';
    ?>
        <table>
            <thead>
                <tr>
                <th>เลขที่สั่งซื้อ</th>
                    <th>ชื่อลูกค้า</th>
                    <th>ราคารวม</th>
                    <th>วันที่สั่งซื้อ</th>
                    <th>รายละเอียด</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $totalSales= 0;
                // ตรวจสอบว่ามีค่าหรือไม่
                if ($start_date && $end_date) {
                    $sql_pagination = "SELECT * FROM orderlist WHERE List_date BETWEEN '$start_date' AND '$end_date' LIMIT $start_row, $rows_per_page";
                    $result_pagination = $conn->query($sql_pagination);

                    // แสดงผลลัพธ์
                    while ($row = $result_pagination->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row["List_ID"]; ?></td>
                            <td><?php echo $row["Cus_ID"]; ?></td>
                            <td><?php echo number_format($row["List_total"], 2); ?></td>
                            <td><?php echo $row["List_date"]; ?></td>
                            <td><a href=''>รายละเอียด</a></td>
                        </tr>
                        <?php
                        $totalSales += $row["List_total"];
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
    // แสดงราคารวมทั้งหมด
    echo '<h3 style="margin-left: 40px;">ราคารวมทั้งหมด: ' . number_format($totalSalesAll, 2) . ' บาท</h3>';
    ?>
    <div class="pagination" style="margin-left: 40px;">
        <?php
        if ($current_page > 1) {
            echo "<li class='page-item'><a class='page-link' href='?C=1&D=11&page=" . ($current_page - 1) . "'>&#9664; ก่อนหน้า</a></li>";
        }

        for ($page = 1; $page <= $total_pages; $page++) {
            if ($page == $current_page) {
                echo "<li class='page-item active'><a class='page-link' href='#'>$page</a></li>";
            } else {
                echo "<li class='page-item'><a class='page-link' href='?C=1&D=11&page=$page'>$page</a></li>";
            }
        }

        if ($current_page < $total_pages) {
            echo "<li class='page-item'><a class='page-link' href='?C=1&D=11&page=" . ($current_page + 1) . "'>ต่อไป &#9654;</a></li>";
        }
        ?>
    </div>
</div><br>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/exceljs/dist/exceljs.min.js"></script>
    <!-- สคริปต์สำหรับสร้างกราฟแท่ง -->
    <script>
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: salesLabels,
            datasets: [{
                label: 'ยอดขาย',
                data: salesValues,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
    <script>
        function exportToExcel() {
            var data = <?= json_encode($salesData); ?>;

            var xls = new ExcelJS.Workbook();
            var sheet = xls.addWorksheet('Sales Report');

            sheet.addRow(['เลขที่สั่งซื้อ', 'ราคารวม', 'วันที่สั่งซื้อ']);

            data.forEach(function (item) {
                sheet.addRow([item.List_ID, item.total_sales, item.List_date]);
            });

            xls.xlsx.writeBuffer().then(function (buffer) {
                var blob = new Blob([buffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'Sales_Report.xlsx';
                link.click();
            });
        }
    </script>
    <script>
        // ฟังก์ชันที่จะถูกเรียกเมื่อมีการเปลี่ยนค่าใน dropdown หรือคลิกที่ปุ่ม "ค้นหา"
        function updateChartData() {
            var selectedDays = document.getElementById('daysDropdown').value;

            // เรียกใช้งาน fetch เพื่อดึงข้อมูลจากฐานข้อมูลตามวันที่ที่เลือก
            fetch('fetch_data.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'days=' + selectedDays,
                })
                .then(response => response.json())
                .then(data => {
                    // อัปเดตข้อมูลกราฟ
                    salesLabels = [];
                    salesValues = [];

                    data.forEach(function(item) {
                        salesLabels.push(item.List_date);
                        salesValues.push(item.total_sales); // ใช้ total_sales ที่รวมยอดขายแล้ว
                    });

                    // อัปเดตข้อมูลกราฟ
                    salesChart.data.labels = salesLabels;
                    salesChart.data.datasets[0].data = salesValues;

                    // รีเฟรชกราฟ
                    salesChart.update();
                })
                .catch(error => console.error('เกิดข้อผิดพลาด:', error));
        }
        </script>
</body>