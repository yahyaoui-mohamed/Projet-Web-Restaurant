<div class="head d-flex justify-content-between align-items-center">
	<h1>Gestion des tables</h1>
	<a href="?tab=ajoutertable">Ajotuer une table</a>
</div>
<?php
$req = $connect->prepare("SELECT * FROM tables");
$req->execute();
$count = $req->rowCount();

if (isset($_GET["page"])) {
	$currentPage = (int)$_GET["page"];
} else {
	$currentPage = 1;
}
$perPages = 4;
$numPages = ceil($count / $perPages);
$offSet = $perPages * ($currentPage - 1);

$req = $connect->prepare("SELECT * FROM tables LIMIT $offSet, $perPages");
$req->execute();

if ($req->rowCount() > 0) {
	echo "<table class='table'>
											<thead>
												<th>Image</th>
												<th>Nom</th>
												<th>Capacité</th>
												<th></th>
											</thead>
											";

	while ($tab = $req->fetch()) {
		echo "
								<tr>
								<td><img size=100 src='$tab[4]' alt=''></td>
									<td>$tab[1]</td>
									<td>$tab[2]</td>
									<td>
										<div class='icons'>
											<a href='?tab=edittable&id=$tab[0]'>
												<i class='fi fi-rr-pencil'></i>
											</a>
											<a href='deletetable.php?id=$tab[0]'>
												<i class='fi fi-rr-trash'></i>
											</a>
										</div>
									</td>
									</tr>";
	}
	echo "</table>";
} else {
	echo "<p>Pas de table jusqu'à maintenant.</p>";
}
?>

<!-- <div class="table-item">
									<div class="row">
										<div class="col-lg-3">
											<img src="<?= $tab[4] ?>" alt="">
										</div>
										<div class="col-lg-9">
											<div class="desc">
												<h1><?= $tab[1] ?></h1>
												<p>Size : <?= $tab[2] ?></p>
												<span><?= $tab[3] == 1 ? "Reserved" : "Available" ?></span>
											</div>
										</div>
									</div>
								</div> -->

<nav aria-label="Page navigation example">
	<ul class="pagination">
		<li class="page-item"><a class="page-link" href="#">Previous</a></li>
		<?php
		for ($i = 0; $i < $numPages; $i++) {
			echo "<li class='page-item'><a class='page-link' href='?tab=table&page=" . ($i + 1) . "'>" . ($i + 1) . "</a></li>";
		}
		?>
	</ul>
</nav>