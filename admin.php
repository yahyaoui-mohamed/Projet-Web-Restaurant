<?php
include "connect.php";
session_start();
if (!isset($_SESSION["admin"])) {
	header("location:login.php");
}
$req = $connect->prepare("SELECT nom, prenom FROM users WHERE priority = 1");
$req->execute();
$res = $req->fetch();

$req1 = $connect->prepare("SELECT * FROM notifications WHERE seen = 0 ORDER BY id DESC");
$req1->execute();
$res1 = $req1->rowCount();

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
	<title>Admin Panel</title>
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
						<div class="col-lg-4 d-flex align-items-center justify-content-center">
							<div class="notif">
								<i class="fi fi-rr-bell"></i>
								<?php
								if ($res1 > 0) {
								?>
									<span><?= $res1 ?></span>
								<?php
								}
								?>
								<div class="notifications">
									<h1 class="title">Notifications
										<?php
										if ($res1 > 0) {
										?>
											<span><?= $res1 ?> New</span>
										<?php
										}
										?>
									</h1>
									<ul>
										<?php
										while ($notif = $req1->fetch()) {
										?>
											<li class="notif-item">
												<div class="img">
													<img src="./img/notif/notif1.jpg" alt="">
												</div>
												<div class="titles">
													<h4><?= $notif["title"] ?></h4>
													<p><?= $notif["message"] ?></p>
												</div>
											</li>
										<?php
										}

										?>
									</ul>
									<div class="see-all">
										<a href="?tab=notifications">See All Notifications</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-8 align-items-center justify-content-center">
							<div class="avatar">
								<div class="img">
									<img src="./img/avatar.svg" alt="" />
								</div>
								<span><?= $res[0] ?></span>
								<div class="profile">
									<ul>
										<li><i class="fi fi-rs-user"></i><a href="admin.php?tab=compte">Compte</a></li>
										<li><i class="fi fi-rr-envelope"></i><a href="admin.php?tab=message">Messages</a></li>
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
								<a href="./admin.php">Accueil</a>
							</li>
							<li
								<?php if (
									isset($_GET["tab"]) &&
									($_GET["tab"] === "admin" || $_GET["tab"] === "ajouteradmin" || $_GET["tab"] === "editadmin")
								) {
									echo "class='active'";
								} ?>>
								<a href="?tab=admin">Gestion des admins</a>
							</li>
							<li
								<?php if (isset($_GET["tab"]) && $_GET["tab"] === "utilisateur") {
									echo "class='active'";
								} ?>>
								<a href="?tab=utilisateur">Gestion des utilisateurs</a>
							</li>
							<li <?php if (isset($_GET["tab"]) && $_GET["tab"] === "commande") {
										echo "class='active'";
									} ?>>
								<a href="?tab=commande">Gestion des commandes</a>
							</li>
							<li <?php if (
										isset($_GET["tab"]) &&
										($_GET["tab"] === "table" || $_GET["tab"] === "ajoutertable" || $_GET["tab"] === "edittable")
									) {
										echo "class='active'";
									} ?>>
								<a href="?tab=table">Gestion des tables</a>
							</li>
							<li <?php if (
										isset($_GET["tab"]) &&
										($_GET["tab"] === "produit" || $_GET["tab"] === "ajouterproduit" || $_GET["tab"] === "editproduct")
									) {
										echo "class='active'";
									} ?>>
								<a href="?tab=produit">Gestion des produits</a>
							</li>
							<li
								<?php if (isset($_GET["tab"]) && $_GET["tab"] === "reservetable") {
									echo "class='active'";
								} ?>>
								<a href="?tab=reservetable">Reservations des tables</a>
							</li>
						</ul>
					</div>
				</div>

				<div class="col-lg-10">
					<div class="account-content">
						<?php if (!isset($_GET["tab"])) {
							include "./includes/home.php";
						} elseif ($_GET["tab"] === "admin") {
							include "./includes/" . $_GET["tab"] . ".php";
						} elseif ($_GET["tab"] === "ajouteradmin") {
							include "./includes/" . $_GET["tab"] . ".php";
						} elseif ($_GET["tab"] === "compte") {
							include "./includes/" . $_GET["tab"] . ".php";
						} elseif ($_GET["tab"] === "utilisateur") {
							include "./includes/" . $_GET["tab"] . ".php";
						} elseif ($_GET["tab"] === "produit") {
							include "./includes/" . $_GET["tab"] . ".php";
						} elseif ($_GET["tab"] === "ajouterproduit") {
							include "./includes/" . $_GET["tab"] . ".php";
						} elseif ($_GET["tab"] === "commande") {
							include "./includes/" . $_GET["tab"] . ".php";
						} elseif ($_GET["tab"] === "reservetable") {
							include "./includes/" . $_GET["tab"] . ".php";
						} elseif ($_GET["tab"] === "table") {
							include "./includes/" . $_GET["tab"] . ".php";
						} elseif ($_GET["tab"] === "edittable") {
							include "./includes/" . $_GET["tab"] . ".php";
						} elseif ($_GET["tab"] === "editproduct") {
							include "./includes/" . $_GET["tab"] . ".php";
						} elseif ($_GET["tab"] === "envoyermessage") {
							include "./includes/" . $_GET["tab"] . ".php";
						} elseif ($_GET["tab"] === "message") {
							include "./includes/message.php";
						} elseif ($_GET["tab"] === "ajoutertable") {
							include "./includes/" . $_GET["tab"] . ".php";
						} elseif ($_GET["tab"] === "editadmin") {
							include "./includes/" . $_GET["tab"] . ".php";
						}
						?>
					</div>
				</div>

			</div>
		</div>
	</div>
	</div>
	</div>



	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
	<script src="js/admin.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/echarts.min.js"></script>
	<script type="text/javascript">
		var myChart1 = echarts.init(document.getElementById('main1'));
		var myChart2 = echarts.init(document.getElementById('main2'));

		var option1 = {
			title: {
				text: ''
			},
			tooltip: {},

			xAxis: {
				data: ['Shirts', 'Cardigans', 'Chiffons', 'Pants', 'Heels', 'Socks']
			},
			yAxis: {},
			series: [{
				name: 'sales',
				type: 'line',
				data: [5, 20, 36, 10, 10, 20],
				smooth: true
			}]
		};

		var option2 = {
			tooltip: {
				trigger: 'item'
			},
			legend: {
				top: '5%',
				left: 'center'
			},
			series: [{
				name: 'Access From',
				type: 'pie',
				radius: ['40%', '70%'],
				avoidLabelOverlap: false,
				itemStyle: {
					borderRadius: 10,
					borderColor: '#fff',
					borderWidth: 2
				},
				label: {
					show: false,
					position: 'center'
				},
				emphasis: {
					label: {
						show: true,
						fontSize: 40,
						fontWeight: 'bold'
					}
				},
				labelLine: {
					show: false
				},
				data: [{
						value: 1048,
						name: 'Search Engine'
					},
					{
						value: 735,
						name: 'Direct'
					},
					{
						value: 580,
						name: 'Email'
					},
					{
						value: 484,
						name: 'Union Ads'
					},
					{
						value: 300,
						name: 'Video Ads'
					}
				]
			}]
		};

		myChart1.setOption(option1);
		myChart2.setOption(option2);
		new gridjs.Grid({
			columns: ["Name", "Email", "Phone Number"],
			data: [
				["John", "john@example.com", "(353) 01 222 3333"],
				["Mark", "mark@gmail.com", "(01) 22 888 4444"],
				["Eoin", "eoin@gmail.com", "0097 22 654 00033"],
				["Sarah", "sarahcdd@gmail.com", "+322 876 1233"],
				["Afshin", "afshin@mail.com", "(353) 22 87 8356"],
			],
			pagination: {
				limit: 5
			},
			search: true,
			sort: true,
			style: {
				table: {
					'border': 'none'
				},
				th: {
					'background-color': '#fff',
					'border': 'none'
				},

			}
		}).render(document.getElementById("wrapper1"));

		new gridjs.Grid({
			columns: ["Name", "Email", "Phone Number"],
			data: [
				["John", "john@example.com", "(353) 01 222 3333"],
				["Mark", "mark@gmail.com", "(01) 22 888 4444"],
				["Eoin", "eoin@gmail.com", "0097 22 654 00033"],
				["Sarah", "sarahcdd@gmail.com", "+322 876 1233"],
				["Afshin", "afshin@mail.com", "(353) 22 87 8356"]
			],
			pagination: {
				limit: 5
			},
			search: true,
			sort: true,
			style: {
				table: {
					border: 'none',
				},
				th: {
					'background-color': '#fff',
					border: 'none',
				},

			}

		}).render(document.getElementById("wrapper2"));
	</script>
</body>

</html>