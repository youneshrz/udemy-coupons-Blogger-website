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
        <link rel="stylesheet" href="../bootstrap-4.0.0/dist/css/bootstrap.min.css">
        <?php
        /// insert new category ///
        $do=$_GET['do'];
        if(($do=='insert') && ($_SERVER['REQUEST_METHOD']=='POST')){
            if(isset($_POST['submit'])){
                    $username=$_POST['username'];
                    $email=$_POST['email'];
                    $password=$_POST['password'];
                    $formErrors=array();
                if(isset($username)){
                    $filteruser=filter_var($_POST['username'],FILTER_SANITIZE_STRING);
                    if(strlen($filteruser)< 5){
                            $formErrors[]='<span>Username cant be less then 5 character</span>';
                    }
                }
                if(isset($password)){
                    if(empty($password)){
                        $formErrors[]='<span>Sorry Passwored Cant Be Empty</span>';
                    }
                }
                if(isset($email)){
                    $filteremail=filter_var($email,FILTER_SANITIZE_STRING);
                        if(filter_var($filteremail,FILTER_VALIDATE_EMAIL) != true){
                            $formErrors[]='<span>This Email Is Not Valide</span> ';
                        }
                }
                //check if there is no error proceed the user add
                if(empty($formErrors)){
                    //check if user exist in database
                    $check=checkitem("Username","admins",$username);
                    if($check == 1){
                        $formErrors[]= '<span> Sorry This Username Is Exist </span>';                   
                    }else{
                        //insert to database with this info
                    $stmt=$con->prepare("INSERT INTO admins ( Username,Password,Email ) VALUES(:zuser,:zpass,:zemail )");
                    $stmt->execute(array(
                        'zuser' => $username,
                        'zpass' =>$password,
                        'zemail' =>$email,
                    ));
                    //echo succsess massage
                    $theMsg="<div class='alert alert-success'>Congrats you are now registed admin </div> ";   
                    redirectHome($theMsg,'back','2'); 
                    }
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
        if(($do=='Delete') && ($_SERVER['REQUEST_METHOD']='POST')){
            $catid=isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
                $stmt=$con->prepare('DELETE FROM admins WHERE User_id=:zid ' );
                $stmt->bindParam(':zid',$catid );
                $stmt->execute();
        }
        if(($do=='Edit') && ($_SERVER['REQUEST_METHOD']='POST')){
            $admin_id=isset($_POST['admin_id']) && is_numeric($_POST['admin_id']) ? intval($_POST['admin_id']) : 0;   
            if(isset($_POST['submit'])){
                $username=$_POST['username'];
                $email=$_POST['email'];
                $password=$_POST['password'];
                $admin_index=$_POST['admin_index'];
                $formErrors=array();
            if(isset($username)){
                $filteruser=filter_var($_POST['username'],FILTER_SANITIZE_STRING);
                if(strlen($filteruser)< 5){
                        $formErrors[]='<span>Username cant be less then 5 character</span>';
                }
            }
            if(isset($password)){
                if(empty($password)){
                    $formErrors[]='<span>Sorry Passwored Cant Be Empty</span>';
                }
            }
            if(isset($admin_index)){
                if(empty($admin_index)){
                    $formErrors[]='<span>Sorry admin index Cant Be Empty</span>';
                }
            }
            if(isset($email)){
                $filteremail=filter_var($email,FILTER_SANITIZE_STRING);
                    if(filter_var($filteremail,FILTER_VALIDATE_EMAIL) != true){
                        $formErrors[]='<span>This Email Is Not Valide</span> ';
                    }
            }
            //check if there is no error proceed the user add
            if(empty($formErrors)){
                //check if user exist in database
                $statement= $con->prepare("SELECT Username FROM admins WHERE Username= ? and User_id != ?");
                $statement->execute(array($username,$admin_id));
                $count = $statement->rowCount();
                if($count == 1){
                    $formErrors[]= '<span> Sorry This Username Is Exist </span>';                   
                }else{
                    //update the database with this info
                    $stmt=$con->prepare("UPDATE admins SET  Username =?,Password=?,Email=?,Admin_index=?   WHERE User_id=? ");
                    $stmt->execute(array($username,$password,$email,$admin_index,$admin_id));
                    //echo succsess massage
                    $theMsg= '<div class="alert alert-success">Recored Update</div>';  
                    redirectHome($theMsg,'back','20'); 
                }
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
        ?>
            <script src="js/jquery-3.4.1.min.js"></script>
            <script src="js/popper.min.js"></script>
            <script src="../bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
        <?php
    }else{  echo 'You have not parmition to access this page'; }
}else{
    header('location:login.php');
}
ob_end_flush();
?>