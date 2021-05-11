<?php

if(isset($_POST["submit"])){
    $username=$_POST["name"];
    $pwd=$_POST["password"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';


    if(emptyInputlogin($username, $pwd) !== false){
        header("location: log-in.php?error=envíovacío");
        exit();
    }

    loginUser($conn, $username, $pwd );


}
else{
    header("location: log-in.php");
    exit();
}