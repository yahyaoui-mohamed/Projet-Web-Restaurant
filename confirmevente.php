<?php 

include "connect.php";
$user    = $_GET["userid"];
$food    = $_GET["food_id"];
$commande = $_GET["commandeid"];
$req  = $connect->prepare("INSERT INTO ventes VALUES('','$user','$food')");
$req1 = $connect->prepare("DELETE FROM commande WHERE commande_id = $commande");
$req->execute();
$req1->execute();
header("location:admin.php?tab=commande");
?>