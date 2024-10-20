<?php if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nom = $_POST["nom"];
  $size = $_POST["capacite"];
  $quantity = $_POST["quantity"];
  $img = $_FILES["img"]["name"];
  $destination = "img/users/" . $_FILES["img"]["name"];
  move_uploaded_file($_FILES["img"]["tmp_name"], $destination);
  $req = $connect->prepare(
    "INSERT INTO tables VALUES ('','$nom','$size','0','$destination', $quantity)"
  );
  $req->execute();
} ?>
<h1>Ajouter une table</h1>
<form action="" method="POST" enctype="multipart/form-data">
  <div class="row">
    <div class="col-lg-6">
      <div class="mb-3">
        <input type="text" class="form-control" placeholder="Nom du table" name="nom" />
      </div>
    </div>
    <div class="col-lg-6">
      <div class="mb-3">
        <input type="number" class="form-control" placeholder="Capacité du table" name="capacite" />
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="mb-3">
        <input type="file" class="form-control" placeholder="Image du table" name="img" autocomplete="off" />
      </div>
    </div>

    <div class="col-lg-6">
      <div class="mb-3">
        <input type="number" class="form-control" placeholder="Quantité" name="quantity" autocomplete="off" />
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