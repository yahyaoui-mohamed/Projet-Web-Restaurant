<?php

include "connect.php";
$id = $_GET["id"];
$req = $connect->prepare("DELETE FROM users WHERE id = '$id'");
$req->execute();
header("location:admin.php?tab=utilisateur");
