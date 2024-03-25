<style>
.card-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    /* ระยะห่างระหว่างข้อมูล */
}

.btn-outline-danger {
    border: 2px solid red;
}

/* ตั้งค่าขนาด font และสีข้อความ */
.cateicon .icon-text-container {
    text-align: center;
    text-decoration: none;
    color: #333;
    position: relative;
    margin: 30px;
    /* เพิ่ม margin เพื่อควบคุมระยะห่าง */
}

.cateicon .icon-text-container img {
    font-size: 40px;
    border: 2px solid #333;
    padding: 10px;
    border-radius: 40%;
    transition: border-color 0.3s;
    box-shadow: 0 20px 30px rgba(0, 0, 0, 0.3);
    background-color: white;
}

.cateicon .icon-text-container span {
    display: block;
    font-size: 16px;
    margin-top: 10px;
}

/* ตกแต่งลิงก์ */
.cateicon .icon-text-container:hover {
    color: #dc3545;
}

.cateicon .icon-text-container:hover img {
    transform: scale(1.1);
    border-color: #dc3545;
    /* กำหนดสีขอบเมื่อลิงก์ถูกชี้ */
}

/* ตกแต่งที่เพิ่มเติมเมื่อลิงก์ถูกเลื่อนเข้ามา */
.cateicon .icon-text-container::before {
    content: '';
    /* เพิ่ม content เพื่อให้ใช้ ::before */
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    /* ทำให้มีมุมโค้ง */
    opacity: 0;
    transition: opacity 0.3s;
    box-sizing: border-box;
    /* คำนึงถึงขอบเขตของ border */
}

.cateicon .icon-text-container:hover::before {
    opacity: 1;
}

/* ตกแต่งที่เพิ่มเติมเมื่อลิงก์ถูกคลิก */
.cateicon .icon-text-container:active {
    color: #dc3545;
}

.cateicon .icon-text-container:active i {
    transform: scale(0.8);
    border-color: #dc3545;
    /* กำหนดสีขอบเมื่อลิงก์ถูกคลิก */
}

/* ปรับขนาดรูปภาพใน Carousel ให้มีความสูงเท่ากัน */
#demo1 .carousel-inner img {
    height: 500px;
    /* ปรับความสูงตามที่ต้องการ */
    object-fit: cover;
    /* ให้รูปภาพทำการปรับขนาดและครอบโดยไม่เสียสัดส่วน */
    margin: auto;
    /* ทำให้รูปอยู่ตรงกลาง */
    display: block;
    /* ทำให้รูปภาพปรับตำแหน่งอยู่ตรงกลาง */
}

/* ปรับขนาด carousel-inner ให้มีความสูงเท่ากัน */
#demo1 .carousel-inner {
    height: 300px;
    /* ปรับความสูงตามที่ต้องการ */
    display: flex;
    /* ใช้ Flexbox */
    align-items: center;
    /* ให้รูปภาพอยู่ตรงกลางตามแนวตั้ง */
}
</style>

<body>
    <?php
include 'condb.php';

$sql = "SELECT * FROM category";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
?>
    <div class="cateicon" style="display: flex; flex-wrap: wrap;">
        <?php 
        while ($row = mysqli_fetch_assoc($result)) { 
        ?>
        <a href="index.php?A=1&B=5&Cate_ID=<?php echo $row['Cate_ID']; ?>" class="icon-text-container"
            style="flex-basis: calc(100% / 12); text-align: center; margin: 0 0;">
            <img src="uploads/<?php echo $row['Cate_Icon']; ?>" alt="" style="width: 80px; height: 80px;"><br>
            <span style="font-size: 19px;"><?php echo $row['Cate_Name']; ?></span>
        </a>
        <?php 
        } 
        ?>
    </div>
    <?php
} else {
    echo "ไม่พบข้อมูลหมวดหมู่";
}
?>
    <div class="headcontent1">
        <br>
        <img src="img/bgimg1.jpg" class="image " alt="">

    </div><br>

    <div class="headcontent">
        <p>สินค้าแนะนำ</p>
    </div><br>

    <?php
        include 'condb.php';

        $sql = "SELECT Pro_ID, Pro_Name, Pro_Price, Pro_Description, Pro_Image FROM product";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
    ?>
    <div class='card-container' style='margin-left: 140px; display: flex; flex-wrap: wrap;'>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class='content card' style='width: 18rem; margin: 10px;'>
            <img class='card-img-top' src='uploads/<?php echo $row['Pro_Image']; ?>' alt='Card image'
                style='margin-top: 10px;'>
            <div class='card-body'>
                <h4 class='card-title'><?php echo $row['Pro_Name']; ?></h4>
                <?php
                    $description = $row['Pro_Description'];
                    $trimmed_description = mb_strimwidth(strip_tags($description), 0, 100, '...');
                    ?>
                <p class='card-text'><?php echo $trimmed_description; ?></p>
                <p class='card-text'>Price: <?php echo number_format($row['Pro_Price']);?> บาท</p>
            </div>
            <a href="index.php?A=1&B=2&id=<?php echo $row['Pro_ID']; ?>" class="btn btn-danger"
                style="font-size: 20px; width: 90%; margin-bottom: 10px; margin-top: -10px;">รายละเอียด</a>
        </div>
        <?php
        }
        ?>
    </div><br>
    <?php
} else {
    echo "ไม่พบข้อมูลสินค้า";
}

?>
</body>