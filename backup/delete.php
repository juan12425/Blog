<?php
session_start()
?>

<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

$imgname=getimgname($_SESSION["users_name"], $conn);
$path='files/'.$imgname;

if(isset($_POST['submit'])){
if(!unlink($path))
{
    echo"Ha sucedido un error.";
}
else{
    $filename='NULL';
    unsetset($conn,  $filename , $_SESSION["users_name"]);
    head('location: profile.php?error=none');
}
}