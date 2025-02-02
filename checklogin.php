<?php session_start();
include("include/config.php");
error_reporting(0);

if(isset($_POST['login'])){
    $username = $_POST['username'];
   //echo "<br>";
    $loginpassword = $_POST['loginpassword'];
   //echo "<br>";
    $hasedpassword = hash('sha256',$loginpassword);
try{
   $ret = "SELECT * FROM userdata WHERE (username=:uname && loginpassword=:loginpassword)";
   $queryt = $dbh -> prepare($ret);
   $queryt->bindParam(':uname',$username,PDO::PARAM_STR);
   $queryt->bindParam(':loginpassword',$hasedpassword,PDO::PARAM_STR);
   $queryt-> execute();
   $results = $queryt -> fetchAll(PDO::FETCH_OBJ);

   if($queryt-> rowCount() > 0){  
        foreach($results as $result){
            $_SESSION['fullname'] = $result->fullname;
            $_SESSION['user_id'] = $result->id;
            $_SESSION['user_type'] = $result->user_type;
        }
        if ($_SESSION['user_type']==0) {
            echo "<script type='text/javascript'>";
<<<<<<< HEAD
            echo "alert('เข้าสู่ระบบเรียบร้อยแล้ว');";
=======
            echo "alert('เข้าสู่ระบบเรียบร้อย');";
>>>>>>> 022653f5fba52008634a1554a2616e64b78bb1ab
            echo "document.location='admin/dashboard.php';";
            echo "</script>";
        }else {
            echo "<script type='text/javascript'>";
<<<<<<< HEAD
            echo "alert('เข้าสู่ระบบเรียบร้อยแล้ว');";
=======
            echo "alert('เข้าสู่ระบบเรียบร้อย');";
>>>>>>> 022653f5fba52008634a1554a2616e64b78bb1ab
            echo "document.location='welcome.php';";
            echo "</script>";
        }
   }else{
        echo "<script type='text/javascript'>";
<<<<<<< HEAD
        echo "alert('Username หรือ Password ไม่ถูกต้อง');";
=======
        echo "alert('username หรือ password ไม่ถูกต้อง');";
>>>>>>> 022653f5fba52008634a1554a2616e64b78bb1ab
        echo "document.location='login.php';";
        echo "</script>";
   }
}catch(PDOException $e){
    exit("Error: ". $e->getMessage());
}

}
?>