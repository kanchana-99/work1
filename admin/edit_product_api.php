<?php session_start();
include("../include/config.php");
error_reporting(0);

if ($_SESSION['user_type']==1) {
    header('location:logout.php');
    
}else{
    if(isset($_POST['update'])){
        $eid = $_POST['eid'];
        $pro_name  = $_POST['pro_name'];
        $cat_id = $_POST['cat_id'];
        $pro_price  = $_POST['pro_price'];
        $pro_cost  = $_POST['pro_cost'];
        $pro_img  = $_POST['pro_img'];

        $sql = "UPDATE product SET pro_name=:pro_name,
        cat_id=:cat_id,
        pro_price=:pro_price,
        pro_cost=:pro_cost,
        pro_img=:pro_img WHERE pro_id=:eid";

        $query = $dbh->prepare($sql);
        $query->bindParam(':eid',$eid,PDO::PARAM_STR);
        $query->bindParam(':pro_name',$pro_name,PDO::PARAM_STR);
        $query->bindParam(':cat_id',$cat_id,PDO::PARAM_STR);
        $query->bindParam(':pro_price',$pro_price,PDO::PARAM_STR);
        $query->bindParam(':pro_cost',$pro_cost,PDO::PARAM_STR);
        $query->bindParam(':pro_img',$pro_img,PDO::PARAM_STR);
        $query->execute();
        echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
 
    if($query){
        echo '<script>
             setTimeout(function() {
              swal({
                  title: "ปรับปรุงข้อมูลสำเร็จ",
                  type: "success"
              }, function() {
                  window.location = "manage_product.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }else{
       echo '<script>
             setTimeout(function() {
              swal({
                  title: "เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง",
                  type: "error"
              }, function() {
                  window.location = "manage_product.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }
    $dbh = null; //close connect db
   
    }
}
    
?>





