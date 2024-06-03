<?php
    try{
        $conn = mysqli_connect("localhost","root","","lms") or die("Data base connection failed!");
    }catch(Exception $e){
        echo"Something went wrong!";
        die();
    }