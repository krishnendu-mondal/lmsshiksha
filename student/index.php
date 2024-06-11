<?php
session_start();
if (!isset($_SESSION["student"])) {
  header("Location: ../");
}else{
  $student_name = $_SESSION['student_name'];
  $student_dept = $_SESSION['student_dept'];
  $student_roll = $_SESSION['student_roll'];
  date_default_timezone_set("Asia/Kolkata");
  $time_now = date('d-m-Y g:i a');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Student | Dashboard</title>
  <link rel="shortcut icon" href="student-asset/graduation-cap-fill.png" type="image/x-icon">
  <script src="https://kit.fontawesome.com/62b94e81b1.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,300&display=swap');

    * {
      margin: 0;
      padding: 0;
      outline: none;
      border: none;
      text-decoration: none;
      box-sizing: border-box;
      font-family: 'Nunito Sans', sans-serif;
    }

    body {
      height: 100vh;
      width: 100%;
    }

    nav {
      box-shadow: 1px 1px 8px rgba(0, 0, 0, 0.3);
      display: flex;
      padding: 15px 20px;
      justify-content: space-between;
    }

    nav a {
      color: black;
      font-size: 18px;
      font-weight: 600;
      letter-spacing: .05rem;
      padding: 15px 10px;
      border-radius: 5px;
      transition: background ease 0.3s;
    }

    .links a {
      margin: 0 20px;
      cursor: pointer;
    }

    .logo i {
      font-size: 22px;
      color: cadetblue;
    }

    .links a:hover {
      background: #ddd;
    }

    .container {
      position: relative;
      margin-top: 10px;
      height: 90%;
      width: 100%;
      display: flex;
    }

    .sidebar {
      position: relative;
      overflow: hidden;
      background-color: white;
      height: 100%;
      width: 65px;
      background: #fff;
      box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
      transition: width ease-out 0.3s;
      z-index: 10;
    }

    .sidebar:hover {
      width: 250px;
    }

    .sidebar-links {
      margin-top: 30px;
    }

    .sidebar-links .logout {
      position: absolute;
      bottom: 3vh;
    }

    .sidebar-links p {
      display: flex;
      padding: 15px 80px 15px 20px;
      align-items: center;
      color: #333;
      margin-bottom: 5px;
      position: relative;
    }

    .sidebar-links .ri {
      font-size: 1.6rem;
      margin-right: 25px;
      transition: color ease-in-out 120ms;
    }

    .sidebar-links .fa {
      font-size: 1.4rem;
      margin-right: 22px;
      transition: color ease-in-out 120ms;
    }

    .sidebar-links span {
      min-width: 150px;
      font-weight: 500;
      letter-spacing: 1px;
      font-size: 1.05rem;
    }


    .sidebar-links p:hover {
      background-color: #ddd;
      cursor: pointer;
    }

    .sidebar-links p:hover i,
    p:hover span {
      color: lightseagreen;
    }

    #active {
      background-color: #ddd;
      color: lightseagreen;
    }

    .main {
      position: absolute;
      height: 80%;
      width: 90%;
      left: 8rem;
      top: 2rem;
      z-index: 0;
    }

    .main p {
      color: rgb(43, 57, 207);
      font-size: 2rem;
      letter-spacing: .15rem;
    }
    #student-index-img{
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-70%, -45%);
      height: 100%;
      width: 40%;
      margin-top: 3.5%;
    }
    .boxes{
      width: 25%;
      float: right;
      padding: 1rem 4rem 0 0;
    }
    .boxes .box{
      background: #abe;
      height: 20%;
      padding: 1rem 2rem 2rem 2rem;
      margin-bottom: 2rem;
      border-radius: 10px;
      box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
      cursor: pointer;
    }
    .box:hover{
      box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.6);;
    }
    .box h3{
      margin-bottom: 10px;
      letter-spacing: .5px;
      color: whitesmoke;
      font-weight: 500;
    }
    .box ul{
      list-style: none;
      line-height: 2;
    }
    .box li{
      display: flex;
      align-items: center;
      gap: 5px;
      font-size: 17px;
    }
    .box li:nth-child(1){
      color: yellow;
    }
    .box li:nth-child(2){
      color: red;
    }
  </style>
</head>

