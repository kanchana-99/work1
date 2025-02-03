<?php
include("include/config.php");
error_reporting(0);

if(isset($_POST['signup'])){
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['useremail'];
    $mobile = $_POST['usermobile'];
    $password = $_POST['loginpassword'];
    //echo "<br>";
    $hasedpassword = hash('sha256',$password);
   // print_r($_POST);

   $ret = "SELECT * FROM userdata WHERE (username=:uname || useremail=:uemail)";
   $queryt = $dbh -> prepare($ret);
   $queryt->bindParam(':uname',$username,PDO::PARAM_STR);
   $queryt->bindParam(':uemail',$email,PDO::PARAM_STR);
   $queryt-> execute();
   $results = $queryt -> fetchAll(PDO::FETCH_OBJ);

   if($queryt-> rowCount() == 0){
    //echo "xx";
        $sql = "INSERT INTO userdata(fullname,username,useremail,usermobile,loginpassword) VALUES (:fname,:uname,:uemail,:umobile,:upass)";
        $query = $dbh -> prepare($sql);
        $query->bindParam(':fname',$fullname,PDO::PARAM_STR);
        $query->bindParam(':uname',$username,PDO::PARAM_STR);
        $query->bindParam(':uemail',$email,PDO::PARAM_STR);
        $query->bindParam(':umobile',$mobile,PDO::PARAM_STR);
        $query->bindParam(':upass',$hasedpassword,PDO::PARAM_STR);
        $query-> execute();
        // $lastInsertId = $dbh->$lastInsertId();
        // if($lastInsertId){
        //         echo "You have signup successfully";
        // }else{
        //         echo "Have something wrong. Please try again";
        // }
        echo "<script type='text/javascript'>";
        echo "alert('สมัครสมาชิกสำเร็จแล้ว!');";
        echo "document.location='login.php';";
        echo "</script>";

   }else{
        echo "ชื่อผู้ใช้งาน หรืออีเมลล์นี้มีผู้ใช้งานแล้ว กรุณาลองใหม่อีกครั้ง";
   }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>สมัครสมาชิก ร้านcute4U</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<style>
.form-container{
    font-family: 'Poppins', sans-serif;
    position: relative;
    z-index: 1;
}
.form-container .form-horizontal{
    background-color: #fff;
    padding: 30px 30px 10px;
    border: 1px solid #e7e7e7;
}
.form-container .form-horizontal:before,
.form-container .form-horizontal:after{
    content: '';
    background-color: #fff;
    height: 100%;
    width: 100%;
    border: 1px solid #e7e7e7;
    transform: rotate(3deg);
    position: absolute;
    left: 0;
    top: 0;
    z-index: -1;
}
.form-container .form-horizontal:after{ transform: rotate(-3deg); }
.form-container .title{
    color: #777;
    background: linear-gradient(to right,#f5f5f5,transparent,transparent,transparent,#f5f5f5);
    font-size: 23px;
    font-weight: 600;
    text-align: center;
    text-transform: capitalize;
    padding: 2px;
    margin: 0 0 20px 0;
}
.form-horizontal .form-group{
    background-color: #eaeaea;
    font-size: 0;
    margin: 0 0 15px;
    border: 1px solid #d1d1d1;
    border-radius: 3px;
}
.form-horizontal .input-icon{
    color: #888;
    font-size: 18px;
    text-align: center;
    line-height: 40px;
    height: 40px;
    width: 40px;
    vertical-align: top;
    display: inline-block;
}
.form-horizontal .form-control{
    color: #555;
    background-color: transparent;
    font-size: 14px;
    letter-spacing: 1px;
    width: calc(100% - 55px);
    height: 40px;
    padding: 2px 10px 2px 0;
    box-shadow: none;
    border: none;
    border-radius: 0;
    display: inline-block;
    transition: all 0.3s;
}
.form-horizontal .form-control:focus{
    box-shadow: none;
    border: none;
}
.form-horizontal .form-control::placeholder{
    color: rgba(0,0,0,0.7);
    font-size: 14px;
    text-transform: capitalize;
}
.form-horizontal .btn{
    color: #fff;
    background: linear-gradient(#1dd1a1,#10ac84);
    font-size: 16px;
    font-weight: 600;
    text-transform: capitalize;
    width: 100px;
    padding: 5px 18px;
    margin: 0 0 15px 0;
    border: none;
    border-radius: 30px;
    display: inline-block;
    transition: all 0.3s ease;
}
.form-horizontal .btn:hover,
.form-horizontal .btn:focus{
    color: #fff;
    letter-spacing: 2px;
}
.form-horizontal .forgot-pass{
    font-size: 12px;
    text-align: right;
    width: calc(100% - 105px);
    display: inline-block;
    vertical-align: top;
}
.form-horizontal .forgot-pass a,
.form-horizontal .register a{
    color: #999;
    transition: all 0.3s ease;
}
.form-horizontal .forgot-pass a:hover,
.form-horizontal .register a:hover{
    color: #555;
    text-decoration: underline;
}
.form-horizontal .register{
    font-size: 12px;
    text-align: center;
    padding-top: 8px;
    border-top: 1px solid #e7e7e7;
    display: block;
}
.form-bg {
    display: flex;
    justify-content: center; /* จัดให้อยู่ตรงกลางแนวนอน */
    align-items: center; /* จัดให้อยู่ตรงกลางแนวตั้ง */
    height: 100vh; /* ให้ความสูงเต็มจอ */
    background-color: #ffcad4; /* สีพื้นหลัง (เลือกได้) */
}

</style>

<body>
<div class="form-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-6 col-md-12 col-sm-offset-6 col-sm-12">
                <div class="form-container">
                    <form class="form-horizontal" action="checklogin.php" method="post">
                        <h3 class="title">สมัครสมาชิก ร้านcute4U</h3>
                        <div class="form-group">
                            <span class="input-icon"><i class="fa fa-user"></i></span>
                              <label for="fullname">ชื่อ-นามสกุล:</label>
                              <input type="text" class="form-control" id="fullname" placeholder="ชื่อ-นามสกุล" name="fullname" required>
                        </div>
                        <div class="form-group">
                            <span class="input-icon"><i class="fa fa-lock"></i></span>
                              <label for="username">UserName:</label>
                              <input type="text" class="form-control" id="username" placeholder="ชื่อผู้ใช้งาน" name="username" required>
                        </div>
                        <div class="form-group">
                            <span class="input-icon"><i class="fa fa-lock"></i></span>
                            <label for="useremail">Email:</label>
                            <input type="email" class="form-control" id="useremail" placeholder="อีเมลล์" name="useremail" required>
                        </div>
                        <div class="form-group">
                            <span class="input-icon"><i class="fa fa-lock"></i></span>
                            <label for="usermobile">Mobile:</label>
                            <input type="text" maxlength="10" pattern="[0-9]{10}" title="ใส่ตัวเลขสิบหลักเท่านั้น" class="form-control" id="usermobile" placeholder="เบอร์โทรศัพท์" name="usermobile" required>
                        </div>
                        <div class="form-group">
                            <span class="input-icon"><i class="fa fa-lock"></i></span>
                            <label for="loginpassword">Password:</label>
                            <input type="password" class="form-control" id="loginpassword" placeholder="รหัสผ่าน" name="loginpassword" required>
                        </div>
                        <button class="btn signin" name="login" id="login">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



</body>
</html>


<!--<div class="container">
  <h2>SignUp Page</h2>
  <form action="#" method="post" >
    <div class="form-group">
      <label for="fullname">FullName:</label>
      <input type="text" class="form-control" id="fullname" placeholder="Enter FullName" name="fullname" required>
    </div>
    <div class="form-group">
      <label for="username">UserName:</label>
      <input type="text" class="form-control" id="username" placeholder="Enter UserName" name="username" required>
    </div>
    <div class="form-group">
      <label for="useremail">Email:</label>
      <input type="email" class="form-control" id="useremail" placeholder="Enter Email" name="useremail" required>
    </div>
    <div class="form-group">
      <label for="usermobile">Mobile:</label>
      <input type="text" maxlength="10" pattern="[0-9]{10}" title="ตัวเลขสิบหลักเท่านั้น" class="form-control" id="usermobile" placeholder="Enter Mobile" name="usermobile" required>
    </div>
    <div class="form-group">
      <label for="loginpassword">Password:</label>
      <input type="password" class="form-control" id="loginpassword" placeholder="Enter password" name="loginpassword" required>
    </div>
    <div class="form-group form-check">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me
      </label>
    </div>
    <button type="submit" class="btn btn-success" name="signup" id="signup">Register</button>
  </form>
</div> -->