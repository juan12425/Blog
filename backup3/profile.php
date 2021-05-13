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

<body class="body1">

<?php 


include_once 'header2.php';
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(isset($_SESSION["users_id"]))
{
    if(checkuserblocked($conn, $_SESSION['users_name']))
            {
                session_unset();
                session_destroy();
                header("location: log-in.php");
                exit();
            }
}



if(isset($_GET["profileuser"]))
{
   
    $supposed_name=$_GET["profileuser"];

    if(userexists($conn,  $supposed_name,  $supposed_name)==false)
    {
        header("location: index.php?");
        exit();
    }
  
    
    $user=$_GET["profileuser"];

    $result=getuserinfo($conn, $user);

    $name= $result["users_name"];
    $realname= $result["u_name"];
    $rol=$result["rol"];
    $rango=$result["rango"];
    $status=$result["profile_img"];
    $profile_imagename=$result["profile_imgname"];
    $email=$result["users_email"];


    if(checkuserblocked($conn, $name))
    {

        if($_SESSION["rango"]==3 || $_SESSION["rango"]==4)
        {
            echo "
            <form action='ban.php?username=".$name."' method='POST'>
            <h2>Desbloquear</h2>
            <button type='submit' name='unblock'>Desbloquear</button>
            </form>
            ";
        }
        else
        {
            header("location: index.php?");
            exit();
        }
    }
    
    if ($rango==0)
    {
        $rango="usuario";
    }
    else if ($rango==1)
    {
        $rango="editor";
    }

    else if($rango==2)
    {
        $rango="esteta";
    }

    else if($rango==3)
    {
        $rango="moderador";
    }

    else if($rango==4)
    {
        $rango="admin";
    }


    if(isset($_SESSION["users_id"]))
    {

         $my_range=$_SESSION["rango"];
        if(($my_range==3 || $my_range==4) & $rango!=="admin" & !checkuserblocked($conn, $name))  
        {
            echo "
            <h2>Banear</h2>
            <form id='ban' action='ban.php?name=".$name."&email=".$email."' method='POST'>
            <p>Tiempo</p>
            <input type='date' name='bandate'>
            <button type='submit' name='submit'>Bloquear</button>
            </form><br>

            
            <select id='reason' name='reason' form='ban'>
            <option value='1'>Uso de Lenguaje Soez</option>
            <option value='2'>Expresa violencia hacia Miembros de la Comunidad</option>
            <option value='3'>Expresa Comportamiento Destructivo</option>
            <option value='4'>Presentación de Material Audiovisual Indebido</option>
            </select>
            ";
        }
    }
    

    echo "<p class='userclass'>".$name."</p>";

    if($status == 'none')
    {
    echo " <img class='placeholderuser' src='i/placeholder.png'> ";
    }
    else if($status == 'set')
    {
        echo ' <img class="placeholderuser" src="files/'.$profile_imagename.'">';
    }

    echo '<div class="profileinfo">';
    echo'<p>Nombre de usuario: '. $name .'</p>';
    echo'<p>Nombre: '. $realname .'</p>';
    echo '<p>Rol en la comunidad: '.$rol.'</p>';
    echo '<p>Rango: '.$rango.'</p>';
    echo '</div>';
    
    
}
    



else if($_SESSION["users_id"])
{
    
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
    <button  type="submit" name="submit" class="button1">Subir Imagen</button>
    </form>';
    }
    
    else if($status == 'set')
    {
        
        $imgname=getimgname( $_SESSION["users_name"], $conn);
        
        echo ' <img class="placeholderuser" src="files/'.$imgname.'">';
        echo '<form action="delete.php" method="POST" >

        <button class="formimageuser button1" type="submit" name="submit" class="button1">Eliminar Imagen</button>
        </form>';
    }


    echo '<form action="profile.php" method="POST">
                <button type="submit" class="formimageuser button1" name="editinfo">Editar Info</button>
    </form>';


    if(isset($_POST['editinfo']))
    {
        echo '<div class="profileinfo">';

        echo '<form action="updateprofile.php" method="POST">';
        
        echo'<p>Nombre de usuario: '."<input type='text' name='user' placeholder='Usuario'>".'</p><br>';
    
        echo'<p>Nombre: '. "<input type='text' name='name' placeholder='Nombre'>" .'</p><br>';
        
        echo '<p>Rol en la comunidad: '."<input type='text' name='Rol'>".'</p><br>';

        echo '<button type=submit name="submit" class="button1">Actualizar</button>';
        echo'</form>';
        
        echo '<form action="profile.php" method="POST">
            <button type="submit" name="cancelar" class="button1">Cancelar</button>
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

    if($rango=="admin")
    {
        echo "<p>Cambiar Rangos</p>";
        echo "<form action='updateprofile.php' method='POST' id='changerange'>
        <p>Correo de la persona destinataria de la voluntad del Líder Supremo</p>
        <input type='text' name='email'>
        <button type='submit' name='editrange'>Subyugar o Liberar</button>
        </form>

        <select id='range' name='range' form='changerange'>
            <option value='0'>Base de la Pirámide(Pueblo)(Usuario)</option>
            <option value='1'>Monje/Monja (Editor)</option>
            <option value='2'>Arquitect@(Esteta)</option>
            <option value='3'>Caballero (Moderador)</option>
            <option value='4'>Líder Supremo (Admin)</option>
            </select>
        ";

        echo "<h2 style='color:red;'>MOTÍN!!!!</h2>";
        echo"<form action='updateprofile.php' method='POST'>
        <button type='submit' name='emergency'>EMERGENCIA</button>
        </form>
        
        ";

    }
}

else
{
    header("location: index.php?");
    exit();
}
    


?>





</body>
