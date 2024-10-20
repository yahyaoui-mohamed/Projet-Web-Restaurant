<?php

include "connect.php";
$id = $_GET["id"];
$req = $connect->prepare("DELETE FROM food WHERE food_id = '$id'");
$req->execute();
header("location:admin.php?tab=produit");
