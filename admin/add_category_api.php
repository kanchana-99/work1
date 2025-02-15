<?php session_start();
include("../include/config.php");
error_reporting(0);

if(isset($_POST['save'])){
    //echo'ถูฏเงื่อนไขส่งข้อมูลมาไ้ด';
    //ประกาศตัวเเปรรับค่าจากฟอร์ม
    $cat_name = $_POST['cat_name'];
    //sql insert
    $query = $dbh->prepare("INSERT INTO category 
    (
    cat_name
    ) 
    VALUES 
    (
    :cat_name
    )");

    //bindprame
    $query->bindParam(':cat_name',$cat_name, PDO::PARAM_STR);
    $query->execute();
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    if($query){
        echo "<script>alert('เพิ่มข้อมูลสำเร็จ!')</script>";
        echo "<script>window.location.href='manage_category.php'</script>";
    }else{
        echo "<script>alert('เกิดข้อผิดพลาด! กรุณาลองใหม่อีกครั้ง')</script>";
        echo "<script>window.location.href='manage_category.php'</script>";
    }
    
    //header('location:logout.php');

}    
    
?>





