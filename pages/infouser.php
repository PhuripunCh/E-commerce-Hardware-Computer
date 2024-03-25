<style>
.row {
    margin-left: 220px;
}

.col-sm-2 {
    background-color: #ffffff;
    border-radius: 5px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    height: 500px;
    display: flex;
    flex-direction: column;
    padding-top: 20px;
}

#demo1 {
    margin-left: 25px;
}

#demo1 a {
    padding-top: 0px;
    font-size: 18px;
}

.col-sm-8 {
    margin-left: 50px;
    background-color: #ffffff;
    border-radius: 5px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    padding: 20px;
}

.col-sm-8 label,
input {
    margin-left: 120px;
    margin-top: 30px;
}

.col-sm-8 h1 {
    margin-left: 100px;
    margin-top: 30px;
}

.col-sm-8 input {
    margin-left: 120px;
    margin-top: 10px;
}


/* เพิ่มสไตล์สำหรับ input ที่มี class custom-input เมื่อได้รับ focus */
.custom-input:focus {
    border-color: #007bff;
    outline: none;
}

.row2 {
    display: flex;
}

.col-sm-4 {
    margin-left: 15px;
    flex: 1;
}

.left-section {
    padding: 15px;
    margin-bottom: 20px;
    transition: border-color 0.3s;
}

.right-section {
    padding: 15px;
    margin-top: 85px;
    transition: border-color 0.3s;
}

.left-section:hover,
.right-section:hover {
    border-color: #ff9800;
}

.col-sm-8 label {
    font-size: 25px;
}

.col-sm-8 .custom-input {
    width: 60%;
    padding: 8px;
    margin-bottom: 10px;
    border: 2px solid #ccc;
    border-radius: 10px;
    box-sizing: border-box;
    transition: border-color 0.3s;
}


.col-sm-8 .custom-input:hover,
.col-sm-8 .custom-input:focus {
    border-color: #ff9800;
}

.col-sm-8 .custom-input::placeholder {
    position: absolute;
    top: 8px;
    left: 10px;
    font-size: 16px;
    color: #888;
    opacity: 1;
    transition: transform 0.3s, opacity 0.3s;
}

.col-sm-8 .custom-input:hover::placeholder,
.col-sm-8 .custom-input:focus::placeholder {
    transform: translateY(-20px);
    opacity: 0;
}

.edit {
    text-align: center;
}

.btn-warning {
    font-size: 20px;
    width: fit-content;
    padding-left: 100px;
    padding-right: 100px;
    display: flex;
    align-items: center;
}

.col-sm-2 a {
    text-decoration: none;
    padding: 15px 30px;
    font-size: 24px;
    transition: background-color 0.3s;
    display: flex;
    align-items: center;
    /* ให้เนื้อหาอยู่ตรงกลางตามทั้งตั้งและนอน */
}

.col-sm-2 a:hover {
    background-color: #f2f2f2;
    text-align: center;
    /* ให้ข้อความอยู่ตรงกลางทั้งตัวนอนและตัวตั้ง */
    align-items: center;
    /* ให้เนื้อหาอยู่ตรงกลางตามทั้งตั้งและนอน */
}

