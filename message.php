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

/*if (isset($_POST['message']) && !empty($_POST['message'])) {
			if (isset($_POST['id']) && !empty($_POST['id'])) {
				$query = "UPDATE messages SET contenu = ? WHERE id = ?";
				$prep = $pdo->prepare($query);
				$prep->bindValue(1, $_POST['message']);
				$prep->bindValue(2, $_POST['id']);
			}else{
				$query = "INSERT INTO messages (contenu) VALUES (?)";
				$prep = $pdo->prepare($query);
				$prep->bindValue(1, $_POST['message']);
	}
	$prep->execute();
	*/
}



header('Location: index.php');
  exit();
?>
