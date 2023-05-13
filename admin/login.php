<?php 
ob_start();
session_start();
if(isset($_SESSION['admin'])){
    header('location:dashboared.php');
}else{
    include 'include/init.php';
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        if(isset($_POST['submit'])){
            $username=$_POST['username'];
            $password=$_POST['password'];
            $formErrors=array();
            $erruser=false;
            $errpassword=false;
            
            if(isset($username)){
                $filteruser=filter_var($_POST['username'],FILTER_SANITIZE_STRING);
                if(strlen($filteruser)< 5){
                    $erruser=true;
                    $formErrors[]='<span >Username cant be less then 5 characters</span>';
                }
            }
            if(isset($password)){
                if(empty($password)){
                    $formErrors[]='<span > Sorry Passwored Cant Be Empty</span>';
                    $errpassword=true;
                }
            }        
            //check if there is no error proceed the user add
            if(empty($formErrors)){       
                //check if user exist in database,
                $stmt=$con->prepare('SELECT   User_id,Username , Password FROM admins WHERE Username= ? AND Password= ? ');
                $stmt->execute(array($username,$password));
                $get=$stmt->fetch();
                $count= $stmt->rowCount();   
                //if count >0 thiis mean the database contain record about this username
                if($count>0){ 
                $_SESSION['admin']=$get['Username']; //register session name
                $_SESSION["admin_id"]=$get['User_id'];//register id of user login
                header('Location:dashboared.php');//redirect to dashborad page
                exit();
                }else{
                    $formErrors[]="<span > This Username Does Not Exist</span> ";
                }
            }                        
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../bootstrap-4.0.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">

        <title>Login</title>
    </head>
    <body>

        <div class="container">
            <div class="row">
                
                    <h1 class="title-login text-center">Login Admin</h1>
                    <div class="col-12">
                        <form action="" method="post" class="login-form block-center">
                            <?php 
                            //print the errors
                            if(!empty($formErrors)){
                                foreach($formErrors as $error){
                                    echo '<div class="alert alert-danger">'.$error.'</div> ';
                                }
                            }
                            ?>
                            <input type="text" name="username" placeholder="Username"><br>
                            <input type="password" name="password" placeholder="Password"><br>
                            <button type="submit" name="submit">Login</button>
                            <br><br><br>
                            <strong>Created By classfreecourses</strong>
                        </form>
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
}
ob_end_flush(); ?>