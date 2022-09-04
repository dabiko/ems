<?php
require 'class.phpmailer.php';
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = 'smtp';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->Host = "smtp.gmail.com";
$mail->IsHTML(true);


$mail->SMTPAuth = true;
$mail->Username = "dabiko.blaise@gmail.com";
$mail->Password = "dabikosadler";

//Sender Info
$mail->From = "no-reply@blastadmin.com";
$mail->FromName = "BLAST Admin Support";

