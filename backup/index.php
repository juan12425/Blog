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
    <p class="p1 w3-animate-opacity">La inesperada pandemia de este año terminó por confirmar una realidad que, aunque de forma velada para algunos, ya había surgido tiempo atrás: el vínculo, cada vez más inextricable, entre virtualidad y educación. 
        Tal vez por carecer de la distancia histórica que permite comprender de forma justa los acontecimientos, aun hoy desconocemos muchas de las implicaciones de esa relación. 
        Pero ni  el más reaccionario se atrevería a dudar de ella. Este fenómeno que siguiendo a Sartori podemos relacionar con la aparición del Homo Videns, 
        basta para justificar la existencia de un nuevo blog. Pues nunca antes en la historia fue tan importante acompañar los procesos formativos de los 
        estudiantes con diferentes recursos audiovisuales.<br><br>
        
        Querer Ver es un blog del Liceo Juan Ramón Jiménez, cuyo principal objetivo es servir de herramienta 
        pedagógica en la enseñanza de la filosofía.  Pretende constituirse en un espacio en el que los estudiantes 
        del Liceo crean conocimiento de forma distendida, en un área del saber tradicionalmente vinculada con 
        el formalismo de los congresos y de las revistas académicas. Esperamos finalmente que esto permita que 
        los estudiantes más pequeños también se acerquen y conozcan un poco más de esta apasionante disciplina a 
        través de ensayos, podcast, reflexiones cortas o entrevistas. 
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
    echo " <a href='sign-up.php' style='text-decoration: none; padding-bottom=100px'>
    <div class='div40'>
        <p class='p6'>¡Registrate ahora, crea tu perfil, accede al ágora<br>
            y a muchas otras características de Querer Ver!</p>
        </div>
    </a>";
}

    



?>



        
    
    
 
        <hr>
        
        <div style="background-color: black;">
            <a href="filósofos.html"><p  class="p41">Filósofos</p></a>
            <a href="filósofos.html" style="text-decoration: none;"><p class="p40">Descubre toda clase de Filósofos, reseñas y libros. <br>
                Solo déjate sorprender.</p></a>
                <img src="i/N.jpg" alt="N" class="n1">;
        </div>
        
        <div style="background-color: white;">
            
            <a href="Ágora.html" style="text-decoration: none;"><p class="p42">Discute y conversa sobre filosofía en el Ágora<br>
            El foro de Querer Ver.</p></a>
                 <img src="i/ágora.PNG" alt="ágora" class="a1">
        

        </div>

        <div style="background-color: black; ">
            <a href="textos.html" style="text-decoration: none;"><p class="p43">Encuentra una gran variedad de Textos 
                sobre múltiples temas y no solamente académicos.</p></a>
                <img src="i/textos.png" alt="textos" class="n1">;
        </div>

        <div style="background-color: white;">
    
            <a href="#Novedades" style="text-decoration: none;"><p class="p44">¡Revisa las últimas actualizaciones del blog
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