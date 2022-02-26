<?php
session_start()
?>


<?php
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(isset($_POST['submit']))
{
    $title=$_POST['title'];

    $textint=invalidtitletext($title, $conn);

    if($textint !== false)
    {
        deletetext($conn, $title);    
    }
    else
    {
        header('location: textos2.php?error=nombredeltextoesinválido');
        exit();
    }
}

if(isset($_POST['submitdeletevideo']))
{
    $title=$_POST['title'];
    deletevideo($conn, $title);
  
}


else{
    echo 'error';
}


