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
          
          
          if(isset($_SESSION["users_id"]))
          {
            
            $range=$_SESSION["rango"];  
            
            if($range==1 || $range==4)
            {
              echo 
              "
              <h2>Crear Sección</h2>
              <form action='newsection.php' method='POST'>
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
              <form action='newsection.php' method='POST'>
              <p>Título Anterior</p>
              <input type='text' name='oldtitle'><br><br>
              <p>Nuevo Título</p>
              <input type='text' name='title'><br><br>
              <p>Nueva Descripción</p>
              <textarea name='newdescription' rows='20' cols='50'></textarea><br><br>
              <button type='submit' name='submitnewdesc'>Enviar</button>
              </form>
              ";
            }
            


            if($range==2 || $range==4)
            {
              echo 
              "
              <h2>Subir Imagen</h2>
              <form action='uplimgsection.php' method='POST' enctype='multipart/form-data'>
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
              <form action='deleteimgsec.php' method='POST'>
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
              <h2 style='color:red;'>Eliminar Sección y TODOS los textos incluidos</h2>
              <form action='deletesection.php' method='POST'>
              <p>Nombre de la sección a eliminar</p>
              <input type='textbox' name='sectionname'>
              <button type='submit' name='submit'>Eliminar</button>
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

          $result=selectall($conn);
          $len=count($result);
          
          echo '<div class="float-container">';
          
          for($i=$len-1; $i>=0; $i=$i-1)
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


    </body>
</html>