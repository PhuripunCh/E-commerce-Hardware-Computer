<?php
include('session.php');

?>
<!-- Include SweetAlert2 CSS -->



<style>
.row {
    margin-left: 220px;
}

.col-sm-2 {
    background-color: #ffffff;
    border-radius: 5px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    height: 500px;
    display: flex;
    flex-direction: column;
    padding-top: 20px;
}


.col-sm-8 {
    margin-left: 50px;
    background-color: #ffffff;
    border-radius: 5px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.col-sm-8 h1,
label,
select {
    margin-left: 120px;
    margin-top: 30px;

}



/* เพิ่มสไตล์สำหรับ input ที่มี class custom-input */


/* เพิ่มสไตล์สำหรับ input ที่มี class custom-input เมื่อได้รับ focus */
.custom-input:focus {
    border-color: #007bff;
    /* เปลี่ยนสีเส้นขอบของ input เมื่อได้รับ focus */
    outline: none;
    /* ลบเส้นขอบในขณะ focus */
}

.row2 {
    display: flex;
}

.col-sm-4 {
    flex: 1;
}

.left-section,
.right-section {
    padding: 16px;
}

.right-section {
    margin-top: 75px;
}

.active {
    color: #dc3545;
}

.col-sm-2 {
    height: 500px;
    display: flex;
    flex-direction: column;
    padding-top: 20px;
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

#demo1 {
    margin-left: 25px;
}

#demo1 a {
    padding-top: 0px;
    font-size: 18px;
}

.col-sm-8 {
    padding: 20px;
    background-color: #ffffff;
    border-radius: 10px;
}



.row2 {
    display: flex;
}

.col-sm-4 {
    margin-left: 15px;
    flex: 1;
}

.left-section2,
.right-section2 {

    padding: 15px;
    margin-bottom: 20px;
    transition: border-color 0.3s;
}

.left-section2:hover,
.right-section2:hover {
    border-color: #ff9800;
}

label {
    font-size: 25px;
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
    margin-top: 30px;
    border: 2px solid #ccc;
    border-radius: 10px;
    padding: 8px;
    width: 70%;
}

.address-box {
    border: 1px solid #ddd;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 8px;
    background-color: #f8f9fa;
    position: relative;
    width: 43%;
    margin-right: 35px;
    margin-left: 35px;
    box-sizing: border-box;
    /* รวม padding และ border เข้าไปในความกว้างและความสูงของ element */
}

.address-box p {
    margin: 5px 0;
    max-width: 100%;
    /* ให้ paragraph ไม่เกินความกว้างของ parent */
    box-sizing: border-box;
    /* รวม padding และ border เข้าไปในความกว้างและความสูงของ element */
}

.status {
    position: absolute;
    top: 10px;
    right: 10px;
    font-weight: bold;
    border: 2px solid red;
    padding: 5px;
}

.edit-button {
    position: absolute;
    bottom: 10px;
    right: 10px;
    margin: 5px;
}

/* The switch - the box around the slider */
.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

/* The slider */
.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}

input:checked+.slider {
    background-color: #2196F3;
}

input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
}

input:checked+.slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}
</style>

