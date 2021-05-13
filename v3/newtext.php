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
    $author=$_POST['author'];
    $author_e=$_POST['author_e'];
    $date=$_POST['date'];
    $data=$_POST['data'];

    $file =$_FILES['file'];
    $file_name=$_FILES['file']['name'];
    $file_location=$_FILES['file']['tmp_name'];
    $file_size=$_FILES['file']['size'];
    $file_error=$_FILES['file']['error'];
    $file_type=$_FILES['file']['type'];
    $file_extension=explode('.', $file_name);
    $file_extension_lowercase=strtolower(end($file_extension));
    $types_allowed=array('pdf');


    if(emptyfieldstext($section, $title, $author, $author_e, $date, $data, $file)==true)
    {
        header("location: textos2.php?error=camposvacios");
    }

    if (invalidtitlesection($section, $conn)==false)
    {
        header("location: textos2.php?error=secciónnoexiste");
        exit();
    }
    
    if(invalidtitletext($title, $conn)!==false)
    {
        header("location: textos2.php?error=títuloyaexiste");
        exit();
    }

    if(in_array($file_extension_lowercase, $types_allowed) && $file_error===0 && $file_size < 10000000)
    {
        $file_newname=$title.".".$file_extension_lowercase;
        newtext($conn, $section, $title, $author, $author_e, $date, $data, $file_newname);
        
        $file_newlocation='texts/'.$file_newname;
        move_uploaded_file($file_location, $file_newlocation);
        
        header("Location: textos2.php?=cargaexitosa");
        exit();
    }
    else
    {
        echo "Error al subir pdf. Probablemente no seleccionaste ninguno.";
    }


}
