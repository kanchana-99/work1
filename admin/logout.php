<?php 
session_start();
session_unset();
session_destroy();
header('location:../index.php'); // เปลี่ยนเส้นทางไปที่หน้า login
//exit(); // ป้องกันโค้ดทำงานต่อ
?>

