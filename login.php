<?php 
	session_start();
    session_destroy();

    include('connection.php');

	$username = isset($_POST['uText']) ? $_POST['uText']: '' ;
	$pword = isset($_POST['uPass']) ? $_POST['uPass']: '';
	$submit=isset($_POST['submit']) ? $_POST['submit']:''; 
	$retxt = '';
	
	if($submit=="เข้าสู่ระบบ") {
		if(($username!='')&&($pword!='')) {
		
			$sqlstr6 = " SELECT * FROM user WHERE uLogin='".$username."'";
			$objQuery6 = mysqli_query($conn,$sqlstr6);
			$objResult6 = mysqli_fetch_array($objQuery6);
			
			if($objResult6['uPassword']!=$pword) {
			 	$retxt = "<font color='red'>ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง</font>";      
			} 
 			if(empty($pword)){ 
				$retxt = "<font color='red'>กรุณาใส่รหัสผ่าน</font>";
			}
			if($objResult6['uPassword']==$pword){                
				session_start();    
				$_SESSION["User"]=$objResult6['uID'];
				echo  "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=kcaltest.php'>";
			}
		}
	}
?>




<html lang="en">
  <head>
  	<title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="style.css">

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
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<a href="index.php">
                <center><img src="assets/images/K2C1.png" style="margin-right:15px;
  padding: 5px;
  width: 150px;">
  </a>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	
                    <form name="loginform" method="post" class="signin-form" action="">
		      		<div class="form-group">
		      			<input type="text" class="form-control" name="uText" placeholder="ชื่อผู้ใช้" required>
		      		</div>
	            <div class="form-group">
	              <input type="password" class="form-control" name="uPass" placeholder="รหัสผ่าน" required>
	            </div>
	            <div class="form-group">
	            	<button type="submit"  name="submit" value="เข้าสู่ระบบ" class="form-control btn btn-primary rounded submit px-3">เข้าสู่ระบบ</button>
                </div>
                <CENTER><p><?=$retxt?></p>
		            	<p style="color:#606468">ยังไม่มีบัญชี ? &nbsp;
                               <a href="register.php">สมัครสมาชิก</a><span class="fontawesome-arrow-right"></span></p>
                               </center>
	          </form>
	          
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

