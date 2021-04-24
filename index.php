<?php
session_start();
include "connect.php";
$req = mysqli_query($conn,"SELECT * FROM `food` limit 0, 5");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="style.css">
	<title>Restaurant</title>
</head>
<body>
	<a href="#" id="scroll-top">&#8593;</a>
	<div class="reserver">
			<span>&#x2716;</span>
		<div class="container">
			<form>
				<h1>Reserver une Table</h1>
				<div>
					<input type="text" placeholder="Nom" name="nom" autocomplete="off" required>
				</div>
				<div>
					<input type="text" placeholder="Prénom" name="prenom" autocomplete="off" required>
				</div>
				<div>
					<input type="phone" placeholder="Numéro de téléphone" name="tel" autocomplete="off" required pattern="[0-9]{8}" title="Please type a valid phone number">
				</div>
				<div>
					<input type="number" placeholder="Nombre de personne(s)" name="nbrpersonne" autocomplete="off" required>
				</div>
				<div>
					<input type="date" placeholder="Date" name="date" required>
				</div>
				<div>
					<input type="submit" value="Reserver">
				</div>
			</form>
		</div>
	</div>
		<div class="navbar">
			<ul>
				<li><a href="./">Home</a></li>
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
	<div class="header">
		<div class="left">
	
		<div class="hero">
			<h1>Bienvenue Dans Notre Restaurant</h1>
			<button id="reserver">Reserver</button>
		</div>	
		</div>
		<div class="right">
			<img src="img/hero.jpg" alt="">
		</div>		
	</div>

	<div class="about">
		<div class="item">
			<img src="img/healthy.svg" alt="">
			<h1>Repas Sain</h1>
			<p>Making a reservation at Délicious restaurant is easy and takes just a couple of minutes.</p>
		</div>

		<div class="item">
			<img src="img/food.svg" alt="">
			<h1>Fast Food</h1>
			<p>Making a reservation at Délicious restaurant is easy and takes just a couple of minutes.</p>
		</div>

		<div class="item">
			<img src="img/coffee.svg" alt="">
			<h1>Caffée Delicieux</h1>
			<p>Making a reservation at Délicious restaurant is easy and takes just a couple of minutes.</p>
		</div>
	</div>
	<div class="repas">
		<div class="head">
			<h1>Nos Menus</h1>
			<a href="menu.php">Voir Plus &nbsp; &#x2794;</a>
		</div>
		<div class="menu-container">
			<div class="owl-carousel">

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
		</div>
	</div>
	<div class="gallery">
		<h1>Gallery</h1>
		<div class="gallery-container">
			<div class="gallery-item">
				<div class="overlay">
					<span>&#10010;</span>
				</div>
				<img src="img/gallery/1.jpg" alt="">
			</div>
			<div class="gallery-item">
				<div class="overlay">
					<span>&#10010;</span>
				</div>
				<img src="img/gallery/2.jpg" alt="">
			</div>
			<div class="gallery-item">
				<div class="overlay">
					<span>&#10010;</span>
				</div>
				<img src="img/gallery/3.jpg" alt="">
			</div>
			<div class="gallery-item">
				<div class="overlay">
					<span>&#10010;</span>
				</div>
				<img src="img/gallery/4.jpg" alt="">
			</div>
			<div class="gallery-item">
				<div class="overlay">
					<span>&#10010;</span>
				</div>
				<img src="img/gallery/5.jpg" alt="">
			</div>
			<div class="gallery-item">
				<div class="overlay">
					<span>&#10010;</span>
				</div>
				<img src="img/gallery/6.jpg" alt="">
			</div>		
		</div>
	</div>
	<script src="js/jquery.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/main.js"></script>	
</body>
</html>