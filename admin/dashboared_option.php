<?php 
ob_start();
session_start();
if(isset($_SESSION['admin'])){
    include 'include/init.php';
    if(($_SERVER['REQUEST_METHOD']=='POST')){
        $posts=isset($_POST['id']) ? $_POST['id'] : 0;
        foreach($posts as $post){
            $stmt=$con->prepare('DELETE FROM posts WHERE Post_id=:zid ' );
            $stmt->bindParam(':zid',$post );
            $stmt->execute();
        }
    }
}else{ header('location:login.php') ;}
ob_end_flush();
?>