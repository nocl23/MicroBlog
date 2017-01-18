<?php
include('includes/connexion.inc.php');
include('includes/haut.inc.php');


if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['pseudo']) ){
$email = $_POST['email'];
$password = $_POST['password'];
$pseudo = $_POST['pseudo'];

$query = 'INSERT INTO users (email,password,pseudo) VALUES (:email,:password,:pseudo)';
$prep = $pdo->prepare($query);
$prep->bindValue(':email', $email);
$prep->bindValue(':password', md5($password));
$prep->bindValue(':pseudo', $pseudo);
$prep->execute();

header('Location: index.php');
}

?>

<form method="post" action="inscription.php" id="form_inscription">
  <div class="row">
    <div class="form-group col-sm-2">
      <label for="InputPseudo">Pseudo</label>
      <input type="pseudo" name="pseudo" class="form-control" id="InputPseudo" placeholder="Pseudo">
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm-2">
      <label for="InputPseudo">Email</label>
      <input type="email" name="email" class="form-control" id="InputEmail" placeholder="Email">
    </div>
  </div>
<div class="row">
  <div class="form-group col-sm-2">
    <label for="InputPassword">Password</label>
    <input type="password" name="password" class="form-control" id="InputPassword" placeholder="Password">
  </div>
</div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
