<?php
session_start();
include "connect.php";
if (isset($_SESSION["user"])) {
  $email = $_SESSION["user"];
  $query = $connect->prepare("SELECT * FROM users WHERE email = '$email'");
  $query->execute();
  $id = $query->fetch()[0];
  $query = $connect->prepare("SELECT food_id FROM commande WHERE user_id = '$id' AND commande_payed = 0");
  $query->execute();
  $count = 0;
  $row_count = $query->rowCount();
  if ($row_count > 0) {
    $row = $query->fetch()[0];
    if (is_array(json_decode($row, true))) {
      $count = count(json_decode($row, true));
    } else {
      $count = 1;
    }
  }
  echo $count;
} else {
  echo "0";
}
