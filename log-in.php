<?php 
include_once 'header.php';
?>
    
    <body class="body1">
    
    <div class="div124 position1" >
    <h1 style="font-family:Lobster;">Iniciar Sesión</h1>
    <form action="login.inc.php" method="POST"> 
    
    <input type="text" name="name"  placeholder="Usuario/Email" class="textbox"> <br>
    
    <input type="password" name="password"  placeholder="Contraseña" class="textbox"> <br><br>
    
    <button type="submit" name="submit" class="button1">Iniciar Sesión</button> <br>

    <a href='forgot-password.php'>Olvidé la Contraseña</a>

    </div>


    </form>

    <?php 
    if(isset($_GET["error"]))
    {
        if($_GET["error"]=="envíovacío")
        {
            echo"<p class='warnings'>Olvidatse llenar todos los campos</p>";
        }
        else if($_GET["error"]=="wronglogin")
        {
            echo"<p class='warnings'>La contraseña o el usuario son incorrectos</p>";
        }
        else if($_GET["error"]=="bloqueado")
        {
            
            $reason=$_GET["reason"];
            $date=$_GET["date"];
           
            echo"<p class='warnings'>Usted ha sido Bloqueado.<br> Si tiene algún reclamo no dude en escribir.<br> Bloqueo hasta: ".$date."<br>Razón: ".$reason."</p>";
        }

    }

    if(isset($_GET["contraseñarecuperada"]))
    {
            
        echo"<p class='warnings' style='color:blue;'>Nueva contraseña enviada al correo</p>";
    
    }

    if(isset($_GET["validcode"]))
    {
            
        echo"<p class='warnings' style='color:blue;'>El código es correcto</p>";
    
    }
    
    ?>

</body>


</html>


<?php 
 ?>