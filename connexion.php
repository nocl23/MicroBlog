<?php
include('includes/connexion.inc.php');
include('includes/haut.inc.php');

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

?>
<!--Block apparait seulement si un des deux ou les deux champs de connexion sont vides-->
<div class="alert alert-danger message_alert">
  <strong>Attention!</strong> Veuillez compléter les deux champs pour vous connecter!
</div>

<!--Formulaire de connexion -->
<form method="post" action="connexion.php" id="form">
  <div class="row">
    <div class="form-group col-sm-2">
      <label for="exampleInputPassword1">Pseudo</label>
      <input type="pseudo" name="pseudo" class="form-control" id="InputPseudo" placeholder="Pseudo">
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm-2">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" name="password" class="form-control" id="InputPassword" placeholder="Password">
    </div>
  </div>

  <button type="submit" class="btn btn-default">Submit</button>
</form>

<script type="text/javascript">
// Script qui vérifie si les deux champs de connexions sont complétés
var value = true;
  $(function(){
    $('#form').submit(function(){
      if(!($('#InputPseudo').val()) || !($('#InputPassword').val())){
        $('.message_alert').removeClass("message_alert");
        value = false;
      }else{
        value = true;
      }
    return value;
    })
  });
</script>
