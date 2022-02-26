<?php
session_start()
?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
        <link rel="stylesheet" href="styles.css">
</head>



<ul class="menuul">
        <li class="menuli"><a class="amenu" href="index.php">Inicio</a></li>
        <li class="menuli"><a class="amenu" href="textos.php">Textos</a></li>
        <li class="menuli"><a class="amenu" href="videos.php">V/P</a></li>
        <li class="menuli"><a class="amenu" href="novedades.php">Novedades</a></li>
        <li class="menuli"><a class="amenu" href="filósofos.php">Filósofos</a></li>
        <li class="menuli"><a class="amenu" href="agora.php?normal">Ágora</a></li>
        <?php
            
            if(isset($_SESSION["users_id"])){
                echo "<li class='menuli' style='float:right; '><a class='amenu' href='profile.php' >Perfil</a></li>";
                echo  "<li class='menuli' style='float:right; '><a class='amenu' href='log-out.php' >Cerrar sesión</a></li>";
            }
            else{
                echo "<li class='menuli' style='float:right; '><a class='amenu' href='sign-up.php?normal' >Registrarse</a></li>";
                echo "<li class='menuli' style='float:right; '><a class='amenu' href='log-in.php' >Iniciar Sesión</a></li>";

            }

        ?>
        
</ul>