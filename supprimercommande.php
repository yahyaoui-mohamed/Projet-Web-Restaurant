<?php 

include "connect.php";

$id = $_GET["commandeid"];
$query = $connect->prepare("DELETE FROM commande WHERE commande_id = $id");
$query->execute();
header("location:account.php?tab=commande");

?>