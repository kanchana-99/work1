<?php session_start();
include("../include/config.php");
error_reporting(0);
 
if($_SESSION['user_type']==1){
    header('location:logout.php');
}else{
    if(isset($_POST['update'])){
        $eid = $_POST['eid'];
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $useremail = $_POST['useremail'];
        $usermobile = $_POST['usermobile'];
        $loginpassword = $_POST['loginpassword'];
 
        $hasedpassword = hash('sha256',$loginpassword);
        //print_r($_POST);
 
 
        $sql ="UPDATE userdata SET fullname=:fullname,username=:username,useremail=:useremail,usermobile=:usermobile,loginpassword=:hasedpassword WHERE id=:eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':eid',$eid,PDO::PARAM_STR);
        $query->bindParam(':fullname',$fullname,PDO::PARAM_STR);
        $query->bindParam(':username',$username,PDO::PARAM_STR);
        $query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
        $query->bindParam(':usermobile',$usermobile,PDO::PARAM_STR);
        $query->bindParam(':hasedpassword',$hasedpassword,PDO::PARAM_STR);
        $query->execute();
<<<<<<< HEAD
        echo "<script>alert('ข้อมูลผู้ใช้งานถูกปรับปรุงแล้ว!')</script>";
=======
        echo "<script>alert('User has been updated')</script>";
>>>>>>> 022653f5fba52008634a1554a2616e64b78bb1ab
        echo "<script>window.location.href='manage_user.php'</script>";
       
 
    }
}
 
 
?>