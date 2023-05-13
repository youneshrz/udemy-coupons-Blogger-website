<?php 
ob_start();
session_start();
if(isset($_SESSION['admin'])){
  include 'include/init.php';
  ?>
  <link rel="stylesheet" href="../bootstrap-4.0.0/dist/css/bootstrap.min.css">
  <?php
  $do=$_GET['do'];
  if(($do=='Insert') && ($_SERVER['REQUEST_METHOD']=='POST')){
      $title=$_POST["title"];
      $description=$_POST["description"];
      $catname=$_POST["catname"];
      $link=$_POST["link"];
      $image=$_FILES['image']['name'];
      $img1_tmp=$_FILES['image']['tmp_name'];
      $date=$_POST["date"];
      $discount=$_POST['discount'];
      $price=$_POST['price'];
      $editor=$_POST["editor"];
      $tags=$_POST['tags'];
      $formErrors=array();
        if(empty($title) || empty($description) || empty( $catname ) || empty( $link) || empty( $image) || empty($editor)){
            $formErrors[]= ' Cant Be any facking filed  <strong> Empty</strong> ';
        }
      $check=checkitem("Link","posts",$link);
          if($check== 1){
              $formErrors[]='<div class="alert alert-danger"> sorry this posts is exist </div>';
          }
            if(empty($formErrors)){
                $image=rand(0,10000000000).'_'.$image;
                move_uploaded_file($img1_tmp,"image\\".$image);
                        //insert to database with this info
                $stmt=$con->prepare("INSERT INTO posts ( Post_title ,Description,Article,Link,Image,Time_end,Price,Discount,Approve,Catid,Date,tags)
                VALUES(:zname,:zdesc,:zarticle,:zlink,:zimg1,:ztime_end,:zprice,:zdiscount,0,:zcatname,now(),:ztags )");
                $stmt->execute(array(
                'zname' => $title,
                'zdesc' =>$description,
                'zarticle' =>$editor,
                'zlink' => $link,
                'zimg1'=> $image,
                'ztime_end' =>$date,
                'zprice' =>$price,
                'zdiscount' =>$discount,
                'zcatname'=>$catname,
                'ztags'=>$tags
                ));
              $theMsg= "<div class='alert alert-success'>Record Inserted</div>";
              redirectHome($theMsg,'back','2');
            }      
            $url=isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !==''? $url= $_SERVER['HTTP_REFERER']:'index.php';
            foreach($formErrors as $errors){
                echo '<div class="alert alert-danger">'.$errors.'</div>';
            }
            echo "<div class='alert alert-info'> you will redirected to $url after 3 seconds .</div>";
            header("refresh:3;url=$url");
            exit();   
  }
  if(($do=='Edit') && ($_SERVER['REQUEST_METHOD']=='POST')){
    $title=$_POST["title"];
    $postid=$_POST["postid"];
    $description=$_POST["description"];
    $catname=$_POST["catname"];
    $link=$_POST["link"];
    $image=$_FILES['image']['name'];
    $img1_tmp=$_FILES['image']['tmp_name'];
    $date=$_POST["date"];
    //$discount=$_POST['discount'];
    //$price=$_POST['price'];
    $editor=$_POST["editor"];
    $tags=$_POST['tags'];
    $formErrors=array();
    
    if(empty($_FILES['image']['tmp_name'])){       
    }else{
      $image=$_FILES['image']['name'];
      $img1_tmp=$_FILES['image']['tmp_name'];
        $img1=rand(0,10000000000).'_'.$image;
        move_uploaded_file($img1_tmp,"image\\".$img1);
        $stmt=$con->prepare("UPDATE  posts SET Image=$img1 WHERE Post_id==$postid ");
        $stmt->execute();
      }
    if(empty($date)){  
    }else{
      $stmt=$con->prepare("UPDATE  posts SET Time_end=$date WHERE Post_id==$postid ");
        $stmt->execute();
    }
      if(empty($title) || empty($description) || empty( $catname )|| empty( $link) || empty($postid) || empty($editor)){
        $formErrors[]= ' Cant Be any facking filed  <strong> Empty</strong></div> ';
      }
    if(empty($formErrors)){
              //update to database with this info
        $stmt=$con->prepare("UPDATE  posts SET  Post_title=? ,Description=?,Article=?,Link=?,Catid=?,tags=? WHERE Post_id=$postid");
        
        $stmt->execute(array(
          $title,
        $description,
        $editor,
        $link,
        $catname,
        $tags
        ));
          $theMsg= "<div class='alert alert-success'>Record Updated</div>";
          redirectHome($theMsg,'back','2');
    }
    $url=isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !==''? $url= $_SERVER['HTTP_REFERER']:'index.php';
    foreach($formErrors as $errors){
        echo '<div class="alert alert-danger">'.$errors.'</div>';
    }
    echo "<div class='alert alert-info'> you will redirected to $url after 3 seconds .</div>";
    header("refresh:3;url=$url");
    exit();
  }
  if(($do=='Delete') && ($_SERVER['REQUEST_METHOD']=='GET')){
    $postid=isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    $stmt = $con->prepare("SELECT * FROM posts WHERE Post_id= :memid LIMIT 1"); 
    $stmt->bindParam(':memid', $postid);
    $stmt->execute(); 
    $record = $stmt->fetch();
   //get image path
    $imageUrl = 'images//'.$record['Image'];
   //check if image exists
    if(file_exists($imageUrl)){
     //delete the image
      unlink($imageUrl);
    $stmt=$con->prepare('DELETE FROM posts WHERE Post_id=:zid ' );
    $stmt->bindParam(':zid',$postid );
    $stmt->execute();
    }
  }
  if(($do=='Approve') && ($_SERVER['REQUEST_METHOD']=='GET')){

    $postid=isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    $status=$con->prepare(" SELECT * from posts where Post_id={$postid}");
    $status->execute();
    $status=$status->fetch();
    if($status['Approve']== 0){
          $stmt=$con->prepare('UPDATE posts SET Approve=1 WHERE Post_id=:zitem');
          $stmt->bindParam(':zitem',$postid);
          $stmt->execute();
    }elseif($status['Approve']== 1){
      $stmt=$con->prepare('UPDATE posts SET Approve=0 WHERE Post_id=:zitem');
          $stmt->bindParam(':zitem',$postid);
          $stmt->execute();
    }
  }
  ?>
      <script src="js/jquery-3.4.1.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="../bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
  <?php
}else{ header('location:login.php') ;}
ob_end_flush();
?>