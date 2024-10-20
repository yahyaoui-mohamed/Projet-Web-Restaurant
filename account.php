<!-- <?php
			session_start();
			if (!isset($_SESSION["user"])) {
				header("location:index.php");
			}
			include "connect.php";
			$query  = $connect->prepare("SELECT * FROM users WHERE email = '$_SESSION[user]'");
			$query->execute();
			$result = $query->fetch();
			?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/main.css">
	<title>Compte</title>
</head>

<body>
	<div class="account-wrap">
		<div class="account-sidebar">
			<div class="account-info">
				<div class="account-profile-img" <?php if ($result[6] !== "") echo "style=background-image:url($result[6])"; ?>></div>
				<span><?php echo ucfirst($_SESSION["nom"]) . " " . ucfirst($_SESSION["prenom"]); ?></span>
			</div>

			<ul>
				<li <?php if (!isset($_GET["tab"]) || $_GET["tab"] === "compte") echo "class='active'" ?>>
					<i class="fas fa-user"></i><a href="?tab=compte">Compte</a>
				</li>
				<li <?php if (isset($_GET["tab"]) && $_GET["tab"] === "commande") echo "class='active'" ?>>
					<i class="fas fa-shopping-cart"></i><a href="?tab=commande">Vos commandes</a>
				</li>
				<li <?php if (isset($_GET["tab"]) && $_GET["tab"] === "motdepasse") echo "class='active'" ?>>
					<i class="fas fa-key"></i><a href="?tab=motdepasse">Changer mot de passe</a>
				</li>
				<li>
					<i class="fas fa-undo"></i><a href="index.php">Retour à l'accueil</a>
				</li>
			</ul>
		</div>
		<div class="account-content">
			<?php
			if (!isset($_GET["tab"]) || $_GET["tab"] === "compte") {
			?>
				<form class="account-form" method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>" enctype="multipart/form-data">
					<h1>Compte</h1>
					<?php

					if ($_SERVER["REQUEST_METHOD"] === "POST") {
						$nom    = $_POST["nom"];
						$prenom = $_POST["prenom"];
						$email  = $_POST["email"];
						$tel    = $_POST["tel"];
						$file   = $_FILES["img"];
						if ($file !== "") {
							$filelocation = $_FILES["img"]["tmp_name"];
							$destination = "img/users/" . $_FILES["img"]["name"];
							move_uploaded_file($_FILES["img"]["tmp_name"], $destination);
							$query = $connect->prepare("UPDATE users SET nom = '$nom', prenom = '$prenom', email = '$email', tel = '$tel', profile_image = '$destination' WHERE email = '$_SESSION[user]'");
							$query->execute();
						} else {
							// $query  = $connect->prepare($conn, " UPDATE users SET nom = '$nom', prenom = '$prenom', email = '$email', tel = '$tel' WHERE email = '$_SESSION[user]'");
							// $query->execute();
						}
					}

					?>
					<div class="row">
						<?php
						$query  = $connect->prepare("SELECT * FROM users WHERE email = '$_SESSION[user]'");
						$query->execute();
						$result = $query->fetch();

						?>
						<div class="form-group">
							<label for="nom">Nom</label>
							<input type="text" id="nom" value="<?php echo $result[1] ?>" placeholder="Nom" name="nom">
						</div>
						<div class="form-group">
							<label for="prenom">Prénom</label>
							<input type="text" id="prenom" value="<?php echo $result[2] ?>" placeholder="Prénom" name="prenom">
						</div>
					</div>

					<div class="row">
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" id="email" value="<?php echo $result[3] ?>" placeholder="Email" name="email">
						</div>
						<div class="form-group">
							<label for="phone">Numéro de téléphone</label>
							<input type="phone" id="phone" placeholder="Téléphone" name="tel">
						</div>
					</div>
					<div class="form-group">
						<label for="file">Photo de profile</label>
						<input type="file" id="file" nom="file" name="img">
					</div>
					<input type="submit" value="Enregistrer">

				</form>

			<?php
			} else if ($_GET["tab"] === "motdepasse") {
			?>
				<form method="POST" action="<?php echo $_SERVER["PHP_SELF"] . "?tab=motdepasse" ?>">
					<h1>Mot de passe</h1>
					<?php
					if ($_SERVER["REQUEST_METHOD"] === "POST") {
						$oldpwd = $_POST["oldpassword"];
						$new    = $_POST["newpassword"];
						$req = $connect->prepare("UPDATE users SET mdp = $new WHERE email = '$_SESSION[user]'");
						$req->fetch();
					}
					?>
					<div class="row">
						<div class="form-group">
							<label for="mdp">Ancien Mot de passe</label>
							<?php
							$req = $connect->prepare("SELECT mdp FROM users WHERE email = '$_SESSION[user]'");
							$req->execute();
							$res = $req->fetch();
							?>
							<input type="password" id="mdp" value="<?php echo $res[0] ?>" placeholder="Mot de passe" name="oldpassword">
						</div>
						<div class="form-group">
							<label for="mdp,">Nouveau mot de passe</label>
							<input type="password" id="mdpn" value="" placeholder="Mot de passe" name="newpassword">
						</div>
					</div>

					<input type="submit" value="Enregistrer">
				</form>
			<?php
			} else if ($_GET["tab"] === "commande") {   ?>
				<h1>Vos Commandes</h1>
			<?php
				$query  = $connect->prepare("SELECT * FROM users WHERE email = '$_SESSION[user]'");
				$query->execute();
				$id = $query->fetch()[0];
				$query1 = $connect->prepare("SELECT * FROM commande WHERE user_id = '$id'");
				$query1->execute();
				echo "<p>Vous Avez " . $query1->rowCount() . " Commandes.</p>";
				echo "
					<table>
						<thead>
							<th>Produit</th>
							<th>Prix</th>
							<th></th>
							<th></th>
						</thead>
					";
				while ($tab = $query1->fetch()) {
					echo "<tr>";
					$query2 = $connect->prepare("SELECT * FROM food WHERE food_id = '$tab[1]'");
					$query2->fetch();
					while ($tab1 = $query2->fetch()) {
						echo "
							<td>$tab1[1]</td>
							<td>$tab1[2]TND</td>
							<td><img src='$tab1[4]' width=100></td>
							<td>";
						if ($tab[3] == 1) {
							echo "Confirmée";
						} else {
							echo "<a href='supprimercommande.php?commandeid=$tab[0]'>Supprimer</a> - 
								<a href='confirmercommande.php?commandeid=$tab[0]'>Confirmer</a>";
						}

						"</td>";
					}
					echo "</tr>";
				}
				echo "</table>";
			}


			?>

		</div>
	</div>
