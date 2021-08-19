<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer;

/** Configurar SMTP **/
$mail->isSMTP();                                      // Indicamos que use SMTP
$mail->Host = 'smtp1.dominio.com;smtp2.dominio.com';  // Indicamos los servidores SMTP
$mail->SMTPAuth = true;                               // Habilitamos la autenticación SMTP
$mail->Username = 'user@example.com';                 // SMTP username
$mail->Password = 'XXXXXX';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Habilitar encriptación TLS o SSL
$mail->Port = 587;                                    // TCP port

/** Configurar cabeceras del mensaje **/
$mail->From = 'tu@correo.com';                       // Correo del remitente
$mail->FromName = 'Tu nombre y apellidos';           // Nombre del remitente
$mail->Subject = 'Asunto del correo';                // Asunto

/** Incluir destinatarios. El nombre es opcional **/
$mail->addAddress('destinatario1@correo.com', 'Nombre1');
$mail->addAddress('destinatario2@correo.com', 'Nombre2');
$mail->addAddress('destinatario3@correo.com', 'Nombre3');

/** Con RE, CC, BCC **/
$mail->addReplyTo('info@correo.com', 'Informacion');
$mail->addCC('cc@correo.com');
$mail->addBCC('bcc@correo.com');

/** Incluir archivos adjuntos. El nombre es opcional **/
$mail->addAttachment('/archivos/miproyecto.zip');        
$mail->addAttachment('/imagenes/imagen.jpg', 'nombre.jpg');

/** Enviarlo en formato HTML **/
$mail->isHTML(true);                                  

/** Configurar cuerpo del mensaje **/
$mail->Body    = 'Este es el mensaje en HTML <b>en negrita!</b>';
$mail->AltBody = 'Este es el mansaje en texto plano para clientes que no admitan HTML';

/** Para que use el lenguaje español **/
$mail->setLanguage('es');

/** Enviar mensaje... **/
if(!$mail->send()) {
    echo 'El mensaje no pudo ser enviado.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Mensaje enviado correctamente';
}

