<?php

function emptyInputSignup($name, $email, $username, $password,  $rpassword)
{
    $result;
    if(empty($name) || empty($email) || empty($username) || empty($password) || empty($rpassword) )
    {
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}

function inavaliduser($username)
{
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
    $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}

function invalidemail($email)
{
    $result;
    if(!preg_match("/@ljrj.net/", $email))
    {
    $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}

function pwdMatch($rpassword, $password)
{
    $result;
    if($rpassword !== $password)
    {
    $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}

function userexists($conn, $username, $email)
{
    $sql="SELECT * FROM users WHERE users_name= ? OR users_email=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: sign-up.php?error=stmtfallido");   
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData=mysqli_stmt_get_result($stmt);

    if($row=mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result=false;
        return $result;
    }

    mysqli_stmt_close($stmt);

}

function createUser($conn, $name, $email, $username, $rpassword)

{
    $sql="INSERT INTO users (u_name, users_email, users_name, pwd, rango, profile_img) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: sign-up.php?error=stmtfallido");   
        exit();
    }
    
    $rango=0;
    $profile_img='none';
    $hashed=password_hash($rpassword, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssssis", $name, $email, $username,  $hashed, $rango,  $profile_img);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: log-in.php?error=none");   
    exit();
}


function emptyInputlogin($username, $pwd)
{
    $result;
    if(empty($username) || empty($pwd)){
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;

}

function loginUser($conn, $username, $pwd )
{

    $userExists= userexists($conn, $username, $username);
   
    if($userExists == false)
    {
     header("location: log-in.php?error=wronglogin");   
    }

    $pwdhashed=$userExists["pwd"];
    $checkpwd=password_verify($pwd, $pwdhashed);

    if($checkpwd==false)
    {
    header("location: log-in.php?error=wronglogin");
    }
    else if($checkpwd==true){
    session_start();
    $_SESSION["users_id"]=$userExists["users_id"];
    $_SESSION["users_name"]=$userExists["users_name"];
    $_SESSION["real_name"]=$userExists["u_name"];
    $_SESSION["Rol"]=$userExists["rol"];
    $_SESSION["rango"]=$userExists["rango"];
    $_SESSION["email"]=$userExists["users_email"];

    header("location: profile.php");
    exit();
    }

}

function checkset($username, $conn)
{
    $userExists= userexists($conn, $username, $username);
    $status=$userExists['profile_img'];
    return $status;

    
}

function getuserid($conn, $username){

    $userExists= userexists($conn, $username, $username);
    $id=$userExists['users_id'];
    return $id;
}

function setset($conn, $file_newname, $users_name){
    $sql="UPDATE users SET profile_img=?, profile_imgname=? WHERE users_name=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: profile.php?error=stmtfallido");   
        exit();
    }
    
  
    $profile_img='set';
    
    mysqli_stmt_bind_param($stmt, "sss", $profile_img, $file_newname, $users_name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: profile.php?error=none");
    exit();
}


function getimgname($username, $conn)
{
    $userExists= userexists($conn, $username, $username);
    $status=$userExists['profile_imgname'];
    return $status;

    
}

function unsetset($conn, $file_newname, $users_name){
    $sql="UPDATE users SET profile_img=?, profile_imgname=? WHERE users_name=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: profile.php?error=stmtfallido");   
        exit();
    }
    
  
    $profile_img='none';
    
    mysqli_stmt_bind_param($stmt, "sss", $profile_img, $file_newname, $users_name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: profile.php?error=none");
    exit();
}





function updateuserinfo($conn,$olduser, $user, $name, $rol)
{
$sql="UPDATE users SET u_name=?, users_name=?, rol=? WHERE users_name=?;";
$stmt=mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql))
{
    header("location: profile.php?error=stmtfallido");
}

mysqli_stmt_bind_param($stmt, "ssss", $name, $user, $rol, $olduser);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
header("location: log-out.php?error=none");
exit();
}




function emptysection($title, $description)
{
    $result;
    
    if(empty($title) || empty($description))
    {
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;

}

function invalidtitlesection($title, $conn)
{
    $sql="SELECT * FROM sections WHERE title= ?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: newsection.php?error=stmtfallido");   
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $title);
    mysqli_stmt_execute($stmt);

    $resultData=mysqli_stmt_get_result($stmt);

    if($row=mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result=false;
        return $result;
    }

    mysqli_stmt_close($stmt);

}

