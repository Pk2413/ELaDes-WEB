<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer autoload file
require 'vendor/autoload.php';

// Generate random OTP
$otp = mt_rand(100000, 999999);

// Simpan OTP di sesi atau database
$_SESSION['kode_otp'] = $otp;

// Email configuration
$to = "ananda.aa70@gmail.com"; // Ganti dengan alamat email tujuan
$subject = "Kode OTP untuk Verifikasi";
$message = "Kode OTP Anda: $otp";

// Send email using PHPMailer
$mail = new PHPMailer(true);
try {
    $mail->setFrom('coba-coba@no-reply.email.co.id', 'kode OTP');
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Uncomment the following line if you are using a local SMTP server
    // $mail->isSMTP(); 

    // Uncomment the following lines and set your SMTP configuration if using an external SMTP server
    /*
    $mail->Host = 'smtp.example.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your_username';
    $mail->Password = 'your_password';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    */

    $mail->send();
    echo "Email berhasil dikirim dengan kode OTP.";
} catch (Exception $e) {
    echo "Email gagal dikirim. Error: {$mail->ErrorInfo}";
}
