<?php
include "connect.php";
session_start();
$query  = mysqli_query($conn,"SELECT * FROM users WHERE email = '$_SESSION[user]'");
$result = mysqli_fetch_row($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="account.css">
	<title>Compte</title>
</head>
<body>
	<div class="account-wrap">
		<div class="account-sidebar">
			<div class="account-info">
				<div class="account-profile-img" <?php if($result[6] !== "") echo "style=background-image:url($result[6])"; ?>></div>
				<span><?php echo ucfirst($_SESSION["nom"]) . " " . ucfirst($_SESSION["prenom"]); ?></span>				
			</div>

			<ul>
				<li <?php if(!isset($_GET["tab"]) || $_GET["tab"] === "compte") echo "class='active'" ?>><a href="?tab=compte">Compte</a></li>
				<li <?php if(isset($_GET["tab"]) && $_GET["tab"] === "commande") echo "class='active'" ?>><a href="?tab=commande">Vos commandes</a></li>
				<li <?php if(isset($_GET["tab"]) && $_GET["tab"] === "motdepasse") echo "class='active'" ?>><a href="?tab=motdepasse">Changer mot de passe</a></li>
				<li <?php if(isset($_GET["tab"]) && $_GET["tab"] === "parametre") echo "class='active'" ?>><a href="?tab=parametre">Paramètres</a></li>
			</ul>
		</div>
		<div class="account-content">
			<?php 
				if(!isset($_GET["tab"]) || $_GET["tab"] === "compte")
				{
					?>
					<form class="account-form" method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>" enctype="multipart/form-data">
					<h1>Compte</h1>
					<?php
						
						if($_SERVER["REQUEST_METHOD"] === "POST")
						{
							$nom    = $_POST["nom"];
							$prenom = $_POST["prenom"];
							$email  = $_POST["email"];
							$tel    = $_POST["tel"];
							$file   = $_FILES["img"];
							if($file !== "")
							{
								$filelocation = $_FILES["img"]["tmp_name"];
								$destination = "img/users/".$_FILES["img"]["name"];
								move_uploaded_file($_FILES["img"]["tmp_name"], $destination);								
								$query  = mysqli_query($conn,"
								UPDATE users SET nom = '$nom', prenom = '$prenom', email = '$email', tel = '$tel', profile_image = '$destination' WHERE email = '$_SESSION[user]'");
							}
							else
							{
								$query  = mysqli_query($conn,"
								UPDATE users SET nom = '$nom', prenom = '$prenom', email = '$email', tel = '$tel' WHERE email = '$_SESSION[user]'");
							}

											
						}

					?>
						<div class="row">
						<?php 
							$query  = mysqli_query($conn,"SELECT * FROM users WHERE email = '$_SESSION[user]'");
							$result = mysqli_fetch_row($query);

						?>
							<div class="form-group">
								<label for="nom">Nom</label>
								<input type="text" id="nom" value="<?php echo $result[1] ?>" placeholder="Nom" name="nom">
							</div>
							<div class="form-group">
								<label for="prenom">Prénom</label>
								<input type="text" id="prenom" value="<?php echo $result[2] ?>"  placeholder="Prénom" name="prenom">
							</div>
						</div>
						
						<div class="row">
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" id="email" value="<?php echo $result[3] ?>"  placeholder="Email" name="email">
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
					<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]."?tab=motdepasse" ?>">
						<h1>Mot de passe</h1>
						<?php 
						if($_SERVER["REQUEST_METHOD"] === "POST")
						{
							$oldpwd = $_POST["oldpassword"];
							$new    = $_POST["newpassword"];
							$req = mysqli_query($conn, "UPDATE users SET mdp = $new WHERE email = '$_SESSION[user]'");
						}
						?>
						<div class="row">
							<div class="form-group">
								<label for="mdp">Ancien Mot de passe</label>
								<?php 
									$req = mysqli_query($conn, "SELECT mdp FROM users WHERE email = '$_SESSION[user]'");
									$res = mysqli_fetch_row($req);
								?>
								<input type="password" id="mdp" 	value="<?php echo $res[0] ?>" placeholder="Mot de passe" name="oldpassword">
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