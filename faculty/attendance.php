<?php
session_start();
if (!isset($_SESSION["faculty"])) {
    header("Location: ../");
} else {
    $faculty_name = $_SESSION["faculty_name"];
    $faculty_dept = $_SESSION["faculty_dept"];
    $faculty_id = $_SESSION["faculty_id"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Faculty | Attendance</title>
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
            height: 100vh;
            display: flex;
            overflow: hidden;
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
            z-index: 8;
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

        .toast {
            position: absolute;
            height: 2.5rem;
            top: 9vh;
            right: -10vw;
            border-radius: 8px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            border-left: 7px solid lightgreen;
            border-bottom: 3px solid lightgreen;
            border-top: 2px solid lightgreen;
            border-right: 2px solid lightgreen;
            display: flex;
            align-items: center;
            scale: 1;
            padding: 5px 25px 5px 5px;
            transition: right ease-in-out 0.5s;
        }

        .toast .checkbox {
            font-size: 25px;
            color: lightgreen;
        }

        .toast span {
            margin-left: 10px;
            font-size: 18px;
            font-weight: 600;
            color: rgb(87, 235, 87);
        }

        .attendance {
            position: absolute;
            width: 80%;
            top: 10vh;
            left: 6rem;
            display: flex;
            justify-content: space-around;
        }

        .take-attendance table {
            border-collapse: collapse;
            border: 1px solid #dadada;
        }

        th,
        td {
            padding: 5px 10px;
        }

        .take-attendance,
        .view-attendance {
            padding: 2rem 3rem 4rem 3rem;
            margin-bottom: 2rem;
            border-radius: 10px;
            /* box-shadow: 1px 1px 5px #aaa; */
        }

        .take-attendance form {
            display: flex;
            justify-content: space-between;
            gap: 2rem;
        }

        .heading {
            margin-bottom: 1rem;
        }

        .heading h2 {
            width: fit-content;
            padding: 5px 15px;
            border-radius: 5px;
            background-color: lightseagreen;
        }

        .heading hr {
            height: 3px;
            width: 100%;
            margin-top: -3.7px;
            margin-left: 2px;
            border-radius: 5px;
            border: none;
            background-color: lightseagreen;
        }

        .take-attendance table input {
            cursor: pointer;
            scale: 1.2;
        }

        input[id='present'] {
            accent-color: lightgreen;
        }

        input[id='absent'] {
            accent-color: red;
        }

        input[id='holiday'] {
            accent-color: orange;
            cursor: pointer;
        }

        .view-attendance {
            height: fit-content;
        }

        .buttons button,
        .view-attendance button {
            padding: .4rem .6rem;
            border-radius: 5px;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
            font-size: .9em;
            background: royalblue;
            cursor: pointer;
            color: #fff;
        }

        .view-attendance button {
            float: right;
        }

        .buttons button[id="btn-save"] {
            background: #56d543;
        }

        input[type="date"],
        input[type="month"] {
            border-radius: 5px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            padding: .25rem .5rem;
        }

        input[type="date"] {
            margin: 10px 15px;
        }

        input[type="month"] {
            margin: 5px 0 20px 0;
            padding: 10px 20px;
            text-align: center;
        }

        #view-atd th,
        #view-atd td {
            border: 1px solid #dadada;
        }

        .popup-table table {
            border-collapse: separate;
            border: 1px solid #dadada;
            margin-top: 3rem;
        }

        .popup-table {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 92vh;
            padding: 0 1rem;
            z-index: 25;
            background: rgba(255, 255, 255);
            overflow: auto;
        }

        #take-atd-table th,
        #take-atd-table td {
            padding: 10px 15px;
            text-align: center;
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
                                <?php echo $_SESSION["faculty_name"] ?>
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
                                class="fa fa-solid fa-chalkboard-user"></i><span>Exams</span>
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
        <div class="toast">
            <i class="ri-checkbox-circle-fill checkbox"></i>
            <span>Success!</span>
        </div>
    </div>

    <div class="attendance">
        <div class="take-attendance">
            <div class="heading">
                <h2>Take Attendance</h2>
                <hr>
            </div>

            <form action="" method="post">
                <table id="take-atd-table">
                    <tr>
                        <td colspan="3">
                            <div class="row">
                                <label for="">Select date(Optional)</label>
                                &nbsp;&nbsp;
                                <input type="date" name="selected_date">
                            </div>

                        </td>
                    </tr>

                    <tr style="background: #222; color: #fff; letter-spacing: .8px;">
                        <th>Sl. No.</th>
                        <th>Student name</th>
                        <th>Attendance</th>
                    </tr>
                    <?php
                    require_once("DB.php");
                    $sql = "SELECT * FROM `student` ORDER BY `name` ASC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        $n = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $n++;
                            ?>
                            <tr style="border-bottom: none; background: <?php $n % 2 == 0 ? print '#dadada' : print(""); ?>;">
                                <td>
                                    <?php echo $n; ?>
                                </td>
                                <td>
                                    <?php echo $row['name'] ?>
                                </td>
                                <td style="display: flex; justify-content: space-evenly; border: inherit;">
                                    <div class="row">
                                        <input type="checkbox" id="present" class="present-<?php echo $row['roll'] ?>"
                                            onclick="resetOtherOne('absent-<?php echo $row['roll'] ?>')"
                                            name="student_present[]" value="<?php echo $row['roll'] ?>" autocomplete="off">
                                        <label for="present">P</label>
                                    </div>

                                    <div class="row">
                                        <input type="checkbox" id="absent" class="absent-<?php echo $row['roll'] ?>"
                                            onclick="resetOtherOne('present-<?php echo $row['roll'] ?>')"
                                            name="student_absent[]" value="<?php echo $row['roll'] ?>" autocomplete="off">
                                        <label for="absent">A</label>
                                    </div>
                                </td>

                                <td style="display:none;">
                                    <input type="checkbox" id="holiday" name="holiday[]" value="<?php echo $row['roll'] ?>">
                                </td>
                            </tr>
                        <?php }
                    } ?>
                </table>
                <div class="buttons" style="display: flex; flex-direction: column; gap: 1rem;">
                    <div class="row"
                        style="display: flex; align-items: center; gap: 5px; background: rgba(0,0,0,0.1); padding: .25rem .4rem; border-radius: 5px; box-shadow: 1px 1px 3px rgba(0,0,0,0.2);">
                        <input type="checkbox" onclick="markAsHoliday()" id="holiday">
                        <label for="holiday">Mark as holiday</label>
                    </div>
                    <button type="button" onclick="markAllPresent()" id="btn-all-present">Mark all present</button>
                    <button type="reset" id="btn-clear">Clear all</button>
                    <button type="submit" name="save_attendance" value="save" id="btn-save"><i
                            class="ri-checkbox-circle-line"></i> Save</button>
                </div>
            </form>

        </div>

        <div class="view-attendance">
            <div class="heading">
                <h2>Get Attendance record</h2>
            </div>
            <form action="attendance.php" method="post">
                <div class="row" style="display: flex; flex-direction: column; ">
                    <label for="fetch_atd_month">Select month</label>
                    <input type="month" name="fetch_atd_month_and_year" id="fetch_atd_month" required>
                </div>
                <button type="submit" name="fetch_atd" value="fetch">View record</button>
            </form>
            <?php
            if (isset($_POST['fetch_atd'])) {
                $fetch_atd_month = date("M-Y", strtotime($_POST['fetch_atd_month_and_year']));
                $total_days_in_month = date("t", strtotime($fetch_atd_month));
                $sql = "SELECT * FROM `student` ORDER BY `name` ASC";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    ?>
                    <div class="popup-table">
                        <button type="button" style="position: fixed; left: 1rem; margin-top: 0.5rem;"
                            onclick="exportToExcel('<?php echo $fetch_atd_month ?>','<?php echo $faculty_dept ?>')"><i
                                class="ri-download-2-line"></i> Export as Xlsheet</button>
                        <button type="button" style="position: fixed; right: 1rem; margin-top: 0.5rem;"
                            onclick="document.querySelector('.popup-table').style.display='none'"><i
                                class="ri-arrow-go-back-line"></i> Back</button>
                        <?php echo "<h3 style='text-align: center; margin-top:1rem; position: fixed; left: 45%;'>Fetching record of month: " . $fetch_atd_month . "</h3>"; ?>
                        <table id="view-atd">
                            <tr style="background: lightseagreen;">
                                <?php for ($day = 0; $day <= $total_days_in_month; $day++) {
                                    if ($day > 0) { ?>
                                        <th align="center" style="min-width: 8rem;">
                                            <?php echo date("$day-M-y", strtotime($fetch_atd_month)) ?>
                                        </th>
                                    <?php } else { ?>
                                        <th rowspan="2"
                                            style="min-width: 15rem; position: sticky; left:-1rem; background: lightseagreen; border: 2px solid #dadada">
                                            Student name</th>
                                    <?php }
                                } ?>
                            </tr>
                            <tr style="background: #000; color:#fff;">
                                <?php for ($day = 1; $day <= $total_days_in_month; $day++) { ?>
                                    <th align="center" style="min-width: 8rem;">
                                        <?php echo date("D", strtotime(date("$day-M-Y", strtotime($fetch_atd_month)))) ?>
                                    </th>
                                <?php } ?>
                            </tr>
                            <?php $n = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $n++ ?>
                                <tr <?php $n % 2 == 0 ? print 'style="background: #E5E5E5;"' : print 'style="background: #fff;"' ?>>
                                    <td
                                        style="min-width: 15rem; position: sticky; left:-1rem; border: 2px solid #dadada; <?php $n % 2 == 0 ? print "background: #E5E5E5;" : print "background: #fff;" ?> ">
                                        <?php echo $row['name'] ?>
                                    </td>

                                    <?php for ($day = 1; $day <= $total_days_in_month; $day++) {
                                        $day_date = date("d-m-Y", strtotime(date("$day-m-Y", strtotime($fetch_atd_month))));
                                        $sql = "SELECT * FROM `attendance` WHERE `roll` = '{$row['roll']}' AND `atd_date` = '{$day_date}'";
                                        $res = mysqli_query($conn, $sql) or die("Query Failed!");
                                        if (mysqli_num_rows($res) > 0) {
                                            $rw = mysqli_fetch_assoc($res);
                                        } else {
                                            $rw['atd_status'] = ' ';
                                        }
                                        ?>
                                        <?php if (!(date("D", strtotime($day_date)) == "Sat") and !(date("D", strtotime($day_date)) == "Sun")) { ?>
                                            <td align="center"
                                                style="font-weight:600; font-size: 20px; color: <?php $rw['atd_status'] == 'H' ? print 'orange' : ($rw['atd_status'] == 'P' ? print '#22dd54' : ($rw['atd_status'] == ' ' ? print '' : print 'red')) ?>">
                                                <?php echo $rw['atd_status']; ?>
                                            </td>
                                        <?php } else { ?>
                                            <td align="center">
                                                <?php echo date("D", strtotime($day_date)); ?>
                                            </td>
                                        <?php }
                                    } ?>

                                </tr>
                            <?php } ?>

                        </table>
                    </div>
                <?php } else { ?>
                    <h3 style="color:crimson;"><i class="ri-error-warning-line"></i> No record found!</h3>
                <?php }
            } ?>

        </div>

    </div>

    <script src="table2excel.js"></script>
    <script>
        function markAllPresent() {
            let p = document.querySelectorAll('#present');
            let a = document.querySelectorAll('#absent');
            let h = document.querySelectorAll('#holiday');

            p.forEach((item) => {
                item.checked = true;
            })
            a.forEach((item) => {
                item.checked = false;
            })
            h.forEach((item) => {
                item.checked = false;
            })
        }

        function markAsHoliday() {
            let p = document.querySelectorAll('#present');
            let a = document.querySelectorAll('#absent');
            let h = document.querySelectorAll('#holiday');

            p.forEach((item) => {
                item.checked = false;
            })
            a.forEach((item) => {
                item.checked = false;
            })
            h.forEach((item) => {
                item.checked = true;
            })

        }

        function resetOtherOne(class_name) {
            let cl = document.querySelector(`.${class_name}`);
            let h = document.querySelectorAll('#holiday');

            if (cl.checked) {
                cl.checked = false;
            }

            h.forEach((item) => {
                item.checked = false;
            })

        }

        function showSuccessToast() {
            let t = document.querySelector('.toast');
            t.style.right = "1.5vw";
            setTimeout(() => {
                t.style.right = "-10vw";
            }, 1500)
        }

        function exportToExcel(date, dept) {
            let exp_file_name = dept + " " + date + " attendance record";
            let table2excel = new Table2Excel();
            table2excel.export(document.querySelector('#view-atd'), exp_file_name);
        }

    </script>

    <?php
    if (isset($_POST['save_attendance'])) {
        $total_atd = 0;
        if (!empty($_POST['holiday'])) {
            $total_atd += count($_POST['holiday']);
        }
        if (!empty($_POST['student_present'])) {
            $total_atd += count($_POST['student_present']);
        }
        if (!empty($_POST['student_absent'])) {
            $total_atd += count($_POST['student_absent']);
        }

        $sql = "SELECT slno FROM `student` WHERE `dept` = '{$faculty_dept}'";
        $result = mysqli_query($conn, $sql) or die("Query Failed!");
        $total_student_count = mysqli_num_rows($result);
        if (mysqli_num_rows($result) > 0) {
            if ($total_atd != $total_student_count) {
                echo "<script>alert('Looks like some attendance are missed!')</script>";
                die();
            } else {

                date_default_timezone_set("Asia/Kolkata");

                !empty($_POST['selected_date']) ? $atd_date = date("d-m-Y", strtotime($_POST['selected_date'])) : $atd_date = date("d-m-Y");

                $sql = "SELECT * FROM `attendance` WHERE `atd_date` = '{$atd_date}'";
                $result = mysqli_query($conn, $sql) or die("Query Failed!");
                if (mysqli_num_rows($result) == 0) {
                    if ((date("D", strtotime($atd_date)) != 'Sat' and date("D", strtotime($atd_date)) != 'Sun')) {
                        if (isset($_POST['student_present'])) {
                            foreach ($_POST['student_present'] as $p) {
                                $sql = "INSERT INTO `attendance`(`roll`, `atd_date`, `atd_status`) VALUES ('{$p}','{$atd_date}','P')";
                                mysqli_query($conn, $sql) or die("Query Failed!");
                            }
                        }

                        if (isset($_POST['student_absent'])) {
                            foreach ($_POST['student_absent'] as $a) {
                                $sql = "INSERT INTO `attendance`(`roll`, `atd_date`, `atd_status`) VALUES ('{$a}','{$atd_date}','A')";
                                mysqli_query($conn, $sql) or die("Query Failed!");
                            }
                        }
                        if (isset($_POST['holiday'])) {
                            foreach ($_POST['holiday'] as $h) {
                                $sql = "INSERT INTO `attendance`(`roll`, `atd_date`, `atd_status`) VALUES ('{$h}','{$atd_date}','H')";
                                mysqli_query($conn, $sql) or die("Query Failed!");
                            }
                        }

                        echo "<script>showSuccessToast()</script>";
                    } else {
                        echo "<script>alert('It is weekend!')</script>";
                    }
                } else {
                    echo "<script>alert('Attendance already taken!')</script>";
                }
            }
        }
    }
    ?>

</body>

</html>