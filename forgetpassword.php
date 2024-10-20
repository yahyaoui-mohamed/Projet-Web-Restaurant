<?php
session_start();

include "connect.php";
if (isset($_SESSION["user"])) {
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <title>Récuperez votre mot de passe</title>
</head>

<body>
  <div class="go-back">
    <a href="index.php">
      <i class="fi fi-rr-arrow-left"></i>
    </a>
  </div>
  <div class="forms">
    <div class="row">
      <div class="col-lg-4">
        <?php
        $message = "";

        use PHPMAILER\PHPMAILER\Exception;
        use PHPMAILER\PHPMAILER\PHPMAILER;



        if ($_SERVER["REQUEST_METHOD"] === "POST") {
          $email = $_POST["email"];
          $message = "
            <div class='alert alert-success alert-dismissible fade show' role='alert'> 
              Nous avons envoyé un email de réinitialisation du mot de passe à $email.
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";


          require './PHPMailer/PHPMailer/src/Exception.php';
          require './PHPMailer/PHPMailer/src/PHPMailer.php';
          require './PHPMailer/PHPMailer/src/SMTP.php';
          require './functions/GeneratePassword.php';
          $password = GeneratePassword();

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


          $mail->addAddress($email);

          $mail->isHTML(true);
          $mail->Subject = "Récuperer votre mot de passe";
          $mail->Body = "Bonjour monsieur; <br><br>
          Voilà votre nouveau mot de passe temporaire : $password ";
          $mail->send();

          $query = $connect->prepare("UPDATE users SET mdp = '$password' AND mdp_risk = 1 WHERE email = '$email'");
          $query->execute();
        }
        ?>
        <form class="login-form" method="POST" action="">
          <h1>Mot de passe oublié</h1>
          <p>Entrez votre email pour récuperer votre mot de passe.</p>
          <?= $message ?>

          <div class="mb-3">
            <label for="email">Email</label>
            <input id="email" type="email" required name="email" autocomplete="off">
          </div>

          <div class="mb-3">
            <input type="submit" value="Valider">
          </div>
        </form>
      </div>
      <div class="col-lg-8"></div>
    </div>

  </div>


  <script src="js/main.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>