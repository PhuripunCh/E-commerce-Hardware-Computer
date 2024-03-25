<style>
.col-sm-10 {
    margin-left: 170px;
    background-color: #ffffff;
    border-radius: 5px;
    padding: 30px;
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


.addamount {

    align-items: center;
}

.addamount a {
    text-decoration: none;
    align-items: center;

}

/* สไตล์ที่ให้กับปุ่มอัปโหลดรูปภาพ */
.custom-upload-btn {
    display: inline-block;
    padding: 10px 15px;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    border: 2px solid #3498db;
    color: #3498db;
    border-radius: 5px;
    background-color: #fff;
    transition: background-color 0.3s, color 0.3s;

}

.custom-upload-btn a {
    text-decoration: none;
}

.custom-upload-btn:hover {
    background-color: #3498db;
    color: #fff;

}


/* ซ่อน input[type="file"] */
.insertimg #Pro_Image {
    display: none;
}

#selectedImage {
    max-width: 40%;
    margin-top: 10px;
    display: none;
    border: 2px solid #ddd;
    /* สีขอบ */
    padding: 5px;
    /* ระยะห่างรอบรูปภาพ */
}

.oldimg {
    max-width: 40%;


    border: 2px solid #ddd;
    /* สีขอบ */
    padding: 5px;
    /* ระยะห่างรอบรูปภาพ */
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

#search-result a {
    display: block;
    padding: 10px;
    text-decoration: none;
    color: #333;
    transition: background-color 0.3s;
}

#search-result a:hover {
    background-color: #ddd;
}

.search-container {
    display: flex;
    align-items: center;
}

.search-icon {
    margin-right: 10px;
    color: white;
    font-size: 24px;
}

.dropdown {
    position: relative;
    display: flex;
    align-items: center;
}

.form-control {
    margin-right: 5px;
}

.dropdown-menu {
    position: absolute;
    top: 70%;
    margin-top: 10px;
    width: 290px;
    max-height: 200px;
    /* ปรับตามความต้องการของคุณ */
    overflow-y: auto;
    /* ทำให้เกิดการเลื่อนในแนวแกน Y เมื่อเนื้อหาเกิน */
    margin-left: 10px;
}

.dropdown-menu a {
    display: block;
    padding: 10px;
    text-decoration: none;
    color: #333;
    transition: background-color 0.3s;
}

