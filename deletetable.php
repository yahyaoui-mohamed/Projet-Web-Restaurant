<?php

include "connect.php";
$id = $_GET["id"];
$req = $connect->prepare("DELETE FROM tables WHERE table_id = '$id'");
$req->execute();
header("location:admin.php?tab=table");
