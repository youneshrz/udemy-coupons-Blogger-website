<?php 
ob_start();
session_start();
if(isset($_SESSION['admin'])){
    include 'include/init.php';
  if(($do=='Delete') && ($_SERVER['REQUEST_METHOD']=='GET')){
    $article_id=isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    $stmt=$con->prepare('DELETE FROM contact WHERE Contact_id=:zid ' );
    $stmt->bindParam(':zid',$article_id );
    $stmt->execute();
  }
}else{ header('location:login.php') ;}
ob_end_flush();
?>