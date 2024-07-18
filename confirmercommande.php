<?php 

include "connect.php";

$id = $_GET["commandeid"];
$req = $connect->prepare("UPDATE commande SET commande_confirm = 1 WHERE commande_id = '$id'");
$req->execute();
header("location:account.php?tab=commande");
?>