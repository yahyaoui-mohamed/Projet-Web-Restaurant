<?php
session_start();

include "connect.php";
if (isset($_SESSION["user"])) {
	header("location: index.php");
}
if (isset($_SESSION["admin"])) {
	header("location: admin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/main.css">
	<title>S'identifier</title>
</head>

<body>
	<div class="go-back">
		<a href="index.php">
			<i class="fi fi-rr-arrow-left"></i>
		</a>
	</div>
	<div class="forms">
		<div class="row">
			<div class="col-lg-4">
				<form class="login-form" method="POST" action="">
					<h1>Login</h1>
					<p>Se connecter avec votre adresse et mot de passe.</p>
					<?php
					if ($_SERVER["REQUEST_METHOD"] === "POST") {
						$email  = $_POST["email"];
						$mdp    = $_POST["mdp"];
						$query  = $connect->prepare("SELECT * FROM users WHERE email = '$email' AND mdp = '$mdp'");
						$query->execute();
						$result = $query->fetch();
						if ($query->rowCount() == 0) {
							echo "<div class='alert-danger'>Email ou mot de passe invalide!</div>";
						} else if ($query->rowCount() == 1 && $result["priority"] == "1") {
							session_start();
							$_SESSION["admin"]  = $email;
							header("location:admin.php");
						} else {
							session_start();
							$_SESSION["user"]   = $email;
							$_SESSION["nom"]    = $result[1];
							$_SESSION["prenom"] = $result[2];
							header("location:index.php");
						}
						$file = "./action.log";

						$time = date('Y-m-d H:i:s');

						if (isset($_SESSION["user"])) {
							$user = $_SESSION["user"];
						} else {
							$user = $_SESSION["admin"];
						}

						$message = $user . " has logged in at " . $time . PHP_EOL;

						file_put_contents($file, $message, FILE_APPEND | LOCK_EX);
					}
					?>
					<div class="mb-3">
						<label for="email">Email</label>
						<input id="email" type="email" required name="email" autocomplete="off">
					</div>
					<div class="mb-3">
						<label for="password">Mot de passe</label>
						<input id="password" type="password" required name="mdp" autocomplete="off">
					</div>
					<div class="mb-3">
						<div class="d-flex justify-content-between">
							<div class="form-check d-flex">
								<input class="form-check-input" type="checkbox" value="" id="remeber-me">
								<label class="form-check-label" for="remeber-me">
									Se rappeler de moi
								</label>
							</div>
							<div class="password-text">
								<a href="forgetpassword.php" class="forgot-password">Mot de passe oublié?</a>
							</div>
						</div>
					</div>
					<div class="mb-3">
						<input type="submit" value="S'identifier">
					</div>
					<div class="signup-link">Vous n'avez pas un compte? <a href="signup.php">Sign up</a></div>
				</form>
			</div>
			<div class="col-lg-8"></div>
		</div>

	</div>





	<script src="js/main.js"></script>
</body>

</html>