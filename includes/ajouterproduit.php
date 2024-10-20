<h1>Ajouter des Produits</h1>
<form class="" method="POST" enctype="multipart/form-data">
  <?php if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST["nom"];
    $prix = $_POST["prix"];
    $desc = $_POST["desc"];
    $photo = $_FILES["img"]["name"];
    $destination = "img/users/" . $_FILES["img"]["name"];
    move_uploaded_file($_FILES["img"]["tmp_name"], $destination);
    $req = $connect->prepare(
      "INSERT INTO food VALUES('','$nom','$prix','$desc','$destination')"
    );
    $req->execute();
  } ?>
  <div class="row">
    <div class="col-lg-6 mb-3">
      <div class="form-group">
        <label for="nom">Nom du produit</label>
        <input class="form-control" type="text" id="nom" value=""
          placeholder="Nom du produit" name="nom" required autocomplete="off">
      </div>
    </div>
    <div class="col-lg-6 mb-3">
      <div class="form-group">
        <label for="prix">Prix de produit</label>
        <input class="form-control" type="number" id="prix" value=""
          placeholder="Prix de produit" name="prix" required autocomplete="off">
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6 mb-3">
      <div class="form-group">
        <label for="desc">Description du produit</label>
        <input class="form-control" type="text" id="desc" value=""
          placeholder="Description du produit" name="desc" required
          autocomplete="off">
      </div>
    </div>
    <div class="col-lg-6 mb-3">
      <div class="form-group">
        <label for="file">Photo du produit</label>
        <input class="form-control" type="file" id="file" nom="file" name="img">
      </div>
    </div>
  </div>
  <input class="form-control" type="submit" value="Ajouter">

</form>