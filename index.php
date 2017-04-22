<?php
include('includes/connexion.inc.php');

require_once('libs/Smarty.class.php');
$smarty = new Smarty();

$search_bool = false;
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

//Pagination
$index = 0;
$mpp = 4;
$page = 1;

if(isset($_GET['p']) && !empty($_GET['p'])){
  $page = $_GET['p'];
  $index = ($page - 1)* $mpp;
}

// Recherche des messages contenant le mot
if(isset($_GET['search']) && !empty($_GET['search'])){
  $search_bool = true;
  $recherche = $_GET['search'];
  $query = 'SELECT * , messages.id as message_id
  FROM messages INNER JOIN users
  ON messages.user_id = users.id
  WHERE contenu LIKE "%'.$recherche.'%" ORDER BY messages.date';

}else if($search_bool == false){
  $query = 'SELECT * , messages.id as message_id FROM messages INNER JOIN users ON messages.user_id = users.id ORDER BY messages.date DESC LIMIT '.$index.','.$mpp.'';
}
$stmt = $pdo->prepare($query);
$stmt->execute();

$res = array();


foreach ($stmt as $msg) {

  //hastags
  if(preg_match_all("/#(\w+)$/",$msg["contenu"],$hashtag,PREG_SET_ORDER)){
    foreach ($hashtag as $value) {
      $link = "<a href='?search=".$value[1]."'>".$value[0]."</a>";
      $msg["contenu"] = preg_replace("/".$value[0]."/", $link, $msg["contenu"]);
    }
  }

  // site web
  /*  if(preg_match_all("/(http(s)?:\/\/)?([\w-]+\.)+[\w-]+(\/[\w- ;,.\/?%&=]*)?/",$msg["contenu"],$website,PREG_SET_ORDER)){
      foreach ($website as $value) {
        $link = "<a href='".$value[0]."'>".$value[0]."</a>";
        $msg["contenu"] = preg_replace("'".$value[0]."'",$link,$msg["contenu"]);
      }
    }*/

    //mail
    if(preg_match_all("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/",$msg["contenu"],$email,PREG_SET_ORDER)){
      foreach ($email as $value) {
        $link = "<a href='mailto:".$value[0]."'>".$value[0]."</a>";
        $msg["contenu"] = preg_replace("/".$value[0]."/",$link,$msg["contenu"]);
      }
    }


  $mess = array(
    "contenu" => $msg["contenu"],
    "date" => $msg["date"],
    "user_id" => $msg["user_id"],
    "pseudo" => $msg["pseudo"],
    "message_id" => $msg["message_id"],
    "votes" => $msg["votes"]
  );

  array_push($res,$mess);
}

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

$smarty->assign('id',$id);
$smarty->assign('connecte',$connecte);
$smarty->assign('message',$message);
$smarty->assign('res',$res);
$smarty->assign('page',$page);
$smarty->assign('mpp',$mpp);
$smarty->assign('nombre_message',$nombre_message);
$smarty->assign('i',1);
$smarty->assign('nb_pages',$nb_pages);
$smarty->assign('next',$next);
$smarty->assign('previous',$previous);
$smarty->assign('search',$search_bool);



$smarty->display('templates/index.html');
