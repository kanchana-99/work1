<?php
session_start();
include("../include/config.php");


$host = "localhost";
$dbname = "myproject"; // ชื่อฐานข้อมูล
$username = "root"; // XAMPP ใช้ root
$password = ""; // XAMPP ไม่มีรหัสผ่าน

try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// เชื่อมต่อฐานข้อมูล
if (!isset($dbh)) {
    die("Error: ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['pro_id']) || empty($_POST['pro_id'])) {
        die("Error: ไม่มี pro_id");
    }

    $pro_id = $_POST['pro_id'];
    $pro_name = $_POST['pro_name'];
    $cat_id = $_POST['cat_id'];
    $pro_price = $_POST['pro_price'];
    $pro_cost = $_POST['pro_cost'];
    $old_pro_img = $_POST['old_pro_img'] ?? '';

    // ตรวจสอบว่ามีการอัพโหลดไฟล์หรือไม่
    if (!empty($_FILES['pro_img']['name'])) {
        $target_dir = "uploads/";
        $new_img = time() . "_" . basename($_FILES["pro_img"]["name"]);
        $target_file = $target_dir . $new_img;

        // ตรวจสอบประเภทไฟล์
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            die("Error: อนุญาตเฉพาะไฟล์รูปภาพเท่านั้น (JPG, JPEG, PNG, GIF)");
        }

        // ตรวจสอบขนาดไฟล์ (ไม่เกิน 2MB)
        if ($_FILES["pro_img"]["size"] > 2 * 1024 * 1024) {
            die("Error: ไฟล์มีขนาดใหญ่เกินไป (ต้องไม่เกิน 2MB)");
        }

        // อัพโหลดไฟล์
        if (move_uploaded_file($_FILES["pro_img"]["tmp_name"], $target_file)) {
            echo "ไฟล์ถูกอัพโหลดสำเร็จ: " . $target_file . "<br>";

            // ลบรูปเก่าถ้ามี
            if (!empty($old_pro_img) && file_exists("uploads/" . $old_pro_img)) {
                unlink("uploads/" . $old_pro_img);
            }
        } else {
            die("Error: ไม่สามารถอัพโหลดไฟล์ได้");
        }
    } else {
        $new_img = $old_pro_img; // ใช้รูปเดิม
    }

    // อัพเดทข้อมูลสินค้า
    $sql = "UPDATE product SET pro_name = :pro_name, cat_id = :cat_id, pro_price = :pro_price, pro_cost = :pro_cost, pro_img = :pro_img WHERE pro_id = :pro_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':pro_name', $pro_name, PDO::PARAM_STR);
    $query->bindParam(':cat_id', $cat_id, PDO::PARAM_STR);
    $query->bindParam(':pro_price', $pro_price, PDO::PARAM_INT);
    $query->bindParam(':pro_cost', $pro_cost, PDO::PARAM_INT);
    $query->bindParam(':pro_img', $new_img, PDO::PARAM_STR);
    $query->bindParam(':pro_id', $pro_id, PDO::PARAM_INT);

    if ($query->execute()) {
        echo "<script>alert('แก้ไขข้อมูลสินค้าสำเร็จ!'); window.location='manage_product.php';</script>";
        exit();
    } else {
        die("Error: ไม่สามารถอัพเดทข้อมูลได้");
    }
}
?>
