<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function mymail($emailrecp, $code)
{
    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'correo';                     //SMTP username
        $mail->Password   = 'clave';                               //SMTP password
        $mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('correo', 'Blog');
        $mail->addAddress($emailrecp);     //Add a recipient
                    
    

        

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'CODIGO DE VERIFICACION';
        $mail->Body    = 'Código: '.$code.' <br>Enlace: <a href="localhost/blog2/sign-up.php?error=none&code&email='.$emailrecp.'">localhost/blog2/sign-up.php?error=none&code&email='.$emailrecp.'</a>';

        $mail->send();
    } catch (Exception $e) {
        echo "Mensaje no se pudo enviar: {$mail->ErrorInfo}";
    }

}

function mymailpwd($emailrecp, $pwd)
{
    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'correo';                     //SMTP username
        $mail->Password   = 'clave';                               //SMTP password
        $mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('correo', 'Blog');
        $mail->addAddress($emailrecp);     //Add a recipient
                    
    

        

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'NUEVA CONTRASEÑA';
        $mail->Body    = 'Contraseña: '.$pwd;

        $mail->send();
    } catch (Exception $e) {
        echo "Mensaje no se pudo enviar: {$mail->ErrorInfo}";
    }

}