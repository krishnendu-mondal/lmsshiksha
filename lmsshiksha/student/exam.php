<?php
session_start();
if (!isset($_SESSION["student"])) {
    header("Location: ../");
} else {
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
    <title>Student | Exams</title>
    <link rel="shortcut icon" href="student-asset/graduation-cap-fill.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/62b94e81b1.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,300&display=swap');

        * {
            margin: 0;
            padding: 0;
            outline: none;
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
            left: 4rem;
            top: 2rem;
            z-index: 0;
        }
        .main h2{
            text-align: center;
        }
        .main .table{
            height: 100%;
            width:100%;
            display: flex;
            justify-content: center;
            align-items: baseline;
        }
        .main table{
            border-collapse: collapse;
        }

        table th,td{
            padding: 10px 20px;
            text-align: center;
        }

        #img{
            position: absolute;
            top: 0;
            left: 0;
            transform: translate(50%,15%);
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
                        <p onclick="window.location.href='./'"><i class="ri ri-user-2-fill"></i><span>
                                <?php echo $_SESSION["student_name"] ?>
                            </span></p>
                    </li>
                    <li>
                        <p onclick="window.location.href='assignment.php'"><i
                                class="ri ri-pencil-ruler-2-line"></i><span>Assignments</span></p>
                    </li>
                    <li>
                        <p onclick="window.location.href='attendance.php'"><i
                                class="ri ri-pie-chart-2-line"></i><span>Attendance</span></p>
                    </li>
                    <li>
                        <p id="active"><i class="fa fa-solid fa-chalkboard-user"></i></i><span>Exams</span>
                        </p>
                    </li>
                    <li>
                        <p onclick="window.location.href='settings.php'"><i
                                class="ri ri-settings-4-line"></i><span>Settings</span>
                        </p>
                    </li>
                </ul>
                <div class="logout">
                    <p onclick="window.location.href='logout.php'"><i
                            class="ri ri-logout-box-r-line"></i><span>Logout</span></p>
                </div>
            </div>
        </div>
        
        <div class="main">
            <?php
                require_once("DB.php");
                $sql = "SELECT * FROM `exam` WHERE `dept` = '{$student_dept}' ORDER BY `exam_date` ASC, `exam_start_time`";
                $result = mysqli_query($conn, $sql) or die("Query Failed!");

                if(mysqli_num_rows($result)>0){
                    $locked = 0;
                    while($r = mysqli_fetch_assoc($result)){
                        $locked = $r['lock_status'];
                    }
                    if($locked){
                        $sql = "SELECT * FROM `exam` WHERE `dept` = '{$student_dept}' ORDER BY `exam_date` ASC, `exam_start_time`";
                        $result = mysqli_query($conn, $sql) or die("Query Failed!");
            ?>
            <div class="table">
                <table border="1">
                    <th style="background: lightseagreen; color: #333;" colspan="5"><h2>Exam schedule</h2></th>
                    <tr  style="background: #222; color: #ddd; letter-spacing: 0.5px;">
                        <th>Sl.No.</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Starting time</th>
                        <th>Ending time</th>
                    </tr>
                    <?php $n = 0; while($row = mysqli_fetch_assoc($result)){ $n++; ?>
                        <tr style="background: <?php $n%2==0?print'#dadada':print' ' ?> ;">
                            <td><?php echo $n ?></td>
                            <td><?php echo $row['subject'] ?></td>
                            <td><?php echo date("d-m-Y",strtotime($row['exam_date'])) ?></td>
                            <td><?php echo date("g:i a",strtotime($row['exam_start_time'])) ?></td>
                            <td><?php echo date("g:i a",strtotime($row['exam_end_time'])) ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <?php }else{?>
                <h2 style="color: royalblue; font-weight: 500; text-align: center;"><i class="ri-sticky-note-line"></i> No schedule is present to show.</h2>
                <img src="student-asset/sleep.webp" height="470" width="750" id="img">
            <?php }}else{?>
                <h2 style="color: royalblue; font-weight: 500; text-align: center;"><i class="ri-sticky-note-line"></i> No schedule is present to show.</h2>
                <img src="student-asset/sleep.webp" height="470" width="750" id="img">
            <?php } ?>
        </div>
    </div>


</body>

</html>