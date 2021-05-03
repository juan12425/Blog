<?php
session_start()
?>

<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';




if(isset($_POST['submit']))
{
    $sname=$_POST["sectionname"];
    if (snotins($conn, $sname)==false)
    {
        header("Location: textos.php?=secciónnoexiste");
        exit();
    }
    
    
    $result=getstatussec($conn, $sname);
    $status=$result[0];
    $imgname=$result[1];


    if($status=="set")
    {
        $path='sections/'.$imgname;
        if(!unlink($path))
        {
            echo"Ha sucedido un error.";
        }
        else{
            $filename='NULL';
            unsetset2($conn, $sname);
            header('location: textos.php?=eliminaciónexitosa');
            exit();
        }

    }
    else
    {
        header('location: textos.php?=imagenpordefecto');
    }

}