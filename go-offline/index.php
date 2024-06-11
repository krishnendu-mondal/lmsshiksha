<?php
session_start();
if (isset($_SESSION['admin'])) {
  header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin | Panel</title>
  <link rel="icon" type="image/x-icon" href="admin-asset/graduation-cap-fill.png">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,300&display=swap');

    * {
      padding: 0;
      margin: 0;
      text-decoration: none;
      font-family: 'Nunito Sans', sans-serif;
    }

    body {
      height: 100vh;
      width: 100%;
    }

    nav {
      display: flex;
      padding: 20px 20px;
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

    .main {
      position: relative;
      width: 100%;
      height: 85%;
      margin-top: 10px;
      overflow: hidden;
      display: flex;
    }

    .form {
      position: absolute;
      right: 35%;
      background: rgba(255, 255, 255, 0.6);
      height: 60vh;
      width: 22%;
      padding: 0 20px;
      border-radius: 5px;
      box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.3);
      margin-top: 100px;
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

    .form input::placeholder {
      color: black;
      letter-spacing: .04rem;
    }

    .form h1 {
      padding: 70px 35% 30px 35%;
    }

    .form button {
      padding: 10px 39%;
      margin: 40px 20px;
      border: none;
      font-size: 15px;
      font-weight: 600;
      color: #fff;
      letter-spacing: .04rem;
      box-shadow: 1px 2px 5px gray;
      cursor: pointer;
      background-color: rgba(47, 166, 170, 0.862);
    }

    .form button:hover {
      background-color: rgb(47, 166, 170);
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
      scale: .9;
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

    .admin-login-img {
      position: absolute;
      height: 85%;
      width: 35%;
      left: 1.4rem;
      bottom: 2rem;
    }

    .admin-logo {
      height: 100px;
      width: 100xp;
      position: absolute;
      top: -2rem;
      right: 38%;
      border-radius: 50%;
      box-shadow: 1px -3px 10px rgba(0, 0, 0, 0.3);
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
    .form .pass-show-hide{
      position: absolute;
      right: 3rem;
      margin-top: -2.8rem;
      cursor: pointer;
      font-size: 1.2rem;
      display: none;
    }
    .form .pass-show-hide:hover{
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

  <div class="main">
    <img src="admin-asset/10215531.webp" alt="" class="admin-login-img">
    <div class="form">
      <img src="admin-asset/admin.webp" alt="" class="admin-logo">
      <form action="./" method="post">
        <h1>Admin</h1>
        <input type="text" name="user_id" placeholder="User ID" required autocomplete="off"> 
        <input type="password" name="pass" id="pass" placeholder="Password" required autocomplete="off">
        <i class="ri-eye-off-line pass-show-hide eye-closed"></i>
        <button type="submit" name="submit" value="submit">Login</button>
      </form>
    </div>
    <div class="toast">
      <i class="ri-checkbox-circle-fill checkbox"></i>
      <span>Logout successful!</span>
    </div>
  </div>

  <script>
    var toast = document.querySelector(".toast");
    var passEye = document.querySelector(".pass-show-hide");
    var pass = document.querySelector("#pass");

    function showLogoutSuccessToast() {
      toast.style.right = '2vw';
      setTimeout(() => {
        toast.style.right = ' -20vw';
      }, 1000);
      setTimeout(() => {
        window.location.href = './';
      }, 1500);

    }
    function showLoginSuccessToast() {
      toast.innerHTML = '<i class="ri-checkbox-circle-fill checkbox"></i><span>Login successful!</span>';
      toast.style.right = '2vw';
      setTimeout(() => {
        toast.style.right = '-20vw';
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
        toast.style.right = '-20vw';
      }, 2000);
    }

    function hideErrorPopup(){
      document.querySelector(".something-went-wrong-popup").style.display='none';
    }

    pass.addEventListener(('input'), ()=>{
      if(pass.value.length > 0){
          passEye.style.display="inline-block";
      }else{
          passEye.style.display="none";
      }
    })

    passEye.addEventListener('click', () => {
      if(passEye.className == "ri-eye-off-line pass-show-hide eye-closed"){
        pass.type = "text";
        passEye.className = "ri-eye-fill pass-show-hide eye-open";
      }else{
        pass.type = "password";
        passEye.className = "ri-eye-off-line pass-show-hide eye-closed";
      }
    })
  </script>

  <?php
  if (isset($_POST["submit"])) {
    require_once("DB.php");

    $user_id = mysqli_real_escape_string($conn, $_POST["user_id"]);
    $pass = mysqli_real_escape_string($conn, $_POST["pass"]);

    $sql = "SELECT * FROM `admin` WHERE user_id = '{$user_id}' AND password = '{$pass}'";

    $result = mysqli_query($conn, $sql) or die("Query failed!");
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
      $_SESSION['admin'] = 'admin';
      $_SESSION['admin_user_id'] = $user_id;
      $_SESSION['admin_name'] = $row['name'];
      $_SESSION['admin_email'] = $row['email'];
      echo "<script>setTimeout('showLoginSuccessToast()',100); setTimeout(()=>{window.location.href = 'dashboard.php'},1500);</script>";

    } else {
      echo "<script>showLoginFailToast();</script>";
    }

  }
  if (isset($_GET["logout"])) {
    echo '<script>setTimeout("showLogoutSuccessToast()", 200);</script>';
  }

  ?>

</body>

</html>