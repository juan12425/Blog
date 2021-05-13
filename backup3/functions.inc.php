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

function updatetextssec($conn, $oldtitle, $title)
{
    $sql="UPDATE texts SET section=? WHERE section=?;";
    $stmt=mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: textos2.php?error=stmtfallidoalactualizarsecentexts");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $title, $oldtitle);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
}


function updatedestisection($conn, $oldtitle, $title, $newdesc)
{
    if(snotins($conn, $oldtitle)==false)
    {
    header("location: textos.php?error=Actualizaciónfallidanoseencuentralasección");
    }
    else
    {
        $sql="UPDATE sections SET title=?, description=? WHERE title=?;";
        $stmt=mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            header("location: textos.php?error=stmtfallidoalactualizar");   
            exit();
        }
        mysqli_stmt_bind_param($stmt, "sss", $title, $newdesc, $oldtitle);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        updatetextssec($conn, $oldtitle, $title);

        $result=getstatussec($conn, $title);
        $status=$result[0];
        $imgname=$result[1];


        if($status=="set")
        {
            $path='sections/'.$imgname;
            if(!unlink($path))
            {
                echo"Ha sucedido un error.";
            }
            else{

                unsetset2($conn, $title);
                header('location: textos.php?actualizaciónexitosa');
                exit();
            }
    
        }
    }
}

function deletest($conn, $sectionname)
{

    $sql="DELETE FROM sections WHERE title=?;";
    $stmt=mysqli_stmt_init($conn);
        
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: textos.php?error=stmtfallidoaleliminar");   
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $sectionname);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql="DELETE FROM texts WHERE section=?;";
    $stmt=mysqli_stmt_init($conn);
        
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: textos.php?error=stmtfallidoaleliminartextosdesecciones");   
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $sectionname);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: textos.php?error=none");
    exit();
}


function deletetext($conn, $title)
{
    $sql="DELETE FROM texts WHERE title=?;";
    $stmt=mysqli_stmt_init($conn);
        
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: textos2.php?error=stmtfallidoaleliminar");   
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $title);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $path='texts/'.$title.'.pdf';
    if(!unlink($path))
    {
        echo"Ha sucedido un error.";
    }
    else{
        header('location: textos2.php?eliminaciónexitosa');
        exit();
    }
}

function createsectionvideos($conn, $title, $description, $responsable, $responsableid)

{
    $sql="INSERT INTO videos (title, description, status, responsable, responsableid) VALUES (?, ?, ?, ?, ?);";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: videos.php?error=stmtfallido");   
        exit();
    }
    
    $status='none';
    mysqli_stmt_bind_param($stmt, "ssssi", $title, $description, $status, $responsable, $responsableid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: videos.php?error=none");
    exit();
}

function invalidtitlesectionvideos($title, $conn)
{
    $sql="SELECT * FROM videos WHERE title= ?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: videos.php?error=stmtfallido");   
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

function vnotinv($conn, $title)
{
    $sql="SELECT * FROM videos WHERE title= ?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: videos.php?error=stmtfallidoupimg");   
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $title);
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

function getstatusvid($conn, $title)
{
    $sql="SELECT status, img_name FROM videos WHERE title= ?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: videos.php?error=stmtfallidoupimg");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $title);
    mysqli_stmt_execute($stmt);

    $resultData=mysqli_stmt_get_result($stmt);

    $row=mysqli_fetch_row($resultData);
    return $row;

    mysqli_stmt_close($stmt);
}

function setset3($conn, $file_newname, $title){
    $sql="UPDATE videos SET status=?, img_name=? WHERE title=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: videos.php?error=stmtfallidoimg");   
        exit();
    }
    
  
    $status='set';
    
    mysqli_stmt_bind_param($stmt, "sss", $status, $file_newname, $title);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: videos.php?error=none");
    exit();
}

function unsetset3($conn, $sname){
    $sql="UPDATE videos SET status=?, img_name=? WHERE title=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: videos.php?error=stmtfallidoeliminaciónimg");   
        exit();
    }
    $img_name='NULL';
    $status="none";
    
    mysqli_stmt_bind_param($stmt, "sss", $status, $img_name, $sname);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}