.col-sm-2 a.active {
    font-weight: bold;
    color: red;
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

.col-sm-2 a i {
    margin-right: 5px;
    /* ปรับค่าตามที่คุณต้องการ */
}

.address-info {
    font-size: 16px;
    /* ขนาดตัวอักษร */
    line-height: 1.5;
    /* ระยะห่างระหว่างบรรทัด */
    margin-bottom: 10px;
    /* ระยะห่างด้านล่าง */
    color: #333;
    /* สีข้อความ */
    margin-left: 120px;
    margin-top: 10px;
    border: 2px solid #ccc;
    border-radius: 10px;
    padding: 8px;
    width: 70%;
}
</style>

<body>
    <div class="row">
        <div class="col-sm-2">
            <a href="index_log.php?P=1&S=2" class="active" data-bs-toggle="collapse" data-bs-target="#demo1">
                <i class="fi fi-rs-user-pen"></i> ข้อมูลส่วนตัว
            </a>

            <div id="demo1" class="collapse">
                <a href="index_log.php?P=1&S=2" class="active"
                    style="font-size: 18px; padding-top: 15px; align-items: center;">
                    <i class="fi fi-rs-user-pen"></i> แก้ไขข้อมูลส่วนตัว
                </a>
                <a href="index_log.php?P=1&S=8" style="font-size: 18px; padding-top: 15px; align-items: center;">
                    <i class="fi fi-rr-marker"></i> ที่อยู่ส่งจัดส่ง
                </a>
            </div>

            <a href="index_log.php?P=1&S=3">
                <i class="fi fi-rs-shipping-fast"></i> สถานะการจัดส่ง
            </a>

            <a href="index_log.php?P=1&S=4">
                <i class="fi fi-rr-time-forward"></i> ประวัติการสั่งซื้อ
            </a>
        </div>
        <?php
            $sql    = "SELECT * FROM customer WHERE Cus_ID = '{$_SESSION['Cus_ID']}'";
        
            $result = mysqli_query($conn,$sql);
            $stmt = $conn->prepare($sql);
        
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $Cus_ID = $row['Cus_ID'];
            $Cus_Username = $row['Cus_Username'];
            $Cus_Password = $row['Cus_Password'];
            $Cus_Email = $row['Cus_Email'];
            $Cus_tel = $row['Cus_tel'];
            $Cus_FName = $row['Cus_FName'];
            $Cus_LName = $row['Cus_LName'];
        ?>

        <div class="col-sm-8">
            <div class="row2">
                <div class="col-sm-4">
                    <h1>ข้อมูลส่วนตัว</h1>
                    <!-- ฝั่งซ้าย -->
                    <div class="left-section">
                        <label for="Cus_Username"><i class="fas fa-user" style="font-size: 25px;"></i>
                            ชื่อผู้ใช้งาน</label>
                        <p class="address-info"><?php echo $Cus_Username ?></p>
                        <label for="Cus_FName"><i class="fas fa-address-book" style="font-size: 25px;"></i> ชื่อ</label>
                        <p class="address-info"><?php echo $Cus_FName ?></p>
                        <label for="Cus_tel"><i class="fas fa-phone" style="font-size: 25px;"></i> เบอร์โทรศัพท์</label>
                        <p class="address-info"><?php echo $Cus_tel ?></p>
                        
                    </div>
                </div>

                <div class="col-sm-4">
                    <!-- ฝั่งขวา -->
                    <div class="right-section">
                        <label for="Cus_Password"><i class="fas fa-lock-open" style="font-size: 25px; "></i>
                            รหัสผ่าน</label>
                        <p class="address-info"><?php echo $Cus_Password ?></p>

                        <label for="Cus_LName"><i class="fas fa-address-book" style="font-size: 25px;"></i>
                            นามสกุล</label>
                        <p class="address-info"><?php echo $Cus_LName ?></p>

                        <label for="Cus_tel"><i class="fas fa-envelope" style="font-size: 25px;"></i> อีเมล</label>
                        <p class="address-info"><?php echo $Cus_Email ?></p>

                    </div>
                </div>
            </div>

            <center><br>
                <div class="edit" style="display: flex; justify-content: center;">
                    <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal">
                        <i class="fi fi-rr-edit"
                            style="font-size: 30px; padding-top: 10px; margin-right: 5px; "></i>แก้ไข
                    </a>
                </div>
            </center><br>
        </div>

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">แก้ไขข้อมูลส่วนตัว</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="post" action="update_user.php">
                            <div><i class="fas fa-user" style="font-size: 25px;"></i> <label for="Cus_Username">
                                    ชื่อผู้ใช้งาน</label>
                                <input type="hidden" name="Cus_ID" id="Cus_ID" class="custom-input2"
                                    style="margin-top: 0px;" value="<?php echo $Cus_ID ?>">
                                <p class="address-info" style="margin-left: 0px; width: 100%;">
                                    <?php echo $Cus_Username ?></p>
                            </div><br>
                            <div>
                                <i class="fas fa-lock-open" style="font-size: 25px;"></i> <label for="Cus_Password"
                                    class="form-label">รหัสผ่าน</label>
                                <input type="password" class="custom-input2" id="Cus_Password" style="margin-top: 0px;"
                                    placeholder="รหัสผ่าน" name="Cus_Password" value="<?php echo $Cus_Password ?>">
                            </div><br>
                            <i class="fas fa-address-book" style="font-size: 25px;"></i>
                            <label for="" class="form-label">ชื่อ-นามสกุล</label>
                            <div class="flex-container">
                                <input type="text" class="custom-input2" id="Cus_FName" placeholder="ชื่อ"
                                    style="margin-top: 0px;" name="Cus_FName" value="<?php echo $Cus_FName ?>">
                                <p>-</p>
                                <input type="text" class="custom-input2" id="Cus_LName" placeholder="นามสกุล"
                                    style="margin-top: 0px;" name="Cus_LName" value="<?php echo $Cus_LName ?>">
                            </div><br>
                            <div>
                                <i class="fas fa-envelope" style="font-size: 25px;"></i>
                                <label for="" class="form-label">อีเมล</label>
                                <input type="text" class="custom-input2" id="Cus_Email" placeholder="อีเมล"
                                    style="margin-top: 0px;" name="Cus_Email" value="<?php echo $Cus_Email ?>">
                            </div><br>
                            <div>
                                <i class="fas fa-phone" style="font-size: 25px;"></i>
                                <label for="" class="form-label">เบอร์โทรศัพท์</label>
                                <input type="text" class="custom-input2" id="Cus_tel" placeholder="เบอร์โทรศัพท์"
                                    style="margin-top: 0px;" name="Cus_tel" value="<?php echo $Cus_tel ?>">
                            </div><br>


                            <center><button type="submit" class="btn btn-success" style="width: 300px;">ยืนยัน</button>
                            </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
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
</body><br>