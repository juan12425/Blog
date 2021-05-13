<?php 
include_once 'header.php';
?>
    
    <body class="body1">
    
    <div class="div124 position1" >
    <h1 style="font-family:Lobster;">Iniciar Sesión</h1>
    <form action="login.inc.php" method="post"> 
    
    <input type="text" name="name"  placeholder="Usuario/Email" class="textbox"> <br>
    
    <input type="password" name="password"  placeholder="Contraseña" class="textbox"> <br><br>
    
    <button type="submit" name="submit" class="button1">Iniciar Sesión</button> <br>

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

    
    ?>

</body>


</html>


<?php 
 ?>