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
					<?php if(isset($_GET["tab"]) && $_GET["tab"] === "motdepasse") echo "class='active'" ?>>
					<a href="?tab=motdepasse">Changer mot de passe</a>
				</li>
				<li 
					<?php if(isset($_GET["tab"]) && $_GET["tab"] === "utilisateur") echo "class='active'" ?>>
					<a href="?tab=utilisateur">Gestion d'utilisateur</a>
				</li>
				<li 
					<?php if(isset($_GET["tab"]) && $_GET["tab"] === "commande") echo "class='active'" ?>>
					<a href="?tab=commande">Gestion de commandes</a>
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
						
						<input type="submit" value="Enregistrer">
					</form>
					<?php
				}

			?>

		</div>
	</div>		
</body>
</html>