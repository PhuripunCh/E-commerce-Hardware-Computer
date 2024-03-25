<?php
session_start();
include 'condb.php';
$C      = @@$_REQUEST['C'];
$D      = @@$_REQUEST['D'];
if(isset($_SESSION['Cus_ID'])){
  
  $Cus_ID = $_SESSION['Cus_ID'];

  
} else {
  echo 'ยังไม่ได้เข้าสู่ระบบ'; 
}
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    </style>

</head>

<body>
    <nav class="navbar">
        <div class="offcanvas offcanvas-start" id="demo">
            <div class="offcanvas-header">
                <h1 class="offcanvas-title">Menu</h1>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <a href="index_ad.php" style="display: inline-flex; align-items: center; ">
                    <img src="../img/boxes.png" alt=""
                        style="width: 40px; height: 40px; margin-right: 10px;">เช็คจำนวนสินค้า
                </a><br><br>
                <a href="index_ad.php?C=1&D=2" style="display: inline-flex; align-items: center; ">
                    <img src="../img/group.png" alt=""
                        style="width: 40px; height: 40px; margin-right: 10px;">ข้อมูลพนักงานและข้อมูลผู้ใช้
                </a><br><br>
                <a href="index_ad.php?C=1&D=10" style="display: inline-flex; align-items: center; ">
                    <img src="../img/apps.png" alt="" style="width: 40px; height: 40px; margin-right: 10px;">หมวดหมู่
                </a><br><br>
                <?php
                // คำสั่ง SQL เพื่อดึงจำนวนรายการที่มี List_status เป็น 'NOTPAY'
                $sql = "SELECT COUNT(*) AS not_pay_count FROM orderlist WHERE List_status = 'NOTPAY'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // อ่านข้อมูลจากแถวที่ได้
                    $row = $result->fetch_assoc();
                    $not_pay_count = $row["not_pay_count"];
                } else {
                    $not_pay_count = 0;
                }

                ?>

                <a href="index_ad.php?C=1&D=4" style="display: inline-flex; align-items: center; ">
                    <img src="../img/report.png" alt="" style="width: 40px; height: 40px; margin-right: 10px;">
                    รายงานการขาย
                    <?php if ($not_pay_count > 0): ?>
                    <span class="badge bg-primary" style="margin-left: 10px;"><?php echo $not_pay_count; ?></span>
                    <?php endif; ?>
                </a><br><br>
                <a href="index_ad.php?C=1&D=7" style="display: inline-flex; align-items: center; ">
                    <img src="../img/delivery.png" alt=""
                        style="width: 40px; height: 40px; margin-right: 10px;">ข้อมูลการจัดส่งสินค้า
                </a><br><br>
                <a href="index_ad.php?C=1&D=8" style="display: inline-flex; align-items: center; ">
                    <img src="../img/analysis.png" alt=""
                        style="width: 40px; height: 40px; margin-right: 10px;">สรุปยอดขาย
                </a><br><br>

            </div>
        </div>


        <a href="" data-bs-toggle="offcanvas" data-bs-target="#demo">
            <div class="menu-icon" style="margin-left: 50px; font-size: 30px;">&#9776;</div>
        </a>

        <div class="container">
            <a href="index_ad.php" class="logo">
                <i class=""><img src="../img/logo.png" alt="" width="70px" height="auto"></i>
                TheFast Gaming gear
            </a>


            <div class="user-actions d-flex justify-content-end">

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

                <a href="" class="login-link"><img src="../img/software-engineer.png" alt=""
                        style="width: 40px; height: 40px; margin-right: 10px;">
                    <?php echo $Cus_Username ?></a>
                <span class="navbar-divider"> | </span>
                <a href="../pages/logout.php" class="login-link"><img src="../img/check-out.png" alt=""
                        style="width: 40px; height: 40px; margin-right: 10px;"> ออกจากระบบ</a>

            </div>

        </div>
    </nav><br>


    <?php
if ($C == "1") {
  if ($D == "1") {
    $PageContant = "stock.php";
  } else if ($D == "2") {
    $PageContant = "detailuser.php";
  } else if ($D == "3") {
    $PageContant = "detailadmin.php";
  } else if ($D == "4") {
    $PageContant = "salesreportnotpay.php";
  } else if ($D == "5") {
    $PageContant = "salesreportpay.php";
  } else if ($D == "6") {
    $PageContant = "salesreportcancel.php";
  } else if ($D == "7") {
    $PageContant = "delivery.php";
  } else if ($D == "8") {
    $PageContant = "Summaryproduct.php";
  } else if ($D == "9") {
    $PageContant = "Summarysales.php";
  } else if ($D == "10") {
    $PageContant = "category.php";
  } else if ($D == "11") {
    $PageContant = "searchsalereport.php";
  } else if ($D == "12") {
    $PageContant = "searchproduct.php";
  } else if ($D == "13") {
    $PageContant = "searchuser.php";
  } else if ($D == "14") {
    $PageContant = "searchreportnotpay.php";
  } else if ($D == "15") {
    $PageContant = "searchreportpay.php";
  } else if ($D == "16") {
    $PageContant = "searchproductreport.php";
} else if ($D == "17") {
    $PageContant = "searchdelivery.php";


  } else {
    $PageContant = "stock.php";
  }

} else {
  $PageContant = "stock.php";
}
?>

    <?php include $PageContant;  ?>



    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // ตรวจสอบว่ามีค่า success ใน Session หรือไม่
        const successParam =
            <?php echo isset($_SESSION['success']) ? $_SESSION['success'] : '0'; ?>;

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
</body>

</html>