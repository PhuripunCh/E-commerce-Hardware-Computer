<?php

include 'session2.php';
include 'condb.php'; 
/*
$id=$_GET['id'];
$sql = "SELECT * FROM product WHERE Pro_ID='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
*/
?>
<style>
.col-sm-10 {
    margin-left: 170px;
    background-color: #ffffff;
    border-radius: 5px;
    padding: 30px;
}

.col-sm-3 {
    background-color: #ECECEC;
    border-radius: 5px;
    margin-left: 30px;

}

.add .col-sm-8 {
    border: 1px solid #ddd;
    border-radius: 5px;

    padding: 20px;
}

.address {

    border: 1px solid #ddd;
    border-radius: 5px;
}

.address a {
    text-decoration: none;

}

.shipbox {
    background-color: #f0f0f0;
    /* สีพื้นหลัง */
    padding: 15px;
    /* ระยะห่างขอบ */
    margin-bottom: 20px;
    /* ระยะห่างล่าง */
    border-radius: 8px;
    /* ขอบมนเวท */
}

.shipbox p {
    margin: 0;
    /* ลบระยะห่างขอบซ้ายขวาของประโยค */
}

.shipbox i {
    margin-right: 10px;
    /* ระยะห่างขวาของไอคอน */
}

/* เพิ่มเอฟเฟกต์เมื่อเมาส์ hover ที่ช่อง */
.shipbox:hover {
    background-color: #e0e0e0;
    /* สีพื้นหลังเมื่อ hover */
    transition: background-color 0.3s ease-in-out;
    /* เพิ่มเอฟเฟกต์แบบ smooth */
}

.custom-input {
    width: 35%;
    /* กำหนดความกว้างให้เต็ม container */
    padding: 8px;
    /* กำหนดระยะห่างขอบใน input */
    box-sizing: border-box;
    /* บอกให้ padding และ border นับเข้าไปในขนาดทั้งหมดของ element */
    border: 2px solid #ccc;
    /* กำหนดเส้นขอบของ input */
    border-radius: 4px;
    /* กำหนดรูปร่างของมุม input */
    font-size: 16px;
    /* กำหนดขนาดตัวอักษร */
    display: inline-flex;
}

.custom-input:hover,
.custom-input:focus {
    border-color: #ff9800;
}

.custom-input::placeholder {
    position: absolute;
    top: 8px;
    left: 10px;
    font-size: 16px;
    color: #888;
    opacity: 1;
    transition: transform 0.3s, opacity 0.3s;
}

.custom-input:hover::placeholder,
.custom-input:focus::placeholder {
    transform: translateY(-20px);
    opacity: 0;
}

.modal-body {
    display: flex;
    justify-content: space-between;
}

.left-section,
.right-section {
    width: 48%;
    position: relative;
}

.left-section {
    text-align: left;
}

.right-section {
    text-align: right;
}

.modal-body label,
.modal-body input,
.modal-body textarea {
    width: 100%;
    margin-bottom: 10px;
    position: relative;
}

.modal-body input::placeholder,
.modal-body textarea::placeholder {
    position: absolute;
    top: 0;
    left: 0;
    padding: 10px;
    pointer-events: none;
    color: #888;
    transition: transform 0.3s, opacity 0.3s, visibility 0.3s;
    opacity: 1;
    visibility: visible;
}

.modal-body input:hover::placeholder,
.modal-body textarea:hover::placeholder {
    transform: translateY(-20px);
    opacity: 0;
    visibility: hidden;
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
    font-size: 20px;
}

tr:hover td {
    background-color: #e6f7ff;
    /* สีที่ต้องการให้เมื่อชี้ที่แถว */
}

.imgbuy {
    width: 40%;
    height: auto;
}

.sumamount a,
input {
    text-decoration: none;
    align-items: center;
}

.box {
    background-color: #ffffff;
    margin-top: 50px;
    border-radius: 15px;
    height: 50px;

}

