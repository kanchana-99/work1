<?php session_start();
include("../include/config.php");
error_reporting(0);


$cat_name = $_POST['cat_name'];

$sql ="INSERT INTO category
    
    (cat_name) 

    VALUES 

    ('$cat_name')";
    
    $result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
    mysqli_close($con);
    
    if($result){
      echo "<script>";
      echo "alert('เพิ่มข้อมูลสำเร็จ !');";
      echo "window.location ='manage_category.php'; ";
      echo "</script>";
    } else {
      
      echo "<script>";
      echo "alert('ผิดพลาด โปรดลองใหม่อีกครั้ง');";
      echo "window.location ='manage_category.php'; ";
      echo "</script>";
    }
?>