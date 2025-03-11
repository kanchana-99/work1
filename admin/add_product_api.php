<?php
session_start();

// ตั้งค่าการเชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myproject";  // ตรวจสอบว่ามีฐานข้อมูลนี้จริงไหม

$conn = new mysqli($servername, $username, $password, $dbname);

// เช็กว่าการเชื่อมต่อสำเร็จไหม
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// เช็กว่าเป็นคำขอแบบ POST หรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากฟอร์ม
    $pro_name = isset($_POST['pro_name']) ? trim($_POST['pro_name']) : "";
    $cat_id = isset($_POST['cat_id']) ? intval($_POST['cat_id']) : 0;
    $pro_cost = isset($_POST['pro_cost']) ? floatval($_POST['pro_cost']) : 0.0;
    $pro_price = isset($_POST['pro_price']) ? floatval($_POST['pro_price']) : 0.0;
    $pro_img = NULL; // ค่าตั้งต้นเป็น NULL
    
    // เช็กว่ามีการอัปโหลดไฟล์ภาพหรือไม่
    if (isset($_FILES['pro_img']) && $_FILES['pro_img']['error'] == 0) {
        $file_name = $_FILES['pro_img']['name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION); // ดึงนามสกุลไฟล์
        $new_filename = time() . "." . $file_ext; // ตั้งชื่อไฟล์ใหม่กันซ้ำ
        $target_dir = "uploads/";
        $target_file = $target_dir . $new_filename;

        // ตรวจสอบว่าโฟลเดอร์ `uploads/` มีอยู่หรือไม่ ถ้าไม่มีให้สร้างใหม่
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // พยายามย้ายไฟล์ไปยังโฟลเดอร์ `uploads/`
        if (move_uploaded_file($_FILES['pro_img']['tmp_name'], $target_file)) {
            $pro_img = $new_filename; // ใช้ชื่อไฟล์ใหม่
        } else {
            echo "<script>alert('อัปโหลดรูปภาพล้มเหลว!'); window.history.back();</script>";
            exit();
        }
    }

    // ตรวจสอบค่าก่อน INSERT
    if (empty($pro_name) || $cat_id == 0 || $pro_cost == 0 || $pro_price == 0) {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน!'); window.history.back();</script>";
        exit();
    }

    // ใช้ prepared statement ป้องกัน SQL Injection
    $stmt = $conn->prepare("INSERT INTO product (pro_name, cat_id, pro_price, pro_cost, pro_img) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sidds", $pro_name, $cat_id, $pro_price, $pro_cost, $pro_img);

    // ทำการ execute คำสั่ง SQL
    if ($stmt->execute()) {
        echo "<script>alert('เพิ่มสินค้าสำเร็จ!'); window.location='manage_product.php';</script>";
    } else {
        echo "<script>alert('บันทึกฐานข้อมูลล้มเหลว: " . $stmt->error . "'); window.history.back();</script>";
    }

    // ปิด statement และ connection
    $stmt->close();
}

$conn->close();
?>
