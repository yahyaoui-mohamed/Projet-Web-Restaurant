<h1>Gestion des commandes</h1>
<?php
$query = $connect->prepare("SELECT * FROM commande WHERE commande_payed = 1");
$query->execute();
$count = $query->rowCount();

if (isset($_GET["page"])) {
  $currentPage = (int)$_GET["page"];
} else {
  $currentPage = 1;
}
$perPages = 10;
$numPages = ceil($count / $perPages);
$offSet = $perPages * ($currentPage - 1);

$query = $connect->prepare("SELECT * FROM commande WHERE commande_payed = 1 LIMIT $offSet, $perPages");
$query->execute();

if ($count > 0) {
  echo "
							<table class='table'>
							<thead>
								<th>Commande N°</th>
								<th>Effectué Par</th>
								<th></th>
							</thead>
							";
  while ($tab = $query->fetch()) {
    echo "<tr>";

    $query1 = $connect->prepare("SELECT * FROM users WHERE id = '$tab[2]'");
    $query1->execute();


    $query2 = $connect->prepare("SELECT * FROM food  WHERE food_id = '$tab[1]'");
    $query2->execute();


    while ($tab1 = $query1->fetch()) {
      echo "
          <td>$tab1[0]</td>
          <td>$tab1[1] $tab1[2]</td>";

      echo $tab["commande_confirm"] == 1 ? "<td> <span class='confirmed'>Confirmé</span></td>"
        : "<td ><a class='not-confirmed' href='confirmevente.php?userid=$tab[2]&commandeid=$tab[0]'>Confirmer</a></td>";;
    }
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "<p>Pas de commande jusqu'à maintenant.</p>";
}
?>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <?php
    for ($i = 0; $i < $numPages; $i++) {
      echo "<li class='page-item'><a class='page-link' href='?tab=commande&page=" . ($i + 1) . "'>" . ($i + 1) . "</a></li>";
    }
    ?>
  </ul>
</nav>