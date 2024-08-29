<?php
session_start();
if(isset($_SESSION["user"]))
{
	header("location:index.php");
}
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<title>S'identifier</title>
</head>
<body>
	<div class="forms">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
				<form class="login-form" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
					<h1>Login</h1>
						<?php 
						if($_SERVER["REQUEST_METHOD"] === "POST")
							{
								$email  = $_POST["email"];
								$mdp    = $_POST["mdp"];
								$query  = $connect->prepare("SELECT * FROM users WHERE email = '$email' AND mdp = '$mdp'");
								$query->execute();
								$result = $query->fetch();
								if($query->rowCount() == 0)
								{
									echo "<div class='alert-danger'>Email ou mot de passe invalide!</div>";
								}
								else if($query->rowCount() == 1 && $result["priority"] == "1")
								{
									session_start();
									$_SESSION["admin"]  = $email;
									header("location:admin.php");	
								}
								else
								{
									session_start();
									$_SESSION["user"]   = $email;
									$_SESSION["nom"]    = $result[1];
									$_SESSION["prenom"] = $result[2];
									header("location:index.php");
								}
							}
						?>
						<div>
							<input type="email" placeholder="Email" required name="email" autocomplete="off">
						</div>
						<div>
							<input type="password" placeholder="Mot de passe" required name="mdp" autocomplete="off">
						</div>
						<div>
							<input type="submit" value="S'identifier">
						</div>
					</form>
				</div>
				<div class="col-lg-6">
				<form class="signup-form" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
					<h1>Sign Up</h1>
					<?php 
						if($_SERVER["REQUEST_METHOD"] === "POST")
						{
							$nom    = $_POST["nom"];
							$prenom = $_POST["prenom"];
							$email  = $_POST["email"];
							$mdp    = $_POST["mdp"];
							$query = $connect->prepare("INSERT INTO users VALUES ('','$nom','$prenom','$email','$mdp','','',0)");
							echo "<div class='alert-success'>Compte créer avec succès. Vous pouvez maintenant <a href='login.php'>S'identifier</a></div>";
						}
						?>
						<div>
							<input type="text" placeholder="Nom" required name="nom" autocomplete="off">
						</div>
						<div>
							<input type="text" placeholder="Prénom" required name="prenom" autocomplete="off">
						</div>
						<div>
							<input type="email" placeholder="Email" required name="email" autocomplete="off">
						</div>
						<div>
							<input type="password" placeholder="Mot de passe" required name="mdp" autocomplete="off">
						</div>
						<div>
							<input type="submit" value="Créer">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	

	

	<script src="js/main.js"></script>	
</body>
</html>