<?php
session_start()
?>


<?php


require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(isset($_POST['submit'])  ) {
    
    $file =$_FILES['file'];
    $file_name=$_FILES['file']['name'];
    $file_location=$_FILES['file']['tmp_name'];
    $file_size=$_FILES['file']['size'];
    $file_error=$_FILES['file']['error'];
    $file_type=$_FILES['file']['type'];
    $file_extension=explode('.', $file_name);
    $file_extension_lowercase=strtolower(end($file_extension));
    $sname=$_POST['sectionname'];
    $types_allowed=array('jpg', 'jpeg', 'png');

    if(snotins($conn, $sname)==false)
    {
        header("Location: textos.php?=secciónnoexiste");
        exit();
    }

    $result=getstatussec($conn, $sname);
    $status=$result[0];
    $imgname=$result[1];

    if($status=="set")
    {
        header("Location: textos.php?=eliminelaimagenantesdesubirotra");
        exit();
    }

    else if(in_array($file_extension_lowercase, $types_allowed)){
        if( $file_error===0){
            if($file_size < 10000000){

                $file_newname=$sname.".".$file_extension_lowercase;
                $file_newlocation='sections/'.$file_newname;

                move_uploaded_file($file_location, $file_newlocation);
                
                setset2($conn, $file_newname, $sname);
                
                header("Location: textos.php?=cargaexitosa");
                
                exit();
            }
            else{
                echo"El archivo que se intenta subir es demasiado grande.";
            }
        }
        else{
            echo "Hubo un error al subir el archivo.";
        }
    }
    else{
        echo "No se pueden subir archivos de este tipo.";
    }
}