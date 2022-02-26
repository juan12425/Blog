<?php
session_start()
?>

<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(isset($_POST['submit']))
{
    $sectionname=$_POST['sectionname'];

    $sectionins=snotins($conn, $sectionname);

    if($sectionins == true)
    {
        deletest($conn, $sectionname);    
    }
    else
    {
        header('location: textos.php?error=nombredelasecciónesinválido');
        exit();
    }

}

if(isset($_POST["submitdeletesecvideo"]))
{
    $title=$_POST["sectionname"];
    deletesecvideos($conn, $title);
}

if(isset($_POST['submitdelnew']))
{
    $sectionname=$_POST['sectionname'];

    $sectionins=invalidtitlesectionnews($sectionname, $conn);

    if($sectionins !== false)
    {
        deletesecnews($conn, $sectionname);    
    }
    else
    {
        header('location: novedades.php?error=nombredelasecciónesinválido');
        exit();
    }

}