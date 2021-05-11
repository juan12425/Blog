<?php
session_start()
?>

<?php
require_once "dbh.inc.php";
require_once "functions.inc.php";

if(isset($_POST["submit"]))
{
    $answer=$_POST["answer"];
    $responsable=$_SESSION["users_name"];
    $responsable_id= $_SESSION["users_id"];
    $range=$_SESSION["rango"];
    $topic=$_GET["topic"];
    $thread=$_GET["title"];
    $t_id=$_GET["id"];
    $date=date("Y/m/d");
    if(empty("answer"))
    {
        header("location: newanswer.php?topic=".$topic."&title=".$title."&id=".$id."&error=camposvacios");
        exit();
    }

    generateanswers($conn, $answer, $responsable, $responsable_id, $range, $topic, $thread, $t_id, $date);
    
}

if(isset($_POST["deleteanswer"]))
{
    $id=$_GET["id"];
    deleteanswer($conn, $id);
}

if(isset($_POST["submitedit"]))
{
    $id=$_GET["id"];
    $answer=$_POST["answer"];
    updateanswer($conn, $id, $answer);
}

