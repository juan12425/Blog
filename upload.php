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

    $types_allowed=array('jpg', 'jpeg', 'png');

    if(in_array($file_extension_lowercase, $types_allowed)){
        if( $file_error===0){
            if($file_size < 10000000){

                $id=getuserid($conn, $_SESSION["users_name"]);
                

                $file_newname=$id.".".$file_extension_lowercase;
                $file_newlocation='files/'.$file_newname;

                move_uploaded_file($file_location, $file_newlocation);
                setset($conn, $file_newname, $_SESSION["users_name"]);
                
                header("Location: profile.php?=cargaexitosa");

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

if(isset($_POST['submitslide'])  ) {
    

    $file =$_FILES['file'];
    $file_name=$_FILES['file']['name'];
    $file_location=$_FILES['file']['tmp_name'];
    $file_size=$_FILES['file']['size'];
    $file_error=$_FILES['file']['error'];
    $file_type=$_FILES['file']['type'];

    $file_extension=explode('.', $file_name);
    $file_extension_lowercase=strtolower(end($file_extension));

    $types_allowed=array('jpg', 'jpeg', 'png');

    if(in_array($file_extension_lowercase, $types_allowed)){
        if( $file_error===0){
            if($file_size < 10000000){

                $newrand=randstring(10);
                $file_newname=$newrand.".".$file_extension_lowercase;
                $file_newlocation='slides/'.$file_newname;

                move_uploaded_file($file_location, $file_newlocation);
                createslide($conn, $file_newname);
                
                header("Location: profile.php?=cargaexitosa");

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