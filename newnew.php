<?php
session_start()
?>

<?php
require_once "dbh.inc.php";
require_once "functions.inc.php";

if(isset($_SESSION["users_id"]))
{
    if(checkuserblocked($conn, $_SESSION['users_name']))
    {
        session_unset();
        session_destroy();
        header("location: log-in.php");
        exit();
    }
}


if(isset($_POST['submitnewdesc']))
{
    $title=$_POST['title'];
    $newdesc=$_POST['newdescription'];
    $oldtitle=$_POST['oldtitle'];
    
    if (empty($newdesc) || empty($title) || empty($oldtitle))
    {
        header('location: novedades.php?error=camposvacíosnuevotd');
        exit();
    }
    if(invalidtitlesectionnews($title, $conn) !== false )
    {
    header("location: novedades.php?error=nuevotítuloyaexiste");
    exit();
    }
    updatedestisectionnews($conn, $oldtitle, $title, $newdesc);
    header("location: novedades.php?SecciónActualizada");
    exit();
}


if(isset($_POST['submit']))
{
    $title=$_POST['title'];
    $description=$_POST['description'];

    $emptysection=emptysection($title, $description);

    if($emptysection==true)
    {
        header("location: novedades.php?error=camposvacios");
        exit();
    }
    
    if(invalidtitlesectionnews($title, $conn) !== false )
    {
    header("location: novedades.php?error=títuloinválido");
    exit();
    }

    else
    {
        //Create Section
        $cdate=date("Y-m-d");
        createsectionnews($conn, $title, $description, $cdate);
        
    }

}
    
else
    {
        header("location: novedades.php?error=Errorcreandonuevasección");
        exit();
    }

    