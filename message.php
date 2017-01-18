<?php
include ('includes/connexion.inc.php');

// Récupérer l'id de l'utilisateur qui a publié un message pour l'associer à son message en BDD
$id = $_POST['id'];
$message = $_POST['message'];

$query = "SELECT id FROM users WHERE sid='$_COOKIE[sid]'";
$prepare = $pdo->prepare($query);
$prepare->execute();
$data = $prepare->fetch();
$user_id = $data['id'];

// Modification en BDD d'un message
if (isset($message) && !empty($message)) {
	if(isset($id) && !empty($id)){
		$query = 'UPDATE messages SET contenu=:contenu WHERE id=:id';
		$prep = $pdo->prepare($query);
		$prep->bindValue(':contenu', $message);
		$prep->bindValue(':id',$id);
		$prep->execute();

// Si on ne reconnait pas d'id de message > pas de message > nouveau message à insérer en BDD
	}else{
		$query = 'INSERT INTO messages (contenu,user_id) VALUES (:contenu,:user_id)';
		$prep = $pdo->prepare($query);
		$prep->bindValue(':contenu', $message);
		$prep->bindValue(':user_id', $user_id);
		$prep->execute();

	}
}

header('Location: index.php');
  exit();
?>
