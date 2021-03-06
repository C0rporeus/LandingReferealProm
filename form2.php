<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

$errors = [];

if (!empty($_POST)) {
  $tiktok = $_POST['tiktok'];
  $email = $_POST['email'];
  $message = $_POST['message'];


  if (empty($tiktok)) {
    $errors[] = 'Username is empty';
  }

  if (empty($email)) {
    $errors[] = 'Email is empty';
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Email is invalid';
  }
  if (!empty($errors)) {
    $allErrors = join('<br/>', $errors);
    $errorMessage = "<p style='color: red;'>{$allErrors}</p>";
  } else {
    $mail = new PHPMailer();

    // specify SMTP credentials
    // specify SMTP credentials
    $mail->isSMTP();
    $mail->SMTPDebug  = 1;
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = '';
    $mail->Password = '';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 465;

    $mail->setFrom('');
    $mail->addAddress('', '');
    $mail->Subject = 'Nuevo mensaje de formulario';

    // Enable HTML if needed
    $mail->isHTML(true);

    $bodyParagraphs = ["TikTok: {$tiktok}", "Email: {$email}", "Message: {$message}"];
    $body = join('<br />', $bodyParagraphs);
    $mail->Body = $body;

    echo $body;
    if ($mail->send()) {

      header('Location: index.php'); // redirect to 'thank you' page
    } else {
      $errorMessage = 'Oops, something went wrong. Mailer Error: ' . $mail->ErrorInfo;
    }
  }
}
