<?php
session_start()
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Textos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="styles.css">
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
    </head>

    <h1 style="text-align: left;">Textos</h1>
        
        
        
        <hr>
        <?php 
         include_once 'header2.php';
        ?>

        <body>

        <?php
        
        if(isset($_SESSION["users_id"]))
        {
            $range=$_SESSION["rango"];

            if($range==1 || $range==4)
            {
                echo '
                <form action="newtext.php" method="POST" enctype="multipart/form-data">
                <p>Sección correspondiente</p><br>
                <input type="textbox" name="section"><br>
                <p>Título</p>
                <input type="textbox" name="title"><br>
                <p>Autor</p><br>
                <input type="textbox" name="author"><br>
                <p>Email Autor</p><br>
                <input type="textbox" name="author_e"><br>
                <p>Fecha de publicación</p><br>
                <input type="textbox" name="date"><br>
                <p>Resumen</p><br>
                <textarea name="data"></textarea><br><br>
                <p>Pdf</p><br>
                <input  type="file" name="file"><br><br>
                <button  type="submit" name="submit">Subir</button>
                </form>
                ';
            }
        }

        ?>
    
        
            
        <?php
        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';
       
        $result=selectall($conn);
        $len=count($result);

        for($i=0; $i<$len; $i++)
        {
            $section=$result[$i][0];
            echo'<h2 id="'.$section.'">'.$section.'<h2>';
            $result1=selectall2($conn, $section);
            $len1=count($result1);
            
            for($v=0; $v<$len1; $v++)
            {
                $title=$result1[$v][0];
                $author=$result1[$v][1];
                $author_e=$result1[$v][2];
                $date=$result1[$v][3];
                $description=$result1[$v][4];
                $pdf_name=$result1[$v][5];
                $auinfo=aimp($conn, $author_e);
                
                $myFunction="myFunction('pdf".$title."', 'button1".$title."', 'button2".$title."')";
                $myFunction2="myFunction2('pdf".$title."', 'button2".$title."', 'button1".$title."')";
                
                if($auinfo !== false)
                {
                    $img="files/".$auinfo["profile_imgname"];
                }
                else
                {
                    $img="i/placeholder.png";
                }

               
                echo '
        
                <h2 class="h2edition" style="color: black; margin-left: 2%;">'.$title.'</h2>
                <img src="'.$img.'" alt="Pepito" class="imgfloat">
                
                
                <p class="p4">
                    <b>Autor</b>:'.$author.'<br>
                    <b>Fecha</b>:'.$date.'<br>
                    <b>Breve resumen</b>:'.$description.'</p>
                    
                <div style="margin-left: 30%;">
                    <button type="button" onclick="'.$myFunction.'" id="button2'.$title.'" class="buttonpdf">Ver PDF</button>
                    <button type="button" onclick="'.$myFunction2.'" style="display: none;" id="button1'.$title.'" class="buttonpdf">Ocultar PDF</button>
                    
                    <p id="demo1"></p>
                    <p id="demo2"></p>
                    <a href="#Foro" class="lforo">Discutir en el Ágora</a>
                </div>
                <iframe src="texts/'.$pdf_name.'" width="100%" height="800vmin" style="display: none;" id="pdf'.$title.'"></iframe> ';
                
                
            
            }
            
            
            
        }
        
        ?>

    
          
        
    </body>
</html>
    
    
    
    
    
    
    
    <script>

        
        function myFunction(id, id2, id3) {
          document.getElementById(id).style.display='block';
          document.getElementById(id2).style.display='block';
          document.getElementById(id3).style.display='none';
         }

         function myFunction2(id, id2, id3) {
          document.getElementById(id).style.display='none';
          document.getElementById(id2).style.display='block';
          document.getElementById(id3).style.display='none';
         }
    </script>