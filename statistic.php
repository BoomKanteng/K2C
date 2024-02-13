<?php session_start();

if($_SESSION['User']==''){
  echo  "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=login.php'>";
}   

        
include('connection.php');
    
   /* 
    if($_SESSION['User']!=2){
      echo "SHIT";
    }
*/

    //ข้อมูลผู้ login
    $sqlLogin = "SELECT * FROM user WHERE uID ='".$_SESSION['User']."' ";
    $objQueryLogin = mysqli_query($conn,$sqlLogin);
    $objResultLogin = mysqli_fetch_array($objQueryLogin);


//อายุ
function getAge($birthday) {
  $then = strtotime($birthday);
  return(floor((time()-$then)/31556926));
  }

//ค่า BMI
$BMI = number_format($objResultLogin['uWeight']/(pow($objResultLogin['uHeight']/100,2)),2);
    
//ข้อมูล eat
    $sqlEat = "SELECT * FROM eat ";
    $objQueryEat = mysqli_query($conn,$sqlEat);
    $objResultEat = mysqli_fetch_array($objQueryEat);

//ข้อมูล food
$sqlFood = "SELECT * FROM food ";
$objQueryFood = mysqli_query($conn,$sqlFood);
$objResultFood = mysqli_fetch_array($objQueryFood);  



//ข้อมูล workout
$sqlWorkout = "SELECT * FROM mmove";
$objQueryWorkout = mysqli_query($conn,$sqlWorkout);
$objResultWorkout = mysqli_fetch_array($objQueryWorkout);

//เก็บค่าปุ่ม
$Done = isset($_POST['บันทึก']) ? $_POST['บันทึก']:'';
$Save = isset($_POST['save']) ? $_POST['save']:'';
$DateSelect = isset($_POST['DateSelect']) ? $_POST['DateSelect']:'';
$DateSubmit = isset($_POST['DateSubmit']) ? $_POST['DateSubmit']:'';

//ปุ่มอาหาร
$dessert = isset($_POST['dessert']) ? $_POST['dessert']:'';
$beverage = isset($_POST['beverage']) ? $_POST['beverage']:'';
$food = isset($_POST['food']) ? $_POST['food']:'';
$etcKcal = isset($_POST['etcKcal']) ? $_POST['etcKcal']:'';
$etcName = isset($_POST['etcName']) ? $_POST['etcName']:'';


//ปุ่มออกกำลังกาย
$workout = isset($_POST['workout']) ? $_POST['workout']:'';   
$WorkoutwMinute = isset($_POST['WorkoutwMinute']) ? $_POST['WorkoutwMinute']:''; 
$etcWorkoutName =isset($_POST['etcWorkoutName']) ? $_POST['etcWorkoutName']:'';
$etcWorkoutKcal =isset($_POST['etcWorkoutKcal']) ? $_POST['etcWorkoutKcal']:'';


//ค่าวัน เวลา
$eDate = date('Y-m-d');
$eTime = date('H:i:s');
$wTime = date('H:i:s');


//ข้อมูล AllKcal ด้านบน
$AllKcal = "SELECT eKcal FROM eat WHERE uID='".$_SESSION['User']."' AND eDate='".$eDate."'";
$objQueryAllKcal = mysqli_query($conn,$AllKcal);

   
//ข้อมูล AllEnergy
$AllEnergy = "SELECT wKcal FROM workout WHERE uID='".$_SESSION['User']."' AND wDate='".$eDate."'";
$objQueryAllEnergy = mysqli_query($conn,$AllEnergy);





