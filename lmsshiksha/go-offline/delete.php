<?php
    if(!isset($_POST['account'])){
        http_response_code(404);
        die();
    }
        
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lmsshiksha</title>
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
            font-family: 'Nunito Sans', sans-serif;
        }

        body {
            height: 100vh;
            width: 100%;
        }

        .container {
            height: 100vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: start;
        }

        .flex {
            display: flex;
            align-items: center;
            margin-bottom: 1vh;
        }
        .grid{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            height: 5vw;
        }

        .delete {
            margin-top: 25vh;
            padding: 2vw 3vw;
            background: #ffffff;
            border-radius: 5px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
        }

        .delete i {
            font-size: 2.3vw;
            margin-right: 2px;
            color: rgb(0, 200, 0);
            /* color: royalblue; */
        }
        .delete h2{
            color: rgb(0,190,0);
            /* color: royalblue; */
        }
        .delete p{
            font-size: 1.1vw;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="delete">
            <div class="flex">
                <i class="ri-checkbox-circle-line"></i>
                <h2>Success! Your account is deleted</h2>
            </div>
            <div class="grid">
                <p>You can close this tab</p>
                <p>OR</p>
                <p>Redirecting to home page in <span class="time">6</span> seconds</p>
            </div>
        </div>
    </div>

    <script>
        var sp = document.querySelector('.time');
        var t = 5;
        setInterval(()=>{
            sp.innerText=t;
            t -= 1;
            if(t < 0){
                window.location.href='./';
            }
        },1000);
    </script>
</body>

</html>