function createsection($conn, $title, $description, $responsable, $responsableid)

{
    $sql="INSERT INTO sections (title, description, status, responsable, responsableid) VALUES (?, ?, ?, ?, ?);";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: textos.php?error=stmtfallido");   
        exit();
    }
    
    $status='none';
    mysqli_stmt_bind_param($stmt, "ssssi", $title, $description, $status, $responsable, $responsableid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: textos.php?error=none");
    exit();
}

function setset2($conn, $file_newname, $title){
    $sql="UPDATE sections SET status=?, img_name=? WHERE title=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: textos.php?error=stmtfallidoimg");   
        exit();
    }
    
  
    $status='set';
    
    mysqli_stmt_bind_param($stmt, "sss", $status, $file_newname, $title);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: textos.php?error=none");
    exit();
}

function selectall($conn) 
{
    $sql="SELECT title, description, status, img_name FROM sections;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: index.php?error=stmtfallidotextos");   
        exit();
    }
   
    mysqli_stmt_execute($stmt);
    $resultData=mysqli_stmt_get_result($stmt);

    $c=mysqli_fetch_all($resultData);
    return $c;
    mysqli_stmt_close($stmt);
}

function snotins($conn, $sname)
{
    $sql="SELECT * FROM sections WHERE title= ?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: textos.php?error=stmtfallidoupimg");   
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $sname);
    mysqli_stmt_execute($stmt);

    $resultData=mysqli_stmt_get_result($stmt);

    if($row=mysqli_fetch_assoc($resultData)){
        $result=true;
        return $result;
    }
    else{
        $result=false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function getstatussec($conn, $sname)
{
    $sql="SELECT status, img_name FROM sections WHERE title= ?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: textos.php?error=stmtfallidoupimg");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $sname);
    mysqli_stmt_execute($stmt);

    $resultData=mysqli_stmt_get_result($stmt);

    $row=mysqli_fetch_row($resultData);
    return $row;

    mysqli_stmt_close($stmt);
}

function unsetset2($conn, $sname){
    $sql="UPDATE sections SET status=?, img_name=? WHERE title=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: textos.php?error=stmtfallidoeliminaciónimg");   
        exit();
    }
    
  
    $img_name='NULL';
    $status="none";
    
    mysqli_stmt_bind_param($stmt, "sss", $status, $img_name, $sname);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function invalidtitletext($title, $conn)
{
    $sql="SELECT * FROM texts WHERE title= ?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: texts2.php?error=stmtfallidott");   
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $title);
    mysqli_stmt_execute($stmt);

    $resultData=mysqli_stmt_get_result($stmt);

    if($row=mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result=false;
        return $result;
    }

    mysqli_stmt_close($stmt);

}

function emptyfieldstext($section, $title, $author, $author_e, $date, $data, $file)
{
    $result;
    
    if(empty($section) || empty($title) || empty($author) || empty($author_e) || empty($date) || empty($data) || empty($file))
    {
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}

function newtext($conn, $section, $title, $author, $author_e, $date, $data, $pdf)
{
    $sql="INSERT INTO texts (title, author, author_e, date, description, pdf_name, section) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: textos2.php?error=stmtfallido");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "sssssss", $title, $author, $author_e, $date, $data, $pdf, $section );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function selectall2($conn, $section)
{
    $sql="SELECT title, author, author_e, date, description, pdf_name FROM texts WHERE section=? ;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: index.php?error=stmtfallidotextos2");   
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $section);
    mysqli_stmt_execute($stmt);
    $resultData=mysqli_stmt_get_result($stmt);

    $c=mysqli_fetch_all($resultData);
    return $c;
    mysqli_stmt_close($stmt);
}

function aimp($conn, $author_e)
{
    $sql="SELECT * FROM users WHERE users_email=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: sign-up.php?error=stmtfallido");   
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $author_e);
    mysqli_stmt_execute($stmt);

    $resultData=mysqli_stmt_get_result($stmt);

    if($row=mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result=false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}