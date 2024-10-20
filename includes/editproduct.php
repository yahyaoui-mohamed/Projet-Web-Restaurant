<?php
$id = $_GET["id"];
$req = $connect->prepare("SELECT * FROM food WHERE food_id = $id");
$req->execute();
$data = $req->fetch();
?>

<h1>Modifier produit</h1>
<form class="" method="POST" action="" enctype="multipart/form-data">
  <?php if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : $data[1];
    $prix = isset($_POST["prix"]) ? $_POST["prix"] : $data[2];
    $desc = isset($_POST["desc"]) ? $_POST["desc"] : $data[3];
    $photo = $_FILES["img"]["name"];
    $destination = "img/users/" . $_FILES["img"]["name"];
    if ($destination === "img/users/") {
      $destination = $data[4];
    }
    move_uploaded_file($_FILES["img"]["tmp_name"], $destination);
    $req = $connect->prepare(
      "UPDATE food SET
										food_name = '$nom',
										food_price = $prix,
										food_description = '$desc',
										food_img = '$destination'
										WHERE food_id = $id
										"
    );
    $req->execute();
    $req = $connect->prepare("SELECT * FROM food WHERE food_id = $id");
    $req->execute();
    $data = $req->fetch();
  } ?>
  <div class="row">
    <div class="col-lg-6 mb-3">
      <div class="form-group">
        <label for="nom">Nom du produit</label>
        <input class="form-control" type="text" id="nom" value="<?= $data[1] ?>"
          placeholder="Nom du produit" name="nom" required autocomplete="off">
      </div>
    </div>
    <div class="col-lg-6 mb-3">
      <div class="form-group">
        <label for="prix">Prix de produit</label>
        <input class="form-control" type="number" id="prix" value="<?= $data[2] ?>"
          placeholder="Prix de produit" name="prix" required autocomplete="off">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6 mb-3">
      <div class="form-group">
        <label for="desc">Description du produit</label>
        <input class="form-control" type="text" id="desc" value="<?= $data[3] ?>"
          placeholder="Description du produit" name="desc" required
          autocomplete="off">
      </div>
    </div>
    <div class="col-lg-6 mb-3">
      <div class="form-group">
        <label for="file">Photo du produit</label>
        <!-- <img src="<?= $data[4] ?>" alt=""> -->
        <input class="form-control" type="file" id="file" nom="file" name="img">
      </div>
    </div>
  </div>
  <input class="form-control" type="submit" value="Ajouter">

</form>