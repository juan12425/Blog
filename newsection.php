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
        header('location: textos.php?error=camposvacíosnuevotd');
        exit();
    }
    if(invalidtitlesection($title, $conn) !== false )
    {
    header("location: textos.php?error=nuevotítuloyaexiste");
    exit();
    }
    updatedestisection($conn, $oldtitle, $title, $newdesc);
    header("location: textos.php?SecciónActualizada");
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
        header("location: textos.php?error=camposvacios");
        exit();
    }
    
    if(invalidtitlesection($title, $conn) !== false )
    {
    header("location: textos.php?error=títuloinválido");
    exit();
    }

    else
    {
        //Create Section
        
        createsection($conn, $title, $description, $responsable, $responsableid);
        
    }

}
    
else
    {
        header("location: textos.php?error=Errorcreandonuevasección");
        exit();
    }

