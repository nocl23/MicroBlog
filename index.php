<?php
include('includes/connexion.inc.php');
include('includes/haut.inc.php');


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

// Pagination
$index = 0;
$mpp = 4;
if(isset($_GET['p']) && !empty($_GET['p'])){
  $index = $_GET['p'];
  $index = ($index - 1)* $mpp;
}
$query = 'SELECT * FROM messages LIMIT '.$index.','.$mpp.'';
echo $query;
//$query = 'SELECT * FROM messages';
$stmt = $pdo->query($query);

while ($data = $stmt->fetch()) {
  if($connecte == true){
  	?>
  	<blockquote>
  		<?= $data['contenu'] ?>
      <div class="col-sm-2">
          <?php echo "<a href='index.php?id=" .$data['id']."&p=".$page."'><button type='button' class='btn btn-warning'>Modifier</button></a>" ?>
      </div>
      <div class="col-sm-2">
          <?php echo "<a href='suppression.php?id=" .$data['id']."&p=".$page."'><button type='button' class='btn btn-danger'>Supprimer</button></a>" ?>
      </div>
      <div class="col-sm-12">
          <?= "Ajouté le ".$data['date'] ?>
        </div>
  	</blockquote>
    <?php
  }else{
    ?>
    <blockquote>
      <?= $data['contenu'] ?>
      <div class="col-sm-2">
          <?php echo "<a href='index.php?id=" .$data['id']. "'></a>" ?>
      </div>
      <div class="col-sm-2">
          <?php echo "<a href='suppression.php?id=" .$data['id']. "'></a>" ?>
      </div>
      <div class="col-sm-12">
          <?= "Ajouté le ".$data['date'] ?>
        </div>
    </blockquote>
    <?php
  }
}
?>
<?php

$requete = 'SELECT COUNT(*) as total_messages FROM messages';
$prep = $pdo->query($requete);
$data = $prep->fetch();
$nombre_message = $data['total_messages'];

$nb_pages = ($nombre_message) ? ceil($nombre_message/$mpp) : 1;


?>
<nav aria-label="Page navigation">
  <ul class="pagination">
    <li>
      <a href="#" aria-label="Previous">
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
      <a href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>

 <?php include('includes/bas.inc.php'); ?>
