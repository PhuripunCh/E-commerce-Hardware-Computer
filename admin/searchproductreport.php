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
                <h1>สรุปการขายสินค้า</h1>
                <a href="index_ad.php?C=1&D=8" class="btn btn-outline-primary active">รายงานสินค้า</a>
                <a href="index_ad.php?C=1&D=9" class="btn btn-outline-primary">รายงานยอดขาย</a><br>
                <div style=" margin-top: 10px; display: flex; align-items: center;">
                    <i class="fi fi-rr-search" style="font-size: 20px; "></i>
                    <form action="index_ad.php?C=1&D=16" method="post">
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
        <center>
            <div style="width: 500px; ">

                <canvas id="myChart" width="200" height="200"></canvas>

            </div>
        </center>
        <table>
            <thead>
                <tr>
                    <th>รูปภาพสินค้า</th>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>หมวดหมู่</th>
                    <th>จำนวนที่ขายได้</th>
                </tr>
            </thead>
            <tbody>
                <?php
include 'condb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // SQL query to retrieve data within specified date range
    $sql = "SELECT o.Pro_ID, p.Pro_Name, p.Pro_Image , p.Cate_ID, c.Cate_Name , o.List_ID, ol.List_date, SUM(o.Detail_qty) AS total_sold_qty
            FROM orderdetail o
            JOIN orderlist ol ON o.List_ID = ol.List_ID
            JOIN product p ON o.Pro_ID = p.Pro_ID
            JOIN category c ON p.Cate_ID = c.Cate_ID
            WHERE ol.List_date BETWEEN '$start_date' AND '$end_date'
            GROUP BY o.Pro_ID";
    $result = mysqli_query($conn, $sql);

    $category_data = array();

    // วนลูปเพื่อดึงข้อมูลและนับจำนวนทั้งหมด
    while ($row = mysqli_fetch_assoc($result)) {
        $category_name = $row['Cate_Name'];
        $total_sold_qty = $row['total_sold_qty'];

        // เพิ่มจำนวนที่ขายได้ในหมวดหมู่นี้
        if (isset($category_data[$category_name])) {
            $category_data[$category_name] += $total_sold_qty;
        } else {
            $category_data[$category_name] = $total_sold_qty;
        }


?>

                <tr>
                    <td style="width: 20%;"><img src="../img/<?php echo $row['Pro_Image']; ?>" alt=""
                            style="max-width: 30%;"></td>
                    <td><?php echo $row['Pro_ID']; ?></td>
                    <td><?php echo $row['Pro_Name']; ?></td>
                    <td><?php echo $row['Cate_Name']; ?></td>
                    <td><?php echo $row['total_sold_qty']; ?></td>
                </tr>
                <?php
                }
            }
                ?>
            </tbody>
        </table>

    </div><br>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // ข้อมูลจาก PHP ให้เขียนลงใน JavaScript
    var category_data = <?php echo json_encode($category_data); ?>;

    // สร้าง Canvas สำหรับแสดงกราฟ
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: Object.keys(category_data),
            datasets: [{
                label: 'จำนวนสินค้าที่ขายได้',
                data: Object.values(category_data),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
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
</body>