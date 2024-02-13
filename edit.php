<?php 
	session_start();
    if($_SESSION['User']==''){
      echo  "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=login.php'>";
    }   

	include('connection.php');
	
	//อายุ
	function getAge($birthday) {
	  $then = strtotime($birthday);
	  return(floor((time()-$then)/31556926));
	  }
	
	$UserChange = isset($_POST['UserChange']) ? $_POST['UserChange']:'';       //เก็บค่า User ที่จะเปลี่ยน
	$PasswordChange = isset($_POST['PasswordChange']) ? $_POST['PasswordChange']:''; //เก็บค่า Password ที่จะเปลี่ยน
	$change = isset($_POST['change']) ? $_POST['change']:''; //ตั้งค่าให้เริ่มทำงานเมื่อกดปุ่ม
	$Done = isset($_POST['บันทึก']) ? $_POST['บันทึก']:'';
	$uGender = isset($_POST['gender']) ? $_POST['gender']:'';
	
	$HeightChange = isset($_POST['HeightChange']) ? $_POST['HeightChange']:'';
	$WeightChange = isset($_POST['WeightChange']) ? $_POST['WeightChange']:'';
	
	//วันเกิด
	$DateChange = isset($_POST['DateChange']) ? $_POST['DateChange']:'';
	
	if($change=="change"){ 
		if($_POST['UserChange']!=""){
			$sqlEdit = "UPDATE user SET uName ='".$UserChange."' WHERE uID ='".$_SESSION['User']."'";
			$objQueryEdit = mysqli_query($conn,$sqlEdit);
		}if($_POST['PasswordChange']!=""){
			$sqlEdit2 = "UPDATE user SET uPassword ='".$PasswordChange."' WHERE uID ='".$_SESSION['User']."'";
			$objQueryEdit2 = mysqli_query($conn,$sqlEdit2);
			
		} if($_POST['HeightChange']!=""){
			$sqlEdit3 = "UPDATE user SET uHeight ='".$HeightChange."' WHERE uID ='".$_SESSION['User']."'";
			$objQueryEdit3 = mysqli_query($conn,$sqlEdit3); 
			
		} if($_POST['WeightChange']!=""){
			$sqlEdit4 = "UPDATE user SET uWeight ='".$WeightChange."' WHERE uID ='".$_SESSION['User']."'";
			$objQueryEdit4 = mysqli_query($conn,$sqlEdit4);
		
		} if($_POST['DateChange']!=""){
		  $sqlEdit5 = "UPDATE user SET uDate ='".$DateChange."' WHERE uID ='".$_SESSION['User']."'";
		  $objQueryEdit5 = mysqli_query($conn,$sqlEdit5);
		
		} if($_POST['gender']!=""){
		  $sqlEdit6 = "UPDATE user SET uGender ='".$uGender."' WHERE uID='".$_SESSION['User']."'";
		  $objQueryEdit6 = mysqli_query($conn,$sqlEdit6);
		}
	}
	
	//รูปภาพ
	if($Done=="บันทึก"){
				  if(isset($_FILES['pp1'])){
					$filename1 = '';
					$Upload_Dir = "pic/profile/";
					$Max_File_Size = 20000000; //กำหนดขนาดไฟล์ที่ ใหญ่ที่สุดที่อนุญาตให้ upload มาที่ Server มีหน่วยเป็น byte
						
					  function validate_form($file_input,$file_size,$file_type) { //เป็น function ที่เอาไว้ตรวจสอบว่าไฟล์ที่ผู้ใช้ upload ตรงตามเงื่อนไขหรือเปล่า
						global $Max_File_Size,$File_Type_Allow;
						if ($file_input == "none") {
						  $error = "ไม่มี file ให้ Upload";
						} elseif ($file_size > $Max_File_Size) {
						  $error = "ขนาดไฟล์ใหญ่กว่า $Max_File_Size ไบต์";
						} else {
						  $error = false;
						}
					  
						return $error;
					  }
					  
					  // รูปที่ 1 
					  if ( $_FILES['pp1']['error'] ) { 
						die($_FILES["pp1"]["error"]);
					  }
					  
					  if($_FILES['pp1']['name']!=''){
						$error_msg = validate_form($_FILES['pp1'],$_FILES['pp1']["size"],$_FILES['pp1']["type"]); // ตรวจดูว่า ไฟล์ที่ upload ตรงตามเงื่อนไขหรือเปล่า
					
						if ($error_msg) {
						  die($error_msg);
						} else {
						  $Uploadpath = $_SESSION['User']."-".$_FILES['pp1']['name'];
						  if (copy($_FILES['pp1']['tmp_name'],$Upload_Dir."/".$Uploadpath)) { //ทำการ copy ไฟล์มาที่ Server
							$filename1 = "paper1='".$Uploadpath."',";
	
						  
							  $sqlEdit6 = "UPDATE user SET uPic ='".$Uploadpath."' WHERE uID='".$_SESSION['User']."'";
							  $objQueryEdit6 = mysqli_query($conn,$sqlEdit6);
							
							
	
						  } else {
							die("ไฟล์ Upload มีปัญหา ".$_FILES["pp1"]["error"]);
						  }
						  }
						}
					  }// ปิด pp1
	
	//bg
					  if(isset($_FILES['pp2'])){
						$filename1 = '';
						$Upload_Dir = "pic/bg/";
						$Max_File_Size = 20000000; //กำหนดขนาดไฟล์ที่ ใหญ่ที่สุดที่อนุญาตให้ upload มาที่ Server มีหน่วยเป็น byte
							 
						  function validate_form($file_input,$file_size,$file_type) { //เป็น function ที่เอาไว้ตรวจสอบว่าไฟล์ที่ผู้ใช้ upload ตรงตามเงื่อนไขหรือเปล่า
							 global $Max_File_Size,$File_Type_Allow;
							 if ($file_input == "none") {
							  $error = "ไม่มี file ให้ Upload";
							 } elseif ($file_size > $Max_File_Size) {
							  $error = "ขนาดไฟล์ใหญ่กว่า $Max_File_Size ไบต์";
							 } else {
							  $error = false;
							 }
						   
							 return $error;
						  }
						  
						  // รูปที่ 1 
						  if ( $_FILES['pp2']['error'] ) { 
							die($_FILES["pp2"]["error"]);
						  }
						  
						  if($_FILES['pp2']['name']!=''){
							$error_msg = validate_form($_FILES['pp2'],$_FILES['pp2']["size"],$_FILES['pp2']["type"]); // ตรวจดูว่า ไฟล์ที่ upload ตรงตามเงื่อนไขหรือเปล่า
						
							if ($error_msg) {
							   die($error_msg);
							} else {
							   $Uploadpath = $_SESSION['User']."-".$_FILES['pp2']['name'];
							   if (copy($_FILES['pp2']['tmp_name'],$Upload_Dir."/".$Uploadpath)) { //ทำการ copy ไฟล์มาที่ Server
								$filename1 = "paper1='".$Uploadpath."',";
					  
							   
								  $sqlEdit6 = "UPDATE user SET uBg ='".$Uploadpath."' WHERE uID='".$_SESSION['User']."'";
								  $objQueryEdit6 = mysqli_query($conn,$sqlEdit6);
								
								
					  
							   } else {
								die("ไฟล์ Upload มีปัญหา ".$_FILES["pp2"]["error"]);
							   }
							  }
							}
						  }// ปิด pp1
	
	}//ปิด $Done
	
	 //ข้อมูลผู้ login
	 $sqlLogin = "SELECT * FROM user WHERE uID ='".$_SESSION['User']."' ";
	 $objQueryLogin = mysqli_query($conn,$sqlLogin);
	 $objResultLogin = mysqli_fetch_array($objQueryLogin);
	
	
	//ค่า BMI
	$BMI = number_format($objResultLogin['uWeight']/(pow($objResultLogin['uHeight']/100,2)),2);
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kcal To Cool</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- Boom text -->
  <link rel="stylesheet" href="text.css">
 <!-- Select2 -->
 <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  
   <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400;500&display=swap" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<style type="text/css">
	
	body,td,th {
		font-family: 'Kanit', sans-serif;
	}

	</style>


