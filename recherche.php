<?php

$recherche = $_POST['search'];

$query = 'SELECT * , messages.id as message_id FROM messages INNER JOIN users ON messages.user_id = users.id ORDER BY messages.date';
$stmt = $pdo->prepare($query);
$stmt->execute();



 ?>
