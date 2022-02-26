<?php

require_once "dbh.inc.php";
require_once "functions.inc.php";

session_start();
$action="cerrar_sesión";
$data= NULL;
logs123($conn, $action, $data);
session_unset();
session_destroy();
header("location: log-in.php");