.dropdown-menu a:hover {
    background-color: #ddd;
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
    left: 30px;
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
        <div style="display: flex;  align-items: center;">
            <h1 style="margin-left: 40px;">เช็คจำนวนสินค้า</h1>

            <div style="display: flex; align-items: center; position: relative; margin-left: 570px; margin-top: 10px;">
                <a href="index_ad.php?C=1&D=3" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#insertModal" style="margin-right: 10px; margin-top: -10px;">
                    <i class="fi fi-rr-apps-add" style="margin-right: 5px; "></i> เพิ่มสินค้า
                </a>

                <form action="index_ad.php?C=1&D=12" method="POST">
                    <div style="position: relative;">
                        <input type="text" id="searchproduct" name="searchproduct" class="custom-input3"
                            placeholder="ค้นหาสินค้า" style="margin-left: 10px; width: 290px; padding-left: 30px;">
                        <button type="submit" class="btn btn-primary"
                            style="margin-left: 10px; margin-top: 0px;">ค้นหา</button>
                        <i class="fas fa-search"
                            style="position: absolute; left: 20px; top: 40%; transform: translateY(-50%);"></i>
                    </div>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="search-result" ></div>
                </form>

            </div>

            <!-- The Modal -->
            <div class="modal fade" id="insertModal">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <div style="display: flex; align-items: center;">
                                <i class="fi fi-rr-box-open-full" style="font-size: 40px; margin-right: 10px;"></i>
                                <h4 class="modal-title">เพิ่มสินค้าใหม่</h4>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                onclick="resetSelectedImage()"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="insertproduct.php" method="POST" enctype="multipart/form-data">
                                <div>
                                    <div style="display: flex; align-items: center;">
                                        <i class="fi fi-rr-pen-field" style="font-size: 25px; margin-right: 10px;"></i>
                                        <label for="Pro_Name" class="form-label">ชื่อสินค้า</label>
                                    </div>
                                    <input type="text" class="custom-input2" id="Pro_Name" placeholder="ชื่อสินค้า"
                                        name="Pro_Name" required>
                                </div>


                                <div>
                                    <div style="display: flex; align-items: center;">
                                        <i class="fi fi-rr-money-check-edit"
                                            style="font-size: 25px; margin-right: 10px;"></i> <label for="Pro_Price"
                                            class="form-label"> ราคาสินค้า</label>
                                    </div>
                                    <input type="text" class="custom-input2" id="Pro_Price" placeholder="ราคาสินค้า"
                                        name="Pro_Price" required>
                                </div>

                                <div>
                                    <div style="display: flex; align-items: center;">
                                        <i class="fi fi-rr-keyboard" style="font-size: 25px; margin-right: 10px;"></i>
                                        <label for="Cate_ID" class="form-label">หมวดหมู่สินค้า</label>
                                    </div>
                                    <select class="custom-input2" id="Cate_ID" name="Cate_ID" required>
                                        <?php
                                        // ดึงข้อมูลจากตาราง category
                                        $sql = "SELECT Cate_ID, Cate_Name FROM category";
                                        $result = mysqli_query($conn, $sql);

                                        // วนลูปเพื่อแสดงตัวเลือก
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value='{$row['Cate_ID']}'>{$row['Cate_Name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div>
                                    <div style="display: flex; align-items: center;">
                                        <i class="fi fi-rr-edit" style="font-size: 25px; margin-right: 10px;"></i>
                                        <label for="Pro_Description" style="margin-top: 5px;"
                                            class="form-label">รายละเอียดสินค้า</label>
                                    </div>
                                    <textarea class="custom-input2" id="Pro_Description" name="Pro_Description" rows="5"
                                        placeholder="รายละเอียดสินค้า" style="margin-top: 5px;"></textarea>
                                </div>
                                <div style="margin-top: -10px;">

                                    <i class="fi fi-rr-box-open" style="font-size: 25px; margin-right: 10px;"></i>
                                    <label for="Pro_Amount" class="form-label">จำนวน</label><br>

                                    <div class="addamount">
                                        <a href="javascript:void(0);" onclick="increaseQuantity()"
                                            style="font-size: 35px;  margin-right: 10px;">+</a>
                                        <input type="text" id="Pro_Amount" class="custom-input2" name="Pro_Amount"
                                            style="width: 80px; height: 40px; text-align: center;" value="1" readonly>
                                        <a href="javascript:void(0);" onclick="decreaseQuantity()"
                                            style="font-size: 35px; margin-left: 10px;">-</a>
                                    </div>
                                </div>
                                <div class="insertimg">
                                    <div style="display: flex; align-items: center;">
                                        <i class="fi fi-rr-picture" style="font-size: 25px; margin-right: 10px;"></i>
                                        <label for="Pro_Image1" style="margin-top: 5px;"
                                            class="form-label">รูปภาพสินค้า</label>

                                        <a href="javascript:void(0);" class="custom-upload-btn"
                                            style="margin-left: 10px;"
                                            onclick="document.getElementById('Pro_Image').click()">
                                            <i class="fi fi-rr-picture"></i> เลือกรูปภาพ
                                        </a>
                                    </div>
                                    <input type="file" id="Pro_Image" name="Pro_Image" accept="image/*"
                                        onchange="displaySelectedImage(this, 'selectedImage')">
                                    <img id="selectedImage" style="max-width: 40%; margin-top: 10px; display: none;" />
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
        </div>
        <table>
            <thead>
                <tr>
                    <th>รูปภาพสินค้า</th>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>จำนวนคงเหลือ</th>
                    <th>ราคา</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'condb.php';

                $sql = "SELECT Pro_ID, Pro_Name, Pro_Price, Pro_Description, Pro_Image, Pro_Amount FROM product";
                $result = mysqli_query($conn, $sql);

                $rows_per_page = 10; // จำนวนรายการต่อหน้า
                $total_rows = mysqli_num_rows($result);
                $total_pages = ceil($total_rows / $rows_per_page); // จำนวนหน้าทั้งหมด

                if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                    $current_page = $_GET['page'];
                } else {
                    $current_page = 1;
                }

                $start_row = ($current_page - 1) * $rows_per_page;
                $sql_pagination = "SELECT Pro_ID, Pro_Name, Pro_Price, Pro_Description, Pro_Image, Pro_Amount
                                   FROM product 
                                   LIMIT $start_row, $rows_per_page";
                $result_pagination = mysqli_query($conn, $sql_pagination);

                while ($row = mysqli_fetch_assoc($result_pagination)) {
                    $modalID = "myModal" . $row['Pro_ID'];
                ?>
                <tr>
                    <td><img src="../uploads/<?php echo $row['Pro_Image']; ?>" alt="Product Image"
                            style="width: 50px; height: auto;"></td>
                    <td><?php echo $row['Pro_ID']; ?></td>
                    <td><?php echo $row['Pro_Name']; ?></td>
                    <td><?php echo $row['Pro_Amount']; ?></td>
                    <td><?php echo $row['Pro_Price']; ?></td>
                    <td style="width: 5%;">
                        <center><a href="#" class="btn btn-warning" data-bs-toggle="modal"
                                style="display: flex; width: 85px;" data-bs-target="#<?php echo $modalID; ?>"><i
                                    class="fi fi-rr-edit"
                                    style="font-size: 20px; margin-right: 5px; display: flex; align-items: center;"></i>แก้ไข</a>
                        </center>
                    </td>
                    <td style="width: 5%;">
                        <center><a href="#" onclick="confirmDelete(<?php echo $row['Pro_ID']; ?>)"
                                class="btn btn-danger" style="display: flex; width: 70px;"><i class="fi fi-rr-trash"
                                    style="font-size: 20px; margin-right: 5px;  display: flex; align-items: center;"></i>ลบ</a>
                        </center>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade product-modal" id="<?php echo $modalID; ?>">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header" style="text-align: center;">
                                <h4 class="modal-title"><?php echo $row['Pro_Name']; ?></h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <center>
                                    <img src="../uploads/<?php echo $row['Pro_Image']; ?>" alt="Product Image"
                                        style="max-width: 40%;" class="oldimg">
                                </center>
                                <form action="updatepro.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="Pro_ID" value="<?php echo $row['Pro_ID']; ?>">
                                    <div>
                                        <div style="display: flex; align-items: center;">
                                            <i class="fi fi-rr-pen-field"
                                                style="font-size: 25px; margin-right: 10px;"></i>
                                            <label for="Pro_Name" class="form-label">ชื่อสินค้า</label>
                                        </div>
                                        <input type="text" class="custom-input2" id="Pro_Name" placeholder="ชื่อสินค้า"
                                            name="Pro_Name" required value="<?php echo $row['Pro_Name']; ?>">
                                    </div>

                                    <div>
                                        <div style="display: flex; align-items: center;">
                                            <i class="fi fi-rr-money-check-edit"
                                                style="font-size: 25px; margin-right: 10px;"></i>
                                            <label for="Pro_Price" class="form-label"> ราคาสินค้า</label>
                                        </div>
                                        <input type="text" class="custom-input2" id="Pro_Price" placeholder="ราคาสินค้า"
                                            name="Pro_Price" required value="<?php echo $row['Pro_Price']; ?>">
                                    </div>

                                    <div>
                                        <div style="display: flex; align-items: center;">
                                            <i class="fi fi-rr-edit" style="font-size: 25px; margin-right: 10px;"></i>
                                            <label for="Pro_Description" style="margin-top: 5px;"
                                                class="form-label">รายละเอียดสินค้า</label>
                                        </div>
                                        <textarea class="custom-input2" id="Pro_Description" name="Pro_Description"
                                            rows="5" placeholder="รายละเอียดสินค้า"
                                            style="margin-top: 5px;"><?php echo $row['Pro_Description']; ?></textarea>
                                    </div>
                                    <div style="margin-top: -10px;">
                                        <i class="fi fi-rr-box-open" style="font-size: 25px; margin-right: 10px;"></i>
                                        <label for="Pro_Amount" class="form-label">จำนวน</label><br>
                                        <div class="addamount">
                                            <input type="number" id="Pro_Amount" class="custom-input2" name="Pro_Amount"
                                                style="width: 80px; height: 40px; text-align: center;" min="0"
                                                value="<?php echo $row['Pro_Amount']; ?>">
                                        </div>
                                    </div>
                                    <div style="margin-top: 10px;">
                                        <label for="Pro_Image" style="font-size: 18px;">อัปโหลดภาพใหม่</label>
                                        <input type="file" class="form-control" id="Pro_Image" name="Pro_Image"
                                            accept="image/*" style="margin-left: 0px;">
                                    </div>

                                    <br>
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
                echo "<li class='page-item'><a class='page-link' href='?page=" . ($current_page - 1) . "'>&#9664; ก่อนหน้า</a></li>";
            }

            for ($page = 1; $page <= $total_pages; $page++) {
                if ($page == $current_page) {
                    echo "<li class='page-item active'><a class='page-link' href='#'>$page</a></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='?page=$page'>$page</a></li>";
                }
            }

            if ($current_page < $total_pages) {
                echo "<li class='page-item'><a class='page-link' href='?page=" . ($current_page + 1) . "'>ต่อไป &#9654;</a></li>";
            }
            ?>
        </div>
    </div><br>
    <script>
    function confirmDelete(Pro_ID) {
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
                window.location.href = `delproduct.php?Pro_ID=${Pro_ID}`;
            }
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า insert_success ใน Session หรือไม่
        const insert_successParam =
            <?php echo isset($_SESSION['insert_success']) ? $_SESSION['insert_success'] : '0'; ?>;

        // ถ้ามีค่า insert_success, ให้แสดง SweetAlert2
        if (insert_successParam === 1) {
            Swal.fire({
                icon: 'success',
                title: 'เพิ่มสินค้าสำเร็จ',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า insert_success ใน Session
            <?php unset($_SESSION['insert_success']); ?>
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า update_success ใน Session หรือไม่
        const update_successParam =
            <?php echo isset($_SESSION['update_success']) ? $_SESSION['update_success'] : '0'; ?>;

        // ถ้ามีค่า update_success, ให้แสดง SweetAlert2
        if (update_successParam === 1) {
            Swal.fire({
                icon: 'success',
                title: 'อัพเดทข้อมูลสินค้าสำเร็จ',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า update_success ใน Session
            <?php unset($_SESSION['update_success']); ?>
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า deletepro_success ใน Session หรือไม่
        const deletepro_successParam =
            <?php echo isset($_SESSION['deletepro_success']) ? $_SESSION['deletepro_success'] : '0'; ?>;

        // ถ้ามีค่า deletepro_success, ให้แสดง SweetAlert2
        if (deletepro_successParam === 1) {
            Swal.fire({
                icon: 'success',
                title: 'ลบข้อมูลสำเร็จ',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า deletepro_success ใน Session
            <?php unset($_SESSION['deletepro_success']); ?>
        }
    });

    function increaseQuantity() {
        var inputElement = document.getElementById('Pro_Amount');
        var currentValue = parseInt(inputElement.value, 10);
        inputElement.value = currentValue + 1;
    }

    function decreaseQuantity() {
        var inputElement = document.getElementById('Pro_Amount');
        var currentValue = parseInt(inputElement.value, 10);
        if (currentValue > 1) {
            inputElement.value = currentValue - 1;
        }
    }


    function displaySelectedImage(input, imageId) {
        var selectedImage = document.getElementById(imageId);
        var file = input.files[0];

        if (file) {
            var reader = new FileReader();

            reader.onload = function(e) {
                selectedImage.src = e.target.result;
                selectedImage.style.display = 'block';
            };

            reader.readAsDataURL(file);
        }
    }

    function resetSelectedImage() {
        var selectedImage = document.getElementById('selectedImage');
        selectedImage.src = '';
        selectedImage.style.display = 'none';
        document.getElementById('Pro_Image').value = '';
    }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        function setValueToInput(value) {
            $('#searchproduct').val(value);
            $('#search-result').empty();
            $('#search-result').removeClass('show');
        }

        $('#searchproduct').on('input', function() {
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