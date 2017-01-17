<?php
$pdo = new PDO('mysql:host=localhost;dbname=dbname', '', '', $arrExtraParam);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$connecte = false;

if(isset($_COOKIE['sid'])){
  $cookie = $_COOKIE['sid'];
  $query = "SELECT * FROM users where sid='$cookie'";
  $prepare = $pdo->prepare($query);
  $prepare->execute();

  if($prepare ->fetch()){
    $connecte = true;
  }
}
