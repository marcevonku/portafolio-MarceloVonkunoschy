<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$mensaje = $_POST['mensaje'];

var_dump($nombre);
var_dump($email);
var_dump($mensaje);


try {
    // Configuración del servidor
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'marcevonku@gmail.com'; // tu correo Gmail
    $mail->Password = 'pnhj uzdf xjof labw';       // tu contraseña o app password
    //$mail->SMTPSecure = 'tls';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Remitente y destinatario
    $mail->setFrom('marcevonku@gmail.com', 'Marcelo Vonkunoschy');
    $mail->addAddress('marcevonku@gmail.com');
    // Asegurar que las cabeceras estén en UTF-8
    $mail->CharSet = 'UTF-8';  // Codificación UTF-8
    // Contenido
    $mail->isHTML(true);
    $mail->Subject =     mb_convert_encoding('Estamos interesados en contactarte', 'UTF-8', 'auto');
    $mail->Body    = mb_convert_encoding('Estimado Marcelo Vonkunoschy: <br> <b>' . $mensaje . '</b><br> ' . $email . '<br> ' . $nombre, 'UTF-8', 'auto');
    $mail->send();
    // echo 'Mensaje enviado correctamente';
    // return true;
    header('Location: index.php');
    exit;
} catch (Exception $e) {
    return "Error al enviar correo: {$mail->ErrorInfo}";
}
