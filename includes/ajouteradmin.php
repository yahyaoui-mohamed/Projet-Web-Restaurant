<?php

use PHPMAILER\PHPMAILER\PHPMAILER;
use PHPMAILER\PHPMAILER\Exception;

require './PHPMailer/PHPMailer/src/Exception.php';
require './PHPMailer/PHPMailer/src/PHPMailer.php';
require './PHPMailer/PHPMailer/src/SMTP.php';


$resp = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nom = $_POST["nom"];
  $prenom = $_POST["prenom"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $tel = $_POST["tel"];
  $role = $_POST["role"];
  $query = $connect->prepare(
    "INSERT INTO users VALUES ('','$nom','$prenom','$email','$password','0','$tel','','$role')"
  );
  $query->execute();
  $resp = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  Admin ajouté avec succès!
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";

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
  $role = $_POST["role"] == 2 ? "Admin" : "Livreur";
  $mail->Subject = "Votre compte $role";
  $mail->Body = "Bonjour monsieur $_POST[prenom], <br><br>
    Votre compte $role vient de se créer, <br><br>

    Email : $_POST[email] <br>
    Mot de passe : $_POST[password]
  ";

  $mail->send();
}
?>

<h1>Ajouter un admin</h1>
<?= $resp ?>
<form action="" method="POST">
  <div class="row">
    <div class="col-lg-6">
      <div class="mb-3">
        <input type="text" class="form-control" name="nom" placeholder="Nom">
      </div>
    </div>
    <div class="col-lg-6">
      <div class="mb-3">
        <input type="text" class="form-control" name="prenom" placeholder="Prénom">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6">
      <div class="mb-3">
        <input type="email" class="form-control" name="email" placeholder="Email">
      </div>
    </div>
    <div class="col-lg-6">
      <div class="mb-3">
        <input type="password" class="form-control" name="password" placeholder="Mot de passe">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6">
      <div class="mb-3">
        <input type="text" name="tel" placeholder="Téléhpone" class="form-control">
      </div>
    </div>

    <div class="col-lg-6">
      <div class="mb-3">
        <select name="role" class="form-select">
          <option value="" selected>Choisissez le rôle</option>
          <option value="1">Super Admin</option>
          <option value="2">Admin</option>
          <option value="3">Livreur</option>
        </select>
      </div>
    </div>

  </div>

  <div class="col-lg-6">
    <div class="mb-3">
      <input type="submit" value="Ajouter">
    </div>
  </div>

</form>