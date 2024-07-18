<?php 
include "connect.php";
session_start();
$req = $connect->prepare("SELECT nom, prenom FROM users WHERE priority = 1");
$req->execute();
$res = $req->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<title>Admin Panel</title>
</head>
<body>
	<div class="account-wrap">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-2">
					<div class="account-sidebar">
						<div class="account-info">
							<div class="account-profile-img" style="background-image: url(img/users/admin.png)"></div>
							<span><?php echo ucfirst($res[0]." ".$res[1]) ?></span>				
						</div>
						<ul>
							<li 
								<?php if(isset($_GET["tab"]) && $_GET["tab"] === "statistiques") echo "class='active'" ?>>
								<i class="far fa-chart-bar"></i><a href="?tab=statistiques">Accueil</a>
							</li>
							<li
								<?php if(!isset($_GET["tab"]) || $_GET["tab"] === "compte") echo "class='active'" ?>>
								<i class="fas fa-user"></i><a href="?tab=compte">Compte</a>
							</li>

							<li 
								<?php if(isset($_GET["tab"]) && $_GET["tab"] === "utilisateur") echo "class='active'" ?>>
								<i class="fas fa-users-cog"></i><a href="?tab=utilisateur">Gestion d'utilisateur</a>
							</li>
							<li 
								<?php if(isset($_GET["tab"]) && $_GET["tab"] === "commande") echo "class='active'" ?>>
								<i class="fas fa-shopping-cart"></i><a href="?tab=commande">Gestion de commandes</a>
							</li>
							<li 
								<?php if(isset($_GET["tab"]) && $_GET["tab"] === "produit") echo "class='active'" ?>>
								<i class="fas fa-list-ul"></i><a href="?tab=produit">Listes Des Produits</a>
							</li>
							<li 
								<?php if(isset($_GET["tab"]) && $_GET["tab"] === "ajout") echo "class='active'" ?>>
								<i class="fas fa-plus-circle"></i><a href="?tab=ajout">Ajouter Des produits</a>
							</li>
							<li 
								<?php if(isset($_GET["tab"]) && $_GET["tab"] === "reservetable") echo "class='active'" ?>>
								<i class="fas fa-calendar"></i><a href="?tab=reservetable">Reservations des tables</a>
							</li>
							<li 
								<?php if(isset($_GET["tab"]) && $_GET["tab"] === "annulercommande") echo "class='active'" ?>>
								<i class="fas fa-times"></i><a href="?tab=annulercommande">Annuler une commande</a>
							</li>
							<li> 
								<i class="fas fa-undo"></i><a href="index.php">Retour à l'accueil</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="col-lg-10">
				<div class="account-content">
			<?php 
				if(!isset($_GET["tab"]) || $_GET["tab"] === "compte")
				{
					?>
					<form class="account-form" method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>" enctype="multipart/form-data">
					<?php 
						if($_SERVER["REQUEST_METHOD"] === "POST")
						{
							$nom = $_POST["nom"];
							$prenom = $_POST["prenom"];
							$email = $_POST["email"];
							$tel = $_POST["tel"];
							$oldpwd = $_POST["oldpassword"];
							$newpwd = $_POST["newpassword"];
							if($newpwd == "")
							{
								$newpwd = $oldpwd;
							}
							$req = $connect->prepare("UPDATE users SET nom = '$nom', prenom = '$prenom', email = '$email', tel='$tel', mdp = '$newpwd' WHERE priority = 1");
							$req->execute();
						}
					?>
					<h1>Compte</h1>
					<?php 
						$req = $connect->prepare("SELECT * FROM users WHERE priority = 1");
						$req->execute();
						$row = $req->fetch();
					?>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="nom">Nom</label>
									<input class="form-control" type="text" id="nom" value="<?php echo $row[1] ?>"  placeholder="Nom" name="nom" autocomplete="off">
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group">
									<label for="prenom">Prénom</label>
									<input class="form-control" type="text" id="prenom" value="<?php echo $row[2] ?>"  placeholder="Prénom" name="prenom" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="email">Email</label>
									<input class="form-control" type="email" id="email" value="<?php echo $row[3] ?>" placeholder="Email" name="email" autocomplete="off">
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group">
									<label for="tel">Téléphone</label>
									<input class="form-control" type="text" id="tel" value="<?php echo $row[5] ?>" placeholder="Téléphone" name="tel" autocomplete="off">
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-lg-6">
									<div class="form-group">
										<label for="mdpn">Ancien mot de passe</label>
										<input class="form-control" type="password" id="mdpn" value=""  placeholder="Ancien Mot de passe" name="oldpassword" autocomplete="off">
									</div>
							</div>

							<div class="col-lg-6">
									<div class="form-group">
										<label for="mdp">Nouveau mot de passe</label>
										<input class="form-control" type="password" id="mdp" value=""  placeholder="Nouveau Mot de passe" name="newpassword" autocomplete="off">
									</div>
							</div>
						</div>
						

						<div class="col-lg-12">
							<div class="form-group">
								<input class="form-control" type="submit" value="Enregistrer">
							</div>
						</div>

					</form>

					<?php
				}
				else if($_GET["tab"] === "motdepasse")
				{
					?>
					<form method="POST" action="">
						<h1>Mot de passe</h1>
						
						
						<input type="submit" value="Enregistrer">
					</form>
					<?php
				}
				else if ($_GET["tab"] === "utilisateur") 
				{
					 ?>
					 <h1>Gestion D'utilisateur</h1>
				<?php
					$req = $connect->prepare("SELECT * FROM users WHERE priority = 0");
					$req->execute();
					if($req->rowCount() !== 0)
					{
						echo "<table class='table'>
						<tr>
							<th>Nom</th>
							<th>Prénom</th>
							<th>Email</th>
						</tr>";
					}
					else{
						echo "<p>Pas d'utilisateur jusqu'à maintenant.";
					}
					while($tab = $req->fetch())
					{
						echo 
						"
							<tr>
								<td>$tab[1]</td>
								<td>$tab[2]</td>
								<td>$tab[3]</td>
							</tr>
						";
					}
					?>
					</table>
					<?php
				}
				else if($_GET["tab"] === "produit")
				{
					if(isset($_GET["action"]) && $_GET["action"] === "modifier")
					{
						echo "<h1>Modifier Un Produit</h1>";
						$id    = $_GET["id"];
						$query = $connect->prepare("SELECT * FROM food WHERE food_id = $id");
						$query->execute();
						$res   = $query->fetch();
						if($_SERVER["REQUEST_METHOD"] === "POST")
						{
							$nom  = $_POST["nom"];
							$prix = $_POST["prix"];
							$desc = $_POST["desc"];
							$img  = $_FILES["img"]["name"];
							if($img !== "")
							{
								$destination = "img/users/".$_FILES["img"]["name"];
								move_uploaded_file($_FILES["img"]["tmp_name"], $destination);
								$req = $connect->prepare("UPDATE food  SET food_name = '$nom', food_price = $prix, food_description = '$desc', food_img = '$destination' WHERE food_id = $id");
								$req->execute();
							}
							else
							{
								$req = $connect->prepare("UPDATE food SET food_name = '$nom', food_price = $prix, food_description = '$desc' WHERE food_id = $id");
								$req->execute();
							}

						
						}
						?>

						<form action="<?php echo '?tab=produit&action=modifier&id='.$_GET["id"] ?>" method="POST" enctype="multipart/form-data">
							<div class="row">
								<div class="form-group">
									<label for="nom">Nom de produit</label>
									<input type="text" id="nom" value="<?php echo $res[1] ?>"  placeholder="Prix de produit" name="nom" autocomplete="off">
								</div>
								<div class="form-group">
									<label for="prix">Prix de produit</label>
									<input type="number" id="nom" value="<?php echo $res[2] ?>"  placeholder="Prix de produit" name="prix" autocomplete="off">
								</div>	
							</div>
							<div class="row">
								<div class="form-group">
									<label for="desc">Description du produit</label>
									<textarea placeholder="" name="desc" id="desc" value="<?php echo $res[3] ?>">Description du produit</textarea>
								</div>
								<div class="form-group">
									<label for="prix">Image de produit</label>
									<img src="<?php echo $res[4] ?>" alt="" width="100">
									<input type="file" id="img" value=""  placeholder="Image de produit" name="img" autocomplete="off">
								</div>
							</div>
							<input type="submit" value="Modifier">
						</form>

						<?php
					}
					else
					{
						echo "<h1>Listes des Produits</h1>
								<div class='menu-container'>
						";
						$req = $connect->prepare("SELECT * FROM food");
						$req->execute();
						while($tab = $req->fetch())
						{
							echo
						"
						<div class='menu-item'>
							<img src='$tab[4]' alt=''>
							<span>$tab[2]TND</span>
							<h1>$tab[1]</h1>
							<p>$tab[3]</p>
							<form action='supprimerproduit.php' method='POST'>
								<input type='hidden' value='$tab[0]' name='id'>
								<input type='submit' id='delete' value='Supprimer'>
								<a id='modifier' href='?tab=produit&action=modifier&id=$tab[0]'>Modifier</a>
						</div>
						";
						}
						echo "</div>";						
					}
				

				}
				else if($_GET["tab"] === "ajout")
				{
				
					echo "<h1>Ajouter des Produits</h1>";
					?>
					<form class="" method="POST" action="<?php echo $_SERVER["PHP_SELF"]."?tab=ajout" ?>" enctype="multipart/form-data">
						<?php 

							if($_SERVER["REQUEST_METHOD"] === "POST")
							{
								$nom    = $_POST["nom"];
								$prix   = $_POST["prix"];
								$desc   = $_POST["desc"];
								$photo  = $_FILES["img"]["name"];
								$destination = "img/users/".$_FILES["img"]["name"];
								move_uploaded_file($_FILES["img"]["tmp_name"], $destination);
								$req = $connect->prepare("INSERT INTO food VALUES('','$nom','$prix','$desc','$destination')");
								$req->execute();
							}

						?>
						<div class="row">
							<div class="col-lg-6 mb-3">
								<div class="form-group">
									<label for="nom">Nom du produit</label>
									<input class="form-control" type="text" id="nom" value="" placeholder="Nom du produit" name="nom" required autocomplete="off">
								</div>
							</div>
							<div class="col-lg-6 mb-3">
								<div class="form-group">
									<label for="prix">Prix de produit</label>
									<input class="form-control" type="number" id="prix" value=""  placeholder="Prix de produit" name="prix" required autocomplete="off">
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-6 mb-3">
								<div class="form-group">
									<label for="desc">Description du produit</label>
									<input class="form-control" type="text" id="desc" value=""  placeholder="Description du produit" name="desc" required autocomplete="off">
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
					<?php
				}




				else if($_GET["tab"] === "commande")
				{
					?>
					<h1>Gestion des commandes</h1>
					<?php
						$query  = $connect->prepare("SELECT * FROM commande WHERE commande_confirm = 1");
						$query->execute();
						$num = $query->rowCount();
						echo "<p>".$num." commandes au total.</p>";
						if($num !== 0)
						{
							echo "
							<table class='table'>
							<thead>
								<th>Commande N°</th>
								<th>Effectué Par</th>
								<th>Produit</th>
								<th>Prix</th>
								<th></th>
							</thead>
							";
						}
						while($tab = $query->fetch())
						{
							echo "<tr>";
							$query1 = $connect->prepare("SELECT * FROM users WHERE id      = '$tab[2]'");
							$query1->execute();
							$query2 = $connect->prepare("SELECT * FROM food  WHERE food_id = '$tab[1]'");
							$query2->execute();
							while($tab1 = $query1->fetch())
							{
								while($tab2 = $query2->fetch())
								{
									echo "
									<td>$tab[0]</td>
									<td>$tab1[1] $tab1[2]</td>
									<td>$tab2[1]</td>
									<td>$tab2[2]TND</td>
									<td><a href='confirmevente.php?userid=$tab[2]&food_id=$tab[1]&commandeid=$tab[0]'>Confirmer</a></td>"
									;
								}
							}
							echo "</tr>";
						}
					echo "</table>";
				}
				else if($_GET["tab"] === "statistiques")
				{
					echo "<h1>Statistiques</h1>";
					$query1 = $connect->prepare("SELECT * FROM users WHERE priority = 0");
					$query2 = $connect->prepare("SELECT * FROM ventes");
					$query2->execute();
					$sum = 0;
					while($tab = $query2->fetch())
					{
						$query3 = $connect->prepare("SELECT * FROM food WHERE food_id = $tab[2]");
						$query3->execute();
						$sum   += $query3->fetch()[2];
					}
					?>
					<div class="statics">
						<div class="container">
							<div class="row">
								<div class="col-lg-4">
									<div class="static-item">
										<span>Utilisateurs Totales</span>
										<h1><?php echo $query1->rowCount(); ?></h1>
									</div>
								</div>
								
								<div class="col-lg-4">
									<div class="static-item">
										<span>Commande Totales</span>
										<h1><?php echo $query2->rowCount(); ?></h1>
									</div>
								</div>

								<div class="col-lg-4">
									<div class="static-item">
										<span>Gains Totales</span>
										<h1><?php echo $sum; ?> TND</h1>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
				
				else if($_GET["tab"] === "reservetable")
				{
					echo "<h1>Listes des Reservations des tables</h1>";
					$req = $connect->prepare("SELECT * FROM reservetable");
					$req->execute();
					$num = $req->rowCount();
					echo "<p>$num Reservations Totales.</p>";
					if($num !== 0)
					{
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
					}

					while($tab = $req->fetch())
					{
						echo "
						<tr>
							<td>$tab[1]</td>
							<td>$tab[2]</td>
							<td>$tab[3]</td>
							<td>$tab[4]</td>
							<td>$tab[5]</td>
							<td>";
							if($tab[6] == 1)
							{
								echo 'Déjà Confirmée';
							}
							else
							{
								echo "<a href='confirmtable.php?id=$tab[0]'>Confirmer</a></td>";
							}
						"</tr>";
					}
					echo "</table>";
				}
				else if($_GET["tab"] === "annulercommande")
				{
					echo "<h1>Annuler une Commande</h1>";
					$req = $connect->prepare("SELECT * FROM ventes");
					$req->execute();
					echo "
					<table class='table'>
						<thead>
							<th>Commande N°</th>
							<th>Effecté Par</th>
							<th>Produit</th>
							<th>Prix</th>
							<th></th>
						</thead>
					";
					while($tab = $req->fetch())
					{
						$req1 = $connect->prepare("SELECT * FROM users WHERE id = $tab[1]");
						$req2 = $connect->prepare("SELECT * FROM food  WHERE food_id = $tab[2]");
						$req1->execute();
						$req2->execute();
						while($tab1 = $req1->fetch())
						{
							while($tab2 = $req2->fetch())
							{
								echo "
								<tr>
									<td>$tab[0]</td>
									<td>$tab1[1] $tab1[2]</td>
									<td>$tab2[1]</td>
									<td>$tab2[2] TND</td>
									<td><a href='annulercommande.php?commandeid=$tab[0]'>Annuler</a></td>
								</tr>
								";
							}
						}
					}
				}

				?>

				</div>
				</div>
			</div>
		</div>
		
		
	</div>		
</body>
</html>