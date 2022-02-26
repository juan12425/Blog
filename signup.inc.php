<?php

require_once "dbh.inc.php";
require_once "functions.inc.php";

if(isset($_POST["submit"])) 
{
    $name=$_POST["name"];
    $email=$_POST["email"];
    $username=$_POST["user"];
    $password=$_POST["password"];
    $rpassword=$_POST["rpassword"];



    if(emptyInputSignup($name, $email, $username, $password,  $rpassword) !== false){
        header("location: sign-up.php?normal&error=envíovacío");
        exit();
    }


    if(inavaliduser($username) !== false){
        header("location: sign-up.php?normal&error=nombreinválido");
        exit();
    }

    if(invalidemail($email) !== false){
        header("location: sign-up.php?normal&error=emailinválido");
        exit();
    }

    if(pwdMatch($rpassword, $password) !== false){
        header("location: sign-up.php?normal&error=contraseñasnosoniguales");
        exit();
    }

    if(strlen($password)<6)
    {
        header("location: sign-up.php?normal&error=contraseñamuycorta");
        exit();
    }

    if(userexists($conn, $username, $email) !== false){
        header("location: sign-up.php?normal&error=nombredeusuarioyaexiste");
        exit();
    }


    createUser($conn, $name, $email, $username, $rpassword);


}

else if(isset($_POST["sendcode"]))
{
    $code=$_POST["code"];
    $email=$_GET["email"];

    
    if(checkcodeu($conn, $code, $email) == true)
    {
        confirmcode($conn, $code, $email);
        header("location: log-in.php?validcode");
        exit();
    }
    
    if(checkcodeu($conn, $code, $email) == false)
    {
        header("location: sign-up.php?error=códigoinválido&code&email=".$email);
        exit();
    }

}

else{
    header("location: sign-up.php?normal");
}