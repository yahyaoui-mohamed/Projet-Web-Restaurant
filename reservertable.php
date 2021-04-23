<?php 

include "connect.php";

$nom = $_GET["nom"];
$prenom = $_GET["prenom"];
$tel = $_GET["tel"];
$nbr = $_GET["nbr"];
$date = $_GET["date"];

$query = mysqli_query($conn, "INSERT INTO reservetable values('','$nom','$prenom','$tel','$nbr','$date')");

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
"

?>


