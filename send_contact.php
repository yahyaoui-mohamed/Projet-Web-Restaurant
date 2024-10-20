<?php

include "connect.php";
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$email = $_POST["email"];
$sujet = $_POST["sujet"];
$message = $_POST["message"];

$query = $connect->prepare("INSERT INTO contact  values('','$nom','$prenom','$email','$sujet','$message')");
$query->execute();
