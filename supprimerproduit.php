<?php 
include "connect.php";
$id = $_POST['id'];
$query = $connect->prepare("DELETE FROM food WHERE food_id = $id");
$query->execute();
header("location:admin.php?tab=produit");
?>