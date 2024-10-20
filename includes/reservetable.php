<h1>Listes des reservations des tables</h1>

<?php

$req = $connect->prepare("SELECT * FROM reservetable");
$req->execute();
$count = $req->rowCount();

if (isset($_GET["page"])) {
	$currentPage = (int)$_GET["page"];
} else {
	$currentPage = 1;
}
$perPages = 10;
$numPages = ceil($count / $perPages);
$offSet = $perPages * ($currentPage - 1);

$req = $connect->prepare("SELECT * FROM reservetable LIMIT $offSet, $perPages");
$req->execute();

if ($count > 0) {
	echo "<table class='table'>
								<thead>
									<th>Nom</th>
									<th>Prénom</th>
									<th>Numéro de téléphone</th>
									<th>Nombres de personnes</th>
									<th>Date</th>
									<th></th>
								</thead>
								";

	while ($tab = $req->fetch()) {
		echo "
								<tr>
									<td>$tab[1]</td>
									<td>$tab[2]</td>
									<td>$tab[3]</td>
									<td>$tab[4]</td>
									<td>$tab[5]</td>
									<td>";
		if ($tab[6] == 1) {
			echo "Déjà Confirmée";
		} else {
			echo "<a href='confirmtable.php?id=$tab[0]'>Confirmer</a></td>";
		}
		"
								</tr>";
	}
	echo "
							</table>";
} else {
	echo "<p>Pas de réservation jusqu'à maintenant.</p>";
}

?>

<nav aria-label="Page navigation example">
	<ul class="pagination">
		<li class="page-item"><a class="page-link" href="#">Previous</a></li>
		<?php
		for ($i = 0; $i < $numPages; $i++) {
			echo "<li class='page-item'><a class='page-link' href='?tab=reservetable&page=" . ($i + 1) . "'>" . ($i + 1) . "</a></li>";
		}
		?>
	</ul>
</nav>