function selectallvideos($conn) 
{
    $sql="SELECT title, description, status, img_name FROM videos;";
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

function updatedestisectionvideos($conn, $oldtitle, $title, $newdesc)
{
    if(vnotinv($conn, $oldtitle)==false)
    {
    header("location: videos.php?error=Actualizaciónfallidanoseencuentralasección");
    }
    else
    {
        $sql="UPDATE videos2 SET section=? WHERE section=?;";
        $stmt=mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            header("location: videos.php?error=stmtfallidoalactualizar");   
            exit();
        }
        mysqli_stmt_bind_param($stmt, "ss", $title, $oldtitle);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        $sql="UPDATE videos SET title=?, description=? WHERE title=?;";
        $stmt=mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            header("location: videos.php?error=stmtfallidoalactualizar");   
            exit();
        }
        mysqli_stmt_bind_param($stmt, "sss", $title, $newdesc, $oldtitle);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        //updatetextssec($conn, $oldtitle, $title);

        $result=getstatusvid($conn, $title);
        $status=$result[0];
        $imgname=$result[1];


        if($status=="set")
        {
            $path='videos/'.$imgname;
            if(!unlink($path))
            {
                echo"Ha sucedido un error.";
            }
            else{

                unsetset3($conn, $title);
                header('location: videos.php?=actualizaciónexitosa');
                exit();
            }
    
        }
    }
}

function invalidtitlevido2($title, $conn)
{
    $sql="SELECT * FROM videos2 WHERE title= ?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: videos2.php?error=stmtfallidott");   
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

function invalidlink($conn, $link)
{
    $result;
    if(!preg_match("/https:\/\/www.youtube.com/", $link))
    {
    $result=true;
    }
    else{
        $result=false;
    }
    return $result;
}

function insertvideo($conn, $title, $link, $section)
{
    $sql="INSERT INTO videos2 (title, link, section) VALUES (?, ?, ?);";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: videos2.php?error=stmtfallidovideos");   
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sss", $title, $link, $section);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: videos2.php?error=none");
    exit();

}

function selectallvideos2($conn, $section)
{
    $sql="SELECT title, link, section FROM videos2 WHERE section=? ;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: videos2.php?error=stmtfallidot");   
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $section);
    mysqli_stmt_execute($stmt);
    $resultData=mysqli_stmt_get_result($stmt);

    $c=mysqli_fetch_all($resultData);
    return $c;
    mysqli_stmt_close($stmt);
}

function checktitle($conn, $title)
{
    $sql="SELECT * FROM topics WHERE title= ?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: createtopic.php?error=stmtfallidott");   
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

function createtopic($conn, $title, $description)
{
    $sql="INSERT INTO topics (title, description) VALUES (?, ?);";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: createtopic.php?error=stmtfallidovideos");   
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $title, $description);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: agora.php?normal&error=none");
    exit();
}

function gettopics($conn)
{
    $sql="SELECT title, description FROM topics;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: agora.php?normal&error=stmtfallidot");   
        exit();
    }
    
    mysqli_stmt_execute($stmt);
    $resultData=mysqli_stmt_get_result($stmt);
    $c=mysqli_fetch_all($resultData);
    return $c;
    mysqli_stmt_close($stmt);

}

function createthread($conn, $title, $answer, $responsable, $responsable_id, $topic, $range, $date)
{
    $sql="INSERT INTO threads (title, answer, responsable, responsable_id, topic, rango, date) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: agora.php?topic=".$topic."&action=thread&error=stmtfallido");   
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sssisss", $title, $answer, $responsable, $responsable_id, $topic, $range, $date);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: agora.php?topic=".$topic."&error=none");
    exit();

}

function getthreads($conn, $topic)
{
    $sql="SELECT title, answer, responsable, rango, date, id FROM threads WHERE topic=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: agora.php?topic=".$topic."&error=stmtfallidot");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $topic);
    mysqli_stmt_execute($stmt);
    $resultData=mysqli_stmt_get_result($stmt);
    $c=mysqli_fetch_all($resultData);
    return $c;
    mysqli_stmt_close($stmt);
}

function generateanswers($conn, $answer, $responsable, $responsable_id, $range, $topic, $thread, $t_id, $date)
{
    $sql="INSERT INTO answers (answer, responsable, responsable_id, rango,  topic, thread, t_id, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: agora.php?topic=".$topic."&action=thread&error=stmtfallido");   
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssiissis", $answer, $responsable, $responsable_id, $range, $topic, $thread, $t_id, $date);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: agora.php?topic=".$topic."&error=none");
    exit();

}

function getanswers($conn, $id)
{
    $sql="SELECT id, answer, responsable, responsable_id, rango,  topic, thread, t_id, date FROM answers WHERE t_id=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: agora.php?topic=".$topic."&error=stmtfallidocargandorespuestas");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $resultData=mysqli_stmt_get_result($stmt);
    $c=mysqli_fetch_all($resultData);
    return $c;
    mysqli_stmt_close($stmt);

}

function updatetopic($conn, $title, $description)
{
    $sql="UPDATE topics SET description=? WHERE title=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: createtopic.php?error=stmtfallido");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $description, $title);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: agora.php?normal&error=none");
    exit();
  
}