</body>

</html> -->



<?php
include "connect.php";
$req = $connect->prepare("SELECT nom, prenom FROM users WHERE email = '$_SESSION[user]'");
$req->execute();
$res = $req->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.4.2/uicons-regular-rounded/css/uicons-regular-rounded.css'>
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.4.2/uicons-regular-straight/css/uicons-regular-straight.css'>
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.4.2/uicons-thin-rounded/css/uicons-thin-rounded.css'>
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.4.2/uicons-regular-rounded/css/uicons-regular-rounded.css'>
	<link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/main.css">
	<title>Account</title>
</head>

<body>
	<div class="upper-nav text-center">
		<div class="container-fluid">
			<div class="row d-flex align-items-center">
				<div class="col-lg-2">
					<h1><a href="index.php">Restaurant</a></h1>
				</div>
				<div class="col-lg-8">
					<form action="">
						<div class="form-group">
							<input type="search" class="form-control" placeholder="Search...">
							<i class="fi fi-rr-search"></i>
						</div>
					</form>
				</div>
				<div class="col-lg-2">
					<div class="row">
						<div class="col-lg-8 align-items-center justify-content-end">
							<div class="avatar">
								<div class="img">
									<img src="./img/avatar.svg" alt="" />
								</div>
								<span><?= $res[0] ?></span>
								<div class="profile">
									<ul>
										<li><i class="fi fi-rs-user"></i><a href="account.php?tab=compte">Compte</a></li>
										<li><i class="fi fi-rr-envelope"></i><a href="account.php?tab=message">Messages</a></li>
										<li><i class="fi fi-rr-settings"></i><a href="#">Parameters</a></li>
										<li><a href="deconnect.php" class="logout">Logout</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="account-wrap">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-2">
					<div class="account-sidebar">

						<!-- <div class="account-info">
                            <div class="account-profile-img" style="background-image: url(img/users/admin.png)" ></div>
                            <span><?php echo ucfirst(
																		$res[0] . " " . $res[1]
																	); ?></span>
					</div> -->

						<ul>
							<li
								<?php if (!isset($_GET["tab"])) {
									echo "class='active'";
								} ?>>
								<a href="./account.php">Accueil</a>
							</li>

							<li
								<?php if (isset($_GET["tab"]) && $_GET["tab"] === "usercommandes") {
									echo "class='active'";
								} ?>>
								<a href="./account.php?tab=usercommandes">Vos commandes</a>
							</li>

						</ul>
					</div>
				</div>

				<div class="col-lg-10">
					<div class="account-content">

					</div>
				</div>

			</div>
		</div>
	</div>
	</div>
	</div>



	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="js/admin.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
		document.querySelector(".avatar").addEventListener("click", function() {
			console.log("clicked")
			let target = document.querySelector(".profile");
			target.classList.toggle("show");
		});
	</script>
</body>

</html>