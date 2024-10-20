<?php
session_start();
include "connect.php";
$foodid =  json_encode($_GET["foodid"]);
$email = $_SESSION["user"];

$query = $connect->prepare("SELECT * FROM users WHERE email = '$email'");
$query->execute();

$id = $query->fetch()[0];

$query = $connect->prepare("SELECT * FROM commande WHERE user_id = $id AND commande_payed = 0");
$query->execute();

if ($query->rowCount() > 0) {

  $query = $connect->prepare("UPDATE commande SET food_id = JSON_ARRAY_APPEND(food_id, '$', $foodid)");
  $query->execute();
} else {
  $query = $connect->prepare("INSERT INTO commande VALUES('','$foodid','$id','0','0')");
  $query->execute();
}

$req = $connect->prepare("INSERT INTO notifications VALUES('','Une nouvelle commande','Veuillez confirmer la nouvelle commande',0)");
$req->execute();

$query1 = $connect->prepare("SELECT food_id FROM commande WHERE user_id = '$id' AND commande_payed = 0");
$query1->execute();
$count = 0;
$rowCount = $query1->rowCount();
if ($rowCount > 0) {
  $row = $query1->fetch()[0];
  if (is_array(json_decode($row, true))) {
    $count = count(json_decode($row, true));
  } else {
    $count = 1;
  }
}
echo $count;
