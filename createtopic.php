<?php
session_start();
if(isset($_SESSION["users_id"]))
{
    $range=$_SESSION["rango"];
    if($range==1 || $range==4)
    {
        echo"Crear nuevo tópico";
        echo '
        <form action="newtopic.php" method="POST">
        <p>Título</p>
        <input type="text" name="title">
        <p>Descripción</p>
        <textarea name="description" rows="20" cols="50"></textarea>
        <button type="submit" name="submit">Crear</button>
        </form>
        ';
        echo"Editar descripción tópico";
        echo '
        <form action="newtopic.php" method="POST">
        <p>Título del Tópico</p>
        <input type="text" name="title">
        <p>Nueva Descripción</p>
        <textarea name="description" rows="20" cols="50"></textarea>
        <button type="submit" name="submitedit">Actualizar</button>
        </form>
        
        <p>Cambiar título</p>
        <form action="newtopic.php" method="POST">
        <p>Título del Tópico</p>
        <input type="text" name="oldtitle">
        <p>Nuevo Título</p>
        <input type="text" name="newtitle">
        <button type="submit" name="submitedittitle">Actualizar</button>
        </form>';
    }
    if($_SESSION["rango"]==4)
    {
        echo'
        <h2 style="color:red">Eliminar Tópico</h2>
        <form action="newtopic.php" method="POST">
        <p>Título del Tópico</p>
        <input type="text" name="title">
        <button type="submit" name="eliminar">Actualizar</button>
        </form>';
    }
}