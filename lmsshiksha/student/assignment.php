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
    <title>Student | Assignments</title>
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
            display: flex;
            flex-direction: column;
            padding: 12vh 4vw 5vh 6vw;
        }

        .assignment {
            position: relative;
            padding: .8rem 0;
            display: flex;
            align-items: center;
            flex-wrap: nowrap;
            background: #eeeeee;
            border-radius: 5px;
            cursor: pointer;
            min-width: 45vw;
        }

        .assignment:hover {
            background: #ddd;
        }

        .assignment i {
            font-size: 1.6rem;
            margin: 0 1vw;
            color: #444;
        }

        .flex {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .grid {
            display: grid;
        }

        .deadline {
            display: flex;
            align-items: center;
            margin-left: 2vw;
            width: 30%;
        }

        .popup {
            position: fixed;
            bottom: 0;
            height: 91%;
            width: 100%;
            background: #0000005a;
            z-index: 999;
            display: flex;
            justify-content: center;
            align-items: center;
            display: none;
        }

        .back {
            background: #fff;
            height: 60vh;
            width: 50vw;
            border-radius: 10px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: space-between;
            padding: 30px;
        }

        .popup .task {
            display: grid;
            height: 50%;
            width: 35%;
            justify-content: center;
            border-radius: 10px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            padding-top: 30px;
        }

        .task span {
            color: black;
            font-size: 1.1rem;
        }

        .task button {
            height: 45px;
            width: 100%;
            background: royalblue;
            color: #fff;
            font-size: .95rem;
            font-weight: 500;
            border-radius: 5px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            cursor: pointer;
        }

        .upload-assignment {
            display: grid;
            width: 42%;
            justify-content: center;
            border-radius: 10px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            padding: 2rem;
        }

        .upload-assignment span {
            color: black;
            font-size: 1.15rem;
            margin-left: .6em;
        }

        .upload-assignment input {
            background-color: #eee;
            margin-bottom: 4rem;
            border-radius: 5px;
            padding: 1em;
            box-shadow: .5px 0px 5px rgba(0, 0, 0, 0.3);
            cursor: pointer;
        }

        .upload-assignment button {
            height: 45px;
            background: lightseagreen;
            color: #fff;
            font-size: .95rem;
            font-weight: 500;
            border-radius: 5px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            cursor: pointer;
            margin-bottom: -4rem;
        }

        .back #close-cross {
            height: fit-content;
            color: #666;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 5px;
            margin-right: -1.5rem;
            margin-top: -1.5rem;
        }

        .back #close-cross:hover {
            color: #000;
        }

        .back #close-cross:hover::after {
            content: "Close";
            position: absolute;
            margin-left: -5rem;
            margin-top: 4px;
            font-size: 16px;
        }

        .status {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .status span {
            display: flex;
            justify-content: center;
            align-items: center;
            height: fit-content;
            width: fit-content;
            padding: 3px 8px;
            border-radius: 5px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            color: #fff;
            font-weight: 500;
            gap: 2px;
        }

        .status-pending span {
            background: orange;
        }

        .status-submitted span {
            background: #4bb543;
        }
        .status-missed span {
            background: red;
        }
        .flex ul span{
            cursor:pointer;
        }
        .flex ul span:hover:nth-child(1){
            color:lightseagreen;
        }
        .flex ul span:hover:nth-child(1)::after{
            content: 'Download submission';
            position: absolute;
            display: grid;
            color: #fff;
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 6px;
            margin-top: .5rem;
            background: rgba(0, 0, 0, 0.7);
        }
        .flex ul span:hover:nth-child(2){
            color:orange;
        }
        .flex ul span:hover:nth-child(2)::after{
            content: 'Edit submission';
            position: absolute;
            display: grid;
            color: #fff;
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 6px;
            margin-top: .5rem;
            background: rgba(0, 0, 0, 0.7);
        }
        .flex ul span:hover:nth-child(3){
            color:red;
        }
        .flex ul span:hover:nth-child(3)::after{
            content: 'Delete submission';
            position: absolute;
            display: grid;
            color: #fff;
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 6px;
            margin-top: .5rem;
            background: rgba(0, 0, 0, 0.7);
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
                        <p id="active"><i class="ri ri-pencil-ruler-2-line"></i><span>Assignments</span></p>
                    </li>
                    <li>
                        <p onclick="window.location.href='attendance.php'"><i
                                class="ri ri-pie-chart-2-line"></i><span>Attendance</span></p>
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
            <?php
            require_once("DB.php");
            $sql = "SELECT * FROM `assignment` WHERE `provider_dept` = '{$student_dept}' ORDER BY `slno` DESC";
            $result = mysqli_query($conn, $sql) or die("Query Failed!");
            if (mysqli_num_rows($result) > 0) {
            ?>
            <h3
                style="background: lightseagreen; color: #fff; width: fit-content; padding: 5px 15px; font-weight: 600;">
                Your assignments</h3>
            <hr style="height: 1px; border: 1px solid lightseagreen; margin-bottom: 1rem;">
            <?php 
                while ($row = mysqli_fetch_assoc($result)) {
                    $deadline_status_pos = strtotime($row['deadline']) > strtotime($time_now);
                    $sql1 = "SELECT * FROM `assignment_submission` WHERE `ass_slno` = '{$row['slno']}' and `student_roll` = '{$student_roll}'";
                    $res = mysqli_query($conn, $sql1) or die("Query Failed!");
                    $r = mysqli_fetch_assoc($res);
                    ?>
                    <div class="flex">
                        <div class="assignment" onclick="show_popup('<?php echo $row['slno'] ?>','<?php echo $row['file_name'] ?>',<?php $deadline_status_pos ? (!isset($r['status']) ? print('1') : print(!$r['status'])) : print('0') ?>)">
                            <i class="ri-survey-line"></i>
                            <span>
                                <?php echo $row['subject'] ?>
                            </span>
                            <span style="position: absolute; right: 15px; top: 5px;font-size: 13px;">
                                <?php echo "Faculty: ".$row['provider_name'] ?>
                            </span>
                            <span style="position: absolute; right: 15px; bottom: 5px;font-size: 13px;">
                                <?php echo "Date: ".$row['time'] ?>
                            </span>

                        </div>
                        <?php
                        
                        if (mysqli_num_rows($res) == 0 and $deadline_status_pos) { ?>
                            <div class="deadline">
                                <span style="color: orange"><b>Last date of submission:</b>
                                    <?php echo $row['deadline'] ?>
                                </span>
                            </div>

                            <div class="status status-pending">
                                <span><i class="ri-error-warning-line"></i> Pending</span>
                            </div>
                        
                        <?php } else if(mysqli_num_rows($res) == 0 and !$deadline_status_pos){ ?>
                            <div class="deadline">
                                <span style="color: orange"><b>Last date of submission was:</b>
                                    <?php echo $row['deadline'] ?>
                                </span>
                            </div>

                            <div class="status status-missed">
                                <span><i class="ri-close-circle-line"></i> Missed</span>
                            </div>
                        <?php } else { ?>
                            <div class="deadline">
                                <span style="color: #4bb543"><b>Submitted on:</b>
                                    <?php echo $r['time'] ?>
                                </span>
                            </div>
                            <?php if($r['status']){ ?>
                                <span style="width: 10%; display: flex; align-items: center; justify-content: center; color: royalblue"><b>Grade:</b>&nbsp;<?php echo $r['grade'] ?></span>
                            <?php }else{ ?>
                                <span style="width: 10%; display: flex; align-items: center; color: orange; margin-left: -6rem;">Not yet graded!</span>
                            <?php } ?>
                            
                            <?php if(!$r['status']){ ?>
                                <ul style="list-style:none; display: flex; align-items:center; justify-content: center; gap: 1rem; margin-right: 2rem; color: royalblue; font-size: 20px;">
                                    <span id="download-submission" onclick="downloadFileFromUrl('<?php echo $r['file_name'] ?>')"><i class="ri-download-line"></i></span>
                                    <?php if($deadline_status_pos){ ?>
                                    <span id="edit-submission" onclick="show_popup('<?php echo $row['slno'] ?>','<?php echo $row['file_name'] ?>',<?php $deadline_status_pos ? (!isset($r['status']) ? print('1') : print(!$r['status'])) : print('0') ?>)"><li><i class="ri-edit-2-line"></i></li></span>
                                    <span id="delete-submission" onclick="delete_submission('<?php echo $row['slno'] ?>','<?php echo $student_roll ?>')"><li><i class="ri-delete-bin-5-line"></i></li></span>
                                    <?php } ?>
                                </ul>
                                <div class="status status-submitted">
                                    <span><i class="ri-checkbox-circle-line"></i> Submitted</span>
                                </div>
                            <?php }else{ ?>
                                <div class="status status-submitted">
                                    <span><i class="ri-checkbox-circle-line"></i> Graded</span>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>

                <?php }
            }else{?>
                <h2 style="color: #74B689; font-weight: 500; text-align: center;"><i class="ri-sticky-note-line"></i> No assignments for you.</h2>
                <img src="student-asset/4419039.webp" height="500" width="550" style="position: absolute; top: 0; left: 0; transform: translate(95%,30%);"> 
            <?php } ?>

        </div>
    </div>

    <div class="popup">
        <div class="back">
            <div class="task">
                <span>Download assignment</span>
                <input type="hidden" id="download-file-name">
                <button type="button" onclick="downloadThisFile()"><i class="ri-download-line"></i> Download</button>
            </div>
            <form action="assignment.php" method="post" enctype="multipart/form-data" class="upload-assignment">
                <span>Submit your assignment</span>
                <input type="hidden" name="slno" id="uslno">
                <input type="file" name="submission_file" required>
                <button type="submit" name="upload" value="upload"><i class="ri-upload-line"></i> Submit</button>
            </form>
            <i id="close-cross" onclick="hide_popup()" class="ri-close-circle-line"></i>
        </div>
    </div>
    
    <form action="assignment.php" method="post" id="delete_submission">
        <input type="hidden" id="delete_slno" name="slno">
        <input type="hidden" id="delete_std_roll" name="student_roll">
        <input type="hidden" name="delete_submission" value="delete">
    </form>

    <a id="download-helper"></a>

    <script>
        var p = document.querySelector('.popup');
        var upldasmnt = document.querySelector('.upload-assignment');

        function show_popup(slno, file_name, status) {
            p.style.display = 'flex';
            document.getElementById('uslno').value = slno;
            document.getElementById('download-file-name').value = file_name;
            if(status){
                upldasmnt.style.display="grid";
            }else{
                upldasmnt.style.display="none";
            }
            
        }

        function downloadThisFile(){
            let dw_file_name = document.getElementById('download-file-name').value;
            let dw_helper = document.getElementById('download-helper');
            dw_helper.download = dw_file_name;
            dw_helper.href = "../assignments/" + dw_file_name;
            dw_helper.click();
            dw_helper.download = '';
            dw_helper.href = '';
        }

        function downloadFileFromUrl(fileName){
            let dw_helper = document.getElementById('download-helper');
            dw_helper.download = fileName;
            dw_helper.href = "../assignment_submission/" + fileName;
            dw_helper.click();
            dw_helper.download = '';
            dw_helper.href = '';
        }

        function hide_popup() {
            p.style.display = 'none';
            upldasmnt.style.display="grid";
        }

        function delete_submission(slno,student_roll){
            if(confirm("Are you sure?\nThis submission will get permanently deleted!")){
                document.getElementById('delete_slno').value = slno;
                document.getElementById('delete_std_roll').value = student_roll;
                document.getElementById('delete_submission').submit();
            }
        }
    </script>

    <?php
    
    if (isset($_POST['upload'])) {
        $slno = $_POST['slno'];
        $sql = "SELECT * FROM `assignment_submission` WHERE `ass_slno` = '{$slno}' and `student_roll` = '{$student_roll}'";
        $result = mysqli_query($conn, $sql) or die("Query Failed!");
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $delete_existing_file = "../assignment_submission/".$row['file_name'];

            date_default_timezone_set("Asia/Kolkata");
            $timestamp = date('d-m-Y g:i a');

            if (isset($_FILES['submission_file'])) {
                $error = array();
                $file_name = $_FILES['submission_file']['name'];
                $file_size = $_FILES['submission_file']['size'];
                $file_tmp = $_FILES['submission_file']['tmp_name'];
                $file_type = $_FILES['submission_file']['type'];

                $file_exp = explode('.', $file_name);
                $file_ext = end($file_exp);
                $extensions = array('pdf', 'docx', 'txt');

                if (!in_array($file_ext, $extensions)) {
                    $error[] = "Unsupported file type! Choose pdf/word/txt document.";
                }

                if ($file_size > 716800) {
                    $error[] = "File size too large! Upload file under 700KB.";
                }

                if (empty($error)) {
                    unlink($delete_existing_file);
                    $file_name_new = $student_roll.$file_name;
                    move_uploaded_file($file_tmp, "../assignment_submission/".$file_name_new);
                    $sql = "UPDATE `assignment_submission` SET `time` = '{$timestamp}', `file_name` = '{$file_name_new}' WHERE `ass_slno` = '{$slno}' and `student_roll` = '{$student_roll}'";
                    $result = mysqli_query($conn, $sql) or die("Query Failed!");
                    mysqli_close($conn);
                    if ($result) {
                        echo "<script>setTimeout(()=>{window.location.href='assignment.php'},500);</script>";
                    }
                } else {
                    echo "<script>alert('$error[0]')</script>";
                    die();
                }

            }
        }else{

            date_default_timezone_set("Asia/Kolkata");
            $timestamp = date('d-m-Y g:i a');

            if (isset($_FILES['submission_file'])) {
                $error = array();
                $file_name = $_FILES['submission_file']['name'];
                $file_size = $_FILES['submission_file']['size'];
                $file_tmp = $_FILES['submission_file']['tmp_name'];
                $file_type = $_FILES['submission_file']['type'];

                $file_exp = explode('.', $file_name);
                $file_ext = end($file_exp);
                $extensions = array('pdf', 'docx', 'txt');

                if (!in_array($file_ext, $extensions)) {
                    $error[] = "Unsupported file type! Choose pdf/word/txt document.";
                }

                if ($file_size > 716800) {
                    $error[] = "File size too large! Upload file under 700KB.";
                }

                if (empty($error)) {
                    $file_name_new = $student_roll.$file_name;
                    move_uploaded_file($file_tmp, "../assignment_submission/".$file_name_new);
                    $sql = "INSERT INTO `assignment_submission`(`ass_slno`, `student_name`, `student_roll`, `file_name`, `time`, `grade`,`status`) VALUES ('{$slno}','{$student_name}','{$student_roll}','{$file_name_new}','{$timestamp}','0','0')";
                    $result = mysqli_query($conn, $sql) or die("Query Failed!");
                    mysqli_close($conn);
                    if ($result) {
                        echo "<script>setTimeout(()=>{window.location.href='assignment.php'},500);</script>";
                    }
                } else {
                    echo "<script>alert('$error[0]')</script>";
                    die();
                }

            }
        }


    }
    if(isset($_POST['delete_submission'])){
        $sql = "SELECT * FROM `assignment_submission` WHERE `ass_slno` = '{$_POST['slno']}' and `student_roll` = '{$_POST['student_roll']}'";
        $result = mysqli_query($conn, $sql) or die("Query Failed!");
        $row = mysqli_fetch_assoc($result);

        $delete_existing_file = "../assignment_submission/".$row['file_name'];
        unlink($delete_existing_file);

        $sql = "DELETE FROM `assignment_submission` WHERE `ass_slno` = '{$_POST['slno']}' and `student_roll` = '{$_POST['student_roll']}'";
        $result = mysqli_query($conn, $sql) or die("Query Failed!");

        if ($result) {
            echo "<script>setTimeout(()=>{window.location.href='assignment.php'},500);</script>";
        }
    }
    ?>

</body>

</html>