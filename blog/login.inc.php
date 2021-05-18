<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';
require_once 'sendmail.php';

if(isset($_POST["submit"])){
    $username=$_POST["name"];
    $pwd=$_POST["password"];
    $block=userblocked($conn, $username);
    
    if(emptyInputlogin($username, $pwd) !== false)
    {
        header("location: log-in.php?error=envíovacío");
        exit();
    }

    loginUser($conn, $username, $pwd );


}

else if(isset($_POST['recoverpassword']))
{
    $email=$_POST['email'];

    if(userexists($conn, $email, $email)==false)
    {
        header("location: forgot-password.php?error=elemailnoseencuentra");
        exit();
    }
    else
    {
        $newpassword=randstring(10);
        replacepassword($conn, $email, $newpassword);
        mymailpwd($email, $newpassword);
        header("location: log-in.php?contraseñarecuperada");
        exit();

    }
}

else{
    header("location: log-in.php");
    exit();
}