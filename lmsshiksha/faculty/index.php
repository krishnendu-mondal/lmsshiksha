<?php
session_start();
if (!isset($_SESSION["faculty"])) {
  header("Location: ../");
}else{
  $faculty_name = $_SESSION["faculty_name"];
  $faculty_dept = $_SESSION["faculty_dept"];
  $faculty_id = $_SESSION["faculty_id"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Faculty | Dashboard</title>
  <link rel="shortcut icon" href="faculty-asset/graduation-cap-fill.png" type="image/x-icon">
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
      box-shadow: 1px 1px 8px #888888;
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
      height: 95%;
      width: 90%;
      left: 6rem;
      top: 2rem;
      z-index: 0;
    }

    .main #heading {
      color: rgb(43, 57, 207);
      font-size: 2rem;
      letter-spacing: .15rem;
    }

    #faculty-index-img{
      position: absolute;
      height: 80%;
      width: 50%;
      top: 50%;
      left: 45%;
      transform: translate(-50%,-50%);
      scale: .85;
    }
    .boxes{
      width: fit-content;
      float: right;
      padding: 1rem 4rem 0 0;

    }
    .boxes .box{
      background: #FF745C;
      height: 20%;
      padding: 1rem 2rem 2rem 2rem;
      margin-bottom: 2rem;
      border-radius: 10px;
      box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
    }
    .box h3{
      margin-bottom: 10px;
      letter-spacing: .5px;
      color: whitesmoke;
      font-weight: 500;
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
                <?php echo $_SESSION["faculty_name"] ?>
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
    $sql = "SELECT * FROM `assignment` WHERE `provider_id` = '{$faculty_id}' ORDER BY `slno` DESC";
    $result = mysqli_query($conn, $sql) or die("Query Failed!");
    $num_of_ungraded_sub = 0;
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $sql = "SELECT * FROM `student` WHERE `dept` = '{$faculty_dept}'";
        $res = mysqli_query($conn, $sql) or die("Query Failed!");
        $num_of_std = mysqli_num_rows($res);

        $sql = "SELECT * FROM `assignment_submission` WHERE `ass_slno` = '{$row['slno']}'";
        $res = mysqli_query($conn, $sql) or die("Query Failed!");

        while ($r = mysqli_fetch_assoc($res)) {
          $r['status'] == 0 ? $num_of_ungraded_sub += 1 : $num_of_ungraded_sub;
        }

      }
      
    }
    mysqli_close($conn);
    ?>
    <div class="main">
      <span id="heading">Welcome to faculty dashboard,
        <?php echo $_SESSION["faculty_name"] ?>
      </span>
      <img src="faculty-asset/6334178.webp" alt="" id="faculty-index-img">
      <div class="boxes">
      <?php if($num_of_ungraded_sub > 0){?>
        <div class="box">
          <h3>Assignments</h3>
          <span style="color: yellow"><?php echo $num_of_ungraded_sub; ?> <?php $num_of_ungraded_sub>1?print'assignments':print'assignment' ?> require grading</span>
        </div>
      <?php } ?>
    </div>

  </div>


</body>

</html>