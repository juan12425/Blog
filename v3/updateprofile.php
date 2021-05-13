<?php 
session_start();

if(isset($_POST["submit"]))
{
    $olduser=$_SESSION["users_name"];
    $user=$_POST["user"];
    $name=$_POST["name"];
    $rol=$_POST["Rol"];

    require_once "dbh.inc.php";
    require_once "functions.inc.php";

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