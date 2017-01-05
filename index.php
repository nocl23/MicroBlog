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
$query = 'SELECT * FROM messages';
$stmt = $pdo->query($query);

while ($data = $stmt->fetch()) {
  if($connecte == true){
  	?>
  	<blockquote>
  		<?= $data['contenu'] ?>
      <div class="col-sm-2">
          <?php echo "<a href='index.php?id=" .$data['id']. "'><button type='button' class='btn btn-warning'>Modifier</button></a>" ?>
      </div>
      <div class="col-sm-2">
          <?php echo "<a href='suppression.php?id=" .$data['id']. "'><button type='button' class='btn btn-danger'>Supprimer</button></a>" ?>
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
 include('includes/bas.inc.php'); ?>
