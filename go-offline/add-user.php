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
  <title>Admin | Add user</title>
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
      overflow: hidden;
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

    .add-user {
      position: absolute;
      height: 100%;
      width: 85%;
      right: 5vw;
      bottom: 1vh;
      transition: bottom ease-in 0.3s;
      overflow: hidden;
    }

    .selection {
      width: fit-content;
      margin: 3rem 4rem;
    }

    .selection label {
      margin: 1rem;
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
      cursor: pointer;
      outline-color: lightseagreen;
    }
    .form{
      min-width: 27%;
    }
    .form form{
      padding: 2rem 4rem 2rem 2rem;
      border-radius: 10px;
      box-shadow: 1px 1px 5px rgba(0,0,0,0.3);
      display: flex;
      flex-direction: column;
      background: #fff;
      scale: .9;
    }

    .form form h1 {
      padding-bottom: 2rem;
    }

    .form form input {
      padding: .8rem 1rem;
      width: 100%;
      border-radius: 10px;
      box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
      font-size: .9rem;
      margin-bottom: 20px;
      outline-color: lightseagreen;
    }

    ::placeholder {
      font-size: 16px;
      letter-spacing: .5px;
      color: #333;
    }

    .form button {
      border-radius: 10px;
      box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
      padding: .6rem 1rem;
      font-size: 1.1rem;
      font-weight: 600;
      color: #fff;
      letter-spacing: .04rem;
      box-shadow: 1px 2px 5px gray;
      cursor: pointer;
      border: none;
      margin-top: 10px;
      margin-bottom: 10px;
      width: 112%;
      background: rgba(47, 166, 170, 0.814);
      transition: all ease-in-out 100ms;
    }

    .form button:hover {
      background-color: rgb(47, 166, 170);
      color: #fff;
    }

    .form-student {
      position: absolute;
      right: 15rem;
      top: -50rem;
      transition: top ease-in-out 200ms;
    }

    .image {
      width: 50%;
      height: 80%;
    }

    .form-faculty {
      position: absolute;
      right: -50rem;
      top: 3rem;
      transition: right ease 200ms;
    }

    .form-admin {
      position: absolute;
      bottom: -50rem;
      right: 15rem;
      transition: bottom ease 200ms;
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

    #active {
      background: #ddd;
      color: lightseagreen;
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
            <p id="active"><i class="ri ri-user-add-fill"></i><span>Add
                new user</span></p>
          </li>
          <li>
            <p onclick="window.location.href='edit-user.php'"><i class="fa fa-solid fa-user-pen fa-xs"></i><span>Edit
                user info</span></p>
          </li>
          <li>
            <p onclick="window.location.href='exam.php'"><i class="fa fa-solid fa-chalkboard-user fa-xs"></i><span>Exams
              </span></p>
          </li>
          <li>
            <p onclick="window.location.href='settings.php'"><i class="ri ri-settings-4-fill"></i><span>Settings</span>
            </p>
          </li>
        </ul>
        <div class="logout">
          <p onclick="window.location.href='logout.php'"><i class="ri ri-logout-box-r-line"></i><span>Logout</span></p>
        </div>

      </div>

    </div>

    <div class="add-user">
      <div class="selection">
        <label>Select user type:</label>
        <select name="user" id="user" class="user-select">
          <option value="student">Student</option>
          <option value="faculty">Faculty</option>
          <option value="admin">Admin</option>
        </select>
      </div>
      <img src="admin-asset/add user.webp" alt="" class="image">
      <div class="form form-student">
        <form action="add-user.php" method="post" class="add-new-student">
          <h1>Add new student</h1>
          <input type="hidden" name="user" value="student">
          <input type="text" name="name" placeholder="Name" required autocomplete="off">
          <input type="email" name="email" placeholder="Email" required autocomplete="off">
          <input type="text" name="dept" placeholder="Department" required autocomplete="off">
          <input type="text" name="roll" placeholder="Roll number" required autocomplete="off">
          <input type="password" name="pass" placeholder="Password" required>
          <button type="submit" name="submit" value="submit">Submit</button>
        </form>
      </div>
      <div class="form form-faculty">
        <form action="add-user.php" method="post" class="add-new-faculty">
          <h1>Add new faculty</h1>
          <input type="hidden" name="user" value="faculty">
          <input type="text" name="name" placeholder="Name" required autocomplete="off">
          <input type="email" name="email" placeholder="Email" required autocomplete="off">
          <input type="text" name="dept" placeholder="Department" required autocomplete="off">
          <input type="text" name="f_id" placeholder="Faculty ID" required autocomplete="off">
          <input type="password" name="pass" placeholder="Password" required>
          <button type="submit" name="submit" value="submit">Submit</button>
        </form>
      </div>
      <div class="form form-admin">
        <form action="add-user.php" method="post" class="add-new-admin">
          <h1>Add new admin</h1>
          <input type="hidden" name="user" value="admin">
          <input type="text" name="name" placeholder="Name" required autocomplete="off">
          <input type="email" name="email" placeholder="Email" required autocomplete="off">
          <input type="text" name="user_id" placeholder="User ID" required autocomplete="off">
          <input type="password" name="pass" placeholder="Password" required>
          <button type="submit" name="submit" value="submit">Submit</button>
        </form>
      </div>

    </div>


    <div class="toast">
      <i class="ri-checkbox-circle-fill checkbox"></i>
      <span>Success!</span>
    </div>
  </div>

  <script>
    var user = document.querySelector('#user');
    var student = document.querySelector('.form-student');
    var faculty = document.querySelector('.form-faculty');
    var admin = document.querySelector('.form-admin');
    const event = new Event('input');

    student.style.top = '3rem';
    var user_value = user.value;

    user.addEventListener('input', () => {
      user_value = user.value;
      if (user_value == "student") {
        faculty.style.right = '-50rem';
        admin.style.bottom = '-50rem';
        student.style.top = '3rem';
      }
      if (user_value == "faculty") {
        student.style.top = '-50rem';
        faculty.style.right = '15rem';
        admin.style.bottom = '-50rem';
      }
      if (user_value == "admin") {
        student.style.top = '-50rem';
        faculty.style.right = '-50rem';
        admin.style.bottom= '5rem';
      }

    })

    var toast = document.querySelector(".toast");

    function showSuccessToast() {
      setTimeout(() => {
        toast.style.right = '2vw';
      }, 100);
      setTimeout(() => {
        toast.style.right = ' -20vw';
      }, 1250);
    }

    function showFailToast() {
      setTimeout(() => {
        toast.style.borderColor = 'orange';
        toast.innerHTML = '<i class="ri-error-warning-fill checkbox"></i><span>User already exists!</span>';
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
  </script>

  <?php
  if (isset($_POST["submit"])) {

    $user = $_POST["user"];
    require_once("DB.php");

    if ($user == "student") {
      $name = $_POST["name"];
      $email = $_POST["email"];
      $dept = $_POST["dept"];
      $roll = $_POST["roll"];
      $pass = $_POST["pass"];

      $sql1 = "SELECT * FROM `student` WHERE email = '{$email}' OR roll = '{$roll}'";
      $result1 = mysqli_query($conn, $sql1) or die("Query failed!");
      if (mysqli_num_rows($result1) > 0) {
        mysqli_close($conn);
        echo ("<script>showFailToast();</script>");
      } else {
        $sql2 = "INSERT INTO `student`(`name`, `email`, `dept`, `roll`, `password`) VALUES ('{$name}','{$email}','{$dept}','{$roll}','{$pass}')";
        $result2 = mysqli_query($conn, $sql2) or die("Query failed!");
        mysqli_close($conn);
        echo ("<script>showSuccessToast();</script>");
      }

    }

    if ($user == "faculty") {
      $name = $_POST["name"];
      $email = $_POST["email"];
      $dept = $_POST["dept"];
      $f_id = $_POST["f_id"];
      $pass = $_POST["pass"];

      $sql1 = "SELECT * FROM `faculty` WHERE email = '{$email}' OR f_id = '{$f_id}'";
      $result1 = mysqli_query($conn, $sql1) or die("Query failed!");
      if (mysqli_num_rows($result1) > 0) {
        mysqli_close($conn);
        echo ("<script>user.value = 'faculty'; user.dispatchEvent(event);</script>");
        echo ("<script>showFailToast();</script>");

      } else {
        $sql2 = "INSERT INTO `faculty`(`name`, `email`, `dept`, `f_id`, `password`) VALUES ('{$name}','{$email}','{$dept}','{$f_id}','{$pass}')";
        $result2 = mysqli_query($conn, $sql2) or die("Query failed!");
        mysqli_close($conn);
        echo ("<script>user.value = 'faculty'; user.dispatchEvent(event);</script>");
        echo ("<script>showSuccessToast();</script>");
      }

    }

    if ($user == "admin") {
      $name = $_POST["name"];
      $email = $_POST["email"];
      $user_id = $_POST["user_id"];
      $pass = $_POST["pass"];

      $sql1 = "SELECT * FROM `admin` WHERE user_id = '{$user_id}' OR email = '{$email}'";
      $result1 = mysqli_query($conn, $sql1) or die("Query failed!");
      if (mysqli_num_rows($result1) > 0) {
        mysqli_close($conn);
        echo ("<script>user.value = 'admin'; user.dispatchEvent(event);</script>");
        echo ("<script>showFailToast();</script>");
      } else {
        $sql2 = "INSERT INTO `admin`(`name`, `email`, `user_id`, `password`) VALUES ('{$name}','{$email}','{$user_id}','{$pass}')";
        $result2 = mysqli_query($conn, $sql2) or die("Query failed!");
        mysqli_close($conn);
        echo ("<script>user.value = 'admin'; user.dispatchEvent(event);</script>");
        echo ("<script>showSuccessToast();</script>");
      }

    }


  }
  ?>

</body>

</html>