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
    <title>Admin | Edit user</title>
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

        .admin-info {
            position: absolute;
            height: 80%;
            width: 90%;
            left: 8rem;
            top: 2rem;
            z-index: 0;
        }

        .admin-info span {
            color: rgb(43, 57, 207);
            font-size: 2rem;
            letter-spacing: .15rem;
        }

        .admin-info p {
            margin-top: 2rem;
        }

        .admin-info img {
            height: 90%;
            width: 35%;
        }

        .selection {
            width: fit-content;
        }

        .selection label {
            font-size: 1.2rem;
            letter-spacing: 1px;
        }

        .selection select {
            height: 5vh;
            width: 10vw;
            font-size: 1.1rem;
            padding-left: .5rem;
            border-radius: 5px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            outline-color: royalblue;
            cursor: pointer;
        }

        .edit-user {
            position: absolute;
            right: 1rem;
            height: 80%;
            width: 85%;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            padding: 2rem 3rem;
        }

        .search-form {
            margin-top: 1rem;
            width: fit-content;

        }

        .search-form-form,
        .flex {
            display: flex;
            align-items: center;

        }

        .set {
            display: grid;

        }

        .search-form input {
            padding: .6rem 1rem .6rem 1rem;
            border-radius: 5px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            font-size: 1rem;
            margin-top: 10px;
            border: none;
            outline-color: royalblue;
        }

        ::placeholder {
            font-size: 1rem;
            letter-spacing: .05rem;
            color: black;
        }

        .search-form button {
            padding: .6rem 1.8rem;
            border-radius: 5px;
            background: rgba(65, 105, 225, 0.866);
            border: none;
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            letter-spacing: .04rem;
            margin-top: 1.8rem;
            margin-left: 1rem;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            cursor: pointer;
        }

        .search-form button:hover {
            background: royalblue;
        }

        .form-student {
            margin-top: 2rem;
        }

        .form-student input {
            padding: .6rem 0rem .6rem 1rem;
            width: 21vw;
            border-radius: 5px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            font-size: 1rem;
            margin-top: 10px;
            border: none;
            outline-color: royalblue;
            margin-right: 2rem;
        }

        .form-student label {
            margin-top: 2rem;
        }

        .edit-student .btn-save,
        .btn-cancel,
        .btn-delete {
            position: absolute;
            bottom: 2rem;
            left: 2rem;
            background: rgba(65, 105, 225, 0.866);
            border: none;
            padding: .5rem .8rem;
            border-radius: 5px;
            font-size: 1rem;
            color: #fff;
            letter-spacing: .04rem;
            margin-top: 1.8rem;
            margin-left: 1rem;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .edit-student .btn-save:hover,
        .btn-cancel:hover {
            background: royalblue;
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
            background: #fff;
            display: flex;
            align-items: center;
            padding: 5px 25px 5px 10px;
            transition: right ease-in-out 0.5s;
            background: white;
            z-index: 20;
            scale: .9;

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

        .btn-cancel {
            left: 43vw;
        }

        .btn-delete {
            background: rgba(255, 0, 0, 0.75);
            left: 76vw;
        }

        .btn-delete:hover {
            background: red;

        }

        .popup {
            position: fixed;
            height: 100%;
            width: 100%;
            top: 9vh;
            left: 0;
            background: #0000005a;
            z-index: 999;
            display: flex;
            justify-content: center;
            align-items: center;
            display: none;
        }

        .popup span {
            font-size: 1.1vw;
        }

        .popup .flex {
            margin-top: 4vh;
            display: flex;
            justify-content: space-between;
        }

        .popup button {
            padding: .4vw 1vw;
            border-radius: 4px;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
            cursor: pointer;
        }

        .popup .form {
            box-shadow: 1px 1px 5px #888;
            background: #fff;
            padding: 2vw 3vw;
            border-radius: 5px;
        }

        .btn-d {
            background: rgba(255, 0, 0, 0.8);
            color: white;
        }

        .btn-d:hover {
            background: red;
            color: white;
        }

        .btn-c {
            background: rgb(80, 117, 228);
            color: white;
        }

        .btn-c:hover {
            background: royalblue;
            color: white;
        }

        
        #active {
            background: #ddd;
            color: lightseagreen;
        }
    </style>
</head>

<body style="overflow: hidden;">
    <nav>
        <div class="logo"><a href="../"><i class="ri-graduation-cap-fill"></i> Lmsshiksha</a></div>
        <div class="links">
            <a href="../">Home</a>
        </div>
    </nav>
    <div class="container">
        <div class="toast">
            <i class="ri-checkbox-circle-fill checkbox"></i>
            <span>Saved Successfully!</span>
        </div>
        <div class="sidebar">
            <div class="sidebar-links">
                <ul>
                    <li>
                        <p onclick="window.location.href='dashboard.php'"><i
                                class="ri ri-shield-user-fill"></i><span>
                                <?php echo $_SESSION["admin_user_id"] ?>
                            </span></p>
                    </li>
                    <li>
                        <p onclick="window.location.href='add-user.php'"><i
                                class="ri ri-user-add-fill"></i><span>Add new user</span></p>
                    </li>
                    <li>
                        <p id="active"><i class="fa fa-solid fa-user-pen fa-xs"></i><span>Edit user info</span>
                        </p>
                    </li>
                    <li>
                        <p onclick="window.location.href='exam.php'"><i class="fa fa-solid fa-chalkboard-user fa-xs"></i><span>Exams
                        </span></p>
                    </li>
                    <li>
                        <p onclick="window.location.href='settings.php'"><i
                                class="ri ri-settings-4-fill"></i><span>Settings</span></p>
                    </li>
                </ul>
                <div class="logout">
                    <p onclick="window.location.href='logout.php'"><i
                            class="ri ri-logout-box-r-line"></i><span>Logout</span></p>
                </div>
            </div>
        </div>

        <div class="edit-user">
            <div class="selection">
                <label>Select user type:</label>
                <select name="user" id="user" class="user-select">
                    <option value="student">Student</option>
                    <option value="faculty">Faculty</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="search-form">
                <form action="edit-user.php" method="post" class="search-form-form">

                </form>
            </div>
            <script>
                var toast = document.querySelector(".toast");

                function showSuccessToast() {
                    setTimeout(() => {
                        toast.style.right = '2vw';
                    }, 100);
                    setTimeout(() => {
                        toast.style.right = ' -20vw';
                    }, 2000);
                }

                function showInvalidToast() {
                    setTimeout(() => {
                        toast.style.borderColor = 'orange';
                        toast.innerHTML = '<i class="ri-error-warning-fill checkbox"></i><span>User does not exists!</span>';
                        let icon = toast.firstElementChild;
                        let txt = toast.lastElementChild;
                        icon.style.color = 'orange';
                        txt.style.color = 'orange';
                        toast.style.right = '2vw';
                    }, 100);

                    setTimeout(() => {
                        toast.style.right = '-20vw';
                    }, 2000);
                }

                function showDeletedToast() {
                    setTimeout(() => {
                        toast.innerHTML = '<i class="ri-checkbox-circle-fill checkbox"></i><span>Account deleted</span>';
                        let icon = toast.firstElementChild;
                        let txt = toast.lastElementChild;
                        toast.style.right = '2vw';
                    }, 100);

                    setTimeout(() => {
                        toast.style.right = '-20vw';
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

                function delete_this_user() {
                    let pd = document.querySelector('.popup-delete');
                    pd.style.display = 'flex';

                }
                function hide_delete_screen() {
                    let pd = document.querySelector('.popup-delete');
                    pd.style.display = 'none';

                }
            
                var user = document.querySelector('#user');

                
                var search_form = document.querySelector('.search-form-form');

                var user_value = user.value;

                search_form.innerHTML = '<input type="hidden" name="user" value="student"><div class="set"><label>Enter Roll Number:</label><input type="text" name="roll" placeholder="Roll number" required autocomplete="off"></div><button type="submit" name="search" value="search">Edit</button>';

                user.addEventListener('input', () => {

                    user_value = user.value;

                    if (user_value == "student") {
                        search_form.innerHTML = '<input type="hidden" name="user" value="student"><div class="set"><label>Enter Roll Number:</label><input type="text" name="roll" placeholder="Roll number" required autocomplete="off"></div><button type="submit" name="search" value="search">Edit</button>';

                    }
                    if (user_value == "faculty") {
                        search_form.innerHTML = '<input type="hidden" name="user" value="faculty"><div class="set"><label>Enter Faculty ID:</label><input type="text" name="f_id" placeholder="Faculty ID" required autocomplete="off"></div><button type="submit" name="search" value="search">Edit</button>';

                    }
                    if (user_value == "admin") {
                        search_form.innerHTML = '<input type="hidden" name="user" value="admin"><div class="set"><label>Enter User ID:</label><input type="text" name="user_id" placeholder="User ID" required autocomplete="off"></div><button type="submit" name="search" value="search">Edit</button>';
                    }

                })

                const event = new Event('input');

                function setSearchField(user_type){
                    user.value = user_type;

                    user.dispatchEvent(event);
                }

            </script>
            <?php
            if (isset($_POST["search"])) {
                $user = $_POST["user"];
                require_once("DB.php");

                if ($user == "student") {
                    echo ("<script>setSearchField('student');</script>");
                    $roll = $_POST["roll"];
                    $sql = "SELECT * FROM `student` WHERE `roll` = '{$roll}'";
                    $result = mysqli_query($conn, $sql) or die("Query failed!");
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $name = $row["name"];
                        $email = $row["email"];
                        $dept = $row["dept"];
                        $roll = $row["roll"];

                        ?>

                        <div class="form form-student">
                            <form action="edit-user.php" method="post" class="edit-student">
                                <h1>Edit Student Info</h1>
                                <div class="flex">
                                    <input type="hidden" name="user" value="student">
                                    <div class="set">
                                        <label>Name:</label>
                                        <input type="text" name="name" placeholder="Name" value="<?php echo ($name); ?>" required autocomplete="off">
                                    </div>
                                    <div class="set">
                                        <label>Email:</label>
                                        <input type="email" name="email" placeholder="Email" value="<?php echo ($email); ?>"
                                            required autocomplete="off">
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="set">
                                        <label>Department:</label>
                                        <input type="text" name="dept" placeholder="Department" value="<?php echo ($dept); ?>"
                                            required autocomplete="off">
                                    </div>
                                    <div class="set">
                                        <label>Roll number:</label>
                                        <input type="text" name="roll" placeholder="Roll number" value="<?php echo ($roll); ?>"
                                            readonly style="background: #ddd; cursor: not-allowed;">
                                    </div>
                                </div>
                                <button type="submit" class="btn-cancel" name="cancel" value="student">Cancel</button>
                                <button type="submit" name="submit" value="submit" class="btn-save"><i class="ri-checkbox-circle-line"></i> Save changes</button>
                                <button class="btn-delete" type="button" onclick="delete_this_user();"><i
                                        class="ri-delete-bin-line"></i> Delete
                                    account</button>
                                <div class="popup popup-delete">
                                    <div class="form">
                                        <span>Are you sure, you want to delete this account?</span>
                                        <div class="grid">
                                            <div class="flex">
                                                <button class="btn-d" type="submit" name="delete" value="delete"><i
                                                        class="ri-delete-bin-line"></i> Delete</button>
                                                <button class="btn-c" type="reset" onclick="hide_delete_screen()">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>

                    <?php } else {
                        echo ("<script>showInvalidToast();</script>");
                    }
                }
                if ($user == "faculty") {
                    echo ("<script>setSearchField('faculty');</script>");
                    $f_id = $_POST["f_id"];
                    $sql = "SELECT * FROM `faculty` WHERE `f_id` = '{$f_id}'";
                    $result = mysqli_query($conn, $sql) or die("Query failed!");
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $name = $row["name"];
                        $email = $row["email"];
                        $dept = $row["dept"];
                        $f_id = $row["f_id"];

                        ?>

                        <div class="form form-student">
                            <form action="edit-user.php" method="post" class="edit-student">
                                <h1>Edit Faculty Info</h1>
                                <div class="flex">
                                    <input type="hidden" name="user" value="faculty">
                                    <div class="set">
                                        <label>Name:</label>
                                        <input type="text" name="name" placeholder="Name" value="<?php echo ($name); ?>" required>
                                    </div>
                                    <div class="set">
                                        <label>Email:</label>
                                        <input type="email" name="email" placeholder="Email" value="<?php echo ($email); ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="set">
                                        <label>Department:</label>
                                        <input type="text" name="dept" placeholder="Department" value="<?php echo ($dept); ?>"
                                            required>
                                    </div>
                                    <div class="set">
                                        <label>Faculty ID:</label>
                                        <input type="text" name="f_id" placeholder="Faculty ID" value="<?php echo ($f_id); ?>"
                                            readonly style="background: #ddd; cursor: not-allowed;">
                                    </div>
                                </div>
                                <button type="submit" class="btn-cancel" name="cancel" value="faculty">Cancel</button>
                                <button type="submit" name="submit" value="submit" class="btn-save"><i
                                        class="ri-checkbox-circle-line"></i> Save
                                    changes</button>
                                <button class="btn-delete" type="button" onclick="delete_this_user();"><i
                                        class="ri-delete-bin-line"></i> Delete
                                    account</button>
                                <div class="popup popup-delete">
                                    <div class="form">
                                        <span>Are you sure, you want to delete this account?</span>
                                        <div class="grid">
                                            <div class="flex">
                                                <button class="btn-d" type="submit" name="delete" value="delete"><i
                                                        class="ri-delete-bin-line"></i> Delete</button>
                                                <button class="btn-c" type="reset" onclick="hide_delete_screen()">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                    <?php } else {
                        echo ("<script>showInvalidToast();</script>");
                    }
                }
                if ($user == "admin") {
                    echo ("<script>setSearchField('admin');</script>");
                    $user_id = $_POST["user_id"];
                    $sql = "SELECT * FROM `admin` WHERE `user_id` = '{$user_id}'";
                    $result = mysqli_query($conn, $sql) or die("Query failed!");
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $name = $row["name"];
                        $email = $row["email"];
                        $user_id = $row["user_id"];

                        ?>

                        <div class="form form-student">
                            <form action="edit-user.php" method="post" class="edit-student">
                                <h1>Edit Admin Info</h1>
                                <div class="flex">
                                    <input type="hidden" name="user" value="admin">
                                    <div class="set">
                                        <label>Name:</label>
                                        <input type="text" name="name" placeholder="Name" value="<?php echo ($name); ?>" required>
                                    </div>
                                    <div class="set">
                                        <label>Email:</label>
                                        <input type="email" name="email" placeholder="Email" value="<?php echo ($email); ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="set">
                                        <label>User ID:</label>
                                        <input type="text" name="user_id" placeholder="User ID" value="<?php echo ($user_id); ?>"
                                            readonly style="background: #ddd; cursor: not-allowed;">
                                    </div>
                                </div>
                                <button type="submit" class="btn-cancel" name="cancel" value="admin">Cancel</button>
                                <button type="submit" name="submit" value="submit" class="btn-save"><i
                                        class="ri-checkbox-circle-line"></i> Save
                                    changes</button>
                                <button class="btn-delete" type="button" onclick="delete_this_user();"><i
                                        class="ri-delete-bin-line"></i> Delete
                                    account</button>
                                <div class="popup popup-delete">
                                    <div class="form">
                                        <span>Are you sure, you want to delete this account?</span>
                                        <div class="grid">
                                            <div class="flex">
                                                <button class="btn-d" type="submit" name="delete" value="delete"><i
                                                        class="ri-delete-bin-line"></i> Delete</button>
                                                <button class="btn-c" type="reset" onclick="hide_delete_screen()">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    <?php } else {
                        echo ("<script>showInvalidToast();</script>");
                    }

                }
            }
            if (isset($_POST["submit"])) {
                $user = $_POST["user"];
                require_once("DB.php");

                if ($user == "student") {
                    $name = $_POST["name"];
                    $email = $_POST["email"];
                    $dept = $_POST["dept"];
                    $roll = $_POST["roll"];

                    $sql = "SELECT `roll` FROM `student` WHERE `email` = '{$email}'";
                    $res = mysqli_query($conn, $sql) or die("Query failed!");

                    $row = mysqli_fetch_assoc($res);

                    if ((mysqli_num_rows($res) > 0 and mysqli_num_rows($res)>0?$roll != $row["roll"]:0) ) {
                        echo ("<script>setSearchField('student');</script>");
                        echo ("<script>showEmailErrorToast();</script>");

                    } else {

                        $sql = "UPDATE `student` SET `name`='{$name}',`email`='{$email}',`dept`='{$dept}' WHERE `roll` = '{$roll}'";
                        $result = mysqli_query($conn, $sql) or die("Query failed!");
                        echo ("<script>setSearchField('student');</script>");
                        echo ("<script>showSuccessToast();</script>");
                    }
                }
                if ($user == "faculty") {
                    $name = $_POST["name"];
                    $email = $_POST["email"];
                    $dept = $_POST["dept"];
                    $f_id = $_POST["f_id"];

                    $sql = "SELECT `f_id` FROM `faculty` WHERE `email` = '{$email}'";
                    $res = mysqli_query($conn, $sql) or die("Query failed!");

                    $row = mysqli_fetch_assoc($res);

                    if ((mysqli_num_rows($res) > 0 and mysqli_num_rows($res)>0?$f_id != $row["f_id"]:0) ) {
                        echo ("<script>setSearchField('faculty');</script>");
                        echo ("<script>showEmailErrorToast();</script>");
                        
                    }else {
                        $sql = "UPDATE `faculty` SET `name`='{$name}',`email`='{$email}',`dept`='{$dept}' WHERE `f_id` = '{$f_id}'";
                        $result = mysqli_query($conn, $sql) or die("Query failed!");
                        echo ("<script>setSearchField('faculty');</script>");
                        echo ("<script>showSuccessToast();</script>");
                    }
                }
                if ($user == "admin") {
                    $name = $_POST["name"];
                    $email = $_POST["email"];
                    $user_id = $_POST["user_id"];

                    $sql = "SELECT `user_id` FROM `admin` WHERE `email` = '{$email}'";
                    $res = mysqli_query($conn, $sql) or die("Query failed!");

                    $row = mysqli_fetch_assoc($res);

                    if ((mysqli_num_rows($res) > 0 and mysqli_num_rows($res)>0?$user_id != $row["user_id"]:0) ) {
                        
                        echo ("<script>setSearchField('admin');</script>");
                        echo ("<script>showEmailErrorToast();</script>");
                        
                    }else {
                        $sql = "UPDATE `admin` SET `name`='{$name}',`email`='{$email}' WHERE `user_id` = '{$user_id}'";
                        $result = mysqli_query($conn, $sql) or die("Query failed!");
                        echo ("<script>setSearchField('admin');</script>");
                        echo ("<script>showSuccessToast();</script>");
                    }
                }

            }
            if(isset($_POST['cancel'])){
                $u = $_POST['cancel'];
                if($u == 'student'){
                    echo ("<script>setSearchField('student');</script>");
                }
                if($u == 'faculty'){
                    echo ("<script>setSearchField('faculty');</script>");
                }
                if($u == 'admin'){
                    echo ("<script>setSearchField('admin');</script>");
                }
            }
            if (isset($_POST["delete"])) {
                $user = $_POST["user"];
                require_once("DB.php");

                if ($user == "student") {
                    $roll = $_POST["roll"];
                    $sql = "DELETE FROM `student` WHERE `roll` = '{$roll}'";
                    $result = mysqli_query($conn, $sql) or die("Query failed!");
                    mysqli_close($conn);
                    echo ("<script>setSearchField('student');</script>");
                    echo ("<script>showDeletedToast();</script>");
                }
                if ($user == "faculty") {
                    $f_id = $_POST["f_id"];
                    $sql = "DELETE FROM `faculty` WHERE `f_id` = '{$f_id}'";
                    $result = mysqli_query($conn, $sql) or die("Query failed!");
                    mysqli_close($conn);
                    echo ("<script>setSearchField('faculty');</script>");
                    echo ("<script>showDeletedToast();</script>");
                }
                if ($user == "admin") {
                    $user_id = $_POST["user_id"];
                    $sql = "DELETE FROM `admin` WHERE `user_id` = '{$user_id}'";
                    $result = mysqli_query($conn, $sql) or die("Query failed!");
                    mysqli_close($conn);
                    echo ("<script>setSearchField('admin');</script>");
                    echo ("<script>showDeletedToast();</script>");
                }
            }
            ?>


        </div>

    </div>

</body>

</html>