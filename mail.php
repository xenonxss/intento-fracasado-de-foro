<?php
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
function enviarmail($asunto,$destinatario, $html){
    require 'vendor/autoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();                                  
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true;                         
    $mail->Username = 'foroxswebmaster@gmail.com';              
    $mail->Password = 'tumamalachupa';                        
    $mail->SMTPSecure = 'ssl';                          
    $mail->Port = 465;                                   
    $mail->From = 'foroxswebmaster@gmail.com';  
    $mail->FromName = 'ForoXSS';           
    $mail->Subject = $asunto;                
    $mail->addAddress($destinatario);
    $mail->isHTML(true);                              
    $mail->Body    = $html;
    $mail->AltBody = 'Eres re gay';
    $mail->setLanguage('es');
    if(!$mail->send()) {
        return false;
    } else {
        return true;
    }
}

?>

<h1>Hey, ¿te gustan los secretos?</h1>

<h4>Aqui encontrarás uno --> <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">pincha aqui</a></h4>