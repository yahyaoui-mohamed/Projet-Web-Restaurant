<?php 
include "connect.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="account.css">
	<title>Admin Panel</title>
</head>
<body>
	<div class="account-wrap">
		<div class="account-sidebar">
			<div class="account-info">
				<div class="account-profile-img" style="background-image: url(img/users/admin.png)"></div>
				<span><?php echo ucfirst($_SESSION["admin"]) ?></span>				
			</div>

			<ul>
				<li 
					<?php if(!isset($_GET["tab"]) || $_GET["tab"] === "compte") echo "class='active'" ?>>
					<a href="?tab=compte">Compte</a>
				</li>

				<li 
					<?php if(isset($_GET["tab"]) && $_GET["tab"] === "utilisateur") echo "class='active'" ?>>
					<a href="?tab=utilisateur">Gestion d'utilisateur</a>
				</li>
				<li 
					<?php if(isset($_GET["tab"]) && $_GET["tab"] === "commande") echo "class='active'" ?>>
					<a href="?tab=commande">Gestion de commandes</a>
				</li>
				<li 
					<?php if(isset($_GET["tab"]) && $_GET["tab"] === "produit") echo "class='active'" ?>>
					<a href="?tab=produit">Listes Des Produits</a>
				</li>
				<li 
					<?php if(isset($_GET["tab"]) && $_GET["tab"] === "ajout") echo "class='active'" ?>>
					<a href="?tab=ajout">Ajouter Des produits</a>
				</li>
			</ul>
		</div>
		<div class="account-content">
			<?php 
				if(!isset($_GET["tab"]) || $_GET["tab"] === "compte")
				{
					?>
					<form class="account-form" method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>" enctype="multipart/form-data">
					<h1>Compte</h1>
						<div class="row">
							<div class="form-group">
								<label for="nom">Nom</label>
								<input type="text" id="nom" value="" placeholder="Nom" name="nom">
							</div>
							<div class="form-group">
								<label for="prenom">Prénom</label>
								<input type="text" id="prenom" value=""  placeholder="Prénom" name="prenom">
							</div>
						</div>
						
						<div class="row">
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" id="email" value=""  placeholder="Email" name="email">
							</div>
							<div class="form-group">
								<label for="phone">Numéro de téléphone</label>
								<input type="phone" id="phone"  placeholder="Téléphone"  name="tel">
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label for="mdp">Ancien Mot de passe</label>
								<input type="password" id="mdp" value="" placeholder="Mot de passe" name="oldpassword">
							</div>
							<div class="form-group">
								<label for="mdp,">Nouveau mot de passe</label>
								<input type="password" id="mdpn" value=""  placeholder="Mot de passe" name="newpassword">
							</div>
						</div>
						<div class="form-group">
								<label for="file">Photo de profile</label>
								<input type="file" id="file" nom="file" name="img">
						</div>
						<input type="submit" value="Enregistrer">

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
					 <table>
						<tr>
							<th>Nom</th>
							<th>Prénom</th>
							<th>Email</th>
						</tr>
				<?php
					$req = mysqli_query($conn, "SELECT * FROM users WHERE priority = 0");
					while($tab = mysqli_fetch_array($req))
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
				
					echo "<h1>Listes des Produits</h1>
							<div class='menu-container'>
					";
					$req = mysqli_query($conn, "SELECT * FROM food");
					while($tab = mysqli_fetch_array($req))
					{
						echo
					"
					<div class='menu-item'>
						<img src='$tab[4]' alt=''>
						<span>$tab[2]$</span>
						<h1>$tab[1]</h1>
						<p>$tab[3]</p>
						<form action='supprimerproduit.php' method='POST'>
							<input type='hidden' value='$tab[0]' name='id'>
							<input type='submit' id='delete' value='Supprimer'>
						</form>
					</div>
					";
					}
					echo "</div>";
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
								$req = mysqli_query($conn, "INSERT INTO food VALUES('','$nom','$prix','$desc','$destination')");
							}

						?>
						<div class="row">
							<div class="form-group">
								<label for="nom">Nom du produit</label>
								<input type="text" id="nom" value="" placeholder="Nom du produit" name="nom" required>
							</div>
							<div class="form-group">
								<label for="prix">Prix de produit</label>
								<input type="number" id="prix" value=""  placeholder="Prix de produit" name="prix" required>
							</div>
						</div>
						
						<div class="row">
							<div class="form-group">
								<label for="desc">Description du produit</label>
								<input type="text" id="desc" value=""  placeholder="Description du produit" name="desc" required>
							</div>
						</div>
						<div class="form-group">
								<label for="file">Photo du produit</label>
								<input type="file" id="file" nom="file" name="img">
						</div>
						<input type="submit" value="Ajouter">

					</form>
					<?php
				}
			?>

		</div>
	</div>		
</body>
</html>