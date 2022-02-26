<!DOCTYPE html>
<html>
    <head>
        <title>Novedades</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="styles.css">
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
    
     <style>
    .mySlides {display:none;}
    </style>
    
    
    </head>

   

    <body class="body2"> 

    <?php 
    session_start();
    ?>
    <?php 
    include_once 'header2.php';

    if(isset($_SESSION["users_id"]))
    {
        if($_SESSION["rango"]==2 || $_SESSION["rango"]==4)
        {
            echo "<a href='novedades.php?cambiarfotos'>Cambiar Fotos</a><br>";

            if(isset($_GET["cambiarfotos"]))
            {
                echo '<form action="upload.php" method="POST" enctype="multipart/form-data">
                <h2>Subir</h2>
                <input class="formimageuser" type="file" name="file"><br><br>
                <button  type="submit" name="submitslide">Subir Imagen</button>
                </form>';

                echo '<form action="delete.php" method="POST">
                <h2 style="margin-left:10%;">Eliminar</h2>
                <p style="margin-left:10%;">ID Diapositiva</p>
                <input type="text" name="id" style="margin-left:10%;"><br>
                <button  type="submit" name="deleteslide" style="margin-left:10%;">Eliminar</button>
                </form><br><br>';


            }
        }

        if($_SESSION["rango"]==4)
        {
            echo "<a href='novedades.php?NuevaNoticia'>Nueva Noticia</a>";
            if(isset($_GET["NuevaNoticia"]))
            {
                echo 
              "
              <h2>Crear Sección</h2>
              <form action='newnew.php' method='POST'>
              <p>Título</p>
              <input type='text' name='title'><br><br>
              <p>Descripción</p>
              <textarea name='description' rows='20' cols='50'></textarea><br><br>
              <button type='submit' name='submit'>Enviar</button>
              </form>
              ";

              echo 
              "
              <h2>Cambiar Título y Descripción</h2>
              <form action='newnew.php' method='POST'>
              <p>Título Anterior</p>
              <input type='text' name='oldtitle'><br><br>
              <p>Nuevo Título</p>
              <input type='text' name='title'><br><br>
              <p>Nueva Descripción</p>
              <textarea name='newdescription' rows='20' cols='50'></textarea><br><br>
              <button type='submit' name='submitnewdesc'>Enviar</button>
              </form>
              ";

              echo
              "
              <h2 style='color:red;'>Eliminar Sección y TODOS los textos incluidos</h2>
              <form action='deletesection.php' method='POST'>
              <p>Nombre de la sección a eliminar</p>
              <input type='textbox' name='sectionname'>
              <button type='submit' name='submitdelnew'>Eliminar</button>
              </form>
              ";
            }


            
        }
    }

        

       
    
    ?>

    <div class="w3-content w3-display-container" style="margin-top: 2%;">

        <img class="mySlides" src="i/slides2.png" style="max-width: 100%; height: auto;">
        <?php
        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';
        
        $result=getslides($conn);
        $len=count($result);
        
        for($i=$len-1; $i>=0; $i=$i-1)
        {
            if(isset($_SESSION["users_id"]))
            {
                if($_SESSION["rango"]==2 || $_SESSION["rango"]==4)
                {
                    echo $result[$i][0];
                }
            }
            $img_name=$result[$i][1];
            echo'<img class="mySlides" src="slides/'.$img_name.'" style="max-width: 100%; height: auto;">';

        }

        ?>
        
        <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
        <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
    </div>


    <div style="margin-top:5%;">
    <?php

    
    
    $result=selectallnews($conn);
    $len=count($result);
    
    for($i=$len-1; $i>=0; $i=$i-1)
    {
        $title=$result[$i][0];
        $des=$result[$i][1];
        $date=$result[$i][2];
        $type=$i%2;

        if($type==0)
        {

        echo'
        <div class="nchild1">
            <h2 style="text-align: center; font-size:3vw; color:#b30059;">'.$title.'</h2>
            <p class="pnews">'.$des.'</p>
        </div>';

        }

        if($type !==0)
        {

        echo'
        <div class="nchild2"> 
            <h2 style="text-align: center; font-size:3vw; color:#4d4dff;">'.$title.'</h2>
            <p class="pnews">'.$des.'</p>
        </div>
        ';

        }
    }
    ?>

    </div>


    

        </body>
    
    <script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
    showDivs(slideIndex += n);
    }

    function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    if (n > x.length) {slideIndex = 1}
    if (n < 1) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
    }
    x[slideIndex-1].style.display = "block";  
    }
    </script>

</html>