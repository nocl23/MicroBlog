<?php
include ('includes/connexion.inc.php');

	if(isset($_GET['id']) && !empty($_GET['id'])){
		$query = 'DELETE FROM messages WHERE id=:id';
		$prep = $pdo->prepare($query);
		$prep->bindValue(':id',$_GET['id']);
		$prep->execute();

}
header('Location: index.php');
  exit();
?>
