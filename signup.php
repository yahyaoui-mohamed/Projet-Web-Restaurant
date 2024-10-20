<?php
session_start();
if (isset($_SESSION["user"])) {
  header("location:index.php");
}
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <title>S'identifier</title>
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
        <form class="signup-form" method="POST" action="">
          <h1>Sign Up</h1>
          <p>Créer un compte maintenant.</p>
          <?php
          if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nom    = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $email  = $_POST["email"];
            $mdp    = $_POST["mdp"];
            $query = $connect->prepare("INSERT INTO users VALUES ('','$nom','$prenom','$email','$mdp','','',0)");
            $query->execute();
            echo "<div class='alert-success'>Compte créer avec succès. Vous pouvez maintenant <a href='login.php'>S'identifier</a></div>";
          }
          ?>
          <div class="mb-3">
            <label for="nom">Nom</label>
            <input type="text" id="nom" required name="nom" autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" required name="prenom" autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" id="email" required name="email" autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="password">Password<label>
                <input type="password" id="password" required name="mdp" autocomplete="off">
          </div>
          <div class="mb-3">
            <input type="submit" value="Créer">
          </div>
          <div class="login-link">Vous avez déjà un compte? <a href="login.php">Login</a></div>
        </form>
      </div>
      <div class="col-lg-8">

      </div>
    </div>

  </div>





  <script src="js/main.js"></script>
</body>

</html>