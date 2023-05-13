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
            <title>Add admin</title>
        </head>
        <body>
        <?php
        include_once 'include/navbar.php';
        $do=isset($_GET['do'])? $_GET['do']:'0';
        if($do=='Edite'){    
                    $admin_id=$_GET['id'];
                    $admins=$con->prepare(" SELECT * from admins where User_id={$admin_id}" ); 
                    $admins->execute();
                    $admin=$admins->fetch();       
        }
        ?>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                    <h2 class="text-center"><?php if($do=='Edite'){ echo 'Edit' ;}else{ echo 'New' ;} ?>  Compte admin</h2>
                    <hr>
                        <div class="add-post">
                            <form action="<?php if($do=='Edite'){ echo 'admin_option.php?do=Edit';}else{ echo 'admin_option.php?do=insert' ;} ?> " method="post"  enctype="multipart/form-data">
                                <input class="form-control" name="username" type="text" value="<?php if($do=='Edite'){ echo $admin["Username"] ;} ?>" placeholder="Enter your username ">
                                <input class="form-control" name="email" type="text" value="<?php if($do=='Edite'){ echo $admin["Email"] ;} ?>" placeholder=" Enter email">
                                <input class="form-control" name="password" type="password" value="<?php if($do=='Edite'){ echo $admin["Password"] ;} ?>" placeholder=" Enter your password">
                                <?php if($do=='Edite'){ 
                                            echo '<input class="form-control" name="admin_index" type="text" value="'.$admin['Admin_index'].'" placeholder=" Enter your index">';
                                } ?>            
                                <input class="form-control" name="admin_id" type="hidden" value="<?php if($do=='Edite'){ echo $admin["User_id"] ;} ?>"> <br>
                                <button class="btn btn-success form-control" name="submit" type="submit">Save</button>
                                <br> <br>
                                <?php if($do=='Edite'){ 
                                            echo '<a href="add_admin.php" class="btn btn-primary form-control">Cancel</a>';
                                } ?> 
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