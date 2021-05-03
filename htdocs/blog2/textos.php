<?php
session_start()
?>




<!DOCTYPE html>
<html>
    <head>
        <title>Textos</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="styles.css">
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
        

    </head>

    <body class="body40">
        <h1 style="text-align: left; color: black;" class="w3-animate-zoom">Textos</h1>
        <hr>
        <?php 
         include_once 'header2.php';
        ?>
        



        <?php  
          
          
          if(isset($_SESSION["users_id"])){
            
            $range=$_SESSION["rango"];  
            
            if($range==1 || $range==4)
            {
              echo 
              "
              <form action='newsection.php' method='POST'>
              
              <p>Título</p>
              <input type='texbox' name='title'><br><br>
              <p>Descripción</p>
              <textarea name='description'></textarea><br><br>
              <button type='submit' name='submit'>Enviar</button>
              </form>
              ";
            }
            


            if($range==2 || $range==4)
            {
              echo 
              "
              <form action='uplimgsection.php' method='POST' enctype='multipart/form-data'>
              <p>Nombre de la sección correspondiente</p><br>
              <input type='textbox' name='sectionname'><br>
              <input class='formimageuser' type='file' name='file'><br><br>
              <button  type='submit' name='submit'>Subir Imagen</button>
              </form>
              ";
              
              echo 
              "
              <form action='deleteimgsec.php' method='POST'>
              <p>Eliminar Img</p><br>
              <p>Nombre de la sección correspondiente</p><br>
              <input type='textbox' name='sectionname'><br>
              <button  type='submit' name='submit'>EliminarImg</button>
              </form>
              ";

            }
               }
            ?>  

        <?php
        require_once "dbh.inc.php";
        require_once "functions.inc.php";
      
          $result=selectall($conn);
          $len=count($result);
          
          echo '<div class="float-container">';
          
          for($i=0; $i<$len; $i++)
            {
              $title=$result[$i][0];
              $des=$result[$i][1];
              $status=$result[$i][2];
              $img_name=$result[$i][3];
              $type=$i%2;

              if ($status == 'none')
              {
                $img_name="i/sócrates2.jpg";
              }
              else
              {
                $img_name="sections/".$img_name;
              }
              
              if($type == 0)
              {
                echo'
                <div class="float-child">
                    <img src="'.$img_name.'" alt="Sócrates" class="foucault w3-animate-zoom">
                    <a href="textos2.php#'.$title.'"'.' style="text-decoration: none;"><p class="p8">'.$title.'</p></a>
                      <p class="p9">'.$des.'</p>
                </div>';
              }
              
              if($type !== 0)
              {
                echo'
                <div class="float-child2">
                    <img src="'.$img_name.'" alt="Sócrates" class="foucault w3-animate-zoom">
                    <a href="textos2.php#'.$title. '"' . ' style="text-decoration: none;"><p class="p8">'.$title.'</p></a>
                      <p class="p9">'.$des.'</p>
                </div>';
              }
              

            }

          echo '</div>';
         
          
        
        ?>


            

        
         <div class="divc">
            <div style="margin-top: 80%; padding-top: 2%">
            <h2 class="h40">Contacto</h2>
            <h2 class="h40">Sobre los Creadores</h2> 
            <h2 class="h40">Otros Créditos</h2> 
            </div>
            <h2 class="h70">QuererVer ©2020</h2>
          </div>
          





        
    </body>
</html>