function updatetopictitle($conn, $newtitle, $oldtitle)
{

    $sql="UPDATE topics SET title=? WHERE title=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: createtopic.php?error=stmtfallidot");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $newtitle, $oldtitle);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    
    
    
    $sql="UPDATE threads SET topic=? WHERE topic=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: createtopic.php?error=stmtfallidot");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $newtitle, $oldtitle);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    
    $sql="UPDATE answers SET topic=? WHERE topic=?";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: createtopic.php?error=stmtfallidot");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $newtitle, $oldtitle);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    header("location: agora.php?error=none");
    exit();
}

function deletetopic($conn, $title)
{
    $sql="DELETE FROM topics WHERE title=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: createtopic.php?error=stmtfallidot");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $title);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql="DELETE FROM threads WHERE topic=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: createtopic.php?error=stmtfallidot");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $title);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql="DELETE FROM answers WHERE topic=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: createtopic.php?error=stmtfallidot");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $title);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: agora.php?normal&error=none");
    exit();
    
}

function deletethread($conn, $title)
{
    $sql="DELETE FROM threads WHERE title=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: agora.php?normal&error=stmtfallidoeliminandohilo");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $title);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql="DELETE FROM answers WHERE thread=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: agora.php?normal&error=stmtfallidoeliminandohilo");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $title,);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: agora.php?normal&error=none");
    exit();
}

function  edittethread($conn, $id, $newtitle, $answer)
{
    $date=date("Y/m/d");
    $sql="UPDATE threads SET title=?, answer=?, date=? WHERE id=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: agora.php?error=stmtfallidotaleditarhilo");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "sssi", $newtitle, $answer, $date, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql="UPDATE answers SET thread=? WHERE t_id=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: agora.php?error=stmtfallidotaleditarhilo");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "si", $newtitle, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: agora.php?normal&error=none");
    exit();
}

function deleteanswer($conn, $id)
{
    $sql="DELETE FROM answers WHERE id=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: agora.php?normal&error=stmtfallidoeliminandorespuesta");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: agora.php?normal&error=none");   
    exit();
}

function updateanswer($conn, $id, $answer)
{
    $date=date("Y/m/d");
    $sql="UPDATE answers SET answer=?, date=? WHERE id=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: agora.php?error=stmtfallidotaleditarrespuesta");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ssi", $answer, $date, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: agora.php?normal&error=none");   
    exit();
}

function getuserinfo($conn, $user)
{
    $sql="SELECT*FROM users WHERE users_name= ?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: profile.php?error=stmtfallidoupimg");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);

    $resultData=mysqli_stmt_get_result($stmt);

    $row=mysqli_fetch_assoc($resultData);
    return $row;

    mysqli_stmt_close($stmt);

}

function deletesecvideos($conn, $title)
{
    $sql="DELETE FROM videos WHERE title=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: videos.php?normal&error=stmtfallido");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $title);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql="DELETE FROM videos2 WHERE section=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: videos.php?normal&error=stmtfallido");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $title);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: videos.php?normal&error=none");   
    exit();   


}

function deletevideo($conn, $title)
{
    $sql="DELETE FROM videos2 WHERE title=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: videos2.php?normal&error=stmtfallido");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $title);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: videos2.php?normal&error=none");   
    exit(); 
}

function blockuser($conn, $user, $date, $currentdate, $reason, $responsable, $email)
{
    $sql="INSERT INTO bans (user, date, currentdate, reason, responsable, ub_email) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: profile.php?profileuser=".$user."&error=stmtfallido");   
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssssss", $user, $date, $currentdate, $reason, $responsable, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: profile.php?profileuser=".$user."&error=none");
    exit();
}


function unblockuser($conn, $username)
{
    $sql="DELETE FROM bans WHERE user=? OR ub_email=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: log-in.php?error=stmtfallido");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $username, $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}



function userblocked($conn, $username)
{
    $sql="SELECT*FROM bans WHERE user= ? OR ub_email=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: log-in.php?error=stmtfallido");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $username, $username);
    mysqli_stmt_execute($stmt);

    $resultData=mysqli_stmt_get_result($stmt);
    $row=mysqli_fetch_assoc($resultData);
    if($row)
    {
        $currentdate=date("Y-m-d");
        $date=$row["date"];
        $reason=$row["reason"];
        mysqli_stmt_close($stmt);
     
        $datearray=explode("-", $date);
        $datecarray=explode("-", $currentdate);

        if(($datearray[0] > $datecarray[0]) || (($datearray[0] == $datecarray[0]) & (($datearray[1] > $datecarray[1]) || (($datearray[1] == $datecarray[1]) &  ($datearray[2] > $datecarray[1])))))
        {

            header("location: log-in.php?error=bloqueado&date=".$date."&reason=".$reason."");
            exit();
            
        }
        else if(($datearray[0] < $datecarray[0]) || (($datearray[0] == $datecarray[0]) & (($datearray[1] < $datecarray[1]) || (($datearray[1] == $datecarray[1]) &  ($datearray[2] < $datecarray[1])))))
        {
            unblockuser($conn, $username);
            $result=false;
            return $result;
    
        }   
    }
 
    else
    {
        $result=false;
        return $result;
    }

}

