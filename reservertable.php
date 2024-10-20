<?php

include "connect.php";
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$tel = $_POST["tel"];
$nbr = $_POST["table"];
$date = $_POST["date"];

$query = $connect->prepare("SELECT * FROM reservetable WHERE date = '$date'");
$query->execute();
if ($query->rowCount() == 1) {
	echo "0";
} else if (strtotime($date) < strtotime(date("Y-m-d"))) {
	echo "-1";
} else {

	$query = $connect->prepare("SELECT table_quantity FROM tables WHERE table_size = $nbr");
	$query->execute();
	$count = $query->fetch()[0];
	if ($count == 0) {
		echo "Table is not available";
	} else {
		$query1 = $connect->prepare("INSERT INTO reservetable values('','$nom','$prenom','$tel','$nbr','$date','0')");
		$query1->execute();
		$req = $connect->prepare("INSERT INTO notifications VALUES('','Une nouvelle Réservation','Veuillez confirmer la nouvelle réservation',0)");
		$req->execute();





		$req1 = $connect->prepare("UPDATE tables SET table_quantity = table_quantity - 1 WHERE table_size = $nbr");
		$req1->execute();
		echo "
<div class=reussite>
	<h1>Reservation résussite !</h1>
	<div class=info>
		<div><span>Nom :</span> $nom</div>
		<div><span>Prenom :</span> $prenom</div>
		<div><span>Numéro de téléphone :</span> $tel</div>
		<div><span>Nombre de personne :</span> $nbr</div>
		<div><span>Date :</span> $date</div>
	</div>
</div>
";
	}
}
