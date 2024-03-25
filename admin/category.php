<link rel='stylesheet'
    href='https://cdn-uicons.flaticon.com/2.0.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
<style>
.col-sm-10 {
    margin-left: 170px;
    background-color: #ffffff;
    border-radius: 10px;
    padding: 30px;
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
    margin-right: auto;
    margin-left: auto;
}

th,
td {
    padding: 15px;
    text-align: center;
    border-bottom: 1px solid #ddd;
    /* เส้นขอบระหว่างแถว */
    border: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
    /* สีพื้นหลังของหัวตาราง */
}



.cate-container {
    display: flex;
    flex-wrap: wrap;
    margin-left: 70px;
    /* ปรับลด margin ที่เกิดจาก flexbox */
}

.catebox {
    text-decoration: none;
    border-radius: 15px;
    border: 2px solid #ddd;
    width: 180px;
    height: 180px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    margin-right: 20px;
    margin-bottom: 20px;
    /* เพิ่ม margin-bottom เพื่อให้ข้อมูลลงบรรทัดใหม่ */
    overflow: hidden;
    position: relative;
    transition: all 0.3s ease;
}

.catebox a {
    text-decoration: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    position: relative;
    z-index: 1;
    color: #333;
    transition: color 0.3s ease;
}

.catebox i {
    margin-bottom: -20px;
    font-size: 40px;
    transition: margin-bottom 0.3s ease;
}

.catebox:hover {
    background-color: #f0f0f0;
    border-color: #bbb;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.catebox:hover a {
    color: #3366cc;
}

.catebox:hover i {
    margin-bottom: 0;
}

.btn-outline-success {
    display: flex;
    margin-left: 20px;
    border: 2px solid #28a745;
    color: #28a745;
    padding: 5px 10px;
    text-decoration: none;
    align-items: center;
}

#image-preview-container {
    text-align: center;
    /* จัดตำแหน่งรูปภาพตรงกลาง */
    margin-top: 10px;
}

#image-preview {
    max-width: 30%;
    height: auto;
    display: inline-block;
    /* ทำให้รูปแสดงตรงกลาง */
}
</style>


