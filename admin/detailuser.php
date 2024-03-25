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

.btn-outline-primary i {
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
.custom-input3 {
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

.custom-input3:hover,
.custom-input3:focus {
    border-color: #ff9800;
}

.custom-input3::placeholder {
    position: absolute;
    top: 8px;
    left: 35px;
    font-size: 16px;
    color: #888;
    opacity: 1;
    transition: transform 0.3s, opacity 0.3s;
}

.custom-input3:hover::placeholder,
.custom-input3:focus::placeholder {
    transform: translateY(-20px);
    opacity: 0;
}
</style>

<body>
    <div class="col-sm-10">
        <div style="display: flex; align-items: center;">
            <h1 style="margin-left: 70px;">ข้อมูลผู้ใช้</h1>


            <div style="display: flex; align-items: center; position: relative; margin-left: 890px; margin-top: 10px;">

                
                <form action="index_ad.php?C=1&D=13" method="post">
         
                    <input type="text" id="searchuser" name="searchuser" class="custom-input3"
                        placeholder="ค้นหาผู้ใช้" style="margin-left: 10px; width: 290px; padding-left: 35px;">
                        
                    <button type="submit" class="btn btn-primary"
                        style="margin-left: 10px; margin-top: 0px;">ค้นหา</button>
                        <i class="fas fa-search"
                            style="position: absolute; left: 25px; top: 40%; transform: translateY(-50%);"></i>
                    </form>
            </div>

        </div>
        <div style="display: flex; align-items: center; margin-left: 50px; ">
            <a href="index_ad.php?C=1&D=2" class="btn btn-outline-primary active">
                <i class="fi fi-rr-user"></i>USER
            </a>
            <a href="index_ad.php?C=1&D=3" class="btn btn-outline-primary ">
                <i class="fi fi-rr-user-gear"></i>ADMIN
            </a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>เลขIDผู้ใช้</th>
                    <th>Username</th>
                    
                    <th>ชื่อ-นามสกุล</th>
                    <th>ที่อยู่</th>
                    <th>อีเมล</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>สถานะ</th>
                    <th>ลบข้อมูล</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include 'condb.php';

                $sql = "SELECT Cus_ID, Cus_Username, Cus_Password, Cus_Email, Cus_tel, Cus_FName, Cus_LName, Cus_Status
                        FROM customer
                        WHERE Cus_Status = 'USER'";
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
                                    WHERE Cus_Status = 'USER' 
                                    LIMIT $start_row, $rows_per_page";
                $result_pagination = mysqli_query($conn, $sql_pagination);

                while ($row = mysqli_fetch_assoc($result_pagination)) {
                    $modalID = "myModal" . $row['Cus_ID'];

                    // ดึงข้อมูล address ที่มี Add_status เป็น 'DEFAULT'
                    $sql_address = "SELECT Add_Address, Add_Province, Add_District, Add_Zip_code
                                    FROM addresscus
                                    WHERE Cus_ID = {$row['Cus_ID']} AND Add_Status = 'DEFAULT'";
                    $result_address = mysqli_query($conn, $sql_address);
                    $row_address = mysqli_fetch_assoc($result_address);
                    ?>
        <tr>
            <td><?= $row['Cus_ID']; ?></td>
            <td><?= $row['Cus_Username']; ?></td>
            
            <td style="width: 15%;"><?= $row['Cus_FName']; ?>-<?= $row['Cus_LName']; ?></td>
            <td>
                <?php if ($result_address && mysqli_num_rows($result_address) > 0) { ?>
                    <?= $row_address['Add_Address']; ?><br>
                    จังหวัด<?= $row_address['Add_Province']; ?>,อำเภอ<?= $row_address['Add_District']; ?>,รหัสไปรษณีย์<?= $row_address['Add_Zip_code']; ?>
                <?php } else { ?>
                    ยังไม่มีที่อยู่
                <?php
 } 
                ?>
            </td>
            <td><?= $row['Cus_Email']; ?></td>
            <td><?= $row['Cus_tel']; ?></td>
            <td><?= $row['Cus_Status']; ?></td>


                    <td style="width: 5%;">
                        <center><a href="#" onclick="confirmDelete(<?php echo $row['Cus_ID']; ?>)"
                                class="btn btn-danger" style="display: flex; width: 70px;"><i class="fi fi-rr-trash"
                                    style="font-size: 20px; margin-right: 5px;  display: flex; align-items: center;"></i>ลบ</a>
                        </center>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="<?php echo $modalID; ?>">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><?php echo $row['Cus_Username']; ?></h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Add other details as needed -->
                                <form action="updateuser.php" method="post" enctype="multipart/form-data">
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
                                            <i class="fi fi-rr-money-check-edit"
                                                style="font-size: 25px; margin-left: 90px; margin-right: 10px;"></i>
                                            <label for="Add_Province" class="form-label"> จังหวัด</label>
                                        </div>
                                        <div class="flex-container">
                                            <input type="text" class="custom-input2" id="Cus_tel"
                                                placeholder="ราคาสินค้า" name="Cus_tel" required
                                                value="<?php echo $row['Cus_tel']; ?>" style=" margin-right: 10px;">
                                            <input type="text" class="custom-input2" id="Add_Province"
                                                placeholder="จังหวัด" name="Add_Province" required
                                                value="<?php echo $row_address['Add_Province']; ?>">
                                        </div>
                                    </div>
                                    <div>
                                        <div style="display: flex; align-items: center;">
                                            <i class="fi fi-rr-money-check-edit"
                                                style="font-size: 25px; margin-right: 10px;"></i> <label
                                                for="Add_District" class="form-label"> อำเภอ</label>
                                            <i class="fi fi-rr-money-check-edit"
                                                style="font-size: 25px ;margin-left: 140px; margin-right: 10px;"></i>
                                            <label for="Add_Zip_code" class="form-label"> รหัสไปรษณีย์</label>
                                        </div>
                                        <div class="flex-container">
                                            <input type="text" class="custom-input2" id="Add_District"
                                                placeholder="อำเภอ" name="Add_District" style=" margin-right: 10px;"
                                                required value="<?= $row_address['Add_District']; ?>">
                                            <input type="text" class="custom-input2" id="Add_Zip_code"
                                                placeholder="รหัสไปรษณีย์" name="Add_Zip_code" required
                                                value="<?php echo  $row_address['Add_Zip_code']; ?>">
                                        </div>
                                    </div>
                                    <div>
                                        <div style="display: flex; align-items: center;">
                                            <i class="fi fi-rr-money-check-edit"
                                                style="font-size: 25px; margin-right: 10px;"></i> <label
                                                for="Cus_Address" style="margin-top: 5px; ">ที่อยู่</label>
                                        </div>
                                        <textarea class="custom-input2" id="Cus_Address" name="Cus_Address" rows="5"
                                            placeholder="รายละเอียดที่อยู่"
                                            style="margin-top: 5px; "><?php echo $row_address['Add_Address']; ?></textarea>


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
                                    <button type="submit" class="btn btn-success" style="width: 100px; ">บันทึก</button>

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
                window.location.href = `deluser.php?Cus_ID=${Cus_ID}`;
            }
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า updateus_success ใน Session หรือไม่
        const updateus_successParam =
            <?php echo isset($_SESSION['updateus_success']) ? $_SESSION['updateus_success'] : '0'; ?>;

        // ถ้ามีค่า updateus_success, ให้แสดง SweetAlert2
        if (updateus_successParam === 1) {
            Swal.fire({
                icon: 'success',
                title: 'อัพเดทข้อมูลผู้ใช้สำเร็จ',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า updateus_success ใน Session
            <?php unset($_SESSION['updateus_success']); ?>
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า deleteuser_success ใน Session หรือไม่
        const deleteuser_successParam =
            <?php echo isset($_SESSION['deleteuser_success']) ? $_SESSION['deleteuser_success'] : '0'; ?>;

        // ถ้ามีค่า deleteuser_success, ให้แสดง SweetAlert2
        if (deleteuser_successParam === 1) {
            Swal.fire({
                icon: 'success',
                title: 'ลบข้อมูลผู้ใช้สำเร็จ',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า deleteuser_success ใน Session
            <?php unset($_SESSION['deleteuser_success']); ?>
        }
    });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        function setValueToInput(value) {
            $('#searchuser').val(value);
            $('#search-result').empty();
            $('#search-result').removeClass('show');
        }

        $('#searchuser').on('input', function() {
            var searchText = $(this).val().trim();

            if (searchText != '') {
                $.ajax({
                    type: 'post',
                    url: 'search.php', // ตั้งชื่อไฟล์ PHP ที่จะใช้ในการค้นหา
                    data: {
                        search: searchText
                    },
                    success: function(response) {
                        $('#search-result').html(response);
                        $('#search-result').addClass('show');

                        // ให้ทุกรายการใน dropdown สามารถคลิกได้
                        $('#search-result a').on('click', function(e) {
                            e.preventDefault();
                            var selectedValue = $(this).text();
                            setValueToInput(selectedValue);
                        });
                    }
                });
            } else {
                $('#search-result').empty();
                $('#search-result').removeClass('show');
            }
        });

        // ปรับแต่งเพื่อทำให้ dropdown หายไปเมื่อคลิกที่พื้นที่นอก dropdown
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.search-container').length) {
                $('#search-result').empty();
                $('#search-result').removeClass('show');
            }
        });
    });
</script>
</body>