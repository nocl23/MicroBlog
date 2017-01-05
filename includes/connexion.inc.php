<?php
$pdo = new PDO('mysql:host=localhost;dbname=micro_blog', 'root', 'root', $arrExtraParam);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$connecte = false;

if(isset($_COOKIE[sid])){
  $query = "SELECT * FROM users where sid='$_COOKIE[sid]'";
  $prepare = $pdo->prepare($query);
  $prepare->execute();

  if($prepare ->fetch()){
    $connecte = true;
  }
}