<body>
    <div class="col-sm-10">
        <div style="display: flex; align-items: center;">
            <h1 style="margin-left: 70px;">หมวดหมู่สินค้า</h1>

            <div style="display: flex; align-items: center; position: relative; margin-left: 970px; margin-top: 10px;">
                <a href="index_ad.php?C=1&D=3" class="btn btn-outline-success" data-bs-toggle="modal"
                    data-bs-target="#addcateModal" style="margin-right: 10px; margin-top: -10px;">
                    <i class="fi fi-rr-apps-add" style="margin-right: 5px; "></i> เพิ่มหมวดหมู่
                </a>
           
            </div>


            <!-- The Modal -->
            <div class="modal fade" id="addcateModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fi fi-rr-apps-add" style="font-size: 25px;"></i>
                                เพิ่มหมวดหมู่</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form method="POST" action="insertcate.php" enctype="multipart/form-data">
                                <div>
                                    <div style="display: flex; align-items: center;">
                                        <i class="fi fi-rr-pen-field" style="font-size: 25px; margin-right: 10px;"></i>
                                        <label for="Cate_Name" class="form-label">ชื่อหมวดหมู่</label>
                                    </div>
                                    <input type="text" class="custom-input2" id="Cate_Name" placeholder="ชื่อหมวดหมู่"
                                        name="Cate_Name" required>
                                </div>
                                <div>
                                    <div style="display: flex; align-items: center;">
                                        <i class="fi fi-rr-graphic-style"
                                            style="font-size: 25px; margin-right: 10px;"></i>
                                        <label for="Cate_Icon" class="form-label">Icon หมวดหมู่</label>
                                    </div>
                                    <input type="file" class="form-control" id="Cate_Icon" placeholder="Icon หมวดหมู่"
                                        name="Cate_Icon" style="margin-left: 0px;" onchange="previewImage()">
                                </div>
                                <div id="image-preview-container">
                                    <!-- ส่วนนี้ใช้ในการแสดงตัวอย่างภาพ -->
                                    <img id="image-preview" />
                                </div>
                                <br>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <div style="margin-top: 10px;">
                                <button type="submit" class="btn btn-success" style="width: 100px;">บันทึก</button>

                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="cate-container">
            <?php
            $sql = "SELECT Cate_ID, Cate_Name, Cate_Icon FROM category";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $cateID = $row["Cate_ID"];
                    $cateName = $row["Cate_Name"];
                    $cate_Icon = $row["Cate_Icon"];
                    $modalID = "editcateModal_" . $cateID; // Generate a unique modal ID for each category

            ?>
            <div class="catebox">
                <a href="" data-bs-toggle="modal" data-bs-target="#<?php echo $modalID; ?>">
                    <img src="../uploads/<?php echo $row['Cate_Icon']; ?>" alt=""
                        style="width: 80px; height: 80px;"><br><?php echo $cateName?>
                </a>
            </div>

            <!-- The Modal -->
            <div class="modal" id="<?php echo $modalID; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title"><?php echo $cateName; ?></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <center>
                                <h2>แก้ไขข้อมูล</h2>
                            </center>
                            <form action="updatecate.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="Cate_ID" value="<?php echo $row['Cate_ID']; ?>">
                                <div>
                                    <div style="display: flex; align-items: center;">
                                        <i class="fi fi-rr-pen-field" style="font-size: 25px; margin-right: 10px;"></i>
                                        <label for="Cate_Name" class="form-label"> ชื่อหมวดหมู่</label>
                                    </div>
                                    <input type="text" class="custom-input2" id="Cate_Name" placeholder="ชื่อหมวดหมู่"
                                        name="Cate_Name" required value="<?php echo $row['Cate_Name']; ?>">
                                </div>
                                <div>
                                    <div style="display: flex; align-items: center;">
                                        <i class="fi fi-rr-graphic-style"
                                            style="font-size: 25px; margin-right: 10px;"></i>
                                        <label for="Cate_Icon" class="form-label">Iconหมวดหมู่</label>
                                    </div>
                                    <input type="file" class="form-control" id="Cate_Icon" placeholder="Iconหมวดหมู่"
                                        name="Cate_Icon" style="margin-left: 0px;">
                                </div>

                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <div style="margin-top: 10px;">
                                <button type="submit" class="btn btn-success" style="width: 100px;">บันทึก</button>
                                <a href="#" class="btn btn-danger" style="margin-left: 10px;"
                                    onclick="confirmDelete(<?php echo $row['Cate_ID']; ?>)">ลบข้อมูล</a>
                            </div>
                            </form>
                        </div>



                    </div>
                </div>
            </div>
            <?php
                }
            } else {
                echo "0 results";
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>

    </div><br>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า updatecate_success ใน Session หรือไม่
        const updatecate_successParam =
            <?php echo isset($_SESSION['updatecate_success']) ? $_SESSION['updatecate_success'] : '0'; ?>;

        // ถ้ามีค่า updatecate_success, ให้แสดง SweetAlert2
        if (updatecate_successParam === 1) {
            Swal.fire({
                icon: 'success',
                title: 'อัพเดทข้อมูลสำเร็จ',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า updatecate_success ใน Session
            <?php unset($_SESSION['updatecate_success']); ?>
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า insertcate_success ใน Session หรือไม่
        const insertcate_successParam =
            <?php echo isset($_SESSION['insertcate_success']) ? $_SESSION['insertcate_success'] : '0'; ?>;

        // ถ้ามีค่า insertcate_success, ให้แสดง SweetAlert2
        if (insertcate_successParam === 1) {
            Swal.fire({
                icon: 'success',
                title: 'เพิ่มหมวดหมู่สำเร็จ',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า insertcate_success ใน Session
            <?php unset($_SESSION['insertcate_success']); ?>
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า deletecate_success ใน Session หรือไม่
        const deletecate_successParam =
            <?php echo isset($_SESSION['deletecate_success']) ? $_SESSION['deletecate_success'] : '0'; ?>;

        // ถ้ามีค่า deletecate_success, ให้แสดง SweetAlert2
        if (deletecate_successParam === 1) {
            Swal.fire({
                icon: 'success',
                title: 'ลบข้อมูลสำเร็จ',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า deletecate_success ใน Session
            <?php unset($_SESSION['deletecate_success']); ?>
        }
    });


    function confirmDelete(Cate_ID) {
        Swal.fire({
            title: "คุณแน่ใจหรือไม่?",
            text: "หากคุณลบข้อมูลคุณจะไม่สามารถกู้คืนข้อมูลนี้ได้!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ใช่, ลบ!",
            cancelButtonText: "ยกเลิก"
        }).then((result) => {
            if (result.isConfirmed) {
                // ถ้าผู้ใช้กด "ใช่" ใน SweetAlert2
                window.location.href = `delcate.php?Cate_ID=${Cate_ID}`;
            }
        });
    }

    // ฟังก์ชันที่เรียกเมื่อมีการเลือกไฟล์
    function previewImage() {
        var input = document.getElementById('Cate_Icon');
        var preview = document.getElementById('image-preview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>
</body>