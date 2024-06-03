<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lmsshiksha</title>
  <link rel="shortcut icon" href="asset/graduation-cap-fill.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,300&display=swap');

    * {
      padding: 0;
      margin: 0;
      text-decoration: none;
      font-family: 'Nunito Sans', sans-serif;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      height: 100vh;
      width: 100%;
    }

    nav {
      position: sticky;
      top: 0;
      z-index: 10;
      background: #fff;
      display: flex;
      padding: 20px 20px;
      justify-content: space-between;
    }

    nav a {
      color: black;
      font-size: 18px;
      font-weight: 600;
      letter-spacing: .05rem;
      padding: 8px 10px;
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

    .main {
      position: relative;
      width: 100%;
      height: 90%;
      display: flex;
      overflow: hidden;
      padding-top: 1rem;
    }

    .main img {
      margin-top: 2rem;
      height: 80%;
      width: 58%;
      scale: .95;
    }

    .main h2 {
      font-size: 27px;
    }

    .words {
      position: absolute;
      top: 10vh;
      right: 1vw;
      width: 50%;
    }

    .words p {
      padding: 15px 20px 0 5px;
    }

    .login-popup {
      position: absolute;
      background: rgba(0, 0, 0, 0.3);
      backdrop-filter: blur(1px);
      height: 95%;
      width: 38%;
      top: -1rem;
      margin-top: 1.5rem;
      right: -50vw;
      border-radius: 5px;
      transition: right ease 200ms;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .form {
      position: relative;
      display: flex;
      background: white;
      height: 80%;
      width: 55%;
      padding: 0 20px;
      border-radius: 5px;
      box-shadow: 1px 2px 5px gray;
    }

    .form input {
      width: 80%;
      padding: 15px;
      margin: 10px 20px;
      font-size: 15px;
      border-radius: 5px;
      border: none;
      box-shadow: 1px 2px 5px gray;
      outline-color: rgb(47, 166, 170);
    }

    .form select {
      width: 89%;
      padding: 10px 10px;
      margin: 10px 20px;
      font-size: 17px;
      border-radius: 5px;
      border: none;
      box-shadow: 1px 2px 5px gray;
      outline-color: rgb(47, 166, 170);
    }

    .form input::placeholder {
      color: black;
      letter-spacing: .04rem;
    }

    .form h1 {
      margin: 25px 39%;

    }

    .form button {
      padding: 10px 39%;
      margin: 30px 20px;
      border: none;
      font-size: 15px;
      font-weight: 600;
      color: #fff;
      letter-spacing: .04rem;
      box-shadow: 1px 2px 5px gray;
      cursor: pointer;
      background-color: rgb(47, 166, 170);
    }

    .form button:hover {
      background-color: rgb(114, 195, 198);
    }

    .login-popup .close {
      position: absolute;
      top: 5%;
      right: 5%;
      padding: 5px;
      border: none;
      border-radius: 50%;
      font-size: 30px;
      cursor: pointer;
      color: #fff;
    }

    .login-popup .close:hover {
      color: #d3d3e8;
    }

    .toast {
      position: absolute;
      height: 2rem;
      top: 0;
      right: -50vw;
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

    .footer{
      padding: 2rem 2rem;
      background: #111;
      color: #ddd;
    
    }

    .footer .top-section{
      display: flex;
      justify-content: space-evenly;
      margin-bottom: 3rem;
      margin-left: -4rem;
    }
    .top-section .about-project p{
      margin-top: 10px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .top-section .about-project b{
      font-size: 1.2rem;
      color: #ddd;
    }
    .top-section .about-project span{
      padding: 2px 10px;
      border-radius: 5px;
      background: #ddd;
      color: #111;
      font-size: 13px;
      font-weight: 600;
      box-shadow: 0px 0px 3px white;
    }

    .socials ul {
      list-style: none;
      gap: 20px;
      display: flex;
      justify-content: space-around;
    }

    .footer .socials i {
      color: #000;
      font-size: 1.5rem;
      padding: 6px;
      border-radius: 50%;
      background: #ddd;
      cursor: pointer;
    }
    
    .footer .section-info {
      max-width: 25%;
    }

    .footer .section-info h3 {
      text-align: center;
      margin-bottom: 15px;
    }
    .socials h3 {
      text-align: center;
      padding-bottom: 2rem;
    }
    .footer .section-info ul {
      list-style: none;
      line-height: 2;
    }

    .info-2 i {
      color: #000;
      padding: 3px;
      border-radius: 50%;
      background: #ddd;
      font-size: 1.1rem;
      margin-right: 5px;
    }
   
    .section-copyright{
      margin-top: 1rem;
      display: flex;
      justify-content: center;
    }
    .section-copyright h4{
      text-align: center;
      width: fit-content;
    }
    .section-copyright h4::after{
      content: '';
      display: grid;
      height: 1px;
      width: 30vw;
      margin-top: 3px;
      background: #dadada;
    }
    .socials i:hover{
      background: yellowgreen;
    }
    .something-went-wrong-popup{
      position: fixed;
      z-index: 40;
      bottom: 0;
      left: 0;
      height: 100vh;
      width: 100%;
      background: rgba(0,0,0,0.6);
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .something-went-wrong-msg{
      padding: 15px 30px 25px 20px;
      border-radius: 10px;
      background: #fff;
    }
    .something-went-wrong-msg h3{
      color: red;
      letter-spacing: 1px;
      margin-bottom: 5px;
    }
    .something-went-wrong-msg span{
      padding-left: 2px;
      color: red;
    }
    .something-went-wrong-msg .close{
      float: right;
      margin-right: -22px;
      margin-top: -6px;
      font-size: 18px;
      cursor: pointer;
    }
    .login-popup .form .pass-show-hide{
      position: absolute;
      right: 3rem;
      margin-top: -2.8rem;
      cursor: pointer;
      font-size: 1.2rem;
    }
    .login-popup .form .pass-show-hide:hover{
      color: gray;
    }

  </style>
</head>

<body>
  <nav>
    <div class="logo"><a href="./"><i class="ri-graduation-cap-fill"></i> Lmsshiksha</a></div>
    <div class="links">
      <a onclick="scrollToAbout()">About</a>
      <?php if (isset($_SESSION['student'])) {
        echo '<a href="./student"><i class="ri-dashboard-3-line"></i> Dashboard</a>';
        echo '<a href="logout.php">Logout <i class="ri-logout-box-r-line"></i></a>';
      } else if (isset($_SESSION['faculty'])) {
        echo '<a href="./faculty"><i class="ri-dashboard-3-line"></i> Dashboard</a>';
        echo '<a href="logout.php">Logout <i class="ri-logout-box-r-line"></i></a>';
      } else {
        echo '<a class="login-btn">Login <i class="ri-login-box-line"></i></i></a>';
      }
      ?>
    </div>
  </nav>
  <div class="main">
    <img src="asset/landing.webp" alt="">
    <div class="words">
      <span style="display: flex; gap:10px; align-items:center; ">
        <h2 style="font-weight: 300;">Welcome to</h2>
        <h1 style="font-weight: 500; font-size: 38px; color: lightseagreen;">Lmsshiksha</h1>
      </span>
      <h2 style="font-weight: 300; font-size: 20px; margin-left: 5px;">A Learning Management System</h2>
      <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptates dolorum nostrum officiis eius iure sit
        animi quam veritatis dolore iste hic sapiente, necessitatibus facilis quisquam illo molestiae quis modi culpa.
        <a href="./go-offline" style="color:lightseagreen">Admin Login</a>
      </p>
    </div>
    <div class="login-popup">
      <div class="form">
        <form action="./" method="post">
          <h1>Login</h1>
          <select name="user">
            <option value="student">Student</option>
            <option value="faculty">Faculty</option>
          </select>
          <input type="email" name="email" placeholder="Email" required autocomplete="off">
          <input type="password" name="pass" placeholder="Password" id="pass" required autocomplete="off">
          <i class="ri-eye-off-line pass-show-hide eye-closed"></i>
          <button type="submit" name="submit" value="submit">Login</button>
        </form>
      </div>
      <i class="ri-close-line close"></i>
    </div>
    <div class="toast">
      <i class="ri-checkbox-circle-fill checkbox"></i>
      <span>Logout successful!</span>
    </div>
  </div>

  <div class="footer" id="about">
    <div class="top-section">
      <div class="section-info about-project">
        <h3>About Project</h3>
        <p>This project is developed using web technology. Lmsshiksha
          provides students and faculties an easy environment of online learning by it's
          user friendly interface. It contains several dashboards for respective
          users to manage their works.</p>
          <p><b>Tools: </b><span>HTML</span><span>CSS</span><span>JavaScript</span><span>PHP</span><span>MySQL</span></p>
      </div>
      <hr>
      <div class="section-info socials">
        <h3>Socials</h3>
        <ul>
          <li><a onclick="window.open('https://www.linkedin.com/in/krishnendu-mondal-627238211', '_blank').focus()"><i class="ri-linkedin-fill"></i></a></li>
          <li><a onclick="window.open('https://www.github.com/krishnendu-mondal', '_blank').focus()"><i class="ri-github-fill"></i></a></li>
          <li><a onclick="window.open('https://www.facebook.com/krishnendu.mondol.716', '_blank').focus()"><i class="ri-facebook-fill"></i></a></li>
        </ul>
      </div>
      <hr>
      <div class="section-info info-2">
        <h3>Developer info</h3>
        <ul>
          <li><i class="ri-user-3-line"></i><span> Krishnendu Mondal</span></li>
          <li><i class="ri-map-pin-line"></i><span> Naihati, West Bengal.</span></li>
          <li><i class="ri-community-line"></i><span> JIS College of Engineering, Kalyani</span></li>
          <li><i class="ri-mail-line"></i><span> krishnendu2002m@gmail.com</span></li>
        </ul>
      </div>
    </div>
    <hr>
    <div class="section-copyright">
      <p>
        @ 2024 Lmsshiksha, All rights reserved.
      </p>
    </div>
  </div>

  <script>
    var loginBtn = document.querySelector(".login-btn");
    var loginPopup = document.querySelector(".login-popup");
    var cross = document.querySelector(".login-popup .close");
    var passEye = document.querySelector(".login-popup .pass-show-hide");
    var pass = document.querySelector(".login-popup #pass");
    var toast = document.querySelector(".toast");
    var loginPopupState = 0;
    if (loginBtn != null) {
      loginBtn.addEventListener('click', () => {
        if (!loginPopupState) {
          loginPopup.style.right = 0;
          pass.type = "password";
          passEye.className = "ri-eye-off-line pass-show-hide eye-closed";
          loginPopupState = 1;
          if(document.documentElement.scrollHeight > 0){
            document.documentElement.scrollTop = 0;
          }
        } else {
          loginPopup.style.right = "-50vw";
          pass.type = "password";
          passEye.className = "ri-eye-off-line pass-show-hide eye-closed";
          loginPopupState = 0;
        }

      })
    }

    passEye.addEventListener('click', () => {
      if(passEye.className == "ri-eye-off-line pass-show-hide eye-closed"){
        pass.type = "text";
        passEye.className = "ri-eye-fill pass-show-hide eye-open";
      }else{
        pass.type = "password";
        passEye.className = "ri-eye-off-line pass-show-hide eye-closed";
      }

    })

    cross.addEventListener('click', () => {
      loginPopup.style.right = "-50vw";
      loginPopupState = 0;
    })

    function showLogoutSuccessToast() {
      toast.style.right = '2vw';
      setTimeout(() => {
        toast.style.right = ' -50vw';
      }, 1000);
      setTimeout(() => {
        window.location.href = './';
      }, 1500);

    }
    function showLoginSuccessToast() {
      toast.innerHTML = '<i class="ri-checkbox-circle-fill checkbox"></i><span>Login successful!</span>';
      toast.style.right = '2vw';
      setTimeout(() => {
        toast.style.right = '-50vw';
      }, 1000);

    }

    function showLoginFailToast() {
      setTimeout(() => {
        toast.style.borderColor = 'red';
        toast.innerHTML = '<i class="ri-error-warning-fill checkbox"></i><span>Invalid email or password!</span>';
        let icon = toast.firstElementChild;
        let txt = toast.lastElementChild;
        icon.style.color = 'red';
        txt.style.color = 'red';
        toast.style.right = '2vw';
      }, 100);

      setTimeout(() => {
        toast.style.right = '-50vw';
      }, 2000);

      setTimeout(() => {
        window.location.href = './';
      }, 2500);
    }


    document.addEventListener('scroll', () => {
      let currentScroll = window.scrollY;
      let nav = document.querySelector('nav');
      if (currentScroll < 10) {
        nav.style.borderBottom = 'none';
      } else {
        nav.style.borderBottom = '1px solid #dadada';
      }
    })

    function scrollToAbout(){
      loginPopup.style.right = "-50vw";
      loginPopupState = 0;
      document.documentElement.scrollTop = document.documentElement.scrollHeight;
    }

    function hideErrorPopup(){
      document.querySelector(".something-went-wrong-popup").style.display='none';
    }
  </script>
  <?php
  if (isset($_POST["submit"])) {
    require_once("DB.php");

    $user = $_POST["user"];
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $pass = mysqli_real_escape_string($conn, $_POST["pass"]);

    if ($user == "student") {
      $sql = "SELECT * FROM `student` WHERE `email` = '{$email}'";
      $result = mysqli_query($conn, $sql) or die("Query failed!");
      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($pass == $row["password"]) {
          $_SESSION["student"] = "student";
          $_SESSION["student_name"] = $row["name"];
          $_SESSION["student_email"] = $row["email"];
          $_SESSION["student_roll"] = $row["roll"];
          $_SESSION["student_dept"] = $row["dept"];
          mysqli_close($conn);
          echo "<script>setTimeout('showLoginSuccessToast()',100); setTimeout(()=>{window.location.href = './student'},1500);</script>";
        } else {
          mysqli_close($conn);
          echo '<script>showLoginFailToast()</script>';
        }
      } else {
        mysqli_close($conn);
        echo '<script>showLoginFailToast()</script>';
      }
    }
    if ($user == "faculty") {
      $sql = "SELECT * FROM `faculty` WHERE `email` = '{$email}'";
      $result = mysqli_query($conn, $sql) or die("Query failed!");
      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($pass == $row["password"]) {
          $_SESSION["faculty"] = "faculty";
          $_SESSION["faculty_name"] = $row["name"];
          $_SESSION["faculty_email"] = $row["email"];
          $_SESSION["faculty_id"] = $row["f_id"];
          $_SESSION["faculty_dept"] = $row["dept"];
          mysqli_close($conn);
          echo "<script>setTimeout('showLoginSuccessToast()',100); setTimeout(()=>{window.location.href = './faculty'},1500);</script>";
        } else {
          mysqli_close($conn);
          echo '<script>showLoginFailToast()</script>';
        }
      } else {
        mysqli_close($conn);
        echo '<script>showLoginFailToast()</script>';
      }
    }
  }

  if (isset($_GET["logout"])) {
    echo '<script>setTimeout("showLogoutSuccessToast()", 200);</script>';
  }
  ?>
</body>

</html>