<?php
include('includes/connexion.inc.php');

require_once('libs/Smarty.class.php');
$smarty = new Smarty();

// Vérification des informations de connexions entrées par l'utilisateur
if(isset($_POST['pseudo'])){
    $password = md5($_POST['password']);
    $pseudo=$_POST['pseudo'];
    $connecte = false;
    $query = "SELECT * from users where pseudo='$pseudo' and password='$password'";
    $prep = $pdo->prepare($query);
    $prep->execute();

// Si les données sont récupérées, connexion est un succès, création du cookie de connexion et mise à jour du cookie en BDD
    if ($prep->fetch()){
      $connecte=true;
      $sid = $pseudo.time();
      setcookie('sid',$sid,time() + 365);
      $update = "UPDATE users SET sid='$sid' where pseudo='$pseudo'";
      $prepare = $pdo->prepare($update);
      $prepare->execute();

      header("Location: index.php");
    }
}
$smarty->assign('connecte',$connecte);
$smarty->display('templates/connexion.html');


?>
<!--Block apparait seulement si un des deux ou les deux champs de connexion sont vides-->