<body>
  <nav>
    <div class="logo"><a href="../"><i class="ri-graduation-cap-fill"></i> Lmsshiksha</a></div>
    <div class="links">
      <a href="../">Home</a>
    </div>
  </nav>
  <div class="container">
    <div class="sidebar">
      <div class="sidebar-links">
        <ul>
          <li>
            <p id="active"><i class="ri ri-user-2-fill"></i><span>
                <?php echo $_SESSION["student_name"] ?>
              </span></p>
          </li>
          <li>
            <p onclick="window.location.href='assignment.php'"><i
                class="ri ri-pencil-ruler-2-line"></i><span>Assignments</span></p>
          </li>
          <li>
            <p onclick="window.location.href='attendance.php'"><i class="ri ri-pie-chart-2-line"></i><span>Attendance</span></p>
          </li>
          <li>
            <p onclick="window.location.href='exam.php'"><i class="fa fa-solid fa-chalkboard-user"></i></i><span>Exams</span>
            </p>
          </li>
          <li>
            <p onclick="window.location.href='settings.php'"><i class="ri ri-settings-4-line"></i><span>Settings</span>
            </p>
          </li>
        </ul>
        <div class="logout">
          <p onclick="window.location.href='logout.php'"><i class="ri ri-logout-box-r-line"></i><span>Logout</span></p>
        </div>
      </div>
    </div>
    <?php 
      require_once("DB.php");
      $sql = "SELECT `atd_status` FROM `attendance` WHERE `roll`='{$student_roll}'";
      $result = mysqli_query($conn, $sql) or die("Query Failed!");
      $atd_count = 0;
      $atd_present = 0;
      $atd_percentile = 0;
      if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
          if($row['atd_status']!='H'){
            $atd_count++;
          }
          if($row['atd_status']=='P'){
            $atd_present++;
          }
        }
        if($atd_present){
          $atd_percentile = round(($atd_present/$atd_count)*100);
        }
      }
      
      
      $prev_date = date("d-m-Y", strtotime('-1 day', strtotime($time_now)));
      $today_date = date("d-m-Y", strtotime($time_now));
      $sql = "SELECT * FROM `assignment` WHERE `time` LIKE '$prev_date%' or `time` LIKE '$today_date%' ";
      $result = mysqli_query($conn, $sql) or die("Query Failed!");
      $new_ass_count = 0;
      if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
          $sql = "SELECT * FROM `assignment_submission` WHERE `ass_slno` = '{$row['slno']}' AND `student_roll` = '{$student_roll}'";
          $res = mysqli_query($conn, $sql) or die("Query Failed!");
          if(!mysqli_num_rows($res)){
            $new_ass_count++;
          }
        }
        
      }

      $sql = "SELECT * FROM `assignment` WHERE `time` LIKE '$prev_date%' or `time` LIKE '$today_date%' ";
      $result = mysqli_query($conn, $sql) or die("Query Failed!");
      $pending_ass_count = 0;
      if(mysqli_num_rows($result)==0){
        while($row = mysqli_fetch_assoc($result)){
          if(strtotime($row['deadline']) > strtotime($today_date)){
            $sql = "SELECT * FROM `assignment_submission` WHERE `ass_slno` = '{$row['slno']}' AND `student_roll` = '{$student_roll}'";
            $res = mysqli_query($conn, $sql) or die("Query Failed!");
            if(!mysqli_num_rows($res)){
              $pending_ass_count++;
            }
            
          }
        }
      }
      
      $sql = "SELECT * FROM `exam` WHERE `dept` = '{$student_dept}' AND `lock_status` = '1'";
      $exam_result = mysqli_query($conn, $sql) or die("Query Failed!");
      $exam_row = mysqli_fetch_assoc($exam_result);
      mysqli_close($conn);
    ?>
    
    <div class="main">
      <p>Welcome to student dashboard,
        <?php echo $_SESSION["student_name"] ?>
      </p>
      <img src="student-asset/5437683.webp" alt="" id="student-index-img">
      <div class="boxes">
        <div class="box" onclick="window.location.href='attendance.php'">
          <h3>Attendance</h3>
          <span style=" font-size: 18px; font-weight:600; color: <?php $atd_percentile>=75?print'green':print'yellow' ?>;" ><?php echo $atd_percentile; ?>%</span>
        </div>
        <?php if($new_ass_count > 0 or $pending_ass_count > 0){ ?>
        <div class="box" onclick="window.location.href='assignment.php'">
          <h3>Assignment</h3>
          <ul>
            <?php if($new_ass_count){ ?>
            <li><i class="ri-notification-2-line"></i><span><?php echo $new_ass_count ?> new assignment</span></li>
            <?php } ?>
            <?php if($pending_ass_count){ ?>
            <li><i class="ri-error-warning-line"></i><span><?php echo $pending_ass_count ?><?php $pending_ass_count>1?print' assignments ':print' assignment ' ?>  pending</span></li>
            <?php }else{ ?>
              <li style="color: blue"><i class="ri-checkbox-circle-line"></i><span>No  pending assignment</span></li>
            <?php } ?>
          </ul>
        </div>
        <?php } ?>
        <?php if(mysqli_num_rows($exam_result)>0){ ?>
        <div class="box" onclick="window.location.href='exam.php'">
          <h3>Exam</h3>
          <?php if(strtotime($exam_row['exam_date']) > strtotime($today_date)){ ?>
            <span style="color: blue">Starting date: <?php echo date("d-m-Y",strtotime($exam_row['exam_date']));  ?></span>
          <?php }else{ ?>
            <span style="color: blue">Started on: <?php echo date("d-m-Y",strtotime($exam_row['exam_date']));  ?></span>
          <?php } ?>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>


</body>

</html>