<?php
include('includes/connexion.inc.php');
include('includes/haut.inc.php');


if(isset($_GET['id']) && !empty($_GET['id'])){
  $id = $_GET['id'];
  $sql = 'SELECT contenu from messages where id='.$id.'';
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
	?>
	<blockquote>
		<?= $data['contenu'] ?>
    <div class="col-sm-2">
        <?php echo "<a href='index.php?id=" .$data['id']. "'><button type='button' class='btn btn-success'>Modifier</button></a>" ?>

    </div>
	</blockquote>
	<?php
}
?>

<?php include('includes/bas.inc.php'); ?>
