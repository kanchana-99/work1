<!--เปลี่ยนรูปโปรไฟล์-->
<nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            </li>
            <li class="nav-item d-none d-md-block"><a href="dashboard.php" class="nav-link">หน้าแรก</a></li>
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
               <img
                  src="./assets/img/bbb.png"
                  class="user-image rounded-circle shadow"
                  alt="User Image"
                /> 
                <span class="d-none d-md-inline"><?php echo $_SESSION['fullname'];?></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary">
                <img
                    src="./assets/img/bbb.png"
                    class="rounded-circle shadow"
                    alt="User Image"
                  /> 
                  <p>
                  <?php echo $_SESSION['fullname'];?>
                    <small>อยากลาออกแต่ทำไม่ได้เพราะฉันเป็นเจ้าของร้าน</small>
                  </p>
                </li>
                <!--end::User Image-->
                <!--begin::Menu Body-->
                <!--end::Menu Body-->
                <!--begin::Menu Footer-->
                <li class="user-footer">
                  <a href="logout.php#" class="btn btn-default btn-flat float-end">ออกจากระบบ</a>
                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav