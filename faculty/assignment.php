<?php
session_start();
if (!isset($_SESSION["faculty"])) {
    header("Location: ../");
}
else{
    $faculty_name = $_SESSION["faculty_name"];
    $faculty_dept = $_SESSION["faculty_dept"];
    $faculty_id = $_SESSION["faculty_id"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Faculty | Assignments</title>
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
            height: 100vh;
            width: 100%;
            z-index: 0;
            display: flex;
            justify-content: space-between;
            padding-top: 12vh;
            padding-left: 4vw;
            padding-right: 2vw;
        }

        .main .bck form {
            padding: 1.5rem 2rem;
            border-radius: 10px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            width: fit-content;
            height: fit-content;
            display: grid;
            background: #fff;
            align-items: center;
            position: relative;
            margin: 4rem 0 0 3.5rem;
            scale: .95;
        }

        .grid {
            display: grid;
        }

        .flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
            margin-bottom: 10px;
        }

        .main form h2, .popup form h2 {
            margin-top: .5rem;
            margin-bottom: 1.5rem;
        }

        .main form label, .popup form label {
            margin-bottom: .5rem;

        }

        .main form input, .popup form input {
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 2rem;
        }

        .main form button, .popup form button, .btn-add-assignment {
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            padding: .75rem;
            margin-top: 1rem;
            margin-bottom: 1rem;
            background: rgba(65, 105, 225, 0.836);
            font-size: 1rem;
            color: #fff;
            font-weight: 500;
            cursor: pointer;

        }

        .main form button:hover, .popup form button:hover, .btn-add-assignment:hover {
            background: royalblue;
        }

        .toast {
            position: absolute;
            height: 2.5rem;
            top: 9vh;
            right: 1.4vw;
            border-radius: 8px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            border-left: 7px solid lightgreen;
            border-bottom: 3px solid lightgreen;
            border-top: 2px solid lightgreen;
            border-right: 2px solid lightgreen;
            display: flex;
            align-items: center;
            scale: .85;
            padding: 5px 25px 5px 5px;
            transition: opacity ease-in-out 0.5s;
            opacity: 0;
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

        .check-assignment {
            padding: 1.5rem 2rem;
            border-radius: 10px;
            width: 90%;
            height: fit-content;

        }

        .check-assignment h2 {
            margin-bottom: 1rem;
        }

        .check-assignment .assignment {
            width: 50%;
            background: #eeeeee;
            padding: .8rem 1rem;
            border-radius: 10px;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .check-assignment .assignment:hover {
            background: #dadada;
            scale: 1.01;
        }
        .check-assignment .assignment:active {
            scale: .99;
        }

        .check-assignment .assignment i {
            font-size: 1.5rem;
            margin-right: 1rem;
        }
        .check-assignment .heading{
            float: right;
            margin-top: -2.5rem;
            margin-right: -2vw;
            width: 45%;
        }
        .check-assignment #edit-assignment, .check-assignment #download-assignment{
            font-size: 20px;
            cursor: pointer;
            color: royalblue;
        }
        .check-assignment #edit-assignment:hover{
            color: orange;
        }
        .check-assignment #edit-assignment:hover::after{
            content: 'Edit assignment';
            position: absolute;
            display: grid;
            color: #fff;
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 6px;
            margin-top: .5rem;
            background: rgba(0, 0, 0, 0.7);
        }
        .check-assignment #download-assignment{
            color: lightseagreen;
        }
        .check-assignment #download-assignment:hover{
            color: #20D9AA;
        }
        .check-assignment #download-assignment:hover::after{
            content: 'Download assignment';
            position: absolute;
            display: grid;
            color: #fff;
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 6px;
            margin-top: .5rem;
            background: rgba(0, 0, 0, 0.7);
        }
        .popup{
            position: absolute;
            z-index: 10;
            left: 0;
            bottom: 0;
            height: 92vh;
            width: 100%;
            background: rgba(0, 0, 0, 0.3);
            display: none;
        }
        .popup form{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 1.5rem 2rem;
            border-radius: 10px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            min-width: 25%;
            height: fit-content;
            display: grid;
            background: #fff;
            align-items: center;
        }

        .popup form .close{
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 22px;
            cursor: pointer;
            color: #666;
        }

        .popup form .close:hover{
            color: #000;
        }

        .popup form .close:hover::after{
            content: "Close";
            position: absolute;
            margin-left: -5rem;
            margin-top: 4px;
            font-size: 16px;
        }
        .btn-add-assignment{
            position: absolute;
            right: 1.5rem;
            top: 5.5rem;
            scale: .85;
        }
        .bck{
            position: fixed;
            bottom: 0;
            right: -100%;
            z-index: 15;
            height: 92vh;
            width: 30vw;
            background: rgba(50, 50, 50, 0.3);
            backdrop-filter: blur(.45px);
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.6);
            transition: right ease 300ms;
        }
        .bck .contract{
            position: absolute;
            top: 1rem;
            left: 1rem;
            font-size: 25px;
            color: #fff;
            cursor: pointer;
            transition: color ease 140ms;
        }
        .contract:hover{
            color: #000;
        }
        .contract:hover::after{
            content: "Collapse";
            position: absolute;
            margin-left: 1rem;
            margin-top: 4px;
            font-size: 16px;
            color: #000;
        }
         #require-grading::after{
            content: '';
            position: absolute;
            margin-top: -40px;
            margin-left: -15px;
            height: 15px;
            width: 15px;
            border-radius: 50%;
            background-color: #FF745C;
            
        }
        #img{
            position: absolute;
            top: 0;
            left: 0;
            transform: translate(90%,50%);
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
                        <p id="active"><i class="ri ri-pencil-ruler-2-line"></i><span>Assignments</span></p>
                    </li>
                    <li>
                        <p onclick="window.location.href='attendance.php'"><i
                                class="ri ri-pie-chart-2-line"></i><span>Attendance</span></p>
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

        <div class="main">
            <div class="check-assignment">
            <button type="button" class="btn-add-assignment" onclick="showAddAsignmentForm()"><i class="ri-add-circle-line"></i> Add new</button>
            
            <?php 
                require_once("DB.php");
                $sql = "SELECT * FROM `assignment` WHERE `provider_id` = '{$faculty_id}' ORDER BY `slno` DESC";
                $result = mysqli_query($conn, $sql) or die("Query Failed!");
                if(mysqli_num_rows($result) > 0){
            ?>  
                <h2>Assignments</h2>
                <div class="flex heading">
                    <h4>Provided on</h4>
                    <h4 style="margin-left: 5rem;">Deadline</h4>
                    <h4 style="margin-left: 3rem;">Action</h4>
                    <h4 style="margin-right: -1rem;">Submissions</h4>
                </div>

                <?php while($row = mysqli_fetch_assoc($result)){ 
                    $sql = "SELECT * FROM `student` WHERE `dept` = '{$faculty_dept}'";
                    $res = mysqli_query($conn, $sql) or die("Query Failed!");
                    $num_of_std = mysqli_num_rows($res);

                    $sql = "SELECT * FROM `assignment_submission` WHERE `ass_slno` = '{$row['slno']}'";
                    $res = mysqli_query($conn, $sql) or die("Query Failed!");
                    $num_of_sub = mysqli_num_rows($res);
                    $num_of_graded_sub = 0;
                    
                    while($r = mysqli_fetch_assoc($res)){

                       $r['status'] == 1? $num_of_graded_sub += 1: $num_of_graded_sub ;
                        
                    }

                ?>

                <div class="flex" >
                    <div class="assignment" id="<?php $num_of_sub!=$num_of_graded_sub? print'require-grading':print''?>" onclick="window.location.href='asmntshow.php?asmnt=<?php echo $row['slno']?>'">
                        <i class="ri-survey-line"></i>
                        <span  style="font-size:15px;"><?php echo $row['subject'] ?></span>
                    </div>
                    <span><?php echo $row['time'] ?></span>
                    <span><?php echo $row['deadline'] ?></span>
                    
                    <div class="actions" style="display: flex; gap: 2rem;">
                        <span id="download-assignment" onclick="downloadThisFile('<?php echo $row['file_name'] ?>')"><i class="ri-download-line"></i></span>
                        <span id="edit-assignment" onclick="showEditPopup( '<?php echo $row['slno'] ?>', '<?php echo $row['subject'] ?>', '<?php echo date('Y-m-d',strtotime($row['deadline'])) ?>' )"> <i class="ri-edit-2-line"></i> </span>
                    </div>
                    <span style="margin-right: -2.5vw"><?php echo $num_of_sub."/".$num_of_std."&nbsp;&nbsp;&nbsp;&nbsp;".(round($num_of_sub/$num_of_std*100))."%" ?></span>
                </div>
            <?php }}else{ ?>
                <h2 style="color: #7785F2; font-weight: 500; text-align: center;"><i class="ri-sticky-note-line"></i> No assignments from your side.</h2>
                <img src="faculty-asset/assignment.webp" height="400" width="500" id="img">
            <?php } ?>
            </div>
            <div class="bck">
                <i class="contract ri-contract-right-line" onclick="hideAddAssignmentPopup()"></i>
                <form action="assignment.php" method="post" enctype="multipart/form-data">
                    <h2>Provide new assignment</h2>

                    <div class="grid">
                        <label>Subject of assignment</label>
                        <input type="text" name="subject" placeholder="Subject" required autocomplete="off">
                    </div>

                    <div class="grid">
                        <label>Deadline</label>
                        <input type="date" name="deadline" required>
                    </div>

                    <div class="grid">
                        <label>Upload assignment</label>
                        <input type="file" name="file_assignment" required style="cursor: pointer">
                    </div>

                    <button type="submit" name="upload_assignment" value="upload"><i class="ri-upload-line"></i> Upload</button>
                </form>
            </div>
        </div>
        <div class="toast">
            <i class="ri-checkbox-circle-fill checkbox"></i>
            <span>Success!</span>
        </div>

    </div>
    <div class="popup">
        <form action="assignment.php" method="post" enctype="multipart/form-data">
            <h2>Edit assignment</h2>
            <i class="close ri-close-circle-line" onclick="hideEditPopup()"></i>
            <input type="hidden" name="slno" id="slno">
            <div class="grid">
                <label>Subject of assignment</label>
                <input type="text" id="subject" name="subject" placeholder="Subject" required autocomplete="off">
            </div>

            <div class="grid">
                <label>Deadline</label>
                <input type="date" id="deadline" name="deadline" required>
            </div>

            <div class="grid">
                <label>Upload assignment</label>
                <input type="file" name="file_assignment" style="cursor: pointer">
            </div>

            <button type="submit" name="edit_assignment" value="edit"><i class="ri-checkbox-circle-line"></i>
                Save changes</button>
                
        </form>

    </div>
    <a id="download-helper"></a>

    <!-- JavaScript -->
    <script>

        var toast = document.querySelector(".toast");
        function showSuccessToast() {
            setTimeout(() => {
                toast.style.opacity = '1';
            }, 100);
            setTimeout(() => {
                toast.style.opacity = '0';
            }, 2000);
        }

        var popup = document.querySelector('.popup');
        function showEditPopup(slno, subject, deadline){
            popup.style.display = 'initial';
            document.querySelector('.popup form #slno').value = slno;
            document.querySelector('.popup form #subject').value = subject;
            document.querySelector('.popup form #deadline').value = deadline;
            
        }

        function hideEditPopup(){
            popup.style.display = 'none';
        }

        function showAddAsignmentForm(){
            document.querySelector('.bck').style.right = '0';
        }

        function hideAddAssignmentPopup(){
            document.querySelector('.bck').style.right = '-100%';
        }

        function downloadThisFile(fileName){
            let dw_helper = document.getElementById('download-helper');
            dw_helper.download = fileName;
            dw_helper.href = "../assignments/" + fileName;
            dw_helper.click();   
            dw_helper.download = '';
            dw_helper.href = '';      
        }
        
    </script>

    <!-- Backend -->
    <?php
    if (isset($_POST['upload_assignment'])) {

        $subject = $_POST["subject"];
    
        date_default_timezone_set("Asia/Kolkata");

        $timestamp = date('d-m-Y g:i a');
        $deadline = $_POST["deadline"].' 11:59 pm';
        $deadline = date('d-m-Y g:i a', strtotime($deadline));

        if (isset($_FILES['file_assignment'])) {
            $error = array();
            $file_name = $_FILES['file_assignment']['name'];
            $file_size = $_FILES['file_assignment']['size'];
            $file_tmp = $_FILES['file_assignment']['tmp_name'];
            $file_type = $_FILES['file_assignment']['type'];
            //explode--> for converting a string to an array
            //explode--> explode(separator,string,limit(optional))
            //end--> the last value
            //strtolower--> converting the last string to lower case
            $file_exp = explode('.', $file_name);
            $file_ext = end($file_exp);
            $extensions = array("pdf", "docx","txt" );

            //in_array will search the extension was in the $extensions array or not
            if (in_array($file_ext, $extensions) === false) {
                $error[] = "Unsupported file type! Choose pdf/word/txt document.";
            }

            if ($file_size > 716800) {
                $error[] = "File size too large! Upload file under 700KB.";
            }

            if (empty($error) == true) {
                $file_name_new = $faculty_id.$file_name;
                move_uploaded_file($file_tmp, "../assignments/" . $file_name_new);

                $sql = "INSERT INTO `assignment`(`provider_name`, `provider_dept`, `provider_id`, `subject`, `file_name`, `time`, `deadline`) VALUES ('{$faculty_name}','{$faculty_dept}','{$faculty_id}','{$subject}','{$file_name_new}','{$timestamp}','{$deadline}')";
                $result = mysqli_query($conn, $sql) or die("Query Failed!");
                mysqli_close($conn);
                if ($result) {
                    echo "<script>showSuccessToast(); setTimeout(()=>{window.location.href='assignment.php'},2000);</script>";
                }
            } else {
                echo "<script>alert('$error[0]')</script>";
                die();
            }
        }

    }

    if(isset($_POST['edit_assignment'])){
        $deadline = $_POST["deadline"].' 11:59 pm';
        $deadline = date('d-m-Y g:i a', strtotime($deadline));

        $sql = "UPDATE `assignment` SET `subject` = '{$_POST['subject']}', `deadline` = '{$deadline}' WHERE `slno` = '{$_POST['slno']}'";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "<script>showSuccessToast(); setTimeout(()=>{window.location.href='assignment.php'},2000);</script>";
        }

        if (!empty($_FILES['file_assignment']['name'])) {
            $error = array();
            $file_name = $_FILES['file_assignment']['name'];
            $file_size = $_FILES['file_assignment']['size'];
            $file_tmp = $_FILES['file_assignment']['tmp_name'];
            $file_type = $_FILES['file_assignment']['type'];
            //explode--> for converting a string to an array
            //explode--> explode(separator,string,limit(optional))
            //end--> the last value
            //strtolower--> converting the last string to lower case
            $file_exp = explode('.', $file_name);
            $file_ext = end($file_exp);
            $extensions = array("pdf", "docx","txt" );

            //in_array will search the extension was in the $extensions array or not
            if (in_array($file_ext, $extensions) === false) {
                $error[] = "Unsupported file type! Choose pdf/word/txt document.";
            }

            if ($file_size > 716800) {
                $error[] = "File size too large! Upload file under 700KB.";
            }

            if (empty($error) == true) {
                $sql = "SELECT * FROM `assignment` WHERE `slno` = '{$_POST['slno']}'";
                $result = mysqli_query($conn, $sql) or die("Query Failed!");
                $row = mysqli_fetch_assoc($result);
                unlink("../assignments/".$row['file_name']);
                
                $file_name_new = $faculty_id.$file_name;
                move_uploaded_file($file_tmp, "../assignments/" . $file_name_new);

                $sql = "UPDATE `assignment` SET `file_name` = '{$file_name_new}' WHERE `slno` = '{$_POST['slno']}'";
                $result = mysqli_query($conn, $sql) or die("Query Failed!");
                mysqli_close($conn);
                if ($result) {
                    echo "<script>showSuccessToast(); setTimeout(()=>{window.location.href='assignment.php'},1000);</script>";
                }
            } else {
                echo "<script>alert('$error[0]')</script>";
                die();
            }
        }
    }


    ?>
</body>

</html>