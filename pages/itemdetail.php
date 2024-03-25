<?php 
include 'condb.php'; 
$iditem = $_GET['id'];
$sql = "SELECT * FROM product WHERE Pro_ID='$iditem' ";
$result = mysqli_query($conn,$sql);
$item = mysqli_fetch_array($result);
?>
<style>
.row {
    margin-left: 290px;
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

.col-sm-6 p {
    margin-left: 80px;
    margin-right: 80px;
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
}
</style>

<body>
    <div class="row">
        <div class="col-sm-3" style="height: 400px; padding-top: 20px;">
            <center><img class="showimg" src="uploads/<?php echo $item['Pro_Image'] ?> " alt=""></center>
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
            <p style="font-size: 25px;">จำนวนคงเหลือ : <?php echo $item['Pro_Amount'] ?></p>
            <h2>ราคา <span style="color: red;"><?php echo number_format($item['Pro_Price']) ?> </span>บาท</h2><br>
        </div>

    </div><br>
    <div class="sumamount" style="align-items: center; margin-top: -15px;">
        <br><br>
        <a href="" style="margin-left: 800px; width: 200px; text-align: center; "
            class="btn btn-success btn-lg">ซื้อสินค้า</a>
        <a href="" style="margin-left: 20px; width: 200px; text-align: center; background-color: #000853;"
            class="btn btn-primary btn-lg">หยิบใส่ตระกร้า</a>

    </div><br>


    <script>
    function increaseQuantity() {
        var inputElement = document.getElementById('quantityInput');
        var currentValue = parseInt(inputElement.value);
        inputElement.value = currentValue + 1;
    }

    function decreaseQuantity() {
        var inputElement = document.getElementById('quantityInput');
        var currentValue = parseInt(inputElement.value);

        // ตรวจสอบไม่ให้ค่าลดลงไปต่ำกว่า 0
        if (currentValue > 1) {
            inputElement.value = currentValue - 1;
        }
    }
    </script>
</body>