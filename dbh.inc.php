<?php 

$serverName="localhost";
$dbUsername="root";
$dbpassword="";
$dbName="loginsystem";

$conn = mysqli_connect($serverName, $dbUsername, $dbpassword, $dbName );

if(!$conn){
    die("Conexión fallida: ". mysqli_connect_error());

    

}



