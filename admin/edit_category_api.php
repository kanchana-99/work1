<?php session_start();
include("../include/config.php");
error_reporting(0);
 
if(isset($_POST['update'])){
    $cid = $_POST['cid'];
    $cat_name = $_POST['cat_name'];

    $sql ="UPDATE category SET cat_name=:cat_name WHERE cat_id=:cid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':cid',$cid,PDO::PARAM_STR);
    $query->bindParam(':cat_name',$cat_name,PDO::PARAM_STR);
    $query->execute();
    echo "<script>alert('ข้อมูลผู้ใช้งานถูกปรับปรุงแล้ว!')</script>";
    echo "<script>window.location.href='manage_category.php'</script>";
   

}
  
 
?>