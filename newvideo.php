<?php
session_start()
?>

<?php
require_once "dbh.inc.php";
require_once "functions.inc.php";


if(isset($_POST['submitnewdesc']))
{
    $title=$_POST['title'];
    $newdesc=$_POST['newdescription'];
    $oldtitle=$_POST['oldtitle'];
    
    if (empty($newdesc) || empty($title) || empty($oldtitle))
    {
        header('location: videos.php?error=camposvacíosnuevotd');
        exit();
    }
    if(invalidtitlesectionvideos($title, $conn) !== false )
    {
    header("location: videos.php?error=nuevotítuloyaexiste");
    exit();
    }
    updatedestisectionvideos($conn, $oldtitle, $title, $newdesc);
    header("location: videos.php?SecciónActualizada");
    exit();
}

if(isset($_POST['submit']))
{
    $title=$_POST['title'];
    $description=$_POST['description'];

    
   

    $responsable=$_SESSION['email'];
    $responsableid=$_SESSION['users_id'];

    $emptysection=emptysection($title, $description);

    if($emptysection==true)
    {
        header("location: videos.php?error=camposvacios");
        exit();
    }
    
    if(invalidtitlesectionvideos($title, $conn) !== false ) //
    {
    header("location: videos.php?error=títuloinválido");//
    exit();
    }

    else
    {
        //Create Section
        
        createsectionvideos($conn, $title, $description, $responsable, $responsableid);//
        
    }

}
    
else
    {
        header("location: videos.php?error=Errorcreandonuevasección");
        exit();
    }