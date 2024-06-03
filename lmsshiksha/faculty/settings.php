<?php
session_start();
if (!isset($_SESSION["faculty"])) {
    header("Location: ../");
} else {
    $faculty_name = $_SESSION["faculty_name"];
    $faculty_email = $_SESSION["faculty_email"];
    $faculty_id = $_SESSION["faculty_id"];
    $faculty_dept = $_SESSION["faculty_dept"];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty | Settings</title>
    <link rel="shortcut icon" href="faculty-asset/graduation-cap-fill.png" type="image/x-icon">
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
            position: sticky;
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
            margin-top: 10px;
            height: 90%;
            width: 100%;
            display: flex;
        }

        .sidebar {
            position: fixed;
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
            bottom: 14vh;
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

        .setting-panel {
            position: absolute;
            right: 25%;
            width: 50vw;
            display: flex;
            flex-direction: column;
            justify-content: space-around;

        }

        .panel {
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            padding: 1.5vw 2vw 1.5vw 2vw;
            margin-top: 4vh;
            margin-bottom: 4vh;
            border-radius: 5px;
        }

        .profile-panel .infos {
            display: flex;
            flex-direction: column;

        }

        .profile-panel h3 {
            border-bottom: 2px solid #111;
            width: fit-content;
            margin-bottom: 2.5vw;
        }

        .profile-panel .flex {
            display: flex;
            align-items: end;
            margin-bottom: 4vh;
            width: fit-content;
        }

        .profile-panel .grid {
            display: grid;

        }

        .profile-panel label {
            margin-bottom: 2vh;
            font-weight: 600;
            font-size: 1.1rem;

        }

        .change-email-panel label {
            font-weight: 600;
            font-size: 1.1rem;
        }


        .profile-panel span {
            margin-right: 2vw;
            margin-left: 1vw;
        }

        .profile-panel button {
            padding: .2vw .4vw;
            font-size: .9rem;
            border-radius: 4px;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
            background: rgb(231, 231, 231);
            color: #000;
            cursor: pointer;
            height: fit-content;

        }

        .profile-panel .flex:hover button {
            background: royalblue;
            color: white;
        }

        .profile-panel button i {
            font-size: 1rem;
        }

        .change-email-panel h3,
        .change-password-panel h3 {
            color: royalblue;
            border-bottom: 2px solid royalblue;
            width: fit-content;
            margin-bottom: .5vw;
        }

        .change-password-panel .flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .change-email-panel label {
            margin-right: 5vw;
        }

        .change-email-panel .flex {
            display: flex;
            margin-top: 2vh;
        }

        .change-email-panel span {
            width: 60%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .change-email-panel button,
        .change-password-panel button {
            padding: .5vw .8vw;
            font-size: .9rem;
            border-radius: 4px;
            box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
            background: rgb(80, 117, 228);
            color: #fff;
            float: right;
            margin-top: 1vw;
            cursor: pointer;
        }

        .change-email-panel button:hover,
        .change-password-panel button:hover {
            background: royalblue;
        }

        .delete-panel {
            margin-bottom: 10vh;
        }

        .delete-panel h3 {
            color: red;
            border-bottom: 2px solid rgb(255, 53, 53);
            width: fit-content;
            margin-bottom: .5vw;
        }

        .delete-panel button {
            padding: .5vw .8vw;
            font-size: .9rem;
            border-radius: 4px;
            box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
            background: rgba(255, 0, 0, 0.8);
            color: #fff;
            float: right;
            margin-top: 1vw;
            cursor: pointer;
        }

        .delete-panel button:hover {
            background: red;
        }

        .popup {
            position: fixed;
            height: 100%;
            width: 100%;
            background: #0000005a;
            z-index: 999;
            display: flex;
            justify-content: center;
            align-items: center;
            display: none;
        }

        .popup form {
            box-shadow: 1px 1px 5px #888;
        }

        .popup1 span {
            font-size: 1.1vw;
        }

        .popup1 .flex {
            margin-top: 4vh;
            display: flex;
            justify-content: space-between;
        }

        .popup1 button {
            padding: .4vw 1vw;
            border-radius: 4px;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
            cursor: pointer;
        }

        .popup2 form,
        .popup3 form,
        .popup4 form,
        .popup5 form {
            width: 25vw;
        }

        .popup2 span,
        .popup3 span,
        .popup4 span,
        .popup5 span {
            font-size: 1.2vw;
        }

        .popup form {
            background: #ffffff;
            padding: 2vw 3vw;
            border-radius: 5px;
        }

        .popup2 .flex,
        .popup3 .flex,
        .popup4 .flex,
        .popup5 .flex {
            margin-top: 4vh;
            display: flex;
            justify-content: space-between;
        }

        .popup2 .eml,
        .popup3 .eml,
        .popup4 .eml,
        .popup5 .eml {
            margin-top: 4vh;
            margin-bottom: 2vh;

        }

        .popup2 .eml label,
        .popup3 .eml label,
        .popup4 .eml label,
        .popup5 .eml label {
            margin-right: 1vw;
        }

        .popup2 input,
        .popup3 input,
        .popup4 input,
        .popup5 input {
            padding: 1.4vh 1vw;
            width: 70%;
            box-shadow: 1px 1px 5px #888;
            border-radius: 4px;
            outline-color: royalblue;
            font-size: 15px;
        }

        .popup2 button,
        .popup3 button,
        .popup4 button,
        .popup5 button {
            padding: .4vw 1vw;
            border-radius: 4px;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
            cursor: pointer;
        }

        .btn-save {
            background: rgb(80, 117, 228);
            color: white;
        }

        .btn-save:hover {
            background: royalblue;
            color: white;
        }

        .btn-delete {
            background: rgba(255, 0, 0, 0.8);
            color: white;
        }

        .btn-delete:hover {
            background: red;
            color: white;
        }

        .btn-cancel {
            background: rgb(80, 117, 228);
            ;
            color: white;
        }

        .btn-cancel:hover {
            background: royalblue;
            color: white;
        }

        .toast {
            position: absolute;
            height: 2rem;
            top: 2vh;
            right: -20vw;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            border-left: 7px solid lightgreen;
            border-bottom: 3px solid lightgreen;
            border-top: 2px solid lightgreen;
            border-right: 2px solid lightgreen;
            display: flex;
            align-items: center;
            padding: 5px 25px 5px 10px;
            transition: right ease-in-out 0.5s;
        }

        .toast .checkbox {
            font-size: 25px;
            color: lightgreen;
        }

        .toast span {
            margin-left: 10px;
            font-size: 15px;
            font-weight: 600;
            color: rgb(87, 235, 87);
        }

        .toast-help {
            position: fixed;
            right: 0;
            height: 15vh;
            width: 25vw;
            overflow: hidden;
        }

        .pos-sent {
            margin-left: 15%;
        }

        .popup5 input {
            width: 75%;
        }
        .popup5 .pass-show-hide1,.popup5 .pass-show-hide2{
            margin-left: -2rem;
            margin-bottom: -60px;
            cursor: pointer;
            font-size: 1.2rem;
        }
        .popup5 .pass-show-hide1:hover, .popup5 .pass-show-hide2:hover{
            color: gray;
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
                        <p onclick="window.location.href='exam.php'"><i
                                class="fa fa-solid fa-chalkboard-user"></i></i><span>Exams</span>
                        </p>
                    </li>
                    <li>
                        <p id="active"><i
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

        <div class="setting-panel">
            <div class="panel profile-panel">
                <h3>Account info</h3>
                <div class="infos">
                    <div class="flex">
                        <div class="grid">
                            <label>Name</label>
                            <span class="show-name">
                                <?php echo $faculty_name ?>
                            </span>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="grid">
                            <label>Faculty ID</label>
                            <span class="show-user-id">
                                <?php echo $faculty_id ?>
                            </span>
                        </div>      
                    </div>

                    <div class="flex">
                        <div class="grid">
                            <label>Department</label>
                            <span class="show-user-id">
                                <?php echo $faculty_dept ?>
                            </span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="panel change-email-panel">
                <h3>Email address</h3>
                <div class="flex">
                    <label>Email id</label>
                    <span class="show-email">
                        <p>
                            <?php echo $faculty_email ?>
                        </p>
                    </span>
                </div>
                <button onclick="show_edit_screen()"><i class="ri-mail-settings-line"></i> Change email</button>

            </div>

            <div class="panel change-password-panel">
                <h3>Change Password</h3>
                <div class="flex">
                    <label>Change your password from here</label>
                    <button onclick="show_change_password_screen()"><i class="ri-lock-password-line"></i> Change
                        password</button>
                </div>
            </div>

            <div class="panel delete-panel">
                <h3>Delete Account</h3>
                <p>Once you delete your account it will be deleted permanently. You will not be able to recover it back.
                </p>
                <button onclick="show_delete_screen()"><i class="ri-delete-bin-line"></i> Delete account</button>

            </div>

        </div>
        <div class="toast-help">
            <div class="toast">
                <i class="ri-checkbox-circle-fill checkbox"></i>
                <span>Success!</span>
            </div>
        </div>
        <div class="popup popup1">
            <form action="settings.php" method="post">
                <span>Are you sure, you want to delete this account?</span>
                <div class="grid">
                    <div class="flex">
                        <button class="btn-delete" type="submit" name="delete" value="delete"><i
                                class="ri-delete-bin-line"></i> Delete</button>
                        <button class="btn-cancel" type="reset" onclick="hide_delete_screen()">Cancel</button>
                    </div>
                </div>

            </form>
        </div>
        <div class="popup popup2">
            <form action="settings.php" method="post">
                <span>Enter new email id</span>
                <div class="grid eml">
                    <label>Email</label>
                    <input type="text" name="new_email" placeholder="Email ID" required autocomplete="off">
                </div>
                <div class="grid">
                    <div class="flex">
                        <button class="btn-save" type="submit" name="save_email" value="save"><i
                                class="ri-checkbox-circle-line"></i> Save</button>
                        <button class="btn-cancel" type="reset" onclick="hide_edit_screen()">Cancel</button>
                    </div>
                </div>

            </form>
        </div>
        
        <div class="popup popup5">
            <form action="settings.php" method="post">
                <span>Enter password</span>
                <div class="pos-sent">
                    <div class="grid eml">
                        <label>Old password</label>
                        <input type="password" name="curr_password" id="pass1" placeholder="Old password" required autocomplete="off">
                        <i class="ri-eye-off-line pass-show-hide1 eye-closed"></i>
                    </div>
                    <div class="grid eml">
                        <label>New password</label>
                        <input type="password" name="new_password" id="pass2" placeholder="New password" required autocomplete="off">
                        <i class="ri-eye-off-line pass-show-hide2 eye-closed"></i>
                    </div>
                </div>
                <div class="grid">
                    <div class="flex">
                        <button class="btn-save" type="submit" name="save_password" value="save"><i
                                class="ri-checkbox-circle-line"></i> Save</button>
                        <button class="btn-cancel" type="reset" onclick="hide_change_password_screen()">Cancel</button>
                    </div>
                </div>

            </form>

        </div>

        <form action="delete.php" method="post" class="delete-post">
            <input type="hidden" name="account" value="deleted">
        </form>
        <form action="pass-changed.php" method="post" class="pass-change-post">
            <input type="hidden" name="passchange" value="changed">
        </form>


    </div>


    <script>
        var d = document.querySelector('.popup1');
        var e = document.querySelector('.popup2');
        var en = document.querySelector('.popup3');
        var euid = document.querySelector('.popup4');
        var ep = document.querySelector('.popup5');
        var dp = document.querySelector('.delete-post');
        var pcp = document.querySelector('.pass-change-post');
        var passEye1 = document.querySelector(".popup5 .pass-show-hide1");
        var passEye2 = document.querySelector(".popup5 .pass-show-hide2");
        var pass1 = document.querySelector(".popup5 #pass1");
        var pass2 = document.querySelector(".popup5 #pass2");
        function show_delete_screen() {
            d.style.display = 'flex';
        }
        function hide_delete_screen() {
            d.style.display = 'none';
        }
        function show_edit_screen() {
            e.style.display = 'flex';
        }
        function hide_edit_screen() {
            e.style.display = 'none';
        }
        function show_edit_name_screen() {
            en.style.display = 'flex';
        }
        function hide_edit_name_screen() {
            en.style.display = 'none';
        }
        function show_edit_user_id_screen() {
            euid.style.display = 'flex';
        }
        function hide_edit_user_id_screen() {
            euid.style.display = 'none';
        }
        function show_change_password_screen() {
            ep.style.display = 'flex';
        }
        function hide_change_password_screen() {
            ep.style.display = 'none';
            pass1.type = "password";
            passEye1.className = "ri-eye-off-line pass-show-hide1 eye-closed";
            pass2.type = "password";
            passEye2.className = "ri-eye-off-line pass-show-hide2 eye-closed";
        }
        function delete_post() {
            dp.submit();
        }
        function pass_change_post() {
            pcp.submit();
        }

        passEye1.addEventListener('click', () => {
            if(passEye1.className == "ri-eye-off-line pass-show-hide1 eye-closed"){
                pass1.type = "text";
                passEye1.className = "ri-eye-fill pass-show-hide1 eye-open";
            }else{
                pass1.type = "password";
                passEye1.className = "ri-eye-off-line pass-show-hide1 eye-closed";
            }
        })
        passEye2.addEventListener('click', () => {
            if(passEye2.className == "ri-eye-off-line pass-show-hide2 eye-closed"){
                pass2.type = "text";
                passEye2.className = "ri-eye-fill pass-show-hide2 eye-open";
            }else{
                pass2.type = "password";
                passEye2.className = "ri-eye-off-line pass-show-hide2 eye-closed";
            }
        })

        var toast = document.querySelector(".toast");

        function showSuccessToast() {
            setTimeout(() => {
                toast.style.right = '2vw';
                toast.children[1].style.fontSize = '17px';
            }, 100);
            setTimeout(() => {
                toast.style.right = ' -20vw';
            }, 2000);
        }
        function showEmailErrorToast() {
            setTimeout(() => {
                toast.style.borderColor = 'orange';
                toast.innerHTML = '<i class="ri-error-warning-fill checkbox"></i><span>Email already exists! Try other email</span>';
                let icon = toast.firstElementChild;
                let txt = toast.lastElementChild;
                icon.style.color = 'orange';
                txt.style.color = 'orange';
                toast.style.right = '2vw';
            }, 100);

            setTimeout(() => {
                toast.style.right = '-30vw';
            }, 2500);
        }
        function showadmin_user_idErrorToast() {
            setTimeout(() => {
                toast.style.borderColor = 'orange';
                toast.innerHTML = '<i class="ri-error-warning-fill checkbox"></i><span>User id already exists! Try other user id</span>';
                let icon = toast.firstElementChild;
                let txt = toast.lastElementChild;
                icon.style.color = 'orange';
                txt.style.color = 'orange';
                toast.style.right = '2vw';
            }, 100);

            setTimeout(() => {
                toast.style.right = '-30vw';
            }, 2500);
        }
        function showPassErrorToast() {
            setTimeout(() => {
                toast.style.borderColor = 'red';
                toast.innerHTML = '<i class="ri-error-warning-fill checkbox"></i><span>Incorrect password! please check</span>';
                let icon = toast.firstElementChild;
                let txt = toast.lastElementChild;
                icon.style.color = 'red';
                txt.style.color = 'red';
                txt.style.fontSize = '17px';
                toast.style.right = '2vw';
            }, 100);

            setTimeout(() => {
                toast.style.right = '-30vw';
            }, 2500);
        }
        function showSamePassErrorToast() {
            setTimeout(() => {
                toast.style.borderColor = 'red';
                toast.innerHTML = '<i class="ri-error-warning-fill checkbox"></i><span>New password should be different!</span>';
                let icon = toast.firstElementChild;
                let txt = toast.lastElementChild;
                icon.style.color = 'red';
                txt.style.color = 'red';
                txt.style.fontSize = '17px';
                toast.style.right = '2vw';
            }, 100);

            setTimeout(() => {
                toast.style.right = '-30vw';
            }, 2500);
        }
        function display_updated_email(u_email) {
            let updated_email = document.querySelector('.show-email');
            updated_email.innerHTML = u_email;
        }
        function display_updated_user_id(u_user_id) {
            let updated_user_id = document.querySelector('.show-user-id');
            let updated_user_id_sidebar = document.querySelector('.show-user-id-sidebar');
            updated_user_id.innerHTML = u_user_id;
            updated_user_id_sidebar.innerHTML = u_user_id;
        }
        function display_updated_name(u_name) {
            let updated_name = document.querySelector('.show-name');
            updated_name.innerHTML = u_name;
        }
    </script>


    <?php
    if (isset($_POST["save_password"])) {
        require_once("DB.php");
        $current_pass = mysqli_real_escape_string($conn, $_POST["curr_password"]);
        $new_pass = mysqli_real_escape_string($conn, $_POST["new_password"]);
        $sql = "SELECT `password` FROM `faculty` WHERE `email` = '{$faculty_email}'";
        $res = mysqli_query($conn, $sql) or die("Query failed!");
        $row = mysqli_fetch_assoc($res);
        if(mysqli_num_rows($res)>0){
            if ($current_pass != $row['password']) {
                mysqli_close($conn);
                echo ("<script>showPassErrorToast();</script>");
            } else if ($current_pass == $new_pass) {
                mysqli_close($conn);
                echo ("<script>showSamePassErrorToast();</script>");
            } else {
                $sql = "UPDATE `faculty` SET `password` = '{$new_pass}' WHERE `email` = '{$faculty_email}'";
                mysqli_query($conn, $sql) or die("Query failed!");
                mysqli_close($conn);
                echo ("<script>showSuccessToast();</script>");
                session_destroy();
                echo ("<script>setTimeout(()=>{pass_change_post();},1000)</script>");
            }
        }
    }

    if (isset($_POST["save_email"])) {
        require_once("DB.php");
        $new_email = mysqli_real_escape_string($conn, $_POST["new_email"]);
        $sql = "SELECT `name` FROM `faculty` WHERE `email` = '{$new_email}'";
        $res = mysqli_query($conn, $sql) or die("Query failed!");
        if (mysqli_num_rows($res) > 0) {
            mysqli_close($conn);
            echo ("<script>showEmailErrorToast();</script>");
        } else {
            $sql = "UPDATE `faculty` SET `email` = '{$new_email}' WHERE `f_id` = '{$faculty_id}'";
            mysqli_query($conn, $sql) or die("Query failed!");
            mysqli_close($conn);
            $_SESSION["faculty_email"] = $new_email;
            echo "<script>display_updated_email(" . "'" . $new_email . "'" . ")</script>";
            echo ("<script>showSuccessToast();</script>");
        }
    }

    if (isset($_POST["delete"])) {
        require_once("DB.php");
        $sql = "DELETE FROM `faculty` WHERE `f_id` = '$faculty_id'";
        mysqli_query($conn, $sql) or die("Query failed!");
        session_destroy();
        echo ("<script>delete_post()</script>");
    }
    ?>
</body>

</html>