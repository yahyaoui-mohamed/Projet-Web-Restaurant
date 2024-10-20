<?php 
include "connect.php";
$id = $_GET["commandeid"];
$req = $connect->prepare("DELETE FROM ventes WHERE id_vente = $id");
$req->execute();
header("location:admin.php?tab=annulercommande");
?>