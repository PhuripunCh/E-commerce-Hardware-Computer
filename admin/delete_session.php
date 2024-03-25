<?php
session_start(); // เริ่ม Session

// ลบค่า new_data_count ออก
unset($_SESSION['new_data_count']);

// ส่งค่ากลับว่าลบ session เรียบร้อยแล้ว
echo "Session ถูกลบแล้ว";
?>
