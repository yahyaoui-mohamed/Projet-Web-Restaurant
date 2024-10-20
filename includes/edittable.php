<?php
$id = $_GET["id"];
$req = $connect->prepare("SELECT * FROM tables WHERE table_id = $id");
$req->execute();
$data = $req->fetch();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nom = isset($_POST["nom"]) ? $_POST["nom"] : $data[1];
  $size = isset($_POST["capacite"]) ? $_POST["capacite"] : $data[2];
  $quantity = isset($_POST["quantity"]) ? $_POST["quantity"] : $data[5];
  $img = $_FILES["img"]["name"];
  $destination = "img/users/" . $_FILES["img"]["name"];
  if ($destination === "img/users/") {
    $destination = $data[4];
  }

  move_uploaded_file($_FILES["img"]["tmp_name"], $destination);
  $req = $connect->prepare(
    "UPDATE tables SET
    table_name = '$nom',
    table_size = $size,
    table_image = '$destination',
    table_quantity = $quantity
    WHERE table_id = $id
"
  );
  $req->execute();
  $req = $connect->prepare(
    "SELECT * FROM tables WHERE table_id = $id"
  );
  $req->execute();
  $data = $req->fetch();
}
?>

<h1>Modifier table</h1>
<form class="edit-table-form" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div class="col-lg-6 mb-3">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Nom du table" name="nom" value="<?= $data[1] ?>" />
      </div>
    </div>
    <div class=" col-lg-6">
      <div class="form-group mb-3">
        <input type="number" class="form-control" placeholder="Capacité du table" name="capacite" value="<?= $data[2] ?>" />
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <img src="<?= $data[4] ?>" alt="">
        <input type="file" class="form-control" placeholder="Image du table" name="img" autocomplete="off" />
      </div>
    </div>

    <div class="col-lg-6">
      <div class="form-group">
        <input type="number" class="form-control" placeholder="Quantité" name="quantity" autocomplete="off" value="<?= $data[5] ?>" />
      </div>
    </div>

  </div>


  <div class="row">
    <div class="col-lg-12">
      <div class="form-group">
        <input type="submit" class="form-control" value="Ajouter" />
      </div>
    </div>
  </div>
</form>