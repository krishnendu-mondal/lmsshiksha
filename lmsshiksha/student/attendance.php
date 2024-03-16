<?php
session_start();
if (!isset($_SESSION["student"])) {
    header("Location: ../");
}else{
    $student_name = $_SESSION['student_name'];
    $student_dept = $_SESSION['student_dept'];
    $student_roll = $_SESSION['student_roll'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Student | Attendance</title>
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
        html{
            scroll-behavior: smooth;
        }
        body {
            height: 100vh;
            width: 100%;
        }

        nav {
            position: fixed;
            width: 100%;
            top: 0;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            display: flex;
            padding: 15px 20px;
            justify-content: space-between;
            background: #fff;
            z-index: 10;
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
            width: 100%;
            height: fit-content;
            display: flex;
        }

        .sidebar {
            position: fixed;
            overflow: hidden;
            background-color: white;
            height: 90%;
            width: 65px;
            background: #fff;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            transition: width ease-out 0.3s;
            z-index: 10;
            margin-top: 9.5vh;
        }

        .sidebar:hover {
            width: 250px;
        }

        .sidebar-links {
            margin-top: 30px;
        }

        .sidebar-links .logout {
            position: absolute;
            bottom: 4vh;
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
        .sidebar-links p:hover span {
            color: lightseagreen;
        }

        #active {
            background-color: #ddd;
            color: lightseagreen;
        }

        .main {
            position: absolute;
            height: fit-content;
            width: 100%;
            z-index: 0;
            padding-left: 4.5vw;
            scale: 0.935;
        }

        .main h1{
            text-align: center;
            border-bottom: 2px solid #777;
            color: #444;
            padding-bottom: 5px;
            margin-bottom: 20px;
            margin-top: -1rem;
        }

        .flex {
            display: flex;
            margin-bottom: 20px;
        }

        .grid {
            display: grid;
        }

        table,
        th,
        td {
            border: 1px solid #dadada;
            border-collapse: collapse;
        }
        th{
            background-color: lightseagreen;
            padding: 10px 0;
        }
        table {
            margin-bottom: 1.5rem;
            box-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        td {
            text-align: center;
            height: 3rem;
            width: 2.8rem;
        }

        td h3 {
            background: lightseagreen;
            height: 100%;
            width: 100%;
            padding: 5px 20px;
            color: #333;
        }
        .back-to-top{
            position: fixed;
            bottom: 1.5rem;
            right: .5rem;
            z-index: 20;
            cursor: pointer;
            display: none;
        }
        .back-to-top:hover i{
            background: #eee;
        }
        .back-to-top:hover::before{
            content: 'Back to top';
            position: absolute;
            display: grid;
            color: #fff;
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 6px;
            margin-top: -3rem;
            margin-left: -3.4rem;
            min-width: 4rem;
            background: #000;
        }
        .back-to-top i{
            padding: 10px;
            border-radius: 50%;
            background: #ddd;
            font-size: 18px;
            color: #222;
            box-shadow: 1px 1px 5px rgba(0,0,0,0.3);
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
                        <p id="active"><i class="ri ri-pie-chart-2-line"></i><span>Attendance</span></p>
                    </li>
                    <li>
                        <p onclick="window.location.href='exam.php'"><i
                                class="fa fa-solid fa-chalkboard-user"></i></i><span>Exams</span>
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
            <h1>Your attendance of year
                <?php echo date("Y") ?>
            </h1>
            <?php for ($k = 1; $k <= 12; $k++) {
                $firstDateOfMonth = date("1-$k-Y");
                $totalDaysInMonth = date("t", strtotime($firstDateOfMonth)); ?>
                <table>
                    <th colspan="<?php echo $totalDaysInMonth+1 ?>"><h2><?php echo date("F", strtotime($firstDateOfMonth)) ?></h2></th>
                    <?php for ($i = 1; $i <= 4; $i++) { ?>
                        <?php if ($i == 1) { ?>
                            <tr>
                                <td>
                                    <h3>Date</h3>
                                </td>
                                <?php for ($j = 1; $j <= $totalDaysInMonth; $j++) { ?>
                                    <td style="background: lightseagreen">
                                        <?php echo $j ?>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        <?php if ($i == 2) { ?>
                            <tr>
                                <td>
                                    <h3>Day</h3>
                                </td>
                                <?php for ($j = 0; $j < $totalDaysInMonth; $j++) { ?>
                                    <td style="background: #222; color: #fff;">
                                        <?php echo date("D", strtotime("+$j days", strtotime($firstDateOfMonth))); ?>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        <?php if ($i == 3) { ?>
                            <tr>
                                <td>
                                    <h3>Attendance</h3>
                                </td>
                                <?php for ($j = 1; $j <= $totalDaysInMonth; $j++) {
                                    require_once("DB.php");
                                    $atd_date = date("d-m-Y",strtotime(date("$j-M-Y",strtotime($firstDateOfMonth))));
                                    $sql = "SELECT * FROM `attendance` WHERE `roll`='{$student_roll}' AND `atd_date`='{$atd_date}'";
                                    $result = mysqli_query($conn, $sql) or die("Query Failed!");
                                    if(mysqli_num_rows($result)>0){
                                        $row = mysqli_fetch_assoc($result);
                                    }else{
                                        $row['atd_status'] = ' ';
                                    }
                                    if (date("D", strtotime(date("$j-M-Y", strtotime($firstDateOfMonth)))) == "Sat"){
                                    ?>
                                    <td style="background: #222; color: #fff;">
                                        <span>Sat</span>
                                    </td>
                                    <?php }else if(date("D", strtotime(date("$j-M-Y", strtotime($firstDateOfMonth)))) == "Sun") { ?>
                                    <td style="background: #222; color: #fff;">
                                        <span>Sun</span>
                                    </td>
                                    <?php } else { ?>
                                        <td> 
                                            <span style=" color: white; font-weight:600; padding: .5rem .65rem; background: <?php $row['atd_status']=='H'?print'orange':($row['atd_status']=='P'?print'#22dd54':($row['atd_status']=='A'?print'red':print'')); ?>">
                                                <?php echo $row['atd_status'] ?>
                                            </span>
                                        </td>
                                    <?php }
                                } ?>
                            </tr>
                        <?php } ?>

                    <?php } ?>
                </table>
            <?php } ?>
            
        </div>
        <div class="back-to-top" onclick="backToTop()">
            <i class="ri-arrow-up-line"></i>
        </div>
        
    </div>
    <script>
        document.addEventListener('scroll', () => {
            let currentScroll = window.scrollY;
            let nav = document.querySelector('nav');
            if (currentScroll < 10) {
                nav.style.borderBottom = 'none';
            } else {
                nav.style.borderBottom = '1px solid #dadada';
            }
        })

        let mybutton = document.querySelector(".back-to-top");
        window.onscroll = function() {scrollFunction()};
        function scrollFunction() {
            if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }

        function backToTop() {
            document.documentElement.scrollTop = 0;
        }
    </script>

</body>

</html>