</head>
<body class="hold-transition sidebar-mini layout-fixed">

<?php include('sidebar.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ข้อมูลส่วนตัว</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
            <!-- BOOM2 -->
            <!-- HEREBOOM -->

<div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">

            <div class="card card-primary" >
              <div class="card-header" >
                <h3 class="card-title">แก้ไขข้อมูล</h3>
              </div>

              <form name="ChangeForm" method="post" action="">
                <div class="card-body" >
                  <div class="form-group" >
                    <label>ชื่อเล่น</label>
                    <input type="text" name="UserChange" class="form-control" value="<?php echo $objResultLogin['uName']; ?>">
                  </div> 
                  <div class="form-group">
                    <label>รหัสผ่าน</label>
                    <input type="text" name="PasswordChange" class="form-control"  value="<?php echo $objResultLogin['uPassword']; ?>">
                  </div>
                  <div class="form-group">
                    <label>ส่วนสูง (ซม.)</label>
                    <input type="text" name="HeightChange" class="form-control" id="exampleInputPassword1" value="<?php echo $objResultLogin['uHeight']; ?>">
                  </div>

                  <div class="form-group">
                    <label>น้ำหนัก (กก.)</label>
                    <input type="text" name="WeightChange" class="form-control" id="exampleInputPassword1" value="<?php echo $objResultLogin['uWeight']; ?>">
                  </div>

                  <div class="form-group">
                    <label>เพศ</label>&nbsp; &nbsp; &nbsp; &nbsp; 
                    <input  type="radio" name="gender" value="Male" <?php if($objResultLogin['uGender']=="Male") echo "checked"; ?>> ชาย&nbsp; &nbsp; &nbsp; &nbsp; 
                    <input  type="radio" name="gender" value="Female"<?php if($objResultLogin['uGender']=="Female") echo "checked"; ?>> หญิง
                    
				          </div> 

                  <div class="form-group">
                    <label>วัน/เดือน/ปี เกิด</label>
                    <input type="date" name="DateChange" class="form-control" id="exampleInputPassword1" value="<?php echo $objResultLogin['uDate']; ?>">
                  </div>

                  <div class="form-group">
                    <label>อายุ</label>
                    <input type="text" disabled="disabled" class="form-control" id="exampleInputPassword1" style="text-align:left;" value="<?php echo getAge($objResultLogin['uDate']); ?>">
                  </div>

                    <button type="submit" name="change" value="change" class="btn btn-primary">แก้ไข</button>
                </div>
              </form>
            </div>
        </section>
    
    
       <!-- right col (We are only adding the ID to make the widgets sortable)-->
       <section class="col-lg-5 connectedSortable">

<!-- Map card -->
<!-- Form Element sizes -->

<div class="card card-success" >
<div class="card-header" >
  <h3 class="card-title">รูปโปรไฟล์</h3>
</div>
<form name="Pictureform" method="post" action="" enctype="multipart/form-data">
  <div class="card-body" >
      <div class="form-group">
        <label for="exampleInputFile">เพิ่มไฟล์</label><br>
        <img style="padding: 5px; 
        width: 300px; 
        display: block;
        margin-left:20%; 
        "
        src="pic/profile/<?php echo $objResultLogin['uPic'];?>" alt="User Avatar"> <BR><BR>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="pp1" accept="image/*,application/pdf" required>
            <label class="custom-file-label">เลือกรูปภาพ</label>
          </div>
            <input type="submit" class="input-group-text" name="บันทึก" value="บันทึก">
        </div>
      </div>
  </div>
</form>
</div>
<div class="card card-warning" >
<div class="card-header" >
  <h3 class="card-title">รูปปกโปรไฟล์</h3>
</div>
<form name="Pictureform" method="post" action="" enctype="multipart/form-data">
  <div class="card-body" >
      <div class="form-group">
        <label for="exampleInputFile">เพิ่มไฟล์</label><br>
        <img style="padding: 5px; 
        width: 300px; 
        display: block;
        margin-left:20%; 
        "
        src="pic/bg/<?php echo $objResultLogin['uBg'];?>" alt="User Avatar"> <BR><BR>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="pp2" accept="image/*,application/pdf" required>
            <label class="custom-file-label">เลือกรูปภาพ</label>
          </div>
            <input type="submit" class="input-group-text" name="บันทึก" value="บันทึก">
        </div>
      </div>
  </div>
</form>
</div>
  <!-- /.card-header -->
  <div class="card-body pt-0">
    <!--The calendar -->
    <div id="calendar" style="width: 100%"></div>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
</section>
<!-- right col -->
</div>
<!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
  <footer class="main-footer">
  <strong>Kcal2Cool</strong> : Keep Kcal Stay Cool
    <div class="float-right d-none d-sm-inline-block">
      <b><a target="_blank"href="https://www.deebuk.ac.th/th/">โรงเรียนดีบุกพังงาวิทยายน</b>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>

</body>
</html>
