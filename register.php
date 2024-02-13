<?php
    session_start();
    session_destroy();  
  
    include('connection.php');
    
    $uStatus = "user";
    $uJob = isset($_POST['Job']) ? $_POST['Job']:'';
    $uAge=isset($_POST['uAge']) ? $_POST['uAge']:'';
    $uDate=isset($_POST['uDate']) ? $_POST['uDate']:'';
    $uGender = isset($_POST['gender']) ? $_POST['gender']:'';
    $uName = isset($_POST['uName']) ? $_POST['uName']:'';
    $username2 = isset($_POST['uText2']) ? $_POST['uText2']: '' ;
    $pword2 = isset($_POST['uPass2']) ? $_POST['uPass2']: '';
    $register=isset($_POST['register']) ? $_POST['register']:'';
    $error = array();
    $pwordCheck = isset($_POST['uPassCheck']) ? $_POST['uPassCheck']: '';
    
    $uHeight = isset($_POST['Height']) ? $_POST['Height']:'';
    $uWeight = isset($_POST['Weight']) ? $_POST['Weight']:'';

    $sqlCheck = "SELECT * FROM user WHERE uLogin ='".$username2."' OR uName ='".$uName."' ";
    $objQueryCheck = mysqli_query($conn,$sqlCheck);
    $objResultCheck = mysqli_fetch_array($objQueryCheck);
    

    ?>




<html lang="en">
  <head>
  	<title>Register</title>
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

            <?php     

$retxt = '';
      if($register=="สมัครสมาชิก"){
            if($username2!=''){


                          if($objResultCheck['uLogin']==$username2){
                            $retxt = "<font color='red'>ชื่อผู้ใช้ซ้ำ</font>";
                                            }
                          if($objResultCheck['uName']==$uName){
                            $retxt = "<font color='red'>ชื่อเล่นซ้ำ</font>";
                                            }
                          if($pword2!=$pwordCheck){
                            $retxt = "<font color='red'>รหัสผ่านไม่ตรงกัน</font>";
                                            }
                          if(empty($uGender)){
                            $retxt = "<font color='red'>กรุณาระบุเพศ</font>";
                                                              }

                                    if($retxt==''){
                                                $sqlstr6 = "INSERT INTO user(uLogin,uPassword,uName,uGender,uHeight,uWeight,uDate,uStatus,uPic,uBg) VALUES('$username2','$pword2','$uName','$uGender','$uHeight','$uWeight','$uDate','$uStatus','newbie.png','bgnewbie.jpg')";
                                                $objQuery6 = mysqli_query($conn,$sqlstr6);      
                                                $retxt = "<font color='green'>สมัครเสร็จสิ้น</font>";               
                                                echo "<META HTTP-EQUIV='Refresh' CONTENT='3;URL=login.php'>";
                                        }       
                                                                                
                                                
                                                                            
                                }  
                                   
               
                                 } 

      ?> 
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	
                    <form name="registerform" method="post" class="signin-form">
		      		<div class="form-group">
		      			<input type="text" class="form-control" name="uText2" placeholder="ชื่อผู้ใช้" required>
		      		</div>
	            <div class="form-group">
	              <input type="password" class="form-control" name="uPass2" placeholder="รหัสผ่าน" required>
	            </div>
                <div class="form-group">
	              <input type="password" class="form-control" name="uPassCheck" placeholder="ยืนยันรหัสผ่าน" required>
	            </div>
                <div class="form-group">
	              <input type="text" class="form-control" name='uName' placeholder="ชื่อเล่น" required>
	            </div>
              <div class="form-group">
                <CENTER><p><?=$retxt?></p></center>
                <input type="radio" name="gender" value="Male"> เพศชาย &nbsp;
                <input type="radio" name="gender" value="Female" > เพศหญิง
	            </div>
                <div class="form-group">
	              <input type="date" class="form-control" name="uDate" placeholder="วันเกิด" required>
	            </div>
                <div class="form-group">
	              <input type="number" min="0" class="form-control" name="Height" placeholder="ส่วนสูง (ซม.)" required>
	            </div>
                <div class="form-group">
	              <input type="number" min="0" class="form-control"  name="Weight" placeholder="น้ำหนัก (กก.)" required>
	            </div>
                

	            <div class="form-group">
	            	<button type="submit"  name="register" value="สมัครสมาชิก" class="form-control btn btn-primary rounded submit px-3">สมัครสมาชิก</button>
                </div>

                
            
		            	<center><p style="color:#606468">มีบัญชีแล้ว? &nbsp;
                               <a href="login.php">เข้าสู่ระบบ</a><span class="fontawesome-arrow-right"></span></p>
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

