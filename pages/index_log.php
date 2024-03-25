<?php
session_start();
include 'condb.php';
$P      = @@$_REQUEST['P'];
$S      = @@$_REQUEST['S'];
include 'session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="../js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/2.0.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/2.0.0/uicons-regular-straight/css/uicons-regular-straight.css'>
    <link rel="stylesheet" href="../css/stylenav1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;700&display=swap">
    <script src="https://kit.fontawesome.com/76476022b8.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-brands/css/uicons-brands.css'>
    <link rel="stylesheet" href="../java/sweetalert2@11.js">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
    <style>
    body {
        font-family: 'Prompt', sans-serif;

    }

    .user-actions a:hover {
        color: red;
    }

    /* กำหนดสีเมื่อ hover ที่ลิงก์ "ตระกร้าสินค้า" */
    .navbar a:hover {
        color: red;
    }

    .logo a:hover {
        color: #fff;
    }

    .login-link {
        display: flex;
        align-items: center;
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
        width: 400px;
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
    </style>

</head>

<body>
    <nav class="navbar">
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
                <a href='index_log.php?P=1&S=11&Cate_ID=<?php echo $cateID; ?>'
                    style='display: inline-flex; align-items: center; font-size: 22px;'>
                    <img src="../uploads/<?php echo $row['Cate_Icon']; ?>" alt=""
                        style="width: 40px; height: 40px; margin-right: 10px;"> <?php echo $cateName; ?>
                </a><br><br>
                <?php
                }
                ?>
            </div>
        </div>


        <a href="" data-bs-toggle="offcanvas" data-bs-target="#demo">
            <div class="menu-icon" style="margin-left: 50px; font-size: 30px;">&#9776;</div>
        </a>

        <div class="container">
            <a href="index_log.php" class="logo">
                <i class=""><img src="../img/logo.png" alt="" width="70px" height="auto"></i>
                <!-- ใช้ FontAwesome ไอคอน -->
                TheFast Gaming gear
            </a>

            <ul class="nav-links">
                <div class="search-container">
                    <span class="search-icon">
                        <i class="fas fa-search" style="font-size: 30px;"></i>
                    </span>
                    <form action="index_log.php?P=1&S=12" method="POST" class="d-flex">
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
                <a href="index_log.php?P=1&S=2" class="login-link"><img src="../img/user.png" alt=""
                        style="width: 40px; height: 40px; margin-right: 10px;">
                    <?php echo $Cus_Username ?></a>

                <span class="navbar-divider"> | </span>
                <a href="logout.php" class="login-link"><img src="../img/check-out.png" alt=""
                        style="width: 40px; height: 40px; margin-right: 10px;"> ออกจากระบบ</a>

            </div>
            <a href="index_log.php?P=1&S=6" class="navbar-divider login-link" style="margin-right: -50px;">
                <img src="../img/add-to-basket.png" alt="" style="width: 40px; height: 40px; margin-right: 10px;">
                ตระกร้าสินค้า
                <?php
                    // ตรวจสอบว่ามีตระกร้าสินค้าหรือไม่
                    if(isset($_SESSION["intLine"])){
                        $cartItemCount = array_sum($_SESSION["strQty"]);
                        echo '<span class="badge bg-warning" style="margin-left: 5px;">' . $cartItemCount . '</span>';
                    } else {
                        echo '<span class="badge bg-warning" style="margin-left: 5px;">0</span>';
                    }
                ?>
            </a>

        </div>
    </nav><br>



    <?php
        if ($P == "1") {
        if ($S == "1") {
            $PageContant = "show1.php";
        } else if ($S == "2") {
            $PageContant = "infouser.php";
        } else if ($S == "3") {
            $PageContant = "transpot.php";
        } else if ($S == "4") {
            $PageContant = "history.php";
        } else if ($S == "5") {
            $PageContant = "itemdetail_log.php";
        } else if ($S == "6") {
            $PageContant = "cart.php";
        } else if ($S == "7") {
            $PageContant = "payment.php";
        } else if ($S == "8") {
            $PageContant = "address.php";
        } else if ($S == "9") {
            $PageContant = "receipt.php";
        } else if ($S == "10") {
            $PageContant = "receipthistory.php";
        } else if ($S == "11") {
            $PageContant = "cateproduct_log.php";
        } else if ($S == "12") {
            $PageContant = "searchpro.php";
        } else {
            $PageContant = "show1.php";
        }

        } else {
        $PageContant = "show1.php";
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
                    <img src="../img/logo.png" alt="Your Logo" style="width: 30%;">
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
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า success ใน Session หรือไม่
        const successParam = <?php echo isset($_SESSION['success']) ? $_SESSION['success'] : '0'; ?>;

        // ถ้ามีค่า success, ให้แสดง SweetAlert2
        if (successParam === 1) {
            Swal.fire({
                icon: 'success',
                title: 'ยินดีต้อนรับเข้าสู่ระบบ',
                showConfirmButton: false,
                timer: 1500
            });

            // เคลียร์ค่า success ใน Session
            <?php unset($_SESSION['success']); ?>
        }
    });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        function setValueToInput(value) {
            $('#searchitem').val(value);
            $('#search-result').empty();
            $('#search-result').removeClass('show');
        }

        $('#searchitem').on('input', function() {
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

    document.getElementById('open-chat').addEventListener('click', function() {
        document.getElementById('chat-popup').style.display = 'block';
    });

    document.getElementById('close-chat').addEventListener('click', function() {
        document.getElementById('chat-popup').style.display = 'none';
    });

    document.getElementById('send-message').addEventListener('click', function() {
        sendMessage();
    });

    document.getElementById('chat-input').addEventListener('keyup', function(event) {
        if (event.key === "Enter") {
            sendMessage();
        }
    });

    function sendMessage() {
        var messageInput = document.getElementById('chat-input');
        var messageText = messageInput.value.trim().toLowerCase(); // แปลงข้อความทั้งหมดเป็นตัวอักษรเล็ก

        if (messageText !== "") {
            var chatMessages = document.getElementById('chat-messages');

            // สร้าง div สำหรับข้อความผู้ใช้
            var userMessage = document.createElement('div');
            userMessage.classList.add('user-message');
            userMessage.textContent = 'คุณ: ' + messageText;
            chatMessages.appendChild(userMessage);

            // เพิ่มโค้ดที่คุณต้องการเพื่อตอบกลับข้อความที่ผู้ใช้พิมพ์
            var replyMessage = document.createElement('div');
            replyMessage.classList.add('system-message');

            // เช็คว่าข้อความที่ผู้ใช้พิมเหมือน "วิธีใช้งาน" หรือไม่
            if (messageText.includes("วิธีใช้งาน")) {
                replyMessage.textContent = 'Bot: นี่คือวิธีการใช้งาน...'; // แก้ไขข้อความตอบกลับตามต้องการ
            } else if (messageText.includes("วิธีสั่งซื้อ")) {
                replyMessage.textContent = 'Bot: นี่คือวิธีการสั่งซื้อ...'; // ข้อความตอบกลับเมื่อพบคำถาม "วิธีสั่งซื้อ"
            } else {
                replyMessage.textContent = 'Bot: ขอบคุณที่ให้คำถาม'; // ข้อความตอบกลับเมื่อไม่พบคำถามที่ตรงกัน
            }

            chatMessages.appendChild(replyMessage);

            // เคลียร์ช่องกรอกข้อความ
            messageInput.value = "";

            // นำ scrollbar ลงไปด้านล่างเพื่อแสดงข้อความล่าสุด
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    }
    </script>
</body>

</html>