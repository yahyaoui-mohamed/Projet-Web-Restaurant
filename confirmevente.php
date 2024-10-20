<?php

include "connect.php";
$user    = $_GET["userid"];
$commande = $_GET["commandeid"];
// $req  = $connect->prepare("INSERT INTO ventes VALUES('','$user','$food')");
$req1 = $connect->prepare("UPDATE commande SET commande_confirm = 1 WHERE commande_id = $commande");
$req1->execute();
// $req->execute();
header("location:admin.php?tab=commande");
