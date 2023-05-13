<?php
ob_start();
session_start();
include 'include/init.php';
if(isset($_SESSION['admin'])){
    $checks=$con->prepare("SELECT Admin_index FROM admins Where User_id={$_SESSION['admin_id']}");
    $checks->execute();
    $check=$checks->fetch();
    if($check['Admin_index']==1){
    ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../bootstrap-4.0.0/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="css/style.css">
            <title>Update Site</title>
        </head>
        <body>
        <?php  
          include 'include/navbar.php' ;  
        if(($_GET['do']=='Edit') && ($_SERVER['REQUEST_METHOD']=='POST')){
            if(isset($_POST['submit'])){
                $name=$_POST['name'];
                $title=$_POST['title'];
                $description=$_POST['description'];
                $tags=$_POST['tags'];
                $formErrors=array();
                if( empty($name) || empty($title) || empty($description) || empty($tags)  ){
                    $formErrors[]= ' Cant Be any facking filed  <strong> Empty</strong> ';
                }
                if(empty($formErrors)){
                    //update to database with this info
                $stmt=$con->prepare("UPDATE  settings SET  Site_name=? ,Site_title=?,Site_description=?,Site_keyword=? WHERE Id=1");                    
                $stmt->execute(array(
                $name,
                $title,
                $description,
                $tags,
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
        }
                    $site_id=$_GET['id'];
                    $settings=$con->prepare(" SELECT * from settings where Id={$site_id}" ); 
                    $settings->execute();
                    $setting=$settings->fetch();       
        ?>
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                    <h2 class="text-center">Update Setting</h2>
                    <hr>
                        <div class="add-post">
                            <form action="?do=Edit" method="post"  enctype="multipart/form-data">
                                <input class="form-control" name="name" type="text" value="<?php echo $setting["Site_name"] ; ?>" placeholder="Enter your site name ">
                                <input class="form-control" name="title" type="text" value="<?php  echo $setting["Site_title"] ; ?>" placeholder=" Enter your site title">
                                <input class="form-control" name="description" type="text" value="<?php  echo $setting["Site_description"] ; ?>" placeholder=" Enter your site description">
                                <input class="form-control" name="tags" type="text" value="<?php  echo $setting["Site_keyword"] ; ?>" placeholder=" Enter your site keyword">
                                <br>
                                <button class="btn btn-success form-control" name="submit" type="submit">Save</button>                        
                            </form>
                        </div>
                        <hr>
                    </div>        
                </div>
            </div>
            <script src="js/jquery-3.4.1.min.js"></script>
            <script src="js/popper.min.js"></script>
            <script src="../bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>   
            <script src="js/script.js"></script>
        </body>
        </html>
    <?php
    }else{  echo 'You have not parmition to access this page'; }
}else{
    header('location:login.php');
}
ob_end_flush(); ?>