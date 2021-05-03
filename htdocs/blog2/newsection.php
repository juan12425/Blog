<?php
session_start()
?>

<?php
require_once "dbh.inc.php";
require_once "functions.inc.php";


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
        header("location: textos.php?error=submit");
        exit();
    }