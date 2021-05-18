<?php
session_start()
?>

<?php
require_once "dbh.inc.php";
require_once "functions.inc.php";

if(isset($_POST['submit']))
{
    $title=$_POST["title"];
    $description=$_POST["description"];
    if(empty($title) || empty($description))
    {
        header("location: createtopic.php?error=camposvacios");
        exit();
    }
    if(checktitle($conn, $title)!==false)
    {
        header("location: createtopic.php?error=títuloinválido");
        exit();
    }
    createtopic($conn, $title, $description);
}

if(isset($_POST['submitedit']))
{
    $title=$_POST["title"];
    $description=$_POST["description"];
    if(empty($title) || empty($description))
    {
        header("location: createtopic.php?error=camposvacios");
        exit();
    }
    if(checktitle($conn, $title)==false)
    {
        header("location: createtopic.php?error=títulonoseencuentra");
        exit();
    }
    updatetopic($conn, $title, $description);
}


if(isset($_POST['submitedittitle']))
{
    $oldtitle=$_POST["oldtitle"];
    $newtitle=$_POST["newtitle"];
    if(empty($oldtitle) || empty($newtitle))
    {
        header("location: createtopic.php?error=camposvacios");
        exit();
    }
    if(checktitle($conn, $oldtitle)==false)
    {
        header("location: createtopic.php?error=títulonoseencuentra");
        exit();
    }
    if(checktitle($conn, $newtitle)!==false)
    {
        header("location: createtopic.php?error=títuloinválido");
        exit();
    }
    updatetopictitle($conn, $newtitle, $oldtitle);
}

if(isset($_POST['eliminar']))
{
    $title=$_POST["title"];
    
    if(empty($title))
    {
        header("location: createtopic.php?error=camposvacios");
        exit();
    }
    if(checktitle($conn, $title)==false)
    {
        header("location: createtopic.php?error=títulonoseencuentra");
        exit();
    }
    
    deletetopic($conn, $title);
}