<?php
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="signup.css">
	<title>S'identifier</title>
</head>
<body>
	<a href="index.php" class="back">&#8592; Retour à l'accueil</a>
	<form class="login-form" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
	<h1>S'identifier</h1>
	<?php 
	if($_SERVER["REQUEST_METHOD"] === "POST")
		{
			$email  = $_POST["email"];
			$mdp    = $_POST["mdp"];
			$query  = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND mdp = '$mdp'");
			$result = mysqli_fetch_row($query);
			if(mysqli_num_rows($query) == 0)
			{
				echo "<div class='alert-danger'>Email ou mot de passe invalide!</div>";
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
		<input type="email" placeholder="Email" required name="email">
	</div>
	<div>
		<input type="password" placeholder="Mot de passe" required name="mdp">
	</div>
	<div>
		<input type="submit" value="S'identifier">
	</div>
	Vous n'avez pas un compte? <a href="signup.php">Créer un</a>

</form>
</body>
</html>