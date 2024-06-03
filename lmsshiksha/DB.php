<?php
    try{
        $conn = mysqli_connect("localhost","root","","lms") or die("Data base connection failed!");
    }catch(Exception $e){
        echo"<div class='something-went-wrong-popup'><div class='something-went-wrong-msg'><i class='close ri-close-line' onclick='hideErrorPopup()'></i><h3>Error</h3><span><i class='ri-error-warning-line'></i> Something went wrong!</span></div></div>";
        die();
    }