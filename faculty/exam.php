<?php
session_start();
if (!isset($_SESSION["faculty"])) {
    header("Location: ../");
} else {
    $faculty_name = $_SESSION["faculty_name"];
    $faculty_dept = $_SESSION["faculty_dept"];
    $faculty_id = $_SESSION["faculty_id"];
    date_default_timezone_set("Asia/Kolkata");
    $time_now = date('d-m-Y g:i a');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Faculty | Exams</title>
    <link rel="shortcut icon" href="faculty-asset/graduation-cap-fill.png" type="image/x-icon">
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
            height: 90%;
            width: 100%;
            right: 0;
            top: 2rem;
            z-index: 0;
            overflow: hidden;
        }
        .main h2{
            text-align: center;
        }
        .main .table{
            display: flex;
            justify-content: center;
            align-items: baseline;
            gap: 5%;
        }
        .main table{
            border-collapse: collapse;
        }

        table th,td{
            padding: 10px 20px;
            text-align: center;
        }
        td button{
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            padding: .5rem .75rem;
            background: rgba(65, 105, 225, 0.836);
            font-size: 1rem;
            color: #fff;
            font-weight: 500;
            border: none;
            cursor: pointer;
        }
        td button:hover{
            background: royalblue;
        }

        #add-schedule{
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            padding: .65rem .75rem;
            background: rgb(40, 192, 184);
            font-size: 1rem;
            color: #fff;
            font-weight: 500;
            border: none;
            cursor: pointer;
        }
        #add-schedule:hover{
            background: lightseagreen;
        }
        .popup, #edit-popup{
            position: absolute;
            bottom: -4px;
            right: 0;
            width: 100%;
            height: 91vh;
            z-index: 20;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            display: none;
        }
        .popup form, #edit-popup form{
            padding: 2rem 2.3rem;
            border-radius: 10px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            width: 24%;
            height: fit-content;
            display: grid;
            background: #fff;
            align-items: center;
            position: relative;
        }
        .row{
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .popup form h2, #edit-popup form h2{
            margin-top: .5rem;
            margin-bottom: 1.5rem;
        }
    
        .popup form input, #edit-popup form input {
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            padding: .8rem 1rem;
            width: 100%;
            border: none;
            margin-bottom: 1rem;
        }

        .popup form button, #edit-popup form button{
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            padding: .75rem;
            margin: 1rem 0 1rem 0;
            background: rgba(65, 105, 225, 0.836);
            font-size: 1rem;
            color: #fff;
            font-weight: 500;
            border: none;
            cursor: pointer;
        }
        .popup form button:hover, #edit-popup form button:hover{
            background: royalblue;
        }
        .popup form .close, #edit-popup form .close{
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 1.5rem;
            color: #555;
            cursor: pointer;
        }
        .popup form .close:hover, #edit-popup form .close:hover{
            color: #222;
        }
        .popup form .close:hover::after, #edit-popup form .close:hover::after{
            content: "Close";
            position: absolute;
            margin-left: -5rem;
            margin-top: 4px;
            font-size: 16px;
        }
        td .btn-edit, td .btn-delete{
            color: lightseagreen;
            cursor: pointer;
        }
        .btn-edit:hover{
            color: orange;
        }
        .btn-edit:hover::after{
            content: 'Edit Schedule';
            position: absolute;
            font-family: 'Nunito Sans', sans-serif;
            display: grid;
            color: #fff;
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 6px;
            margin-top: .5rem;
            background: rgba(0, 0, 0, 0.8);
        }
        .btn-delete:hover {
            color: red;
        }
        .btn-delete:hover::after{
            content: 'Delete Schedule';
            position: absolute;
            font-family: 'Nunito Sans', sans-serif;
            display: grid;
            color: #fff;
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 6px;
            margin-top: .5rem;
            background: rgba(0, 0, 0, 0.8);
        }
        .toast {
            position: absolute;
            height: 2.5rem;
            top: 0;
            right: -30vw;
            border-radius: 8px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            border-left: 7px solid lightgreen;
            border-bottom: 3px solid lightgreen;
            border-top: 2px solid lightgreen;
            border-right: 2px solid lightgreen;
            display: flex;
            align-items: center;
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
        .locked:hover::after{
            content: 'Exam schedule is locked';
            position: absolute;
            display: grid;
            margin-top: 1.5rem;
            color: #eee;
            background: #333;
            padding: 5px 10px;
            font-size: 15px;
            border-radius: 8px;
        }
        #img{
            position: absolute;
            top: 0;
            left: 0;
            transform: translate(115%,25%);
        }
        #add-schedule{
            position: absolute;
            top: 3rem;
            right: 3rem;
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
                        <p onclick="window.location.href='attendance.php'"><i
                                class="ri ri-pie-chart-2-line"></i><span>Attendance</span></p>
                    </li>
                    <li>
                        <p id="active"><i
                                class="fa fa-solid fa-chalkboard-user"></i></i><span>Exams</span>
                        </p>
                    </li>
                    <li>
                        <p onclick="window.location.href='settings.php'">
                            <i class="ri ri-settings-4-line"></i><span>Settings</span>
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
                $sql = "SELECT * FROM `exam` WHERE `dept` = '{$faculty_dept}' ORDER BY `exam_date` ASC, `exam_start_time`";
                $result = mysqli_query($conn, $sql) or die("Query Failed!");
                $res = mysqli_query($conn, $sql) or die("Query Failed!");
                $locked = 0;
                if(mysqli_num_rows($result)>0){
                    $r = mysqli_fetch_assoc($res);
            ?>
            <?php if($r['lock_status'] == 0){?>
                <h4 style="text-align: center; margin: 10px 0; color: orangered;">After verification of admin, schedule will be visible to students.</h4>
            <?php }else{ ?>
                <h4 style="text-align: center; margin: 10px 0; color: #22dd54;">Schedule is verified & locked by admin.</h4>
            <?php } ?>
            <div class="table">
            
            <table border="1">
                <th style="background: lightseagreen; color: #333;" colspan="6"><h2>Exam schedule</h2></th>
                <tr  style="background: #222; color: #ddd; letter-spacing: 0.5px;">
                    <th>Sl.No.</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Starting time</th>
                    <th>Ending time</th>
                    <th>Action</th>
                </tr>
                <?php $n = 0; while($row = mysqli_fetch_assoc($result)){ $n++; ?>
                    <tr style="background: <?php $n%2==0?print'#dadada':print'' ?> ;">
                        <td><?php echo $n ?></td>
                        <td><?php echo $row['subject'] ?></td>
                        <td><?php echo date("d-m-Y",strtotime($row['exam_date'])) ?></td>
                        <td><?php echo date("g:i a",strtotime($row['exam_start_time'])) ?></td>
                        <td><?php echo date("g:i a",strtotime($row['exam_end_time'])) ?></td>
                        <?php $locked = $row['lock_status']; if(!$row['lock_status']){ ?>
                            <td style="font-size: 18px;"><i class="btn-edit ri-edit-2-line" onclick="editSchedule('<?php echo $row['slno'] ?>','<?php echo $row['subject'] ?>','<?php echo date('Y-m-d',strtotime($row['exam_date'])) ?>','<?php echo date('H:i',strtotime($row['exam_start_time'])) ?>','<?php echo date('H:i',strtotime($row['exam_end_time'])) ?>')"></i><i class="btn-delete ri-delete-bin-5-line" onclick="deleteSchedule('<?php echo $row['slno'] ?>')" style="margin-left:1rem;"></i></td>
                        <?php }else{ ?>
                            <td style="font-size: 18px; cursor: not-allowed;"><i class="ri-lock-2-line" ></i></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </table>
            </div>
            <?php }else{?>
                <h2 style="color: #3797E8; font-weight: 500; text-align: center;"><i class="ri-sticky-note-line"></i> No schedule is present to show. You can add schedule from here.</h2>
                <img src="faculty-asset/nodata.webp" height="420" width="440" id="img">
            <?php } ?>
            <button type="button" id="add-schedule" onclick="showPopup()" class="<?php $locked ? print'locked':print''?>" <?php $locked ? print' disabled ':print''?> style="cursor: <?php $locked ? print' not-allowed':print' pointer'?>;"><i class="ri-add-circle-line"></i> Add exam schedule</button>
            <div class="toast">
                <i class="ri-checkbox-circle-fill checkbox"></i>
                <span>Success!</span>
            </div>
        </div>
        <div class="popup">
                <form action="exam.php" method="post">
                    <h2 id="h2">Add exam schedule</h2>
                    <div class="row">
                        <label for="exam-subject">Subject</label>
                        <input type="text" name="exam_subject" id="exam-subject" required autocomplete="off">
                    </div>
                    <div class="row">
                        <label for="exam-date">Date</label>
                        <input type="date" name="exam_date" id="exam-date" required>
                    </div>
                    <div class="row">
                        <label for="exam-start-time">Start time</label>
                        <input type="time" name="exam_start_time" id="exam-start-time" required>
                    </div>
                    <div class="row">
                        <label for="exam-end-time">End time</label>
                        <input type="time" name="exam_end_time" id="exam-end-time" required>
                    </div>
                    <button type="submit" name="add_exam_schedule" value="add">Submit</button>
                    <i class="close ri-close-circle-line" onclick="hidePopup()"></i>
                </form>
        </div>
        <div id="edit-popup">
                <form action="exam.php" method="post">
                    <h2>Edit exam schedule</h2>
                    <input type="hidden" name="edit_slno" id="edit-slno">
                    <div class="row">
                        <label for="edit-subject">Subject</label>
                        <input type="text" name="edit_subject" id="edit-subject" required autocomplete="off">
                    </div>
                    <div class="row">
                        <label for="edit-date">Date</label>
                        <input type="date" name="edit_date" id="edit-date" required>
                    </div>
                    <div class="row">
                        <label for="edit-start-time">Start time</label>
                        <input type="time" name="edit_start_time" id="edit-start-time" required>
                    </div>
                    <div class="row">
                        <label for="edit-end-time">End time</label>
                        <input type="time" name="edit_end_time" id="edit-end-time" required>
                    </div>
                    <button type="submit" name="save_changed_exam_schedule" value="save" id="edit-save"><i class="ri-checkbox-circle-line"></i> Save changes</button>
                    <i class="close ri-close-circle-line" onclick="hideEditSchedule()"></i>
                </form>
        </div>
    </div>
    <form action="exam.php" method="post" id="delete-schedule">
        <input type="hidden" name="delete_schedule_slno" id="delete-schedule-slno">
    </form>

    <script>
        var popup = document.querySelector('.popup');
        function showPopup(){
           popup.style.display = 'flex';
        }
        function hidePopup(){
           popup.style.display = 'none';
        }

        var editPopup = document.getElementById('edit-popup');
        function editSchedule(slno, subject, date, startTime, endTime){
            editPopup.style.display = 'flex';
            document.getElementById('edit-slno').value = slno;
            document.getElementById('edit-subject').value = subject;
            document.getElementById('edit-date').value = date;
            document.getElementById('edit-start-time').value = startTime;
            document.getElementById('edit-end-time').value = endTime;

        }
        function hideEditSchedule(){
            editPopup.style.display = 'none';
        }

        function deleteSchedule(slno){
            if(confirm("Are you sure?")){
                document.getElementById('delete-schedule-slno').value = slno;
                document.getElementById('delete-schedule').submit();
            }
        }

        function showSuccessToast(){
            let toast = document.querySelector('.toast');
            setTimeout(()=>{
                toast.style.right = '3vw';
            },300)
            setTimeout(()=>{
                toast.style.right = '-30vw';
            },1700)
        }
    </script>

    <?php
        if(isset($_POST['add_exam_schedule'])){
            $subject = $_POST['exam_subject'];
            $exam_date = date("Y-m-d",strtotime($_POST['exam_date']));
            $exam_start_time = $_POST['exam_start_time'];
            $exam_end_time = $_POST['exam_end_time'];

            if($exam_start_time < $exam_end_time){
                $sql = "SELECT * FROM `exam` WHERE `dept` = '{$faculty_dept}' and `exam_date` = '{$exam_date}' and ((((`exam_start_time` BETWEEN '{$exam_start_time}' AND '{$exam_end_time}') or (`exam_end_time` BETWEEN '{$exam_start_time}' AND '{$exam_end_time}')) AND (`exam_start_time` != '{$exam_end_time}' AND `exam_end_time` != '{$exam_start_time}')) or (`exam_start_time` < '{$exam_start_time}' AND `exam_end_time` > '{$exam_end_time}'))";
                $result = mysqli_query($conn, $sql) or die("Query Failed!");
                $row = mysqli_fetch_assoc($result);
                if(mysqli_num_rows($result)==0){
                    $sql = "INSERT INTO `exam`(`dept`, `subject`, `exam_date`, `exam_start_time`, `exam_end_time`, `lock_status`) VALUES ('{$faculty_dept}','{$subject}','{$exam_date}','{$exam_start_time}','{$exam_end_time}','0')";
                    $result = mysqli_query($conn, $sql) or die("Query Failed!");
                    echo"<script>window.location.href='exam.php'</script>";
                }else{
                    echo"<script>alert('Selected slot is not available!')</script>";
                }
            }else{
                echo"<script>alert('Please select valid exam time!')</script>";
            }
        }

        if(isset($_POST['save_changed_exam_schedule'])){
            $slno = $_POST['edit_slno'];
            $subject = $_POST['edit_subject'];
            $exam_date = $_POST['edit_date'];
            $exam_start_time = $_POST['edit_start_time'];
            $exam_end_time = $_POST['edit_end_time'];

            if($exam_start_time < $exam_end_time){
                $sql = "SELECT * FROM `exam` WHERE `dept` = '{$faculty_dept}' and `exam_date` = '{$exam_date}' and ((((`exam_start_time` BETWEEN '{$exam_start_time}' AND '{$exam_end_time}') or (`exam_end_time` BETWEEN '{$exam_start_time}' AND '{$exam_end_time}')) AND (`exam_start_time` != '{$exam_end_time}' AND `exam_end_time` != '{$exam_start_time}')) or (`exam_start_time` < '{$exam_start_time}' AND `exam_end_time` > '{$exam_end_time}'))";
                $result = mysqli_query($conn, $sql) or die("Query Failed!");
                $row = mysqli_fetch_assoc($result);
                mysqli_num_rows($result) > 0 ? $fetchedSlno = $row['slno'] : $fetchedSlno = null;
                if(mysqli_num_rows($result)==0 or $slno == $fetchedSlno){
                    $sql = "UPDATE `exam` SET `subject`='{$subject}',`exam_date`='{$exam_date}',`exam_start_time`='{$exam_start_time}',`exam_end_time`='{$exam_end_time}' WHERE `slno` = '{$slno}'";
                    $result = mysqli_query($conn, $sql) or die("Query Failed!");
                    echo"<script>showSuccessToast(); setTimeout(()=>{window.location.href='exam.php'},2000);</script>";
                }else{
                    echo"<script>alert('Selected slot is not available!')</script>";
                }
            }else{
                echo"<script>alert('Please select valid exam time!')</script>";
            }
        }

        if(isset($_POST['delete_schedule_slno'])){
            $slno = $_POST['delete_schedule_slno'];
            $sql = "DELETE FROM `exam` WHERE `slno` = '{$slno}'";
            mysqli_query($conn, $sql) or die("Query Failed!");
            echo"<script>window.location.href='exam.php'</script>";
        }
    ?>


</body>

</html>