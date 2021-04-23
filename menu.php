<?php
session_start();
include "connect.php";
$req = mysqli_query($conn,"SELECT * FROM `food`");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="style.css">
		<title>Menu</title>
	</head>
	<body>
	<a href="#" id="scroll-top">&#8593;</a>
	<div class="navbar">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="#">Menu</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
		</ul>
		<div class="account">
			<?php 
			if(isset($_SESSION["user"]))
			{
				echo "<a href='account.php'>Compte</a>";
				echo "<a href='deconnect.php'>Déconnexion</a>";
			}
			else{
				echo "
				<a href='signup.php'>Créer Un compte</a>
				<a href='login.php'>S'identifier</a>";
			}
			?>

		</div>
	</div>
		<div class="menu-container">

			<?php 
				while($tab = mysqli_fetch_row($req))
				{
					echo
					"
					<div class='menu-item'>
						<img src='$tab[4]' alt=''>
						<span>$tab[2]$</span>
						<h1>$tab[1]</h1>
						<p>$tab[3]</p>
						<a href=commande.php?id=$tab[0]>Commander</a>
					</div>
					";
				}

			?>
		</div>
	</body>

</html>