<body>
    <div class="col-sm-10">
        <div style="display: flex; align-items: center;">
            <div style="margin-left: 40px;">
                <h1>สรุปการขายสินค้า</h1>
                <a href="index_ad.php?C=1&D=8" class="btn btn-outline-primary active">รายงานสินค้า</a>
                <a href="index_ad.php?C=1&D=9" class="btn btn-outline-primary">รายงานยอดขาย</a><br>
                <div style=" margin-top: 10px; display: flex; align-items: center;">
                    <i class="fi fi-rr-search" style="font-size: 20px; margin-right: 10px;"></i>
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

$rows_per_page = 10; // จำนวนรายการต่อหน้า

// เขียน SQL Query เพื่อดึงข้อมูลจากตาราง orderdetail และ product
$sql = "SELECT o.Pro_ID, p.Pro_Name, p.Pro_Image , p.Cate_ID, c.Cate_Name, SUM(o.Detail_qty) AS total_sold_qty
        FROM orderdetail o
        JOIN product p ON o.Pro_ID = p.Pro_ID
        JOIN category c ON p.Cate_ID = c.Cate_ID
        GROUP BY o.Pro_ID";
$result = mysqli_query($conn, $sql);

$total_rows = mysqli_num_rows($result);
$total_pages = ceil($total_rows / $rows_per_page); // จำนวนหน้าทั้งหมด

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = $_GET['page'];
} else {
    $current_page = 1;
}

$start_row = ($current_page - 1) * $rows_per_page;

// ทำคำสั่ง SQL เพื่อดึงข้อมูลตามหน้า
$sql_pagination = "SELECT o.Pro_ID, p.Pro_Name, p.Pro_Image, p.Cate_ID, c.Cate_Name, SUM(o.Detail_qty) AS total_sold_qty
                    FROM orderdetail o
                    JOIN product p ON o.Pro_ID = p.Pro_ID
                    JOIN category c ON p.Cate_ID = c.Cate_ID
                    GROUP BY o.Pro_ID
                    LIMIT $start_row, $rows_per_page";

$result_pagination = mysqli_query($conn, $sql_pagination);

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
                        <td style="width: 20%;"><img src="../img/<?php echo $row['Pro_Image']; ?>" alt="" style="max-width: 30%;"></td>
                        <td><?php echo $row['Pro_ID']; ?></td>
                        <td><?php echo $row['Pro_Name']; ?></td>
                        <td><?php echo $row['Cate_Name']; ?></td>
                        <td><?php echo $row['total_sold_qty']; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <div class="pagination" style="margin-left: 40px;">
        <?php
        if ($current_page > 1) {
            echo "<li class='page-item'><a class='page-link' href='?C=1&D=8&page=" . ($current_page - 1) . "'>&#9664; ก่อนหน้า</a></li>";
        }

        for ($page = 1; $page <= $total_pages; $page++) {
            if ($page == $current_page) {
                echo "<li class='page-item active'><a class='page-link' href='#'>$page</a></li>";
            } else {
                echo "<li class='page-item'><a class='page-link' href='?C=1&D=8&page=$page'>$page</a></li>";
            }
        }

        if ($current_page < $total_pages) {
            echo "<li class='page-item'><a class='page-link' href='?C=1&D=8&page=" . ($current_page + 1) . "'>ต่อไป &#9654;</a></li>";
        }
        ?>
    </div>
    </div><br>
   
 
</body>