<?php
session_start()
?>
<?php 
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(isset($_POST["submit"]))
{
    $date=$_POST["bandate"];
    $reason=$_POST["reason"];
    $user=$_GET["name"];
    $currentdate=date("Y-m-d");
    $responsable=$_SESSION["users_name"];
    $email=$_GET["email"];

    $datearray=explode("-", $date);
    $datecarray=explode("-", $currentdate);


    if(($datearray[0] > $datecarray[0]) || (($datearray[0] == $datecarray[0]) & (($datearray[1] > $datecarray[1]) || (($datearray[1] == $datecarray[1]) &  ($datearray[2] > $datecarray[1])))))
    {
        blockuser($conn, $user, $date, $currentdate, $reason, $responsable, $email);
    }
    else
    {
        echo"Error";
    }

    
}

if(isset($_POST["unblock"]))
{
    
    $username=$_GET["username"];

    if(checkuserblocked($conn, $username)==true)
    {
        unblockuser($conn, $username);
        header("location: index.php?error=none");
        exit();
    }
    else
    {
        header("location: index.php?");
        exit();
    }

    
}

