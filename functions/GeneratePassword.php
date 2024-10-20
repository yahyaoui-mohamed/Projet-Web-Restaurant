<?php
function GeneratePassword()
{
  $length = 8;
  $upperCase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $lowerCase = 'abcdefghijklmnopqrstuvwxyz';
  $numbers = '0123456789';
  $specialChars = '!@#$%^&*()-_+=?';

  $allChars = $upperCase . $lowerCase . $numbers . $specialChars;

  $shuffledChars = str_shuffle($allChars);

  $password = '';

  for ($i = 0; $i < $length; $i++) {
    $password .= $shuffledChars[random_int(0, strlen($shuffledChars) - 1)];
  }

  return $password;
}
