<?php
session_start()
?>

<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';



if(isset($_POST['submit']))
{
    $imgname=getimgname($_SESSION["users_name"], $conn);
    $path='files/'.$imgname;
    if(!unlink($path))
    {
        echo"Ha sucedido un error.";
    }
    else{
        $filename='NULL';
        unsetset($conn,  $filename , $_SESSION["users_name"]);
        header('location: profile.php?error=none');
        exit();
    }
}

if(isset($_POST['deleteslide']))
{
    $id=$_POST["id"];
    $result=getimgnameslide($conn, $id);
    $imgname=$result['img_name'];
    $path='slides/'.$imgname;
    if(!unlink($path))
    {
        echo"Ha sucedido un error.";
    }
    else{
        deleteslidefromdb($conn,  $id);
        header('location: novedades.php?error=none');
        exit();
    }
}

