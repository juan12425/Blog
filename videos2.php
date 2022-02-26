<?php
session_start()
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Videos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="styles.css">
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
    </head>

    <h1 style="text-align: left;">Videos y Podcasts</h1>
        
        <?php 
         include_once 'header2.php';
        ?>
    <body class="body52">

    <?php
        
        if(isset($_SESSION["users_id"]))
        {
            $range=$_SESSION["rango"];

            if($range==2 || $range==4)
            {
                echo '
                <h2>Subir un Video</h2>
                <form action="newvideo2.php" method="POST">
                <p>Sección correspondiente</p><br>
                <input type="text" name="section"><br>
                <p>Título</p>
                <input type="text" name="title"><br>
                <p>Link de Youtube</p><br>
                <input type="text" name="link"><br>
                <button  type="submit" name="submit">Subir</button>
                </form>
                ';

                echo
                '
                <h2 style="color:red;">Eliminar un Video</h2>
                <form action="deletetextorvideo.php" method="POST">
                <p>Título</p>
                <input type="text" name="title">
                <button type="submit" name="submitdeletevideo">Eliminar</button>
                </form>

                ';
            }
        }
        ?>

<?php
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

       
        $result=selectallvideos($conn);
        $len=count($result);

        for($i=$len-1; $i>=0; $i=$i-1)
        {
            $section=$result[$i][0];
            echo'
            <h2 style="font-size: 2.1vw;" id="'.$section.'">'.$section.'</h2><br>
            <hr>';

            $result1=selectallvideos2($conn, $section);               
            $len1=count($result1);
            
            for($v=0; $v<$len1; $v++)
            {
                $title=$result1[$v][0];
                $link=$result1[$v][1];
                $section=$result1[$v][2];
                $code=explode("=",$link)[1];
                $newlink="https://www.youtube.com/embed/".$code;
                
                echo '<p class="h2edition" style="color: black; margin-left: 2%;">'.$title.'</p>';
                echo '
                <div class="iframe-container">
                    <iframe width="80%" height="500" src='.$newlink.' style="float:left;"></iframe>
                </div>
                ';
                
            }
            
            
            
        }
        
        ?>




    </body>

</html>