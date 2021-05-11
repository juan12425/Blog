<?php
session_start()
?>

<?php
require_once "dbh.inc.php";
require_once "functions.inc.php";

if(isset($_POST["submit"]))
{
    $title=$_POST["title"];
    $answer=$_POST["answer"];
    $responsable=$_SESSION["users_name"];
    $responsable_id= $_SESSION["users_id"];
    $range=$_SESSION["rango"];
    $topic=$_GET["topic"];
    $date=date("Y/m/d");
    if(empty($title) || empty($answer))
    {
        header("location: Ágora.php?topic=".$topic."&action=thread&error=camposvacios");
        exit();
    }

    createthread($conn, $title, $answer, $responsable, $responsable_id, $topic, $range, $date);
}

if(isset($_POST["deletethread"]))
{
    $title=$_GET["thread"];
   deletethread($conn, $title);
}

if(isset($_POST["submitedit"]))
{
    $id=$_GET["id"];
    $newtitle=$_POST["title"];
    $answer=$_POST["answer"];
    edittethread($conn, $id, $newtitle, $answer);
}

