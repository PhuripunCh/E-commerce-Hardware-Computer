<?php 

include 'condb.php'; 
$iditem = $_GET['id'];
$sql = "SELECT * FROM product WHERE Pro_ID='$iditem' ";
$result = mysqli_query($conn,$sql);
$item = mysqli_fetch_array($result);
?>
<style>
.row {
    margin-left: 320px;
}

.col-sm-3 {
    background-color: #ffffff;
    border-radius: 5px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.col-sm-3 a {
    text-decoration: none;
    padding: 30px;
    font-size: 24px;

}

.col-sm-6 {
    margin-left: 50px;
    background-color: #ffffff;
    border-radius: 5px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.col-sm-6 h2 {
    margin-left: 80px;
    margin-top: 40px;
    margin-right: 80px;
}

.col-sm-6 p,
label {
    margin-left: 80px;
    margin-right: 80px;
    font-size: 23px;

}

.col-sm-6 label {
    margin-left: 80px;
    margin-right: 10px;
    font-size: 23px;

}

.showimg {
    width: 80%;
    height: auto;

}

.sumamount a,
input {
    text-decoration: none;
    align-items: center;
}

.custom-input {
    width: 50px;
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
    text-align: center;
}
</style>

<body>
    <a href="index_log.php" class="btn btn-outline-primary back-btn"
        style="display: flex; align-items: center; margin-left: 25px; font-size: 20px; width: 180px;">
        <i class="fi fi-rr-left" style="margin-left: 5px; margin-right: 5px; display: flex;"></i>กลับหน้าหลัก
    </a>

    <div class="row"style="margin-top: -40px;">
        <div class="col-sm-3" style="height: 400px; padding-top: 20px;">
            <center><img class="showimg" src="../uploads/<?php echo $item['Pro_Image'] ?> " alt=""></center>
        </div>

        <div class="col-sm-6">
            <h2 style="margin-bottom: 15px;"><?php echo $item['Pro_Name'] ?></h2>
            <?php
                $description = $item['Pro_Description'];
                $paragraphs = explode("\n", $description);

                foreach ($paragraphs as $paragraph) {
                    echo "<p style='margin-top: -10px;'>&#8226; $paragraph</p>"; // &#8226; คือ entity code ของจุดกลม
                }
            ?>
            <p style="font-size: 25px;">จำนวนคงเหลือ : <?php echo $item['Pro_Amount'] ?> ชิ้น</p>
            <h2>ราคา <span style="color: red;"><?php echo number_format($item['Pro_Price']) ?> </span>บาท</h2><br>

            <!-- เพิ่ม input field สำหรับระบุจำนวน -->
            <label for="quantityInput">จำนวน: </label>
            <button onclick="decreaseQuantity()" class="btn btn-outline-primary">-</button>
            <input type="text" id="quantityInput" class="custom-input" name="quantity" min="1" value="1" readonly>
            <button onclick="increaseQuantity()" class="btn btn-outline-primary">+</button>
            <br><br>
        </div>
    </div><br>

    <div class="sumamount" style="align-items: center; margin-top: -15px;">
        <br><br>

        <?php
        // เพิ่มเงื่อนไขตรวจสอบจำนวนคงเหลือ
        $isOutOfStock = $item['Pro_Amount'] == 0;

        if (!$isOutOfStock) {
            // เพิ่ม input hidden เพื่อส่งค่าจำนวนสินค้า
            ?>
        <form action="addorder.php" method="get">
            <input type="hidden" name="id" value="<?php echo $item['Pro_ID']; ?>">
            <input type="hidden" id="quantityHidden" name="quantity" value="1">
            <a href="order.php?id=<?php echo $item['Pro_ID']; ?>" style="margin-left: 800px; width: 200px; text-align: center;"
                class="btn btn-success btn-lg">ซื้อสินค้า</a>
            <button type="submit" onclick="setHiddenQuantity()"
                style="margin-left: 20px; width: 200px; text-align: center; ;"
                class="btn btn-primary btn-lg">หยิบใส่ตระกร้า</button>
        </form>
        <?php
        } else {
            ?>
        <button style="margin-left: 800px; width: 200px; text-align: center; background-color: #d3d3d3;"
            class="btn btn-secondary btn-lg" disabled>ซื้อสินค้า</button>
        <button style="margin-left: 20px; width: 200px; text-align: center; background-color: #d3d3d3;"
            class="btn btn-secondary btn-lg" disabled>หยิบใส่ตระกร้า</button>
        <?php
        }
        ?>
    </div><br>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า add_error ใน Session หรือไม่
        const add_errorParam = <?php echo isset($_SESSION['add_error']) ? $_SESSION['add_error'] : '0'; ?>;

        // ถ้ามีค่า add_error, ให้แสดง SweetAlert2
        if (add_errorParam === 1) {
            Swal.fire({
                icon: 'error',
                title: 'ไม่สามารถเพิ่มจำนวนได้เนื่องจากสินค้าเท่ากับจำนวนคงเหลือ',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า add_error ใน Session
            <?php unset($_SESSION['add_error']); ?>
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า add_success ใน Session หรือไม่
        const add_successParam =
            <?php echo isset($_SESSION['add_success']) ? $_SESSION['add_success'] : '0'; ?>;

        // ถ้ามีค่า add_success, ให้แสดง SweetAlert2
        if (add_successParam === 1) {
            Swal.fire({
                icon: 'success',
                title: 'ทำการเพิ่มสินค้าลงตระกร้าแล้ว',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า add_success ใน Session
            <?php unset($_SESSION['add_success']); ?>
        }
    });

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

        // ตรวจสอบไม่ให้ค่าลดลงไปต่ำกว่า 1
        if (currentValue > 1) {
            inputElement.value = currentValue - 1;
            setHiddenQuantity(); // เรียกใช้ฟังก์ชั่นเพื่ออัพเดท input hidden
        }
    }

    function setHiddenQuantity() {
        var inputElement = document.getElementById('quantityInput');
        var hiddenElement = document.getElementById('quantityHidden');
        hiddenElement.value = inputElement.value;
    }
    </script>
</body>