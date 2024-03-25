<?php
ob_start();
session_start();
include 'condb.php';

// เช็คว่ามีตะกร้าสินค้าหรือไม่
if (isset($_SESSION["intLine"])) {
    $cartItemCount = array_sum($_SESSION["strQty"]);
} else {
    $cartItemCount = 0;
}
// ตรวจสอบว่ามีการส่งค่า id มาจากฟอร์มหรือไม่
if(isset($_GET["id"])) {
    $productId = $_GET["id"];

    // ดึงข้อมูลสินค้าจากฐานข้อมูล (ตัวอย่างเท่านี้เท่านั้น คุณอาจต้องปรับแต่งตามโครงสร้างฐานข้อมูลของคุณ)
    $query = "SELECT * FROM product WHERE Pro_ID = $productId";
    $result = mysqli_query($conn, $query);

    if($result) {
        $item = mysqli_fetch_assoc($result);
        $availableQty = $item['Pro_Amount'];  // ปรับตามชื่อ field ในฐานข้อมูลที่เก็บจำนวนสินค้าคงเหลือ

        // ตรวจสอบว่ามีสินค้าในตระกร้าหรือไม่
        if(isset($_SESSION["intLine"])) {
            $key = array_search($productId, $_SESSION["strProductID"]);

            // ถ้ามีสินค้าในตระกร้าแล้ว
            if((string)$key !== "") {
                $totalQty = $_SESSION["strQty"][$key];

                // ตรวจสอบว่าจำนวนสินค้าทั้งหมดไม่เกินจำนวนสินค้าคงเหลือ
                if($totalQty < $availableQty) {
                    $_SESSION["strQty"][$key] = $totalQty + 1;
                } else {
                    // แจ้งเตือนหรือทำการจัดการเพิ่มเติมตามที่ต้องการ
                    echo "ไม่สามารถเพิ่มสินค้าลงในตระกร้าได้ เนื่องจากจำนวนสินค้าทั้งหมดเกินหรือเท่ากับจำนวนคงเหลือ";
                }
            } else {
                // ถ้ายังไม่มีสินค้าในตระกร้า
                $_SESSION["intLine"] += 1;
                $intNewLine = $_SESSION["intLine"];

                // ตรวจสอบว่าจำนวนสินค้าไม่เกินจำนวนสินค้าคงเหลือ
                if(1 <= $availableQty) {
                    $_SESSION["strProductID"][$intNewLine] = $productId;
                    $_SESSION["strQty"][$intNewLine] = 1;
                } else {
                    // แจ้งเตือนหรือทำการจัดการเพิ่มเติมตามที่ต้องการ
                    echo "ไม่สามารถเพิ่มสินค้าลงในตระกร้าได้ เนื่องจากจำนวนสินค้าทั้งหมดเกินหรือเท่ากับจำนวนคงเหลือ";
                }
            }
        } else {
            // ถ้ายังไม่มีการสร้างตัวแปร session สำหรับตระกร้า
            $_SESSION["intLine"] = 0;
            $_SESSION["strProductID"][0] = $productId;

            // ตรวจสอบว่าจำนวนสินค้าไม่เกินจำนวนสินค้าคงเหลือ
            if(1 <= $availableQty) {
                $_SESSION["strQty"][0] = 1;
            } else {
                // แจ้งเตือนหรือทำการจัดการเพิ่มเติมตามที่ต้องการ
                echo "ไม่สามารถเพิ่มสินค้าลงในตระกร้าได้ เนื่องจากจำนวนสินค้าทั้งหมดเกินหรือเท่ากับจำนวนคงเหลือ";
            }
        }

        echo "<script> window.location='index_log.php?P=1&S=6';</script>";
    } else {
        // แสดงข้อความหรือทำการจัดการเพิ่มเติมตามที่ต้องการ
        echo "เกิดข้อผิดพลาดในการดึงข้อมูลสินค้า";
    }
} else {
    // กรณีที่ไม่ได้รับค่า id จากฟอร์ม
    // แสดงข้อความหรือทำการจัดการเพิ่มเติมตามที่ต้องการ
    echo "ไม่ได้รับค่าที่จำเป็นจากฟอร์ม";
}
?>