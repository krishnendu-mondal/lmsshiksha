<?php
session_start();
if (!isset($_SESSION["faculty"]) and (!isset($_GET['asmnt']) and !isset($_POST['save_grade']))) {
    header("Location: ../");
} else {
    $faculty_name = $_SESSION["faculty_name"];
    $faculty_dept = $_SESSION["faculty_dept"];
    $faculty_id = $_SESSION["faculty_id"];

    if (isset($_GET['asmnt'])) {
        $assignment_id = $_GET['asmnt'];
    } else {
        $assignment_id = $_POST['asmnt'];
    }



    require_once("DB.php");
    $sql = "SELECT * FROM `assignment` WHERE `slno`='{$assignment_id}'";
    $result = mysqli_query($conn, $sql) or die("Query Failed!");
    $r = mysqli_fetch_assoc($result);

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            height: 100%;
            display: flex;
        }

        .popup {
            position: fixed;
            left: 0;
            bottom: 0;
            height: 92vh;
            width: 100%;
            z-index: 30;
            backdrop-filter: blur(.5px);
            background: rgba(0, 0, 0, 0.3);
            display: none;
        }

        .back {
            position: fixed;
            left: 0;
            bottom: 0;
            height: 92vh;
            width: 100%;
            padding: 2rem;
        }

        .flex {
            display: flex;
        }

        .back .flex {
            align-items: center;
            gap: 2rem;
            margin-bottom: 0.5rem;
        }

        .back .assignment {
            background: #eeeeee;
            ;
            display: flex;
            align-items: center;
            padding: 0.6rem 1rem;
            border-radius: 5px;

            width: 60vh;
            cursor: pointer;
            font-size: 15px;
        }

        .back .assignment:hover {
            background-color: #dadada;
        }

        .back .assignment i {
            margin-right: 8px;
            font-size: 1.5rem;
        }

        .status {
            display: flex;
            justify-content: center;
            align-items: center;
            height: fit-content;
            padding: 4px 10px;
            border-radius: 5px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            color: #fff;
            font-weight: 500;
            font-size: 15px;
        }

        .status-pending {
            background: orange;
        }

        .status-complete {
            background: #4bb543;
        }

        .flex .ri-edit {
            font-size: 20px;
            color: royalblue;
            cursor: pointer;
        }

        .flex .ri-edit:hover {
            color: orange;
        }

        .flex #grade {
            color: royalblue;
        }

        .back .ass-form-popup {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100vw;
            height: 92vh;
            background: #0000004f;
            display: flex;
            align-items: center;
            justify-content: center;
            display: none;
        }

        .back .form {
            background: #fff;
            height: 50vh;
            width: 50vw;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            display: flex;
            justify-content: space-around;
            gap: 1rem;
            padding: 3rem 1rem;
        }

        .form .ass-down {
            padding: 1rem 2rem;
            border-radius: 5px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            display: grid;
            align-items: center;
        }


        .ass-down button {
            background: lightseagreen;
            color: #fff;
            font-size: .95rem;
            font-weight: 500;
            border-radius: 5px;
            padding: .6rem 2rem;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            cursor: pointer;
        }

        .form .ass-grade {
            padding: 1rem 2rem;
            width: 35%;
            border-radius: 5px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            display: grid;
            align-items: center;

        }

        .form .ass-grade label {
            font-size: 13px;
            margin-bottom: -1.8rem;
        }

        .form .ass-grade input {
            padding: 10px 0;
            text-align: center;
            border-radius: 5px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
        }

        .form .ass-grade button {
            background: royalblue;
            color: #fff;
            font-size: .95rem;
            font-weight: 500;
            border-radius: 5px;
            padding: .6rem 2.5rem;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            cursor: pointer;
        }

        .ass-form-popup .close {
            margin-top: -2.2rem;
            margin-right: -2rem;
            font-size: 1.5rem;
            color: #666;
            height: fit-content;
            width: fit-content;
            cursor: pointer;
        }

        .ass-form-popup .close:hover {
            color: #000;
        }

        .ass-form-popup .close:hover::after {
            content: "Close";
            position: absolute;
            margin-left: -5rem;
            margin-top: 4px;
            font-size: 16px;
        }

        .sub-head {
            background: lightseagreen;
            width: fit-content;
            color: whitesmoke;
            padding: 8px 15px;
        }

        .back hr {
            background: lightseagreen;
            height: 1px;
            border: 1px solid lightseagreen;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <nav>
        <div class="logo"><a href="../"><i class="ri-graduation-cap-fill"></i> Lmsshiksha</a></div>
        <div class="links">
            <a href="assignment.php"><i class="ri-arrow-go-back-line"></i> Back</a>
        </div>
    </nav>
    <div class="container">
        <div class="back">
            <h3 class='sub-head'><span>Submissions of
                    <?php echo $r['subject'] ?>
                </span></h3>
            <hr>
            <?php

            $sql = "SELECT * FROM `assignment_submission` WHERE `ass_slno` = '{$assignment_id}' ORDER BY `student_name` ASC";
            $result = mysqli_query($conn, $sql) or die("Query Failed!");
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="flex">
                        <div class="assignment"
                            onclick="showPopup('<?php echo $row['student_roll'] ?>', '<?php echo $row['file_name'] ?>')">
                            <i class="ri-survey-line"></i>
                            <span>Assignment submitted by
                                <?php echo $row['student_name'] ?>
                            </span>
                        </div>
                        <?php if (!$row['status']) { ?>
                            <span><b>Submitted on: </b>
                                <?php echo $row['time'] ?>
                            </span>
                            <div class="status status-pending">
                                <span><i class="ri-error-warning-line"></i> Require grading</span>
                            </div>
                        <?php } else { ?>
                            <span id="grade"><b>Grade:</b>
                                <?php echo $row['grade'] ?>
                            </span>
                            <abbr title="Edit grade" class="ri-edit" onclick="showPopup(<?php echo $row['student_roll'] ?>)"><i
                                    class="ri-edit-2-line"></i></abbr>
                            <div class="status status-complete">
                                <span><i class="ri-checkbox-circle-line"></i> Graded</span>
                            </div>
                        <?php } ?>
                        <div class="ass-form-popup">
                            <div class="form">
                                <div class="ass-down">
                                    <h3>Download this submission</h3>
                                    <input type="hidden" id="download-file-name">
                                    <button type="button" onclick="downloadThisFile()"><i class="ri-download-line"></i>
                                        Download</button>
                                </div>
                                <form class="ass-grade" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                                    <h3>Grade this submission</h3>
                                    <input type="hidden" name="student_roll" id="student-roll">
                                    <input type="hidden" name="asmnt" value="<?php echo $assignment_id ?>">
                                    <label>Between 0 - 10</label>
                                    <input type="number" name="grade" min="0" max="10">
                                    <button type="submit" name="save_grade" value="save"><i class="ri-checkbox-circle-line"></i>
                                        Save</button>
                                </form>
                                <i class="close ri-close-circle-line" onclick="hidePopup()"></i>
                            </div>
                        </div>

                    </div>
                <?php }
            }else{?>
            <h2 style="color: crimson; text-align: center; font-weight: 500;"><i class="ri-error-warning-line"></i> No record found!</h2>
        <?php } ?>
        </div>
        <a id="download-helper"></a>
    </div>



    <script>
        function showPopup(student_roll, file_name) {
            document.querySelector('.ass-form-popup').style.display = 'flex';
            document.getElementById('student-roll').value = student_roll;
            document.getElementById('download-file-name').value = file_name;
        }

        function downloadThisFile() {
            let dw_file_name = document.getElementById('download-file-name').value;
            let dw_helper = document.getElementById('download-helper');
            dw_helper.download = dw_file_name;
            dw_helper.href = "../assignment_submission/" + dw_file_name;
            dw_helper.click();
            dw_helper.download = '';
            dw_helper.href = '';
        }

        function hidePopup() {
            document.querySelector('.ass-form-popup').style.display = 'none';
        }

    </script>

    <?php
    if (isset($_POST['save_grade'])) {
        $sql = "UPDATE `assignment_submission` SET `grade`='{$_POST['grade']}', `status`='1' WHERE `ass_slno`='{$_POST['asmnt']}' and `student_roll`='{$_POST['student_roll']}'";
        $result = mysqli_query($conn, $sql) or die("Query Failed!");
        echo "<script> window.location.href='asmntshow.php?asmnt=" . $assignment_id . "' </script>";
    }
    ?>
</body>

</html>