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
  <title>Admin | Dashboard</title>
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
            <p id="active"><i class="ri ri-shield-user-fill"></i><span>
                <?php echo $_SESSION["admin_user_id"] ?>
              </span></p>
          </li>
          <li>
            <p onclick="window.location.href='add-user.php'"><i class="ri ri-user-add-fill"></i><span>Add
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

    <div class="admin-info">
      <span>Welcome,
        <?php echo $_SESSION["admin_name"] ?>
      </span>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit repellendus mollitia consectetur dolore iste,
        suscipit aperiam voluptatum minima dicta in ipsam atque explicabo temporibus unde laboriosam quam dolorum
        necessitatibus magni!</p>
      <img src="admin-asset/5351347.webp" alt="">
    </div>
  </div>

</body>

</html>