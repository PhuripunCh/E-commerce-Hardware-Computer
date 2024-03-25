<?php
session_start();
$A      = @@$_REQUEST['A'];
$B      = @@$_REQUEST['B'];


include 'pages/condb.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/2.0.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="stylesheet" href="css/stylenav1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;700&display=swap">
    <script src="https://kit.fontawesome.com/76476022b8.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-brands/css/uicons-brands.css'>
    <link rel="stylesheet" href="java/sweetalert2@11.js">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
    body {
        font-family: 'Prompt', sans-serif;
    }

    .login-link {
        display: flex;
        align-items: center;
        margin-right: 50px;
    }

    .login-link i {
        font-size: 24px;
        /* ปรับขนาดไอคอนตามที่ต้องการ */
        margin-right: 5px;
        /* ระยะห่างระหว่างไอคอนกับข้อความ */
        display: flex;
        align-items: center;
    }

    .offcanvas-body a:hover {
        color: rgb(255, 255, 255);
        margin-right: -10px;
    }

    .card {
        display: flex;
        flex-direction: column;
        align-items: center;
        box-shadow: 0 20px 30px rgba(0, 0, 0, 0.3);

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


    /* สไตล์ปุ่มแชท */
    .chat-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 999;
    }

    .chat-button button {
        padding: 10px 20px;
        font-size: 16px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    /* ปรับแต่ง CSS เพื่อให้ข้อความแสดงผลได้ดีขึ้น */
    .messages {
        max-height: 200px;
        overflow-y: auto;
        padding: 10px;
        border-bottom: 1px solid #ccc;
    }

    .message {
        margin-bottom: 10px;
        padding: 8px;
        background-color: #e6e6e6;
        border-radius: 5px;
    }

    /* สไตล์ของหน้าต่างแชท */
    .chat-popup {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 20px;
        border: 1px solid #ccc;
        z-index: 999;
    }

    .chat-container {
        max-width: 300px;
        padding: 10px;
        background-color: #f1f1f1;
    }

    .header {
        background-color: #4CAF50;
        color: white;
        padding: 15px;
        text-align: center;
        font-size: 18px;
    }

    .close {
        float: right;
        font-size: 24px;
        cursor: pointer;
    }

    #chat-input {
        width: 100%;
        padding: 10px;
        border: none;
        border-top: 1px solid #ccc;
        resize: none;
    }

    #send-message {
        width: 100%;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-top: 1px solid #ccc;
        cursor: pointer;
    }

    /* ปรับแต่ง CSS เพื่อแสดงผลข้อความผู้ใช้และข้อความระบบ */
    .user-message {
        margin-bottom: 10px;
        padding: 8px;
        background-color: rgba(0, 100, 0, 0.3);
        /* เปลี่ยนเป็นสีเขียวอ่อนแบบไลน์ */
        border-radius: 5px;
        margin-left: auto;
        /* จะทำให้ข้อความของผู้ใช้อยู่ทางขวา */
        max-width: 70%;
        /* ปรับขนาดข้อความให้ไม่ครอบทั้งหมด */
        color: #000;
        /* เปลี่ยนเป็นสีดำ */
    }

    .system-message {
        margin-bottom: 10px;
        padding: 8px;
        background-color: #e6e6e6;
        border-radius: 5px;
        margin-right: auto;
        /* จะทำให้ข้อความระบบอยู่ทางซ้าย */
        max-width: 70%;
        /* ปรับขนาดข้อความให้ไม่ครอบทั้งหมด */
        color: #000;
        /* สีเขียวอ่อน */
    }

    #search-result a {
        display: block;
        padding: 10px;
        text-decoration: none;
        color: #333;
        /* สีตัวอักษร */
        transition: background-color 0.3s;
    }

    #search-result a:hover {
        background-color: #ddd;
        /* สีพื้นหลังเมื่อ hover */
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
        display: flex;
        align-items: center;
    }

    .form-control {
        margin-right: 5px;
        /* ปรับระยะห่างของ input กับปุ่ม */
    }

    .dropdown-menu {
        margin-top: 10px;
        width: 400px;
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

    .underline-on-hover:hover {
        text-decoration: underline;
        font-size: 18px;
    }
    </style>
</head>

<body>

    <nav class="navbar">
        <!-- Offcanvas Sidebar -->
        <div class="offcanvas offcanvas-start" id="demo">
            <div class="offcanvas-header">
                <h1 class="offcanvas-title">หมวดหมู่สินค้า</h1>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <?php
                // ดึงข้อมูลจากตาราง category
                $sql = "SELECT * FROM category";
                $result = mysqli_query($conn, $sql);

                // แสดงลิงก์และ icon จากข้อมูล category
                while ($row = mysqli_fetch_assoc($result)) {
                    $cateName = $row['Cate_Name'];
                    $cateIcon = $row['Cate_Icon'];
                    $cateID = $row['Cate_ID'];
                    ?>
                <a href='index.php?A=1&B=5&Cate_ID=<?php echo $cateID; ?>'
                    style='display: inline-flex; align-items: center; font-size: 22px;'>
                    <img src="uploads/<?php echo $row['Cate_Icon']; ?>" alt=""
                        style="width: 40px; height: 40px; margin-right: 10px;"><?php echo $cateName; ?>
                </a><br><br>
                <?php
                }
                ?>
            </div>
        </div>

        <!-- Button to open the offcanvas sidebar -->

        <a href="" data-bs-toggle="offcanvas" data-bs-target="#demo">
            <div class="menu-icon" style="margin-left: 50px; font-size: 30px;">&#9776;</div>
        </a>
        <div class="container">


            <a href="index.php" class="logo">
                <i class=""><img src="img/logo.png" alt="" width="70px" height="auto"></i>
                <!-- ใช้ FontAwesome ไอคอน -->
                TheFast Gaming gear
            </a>

            <ul class="nav-links">
                <div class="search-container">
                    <span class="search-icon">
                        <i class="fas fa-search" style="font-size: 30px;"></i>
                    </span>
                    <form action="" method="get" class="d-flex">
                        <div class="dropdown">
                            <input type="text" class="form-control" id="searchitem" placeholder="ค้นหาสินค้า"
                                name="searchitem" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                style="width: 400px; ">
                            <button type="submit" class="btn btn-primary">ค้นหา</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="search-result"></div>
                        </div>
                    </form>
                </div>
            </ul>

            <div class="user-actions">

                <a href="index.php?P=1&S=2" data-bs-toggle="modal" data-bs-target="#myModal1" class="login-link">
                    <img src="img/login-door.png" alt="" style="width: 40px; height: 40px; margin-right: 10px;">
                    เข้าสู่ระบบ
                </a>


                <!-- The Modal -->
                <div class="modal fade" id="myModal1">
                    <div class="modal-dialog ">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h3 class="modal-title">เข้าสู่ระบบ</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">

                                <center><img src="img/login2.png" width="150px" height="auto" alt=""
                                        style="margin-top: -10px;">

                                </center><br>
                                <form method="POST" action="pages/logincheck.php">
                                    <div><i class="fas fa-user" style="font-size: 25px;"></i> <label
                                            for="Username">ชื่อผู้ใช้งาน</label>
                                        <input type="Username" class="custom-input2" id="Username"
                                            placeholder="ชื่อผู้ใช้งาน" name="Cus_Username" style="margin-top: 5px;">
                                    </div>
                                    <div>
                                        <i class="fas fa-lock-open" style="font-size: 25px;"></i> <label for=""
                                            class="form-label">รหัสผ่าน</label>
                                        <input type="password" class="custom-input2" id="Cus_Password"
                                            placeholder="รหัสผ่าน" name="Cus_Password">
                                    </div>
                                    <div style="margin-top: 10px;">หากยังไม่บัญชีคลิกที่นี่
                                        <a href="" class="underline-on-hover"
                                            style="color: blue; font-size: 18px; margin-left: 0px; font-weight: bold;"
                                            data-bs-toggle="modal" data-bs-target="#myModal2">สมัครสมาชิก</a>
                                    </div><br>


                                    <center><button type="submit" class="btn btn-success"
                                            style="width: 300px;">เข้าสู่ระบบ</button> </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <span class="navbar-divider"> | </span>
                <a href="#" data-bs-toggle="modal" data-bs-target="#myModal2" class="login-link"><img src="img/edit.png"
                        alt="" style="width: 40px; height: 40px; margin-right: 10px;"> สมัครสมาชิก</a>

                <!-- The Modal -->
                <div class="modal fade" id="myModal2">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h3 class="modal-title">สมัครสมาชิก</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">

                                <center><img src="img/Regis.png" width="150px" height="auto" alt="">

                                </center><br>
                                <form method="POST" action="pages/insert_User.php">
                                    <div><i class="fas fa-user" style="font-size: 25px;"></i> <label for="Cus_Username">
                                            ชื่อผู้ใช้งาน <span style="font-size: 20px; color: red;">*</span></label>
                                        <input type="Username" class="custom-input2" id="Cus_Username"
                                            placeholder="ชื่อผู้ใช้งาน" name="Cus_Username" required>
                                    </div>
                                    <div>
                                        <i class="fas fa-lock-open" style="font-size: 25px;"></i>
                                        <label for="Cus_Password" class="form-label">รหัสผ่าน <span
                                                style="font-size: 20px; color: red;">*</span><span
                                                style=" color: red;">รหัสผ่านต้องเป็นตัวเลขและตัวหนังสือผสมกันอย่างน้อย
                                                8 ตัวอักษร</span></label>
                                        <input type="password" class="custom-input2" id="Cus_Password"
                                            placeholder="รหัสผ่าน" name="Cus_Password" required
                                            pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$">
                                        <!-- pattern นี้ต้องการรหัสผ่านที่ประกอบด้วยตัวเลขและตัวหนังสือ โดยมีความยาวอย่างน้อย 8 ตัว -->
                                    </div>
                                    <i class="fas fa-address-book" style="font-size: 25px;"></i>
                                    <label for="" class="form-label">ชื่อ-นามสกุล <span
                                            style="font-size: 20px; color: red;">*</span></label>
                                    <div class="flex-container">

                                        <input type="text" class="custom-input2" id="Cus_FName" required
                                            placeholder="ชื่อ" name="Cus_FName">-
                                        <input type="text" class="custom-input2" id="Cus_LName" required
                                            placeholder="นามสกุล" name="Cus_LName">
                                    </div>
                                    <div>
                                        <i class="fas fa-envelope" style="font-size: 25px;"></i>
                                        <label for="" class="form-label">อีเมล <span
                                                style="font-size: 20px; color: red;">*</span></label>
                                        <input type="email" class="custom-input2" id="Cus_Email" required
                                            placeholder="อีเมล" name="Cus_Email">
                                    </div>
                                    <div>
                                        <i class="fas fa-phone" style="font-size: 25px;"></i>
                                        <label for="" class="form-label">เบอร์โทรศัพท์ <span
                                                style="font-size: 20px; color: red;">*</span></label>
                                        <input type="text" class="custom-input2" id="Cus_tel"
                                            placeholder="เบอร์โทรศัพท์" name="Cus_tel" required>
                                    </div>
                                    <p style="font-size: 30px; text-align: center;">ที่อยู่สำหรับจัดส่งสินค้า</p>
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
                                    <input type="text" name="zipcode" id="zipcode" class="custom-input2"
                                        style="margin-top: 0px;">
                                    <label for="" style=" align-items: center; margin-left: 0px; margin-top: 0px;"><i
                                            class="fi fi-rr-home-location-alt"
                                            style="margin-right: 5px;"></i>ที่อยู่</label>
                                    <textarea name="Add_Address" id="Add_Address" class="custom-input2" rows="5"
                                        style="width: 100%; margin-top: 0px;"></textarea>
                                    <center><button type="submit" class="btn btn-success"
                                            style="width: 300px;">สมัครสามาชิก</button> </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <a href="index.php?A=1&B=3" class="login-link" style="margin-right: -50px;">
                <img src="img/add-to-basket.png" alt="" style="width: 40px; height: 40px; margin-right: 10px;">
                ตระกร้าสินค้า</a>

        </div>
    </nav><br>


    <?php
if ($A == 1) {
  if ($B == 1) {
    $PageContant = "pages/show2.php";
  } else if ($B == "2") {
    $PageContant = "pages/itemdetail.php";
  } else if ($B == "3") {
    $PageContant = "pages/cart.php";
  } else if ($B == "4") {
    $PageContant = "pages/history.php";
  } else if ($B == "5") {
    $PageContant = "pages/cateproduct.php";
  } else if ($B == "6") {
    $PageContant = "loginguide.php";
  } else if ($B == "7") {
    $PageContant = "question.php";
  } else if ($B == "8") {
    $PageContant = "report.php";

  } else {
    $PageContant = "pages/show2.php";
  }

} else {
  $PageContant = "pages/show2.php";
}
?>

    <?php include $PageContant;  ?>
    <style>
    .footer-categories a {
        color: white; /* ตั้งค่าสีข้อความเริ่มต้นเป็นสีขาว */
        text-decoration: underline; /* ไม่มีเส้นใต้ในข้อความเริ่มต้น */
    }

    .footer-categories a:hover {
        color: red; /* เมื่อนำเม้าส์ไปชี้ที่ลิงก์ สีข้อความจะเปลี่ยนเป็นสีแดง */
        text-decoration: underline; /* เมื่อนำเม้าส์ไปชี้ที่ลิงก์ จะมีเส้นใต้ในข้อความ */
    }
</style>

    <footer class="footer">
    <div class="container">
        <div class="footer-content" style="display: flex; justify-content: space-between; align-items: center; ">
            <div class="footer-contact-info" style="margin-right: 150px;  margin-top: -150px;">
            <a href="#" class="logo" >
                    <img src="img/logo.png" alt="Your Logo" style="width: 30%;">
                </a>
                <p style="font-size: 22px;">ร้าน Thefast Gaming Gear</p>
                <p style="font-size: 22px;">40/88-89 หมู่บ้านพรธิสาร3ซอย11 ตำบลคลองหก</p>
                <p style="font-size: 22px;">อำเภอคลองหลวง ปทุมธานี 12120</p>
                <p style="font-size: 22px;">เบอร์โทรติดต่อ: 02 549 4990</p>
            </div>
            <div class="footer-categories" style="flex: 1; text-align: left; margin-right: 300px; margin-top: 30px;">
                <h3>หมวดหมู่</h3>
                <ul>
                    <?php
                    // ดึงข้อมูลจากตาราง category
                    $sql = "SELECT * FROM category";
                    $result = mysqli_query($conn, $sql);

                    // แสดงลิงก์และ icon จากข้อมูล category
                    while ($row = mysqli_fetch_assoc($result)) {
                        $cateName = $row['Cate_Name'];
                        $cateIcon = $row['Cate_Icon'];
                        $cateID = $row['Cate_ID'];
                    ?>
                        <li>
                            <a href="index.php?A=1&B=5&Cate_ID=<?php echo $cateID; ?>"><?php echo $cateName; ?></a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="footer-social" style="margin-left: auto; margin-top: 40px;">
            <h3>ติดต่อเรา</h3>
                <div id="fb-root"></div>
                <script>
                    (function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&appId=183384128526201&version=v2.0";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                </script>
                <div class="fb-like-box" data-href="https://www.facebook.com/TheFastGamingV2" data-width="384" data-height="410" data-colorscheme="light" data-show-faces="false" data-header="false" data-stream="true" data-show-border="true"></div>
            </div>
        </div>
    </div>
</footer>
    <!-- ตรวจสอบค่า logout_success และแสดง SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
    });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า logout_success ใน URL หรือไม่
        const urlParams = new URLSearchParams(window.location.search);
        const logoutSuccessParam = urlParams.get('logout_success');

        // ถ้ามีค่า logout_success, ให้แสดง SweetAlert2 และลบค่า logout_success ออกจาก URL
        if (logoutSuccessParam === '1') {
            Swal.fire({
                icon: 'success',
                title: 'ออกจากระบบสำเร็จ',
                showConfirmButton: false,
                timer: 1500
            });

            // ลบค่า logout_success ออกจาก URL
            const newURL = window.location.href.split('?')[0]; // ดึง URL ทั้งหมดยกเว้น parameter
            history.pushState({}, '', newURL);
        }
    });
    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า pls_login ใน Session หรือไม่
        const pls_loginParam =
            <?php echo isset($_SESSION['pls_login']) ? $_SESSION['pls_login'] : '0'; ?>;

        // ถ้ามีค่า pls_login, ให้แสดง SweetAlert2
        if (pls_loginParam === 1) {
            Swal.fire({
                icon: 'warning',
                title: 'กรุณาLogin',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า pls_login ใน Session
            <?php unset($_SESSION['pls_login']); ?>
        }
    });



    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า error ใน Session หรือไม่
        const errorParam = <?php echo isset($_SESSION['error']) ? $_SESSION['error'] : '0'; ?>;

        // ถ้ามีค่า error, ให้แสดง SweetAlert2
        if (errorParam === 1) {
            Swal.fire({
                icon: 'error',
                title: 'เข้าสู่ระบบไม่สำเร็จ',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า error ใน Session
            <?php unset($_SESSION['error']); ?>
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า register_error ใน Session หรือไม่
        const registerError =
            <?php echo isset($_SESSION['register_error']) ? json_encode($_SESSION['register_error']) : 'null'; ?>;

        // ถ้ามีค่า register_error, ให้แสดง SweetAlert2
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

            // เคลียร์ค่า register_error ใน Session
            <?php unset($_SESSION['register_error']); ?>
        }


        // ตรวจสอบว่ามีค่า register_success ใน Session หรือไม่
        const registerSuccess =
            <?php echo isset($_SESSION['register_success']) ? $_SESSION['register_success'] : '0'; ?>;

        // ถ้ามีค่า register_success, ให้แสดง SweetAlert2
        if (registerSuccess) {
            Swal.fire({
                icon: 'success',
                title: 'ลงทะเบียนสำเร็จ',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า register_success ใน Session
            <?php unset($_SESSION['register_success']); ?>
        }
    });
    </script>
</body>

</html>