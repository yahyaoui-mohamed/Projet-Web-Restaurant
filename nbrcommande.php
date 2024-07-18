<?php 
session_start();
include "connect.php";
$email = $_SESSION["user"];
$query = $connect->prepare("SELECT * FROM users WHERE email = '$email'");
$query->execute();
$id = $query->fetch()[0];
$query1 = $connect->prepare("SELECT * FROM commande WHERE user_id = '$id' AND commande_confirm = 0");
echo $query1->rowCount();
?>