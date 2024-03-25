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
    transition: background-color 0.3s ease;
}

th {
    background-color: #f2f2f2;
    /* สีพื้นหลังของหัวตาราง */
}


tr:hover td {
    background-color: #e6f7ff;
    /* สีที่ต้องการให้เมื่อชี้ที่แถว */
}


.btn-outline-primary {

    display: flex;
    margin-left: 20px;
    border: 2px solid #007bff;
    color: #007bff;
    padding: 5px 10px;
    text-decoration: none;
    align-items: center;
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

.btn-outline-primary i {
    align-items: center;
    font-size: 25px;
    display: flex;
    margin-right: 5px;
}

.btn-outline-success i {
    align-items: center;
    font-size: 25px;
    display: flex;
    margin-right: 5px;
}

.btn-outline-primary.active {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
}
</style>

<body>
    <div class="col-sm-10">
        <div style="display: flex; align-items: center;">
            <h1 style="margin-left: 70px;">ข้อมูลพนักงาน</h1>

            <div style="display: flex; align-items: center; position: relative; margin-left: 630px; margin-top: 10px;">
                <a href="index_ad.php?C=1&D=3" class="btn btn-outline-success" data-bs-toggle="modal"
                    data-bs-target="#addadminModal" style="margin-right: 10px; margin-top: -10px;">
                    <i class="fi fi-rr-user-add"></i> เพิ่มพนักงาน
                </a>
                <i class="fi fi-rr-search" style="font-size: 20px;"></i>
                <input type="text" id="searchInput" class="custom-input2" placeholder="ค้นหาผู้ใช้"
                    style="margin-left: 10px; width: 290px;">
            </div>


            <!-- The Modal -->
            <div class="modal fade" id="addadminModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fi fi-rr-user-add" style="font-size: 25px;"></i>
                                เพิ่มพนักงาน</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form method="POST" action="insert_admin.php">
                                <div>
                                    <div style="display: flex; align-items: center;">
                                        <i class="fas fa-user" style="font-size: 25px; margin-right: 5px;"></i> <label
                                            for="Cus_Username">
                                            ชื่อผู้ใช้งาน</label>
                                    </div>
                                    <input type="Username" class="custom-input2" id="Cus_Username"
                                        placeholder="ชื่อผู้ใช้งาน" name="Cus_Username" required>
                                </div><br>
                                <div>
                                    <div style="display: flex; align-items: center;">
                                        <i class="fas fa-lock-open" style="font-size: 25px; margin-right: 5px;"></i>
                                        <label for="Cus_Password" class="form-label"> รหัสผ่าน</label>
                                    </div>
                                    <input type="password" class="custom-input2" id="Cus_Password"
                                        placeholder="รหัสผ่าน" name="Cus_Password" required>
                                </div><br>
                                <div style="display: flex; align-items: center;">
                                    <i class="fas fa-address-book" style="font-size: 25px; margin-right: 5px;"></i>
                                    <label for="" class="form-label"> ชื่อ-นามสกุล</label>
                                </div>
                                <div class="flex-container">

                                    <input type="text" class="custom-input2" id="Cus_FName" required placeholder="ชื่อ"
                                        name="Cus_FName">-
                                    <input type="text" class="custom-input2" id="Cus_LName" required
                                        placeholder="นามสกุล" name="Cus_LName">
                                </div><br>
                                <div>
                                    <div style="display: flex; align-items: center;">
                                        <i class="fas fa-envelope" style="font-size: 25px; margin-right: 5px;"></i>
                                        <label for="" class="form-label"> อีเมล</label>
                                    </div>
                                    <input type="email" class="custom-input2" id="Cus_Email" required
                                        placeholder="อีเมล" name="Cus_Email">
                                </div><br>
                                <div>
                                    <div style="display: flex; align-items: center;">
                                        <i class="fas fa-phone" style="font-size: 25px; margin-right: 5px;"></i>
                                        <label for="" class="form-label"> เบอร์โทรศัพท์</label>
                                    </div>
                                    <input type="text" class="custom-input2" id="Cus_tel" placeholder="เบอร์โทรศัพท์"
                                        name="Cus_tel" required>
                                </div><br>

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
        </div>
        <div style="display: flex; align-items: center; margin-left: 50px; ">
            <a href="index_ad.php?C=1&D=2" class="btn btn-outline-primary">
                <i class="fi fi-rr-user"></i>USER
            </a>
            <a href="index_ad.php?C=1&D=3" class="btn btn-outline-primary active">
                <i class="fi fi-rr-user-gear"></i>ADMIN
            </a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>เลขIDผู้ใช้</th>
                    <th>Username</th>
                    <th>รหัสผ่าน</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>อีเมล</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>สถานะ</th>
                    <th>แก้ไขข้อมูล</th>
                    <th>ลบข้อมูล</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include 'condb.php';

                    $sql = "SELECT Cus_ID, Cus_Username, Cus_Password, Cus_Email, Cus_tel, Cus_FName, Cus_LName, Cus_Status
                            FROM customer
                            WHERE Cus_Status = 'ADMIN'"; // เพิ่มเงื่อนไข WHERE เพื่อกรองเฉพาะ Cus_Status เป็น 'USER'
                    $result = mysqli_query($conn, $sql);
                    
                    $rows_per_page = 10;
                    $total_rows = mysqli_num_rows($result);
                    $total_pages = ceil($total_rows / $rows_per_page);
                    
                    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                        $current_page = $_GET['page'];
                    } else {
                        $current_page = 1;
                    }
                    
                    $start_row = ($current_page - 1) * $rows_per_page;
                    $sql_pagination = "SELECT Cus_ID, Cus_Username, Cus_Password, Cus_Email, Cus_tel, Cus_FName, Cus_LName, Cus_Status
                                        FROM customer 
                                        WHERE Cus_Status = 'ADMIN' 
                                        LIMIT $start_row, $rows_per_page";
                    $result_pagination = mysqli_query($conn, $sql_pagination);
                    while ($row = mysqli_fetch_assoc($result_pagination)) {
                        $modalID = "myModal" . $row['Cus_ID'];
                ?>
                <tr>
                    <!-- Modify these lines to display the desired customer information -->
                    <td><?php echo $row['Cus_ID']; ?></td>
                    <td><?php echo $row['Cus_Username']; ?></td>
                    <td><?php echo $row['Cus_Password']; ?></td>
                    <td><?php echo $row['Cus_FName']; ?>-<?php echo $row['Cus_LName']; ?></td>
                    <td><?php echo $row['Cus_Email']; ?></td>
                    <td><?php echo $row['Cus_tel']; ?></td>
                    <td><?php echo $row['Cus_Status']; ?></td>

                    <!-- Modify the modal accordingly -->
                    <td style="width: 5%;">
                        <center><a href="#" class="btn btn-warning" data-bs-toggle="modal"
                                style="display: flex; width: 85px;" data-bs-target="#<?php echo $modalID; ?>"><i
                                    class="fi fi-rr-edit"
                                    style="font-size: 20px; margin-right: 5px; display: flex; align-items: center;"></i>แก้ไข</a>
                        </center>
                    </td>
                    <td style="width: 5%;">
                        <center><a href="#" onclick="confirmDelete(<?php echo $row['Cus_ID']; ?>)"
                                class="btn btn-danger" style="display: flex; width: 70px;"><i class="fi fi-rr-trash"
                                    style="font-size: 20px; margin-right: 5px;  display: flex; align-items: center;"></i>ลบ</a>
                        </center>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="<?php echo $modalID; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><?php echo $row['Cus_Username']; ?></h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Add other details as needed -->
                                <form action="update_admin.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="Cus_ID" value="<?php echo $row['Cus_ID']; ?>">
                                    <div>
                                        <div style="display: flex; align-items: center;">
                                            <i class="fi fi-rr-pen-field"
                                                style="font-size: 25px; margin-right: 10px;"></i>
                                            <label for="Cus_Username" class="form-label">Username</label>
                                        </div>
                                        <input type="text" class="custom-input2" id="Cus_Username"
                                            placeholder="ชื่อสินค้า" name="Cus_Username" required
                                            value="<?php echo $row['Cus_Username']; ?>">
                                    </div>

                                    <div>
                                        <div style="display: flex; align-items: center;">
                                            <i class="fi fi-rr-money-check-edit"
                                                style="font-size: 25px; margin-right: 10px;"></i> <label
                                                for="Cus_Password" class="form-label"> รหัสผ่าน</label>
                                        </div>
                                        <input type="text" class="custom-input2" id="Cus_Password"
                                            placeholder="ราคาสินค้า" name="Cus_Password" required
                                            value="<?php echo $row['Cus_Password']; ?>">
                                    </div>
                                    <i class="fas fa-address-book" style="font-size: 25px;"></i>
                                    <label for="" class="form-label">ชื่อ-นามสกุล</label>
                                    <div class="flex-container">

                                        <input type="text" class="custom-input2" id="Cus_FName" required
                                            placeholder="ชื่อ" name="Cus_FName"
                                            value="<?php echo $row['Cus_FName']; ?>">-
                                        <input type="text" class="custom-input2" id="Cus_LName" required
                                            placeholder="นามสกุล" name="Cus_LName"
                                            value="<?php echo $row['Cus_LName']; ?>">
                                    </div>
                                    <div>
                                        <div style="display: flex; align-items: center;">
                                            <i class="fi fi-rr-money-check-edit"
                                                style="font-size: 25px; margin-right: 10px;"></i> <label for="Cus_Email"
                                                class="form-label"> Email</label>
                                        </div>
                                        <input type="text" class="custom-input2" id="Cus_Email" placeholder="ราคาสินค้า"
                                            name="Cus_Email" required value="<?php echo $row['Cus_Email']; ?>">
                                    </div>
                                    <div>
                                        <div style="display: flex; align-items: center;">
                                            <i class="fi fi-rr-money-check-edit"
                                                style="font-size: 25px; margin-right: 10px;"></i> <label for="Cus_tel"
                                                class="form-label"> เบอร์โทรศัพท์</label>
                                        </div>
                                        <input type="text" class="custom-input2" id="Cus_tel" placeholder="ราคาสินค้า"
                                            name="Cus_tel" required value="<?php echo $row['Cus_tel']; ?>">
                                    </div>
                                    <div>
                                        <div style="display: flex; align-items: center;">
                                            <i class="fi fi-rr-money-check-edit"
                                                style="font-size: 25px; margin-right: 10px;"></i>
                                            <label for="Cus_Status" class="form-label"> สถานะ</label>
                                        </div>

                                        <label>
                                            <input type="radio" name="Cus_Status" value="USER"
                                                <?php echo ($row['Cus_Status'] == 'USER') ? 'checked' : ''; ?>>
                                            USER
                                        </label>

                                        <label>
                                            <input type="radio" name="Cus_Status" value="ADMIN"
                                                <?php echo ($row['Cus_Status'] == 'ADMIN') ? 'checked' : ''; ?>>
                                            ADMIN
                                        </label>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <div style="margin-top: 10px;">
                                    <button type="submit" class="btn btn-success" style="width: 100px;">บันทึก</button>

                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
        }
        ?>
            </tbody>
        </table>

        <!-- Pagination links go here -->
        <div class="pagination">
            <?php
                if ($current_page > 1) {
                    echo "<li class='page-item'><a class='page-link' href='index_ad.php?C=1&D=2&page=" . ($current_page - 1) . "'>&#9664; ก่อนหน้า</a></li>";
                }

                for ($page = 1; $page <= $total_pages; $page++) {
                    if ($page == $current_page) {
                        echo "<li class='page-item active'><a class='page-link' href='#'>$page</a></li>";
                    } else {
                        echo "<li class='page-item'><a class='page-link' href='index_ad.php?C=1&D=2&page=$page'>$page</a></li>";
                    }
                }

                if ($current_page < $total_pages) {
                    echo "<li class='page-item'><a class='page-link' href='index_ad.php?C=1&D=2&page=" . ($current_page + 1) . "'>ต่อไป &#9654;</a></li>";
                }
            ?>
        </div>

    </div><br>
    <script>
    function confirmDelete(Cus_ID) {
        Swal.fire({
            title: "คุณแน่ใจหรือไม่?",
            text: "คุณจะไม่สามารถกู้คืนข้อมูลนี้ได้!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ใช่, ลบ!",
            cancelButtonText: "ยกเลิก"
        }).then((result) => {
            if (result.isConfirmed) {
                // ถ้าผู้ใช้กด "ใช่" ใน SweetAlert2
                window.location.href = `deladmin.php?Cus_ID=${Cus_ID}`;
            }
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า registerad_error ใน Session หรือไม่
        const registerError =
            <?php echo isset($_SESSION['registerad_error']) ? json_encode($_SESSION['registerad_error']) : 'null'; ?>;

        // ถ้ามีค่า registerad_error, ให้แสดง SweetAlert2
        if (registerError) {
            let errorMessage = '';

            if (registerError === 'user_tel') {
                errorMessage = 'มีชื่อผู้ใช้และเบอร์โทรศัพท์นี้ในระบบแล้ว';
            } else if (registerError === 'user') {
                errorMessage = 'มีชื่อผู้ใช้นี้ในระบบแล้ว';
            } else if (registerError === 'tel') {
                errorMessage = 'มีเบอร์โทรศัพท์นี้ในระบบแล้ว';
            }

            Swal.fire({
                icon: 'error',
                title: 'ลงทะเบียนไม่สำเร็จ',
                text: errorMessage,
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า registerad_error ใน Session
            <?php unset($_SESSION['registerad_error']); ?>
        }


        // ตรวจสอบว่ามีค่า registerad_success ใน Session หรือไม่
        const registerSuccess =
            <?php echo isset($_SESSION['registerad_success']) ? $_SESSION['registerad_success'] : '0'; ?>;

        // ถ้ามีค่า registerad_success, ให้แสดง SweetAlert2
        if (registerSuccess) {
            Swal.fire({
                icon: 'success',
                title: 'ลงทะเบียนสำเร็จ',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า registerad_success ใน Session
            <?php unset($_SESSION['registerad_success']); ?>
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า updatead_success ใน Session หรือไม่
        const updatead_successParam =
            <?php echo isset($_SESSION['updatead_success']) ? $_SESSION['updatead_success'] : '0'; ?>;

        // ถ้ามีค่า updatead_success, ให้แสดง SweetAlert2
        if (updatead_successParam === 1) {
            Swal.fire({
                icon: 'success',
                title: 'อัพเดทข้อมูลผู้ดูแลระบบเสร็จสิ้น',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า updatead_success ใน Session
            <?php unset($_SESSION['updatead_success']); ?>
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า deleteadmin_success ใน Session หรือไม่
        const deleteadmin_successParam =
            <?php echo isset($_SESSION['deleteadmin_success']) ? $_SESSION['deleteadmin_success'] : '0'; ?>;

        // ถ้ามีค่า deleteadmin_success, ให้แสดง SweetAlert2
        if (deleteadmin_successParam === 1) {
            Swal.fire({
                icon: 'success',
                title: 'ลบข้อมูลผู้ดูแลระบบสำเร็จ',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า deleteadmin_success ใน Session
            <?php unset($_SESSION['deleteadmin_success']); ?>
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า deleteadmin_error ใน Session หรือไม่
        const deleteadmin_errorParam =
            <?php echo isset($_SESSION['deleteadmin_error']) ? $_SESSION['deleteadmin_error'] : '0'; ?>;

        // ถ้ามีค่า deleteadmin_error, ให้แสดง SweetAlert2
        if (deleteadmin_errorParam === 1) {
            Swal.fire({
                icon: 'error',
                title: 'ไม่สามารถลบข้อมูลผู้ดูแลที่เข้าสู่ระบบอยู่ได้',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า deleteadmin_error ใน Session
            <?php unset($_SESSION['deleteadmin_error']); ?>
        }
    });
    </script>
</body>