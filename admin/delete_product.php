<?php 
session_start();
include("../include/config.php");
error_reporting(0);

$pro_id = $_GET['pro_id']; // กำหนดค่า pro_id

// ดึงข้อมูลรูปภาพของสินค้าก่อนลบ
$stmt = $dbh->prepare("SELECT pro_img FROM product WHERE pro_id = :pro_id");
$stmt->bindParam(':pro_id', $pro_id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    // ลบไฟล์รูปภาพถ้ามีอยู่จริง
    $file_path = "../uploads/" . $row['pro_img'];
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    // ลบข้อมูลสินค้าออกจากฐานข้อมูล
    $query = $dbh->prepare("DELETE FROM product WHERE pro_id = :pro_id");
    $query->bindParam(':pro_id', $pro_id, PDO::PARAM_INT);
    $deleteSuccess = $query->execute();
}

// โหลด SweetAlert
echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

// ตรวจสอบผลลัพธ์หลังจากลบสินค้า
if ($deleteSuccess) {
    echo '<script>
         setTimeout(function() {
          swal({
              title: "ลบข้อมูลสำเร็จ",
              type: "success"
          }, function() {
              window.location = "manage_product.php";
          });
        }, 1000);
    </script>';
} else {
    echo '<script>
         setTimeout(function() {
          swal({
              title: "เกิดข้อผิดพลาด",
              type: "error"
          }, function() {
              window.location = "manage_product.php";
          });
        }, 1000);
    </script>';
}

$dbh = null;
?>
