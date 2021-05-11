<?php
session_start()
?>

<?php
require_once "dbh.inc.php";
require_once "functions.inc.php";

if(isset($_POST['submit']))
{

    $section=$_POST['section'];
    $title=$_POST['title'];
    $link=$_POST['link'];
  



    if(empty($section) || empty($title) || empty($link))
    {
        header("location: videos2.php?error=camposvacios");
    }

    if (invalidtitlesectionvideos($section, $conn)==false)
    {
        header("location: videos2.php?error=secciónnoexiste");
        exit();
    }
    
    if(invalidtitlevido2($title, $conn)!==false)
    {
        header("location: videos2.php?error=títuloyaexiste");
        exit();
    }

    if(invalidlink($conn, $link)==true)
    {
        header("location: videos2.php?error=linkinválido");
        exit();
    }
    insertvideo($conn, $title, $link, $section);

}