function checkuserblocked($conn, $username)
{
    $sql="SELECT*FROM bans WHERE user= ? OR ub_email=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: log-in.php?error=stmtfallido");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $username, $username);
    mysqli_stmt_execute($stmt);

    $resultData=mysqli_stmt_get_result($stmt);
    $row=mysqli_fetch_assoc($resultData);
    if($row)
    {
        $currentdate=date("Y-m-d");
        $date=$row["date"];
        mysqli_stmt_close($stmt);
     
        $datearray=explode("-", $date);
        $datecarray=explode("-", $currentdate);

        if(($datearray[0] > $datecarray[0]) || (($datearray[0] == $datecarray[0]) & (($datearray[1] > $datecarray[1]) || (($datearray[1] == $datecarray[1]) &  ($datearray[2] > $datecarray[1])))))
        {
            $result=true;
            return $result;
            
        }
    }
    else
    {
        mysqli_stmt_close($stmt);
        $result=false;
        return $result;
    }
 

}


function randstring($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
  
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
  
    return $randomString;
}



function createslide($conn, $file_newname)
{
    $sql="INSERT INTO slides (img_name) VALUES (?);";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: novedades.php?error=stmtfallido");   
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $file_newname);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: novedades.php?normal&error=none");
    exit();
}

function getimgnameslide($conn, $id)
{
    $sql="SELECT*FROM slides WHERE id=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: novedades.php?error=stmtfallido");   
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $resultData=mysqli_stmt_get_result($stmt);
    $row=mysqli_fetch_assoc($resultData);
    if($row)
    {
        return $row;
    }
    else
    {
        header("location: novedades.php?error=slidenoseencuentra");
        exit();
    }
    mysqli_stmt_close($stmt);

}

function deleteslidefromdb($conn,  $id)
{
    $sql="DELETE FROM slides WHERE id=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: novedades.php?error=stmtfallido");   
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
}

function getslides($conn)
{
    $sql="SELECT*FROM slides;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: novedades.php?stmtfallido");   
        exit();
    }
    
    mysqli_stmt_execute($stmt);
    $resultData=mysqli_stmt_get_result($stmt);
    $c=mysqli_fetch_all($resultData);
    return $c;
    mysqli_stmt_close($stmt);
}

function invalidtitlesectionnews($title, $conn)
{
    $sql="SELECT * FROM updates WHERE title= ?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: novedades.php?error=stmtfallidojjjj");   
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

function createsectionnews($conn, $title, $description, $cdate)

{
    $sql="INSERT INTO updates (title, description, cdate) VALUES (?, ?, ?);";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: novedades.php?error=stmtfallido");   
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "sss", $title, $description, $cdate);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: novedades.php?error=none");
    exit();
}

function updatedestisectionnews($conn, $oldtitle, $title, $newdesc)
{
   
    $sql="UPDATE updates SET title=?, description=? WHERE title=?;";
    $stmt=mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: novedades.php?error=stmtfallidoalactualizar");   
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sss", $title, $newdesc, $oldtitle);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
}

function deletesecnews($conn, $sectionname)
{

    $sql="DELETE FROM updates WHERE title=?;";
    $stmt=mysqli_stmt_init($conn);
        
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: novedades.php?error=stmtfallidoaleliminarnn");   
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $sectionname);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: novedades.php?error=none");   
    exit();
}

function selectallnews($conn) 
{
    $sql="SELECT title, description, cdate FROM updates;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: novedades.php?error=stmtfallidomum");   
        exit();
    }
   
    mysqli_stmt_execute($stmt);
    $resultData=mysqli_stmt_get_result($stmt);

    $c=mysqli_fetch_all($resultData);
    return $c;
    mysqli_stmt_close($stmt);
}

function  changerange($conn, $range, $email)
{

    $sql="UPDATE users SET rango=? WHERE users_email=?;";
    $stmt=mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: profile.php?error=stmtfallido");   
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $range, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: profile.php?error=none");
    exit();

}

function riot($conn)
{
    
    $sql="UPDATE users SET rango=? WHERE rango!=?;";
    $stmt=mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("location: profile.php?error=stmtfallido");   
        exit();
    }
    $range1=0;
    $range2=4;
    mysqli_stmt_bind_param($stmt, "ii", $range1, $range2);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: profile.php?error=none");
    exit();

}