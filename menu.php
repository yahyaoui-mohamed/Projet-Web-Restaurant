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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
		<title>Menu</title>
	</head>
	
	<body>
	<nav class="navbar navbar-expand-lg bg-transparent">
		<div class="container">
			<!-- <a class="navbar-brand" href="#">Navbar</a> -->
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="./">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="menu.php">Menu</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Reserver</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="contact.php">Contact</a>
					</li>
				</ul>
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a href="signup.php">
							<i class="fi fi-rs-user"></i>
						</a>
					</li>
					<li class="nav-item">
						<a href="login.php">
							<span>0</span>
							<i class="fi fi-rs-shopping-cart"></i>
						</a>
					</li>
				</ul>
			</div>

		</div>
	</nav>
		<div class="menu-container">

			<?php 
				while($tab = mysqli_fetch_row($req))
				{
					?>
					<div class='menu-item'>
						<img src='<?php echo $tab[4] ?>' alt=''>
						<span><?php echo $tab[2]?>TND</span>
						<h1><?php echo $tab[1] ?></h1>
						<p><?php echo $tab[3] ?></p>
						<input type="hidden" name="id" value="<?php echo $tab[0]?>">
						<a href="#" id='commander' class="commande-btn" 
							<?php if(isset($_SESSION["user"]))echo "data-login='true'"?>>
						Commander</a>
					</div>
				<?php
				}

			?>
		</div>
		<script src="js/main.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>

</html>