<?php
$pdo = new PDO('mysql:host=localhost;dbname= ', ' ', ' ', $arrExtraParam);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//permet de savoir si un utilisateur est connecté

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
