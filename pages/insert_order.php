<?php
session_start();
include 'condb.php';

// ตรวจสอบว่ามีข้อมูลที่อยู่สำหรับ Cus_ID หรือไม่
$sql_check_address = "SELECT * FROM addresscus WHERE Cus_ID = '" . $_SESSION["Cus_ID"] . "'";
$result_check_address = mysqli_query($conn, $sql_check_address);

if (mysqli_num_rows($result_check_address) > 0) {
    // ถ้ามีข้อมูลที่อยู่ ตรวจสอบค่า shipping_type ว่าถูกส่งมาหรือไม่
    if (isset($_POST['shipping_type'])) {
        // ถ้ามีการส่งค่า shipping_type มา
        // ทำตามขั้นตอนต่อไป
        if (isset($_FILES['Pay_img']) && $_FILES['Pay_img']['error'] === UPLOAD_ERR_OK) {
            $new_file_name = basename($_FILES['Pay_img']['name']);
            $file_upload_path = "../PayImage/" . $new_file_name;
            move_uploaded_file($_FILES['Pay_img']['tmp_name'], $file_upload_path);
        } else {
            $new_file_name = "";
        }
        $shipping_type = $_POST['shipping_type'];
        // ตรวจสอบว่า shipping_type ไม่ว่างเปล่า
        if (empty($shipping_type)) {
            // กระทำเมื่อ shipping_type ว่างเปล่า
            $_SESSION['pay_error'] = 1;
            echo "<script> window.history.back(); </script>";
            exit(); // หยุดการทำงานถ้า shipping_type ว่างเปล่า
        }

        // คำนวณค่า Total_all โดยกำหนดค่าเริ่มต้น
        $sumprice = $_POST['sumprice'];
        $Shipcost =100;
        $ShipEX =150;
        // ตรวจสอบ shipping_type เพื่อกำหนดค่า Total_all
        if ($shipping_type == 'FAST') {
            // ถ้าเลือก "ส่งด่วน" ให้คำนวณค่า Total_all โดยเพิ่มค่า $ShipEX
            $Total_all = $sumprice + $ShipEX;
        } else {
            // ถ้าไม่ใช่ "ส่งด่วน" ให้คำนวณค่า Total_all โดยเพิ่มค่า $Shipcost
            $Total_all = $sumprice + $Shipcost;
        }

        // เก็บค่า Total_all ใน $_SESSION["total_all"]
        $_SESSION["total_all"] = $Total_all;

        // ตรวจสอบ shipping_type และดำเนินการต่อไปตามที่คุณต้องการ

        $sql = "INSERT INTO orderlist(Cus_ID, List_total, List_status, Pay_img, shipping_type)
                VALUES ('" . $_SESSION["Cus_ID"] . "', '" . $_SESSION["total_all"] . "', 'NOTPAY', '$new_file_name', '$shipping_type')";
        mysqli_query($conn, $sql);
        $orderID = mysqli_insert_id($conn);
        $_SESSION["List_ID"] = $orderID;

        // เพิ่มคำสั่ง SQL สำหรับการ insert ค่า Ship_status = PREPARE ในตาราง shipping
        $sql_shipping = "INSERT INTO shipping(List_ID, Cus_ID, Ship_status)
                         VALUES ('$orderID', '" . $_SESSION["Cus_ID"] . "', 'PREPARE')";
        mysqli_query($conn, $sql_shipping);
        for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
            if (($_SESSION["strProductID"][$i]) != "") {
                // ดึงข้อมูลสินค้า
                $sql1 = "SELECT * FROM product WHERE Pro_ID = '" . $_SESSION["strProductID"][$i] . "' ";
                $result1 = mysqli_query($conn, $sql1);
                $row1 = mysqli_fetch_array($result1);
                $price = $row1['Pro_Price'];
                $total = $_SESSION["strQty"][$i] * $price;

                $sql2 = "INSERT INTO orderdetail (List_ID,Pro_id,Detail_price,Detail_qty,Total)
                         VALUES ('$orderID', '" . $_SESSION["strProductID"][$i] . "', '$price', 
                         '" . $_SESSION["strQty"][$i] . "', '$total')";
                if (mysqli_query($conn, $sql2)) {
                    $sql3 = "UPDATE product SET Pro_Amount = Pro_Amount - '" . $_SESSION["strQty"][$i] . "' 
                             WHERE Pro_ID = '" . $_SESSION["strProductID"][$i] . "' ";
                    mysqli_query($conn, $sql3);

                    // 1. นับจำนวนสินค้าที่ขายได้และอัปเดตตาราง sumproduct
                    $sql_count_sold = "SELECT Pro_ID, SUM(Detail_qty) AS sold_qty
                                       FROM orderdetail
                                       WHERE List_ID = '$orderID'
                                       GROUP BY Pro_ID";
                    $result_count_sold = mysqli_query($conn, $sql_count_sold);

                    // 2. วนลูปเพื่อนับและอัปเดตค่าในตาราง sumproduct
                    while ($row_sold = mysqli_fetch_assoc($result_count_sold)) {
                        $proID_sold = $row_sold['Pro_ID'];
                        $soldQty = $row_sold['sold_qty'];

                        // 3. อัปเดตหรือเพิ่มข้อมูลในตาราง sumproduct
                        $sql_update_sumproduct = "INSERT INTO sumproduct (Pro_ID, Sum_qty)
                                                  VALUES ('$proID_sold', '$soldQty')
                                                  ON DUPLICATE KEY UPDATE Sum_qty = Sum_qty + '$soldQty'";
                        mysqli_query($conn, $sql_update_sumproduct);
                    }

                    $_SESSION['pay_success'] = 1;
                    echo "<script> window.location='index_log.php?P=1&S=9';</script>";
                }
            }
        }

        unset($_SESSION["intLine"]);
        unset($_SESSION["strProductID"]);
        unset($_SESSION["strQty"]);
        unset($_SESSION["sum_price"]);
        unset($_SESSION["total_all"]);
    } else {
        // ถ้าไม่มีการส่งค่า shipping_type มา
        // กลับไปที่หน้าเดิมหรือทำตามที่คุณต้องการ
        $_SESSION['pay_error'] = 1;
        echo "<script> window.history.back(); </script>";
    }
} 
?>
