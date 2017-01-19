<?php
include('includes/connexion.inc.php');
include('includes/haut.inc.php');

$message= "";
$id ="";
// affichage d'un message a modifier
if(isset($_GET['id']) && !empty($_GET['id'])){

  $id = $_GET['id'];
    $sql = 'SELECT * from messages where id='.$id.'';
    $requete = $pdo->query($sql);
    if ($data = $requete->fetch()) {
      $message =  $data['contenu'];
    }else{
      header("Location: index.php");
    }
}
// Seules les personnes connectées peuvent ajouter un message
if($connecte){
?>
<div class="row">
    <form method="post" action="message.php">
        <div class="col-sm-10">
            <div class="form-group">
                <textarea id="message" name="message" class="form-control" placeholder="Message">
                  <?php echo $message?>

                </textarea>
                <input type="hidden" name="id" value="<?php echo $id ?>"/>
            </div>
        </div>
        <div class="col-sm-2">
            <button type="submit" class="btn btn-success btn-lg">Envoyer</button>
        </div>
    </form>
</div>
<?php
}

// Pagination
$index = 0;
$mpp = 4;

if(isset($_GET['p']) && !empty($_GET['p'])){
  $page = $_GET['p'];
  $index = ($page - 1)* $mpp;
}
// Affichage de 4 messages par page
$query = 'SELECT * , messages.id as message_id FROM messages INNER JOIN users ON messages.user_id = users.id LIMIT '.$index.','.$mpp.'';
$stmt = $pdo->prepare($query);
$stmt->execute();

// Affichage des boutons modifications et suppressions si l'utilisateur est connecté
while ($data = $stmt->fetch()) {
  if($connecte){
  	?>
  	<blockquote class="col-md-12">
      <div class="col-md-8">
        <div>
          <?= $data['contenu'] ?>
        </div>
        <footer>
            <?= "Ajouté par ".$data['pseudo']. " le " .$data['date'] ?>
        </footer>
      </div>
      <div class="col-md-4">
        <div class="col-md-6">
            <?php echo "<a href='index.php?id=" .$data['message_id']."&p=".$page."'><button type='button' class='btn btn-warning'>Modifier</button></a>" ?>
        </div>
        <div class="col-md-6">
            <?php echo "<a href='suppression.php?id=" .$data['message_id']."&p=".$page."'><button type='button' class='btn btn-danger'>Supprimer</button></a>" ?>
        </div>
      </div>
  	</blockquote>
    <?php
  }else{
    ?>
    <blockquote>
      <div>
        <?= $data['contenu'] ?>
      </div>
      <footer>
          <?= "Ajouté par ".$data['pseudo']. " le " .$data['date'] ?>
      </footer>
    </blockquote>
    <?php
  }
}

// Calcul du nombre total de message pour déterminer le nombre de page pour l'affichage des messages
$requete = 'SELECT COUNT(*) as total_messages FROM messages';
$prep = $pdo->query($requete);
$data = $prep->fetch();
$nombre_message = $data['total_messages'];
$nb_pages = ($nombre_message) ? ceil($nombre_message/$mpp) : 1;

// Pagination avec les flêches
  if ($page > 1){
    $previous = $page - 1;
  }else{
    $previous = 1;
  }
  if($page < $nb_pages){
    $next = $page + 1;
  }else{
    $next = $page;
  }
?>
<!--Système de pagination Bootstrap-->
<nav aria-label="Page navigation">
  <ul class="pagination">
    <li>
      <a <?php echo "href='index.php?p=$previous'" ?> aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <?php for ($i=1; $i < $nb_pages+1; $i++) {
      ?>
    <li>  <?php echo "<a href='index.php?p=$i'>$i</a>" ?></li>
    <?php
    }
     ?>

    <li>
      <a <?php echo "href='index.php?p=$next'" ?> aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>

 <?php include('includes/bas.inc.php'); ?>
