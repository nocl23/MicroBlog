<?php

include('includes/connexion.inc.php');

require_once('libs/Smarty.class.php');
$smarty = new Smarty();

// Si les variables sont définies et remplies, l'utilisateur peur s'inscrire
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['pseudo']) && isset($_POST['prenom']) && isset($_POST['nom'])
  && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['pseudo']) && !empty($_POST['prenom']) && !empty($_POST['nom'])){
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $pseudo = $_POST['pseudo'];


  $query = 'INSERT INTO users (nom,prenom,email,password,pseudo)
            VALUES (:nom,:prenom,:email,:password,:pseudo)';

  $prep = $pdo->prepare($query);
  $prep->bindValue(':email', $email);
  $prep->bindValue(':password', md5($password));
  $prep->bindValue(':pseudo', $pseudo);
  $prep->bindValue(':nom', $nom);
  $prep->bindValue(':prenom', $prenom);
  $prep->execute();

  header('Location: index.php');

  }

  $smarty->display('templates/inscription.html');

?>

<!--Formulaire d'inscription Bootstrap -->