<body>
             
    <div class="row">
        <div class="col-sm-2">
            <a href="index_log.php?P=1&S=2" class="active" data-bs-toggle="collapse" data-bs-target="#demo1">
                <i class="fi fi-rs-user-pen"></i>ข้อมูลส่วนตัว
            </a>

            <div id="demo1" class="collapse">
                <a href="index_log.php?P=1&S=2" style="font-size: 18px; padding-top: 15px; align-items: center;">
                    <i class="fi fi-rs-user-pen"></i>แก้ไขข้อมูลส่วนตัว
                </a>
                <a href="index_log.php?P=1&S=8" class="active"
                    style="font-size: 18px; padding-top: 15px; align-items: center;">
                    <i class="fi fi-rr-marker"></i>ที่อยู่ส่งจัดส่ง
                </a>
            </div>

            <a href="index_log.php?P=1&S=3">
                <i class="fi fi-rs-shipping-fast"></i>สถานะการจัดส่ง
            </a>

            <a href="index_log.php?P=1&S=4">
                <i class="fi fi-rr-time-forward"></i>ประวัติการสั่งซื้อ
            </a>
        </div>
        <div class="col-sm-8">
            <h1>ที่อยู่ส่งจัดส่ง</h1>
            <div class="row2">
            <?php
                $cusID = $_SESSION["Cus_ID"];
                $sql = "SELECT *
                FROM addresscus
                WHERE Cus_ID = '$cusID'";
                $result = $conn->query($sql);

                // ตรวจสอบว่ามีข้อมูลหรือไม่
                $count = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $modalID = "myModal" . $row['Add_ID'];
                ?>
                <div class="address-box">
                    <!-- ข้อมูลที่ต้องการแสดง -->
                    
                    <p><strong>จังหวัด:</strong> <?php echo $row["Add_Province"]; ?></p>
                    <p><strong>อำเภอ:</strong> <?php echo $row["Add_District"]; ?></p>
                    <p><strong>ตำบล:</strong> <?php echo $row["Add_Subdistrict"]; ?></p>
                    <p><strong>รหัสไปรษณีย์:</strong> <?php echo $row["Add_Zip_code"]; ?></p>
                    <p><strong>ที่อยู่:</strong> <?php echo $row["Add_Address"]; ?></p>
                    
                    <?php if ($row["Add_status"] == 'DEFAULT') : ?>
                    <p class="status"><strong></strong> ค่าเริ่มต้น</p>
                    <?php endif; ?>
                    <div class="edit-button" style="position: absolute; bottom: 10px; right: 10px; margin: 5px;">
                        <a href="" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#<?php echo $modalID; ?>"
                            style="font-size: 16px; padding: 5px 10px; display: flex; align-items: center;">
                            <i class="fi fi-rr-edit" style="font-size: 20px; margin-right: 5px;"></i>แก้ไข
                        </a>
                    </div>
                </div>
                <!-- The Modal -->
                <div class="modal fade" id="<?php echo $modalID; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">แก้ไขที่อยู่ส่งจัดส่ง</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <!-- ส่วนนี้จะถูกแสดงเมื่อคลิกแก้ไข -->
                                <form method="post" action="update_address.php">

                                    <input type="hidden" name="Add_ID" id="Add_ID" class="custom-input2"
                                        style="margin-top: 0px;" value="<?php echo $row["Add_ID"]; ?>">
                                    <input type="hidden" name="Cus_ID" id="Cus_ID" class="custom-input2"
                                        style="margin-top: 0px;" value="<?php echo $cusID; ?>">
                                    <label for="" style=" align-items: center; margin-left: 0px; margin-top: 0px;"><i
                                            class="fi fi-rr-earth-asia" style="margin-right: 5px;"></i>จังหวัด</label>
                                    <section name="provinces" id="provinces">
                                        <select name="provinces" class="custom-input2" style="margin-top: 0px;">
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
                                                    $selected = ($row_provinces['provinces_name_th'] == $row['Add_Province']) ? "selected" : "";
                                                    // สร้าง option สำหรับแต่ละจังหวัด
                                                    echo "<option value='" . $row_provinces['provinces_id'] . "' $selected>" . $row_provinces['provinces_name_th'] . "</option>";
                                                    
                                                    
                                                }
                                            }
                                            ?>
                                        </select>
                                    </section>
                                    <label for="" style=" align-items: center; margin-left: 0px; margin-top: 0px;"><i
                                            class="fi fi-rr-map" style="margin-right: 5px;"></i>อำเภอ</label>
                                    <section name="amphures" id="amphures">
                                        <select name="amphures" class="custom-input2" style="margin-top: 0px;">
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
                                                    $selected2 = ($row2['amphures_name_th'] == $row['Add_District']) ? "selected" : "";
                                                // สร้าง option สำหรับแต่ละจังหวัด
                                                echo "<option value='" . $row2['amphures_id'] . "' $selected2>" . $row2['amphures_name_th'] . "</option>";
                                        
                                                }
                                            } 
                                            ?>
                                        </select>
                                    </section>
                                    <label for="" style=" align-items: center; margin-left: 0px; margin-top: 0px;"><i
                                            class="fi fi-rr-hastag" style="margin-right: 5px;"></i>ตำบล</label>
                                    <section name="districts" id="districts">
                                        <select name="districts" class="custom-input2" style="margin-top: 0px;">
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
                                                    $selected3 = ($row3['districts_name_th'] == $row['Add_Subdistrict']) ? "selected" : "";
                                                    // สร้าง option สำหรับแต่ละจังหวัด
                                                    echo "<option value='" . $row3['id'] . "' $selected3>" . $row3['districts_name_th'] . "</option>";
                                                
                                                }
                                            }
                                            ?>
                                        </select>
                                    </section>
                                    <label for="" style=" align-items: center; margin-left: 0px; margin-top: 0px;"><i
                                            class="fi fi-rr-hastag" style="margin-right: 5px;"></i>รหัสไปรษณีย์</label>
                                    <input type="text" name="zipcode" id="zipcode" class="custom-input2"
                                        style="margin-top: 0px;" value="<?php echo $row['Add_Zip_code']; ?>">
                                    <label for="" style=" align-items: center; margin-left: 0px; margin-top: 0px;"><i
                                            class="fi fi-rr-home-location-alt"
                                            style="margin-right: 5px;"></i>ที่อยู่</label>
                                    <textarea name="Add_Address" id="Add_Address" class="custom-input2" rows="5"
                                        style="width: 100%; margin-top: 0px;"><?php echo $row['Add_Address']; ?></textarea>
                                    <label for="Add_status"
                                        style="align-items: center; margin-left: 0px; margin-top: 0px;">เลือกเป็นที่อยู่ตั้งต้น:</label>
                                    <label class="switch" style="margin-left: 0px; margin-top: 0px;">
                                        <input type="checkbox" name="Add_status" value="DEFAULT"
                                            <?php echo ($row['Add_status'] == 'DEFAULT') ? 'checked disabled' : ''; ?>>
                                        <span class="slider round"></span>
                                    </label><br>

                                    <input type="hidden" name="Add_status" value="RESERVE"><br>
                                    <!-- Hidden field for RESERVE value -->
                                    <button type="submit" class="btn btn-success"
                                        style="margin-left: 270px; width: 40%;">บันทึก</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    $count++;
                    // ถ้าแสดงไปแล้ว 2 อันในแถว ให้ปิดแถวและเริ่มแถวใหม่
                    if ($count % 2 == 0) {
                        echo '</div><div class="row2">';
                    }
                }
                ?>
            </div>
            <center>
                <br>
                <div class="" style="display: flex; justify-content: center;">
                    <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal2"
                        style="display: flex; align-items: center; font-size: 20px;">
                        <i class="fi fi-rr-edit" style="font-size: 30px; margin-right: 5px;"></i>เพิ่มที่อยู่ส่งจัดส่ง
                    </a>
                </div>
            </center>
        </div>




        <!-- The Modal -->
        <div class="modal fade" id="myModal2">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">เพิ่มที่อยู่ส่งจัดส่ง</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <!-- ส่วนนี้จะถูกแสดงเมื่อคลิกแก้ไข -->
                        <form method="post" action="addaddress.php">

                            <input type="hidden" name="Cus_ID" id="Cus_ID" class="custom-input2"
                                style="margin-top: 0px;" value="<?php echo $_SESSION["Cus_ID"]; ?>">
                            <label for="" style=" align-items: center; margin-left: 0px; margin-top: 0px;"><i
                                    class="fi fi-rr-earth-asia" style="margin-right: 5px;"></i>จังหวัด</label>
                            <section name="provinces" id="provinces">
                                <select name="provinces" class="custom-input2">
                                    <option value="">กรุณาเลือกจังหวัด</option>
                                    <?php
                                        // สร้างคำสั่ง SQL เพื่อดึงข้อมูลจากตาราง provinces
                                    $sql = "SELECT provinces_id, provinces_name_th FROM  provinces";
                                    // ทำการ query ข้อมูล
                                    $result = $conn->query($sql);
                                        // ตรวจสอบว่ามีข้อมูลจากการ query หรือไม่
                                        if ($result->num_rows > 0) {
                                            // Loop เพื่อเข้าถึงแต่ละแถวของข้อมูล
                                            while ($row = $result->fetch_assoc()) {
                                                // สร้าง option สำหรับแต่ละจังหวัด
                                                echo "<option value='" . $row['provinces_id'] . "'>" . $row['provinces_name_th'] . "</option>";
                                            }
                                        } else {
                                            echo "0 results";
                                        }

                                        // ปิดการเชื่อมต่อฐานข้อมูล

                                        ?>
                                </select>
                            </section>

                            <label for="" style=" align-items: center; margin-left: 0px; margin-top: 0px;"><i
                                    class="fi fi-rr-map" style="margin-right: 5px;"></i>อำเภอ</label>
                            <section name="amphures" id="amphures">
                                <select name="amphures" class="custom-input2">
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
                                            // สร้าง option สำหรับแต่ละอำเภอ
                                            echo "<option value='" . $row2['amphures_id'] . "'>" . $row2['amphures_name_th'] . "</option>";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>
                                </select>
                            </section>
                            <label for="" style=" align-items: center; margin-left: 0px; margin-top: 0px;"><i
                                    class="fi fi-rr-hastag" style="margin-right: 5px;"></i>ตำบล</label>
                            <section name="districts" id="districts">
                                <select name="districts" class="custom-input2">
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
                                            // สร้าง option สำหรับแต่ละอำเภอ
                                            echo "<option value='" . $row3['id'] . "'>" . $row3['districts_name_th'] . "</option>";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>
                                </select>
                            </section>

                            <label for="" style=" align-items: center; margin-left: 0px; margin-top: 0px;"><i
                                    class="fi fi-rr-hastag" style="margin-right: 5px;"></i>รหัสไปรษณีย์</label>
                            <input type="text" name="zipcode" id="zipcode1" class="custom-input2"
                                style="margin-top: 0px;">

                            <label for="" style=" align-items: center; margin-left: 0px; margin-top: 0px;"><i
                                    class="fi fi-rr-home-location-alt" style="margin-right: 5px;"></i>ที่อยู่</label>
                            <textarea name="Add_Address" id="Add_Address" class="custom-input2" rows="5"
                                style="width: 100%; margin-top: 0px;"></textarea>

                            <button type="submit" class="btn btn-success" style=" margin-left: 250px;">บันทึก</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- ส่วน JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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

    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า add_success ใน Session หรือไม่
        const add_successParam =
            <?php echo isset($_SESSION['add_success']) ? $_SESSION['add_success'] : '0'; ?>;

        // ถ้ามีค่า add_success, ให้แสดง SweetAlert2
        if (add_successParam === 1) {
            Swal.fire({
                icon: 'success',
                title: 'อัพเดตข้อมูลสำเร็จ',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า add_success ใน Session
            <?php unset($_SESSION['add_success']); ?>
        }
    });
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

        // เมื่อมีการเลือกตำบล
        $('select[name="districts"]').change(function() {
            var districtId = $(this).val();

            // โหลดข้อมูล zip code
            $.ajax({
                url: 'getZipCode.php',
                type: 'POST',
                data: {
                    districtId: districtId
                },
                success: function(data) {
                    $('#zipcode').val(data);
                    console.log(data)
                }
            });
        });
    });
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
                    $('#zipcode1').val('');
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
                    $('#zipcode1').val('');
                }
            });
        });

        // เมื่อมีการเลือกตำบล
        $('select[name="districts"]').change(function() {
            var districtId = $(this).val();

            // โหลดข้อมูล zip code
            $.ajax({
                url: 'getZipCode.php',
                type: 'POST',
                data: {
                    districtId: districtId
                },
                success: function(data) {
                    $('#zipcode1').val(data);
                    console.log(data)
                }
            });
        });
    });
    </script>
</body><br>