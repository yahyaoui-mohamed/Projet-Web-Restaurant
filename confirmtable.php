<?php 

include "connect.php";

$id = $_GET["id"];

$req = $connect->prepare("UPDATE reservetable SET table_confirme = 1 WHERE id = $id");
$req->execute();
header("location:admin.php?tab=reservetable");

?>