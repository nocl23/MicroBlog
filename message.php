<?php
include ('includes/connexion.inc.php');

$id = $_POST['id'];
$message = $_POST['message'];

if (isset($message) && !empty($message)) {
	if(isset($id) && !empty($id)){
		$query = 'UPDATE messages SET contenu=:contenu WHERE id=:id';
		$prep = $pdo->prepare($query);
		$prep->bindValue(':contenu', $message);
		$prep->bindValue(':id',$id);
	$prep->execute();


}else{
	$query = 'INSERT INTO messages (contenu) VALUES (:contenu)';
	$prep = $pdo->prepare($query);
	$prep->bindValue(':contenu', $message);
	$prep->execute();

	}

}
header('Location: index.php');
  exit();
?>
