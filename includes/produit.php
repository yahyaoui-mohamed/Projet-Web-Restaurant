<?php

if (isset($_GET["action"]) && $_GET["action"] === "modifier") {
  $id = $_GET["id"];
  $query = $connect->prepare("SELECT * FROM food WHERE food_id = $id");
  $query->execute();
  $res = $query->fetch();



  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST["nom"];
    $prix = $_POST["prix"];
    $desc = $_POST["desc"];
    $img = $_FILES["img"]["name"];
    if ($img !== "") {
      $destination = "img/users/" . $_FILES["img"]["name"];
      move_uploaded_file($_FILES["img"]["tmp_name"], $destination);
      $req = $connect->prepare(
        "UPDATE food  SET food_name = '$nom', food_price = $prix, food_description = '$desc', food_img = '$destination' WHERE food_id = $id"
      );
      $req->execute();
    } else {
      $req = $connect->prepare(
        "UPDATE food SET food_name = '$nom', food_price = $prix, food_description = '$desc' WHERE food_id = $id"
      );
      $req->execute();
    }
  }
?>

<?php
} else {
?>
  <div class="head d-flex justify-content-between align-items-center">
    <h1>Gestion des produits</h1>
    <a href='?tab=ajouterproduit'>Ajouter un produit</a>
  </div>
<?php
  $req = $connect->prepare("SELECT * FROM food");
  $req->execute();
  $count = $req->rowCount();

  if (isset($_GET["page"])) {
    $currentPage = (int)$_GET["page"];
  } else {
    $currentPage = 1;
  }
  $perPages = 6;
  $numPages = ceil($count / $perPages);
  $offSet = $perPages * ($currentPage - 1);
  $req = $connect->prepare("SELECT * FROM food LIMIT $offSet, $perPages");
  $req->execute();
  if ($req->rowCount() > 0) {
    echo "<table class='table'>
											<thead>
												<th>Image</th>
												<th>Nom</th>
												<th>Prix</th>
												<th>Description</th>
												<th></th>
											</thead>";
    while ($tab = $req->fetch()) {
      echo "
									<tr>
										<td><img src=$tab[4] /></td>
										<td>$tab[1]</td>
										<td>$tab[2]</td>
										<td>$tab[3]</td>
										<td>
											<div class='icons'>
												<a href='?tab=editproduct&id=$tab[0]'><i class='fi fi-rr-pencil'></i></a>
												<a href='deleteproduct.php?id=$tab[0]'><i class='fi fi-rr-trash'></i></a>
											</div>
										</td>
									</tr>
								";
    }
    echo "</table>";
  } else {
    echo "<p>Pas de produit jusqu'à maintenant.</p>";
  }
} ?>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <?php
    for ($i = 0; $i < $numPages; $i++) {
      echo "<li class='page-item'><a class='page-link' href='?tab=produit&page=" . ($i + 1) . "'>" . ($i + 1) . "</a></li>";
    }
    ?>
  </ul>
</nav>