//ปุ่ม Food
if($Done=="บันทึก"){
 // echo "asldk;lasdk;lsadk;lsakl;sakd;lsa2132132121321;",$workout,$WorkoutwMinute; 

  if($food!=''){
       
    $AllFood= "SELECT * FROM food WHERE fID='".$food."'";
    $objQueryAllFood = mysqli_query($conn,$AllFood);
    $objResultAllFood = mysqli_fetch_array($objQueryAllFood);

  $sqlstrSavory = "INSERT INTO eat(uID,eType,eName,eDate,eTime,eKcal) VALUES('".$_SESSION['User']."','".$objResultAllFood['fType']."','".$objResultAllFood['fName']."','".$eDate."','".$eTime."','".$objResultAllFood['fKcal']."')";
  $objQuerySavory = mysqli_query($conn,$sqlstrSavory);

   } if($etcKcal!=0){


      $AllFood= "SELECT * FROM food WHERE fID='".$food."'";
      $objQueryAllFood = mysqli_query($conn,$AllFood);
      $objResultAllFood = mysqli_fetch_array($objQueryAllFood);
  
    $sqlstrSavoryEtc = "INSERT INTO eat(uID,eType,eName,eDate,eTime,eKcal) VALUES('".$_SESSION['User']."','etc','".$etcName."','".$eDate."','".$eTime."','".$etcKcal."')";
    $objQuerySavoryEtc = mysqli_query($conn,$sqlstrSavoryEtc);

    

    
  //ออกกำลังกาย
  }if($workout!=''){
      
  
  if($WorkoutwMinute!=0){
  
    $AllWorkout= "SELECT * FROM mmove WHERE mID='".$workout."'";
    $objQueryAllWorkout = mysqli_query($conn,$AllWorkout);
    $objResultAllWorkout = mysqli_fetch_array($objQueryAllWorkout);

    $wKcal = $objResultLogin['uWeight']*$objResultAllWorkout['mMET']*0.0175*$WorkoutwMinute;

    $sqlstr7 = "INSERT INTO workout(uID,wName,wMET,wMinute,wDate,wTime,wKcal) VALUES('".$_SESSION['User']."','".$objResultAllWorkout['mName']."','".$objResultAllWorkout['mMET']."','".$WorkoutwMinute."','".$eDate."','".$wTime."','".$wKcal."')";
    $objQuery7 = mysqli_query($conn,$sqlstr7);

}
}if($etcWorkoutKcal!=0){
  

  $sqlstr8 = "INSERT INTO workout(uID,wName,wMET,wMinute,wDate,wTime,wKcal) VALUES('".$_SESSION['User']."','".$etcWorkoutName."','0','0','".$eDate."','".$wTime."','".$etcWorkoutKcal."')";
  $objQuery8 = mysqli_query($conn,$sqlstr8);

} } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kcal to Cool</title>

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
  <link rel="stylesheet" href="dist/css/adminlte.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- Boom text -->
  <link rel="stylesheet" href="text.css">
 <!-- Select2 -->
 <link rel="stylesheet" href="plugins/select2/css/select2.css">
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
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    </div>
    <!-- Main content -->
    <section class="content"> 
		<div class="col-md-12">
        <!-- Widget: user widget style 1 -->
			<div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white"
                   style="background: url('pic/bg/<?php echo $objResultLogin['uBg'] ?>') center center;">
                <h3 class="widget-user-username text-right"><?php echo $objResultLogin['uName'] ?></h3>
                <h5 class="widget-user-desc text-right"><?php echo $objResultLogin['uStatus'] ?></h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="pic/profile/<?php echo $objResultLogin['uPic'] ?>" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo getAge($objResultLogin['uDate']); ?></h5>
                      <span class="description-text">อายุ(ปี)</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo $objResultLogin['uHeight']; ?></h5>
                      <span class="description-text">ส่วนสูง(เซนติเมตร)</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo $objResultLogin['uWeight']; ?></h5>
                      <span class="description-text">น้ำหนัก(กิโลกรัม)</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
          <!-- /.col -->
    
      <div class="container-fluid"> 
      
        <!-- Small boxes (Stat box) -->
        <div class="row">
        
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <form name="DateForm" method="post" action="">
				กำหนดวันที่<br>
                <input type="date" name="DateSelect" value="DateSelect" class="form-control" placeholder="เลือกวันที่"><br>
                <button type="submit" name="DateSubmit" value="DateSubmit" class="btn btn-light">ตกลง</button>
            </form>
            </div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gradient-primary"> <!-- สีเดิม : bg-info -->
              <div class="inner">
                <h3><?php //Top Kcal
					$sum=0;
                    
                    if($DateSubmit=="DateSubmit"){

                        $AlleatTop = "SELECT * FROM eat WHERE eDate='".$DateSelect."' AND uID='".$_SESSION['User']."'";
						$objQueryAlleatTop = mysqli_query($conn,$AlleatTop);

					while($objResultAlleatTop = mysqli_fetch_array($objQueryAlleatTop)) {
					  $sum=$sum+$objResultAlleatTop['eKcal'];
					}
					echo $sum;
                } else echo "-";
					?></h3>
                <p>แคลอรี่</p>
              </div>
              <div class="icon ">
               
                <i class="ion ion-spoon"></i>
                
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger"> <!-- class="small-box bg-success" สีเขียว-->
              <div class="inner">
                <h3><?php //Top burn
                $burn=0;
                    
                    if($DateSubmit=="DateSubmit"){

                        $AllburnTop = "SELECT * FROM workout WHERE wDate='".$DateSelect."' AND uID='".$_SESSION['User']."'";
						$objQueryAllburnTop = mysqli_query($conn,$AllburnTop);

					while($objResultAllburnTop = mysqli_fetch_array($objQueryAllburnTop)) {
					  $burn=$burn+$objResultAllburnTop['wKcal'];
					}
					echo $burn;
                } else echo "-";
                ?>
                <sup style="font-size: 20px"></sup></h3>

                <p>การเผาผลาญแคลอรี่</p>
              </div>
              <div class="icon">
                <i class="ion ion-fireball"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 ><?php  if($DateSubmit=="DateSubmit"){
                    echo $sum-$burn;
                } else echo "-"; ?></h3>

                <p>แคลอรี่สะสม</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-6 connectedSortable">
            <!-- BOOM2 -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  รายการอารหารที่รับประทาน
                </h3>
                <div class="card-tools">
                </div>
              </div><!-- /.card-header -->

              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 100%; text-align:center; ">
                       
                       <?php
						 //Kcalทั้งหมด
						$Meal=0;
						$sumdown=0;

						
						
						
						//SHOW
						//AllKcal while loop
						 ?>       

    <p style="text-align:left"> <img src="dist/img/calendar 3.png" style=" padding: 5px; width: 50px; ">&nbsp;
     <?php if($DateSubmit=="DateSubmit"){
         echo $DateSelect ;
     } ?></p>
    
    <div class="card-body p-0">
    
    <table class="table table-striped" border="0" align="center">
    <tr height="30 px">
      <td width="7%">ลำดับ</td>
      <td>บันทึกเมื่อ</td>
      <td>รายการ</td>
      <td width="10%">kcal</td>
    </tr>

    <?php if($DateSubmit=="DateSubmit"){ 

        //ดึงข้อมูล eat ทั้งหมด
						$Alleat = "SELECT * FROM eat WHERE eDate='".$DateSelect."' AND uID='".$_SESSION['User']."'";
						$objQueryAlleat = mysqli_query($conn,$Alleat); ?>
 
  <?php
    while($objResultAlleat = mysqli_fetch_array($objQueryAlleat)) {
  ?>
      <tr>     
         <?php if($objResultAlleat['eKcal'] != 0){ ?>
        <td width="7%"><?php echo $Meal=$Meal+1,"&nbsp;&nbsp;";?></td>
        <td width="20%"><?php  echo $objResultAlleat['eTime'];?></td>
        <td><?php  echo $objResultAlleat['eName'];?></td>
        <td width="10%"><?php  echo $objResultAlleat['eKcal']; ?></td>
  </tr>

  
   
   
 <?php  }  } }// ?>  
       
    </table> 
  </div>
  

    </div>               
  </div>
  </div>
  </div>
         </section>
         
          <!-- /.Left col -->
         
      

          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-6 connectedSortable">

   <!-- HEREBOOM -->
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  รายการใช้พลังงาน
                </h3>
                <div class="card-tools">
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height:100%; text-align:center;">
              
                       
                      

                       <?php 

