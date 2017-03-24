<?php
$pdo = new PDO('mysql:host=localhost;dbname=micro_blog', 'root', 'root', $arrExtraParam);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

require('./libs/Smarty.class.php');
$smarty = new Smarty();

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

$smarty->assign('connecte',$connecte);
