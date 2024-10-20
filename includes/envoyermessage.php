<h1>Envoyer un message</h1>
<form action="" method="POST">
  <?php

  use PHPMAILER\PHPMAILER\PHPMAILER;
  use PHPMAILER\PHPMAILER\Exception;

  require './PHPMailer/PHPMailer/src/Exception.php';
  require './PHPMailer/PHPMailer/src/PHPMailer.php';
  require './PHPMailer/PHPMailer/src/SMTP.php';

  $id = $_GET["id"];
  $query = $connect->prepare("SELECT * FROM users WHERE id = $id");
  $query->execute();
  $data = $query->fetch();
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sujet = $_POST["sujet"];
    $query = $connect->prepare("INSERT INTO messages VALUES('','$_SESSION[admin]','$data[3]','$sujet','$_POST[message]')");
    $query->execute();

    $query = $connect->prepare("SELECT * FROM users where email = '$data[3]'");
    $query->execute();
    $res = $query->fetch();

    $query = $connect->prepare("SELECT * FROM users where email = '$_SESSION[admin]'");
    $query->execute();
    $res1 = $query->fetch();


    $nom = $res["nom"];
    $admin = $res1["nom"];

    $mail = new PHPMAILER(true);
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "hamayah4@gmail.com";
    $mail->Password = "duek lrnz morl vxjg";
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;


    $mail->setFrom("hamayah4@gmail.com");


    $mail->addAddress($data[3]);

    $mail->isHTML(true);
    $mail->Subject = "Vous avez un nouveau message";
    $mail->Body = "Bonjour monsieur $nom, <br><br>
    Votre avez un nouveau message de la part de $admin, <br><br>

    Veuillez consulter l'application pour lire le message.
    ";

    $mail->send();
  }
  ?>
  <div class="row">
    <div class="col-lg-6">
      <div class="mb-3">
        <input type="email" class="form-control" name="email" value="<?= $data[3] ?>" disabled>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="mb-3">
        <input type="text" class="form-control" placeholder="Sujet" name="sujet">
      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="mb-3">
        <textarea name="message" placeholder="Message" class="form-control"></textarea>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="form-group">
        <input type="submit" value="Envoyer">
      </div>
    </div>
  </div>


</form>