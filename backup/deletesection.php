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

