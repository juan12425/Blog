<?php
session_start()
?>




<!DOCTYPE html>
<html>
    <head>
        <title>V/P</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="styles.css">
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
        

    </head>

    <body class="body52">
        <h1 style="text-align: left; color: black;" class="w3-animate-zoom">Videos y Podcasts</h1>
      
        <?php 
         include_once 'header2.php';
        ?>
        



        <?php  
          
          
          if(isset($_SESSION["users_id"]))
          {
            
            $range=$_SESSION["rango"];  
            
            if($range==1 || $range==4)
            {
              echo 
              "
              <h2>Crear Sección</h2>
              <form action='newvideo.php' method='POST'>
              <p>Título</p>
              <input type='text' name='title'><br><br>
              <p>Descripción</p>
              <textarea name='description'></textarea><br><br>
              <button type='submit' name='submit'>Enviar</button>
              </form>
              ";

              echo 
              "
              <h2>Cambiar Título y Descripción</h2>
              <form action='newvideo.php' method='POST'>
              <p>Título Anterior</p>
              <input type='text' name='oldtitle'><br><br>
              <p>Nuevo Título</p>
              <input type='text' name='title'><br><br>
              <p>Nueva Descripción</p>
              <textarea name='newdescription'></textarea><br><br>
              <button type='submit' name='submitnewdesc'>Enviar</button>
              </form>
              ";

            }
            


            if($range==2 || $range==4)
            {
              echo 
              "
              <h2>Subir Imagen</h2>
              <form action='uplimgvideos.php' method='POST' enctype='multipart/form-data'>
              <p>Si ya existe una imagen elimínala antes de subir una nueva</p>
              <p>Nombre de la sección correspondiente</p>
              <input type='text' name='sectionname'><br>
              <input class='formimageuser' type='file' name='file'><br><br>
              <button  type='submit' name='submit'>Subir Imagen</button>
              </form>
              ";
              
              echo 
              "
              <h2>Eliminar Imagen</h2>
              <form action='deleteimgvid.php' method='POST'>
              <p>Nombre de la sección correspondiente</p><br>
              <input type='text' name='sectionname'><br>
              <button  type='submit' name='submit'>EliminarImg</button>
              </form>
              ";

             
            }

            if($range==4)
            {
              echo
              "
              <h2 style='color:red;'>Eliminar Sección y TODOS los videos incluidos</h2>
              <form action='deletesection.php' method='POST'>
              <p>Nombre de la sección a eliminar</p>
              <input type='textbox' name='sectionname'>
              <button type='submit' name='submitdeletesecvideo'>Eliminar</button>
              </form>
              ";
            }

          
          }
            ?>  

        <?php
        require_once "dbh.inc.php";
        require_once "functions.inc.php";

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

      
          $result=selectallvideos($conn);
          $len=count($result);
          
          
          for($i=$len-1; $i>=0; $i=$i-2)
            {

              if($i==0)
              {
                $title=$result[$i][0];
                $des=$result[$i][1];
                $status=$result[$i][2];
                $img_name=$result[$i][3];

                if ($status == 'none')
                {
                  $img_name="i/sócrates2.jpg";
                }
                else
                {
                  $img_name="sections/".$img_name;
                }

                echo '<div class="float-container">';
                echo'
                <div class="float-child">
                    <img src="'.$img_name.'" alt="Sócrates" class="foucault w3-animate-zoom">
                    <a href="videos2.php#'.$title.'"'.' style="text-decoration: none;"><p class="p8">'.$title.'</p></a>
                      <p class="p9">'.$des.'</p>
                </div>';
                echo '</div>';

                break;

              }


              echo '<div class="float-container">';
         
          
              
          
              
              $title=$result[$i][0];
              $des=$result[$i][1];
              $status=$result[$i][2];
              $img_name=$result[$i][3];

              

              if ($status == 'none')
              {
                $img_name="i/sócrates2.jpg";
              }
              else
              {
                $img_name="sections/".$img_name;
              }
              
              
                echo'
                <div class="float-child">
                    <img src="'.$img_name.'" alt="Sócrates" class="foucault w3-animate-zoom">
                    <a href="videos2.php#'.$title.'"'.' style="text-decoration: none;"><p class="p8">'.$title.'</p></a>
                      <p class="p9">'.$des.'</p>
                </div>';


              $title2=$result[$i-1][0];
              $des2=$result[$i-1][1];
              $status2=$result[$i-1][2];
              $img_name2=$result[$i-1][3];


              if ($status2 == 'none')
              {
                $img_name2="i/sócrates2.jpg";
              }
              else
              {
                $img_name2="sections/".$img_name2;
              }
              
              
             
                echo'
                <div class="float-child2">
                    <img src="'.$img_name2.'" alt="Sócrates" class="foucault w3-animate-zoom">
                    <a href="videos2.php#'.$title2. '"' . ' style="text-decoration: none;"><p class="p8">'.$title2.'</p></a>
                      <p class="p9">'.$des2.'</p>
                </div>';
            
                echo '</div>';

            }
          
         
          
        
        ?>


    </body>
</html>
