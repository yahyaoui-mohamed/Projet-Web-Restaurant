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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<link rel="stylesheet" href="css/style.css">
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
				<li><a href="menu.php">Menu</a></li>
				<li><a href="about.php">About</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
			<div class="account">
				<?php 
				if(isset($_SESSION["admin"]))
				{
					echo "<a href='admin.php'>Dashboard</a>";
					echo "<a href='deconnect.php'>Déconnexion</a>";
				}
				else if(isset($_SESSION["user"]))
				{

					echo "<a href='account.php'>Compte</a>";
					echo "<a href='deconnect.php'>Déconnexion</a>";
					echo "
					<a href='account.php?tab=commande'>
						<span href='#' id='shop'>
						    <span class='shop-count'>0</span>
							<i class='fas fa-shopping-cart'></i>
						</span>
					</a>"
					;
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
			<button id="reserver">Reserver une table</button>
		</div>	
		</div>
		<div class="right">
			<img src="img/hero.jpg" alt="">
		</div>		
	</div>

	<div class="about">
		<h1>Meilleure façon de manger des repas sains</h1>
		<div class="about-container">
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
	</div>
	<div class="repas">
		<div class="head">
			<h1>Nos Menus</h1>
			<a href="menu.php">Voir Plus &nbsp; &#x2794;</a>
		</div>

		<div class="menu-container">
			<div class="swiper-container">
  				<div class="swiper-wrapper">

				<?php 
				while($tab = mysqli_fetch_row($req))
				{
				?>
					<div class="swiper-slide">
						<div class='menu-item'>
							<img src='<?php echo $tab[4] ?>' alt=''>
							<span><?php echo $tab[2]?>TND</span>
							<h1><?php echo $tab[1] ?></h1>
							<p><?php echo $tab[3] ?></p>
							<input type="hidden" name="id" value="<?php echo $tab[0]?>">
							<a href="" id='commander' class="commande-btn" 
								<?php if(isset($_SESSION["user"]))echo "data-login='true'"?>>
							Commander</a>
						</div>
					</div>
				<?php
				}
				?>
 				</div>
			    <div class="swiper-pagination"></div>
			    <div class="swiper-button-prev"></div>
			    <div class="swiper-button-next"></div>
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
	<footer>
		<div class="footer-item">
			<h3 class="title">Restaurant<span>.</span></h3>
			<p>Lorem, ipsum, dolor sit amet consectetur adipisicing elit.</p>
			<div class="tel"><i class="fas fa-phone-alt"></i> +216 22000000</div>
			<div class="email"><i class="fas fa-envelope"></i> exemple@email.com</div>
			<div class="links">
				<a href="#"><i class="fas fa-facebook"></i></a>
				<a href="#"><i class="fas fa-twitter"></i></a>
				<a href="#"><i class="fas fa-instagram"></i></a>
				<a href="#"><i class="fas fa-youtube"></i></a>
			</div>
		</div>
		<div class="footer-item">
			<h3>Liens utiles</h3>
			<ul>
				<li><i class="fas fa-chevron-right"></i><a href="index.php">Home</a></li>
				<li><i class="fas fa-chevron-right"></i><a href="menu.php">Menu</a></li>
				<li><i class="fas fa-chevron-right"></i><a href="about.php">About</a></li>
				<li><i class="fas fa-chevron-right"></i><a href="contact.php">Contact</a></li>
			</ul>
		</div>
		<div class="footer-item">
			<div class="mapouter"><div class="gmap_canvas"><iframe width="352" height="293" id="gmap_canvas" src="https://maps.google.com/maps?q=&t=&z=11&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://soap2day-to.com"></a><br><style>.mapouter{position:relative;text-align:right;height:293px;width:352px;}</style><a href="https://www.embedgooglemap.net">google map embed code</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:293px;width:352px;}</style></div></div>
		</div>
	</footer>
	<p class="copyright">Restaurant 2021 &copy; All Right Resereved &reg;</p>
	<script src="js/main.js"></script>	
</body>
</html>