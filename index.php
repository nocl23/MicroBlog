<?php
include('includes/connexion.inc.php');
include('includes/haut.inc.php');


if(isset($_GET['id']) && !empty($_GET['id'])){
  $id = $_GET['id'];
  $sql = 'SELECT contenu from messages where id='.$id.'';
  $requete = $pdo->query($sql);
  $message = $requete->fetch();
  }
?>


<div class="row">
    <form method="post" action="message.php">
        <div class="col-sm-10">
            <div class="form-group">
                <textarea id="message" name="message" class="form-control" placeholder="Message">
                  <?php echo $message['contenu']?>
                </textarea>
                <input type="hidden" name="id" value="<?php $id ?>"/>
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
	?>
	<blockquote>
		<?= $data['contenu'] ?>
    <div class="col-sm-2">
        <a href="index.php?id=<?= $data['id'] ?>" >
          <button type="submit" class="btn btn-warning btn-lg">Modifier</button>
        </a>
    </div>
	</blockquote>
	<?php
}
?>

<?php include('includes/bas.inc.php'); ?>
