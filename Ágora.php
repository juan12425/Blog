<?php
session_start()
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Ágora</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="styles.css">
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
    </head>

    <body class="body2"> 
       
        <?php 
        include_once 'header2.php';
        ?>

        
        
        <h1 style="font-size:3vw">Ágora</h1>
        
        <img src="i/Manchas.jpg" alt="N" class="manchas" >
        <div class="padd">
            <?php

            require_once "dbh.inc.php";
            require_once "functions.inc.php";
            if(isset($_GET["normal"]))
            {
                if(isset($_SESSION["users_id"]))
                {
                    $range=$_SESSION["rango"];
                    if($range==1 || $range==4)
                    {
                        echo "<a href='createtopic.php' style='text-decoration:none'>Nuevo Tópico o Editar Existente</a><br>";
                    }
                }

                $result=gettopics($conn);
                $len=$len=count($result);
                
                for($i=$len-1; $i>=0; $i=$i-1)
                {
                $title=$result[$i][0];
                $des=$result[$i][1];

                echo "<hr>";
                echo "<a href='Ágora.php?topic=".$title."' style='text-decoration:none;'><p class='h2edition' style='color:blue; margin-bottom:0%;'>".$title."</p></a>";
                echo "<p class='p4' style='padding-top:5%; padding-bottom:5%;'>".$des."</p>";
                }
            }
            
            
            
            if(isset($_GET["topic"]))
            {
                $topic=$_GET["topic"];
                echo "<p class='h2edition' style='color:blue;'>".$topic."</p>";
                if(isset($_SESSION["users_id"]))
                {
                    echo"<a href='Ágora.php?topic=".$topic."&action=thread' style='text-decoration:none; font-size:1.8vw; color:purple;'>Nuevo Hilo</a><br>";
                    
                    if(isset($_GET["action"]))
                    {
                    
                    echo"
                    <form action='newthread.php?topic=".$topic."' method='POST'>
                    <p style='font-size:1.4vw;'>Título</p>
                    <input type='text' name='title'>
                    <p style='font-size:1.4vw;'>Respuesta</p>
                    <textarea name='answer' style='width: 49%; height:20vh'></textarea><br>
                    <button type='submit' name='submit' class='button1' style='width:30%; height:5%; font-size:1.8vw;'>Enviar</button>
                    </form>
                    ";
                    }
                }

                $result=getthreads($conn, $topic);
                $len=$len=count($result);
                
                for($i=$len-1; $i>=0; $i=$i-1)
                {
                    $title=$result[$i][0];
                    $answer=$result[$i][1];
                    $responsable=$result[$i][2];
                    $range=$result[$i][3];
                    $date=$result[$i][4];
                    $id=$result[$i][5];
                    if($range==4){
                        $range="Admin";
                    }
                    elseif($range==3){
                        $range="Moderador";
                    }
                    elseif($range==2)
                    {
                        $range="Esteta";
                    }
                    elseif($range==1)
                    {
                        $range=="Editor";
                    }
                    elseif($range==0)
                    {
                        $range="Usuario";
                    }
                    
                     echo "<hr>
                     <p class='h2edition' style='color:blue; margin-left:2%;'>".$title."</p>
                     <a href='profile.php?profileuser=".$responsable."' style='color:black; margin-left:2%; padding-left:0px;><p style='font-size:1.5vw;'>".$responsable."</a>[".$range."]</p>
                     <p style='font-size:1vw; margin-left:2%;'>".$date."</p>";
                     
                     if(isset($_SESSION["users_id"]) AND ($_SESSION["rango"]==4 || $_SESSION["rango"]==3 || $responsable==$_SESSION["users_name"] ))
                     {
                         echo"<form action='newthread.php?thread=".$title."' method='POST'>
                         
                        <button class=button1 style='width:6%; font-size:1vw; height:1%; margin-left:2%;' name='deletethread'>Eliminar</button>

                         </form>";
                     }
                     
                     if(isset($_SESSION["users_id"]) AND $responsable==$_SESSION["users_name"] )
                     {
                         echo  "<a href='Ágora.php?topic=".$topic."&editthread=".$id."' style='text-decoration:none; font-size:1vw; color:purple;margin-left:2%;'>Editar</a><br><br>";
                        
                         if(isset($_GET["editthread"]))
                         {
                             $edit=$_GET["editthread"];
                             
                             if($edit==$id)
                             {
                                 
                                 echo"
                                 <form action='newthread.php?id=".$id."' method='POST'>
                                
                                 <p style='font-size:1.4vw;'>Título</p>
                                 <input type='text' name='title'>
                                 <p style='font-size:1.4vw;'>Respuesta</p>
                                 <textarea name='answer' style='width: 49%; height:20vh'>".$answer."</textarea><br>
                                 <button type='submit' name='submitedit' class='button1' style='width:30%; height:5%; font-size:1.8vw;'>Enviar</button>
                                 </form>
                                 ";
                             }
 
                         }
                        
                        
                    }

                    echo "<p class='p4' style='padding-top:0%; padding-bottom:2%; margin-left:2%;'>".$answer."</p>";

                     

                     if(isset($_SESSION["users_id"]))
                     {
                         echo "<a href='Ágora.php?topic=".$topic."&action2=".$id."' style='text-decoration:none; font-size:1.5vw; color:blue;'>Responder</a><br><br>";
                         if(isset($_GET["action2"]))
                        {
                            $action2=$_GET["action2"];
                            
                            if($action2==$id)
                            {
                                
                                echo"
                                <form action='newanswer.php?topic=".$topic."&title=".$title."&id=".$id."' method='POST'>
                                <p style='font-size:1.4vw;'>Respuesta</p>
                                <textarea name='answer' style='width: 49%; height:20vh'></textarea><br>
                                <button type='submit' name='submit' class='button1' style='width:30%; height:5%; font-size:1.8vw;'>Enviar</button>
                                </form>
                                ";
                            }

                        }

                    }

                    
                    $result2=getanswers($conn, $id);
                    $len2=count($result2);

                    if($len2>0)
                    {
                        echo"<p class='h2edition' style='color:black;'>Respuestas</p>";
                    }
                    
                    for($v=$len2-1; $v>=0; $v=$v-1)
                    {
                        $id=$result2[$v][0];
                        $answer=$result2[$v][1];
                        $responsable=$result2[$v][2];
                        $range=$result2[$v][4];
                        $date=$result2[$v][8];
                        
                        if($range==4){
                            $range="Admin";
                        }
                        elseif($range==3){
                            $range="Moderador";
                        }
                        elseif($range==2)
                        {
                            $range="Esteta";
                        }
                        elseif($range==1)
                        {
                            $range=="Editor";
                        }
                        elseif($range==0)
                        {
                            $range="Usuario";
                        }
                        
                        if($v%2==0)
                        {
                        echo "<div style='background-color:#ffffcc;'>";
                        }
                        else
                        {
                        echo "<div style='background-color:white;'>"; 
                        }
                        echo "<b><a href='profile.php?profileuser=".$responsable."' style='color:black;'><p style='font-size:1vw; margin-left:2%; color: black'>".$responsable."</a>[".$range."]</p></b>"; 
                        echo "<p style='font-size:1vw; margin-left:2%;'>".$date."</p>";

                        if(isset($_SESSION["users_id"]) AND ($_SESSION["rango"]==4 || $_SESSION["rango"]==3 || $responsable==$_SESSION["users_name"] ))
                        {
                            echo"<form action='newanswer.php?id=".$id."' method='POST'>
                            
                            <button class=button1 style='width:6%; font-size:1vw; height:1%; margin-left:2%;' name='deleteanswer'>Eliminar</button>

                            </form>";
                        }
                     
                        if(isset($_SESSION["users_id"]) AND $responsable==$_SESSION["users_name"] )
                        {
                            echo  "<a href='Ágora.php?topic=".$topic."&editanswer=".$id."' style='text-decoration:none; font-size:1vw; color:purple;margin-left:2%;'>Editar</a><br><br>";
                            
                            if(isset($_GET["editanswer"]))
                            {
                                $edit=$_GET["editanswer"];
                                
                                if($edit==$id)
                                {
                                    
                                    echo"
                                    <form action='newanswer.php?id=".$id."' method='POST'>
                                    <p style='font-size:1.4vw;'>Respuesta</p>
                                    <textarea name='answer' style='width: 49%; height:20vh'>".$answer."</textarea><br>
                                    <button type='submit' name='submitedit' class='button1' style='width:30%; height:5%; font-size:1.8vw;'>Enviar</button>
                                    </form>
                                    ";
                                }
    
                            }
                            
                            
                        }


                        echo "<p class='p4' style='padding-top:0%; padding-bottom:2%; margin-left:2%;'>".$answer."</p>";
                        echo "</div>";
                        
                    }
                
                }


            }

            ?>
        </div>
       
    </body>
</html>