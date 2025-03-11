<?php
session_start(); 
include("../include/config.php");// เชื่อมต่อฐานข้อมูล

// เช็คว่ามี pro_id ถูกส่งมาหรือไม่
if (!isset($_GET['pro_id']) || empty($_GET['pro_id'])) {
  die("Error: ไม่พบรหัสสินค้า");
}

$pro_id = $_GET['pro_id'];

// ดึงข้อมูลสินค้าจากฐานข้อมูล
$sql = "SELECT * FROM product WHERE pro_id = :pro_id";
$query = $dbh->prepare($sql);
$query->bindParam(':pro_id', $pro_id, PDO::PARAM_INT);
$query->execute();
$row = $query->fetch(PDO::FETCH_OBJ);

// ถ้าไม่พบสินค้า ให้แสดงข้อความ
if (!$row) {
  die("Error: ไม่พบข้อมูลสินค้า");
}

// ดึงข้อมูลสินค้าจากฐานข้อมูล
$sql = "SELECT * FROM product WHERE pro_id = :pro_id";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(":pro_id", $pro_id, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Error: Product not found.");
}

?>

<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>แก้ไขข้อมูลสินค้า</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"
    />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />
    <!-- jsvectormap -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
      integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
      crossorigin="anonymous"
    />
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <?php include("include/navbar.php");?>
      <!--end::Header-->
      <!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="dashboard.php" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="./assets/img/AdminLTELogo.png"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">AdminLTE 4</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <?php include("include/sidebar.php");?>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">แก้ไขข้อมูลสินค้า</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="manage_product.php">กลับ</a></li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <!--begin::Col-->
              <div class="col-md-12">
                <div class="card mb-4">
                  <div class="card-header"><h3 class="card-title">แก้ไขข้อมูลสินค้า</h3></div>
                  <!-- /.card-header -->
                  <div class="card-body">
                  <form action="edit_product_api.php" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="pro_id" value="<?php echo htmlspecialchars($row->pro_id); ?>">
                    <input type="hidden" name="old_pro_img" value="<?php echo isset($row->pro_img) ? htmlspecialchars($row->pro_img) : ''; ?>">

                        <div class="form-group">
                            <label for="pro_name">ชื่อสินค้า:</label>
                            <input type="text" class="form-control" id="pro_name" placeholder="พิมพ์ชื่อสินค้าที่นี่" name="pro_name" value="<?php echo htmlspecialchars($product['pro_name']); ?>" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="cat_id">รหัสประเภทสินค้า:</label>
                            <input type="number" class="form-control" id="cat_id" placeholder="พิมพ์รหัสประเภทสินค้าที่นี่" name="cat_id" value="<?php echo $product['cat_id']; ?>" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="pro_cost">ราคาต้นทุน:</label>
                            <input type="number" class="form-control" id="pro_cost" placeholder="พิมพ์ราคาต้นทุนที่นี่" name="pro_cost" value="<?php echo $product['pro_cost']; ?>" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="pro_price">ราคาขาย:</label>
                            <input type="number" class="form-control" id="pro_price" placeholder="พิมพ์ราคาขายที่นี่" name="pro_price" value="<?php echo $product['pro_price']; ?>" required>
                        </div>
                        <br>
        <label>รูปสินค้า:</label>
        <input type="file" name="pro_img">
        <p>
       <?php
            $image_path = "uploads/" . $row->pro_img;

            // ตรวจสอบว่ามีไฟล์หรือไม่ ถ้าไม่มีให้ลองเติมนามสกุลที่เป็นไปได้
            if (!file_exists($image_path)) {
                if (file_exists($image_path . ".png")) {
                    $image_path .= ".png";
                } elseif (file_exists($image_path . ".jpg")) {
                    $image_path .= ".jpg";
                } elseif (file_exists($image_path . ".jpeg")) {
                    $image_path .= ".jpeg";
                } elseif (file_exists($image_path . ".gif")) {
                    $image_path .= ".gif";
                } else {
                    $image_path = "uploads/default.jpg"; // ใช้รูป Default ถ้าไม่พบรูปจริง
                }
            }
            ?>

            <img src="<?php echo htmlspecialchars($image_path); ?>" width="100px" height="100px" alt="รูปสินค้า">
        </p>

        <!-- แสดงภาพเก่าถ้ามี -->
          <?php if (!empty($row->pro_img)) { ?>
              <img src="uploads/<?php echo htmlspecialchars($row->pro_img); ?>" width="100px">
              <input type="hidden" name="old_pro_img" value="<?php echo htmlspecialchars($row->pro_img); ?>">
          <?php } ?>

        <button type="submit" class="btn btn-success" name="save_button" id="save_button">บันทึกการเปลี่ยนแปลง</button>
    </form>

    <?php
    // DEBUG: แสดงค่าที่ส่งมา
    var_dump($_POST);
    var_dump($_FILES);
    ?>

              
                  </div>
                  <!-- /.card-body -->

                </div>
                <!-- /.card -->
 
                <!-- /.card -->
              </div>
              <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row">
              <!-- Start col -->



              <!-- /.Start col -->
            </div>
            <!-- /.row (main row) -->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <?php include("include/footer.php");?>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="js/adminlte.js"></script>
   
  </body>
  <!--end::Body-->
</html>
