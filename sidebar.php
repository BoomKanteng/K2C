<div class="wrapper">
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item"> <!-- ปุ่ม -->
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="kcaltest.php" class="nav-link">โปรไฟล์และบันทึกแคลอรี่</a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">ออกจากระบบ</a>
      </li>
</div>

<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home.php" class="brand-link">
      <img src="dist/img/K2CLogo.png" alt="AdminLTE Logo"style="
    padding: 4px;
    width: 65px;">
      <span class="brand-text font-weight-light">Kcal to Cool</span>
    </a>
  <!-- Sidebar Menu -->
  <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
               <li class="nav-header">เมนู</li>
               <li class="nav-item">
            <a href="kcaltest.php" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                บันทึกแคลอรี่
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="statistic.php" class="nav-link">
              <i class="nav-icon fas ion-ios-list"></i>
              <p>
                สถิติย้อนหลัง
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                หน้าจัดอันดับ
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="rankeat.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>อันดับการกิน</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="rankworkout.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>อันดับการใช้พลังงาน</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="ranktotalkcal.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>อันดับความสมดุล</p>
                </a>
              </li>
            </ul>

            <li class="nav-item">
              <a href="edit.php" class="nav-link">
                <i class="nav-icon fas ion-android-settings"></i>
                <p>
                  ตั้งค่าบัญชี
                </p>
              </a>
            </li>
          </li>
    
  </aside>