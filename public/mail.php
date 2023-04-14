<?php

require_once("../vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;

function sendMail($subject, $body, $email, $name, $html = false)
{
    // Configuración inicial de nuestro servidor de correos

    $phpmailer = new PHPMailer();
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.gmail.com';
    $phpmailer->SMTPAuth = true;
    $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $phpmailer->Port = 465;
    $phpmailer->Username = 'tucorreo@mail.com';
    $phpmailer->Password = 'tucontraseña';

    //  Añadiendo destinatarios
    $phpmailer->setFrom('tucorreo@mail.com', 'Formulario de contacto');
    $phpmailer->addAddress('correodondelorecibes@mail.com', $name);

    // Definiendo el contenido de mi email
    $phpmailer->isHTML($html);
    $phpmailer->Subject = $subject;
    $phpmailer->Body    = $body;

    // Mandar el correo
    $phpmailer->send();
}
