<div class="head d-flex justify-content-between align-items-center">
	<h1>Gestion des admins</h1>
	<a href="?tab=ajouteradmin">Ajotuer un admin</a>
</div>
<?php
$req = $connect->prepare("SELECT * FROM users WHERE priority = 2 OR priority = 3");
$req->execute();
if ($req->rowCount() !== 0) {
	echo "<table class='table'>
										<thead>
											<th>Nom</th>
											<th>Prénom</th>
											<th>Email</th>
											<th>Téléhpone</th>
											<th>Role</th>
											<th></th>
										</thead>";
} else {
	echo "<p>Pas d'admin jusqu'à maintenant.";
}
while ($tab = $req->fetch()) {
	echo "
							<tr>
								<td>$tab[1]</td>
								<td>$tab[2]</td>
								<td>$tab[3]</td>
								<td>$tab[6]</td>
								<td>" . ($tab[7] == 1 ? "Super admin" : ($tab[7] == 2 ? "Admin" : "Livreur")) . "</td>
								<td>
									<div class='icons'>
										<a href='?tab=envoyermessage&id=$tab[0]'><i class='fi fi-rr-envelope'></i></a>
										<a href='?tab=editadmin&id=$tab[0]'><i class='fi fi-rr-edit'></i></a>
										<a href='deleteadmin.php?id=$tab[0]'><i class='fi fi-rr-trash'></i></a>
									</div>
								</td>
							</tr>
						";
}
?>
</table>