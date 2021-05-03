<?php
if(isset($_POST["submit"])) 
{
    $name=$_POST["name"];
    $email=$_POST["email"];
    $username=$_POST["user"];
    $password=$_POST["password"];
    $rpassword=$_POST["rpassword"];

    require_once "dbh.inc.php";
    require_once "functions.inc.php";


    if(emptyInputSignup($name, $email, $username, $password,  $rpassword) !== false){
        header("location: sign-up.php?error=envíovacío");
        exit();
    }


    if(inavaliduser($username) !== false){
        header("location: sign-up.php?error=nombreinválido");
        exit();
    }

    if(invalidemail($email) !== false){
        header("location: sign-up.php?error=emailinválido");
        exit();
    }

    if(pwdMatch($rpassword, $password) !== false){
        header("location: sign-up.php?error=contraseñasnosoniguales");
        exit();
    }

    if(userexists($conn, $username, $email) !== false){
        header("location: sign-up.php?error=nombredeusuarioyaexiste");
        exit();
    }

    createUser($conn, $name, $email, $username, $rpassword);


    }

else{
    header("location: sign-up.php");
}