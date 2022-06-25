<?php

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  require_once "vendor\phpmailer\phpmailer\src\PHPMailer.php";
  require_once "vendor\phpmailer\phpmailer\src\SMTP.php";
  require_once "vendor\phpmailer\phpmailer\src\Exception.php";

  function smtpMailer($toEmail, $emailSubject, $emailBody) {

    $mail = new PHPMailer(true);

    $mail->SMTPDebug = 2;
    $mail->isSMTP();                                            // Send using SMTP

    $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'ghulammustafa9901@gmail.com';          // SMTP username
    $mail->Password   = 'wzbmpggqgwypfdvf';                         // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged  PHPMailer::ENCRYPTION_SMTPS Means TLS
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('ghulammustafa9901@gmail.com', 'TUF Portfolio');
    $mail->addAddress($toEmail);                       // Add a recipient, Name is optional

    // Content
    $mail->isHTML(true);                                        // Set email format to HTML
    $mail->Subject = $emailSubject;
    $mail->Body    = $emailBody;
    $mail->AltBody = 'Hello ';
    $mail->send();

  }

?>
