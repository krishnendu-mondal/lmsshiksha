<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: ./");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Exams</title>
    <link rel="shortcut icon" href="admin-asset/graduation-cap-fill.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/62b94e81b1.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,300&display=swap');

        * {
            padding: 0;
            margin: 0;
            text-decoration: none;
            list-style: none;
            font-family: 'Nunito Sans', sans-serif;
            border: none;
        }

        body {
            height: 100vh;
            width: 100%;
        }

        nav {
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
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
            background: #ddd;
            color: lightseagreen;
        }
        .row{
            display: flex;
            flex-direction: column;
        }
        .main{
            position: absolute;
            top: 0;
            right: 0;
            width: 91.5%;
            padding: 1rem 1rem;
            display: flex;
            gap: 4rem;
            overflow: hidden;
        }
        #fetch-dept-schedule h2{
            margin-top: .5rem;
            margin-bottom: 1.5rem;
        }
        #fetch-dept-schedule label{
            margin-bottom: 5px;
        }
        #fetch-dept-schedule input{
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            padding: .8rem 1rem;
            width: 80%;
            border: none;
            margin-bottom: .5rem;
            outline: none;
        }
        #fetch-dept-schedule button{
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            padding: .45rem 1rem;
            margin: 1rem 0 1rem 0;
            background: rgba(65, 105, 225, 0.836);
            font-size: 1rem;
            color: #fff;
            font-weight: 500;
            border: none;
            cursor: pointer;
        }
        #fetch-dept-schedule button:hover{
            background: royalblue;
        }
        .main table{
            margin-top: .5rem;
            border-collapse: collapse;
        }
        table th,td{
            padding: 10px 20px;
            text-align: center;
            border: 1px solid #888;
        }
        td button{
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            padding: .5rem .75rem;
            font-size: 1rem;
            color: #fff;
            font-weight: 500;
            border: none;
            cursor: pointer;
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
        #edit-popup{
            position: absolute;
            top:0;
            right: 0;
            width: 100vw;
            height: 90vh;
            z-index: 20;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            display: none;
        }
        #edit-popup form{
            padding: 2rem 4.5rem 2rem 2.5rem;
            border-radius: 10px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            width: 18%;
            height: fit-content;
            display: grid;
            background: #fff;
            align-items: center;
            position: relative;
        }
    
        #edit-popup form h2{
            margin-top: .5rem;
            margin-bottom: 1.5rem;
        }
    
        #edit-popup form input {
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            padding: .8rem 1rem;
            width: 100%;
            border: none;
            outline: none;
            margin-bottom: 1rem;
        }

        #edit-popup form button{
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            padding: .75rem;
            margin: 1rem -2rem 1rem 0;
            background: rgba(65, 105, 225, 0.836);
            font-size: 1rem;
            color: #fff;
            font-weight: 500;
            border: none;
            cursor: pointer;
        }
        #edit-popup form button:hover{
            background: royalblue;
        }
        #edit-popup form .close{
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 1.5rem;
            color: #555;
            cursor: pointer;
        }
        #edit-popup form .close:hover{
            color: #222;
        }
        #edit-popup form .close:hover::after{
            content: "Close";
            position: absolute;
            margin-left: -5rem;
            margin-top: 4px;
            font-size: 16px;
        }
        
        .locked:hover::after{
            content: 'Exam schedule is locked';
            position: absolute;
            margin: -5px 0 0 1rem;
            color: #eee;
            background: #333;
            padding: 5px 10px;
            font-size: 15px;
            border-radius: 8px;
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
                        <p onclick="window.location.href='dashboard.php'"><i class="ri ri-shield-user-fill"></i><span>
                                <?php echo $_SESSION["admin_user_id"] ?>
                            </span></p>
                    </li>
                    <li>
                        <p onclick="window.location.href='add-user.php'"><i class="ri ri-user-add-fill"></i><span>Add
                                new user</span></p>
                    </li>
                    <li>
                        <p onclick="window.location.href='edit-user.php'"><i
                                class="fa fa-solid fa-user-pen fa-xs"></i><span>Edit
                                user info</span></p>
                    </li>
                    <li>
                        <p id="active"><i
                                class="fa fa-solid fa-chalkboard-user fa-xs"></i><span>Exams
                            </span></p>
                    </li>
                    <li>
                        <p onclick="window.location.href='settings.php'"><i
                                class="ri ri-settings-4-fill"></i><span>Settings</span>
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
            <form action="exam.php" method="post" id="fetch-dept-schedule">
                <h2>Verify and Lock exam schedule</h2>
                <div class="row">
                    <label for="dept">Enter department to get schedule</label>
                    <input type="text" name="dept" id="dept" placeholder="Department" required autocomplete="off">
                </div>
                <button type="submit" name="fetch_exam_schedule" value="fetch" id="fetch-exam-schedule">Submit</button>
                
            </form>
            <?php
                if(isset($_POST['fetch_exam_schedule'])){
                    require_once("DB.php");
                    $dept = mysqli_real_escape_string($conn, $_POST['dept']);
                    $sql = "SELECT * FROM `exam` WHERE `dept` = '{$dept}' ORDER BY `exam_date` ASC,`exam_start_time`";
                    $result = mysqli_query($conn, $sql) or die("Query Failed!");
                    if(mysqli_num_rows($result)>0){
                        
            ?>
            
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
                <?php $n = 0; $locked; while($row = mysqli_fetch_assoc($result)){ $n++; ?>
                    <tr style="background: <?php $n%2==0?print'#dadada':print'' ?> ;">
                        <td><?php echo $n ?></td>
                        <td><?php echo $row['subject'] ?></td>
                        <td><?php echo date("d-m-Y",strtotime($row['exam_date'])) ?></td>
                        <td><?php echo date("g:i a",strtotime($row['exam_start_time'])) ?></td>
                        <td><?php echo date("g:i a",strtotime($row['exam_end_time'])) ?></td>
                        <?php $exam_date = date("Y-m-d",strtotime($row['exam_date']));?>
                        <?php $locked = $row['lock_status']; if(!$locked){ ?>
                            <td style="font-size: 18px;"><i class="btn-edit ri-edit-2-line" onclick="editSchedule('<?php echo $row['slno'] ?>','<?php echo $row['dept'] ?>','<?php echo $row['subject'] ?>','<?php echo $exam_date ?>','<?php echo date('H:i',strtotime($row['exam_start_time'])) ?>','<?php echo date('H:i',strtotime($row['exam_end_time'])) ?>')"></i><i class="btn-delete ri-delete-bin-5-line" onclick="deleteSchedule('<?php echo $row['slno'] ?>','<?php echo $row['dept'] ?>')" style="margin-left:1rem;"></i></td>
                        <?php }else{ ?>
                            <td style="font-size: 18px; cursor: not-allowed;"><i class="ri-lock-2-line" ></i></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                <tr style="border: none;">
                    <td colspan="<?php $locked ? print'3' : print'6'?>"><button type="button" style="background: <?php $locked ? print' lightseagreen':print' red'?>; cursor: <?php $locked ? print' not-allowed':print' pointer'?>;" class="<?php $locked ? print'locked':print''?>" <?php $locked ? print' disabled ':print''?> onclick="lockSchedule('<?php print $dept;?>')"><i class="ri-lock-2-line"></i> <?php $locked ? print'Locked':print'Lock schedule'?></button></td>
                    <?php if($locked){ ?>
                        <td colspan="3"><button type="button" style="background: orangered" onclick="deleteWholeSchedule('<?php print $dept;?>')"><i class="ri-delete-bin-5-line"></i> Delete schedule</button></td>
                    <?php } ?>
                </tr>
            </table>
            <?php }else{?>
                <h2 style="color: crimson;"><i class="ri-error-warning-line"></i> No schedule found!</h2>
            <?php }} ?>
        </div>
        <div id="edit-popup">
                <form action="exam.php" method="post">
                    <h2>Edit exam schedule</h2>
                    <input type="hidden" name="edit_slno" id="edit-slno">
                    <input type="hidden" name="edit_dept" id="edit-dept">
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
        <input type="hidden" name="delete_schedule_dept" id="delete-schedule-dept">
    </form>
    <form action="exam.php" method="post" id="delete-whole-schedule">
        <input type="hidden" name="delete_whole_schedule_dept" id="delete-whole-schedule-dept">
    </form>
    <form action="exam.php" method="post" id="lock-schedule">
        <input type="hidden" name="lock_schedule_dept" id="lock-schedule-dept">
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
        function editSchedule(slno, dept, subject, date, startTime, endTime){
            editPopup.style.display = 'flex';
            document.getElementById('edit-slno').value = slno;
            document.getElementById('edit-dept').value = dept;
            document.getElementById('edit-subject').value = subject;
            document.getElementById('edit-date').value = date;
            document.getElementById('edit-start-time').value = startTime;
            document.getElementById('edit-end-time').value = endTime;

        }
        function fetchExamSchedule(dept){
            document.getElementById('dept').value = dept;
            document.getElementById('fetch-dept-schedule').submit();
        }
        function hideEditSchedule(){
            editPopup.style.display = 'none';
        }
        function lockSchedule(dept){
            if(confirm("Are you sure?\nThis will lock the schedule, after that no one will be able to edit this.")){
                document.getElementById('lock-schedule-dept').value = dept;
                document.getElementById('lock-schedule').submit();
            }
        }
        function deleteSchedule(slno, dept){
            if(confirm("Are you sure?")){
                document.getElementById('delete-schedule-slno').value = slno;
                document.getElementById('delete-schedule-dept').value = dept;
                document.getElementById('delete-schedule').submit();
            }
        }
        function deleteWholeSchedule(dept){
            if(confirm("Are you sure?\nThis will delete whole schedule.")){
                document.getElementById('delete-whole-schedule-dept').value = dept;
                document.getElementById('delete-whole-schedule').submit();
            }
        }

        function setDeptField(dept_n){
            document.getElementById('dept').value = dept_n;
            document.getElementById('fetch-exam-schedule').click();
        }
        
    </script>
     <?php
        if(isset($_POST['save_changed_exam_schedule'])){
            require_once("DB.php");
            $slno = $_POST['edit_slno'];
            $dept = $_POST['edit_dept'];
            $subject = $_POST['edit_subject'];
            $exam_date = $_POST['edit_date'];
            $exam_start_time = $_POST['edit_start_time'];
            $exam_end_time = $_POST['edit_end_time'];

            if($exam_start_time < $exam_end_time){
                $sql = "SELECT * FROM `exam` WHERE `dept` = '{$dept}' and `exam_date` = '{$exam_date}' and ((((`exam_start_time` BETWEEN '{$exam_start_time}' AND '{$exam_end_time}') or (`exam_end_time` BETWEEN '{$exam_start_time}' AND '{$exam_end_time}')) AND (`exam_start_time` != '{$exam_end_time}' AND `exam_end_time` != '{$exam_start_time}')) or (`exam_start_time` < '{$exam_start_time}' AND `exam_end_time` > '{$exam_end_time}'))";
                $result = mysqli_query($conn, $sql) or die("Query Failed!");
                $row = mysqli_fetch_assoc($result);
                mysqli_num_rows($result) > 0 ? $fetchedSlno = $row['slno'] : $fetchedSlno = null;
                if(mysqli_num_rows($result)==0 or $slno == $fetchedSlno){
                    $sql = "UPDATE `exam` SET `subject`='{$subject}',`exam_date`='{$exam_date}',`exam_start_time`='{$exam_start_time}',`exam_end_time`='{$exam_end_time}' WHERE `slno` = '{$slno}'";
                    $result = mysqli_query($conn, $sql) or die("Query Failed!");
                    
                    echo"<script>setDeptField('$dept')</script>";
                }else{
                    echo"<script>setDeptField('$dept')</script>";
                    echo"<script>alert('Selected slot is not available!')</script>";
                }
            }else{
                echo"<script>setDeptField('$dept')</script>";
                echo"<script>alert('Please select valid exam time!')</script>";
            }
        }
        if(isset($_POST['lock_schedule_dept'])){
            require_once('DB.php');
            $dept = $_POST['lock_schedule_dept'];
            $sql = "UPDATE `exam` SET `lock_status` = '1' WHERE `dept` = '{$dept}'";
            mysqli_query($conn, $sql) or die("Query Failed!");
            echo"<script>setDeptField('$dept')</script>";

        }
        if(isset($_POST['delete_schedule_slno'])){
            require_once('DB.php');
            $slno = $_POST['delete_schedule_slno'];
            $dept = $_POST['delete_schedule_dept'];
            $sql = "DELETE FROM `exam` WHERE `slno` = '{$slno}'";
            mysqli_query($conn, $sql) or die("Query Failed!");
            echo"<script>setDeptField('$dept')</script>";
        }
        if(isset($_POST['delete_whole_schedule_dept'])){
            require_once('DB.php');
            $dept = $_POST['delete_whole_schedule_dept'];
            $sql = "DELETE FROM `exam` WHERE `dept` = '{$dept}'";
            mysqli_query($conn, $sql) or die("Query Failed!");
        }
    ?>

</body>

</html>