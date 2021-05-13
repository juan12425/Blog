<?php 
session_start();

require_once "dbh.inc.php";
require_once "functions.inc.php";


if(isset($_POST["submit"]))
{
    $olduser=$_SESSION["users_name"];
    $user=$_POST["user"];
    $name=$_POST["name"];
    $rol=$_POST["Rol"];

    if(empty($user) ||  empty($name) || empty($rol))
    {
        header("location: profile.php?error=camposvacíos");
        exit();
    }
    
    
    if( userexists($conn, $user, $user) !== false)
    {
        header("location: profile.php?error=nombredeusuarioyaexiste");
        exit();
    }
    else
    {
        updateuserinfo($conn,$olduser, $user, $name, $rol);
    }
   
}

if(isset($_POST["editrange"]))
{
    $email=$_POST["email"];
    $range=$_POST["range"];

    echo $email;
    echo $range;

    changerange($conn, $range, $email);
}

if(isset($_POST["emergency"]))
{
    riot($conn);
}