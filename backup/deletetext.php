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
else{
    echo 'error';
}