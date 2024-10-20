<form class="account-form" method="POST" action=""
  enctype="multipart/form-data">
  <?php if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];
    $oldpwd = $_POST["oldpassword"];
    $newpwd = $_POST["newpassword"];
    if ($newpwd == "") {
      $newpwd = $oldpwd;
    }
    $req = $connect->prepare(
      "UPDATE users SET nom = '$nom', prenom = '$prenom', email = '$email', tel='$tel', mdp = '$newpwd' WHERE priority = 1"
    );
    $req->execute();
  } ?>
  <h1>Compte</h1>
  <?php
  $req = $connect->prepare("SELECT * FROM users WHERE priority = 1");
  $req->execute();
  $row = $req->fetch();
  ?>
  <div class="row">
    <div class="col-lg-6">
      <div class="mb-3">
        <label for="nom">Nom</label>
        <input class="form-control" type="text" id="nom" value="<?php echo $row[1]; ?>"
          placeholder="Nom" name="nom" autocomplete="off">
      </div>
    </div>

    <div class="col-lg-6">
      <div class="mb-3">
        <label for="prenom">Prénom</label>
        <input class="form-control" type="text" id="prenom"
          value="<?php echo $row[2]; ?>" placeholder="Prénom" name="prenom"
          autocomplete="off">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="mb-3">
        <label for="email">Email</label>
        <input class="form-control" type="email" id="email"
          value="<?php echo $row[3]; ?>" placeholder="Email" name="email"
          autocomplete="off">
      </div>
    </div>

    <div class="col-lg-6">
      <div class="mb-3">
        <label for="tel">Téléphone</label>
        <input class="form-control" type="text" id="tel" value="<?php echo $row[5]; ?>"
          placeholder="Téléphone" name="tel" autocomplete="off">
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="mb-3">
        <label for="mdpn">Ancien mot de passe</label>
        <input class="form-control" type="password" id="mdpn" value=""
          placeholder="Ancien Mot de passe" name="oldpassword" autocomplete="off">
      </div>
    </div>

    <div class="col-lg-6">
      <div class="mb-3">
        <label for="mdp">Nouveau mot de passe</label>
        <input class="form-control" type="password" id="mdp" value=""
          placeholder="Nouveau Mot de passe" name="newpassword" autocomplete="off">
      </div>
    </div>
  </div>


  <div class="col-lg-12">
    <div class="mb-3">
      <input class="form-control" type="submit" value="Enregistrer">
    </div>
  </div>

</form>