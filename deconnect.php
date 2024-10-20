<?php

session_start();
$file = "./action.log";

$time = date('Y-m-d H:i:s');

if (isset($_SESSION["user"])) {
  $user = $_SESSION["user"];
} else {
  $user = $_SESSION["admin"];
}

$message = $user . " has logged out at " . $time . PHP_EOL;

file_put_contents($file, $message, FILE_APPEND | LOCK_EX);

session_unset();
session_destroy();
header("location:index.php");
