
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
    include 'condb.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];

        $sql = "SELECT orderlist.List_ID, customer.Cus_FName, customer.Cus_LName, DATE(orderlist.List_date) AS List_date, SUM(orderlist.List_total) AS total_sales
                FROM orderlist
                INNER JOIN customer ON orderlist.Cus_ID = customer.Cus_ID
                WHERE orderlist.List_status = 'PAY' AND DATE(orderlist.List_date) BETWEEN '$start_date' AND '$end_date'
                GROUP BY DATE(orderlist.List_date)
                ORDER BY DATE(orderlist.List_date)";

        $result = mysqli_query($conn, $sql);

        $salesData = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $salesData[] = array(
                'List_ID' => $row['List_ID'],
                'Cus_Name' => $row['Cus_FName'] . ' ' . $row['Cus_LName'],
                'List_date' => $row['List_date'],
                'total_sales' => $row['total_sales']
            );
        }

        // Create PHP arrays for chart data
        $chartLabels = array();
        $chartValues = array();

        if (isset($salesData)) {
            foreach ($salesData as $row) {
                $chartLabels[] = $row['List_date'];
                $chartValues[] = $row['total_sales'];
            }
        }
    }
    ?>
<div class="col-sm-10">
    <h1>สรุปรายงานยอดขาย</h1>
    <a href="index_ad.php?C=1&D=8" class="btn btn-outline-primary">รายงานสินค้า</a>
    <a href="index_ad.php?C=1&D=9" class="btn btn-outline-primary active">รายงานยอดขาย</a>
    <button onclick="exportToExcel()" class="btn btn-outline-success">ออกรายงาน Excel</button>
    <div style="margin-top: 10px; display: flex; align-items: center;">
        <i class="fi fi-rr-search" style="font-size: 20px;"></i>
        <form method="post" action="index_ad.php?C=1&D=11">
            <input type="date" name="start_date" class="custom-input2" style="margin-left: 10px; width: 290px; margin-right: 10px;" required>
            ถึงวันที่
            <input type="date" name="end_date" class="custom-input2" style="margin-left: 10px; width: 290px;" required>
            <button type="submit" class="btn btn-primary">ค้นหา</button>
        </form>
    </div>

    <!-- ส่วนของ dropdown เลือกวันที่ -->
    <label for="" style="font-size: 20px;">ข้อมูลกราฟรายวัน</label>
    <select id="daysDropdown" class="custom-input2" style="margin-left: 10px; width: 150px;" onchange="updateChartData()">
        <option value="1">1 วัน</option>
        <option value="7">7 วัน</option>
        <option value="14">14 วัน</option>
        <option value="30">30 วัน</option>
    </select>

    <center>
            <div style="width: 1000px;">
                <!-- ส่วนของกราฟแท่ง -->
                <canvas id="salesChart" width="800" height="400"></canvas>
            </div>
        </center>

        <table>
            <thead>
                <tr>
                    <th>เลขที่สั่งซื้อ</th>
                    <th>ราคารวม</th>
                    <th>วันที่สั่งซื้อ</th>
                    <th>รายละเอียด</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($salesData)) {
                    foreach ($salesData as $i => $row) {
                        $modalID = "myModal" . $row['List_ID'];
                ?>
                        <tr>
                            <td><?= $i + 1; ?></td>
                            <td><?= $row['total_sales'] ?></td>
                            <td><?= $row['List_date'] ?></td>
                            <td><a href=''>รายละเอียด</a></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>

        <!-- เพิ่มส่วนของ pagination ด้านล่าง -->
        <div class="pagination">
            <!-- Add your pagination code here -->
        </div>
    </div><br>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/exceljs/dist/exceljs.min.js"></script>
    <script>
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart;

        // Use PHP arrays for chart data
        var salesLabels = <?= json_encode($chartLabels); ?>;
        var salesValues = <?= json_encode($chartValues); ?>;

        function initializeChart() {
            salesChart = new Chart(ctx, {
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
        }

        function updateChartData() {
            var selectedDays = document.getElementById('daysDropdown').value;

            // Fetch data using selected days
            fetch('fetch_data.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'start_date=' + encodeURIComponent(document.querySelector('input[name="start_date"]').value) +
                        '&end_date=' + encodeURIComponent(document.querySelector('input[name="end_date"]').value) +
                        '&days=' + selectedDays,
                })
                .then(response => response.json())
                .then(data => {
                    salesLabels = [];
                    salesValues = [];

                    data.forEach(function(item) {
                        salesLabels.push(item.List_date);
                        salesValues.push(item.total_sales);
                    });

                    // Check if chart is initialized
                    if (!salesChart) {
                        initializeChart();
                    }

                    // Update chart data
                    salesChart.data.labels = salesLabels;
                    salesChart.data.datasets[0].data = salesValues;

                    // Refresh chart
                    salesChart.update();
                })
                .catch(error => console.error('Error:', error));
        }

        // Call initializeChart when the page loads
        window.onload = initializeChart;

        function exportToExcel() {
            var data = <?= json_encode($salesData); ?>;

            var xls = new ExcelJS.Workbook();
            var sheet = xls.addWorksheet('Sales Report');

            sheet.addRow(['เลขที่สั่งซื้อ', 'ราคารวม', 'วันที่สั่งซื้อ']);

            data.forEach(function(item) {
                sheet.addRow([item.List_ID, item.total_sales, item.List_date]);
            });

            xls.xlsx.writeBuffer().then(function(buffer) {
                var blob = new Blob([buffer], {
                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'Sales_Report.xlsx';
                link.click();
            });
        }
    </script>
</body>