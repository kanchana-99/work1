<?php
session_start();
include("../include/config.php");
//error_reporting(0);


if (isset($_POST['save_button'])) {
    $filename = $_FILES['pro_img']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $allowed = array('jpg', 'png', 'jpeg');

    if (!in_array(strtolower($ext), $allowed)) {
        $_SESSION['Respclass'] = 'danger';
        $_SESSION['RespDisplay'] = 'block';
        $_SESSION['RespMessage'] = 'Invalid file extension';
    } else {
        $milliseconds = round(microtime(true) * 1000);
        $newfilename = $milliseconds . "." . $ext;
        $tmpname = $_FILES['pro_img']['tmp_name'];
        $moveto = '../uploads' . $newfilename;

        if (move_uploaded_file($tmpname, $moveto)) {
            chmod($moveto, 0777);
            $_SESSION['Respclass'] = 'success';
            $_SESSION['RespDisplay'] = 'block';
            $_SESSION['RespMessage'] = 'Upload file successfully';

            // รับค่าจากฟอร์ม
            $pro_name = $_POST['pro_name'];
            $cat_id = $_POST['cat_id'];
            $pro_price = $_POST['pro_price'];
            $pro_cost = $_POST['pro_cost'];
            $pro_img = 'work1/uploads/' . $newfilename; // เพิ่ม path ก่อนชื่อไฟล์

            // SQL Insert
            try {
                $quley = $dbh->prepare("INSERT INTO product (pro_name, cat_id, pro_price, pro_cost, pro_img) 
                                        VALUES (:pro_name, :cat_id, :pro_price, :pro_cost, :pro_img)");
                $quley->bindParam(':pro_name', $pro_name, PDO::PARAM_STR);
                $quley->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
                $quley->bindParam(':pro_price', $pro_price, PDO::PARAM_STR);
                $quley->bindParam(':pro_cost', $pro_cost, PDO::PARAM_STR);
                $quley->bindParam(':pro_img', $pro_img, PDO::PARAM_STR);

                if ($quley->execute()) {
                    echo '<script>
                        setTimeout(function() {
                            swal({
                                title: "เพิ่มข้อมูลสำเร็จ",
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
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            $dbh = null;
        } else {
            $_SESSION['Respclass'] = 'danger';
            $_SESSION['RespDisplay'] = 'block';
            $_SESSION['RespMessage'] = 'Upload file error';
        }
    }
}
?>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
