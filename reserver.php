<?php
session_start();
include "connect.php";
$req = $connect->prepare("SELECT * FROM food");
$req->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.4.2/uicons-regular-straight/css/uicons-regular-straight.css'>
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
					<?php
					if (isset($_SESSION["user"])) {
					?>
						<li class="nav-item">
							<a href="deconnect.php">Logout
						</li>
					<?php }
					?>
					</a>
				</ul>
			</div>

		</div>
	</nav>

	<div class="reserver-table">
		<div class="overlay"></div>
		<div class="title">
			<h1>Réserver votre table</h1>
		</div>
	</div>

	<div class="table-list">
		<div class="container">
			<?php
			$req = $connect->prepare("SELECT * FROM tables");
			$req->execute();

			while ($res = $req->fetch()) {
			?>
				<div class="table-item">
					<div class="row">
						<div class="col-lg-6">
							<img src="<?= $res[4] ?>" alt="">
						</div>
						<div class="col-lg-6 d-flex justify-content-center align-items-center">
							<div class="desc">
								<h1><?= $res[1] ?></h1>
								<p><?= $res[2] ?> Persons</p>
								<span><?= $res[5] > 0 ? "Available" : "Unavailable" ?></span>
							</div>

						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>



	<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
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
				</div>
				<div class="col-lg-4">
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
				<div class="col-lg-4">
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


	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/main.js"></script>
</body>

</html>