.shipbox.selected {
    border: 2px solid #007BFF;
    /* เพิ่มขอบสีน้ำเงินเมื่อถูกเลือก */
    background-color: #F2F2F2;
    /* เปลี่ยนสีพื้นหลังเมื่อถูกเลือก */
}
</style>

<body>
    <div class="col-sm-10">
        <h1>ตระกร้าสินค้า</h1>
        <div class="row">
            <div class="col-sm-8" style="margin-left: 50px;">
                <table>
                    <thead>
                        <tr>
                            <th>ลำดับที่</th>
                            <th>รูปภาพสินค้า</th>
                            <th>ชื่อสินค้า</th>
                            <th>ราคา</th>
                            <th>จำนวน</th>
                            <th>ราคารวม</th>
                            <th>ลบสินค้า</th>
                        </tr>
                    </thead>
                    <?php
                        $Total =0;
                        $sumprice = 0;
                        $m = 1;
                        $Total_all =0;
                        $Shipcost =100;
                        $ShipEX =150;
                        if(isset($_SESSION["intLine"])) {  // ถ้าไม่เป็นค่าว่างให้ทำงานใน {}
                        for($i=0; $i <= (int)$_SESSION["intLine"]; $i++){
                            if(($_SESSION["strProductID"][$i]) != ""){
                                $sql1="SELECT * FROM product WHERE Pro_ID = '". $_SESSION["strProductID"][$i] . "' ";
                                $result1 = mysqli_query($conn, $sql1);
                                $row_pro = mysqli_fetch_array($result1);

                                $_SESSION["price"] = $row_pro['Pro_Price'];
                                $Total = $_SESSION["strQty"][$i];
                                $sum = $Total * $row_pro['Pro_Price'];
                                $sumprice =(float) $sumprice + $sum;
                                $_SESSION["sum_price"] = $sumprice;
                                $Total_all = $sumprice ;
                                $_SESSION["total_all"] = $Total_all;
                    ?>
                    <tbody>
                        <tr>
                            <td><?= $m  ?></td>
                            <td style="width: 30%;"><img src="../img/<?php echo $row_pro['Pro_Image'];?>" class="imgbuy"
                                    alt=""></td>
                            <td style="width: 30%;"><?php echo $row_pro['Pro_Name'];?></td>
                            <td><?php echo number_format($row_pro['Pro_Price'], 2);?></td>
                            <td style="width: 25%;">
                                <?php if($_SESSION["strQty"][$i] > 1) { ?>
                                <a href="order_del.php?id=<?php echo $row_pro['Pro_ID']; ?>"
                                    class="btn btn-outline-primary">-</a>
                                <?php } ?>

                                <?php echo $_SESSION["strQty"][$i];?>

                                <?php if($_SESSION["strQty"][$i] < $row_pro['Pro_Amount']) { ?>
                                <a href="order.php?id=<?php echo $row_pro['Pro_ID']; ?>"
                                    class="btn btn-outline-primary">+</a>
                                <?php } else { ?>
                                <!-- แจ้งเตือนเมื่อจำนวนสินค้าเกิน -->
                                <span style="color: red;">จำนวนสูงสุดที่สามารถเพิ่มได้</span>
                                <?php } ?>
                            </td>
                            <td><?php echo number_format($sum, 2);?></td>
                            <td><a href="pro_del.php?Line=<?= $i ?>" class="btn btn-danger">
                                    <i class="fi fi-rr-trash-xmark"></i></a></td>
                        </tr>

                    </tbody>
                    <?php
                    $m=$m+1;
                      }
                }
            } 
                ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>รวมเป็นเงิน</td>
                        <td style="color: red;"> <?php echo number_format($sumprice, 2);?></td>
                        <td> บาท</td>
                    </tr>
                </table>
                <div class="add">
                    <div class="col-sm-8">
                        <h4><i class="fi fi-rr-marker"></i>ที่อยู่ส่งจัดส่ง</h4>
                        <div class="address"><br>
                            <?php
                        // ตรวจสอบว่ามี Session ของผู้ใช้ที่ลงชื่อเข้าใช้หรือไม่
                        if (isset($_SESSION["Cus_ID"])) {
                            $cusID = $_SESSION["Cus_ID"];
                            $shippingCost = 120;
                            // ดึงข้อมูลที่ต้องการจากตาราง customer โดยใช้ Cus_ID
                            $sql_customer = "SELECT *
                                            FROM addresscus
                                            WHERE Cus_ID = {$row['Cus_ID']} AND Add_Status = 'DEFAULT'";
                            $result_customer = mysqli_query($conn, $sql_customer);

                            // ตรวจสอบว่ามีข้อมูลหรือไม่
                            
                                $customer_data = mysqli_fetch_assoc($result_customer);
                                // แสดงข้อมูลที่ดึงมาจากฐานข้อมูล    
                        ?>

                            <div>
                                <p style="margin-left: 20px;">
                                    <?php echo $customer_data['Add_Address']; ?><br>จังหวัด<?php echo $customer_data['Add_Province']; ?>,อำเภอ<?php echo $customer_data['Add_District']; ?>,รหัสไปรษณีย์<?php echo $customer_data['Add_Zip_code']; ?>
                                </p>
                            </div>
                            <center>
                                <a href="" data-bs-toggle="modal" data-bs-target="#editModal" style=" margin-top: 0px;">
                                    <i class="fi fi-rr-pen-square" style="font-size: 25px;"></i><br>
                                    <span>แก้ไขที่อยู่</span>
                                </a>
                            </center>
                            <!-- The Modal -->
                            <!-- โค้ด modal สำหรับแก้ไขที่อยู่ -->
                            <div class="modal fade" id="editModal">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">แก้ไขที่อยู่จัดส่ง</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <!-- Modal body -->

                                        <div class="modal-body">

                                            <!-- ส่วนนี้จะถูกแสดงเมื่อคลิกแก้ไข -->
                                            <form method="post" action="update_address.php">
                                                <input type="hidden" name="Add_ID" id="Add_ID" class="custom-input2"
                                                    style="margin-top: 0px;"
                                                    value="<?php echo $customer_data["Add_ID"]; ?>">
                                                <input type="hidden" name="Cus_ID" id="Cus_ID" class="custom-input2"
                                                    style="margin-top: 0px;" value="<?php echo $cusID; ?>">
                                                <label for=""
                                                    style=" align-items: center; margin-left: 0px; margin-top: 0px;"><i
                                                        class="fi fi-rr-earth-asia"
                                                        style="margin-right: 5px;"></i>จังหวัด</label>
                                                <section name="provinces" id="provinces">
                                                    <select name="provinces" class="custom-input"
                                                        style="margin-top: 0px;">
                                                        <option value="">กรุณาเลือกจังหวัด</option>
                                                        <?php
                                            // สร้างคำสั่ง SQL เพื่อดึงข้อมูลจากตาราง provinces
                                            $sql_provinces = "SELECT provinces_id, provinces_name_th FROM  provinces";
                                            // ทำการ query ข้อมูล
                                            $result_provinces = $conn->query($sql_provinces);
                                            // ตรวจสอบว่ามีข้อมูลจากการ query หรือไม่
                                            if ($result_provinces->num_rows > 0) {
                                                // Loop เพื่อเข้าถึงแต่ละแถวของข้อมูล
                                                
                                                while ($row_provinces = $result_provinces->fetch_assoc()) {
                                                    // ตรวจสอบว่าค่าใน dropdown list ตรงกับข้อมูลในฐานข้อมูลหรือไม่
                                                    $selected = ($row_provinces['provinces_name_th'] == $customer_data['Add_Province']) ? "selected" : "";
                                                    // สร้าง option สำหรับแต่ละจังหวัด
                                                    echo "<option value='" . $row_provinces['provinces_id'] . "' $selected>" . $row_provinces['provinces_name_th'] . "</option>";
                                                    
                                                    
                                                }
                                            }
                                            ?>
                                                    </select>
                                                </section>
                                                <label for=""
                                                    style=" align-items: center; margin-left: 0px; margin-top: 0px;"><i
                                                        class="fi fi-rr-map"
                                                        style="margin-right: 5px;"></i>อำเภอ</label>
                                                <section name="amphures" id="amphures">
                                                    <select name="amphures" class="custom-input"
                                                        style="margin-top: 0px;">
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
                                                    $selected2 = ($row2['amphures_name_th'] == $customer_data['Add_District']) ? "selected" : "";
                                                // สร้าง option สำหรับแต่ละจังหวัด
                                                echo "<option value='" . $row2['amphures_id'] . "' $selected2>" . $row2['amphures_name_th'] . "</option>";
                                        
                                                }
                                            } 
                                            ?>
                                                    </select>
                                                </section>
                                                <label for=""
                                                    style=" align-items: center; margin-left: 0px; margin-top: 0px;"><i
                                                        class="fi fi-rr-hastag"
                                                        style="margin-right: 5px;"></i>ตำบล</label>
                                                <section name="districts" id="districts">
                                                    <select name="districts" class="custom-input"
                                                        style="margin-top: 0px;">
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
                                                    $selected3 = ($row3['districts_name_th'] == $customer_data['Add_Subdistrict']) ? "selected" : "";
                                                    // สร้าง option สำหรับแต่ละจังหวัด
                                                    echo "<option value='" . $row3['id'] . "' $selected3>" . $row3['districts_name_th'] . "</option>";
                                                
                                                }
                                            }
                                            ?>
                                                    </select>
                                                </section>
                                                <label for=""
                                                    style=" align-items: center; margin-left: 0px; margin-top: 0px;"><i
                                                        class="fi fi-rr-hastag"
                                                        style="margin-right: 5px;"></i>รหัสไปรษณีย์</label>
                                                <input type="text" name="zipcode" id="zipcode" class="custom-input"
                                                    style="margin-top: 0px;"
                                                    value="<?php echo $customer_data['Add_Zip_code']; ?>">
                                                <label for=""
                                                    style=" align-items: center; margin-left: 0px; margin-top: 0px;"><i
                                                        class="fi fi-rr-home-location-alt"
                                                        style="margin-right: 5px;"></i>ที่อยู่</label>
                                                <textarea name="Add_Address" id="Add_Address" class="custom-input"
                                                    rows="5"
                                                    style="width: 100%; margin-top: 0px;"><?php echo $customer_data['Add_Address']; ?></textarea>
                                                <button type="submit" class="btn btn-success"
                                                    style=" margin-left: 250px;">บันทึก</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?php
                            
                        }
                        ?>

                        </div><br>

                        <div>
                            <h4><i class="fi fi-rr-shipping-fast"></i>รูปแบบการจัดส่ง</h4>
                            <div class="shipbox" onclick="changeShippingCost(100)">
                                <p style="display: inline-flex; align-items: center;">
                                    <i class="fi fi-rs-box-open" style="font-size: 25px;"></i>ส่งแบบปกติ
                                </p>
                                <P id="shipping-amount-1">ราคา $100 บาท</P>

                            </div>

                            <div class="shipbox" onclick="changeShippingCost(150)">
                                <p style="display: inline-flex; align-items: center;">
                                    <i class="fi fi-rs-box-open" style="font-size: 25px;"></i>ส่งด่วน
                                </p>
                                <P id="shipping-amount-2">ราคา $150 บาท</P>

                            </div>
                        </div>
                        <script>
                        // เรียกใช้ changeShippingCost เพื่อกำหนดค่าเริ่มต้นเป็น "ส่งแบบปกติ"
                        window.onload = function() {
                            changeShippingCost(
                                100); // เรียกใช้ changeShippingCost โดยกำหนดค่าเริ่มต้นเป็น 120 (ส่งแบบปกติ)      
                        };

                        function changeShippingCost(amount) {
                            // อัปเดตค่าจัดส่งทั้งในส่วนแสดงการจัดส่ง
                            document.getElementById('shipping-amount-1').innerText = 'ราคา ' + formatNumber(100) +
                                ' บาท';
                            document.getElementById('shipping-amount-2').innerText = 'ราคา ' + formatNumber(150) +
                                ' บาท';

                            // อัปเดตค่าจัดส่งในสรุปการสั่งซื้อ
                            document.getElementById('shipping-cost-summary').innerText = formatNumber(amount);

                            // เอาคลาส 'selected' ออกจากทุกๆ .shipbox
                            var shipboxes = document.querySelectorAll('.shipbox');
                            shipboxes.forEach(function(shipbox) {
                                shipbox.classList.remove('selected');
                            });

                            // เพิ่มคลาส 'selected' ให้กับ .shipbox ที่ถูกคลิก
                            var selectedShipbox = document.querySelector('.shipbox[onclick="changeShippingCost(' +
                                amount + ')"]');
                            selectedShipbox.classList.add('selected');

                            // ตรวจสอบว่าเลือก "ส่งด่วน" หรือไม่
                            if (amount == 150) {
                                // ถ้าเลือก "ส่งด่วน" ให้นำ $sumprice บวกกับ $ShipEX
                                var sumprice = <?php echo $sumprice; ?>;
                                var ShipEX = <?php echo $ShipEX; ?>;
                                var Total_all = sumprice + ShipEX;
                                document.getElementById('Total_all').innerText = formatNumber(Total_all);
                            } else {
                                // ถ้าไม่ใช่ "ส่งด่วน" ให้นำ $sumprice บวกกับ $Shipcost
                                var sumprice = <?php echo $sumprice; ?>;
                                var Shipcost = <?php echo $Shipcost; ?>;
                                var Total_all = sumprice + Shipcost;
                                document.getElementById('Total_all').innerText = formatNumber(Total_all);
                            }
                        }

                        // ฟังก์ชัน formatNumber เพื่อใส่ลูกน้ำให้กับเลขทุกราคา
                        function formatNumber(number) {
                            var formattedNumber = number.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                            return formattedNumber; // ไม่มี '$' นำหน้า
                        }
                        </script>

                    </div>
                </div>
            </div>
            <div class="col-sm-3"
                style="margin-top: 20px; display: flex; flex-direction: column; gap: 10px; max-height: 400px;">
                <h3 style="margin-left: 20px; margin-top: 20px;"><i class="fi fi-rr-donate"></i> สรุปการสั่งซื้อ</h3>

                <div style="margin-left: 20px; font-size: 22px; display: flex; justify-content: space-between; ">
                    <label for="" style="display: inline-block;">ยอดรวมสินค้า</label>
                    <p style="margin-left: 60px; font-size: 22px; color: red; margin-right: 20px;">
                        <?php echo number_format($sumprice, 2);?></p>
                </div>

                <div style="margin-left: 20px; font-size: 22px; display: flex; justify-content: space-between;">
                    <label for="" style="display: inline-block;">ค่าจัดส่ง</label>
                    <p style="margin-left: 60px; font-size: 22px; color: red; margin-right: 20px;"
                        id="shipping-cost-summary">
                    </p>
                </div>


                <div class="box"
                    style="font-size: 22px; display: flex; justify-content: space-between;  margin-bottom: 10px;">
                    <label for=""
                        style="margin-left: 20px; display: inline-block; margin-top: 10px;">ยอดชำระเงินทั้งหมด</label>
                    <p id="Total_all"
                        style="font-size: 22px; color: red; text-align: center; margin-top: 10px; margin-right: 20px;">
                        <?php echo number_format($Total_all, 2);?></p>
                </div>
                <div style="display: flex;  align-items: center; font-size: 22px;">
                    <a href="index_log.php" class="btn btn-primary"
                        style="display: flex;  align-items: center; margin-left: 45px;">
                        <i class="fi fi-rr-arrow-small-left"
                            style="display: flex;  align-items: center; font-size: 22px; margin-right: 5px;"></i>
                        เลือกซื้อต่อ
                    </a>
                    <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModalpay"
                        style="display: flex;  align-items: center; margin-left: 20px;">
                        <i class="fi fi-rr-cart-shopping-fast"
                            style="display: flex;  align-items: center; font-size: 22px; margin-right: 5px;"></i>
                        ทำการสั่งซื้อ
                    </a>
                </div><br>
            </div>
        </div>
        <!-- The Modal -->
        <div class="modal fade" id="myModalpay">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">ชำระเงิน</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body1">
                        <form action="insert_order.php" method="post" enctype="multipart/form-data">
                            <center>
                                <img src="../img/promptpay.png" alt="" style="width: 200px;"><br>
                                <img src="../img/qr.png" alt="" style="width: 300px;"><br><br>
                                <p style="color: red; font-size: 22px;">***กรุณาโอนผ่าน QR นี้เท่านั้น***
                                </p>
                                <p style="color: red; font-size: 22px; margin-top: -10px;">
                                    ***โปรดเช็คชื่อละบัญชีให้เรียบร้อย***</p>

                                <!-- เพิ่ม input file สำหรับการแนบไฟล์ -->
                                <label for="Pay_img"
                                    style="font-size: 24px; font-weight: bold;">อัปโหลดสลิปการโอนเงิน</label>
                                <input type="file" class="form-control" id="Pay_img" name="Pay_img" accept="image/*"
                                    style="width: 80%;" required><br>

                                <h4>การจัดส่งที่เลือก</h4>
                                <p id="selected-shipping-type" style="color: blue; font-size: 18px;"></p>
                                <p id="selected-shipping-cost" style="color: blue; font-size: 18px;"></p>

                                <input type="text" id="selected-shipping-type-input" name="shipping_type" value="">
                                <input type="text" id="sumprice" name="sumprice" value="<?php echo $sumprice;?> ">
                                <!-- ตรวจสอบว่าเลือก "ส่งด่วน" หรือไม่ -->
                                <script>
                                // ฟังก์ชัน updateSelectedShipping เพื่ออัปเดตข้อความการจัดส่งที่เลือก
                                function updateSelectedShipping() {
                                    var selectedShippingType = document.querySelector('.shipbox.selected p').innerText;
                                    var selectedShippingCost = document.querySelector('.shipbox.selected P').innerText;

                                    // ตรวจสอบว่าเป็น "ส่งแบบปกติ" หรือ "ส่งด่วน"
                                    if (selectedShippingType.includes("ปกติ")) {
                                        document.getElementById('selected-shipping-type').innerText =
                                            "การจัดส่งที่เลือก: ส่งแบบปกติ";
                                        document.getElementById('selected-shipping-type-input').value =
                                        "NORMAL"; // เซ็ตค่าให้เป็น "NORMAL" ใน input
                                        // คำนวณค่า Total_all เมื่อเลือกส่งแบบปกติ
                                        var sumprice = <?php echo $sumprice; ?>;
                                        var Shipcost = <?php echo $Shipcost; ?>;
                                        var Total_all = sumprice + Shipcost;
                                        document.getElementById('Total_all').innerText = formatNumber(Total_all);
                                    } else if (selectedShippingType.includes("ด่วน")) {
                                        document.getElementById('selected-shipping-type').innerText =
                                            "การจัดส่งที่เลือก: ส่งด่วน";
                                        document.getElementById('selected-shipping-type-input').value =
                                        "FAST"; // เซ็ตค่าให้เป็น "FAST" ใน input
                                        // คำนวณค่า Total_all เมื่อเลือกส่งด่วน
                                        var sumprice = <?php echo $sumprice; ?>;
                                        var ShipEX = <?php echo $ShipEX; ?>;
                                        var Total_all = sumprice + ShipEX;
                                        document.getElementById('Total_all').innerText = formatNumber(Total_all);
                                    } else {
                                        // กรณีอื่นๆ ที่คุณต้องการเพิ่ม
                                    }
                                }

                                // เรียกใช้ฟังก์ชัน updateSelectedShipping เมื่อ Modal ถูกเปิด
                                document.addEventListener('DOMContentLoaded', function() {
                                    document.getElementById('myModalpay').addEventListener('shown.bs.modal',
                                        function() {
                                            updateSelectedShipping();
                                        });
                                });
                                </script>

                                <button type="submit" class="btn btn-success">ชำระเงิน</button><br><br>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><br>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า pay_error ใน Session หรือไม่
        const pay_errorParam =
            <?php echo isset($_SESSION['pay_error']) ? $_SESSION['pay_error'] : '0'; ?>;

        // ถ้ามีค่า pay_error, ให้แสดง SweetAlert2
        if (pay_errorParam === 1) {
            Swal.fire({
                icon: 'error',
                title: 'กรุณาเลือกรูปแบบการจัดส่ง',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า pay_error ใน Session
            <?php unset($_SESSION['pay_error']); ?>
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า pay_errorimg ใน Session หรือไม่
        const pay_errorimgParam =
            <?php echo isset($_SESSION['pay_errorimg']) ? $_SESSION['pay_errorimg'] : '0'; ?>;

        // ถ้ามีค่า pay_errorimg, ให้แสดง SweetAlert2
        if (pay_errorimgParam === 1) {
            Swal.fire({
                icon: 'error',
                title: 'กรุณาแนบรูปสลิปการโอนเงิน',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า pay_errorimg ใน Session
            <?php unset($_SESSION['pay_errorimg']); ?>
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า updateadd_success ใน Session หรือไม่
        const updateadd_successParam =
            <?php echo isset($_SESSION['updateadd_success']) ? $_SESSION['updateadd_success'] : '0'; ?>;

        // ถ้ามีค่า updateadd_success, ให้แสดง SweetAlert2
        if (updateadd_successParam === 1) {
            Swal.fire({
                icon: 'success',
                title: 'อัพเดตข้อมูลสำเร็จ',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า updateadd_success ใน Session
            <?php unset($_SESSION['updateadd_success']); ?>
        }
    });
    </script>
    <script>
    function increaseQuantity() {
        var inputElement = document.getElementById('quantityInput');
        var currentValue = parseInt(inputElement.value);
        var maxQuantity = <?php echo $item['Pro_Amount']; ?>; // ดึงค่าจำนวนสินค้าคงเหลือจาก PHP
        if (currentValue < maxQuantity) {
            inputElement.value = currentValue + 1;
        }
        setHiddenQuantity(); // เรียกใช้ฟังก์ชั่นเพื่ออัพเดท input hidden
    }

    function decreaseQuantity() {
        var inputElement = document.getElementById('quantityInput');
        var currentValue = parseInt(inputElement.value);

        // ตรวจสอบไม่ให้ค่าลดลงไปต่ำกว่า 0
        if (currentValue > 0) {
            inputElement.value = currentValue - 1;
        }
    }
    </script>
    <script>
    $(document).ready(function() {
        // เมื่อมีการเลือกจังหวัด
        $('select[name="provinces"]').change(function() {
            var provinceId = $(this).val();

            // โหลดข้อมูลอำเภอ
            $.ajax({
                url: 'getAmphures.php',
                type: 'POST',
                data: {
                    provinceId: provinceId
                },
                success: function(data) {
                    $('select[name="amphures"]').html(data);
                    $('select[name="districts"]').html(
                        '<option value="">กรุณาเลือกตำบล</option>');
                    $('#zipcode').val('');
                }
            });
        });

        // เมื่อมีการเลือกอำเภอ
        $('select[name="amphures"]').change(function() {
            var amphureId = $(this).val();

            // โหลดข้อมูลตำบล
            $.ajax({
                url: 'getDistricts.php',
                type: 'POST',
                data: {
                    amphureId: amphureId
                },
                success: function(data) {
                    $('select[name="districts"]').html(data);
                    $('#zipcode').val('');
                }
            });
        });
    });
    </script>
</body>