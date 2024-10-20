<h1>Gestion des utilisateur</h1>
<?php
$req = $connect->prepare("SELECT * FROM users WHERE priority = 0");
$req->execute();
if ($req->rowCount() !== 0) {
	echo "<table class='table'>
										<thead>
											<th>Nom</th>
											<th>Prénom</th>
											<th>Email</th>
											<th></th>
										</thead>";
} else {
	echo "<p>Pas d'utilisateur jusqu'à maintenant.";
}
while ($tab = $req->fetch()) {
	echo "
							<tr>
								<td>$tab[1]</td>
								<td>$tab[2]</td>
								<td>$tab[3]</td>
								<td>
									<div class='icons'>
										<a href='deleteuser.php?id=$tab[0]'><i class='fi fi-rr-trash'></i></a>
									</div>
								</td>
							</tr>
						";
}
?>
</table>