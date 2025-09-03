<?php
// Load PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name    = htmlspecialchars($_POST['name']);
    $email   = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars($_POST['message']);

    if (!$email) {
        die("Invalid email address.");
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'nu2107028@gmail.com';      // Your Gmail
        $mail->Password   = 'qehd tlpi nsgk zxlp';      // Gmail App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom($email, $name);                  
        $mail->addAddress('shoaibhasan425@gmail.com');  
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(false);                           
        $mail->Subject = "New Contact Form Message from $name";
        $mail->Body    = "You have received a new message from your portfolio contact form.\n\n"
                       . "Name: $name\n"
                       . "Email: $email\n\n"
                       . "Message:\n$message";

        $mail->send();

        // ✅ Redirect to portfolio page after success
        header("Location: index.php?status=success");
        exit(); // important to stop execution after redirect

    } catch (Exception $e) {
        // Redirect with error status if sending fails
        header("Location: index.php?status=error&message=" . urlencode($mail->ErrorInfo));
        exit();
    }

} else {
    header("Location: index.php?status=invalid");
    exit();
}
