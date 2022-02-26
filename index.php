<?php
session_start()
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Querer Ver</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
        <link rel="stylesheet" href="styles.css">
    </head>

   
   
   
   
   
    <body class="body2">
    <h1 class="w3-animate-top">QuererVer</h1>
    <hr>

    <?php 
    include_once 'header2.php';
    ?>

    <img class="imgi w3-animate-opacity" src="i/dibujo14.jpg" alt="¿Zeus?"> 
    <p class="p2 w3-animate-opacity">Introducción del Blog</p>
    <div class="div1">
        <p class="p1 w3-animate-opacity">Nunc suscipit nunc in massa fermentum condimentum. Maecenas fringilla 
            sollicitudin purus, non lobortis neque pellentesque ut. Aenean tincidunt quam et auctor vehicula. 
            Curabitur gravida lacus et neque posuere, non suscipit nibh sollicitudin. Phasellus mollis, libero ac semper 
            tincidunt, tortor erat hendrerit nulla, vitae venenatis magna mi ut ex. Quisque feugiat lacus quis convallis tincidunt.
            Sed blandit libero lacus, in placerat turpis rutrum ut. Morbi condimentum dolor magna, ac sollicitudin felis rutrum ut.<br><br>
            
            Nunc suscipit nunc in massa fermentum condimentum. Maecenas fringilla 
            sollicitudin purus, non lobortis neque pellentesque ut. Aenean tincidunt quam et auctor vehicula. 
            Curabitur gravida lacus et neque posuere, non suscipit nibh sollicitudin. Phasellus mollis, libero ac semper 
            tincidunt, tortor erat hendrerit nulla, vitae venenatis magna mi ut ex. Quisque feugiat lacus quis convallis tincidunt.
            Sed blandit libero lacus, in placerat turpis rutrum ut. Morbi condimentum dolor magna, ac sollicitudin felis rutrum ut
        </p>
    </div>
   

        <?php 

        if(isset($_SESSION["users_id"])){
            echo " <a href='#registro' style='text-decoration: none;'>
            <div class='div40'>
                <p class='p6'>¡Qué bien ya te has registrado en Querer Ver!<br><br><br></p>
                </div>
            </a>";}
        else
        {
            echo " <a href='sign-up.php?normal' style='text-decoration: none; padding-bottom=100px'>
            <div class='div40'>
                <p class='p6'>¡Registrate ahora, crea tu perfil, accede al ágora<br>
                    y a muchas otras características de Querer Ver!</p>
                </div>
            </a>";
        }

            
        ?>

        <hr>
        
        <div style="background-color: black;">
            <a href="filósofos.php"><p  class="p41">Filósofos</p></a>
            <a href="filósofos.php" style="text-decoration: none;"><p class="p40">Descubre toda clase de Filósofos, reseñas y libros. <br>
                Solo déjate sorprender.</p></a>
                <img src="i/N.jpg" alt="N" class="n1">;
        </div>
        
        <div style="background-color: white;">
            
            <a href="agora.php?normal" style="text-decoration: none;"><p class="p42">Discute y conversa sobre filosofía en el Ágora<br>
            El foro de Querer Ver.</p></a>
            <img src="i/ágora.PNG" alt="ágora" class="a1">
        
        </div>

        <div style="background-color: black; ">
            <a href="textos.php" style="text-decoration: none;"><p class="p43">Encuentra una gran variedad de Textos 
                sobre múltiples temas y no solamente académicos.</p></a>
                <img src="i/textos.png" alt="textos" class="n1">;
        </div>

        <div style="background-color: white;">
    
            <a href="novedades.php" style="text-decoration: none;"><p class="p44">¡Revisa las últimas actualizaciones del blog
                <br>en nuestra sección de Novedades!
            </p></a>
                    <img src="i/p.jpg" alt="ágora" class="a2">
        </div>
            
        <hr>
    
    
    
        <div class="divc">
            <div style="padding-top:2%">
            <h2 class="h40">Contacto</h2>
            <h2 class="h40">Sobre los Creadores</h2> 
            <h2 class="h40">Otros Créditos</h2> 
            </div>
            <h2 class="h70">QuererVer ©2021</h2>
        </div>
            
            


    
 </body>

</html>