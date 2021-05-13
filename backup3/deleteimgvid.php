<?php
session_start()
?>

<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';




if(isset($_POST['submit']))
{
    $sname=$_POST["sectionname"];
    if (vnotinv($conn, $sname)==false)
    {
        header("Location: videos.php?=secciónnoexiste");
        exit();
    }
    
    
    $result=getstatusvid($conn, $sname);
    $status=$result[0];
    $imgname=$result[1];


    if($status=="set")
    {
        $path='videos/'.$imgname;
        if(!unlink($path))
        {
            echo"Ha sucedido un error.";
        }
        else{
            $filename='NULL';
            unsetset3($conn, $sname);
            header('location: videos.php?=eliminaciónexitosa');
            exit();
        }

    }
    else
    {
        header('location: videos.php?imagenpordefecto');
    }

}