<?php
// Cookie dépassé pour la déconnexion
setcookie('sid','',time()-1);

header("Location: index.php");

?>
