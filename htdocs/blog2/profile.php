<?php
session_start()
?>

<!DOCTYPE html>
<html>
<title>Perfil</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho+B1:wght@500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">

<body>

<?php 
include_once 'header2.php';
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

$name= ucfirst($_SESSION["users_name"]);
$realname= ucfirst($_SESSION["real_name"]);
$rol=ucfirst($_SESSION["Rol"]);
$rango=NULL;
if ($_SESSION["rango"]==0)
{
    $rango="usuario";
}
else if ($_SESSION["rango"]==1)
{
    $rango="editor";
}

else if($_SESSION["rango"]==2)
{
    $rango="esteta";
}

else if($_SESSION["rango"]==3)
{
    $rango="moderador";
}

else if($_SESSION["rango"]==4)
{
    $rango="admin";
}


echo "<p class='userclass'>".$name."</p>";

$status=checkset($_SESSION["users_name"], $conn);

if($status == 'none')
{
echo " <img class='placeholderuser' src='i/placeholder.png'> ";
echo '<form action="upload.php" method="POST" enctype="multipart/form-data">

<input class="formimageuser" type="file" name="file"><br><br>
<button  type="submit" name="submit">Subir Imagen</button>
</form>';
}
else if($status == 'set')
{
    $imgname=getimgname( $_SESSION["users_name"], $conn);
    
    echo ' <img class="placeholderuser" src="files/'.$imgname.'">';
    echo '<form action="delete.php" method="POST" >

    <button class="formimageuser" type="submit" name="submit">Eliminar Imagen</button>
   </form>'; }


   echo '<form action="profile.php" method="POST">
            <button type="submit" class="formimageuser" name="editinfo">Editar Info</button>
   </form>';


    if(isset($_POST['editinfo']))
    {
        echo '<div class="profileinfo">';

        echo '<form action="updateprofile.php" method="POST">';
        
        echo'<p>Nombre de usuario: '."<input type='text' name='user' placeholder='Usuario'>".'</p><br>';
       
        echo'<p>Nombre: '. "<input type='text' name='name' placeholder='Nombre'>" .'</p><br>';
        
        echo '<p>Rol en la comunidad: '."<input type='text' name='Rol'>".'</p><br>';

        echo '<button type=submit name="submit">Actualizar</button>';
        echo'</form>';
        
        echo '<form action="profile.php" method="POST">
            <button type="submit" name="cancelar">Cancelar</button>
            </form>';
        
        
        
        echo '<p>Rango: '.$rango.'</p>';
        echo '</div>';

        
    }


    else{
    echo '<div class="profileinfo">';
    echo'<p>Nombre de usuario: '. $name .'</p>';
    echo'<p>Nombre: '. $realname .'</p>';
    echo '<p>Rol en la comunidad: '.$rol.'</p>';
    echo '<p>Rango: '.$rango.'</p>';
    echo '</div>';
    }
?>





</body>
