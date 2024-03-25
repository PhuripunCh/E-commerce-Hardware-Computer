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

// ตรวจสอบว่ามีการส่งค่า id และ quantity มาจากฟอร์มหรือไม่
if (isset($_GET["id"]) && isset($_GET["quantity"])) {
    $productId = $_GET["id"];
    $quantity = $_GET["quantity"];

    // ดึงข้อมูลสินค้าจากฐานข้อมูล
    $query = "SELECT * FROM product WHERE Pro_ID = $productId";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $item = mysqli_fetch_assoc($result);
        $availableQty = $item['Pro_Amount'];

        // ตรวจสอบว่ามีสินค้าในตระกร้าหรือไม่
        if (isset($_SESSION["intLine"])) {
            $key = array_search($productId, $_SESSION["strProductID"]);

            // ถ้ามีสินค้าในตระกร้าแล้ว
            if ((string)$key !== "") {
                $totalQty = $_SESSION["strQty"][$key];

                // ตรวจสอบว่าจำนวนสินค้าทั้งหมดไม่เกินจำนวนสินค้าคงเหลือ
                $maxQuantity = $availableQty - $totalQty;
                if ($quantity <= $maxQuantity) {
                    $_SESSION["strQty"][$key] = $totalQty + $quantity;
                } else {
                    // แจ้งเตือนหรือทำการจัดการเพิ่มเติม
                    $_SESSION['add_error'] = 1;
                    echo "ไม่สามารถเพิ่มสินค้าลงในตระกร้าได้ เนื่องจากจำนวนสินค้าทั้งหมดเกินหรือเท่ากับจำนวนคงเหลือ";
                }
            } else {
                // ถ้ายังไม่มีสินค้าในตระกร้า
                $_SESSION["intLine"] += 1;
                $intNewLine = $_SESSION["intLine"];

                // ตรวจสอบว่าจำนวนสินค้าไม่เกินจำนวนสินค้าคงเหลือ
                if ($quantity <= $availableQty) {
                    $_SESSION["strProductID"][$intNewLine] = $productId;
                    $_SESSION["strQty"][$intNewLine] = $quantity;
                } else {
                    // แจ้งเตือนหรือทำการจัดการเพิ่มเติม
                    $_SESSION['add_error'] = 1;
                    echo "ไม่สามารถเพิ่มสินค้าลงในตระกร้าได้ เนื่องจากจำนวนสินค้าทั้งหมดเกินหรือเท่ากับจำนวนคงเหลือ";
                }
            }
        } else {
            // ถ้ายังไม่มีการสร้างตัวแปร session สำหรับตระกร้า
            $_SESSION["intLine"] = 0;
            $_SESSION["strProductID"][0] = $productId;

            // ตรวจสอบว่าจำนวนสินค้าไม่เกินจำนวนสินค้าคงเหลือ
            if ($quantity <= $availableQty) {
                $_SESSION["strQty"][0] = $quantity;
            } else {
                // แจ้งเตือนหรือทำการจัดการเพิ่มเติม
                $_SESSION['add_error'] = 1;
                echo "ไม่สามารถเพิ่มสินค้าลงในตระกร้าได้ เนื่องจากจำนวนสินค้าทั้งหมดเกินหรือเท่ากับจำนวนคงเหลือ";
            }
        }
        $_SESSION['add_success'] = 1;
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        // แสดงข้อความหรือทำการจัดการเพิ่มเติม
        echo "เกิดข้อผิดพลาดในการดึงข้อมูลสินค้า";
    }
} else {
    // กรณีที่ไม่ได้รับค่า id จากฟอร์ม
    // แสดงข้อความหรือทำการจัดการเพิ่มเติม
    echo "ไม่ได้รับค่าที่จำเป็นจากฟอร์ม";
}
?>
