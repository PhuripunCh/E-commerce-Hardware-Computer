<style>
.col-sm-8 {
    background-color: #fff;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
    border-radius: 5px;
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
    margin-left: auto;
    margin-right: auto;
}

th,
td {
    padding: 15px;
    text-align: center;
    border-bottom: 1px solid #ddd;
    /* เส้นขอบระหว่างแถว */

}

th {
    background-color: #f2f2f2;
    /* สีพื้นหลังของหัวตาราง */
}

</style>

<body>
    <div class="col-sm-8"><br>
        <?php
        include 'condb.php';

        // ตรวจสอบว่ามีค่า List_ID ที่ถูกส่งมาหรือไม่
        if (isset($_GET['List_ID'])) {
            $reid = $_GET['List_ID'];

            // ดึงข้อมูลลูกค้าจากตาราง customer
            $customer_sql = "SELECT * FROM customer WHERE Cus_ID = '" . $_SESSION["Cus_ID"] . "'";
            $customer_result = mysqli_query($conn, $customer_sql);
            $customer_data = mysqli_fetch_array($customer_result);

            // ดึงข้อมูลการสั่งซื้อจากตาราง orderlist
            $orderlist_sql = "SELECT * FROM orderlist WHERE List_ID = '$reid'";
            $orderlist_result = mysqli_query($conn, $orderlist_sql);
            $orderlist_data = mysqli_fetch_array($orderlist_result);

            // ดึงข้อมูลที่อยู่จากตาราง addresscus โดยใช้ Cus_ID
            $address_sql = "SELECT * FROM addresscus WHERE Cus_ID = '" . $_SESSION["Cus_ID"] . "' AND Add_status = 'DEFAULT'";
            $address_result = mysqli_query($conn, $address_sql);
            $address_data = mysqli_fetch_array($address_result);
            
                // คำนวณราคารวม
                $total = $orderlist_data['List_total'] ;
                ?>
        <div class="printable-area"><br>
            <h1 style="">ใบเสร็จการสั่งซื้อ</h1>
            <p>เลขที่การสั่งซื้อ : <?php echo $orderlist_data['List_ID']; ?></p>
            <p>ชื่อ-นามสกุล (ลูกค้า) : <?php echo $customer_data['Cus_FName'] . ' ' . $customer_data['Cus_LName']; ?>
            </p>
            <p>ที่อยู่การจัดส่งสินค้า :
                <?php echo $address_data['Add_Address'] . '<br> ' . $address_data['Add_Province'] . ' 
            ' . $address_data['Add_District'] . '  ' . $address_data['Add_Subdistrict'] . ' ' . $address_data['Add_Zip_code']; ?>
            </p>
            <p>เบอร์โทรศัพท์ : <?php echo $customer_data['Cus_tel']; ?></p>
            <!-- ตารางสินค้า -->
            <table border="1">
                <thead>
                    <tr>
                        <th>รหัสสินค้า</th>
                        <th>ชื่อสินค้า</th>
                        <th>ราคา</th>
                        <th>จำนวน</th>
                        <th>ราคารวม</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
           
           $orderdetail_sql = "SELECT d.*, p.*, o.shipping_type 
           FROM orderdetail d 
           INNER JOIN product p ON d.Pro_ID=p.Pro_ID 
           INNER JOIN orderlist o ON d.List_ID = o.List_ID 
           WHERE d.List_ID = '$reid'";
$orderdetail_result = mysqli_query($conn, $orderdetail_sql);

            
            $total_shipping_cost = 0; // เพิ่มตัวแปรเก็บค่าจัดส่งรวมทั้งหมด
            
            while ($row = mysqli_fetch_array($orderdetail_result)) {
                // ตรวจสอบ shipping_type
                $shipping_cost = 0;
                if ($row['shipping_type'] == 'NORMAL') {
                    $shipping_cost = 100; // ถ้า shipping_type เป็น NORMAL กำหนดค่าจัดส่งเป็น 100
                } elseif ($row['shipping_type'] == 'FAST') {
                    $shipping_cost = 150; // ถ้า shipping_type เป็น FAST กำหนดค่าจัดส่งเป็น 150
                }
            
                $total_shipping_cost += $shipping_cost; // เพิ่มค่าจัดส่งรวม
            
                // แสดงข้อมูลสินค้า
                ?>
                <tr>
                    <td><?php echo $row['Pro_ID'] ?></td>
                    <td><?php echo $row['Pro_Name'] ?></td>
                    <td><?php echo number_format($row['Detail_price']) ?></td>
                    <td><?php echo $row['Detail_qty'] ?></td>
                    <td><?php echo number_format($row['Total']) ?></td>
                </tr>
                <?php
            }
            
            // แสดงข้อมูลค่าจัดส่ง
            ?>
            <tr>
                <td colspan="4" style="text-align:right;">ค่าจัดส่ง</td>
                <td><?php echo number_format($total_shipping_cost); ?> บาท</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:right;">รวมเป็นเงิน</td>
                <td style="color: red; font-weight: bold;"><?php echo number_format($total ); ?> บาท</td>
            </tr>
            
                </tbody>
            </table>
        </div>

        <a href="javascript:void(0);" onclick="goBack()" class="btn btn-success">กลับ</a>

        <a href="#" class="btn btn-primary" id="printBtn">Print</a>


        <br><br>

    </div><br>
    <script>

        
        document.getElementById("printBtn").addEventListener("click", function() {
            var printableArea = document.querySelector('.printable-area').innerHTML;
            var printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Print</title></head><body>' + printableArea + '</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    </script>

    <script>
    function goBack() {
        window.history.back();
    }

    
    </script>

</body>
<?php
} else {
    // กรณีไม่มีค่า List_ID ที่ถูกส่งมา
    echo "ไม่พบข้อมูลการสั่งซื้อ";
}
?>