//SHOW2


$move=0;
$burndown=0; //Kcal ที่ Burn ทั้งหมด


?>
  <p style="text-align:left"> <img src="dist/img/calendar 3.png" style=" padding: 5px; width: 50px; ">&nbsp; <?php 
    if($DateSubmit=="DateSubmit"){
        echo $DateSelect;
    }
?></p>
 
  <div class="card-body p-0">
    <table class="table table-striped" border="0" align="center">
    <tr height="30 px">
      <td width="7%">ลำดับ</td>
      <td width="20%">บันทึกเมื่อ</td>
      <td>รายการ</td>
      <td width="10%">kcal</td>
    </tr>

    <?php if($DateSubmit=="DateSubmit"){ 
        
//ข้อมูล Show workout

$AllWorkoutShow ="SELECT * FROM workout WHERE wDate='".$DateSelect."' AND uID='".$_SESSION['User']."'";
$objQueryAllWorkoutShow = mysqli_query($conn,$AllWorkoutShow);

        
        ?>

  <?php
    while($objResultAllWorkoutShow = mysqli_fetch_array($objQueryAllWorkoutShow)){ 
      ?>
    <tr>
      <td width="7%"><?php  echo $move=$move+1;?></td>
      <td><?php  echo $objResultAllWorkoutShow['wTime'];?></td>
      <td><?php  echo $objResultAllWorkoutShow['wName'];?></td>
      <td width="10%"><?php  echo $objResultAllWorkoutShow['wKcal'];?></td>
    </tr>
 <?php   } } ?>
    
    
    


  </table>
  </div>                  


  </div>
  </div>
  </div>
  </div>
  </div>
  
          </section>


              </div>
              
              
              <!-- /.card-body-->
              <div class="card-footer bg-transparent">
              <div class="row">
                  <div class="col-4 text-center" >

                  </div>
                
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.card -->


            <!-- /.card -->

           
              

               
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
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="../../plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script>



</body>
</html>
