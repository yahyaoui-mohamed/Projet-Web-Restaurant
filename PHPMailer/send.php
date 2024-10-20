<?php

use PHPMAILER\PHPMAILER\PHPMAILER;
use PHPMAILER\PHPMAILER\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
  echo $_POST["email"];
  echo $_POST["sujet"];
  echo $_POST["message"];
  $mail = new PHPMAILER(true);
  $mail->isSMTP();
  $mail->Host = "smtp.gmail.com";
  $mail->SMTPAuth = true;
  $mail->Username = "hamayah4@gmail.com";
  $mail->Password = "duek lrnz morl vxjg
";
  $mail->SMTPSecure = "ssl";
  $mail->Port = 465;


  $mail->setFrom("hamayah4@gmail.com");


  $mail->addAddress($_POST["email"]);

  $mail->isHTML(true);

  $mail->Subject = $_POST["sujet"];
  $mail->Body = $_POST["message"];

  $mail->send();
}




// djdc zqmx rqfm fgkr