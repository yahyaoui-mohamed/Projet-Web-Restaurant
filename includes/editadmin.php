<?php
$id = $_GET["id"];
$req = $connect->prepare("SELECT * FROM users WHERE id = $id");
$req->execute();
$data = $req->fetch();
?>

<h1>Modifier admin</h1>
<form class="" method="POST" action="" enctype="multipart/form-data">
  <?php if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : $data[1];
    $prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : $data[2];
    $email  = isset($_POST["email"]) ? $_POST["email"] : $data[3];
    $tel    = isset($_POST["tel"]) ? $_POST["tel"] : $data[5];
    $role   = isset($_POST["role"]) ? $_POST["role"] : $data[7];

    $req = $connect->prepare(
      "UPDATE users SET
										nom = '$nom',
										prenom = '$prenom',
										email = '$email',
										tel = '$tel',
                    priority = $role
										WHERE id = $id
										"
    );
    $req->execute();
    $req = $connect->prepare("SELECT * FROM users WHERE id = $id");
    $req->execute();
    $data = $req->fetch();
  } ?>
  <div class="row">
    <div class="col-lg-6 mb-3">
      <div class="form-group">
        <label for="nom">Nom</label>
        <input class="form-control" type="text" id="nom" value="<?= $data[1] ?>"
          placeholder="Nom" name="nom" required autocomplete="off">
      </div>
    </div>
    <div class="col-lg-6 mb-3">
      <div class="form-group">
        <label for="prenom">Prénom</label>
        <input class="form-control" type="text" id="prenom" value="<?= $data[2] ?>"
          placeholder="Prénom" name="prenom" required autocomplete="off">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6 mb-3">
      <div class="form-group">
        <label for="desc">Email</label>
        <input class="form-control" type="email" value="<?= $data[3] ?>"
          placeholder="Email" name="email" required
          autocomplete="off">
      </div>
    </div>

    <div class="col-lg-6 mb-3">
      <div class="form-group">
        <label for="tel">Téléphone</label>
        <!-- <img src="<?= $data[4] ?>" alt=""> -->
        <input class="form-control" type="text" id="tel" nom="tel" value="<?= $data[5] ?>">
      </div>
    </div>

    <div class="col-lg-6 mb-3">
      <div class="form-group">
        <label for="role">Rôle</label>
        <select name="role" class="form-select">
          <option value="1" <?= $data[7] == 1 ? "selected" : "" ?>>Super Admin</option>
          <option value="2" <?= $data[7] == 2 ? "selected" : "" ?>>Admin</option>
          <option value="3" <?= $data[7] == 3 ? "selected" : "" ?>>Livreur</option>
        </select>
      </div>
    </div>


  </div>
  <input class="form-control" type="submit" value="Ajouter">

</form>