<?php 
include_once 'header.php';
?>
    
    <body class="body1">
    

    <div class="div124">
    <h1 style="font-family:Lobster;" class="textcolor">Registro</h1>
    
    
    <form action="signup.inc.php" method="post"> 
    <input type="text" name="name"  placeholder="Nombre" class="textbox"> <br><br>
    <input type="text" name="email"  placeholder="Email" class="textbox"> <br><br>
   
    <input type="text" name="user"  placeholder="Usuario" class="textbox"> <br><br>
 
    <input type="password" name="password"  placeholder="Contraseña" class="textbox"> <br><br>
    <input type="password" name="rpassword"  placeholder="Repite la Contraseña" class="textbox"> <br><br>
    <button type="submit" name="submit" class="button1">Registrarse</button> <br>

    </div>


    </form>


    <?php 
    if(isset($_GET["error"]))
    {
        if($_GET["error"]=="envíovacío")
        {
            echo"<p class='warnings'>Olvidatse llenar todos los campos</p>";
        }
        else if($_GET["error"]=="nombreinválido")
        {
            echo"<p class='warnings'>Nombre de usuario inválido</p>";
        }

        else if($_GET["error"]=="emailinválido")
        {
            echo"<p class='warnings'>Email inválido</p>";
        }
        else if($_GET["error"]=="contraseñasnosoniguales")
        {
            echo"<p class='warnings'>Las contraseñas introducidas no son iguales</p>";
        }
        else if($_GET["error"]=="nombredeusuarioyaexiste")
        {
            echo"<p class='warnings'>El email o el nombre de usuario ya existe</p>";
        }
        else if($_GET["error"]=="stmtfallido")
        {
            echo"<p class='warnings'>Algo salió mal contacte con los admin</p>";
        }
        else if($_GET["error"]=="none")
        {
            echo"<p class='warnings'>Te has registrado</p>";
        }
    }
    
    ?>
</body>


</html>


<?php 
 ?>