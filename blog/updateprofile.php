<?php 
session_start();

require_once "dbh.inc.php";
require_once "functions.inc.php";


if(isset($_POST["submitnewname"]))
{
    $user=$_SESSION["users_name"];
    $name=$_POST["name"];
    

    if( empty($name) )
    {
        header("location: profile.php?error=nombrevacío");
        exit();
    }
    
    updatenameuser($conn,$user, $name);
    header("location: profile.php?error=none");
    exit();
    
}

if(isset($_POST["submitnewpassword"]))
{
    $user=$_SESSION["users_name"];
    $password=$_POST["password"];
    $rpassword=$_POST["rpassword"];

    
    
    if(empty($password) || empty($rpassword))
    {
        header("location: profile.php?error=contraseñasvacias");
        exit();
    }
    
    if($password !== $rpassword)
    {
        header("location: profile.php?error=contraseñasdistintas");
        exit();
    }

    if(strlen($password)<6)
    {
        header("location: profile.php?error=contraseñamuycorta");
        exit();
    }
    
    
    updatepassworduser($conn,$user, $password);
    header("location: profile.php?error=none");
    exit();
    
}

if(isset($_POST['submitrole']))
{
    $user=$_SESSION["users_name"];
    $role=$_POST["role"];
    updateroleuser($conn,$user, $role);
    header("location: profile.php?error=none");
    exit();
}



if(isset($_POST["editrange"]))
{
    $email=$_POST["email"];
    $range=$_POST["range"];

    changerange($conn, $range, $email);
}

if(isset($_POST["emergency"]))
{
    riot($conn);
}