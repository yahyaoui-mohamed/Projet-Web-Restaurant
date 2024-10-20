<?php
session_start();
include "connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.4.2/uicons-regular-straight/css/uicons-regular-straight.css'>
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.4.2/uicons-brands/css/uicons-brands.css'>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/main.css">
	<title>Restaurant</title>
</head>

<body>

	<nav class="navbar navbar-expand-lg bg-transparent">
		<div class="container">
			<a class="navbar-brand" href="./">Restaurant <span>.</span></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav m-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="./">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="menu.php">Menu</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="reserver.php">Reserver</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="contact.php">Contact</a>
					</li>
				</ul>
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a href=<?php if (isset($_SESSION["admin"])) echo "admin.php";
										else if (isset($_SESSION["user"])) echo "account.php";
										else echo "login.php"; ?>>
							<i class="fi fi-rs-user"></i>
						</a>
					</li>
					<li class="nav-item">
						<a href="cart.php">
							<span class="nav-shop">0</span>
							<i class="fi fi-rs-shopping-cart"></i>
						</a>
					</li>
				</ul>
			</div>

		</div>
	</nav>

	<div class="header">
		<div class="content">
			<div class="overlay">
			</div>
			<div class="container">
				<div class="hero">
					<h1>Bienvenue dans notre restaurant</h1>
					<button href="#" class="slide" id="reserver">Reserver votre table</button>

				</div>
			</div>
		</div>

	</div>

	<div class="about">
		<div class="container">
			<h1>Meilleure façon de manger des repas sains</h1>
			<div class="row">
				<div class="col-lg-4">
					<div class="item">
						<img src="img/healthy.svg" alt="">
						<h1>Repas Sain</h1>
						<p>Faire une réservation dans un délicieux restaurant est facile et ne prend que quelques minutes.</p>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="item">
						<img src="img/food.svg" alt="">
						<h1>Fast Food</h1>
						<p>Faire une réservation dans un délicieux restaurant est facile et ne prend que quelques minutes.</p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="item">
						<img src="img/coffee.svg" alt="">
						<h1>Caffée Delicieux</h1>
						<p>Faire une réservation dans un délicieux restaurant est facile et ne prend que quelques minutes.</p>
					</div>
				</div>



			</div>
		</div>
	</div>

	<div class="repas">
		<div class="container">
			<h1>Nos Menus</h1>
		</div>

		<div class="container">
			<?php
			$req = $connect->prepare("SELECT * FROM food limit 0,6");
			$req->execute();
			?>
			<div class="row">
				<?php
				while ($res = $req->fetch()) {
				?>
					<div class="col-lg-4">
						<div class="menu-item">
							<div class="menu-img">
								<img src="<?= $res["food_img"] ?>" alt="">
							</div>
							<div class="contents">
								<div class="title">
									<h1><?= $res["food_name"] ?></h1>
								</div>
								<div class="desc">
									<p><?= $res["food_description"] ?></p>
									<span><?= $res["food_price"] ?> TND</span>
								</div>
							</div>
						</div>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>

	<div class="reservation text-center">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<form class="reserve-table">
						<p>Reservation</p>
						<h1>Reserver votre table</h1>
						<div class="row">
							<div class="mb-3 col-lg-6">
								<input class="form-control" type="text" placeholder="Nom" name="nom" autocomplete="off" id="nom" required>
							</div>
							<div class="mb-3 col-lg-6">
								<input class="form-control" type="text" placeholder="Prénom" id="prenom" name="prenom" autocomplete="off" required>
							</div>
						</div>

						<div class="row">
							<div class="mb-3 col-lg-6">
								<input class="form-control" type="phone" placeholder="Numéro de téléphone" id="tel" name="tel" autocomplete="off" required title="Please type a valid phone number">
							</div>
							<div class="mb-3 col-lg-6">
								<select class="form-select" name="table" id="table">
									<option selected>Choisissez une table</option>
									<option value="2">Table 2 personnes</option>
									<option value="4">Table 4 personnes</option>
									<option value="8">Table 8 personnes</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="mb-3 col-lg-12">
								<input class="form-control" type="datetime-local" id="date" placeholder="Date" name="date" required>
							</div>
						</div>
						<div class="row">
							<div class="mb-3 col-lg-12">
								<input class="form-control" type="submit" value="Reserver">
							</div>
						</div>
					</form>
				</div>
				<div class="col-lg-6">
					<div class="img">
						<div class="overlay"></div>
						<img src="./img/table.jpg" alt="">
						<a href="reserver.php">Voir la liste des tables</a>
					</div>
				</div>
			</div>

		</div>
	</div>


	<div class="gallery">
		<h1>Gallery</h1>
		<div class="gallery-container">

			<div class="row">

				<div class="col-lg-4">
					<div class="gallery-item">
						<div class="overlay">
							<span>+</span>
						</div>
						<img src="img/gallery/1.jpg" alt="">
					</div>
				</div>

				<div class="col-lg-4">
					<div class="gallery-item">
						<div class="overlay">
							<span>+</span>
						</div>
						<img src="img/gallery/2.jpg" alt="">
					</div>
				</div>

				<div class="col-lg-4">
					<div class="gallery-item">
						<div class="overlay">
							<span>+</span>
						</div>
						<img src="img/gallery/3.jpg" alt="">
					</div>
				</div>

				<div class="col-lg-4">
					<div class="gallery-item">
						<div class="overlay">
							<span>+</span>
						</div>
						<img src="img/gallery/4.jpg" alt="">
					</div>
				</div>

				<div class="col-lg-4">
					<div class="gallery-item">
						<div class="overlay">
							<span>+</span>
						</div>
						<img src="img/gallery/5.jpg" alt="">
					</div>
				</div>

				<div class="col-lg-4">
					<div class="gallery-item">
						<div class="overlay">
							<span>+</span>
						</div>
						<img src="img/gallery/6.jpg" alt="">
					</div>
				</div>
			</div>

		</div>
	</div>


	<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="footer-item">
						<h3 class="title">Restaurant<span>.</span></h3>
						<p>Lorem, ipsum, dolor sit amet consectetur adipisicing elit.</p>
						<div class="links">
							<ul>
								<li><i class="fi fi-rs-marker"></i> 8th floor, 379 Hudson St, New York, NY 10018</li>
								<li><i class="fi fi-rs-phone-flip"></i> (+1) 96 716 6879</li>
								<li><i class="fi fi-rs-envelope"></i> contact@site.com</li>
								<li></li>
							</ul>
							<div class="social-contact">
								<ul>
									<li><a href="#"><i class="fi fi-brands-facebook"></i></a></li>
									<li><a href="#"><i class="fi fi-brands-instagram"></i></a></li>
									<li><a href="#"><i class="fi fi-brands-twitter-alt"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-3">
					<div class="footer-item">
						<h3 class="title">Liens utiles</h3>
						<ul>
							<li><i class="fas fa-chevron-right"></i><a href="index.php">Home</a></li>
							<li><i class="fas fa-chevron-right"></i><a href="menu.php">Menu</a></li>
							<li><i class="fas fa-chevron-right"></i><a href="about.php">About</a></li>
							<li><i class="fas fa-chevron-right"></i><a href="contact.php">Contact</a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-3">
					<div class="footer-item">
						<h3 class="title">Opening Hours</h3>
						<ul>
							<li>Monday 9:00 - 00:00</li>
							<li>Tuesday 9:00 - 00:00</li>
							<li>Wednesday 9:00 - 00:00</li>
							<li>Thursday 9:00 - 00:00</li>
							<li>Friday 9:00 - 02:00</li>
							<li>Saturday 9:00 - 02:00</li>
							<li>Sunday 9:00 - 02:00</li>
						</ul>
					</div>
				</div>

				<div class="col-lg-3">
					<div class="footer-item">
						<div class="mapouter">
							<div class="gmap_canvas"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3211.281964746296!2d10.565097814784021!3d36.40237279769265!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12fd617c47ada893%3A0xa5662090817a12af!2sRestaurant%20Condor!5e0!3m2!1sfr!2stn!4v1620347748711!5m2!1sfr!2stn" width="352" height="293" style="border:0;" allowfullscreen="" loading="lazy"></iframe><a href="https://soap2day-to.com"></a><br>
								<style>
									.mapouter {
										position: relative;
										text-align: right;
										height: 293px;
										width: 352px;
									}
								</style><a href="https://www.embedgooglemap.net">google map embed code</a>
								<style>
									.gmap_canvas {
										overflow: hidden;
										background: none !important;
										height: 293px;
										width: 352px;
									}
								</style>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



	</footer>
	<p class="copyright">Restaurant <span id="year"></span> &copy; All Right Resereved &reg;</p>

	<div class="msg">
	</div>

	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/main.js"></script>
	<script>
		document.querySelector(".reserve-table").addEventListener("submit", function(e) {
			e.preventDefault();
			let nom = document.getElementById("nom").value;
			let prenom = document.getElementById("prenom").value;
			let tel = document.getElementById("tel").value;
			let nbrpersonne = document.getElementById("table").value;
			console.log(nbrpersonne);
			let date = document.getElementById("date").value;

			let xhr = new XMLHttpRequest();

			xhr.open("POST", "reservertable.php", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send("&nom=" + nom + "&prenom=" + prenom + "&tel=" + tel + "&table=" + nbrpersonne + "&date=" + date);

			xhr.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("nom").value = "";
					document.getElementById("prenom").value = "";
					document.getElementById("tel").value = "";
					document.getElementById("date").value = "";
				}
			};

		});
	</script>
</body>

</html>