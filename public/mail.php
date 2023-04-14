<?php

require_once("../vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;

function sendMail($subject, $body, $name, $html = false)
{
    // Configuración inicial de nuestro servidor de correos

    $phpmailer = new PHPMailer();
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp de tu servidor de correos';
    $phpmailer->SMTPAuth = true;
    $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $phpmailer->Port = 465;
    $phpmailer->Username = 'tu Correo';
    $phpmailer->Password = 'tu Contraseña';

    //  Añadiendo destinatarios
    $phpmailer->setFrom('tu correo', 'Formulario de contacto');
    $phpmailer->addAddress('Correo donde recibirás el mensaje', $name);

    // Definiendo el contenido de mi email
    $phpmailer->isHTML($html);
    $phpmailer->Subject = $subject;
    $phpmailer->Body    = $body;

    // Mandar el correo
    $phpmailer->send();
}
