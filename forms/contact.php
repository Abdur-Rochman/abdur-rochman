<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $subject = htmlspecialchars($_POST['subject']);
  $message = htmlspecialchars($_POST['message']);

  $mail = new PHPMailer(true);

  try {
    // SMTP Settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'abdurrochman195@gmail.com'; // ganti dengan Gmail kamu
    $mail->Password = 'YOUR_APP_PASSWORD';    // pakai App Password, bukan password Gmail biasa
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Email pengirim & penerima
    $mail->setFrom($email, $name);
    $mail->addAddress('abdurrochman195@gmail.com'); // email tujuanmu

    // Konten email
    $mail->isHTML(false);
    $mail->Subject = $subject;
    $mail->Body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

    $mail->send();
    echo "OK";
  } catch (Exception $e) {
    echo "Error: Email gagal dikirim. {$mail->ErrorInfo}";
  }
} else {
  echo "Error: Invalid request.";
}
?>
