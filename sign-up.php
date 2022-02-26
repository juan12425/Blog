<?php 
include_once 'header.php';
?>
<body class="body1">

 <?php 

    if(isset($_GET['normal']))
    {
        echo '
        
        

        <div class="div124 position1">
        <h1 style="font-family:Lobster;" class="textcolor">Registro</h1>
        
        
        <form action="signup.inc.php" method="post"> 
        <input type="text" name="name"  placeholder="Nombre" class="textbox"> <br><br>
        <input type="text" name="email"  placeholder="Email" class="textbox"> <br><br>
    
        <input type="text" name="user"  placeholder="Usuario" class="textbox"> <br><br>
    
        <input type="password" name="password"  placeholder="Contraseña" class="textbox"> <br><br>
        <input type="password" name="rpassword"  placeholder="Repite la Contraseña" class="textbox"> <br><br>
        <button type="submit" name="submit" class="button1">Registrarse</button> <br>

        </form>

        </div>';

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
            else if($_GET["error"]=="contraseñamuycorta")
            {
                echo"<p class='warnings'>La contraseña debe ser mayor a 6 caracteres</p>";
            }
        }

    }

    else if(isset($_GET['code']) & isset($_GET['email']) )
    {
        $email=$_GET['email'];

        echo'
        <div class="div124 position1">
        <h1 style="font-family:Lobster;" class="textcolor">Código de Verificación</h1>
        <form action="signup.inc.php?email='.$email.'" method="POST">
        <input type="text" name="code" class="textbox"><br>
        <button type="submit" name="sendcode" class="button1">Confirmar</button>
        <p class="warnings" style="color:blue;">Código enviado al correo: '.$email.'</p>
        </form>
        </div>
        ';

        if(isset($_GET['error']))
        {
            if($_GET['error']=="códigoinválido")
            {
                echo'<p class="warnings">El código es incorrecto</p>';
            }
        }

    }

    

    ?>

</body>


</html>


<?php 
 ?>