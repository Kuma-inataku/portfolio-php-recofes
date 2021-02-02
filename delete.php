<?php 
session_start();
require('dbconnect.php');

if(isset($_SESSION['id'])){
  $id = $_REQUEST['id'];
  // 削除するreviewのidの特定
  $reviews = $db->prepare('SELECT * FROM reviews WHERE id=?');
  $reviews->execute(array($id));
  $review= $reviews->fetch();
  // DB上のreviewer_idと今SESION上のidが同じ場合、のみ削除できる
  if($review['reviewer_id'] == $_SESSION['id']){
    $del = $db->prepare('DELETE FROM reviews WHERE id=?');
    $del->execute(array($id)); 
  }

  header('Location: ./ranking/home.php');
  exit();
}
?>