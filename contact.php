<?php 
ob_start();
include_once 'connect.php';

    ?>
<?php
        /// insert new contact ///
        $do=$_GET['do'];
        if(($do=='insert') && ($_SERVER['REQUEST_METHOD']=='POST')){
                    $username=$_POST['username'];
                    $email=$_POST['email'];
                    $message=$_POST['message'];
                if(isset($username)){
                    $filteruser=filter_var($_POST['username'],FILTER_SANITIZE_STRING);
                }
                if(isset($email)){
                    $filteremail=filter_var($email,FILTER_SANITIZE_STRING);
                        if(filter_var($filteremail,FILTER_VALIDATE_EMAIL) != true){
                            $Errors='<div class="alert alert-info">This Email Is Not Valide</div>';
                        }
                }
                if(isset($message)){
                    $filtermessage=filter_var($message,FILTER_SANITIZE_STRING);
                }
                
                if(empty($Errors)){
                        //insert to database with this info
                    $stmt=$con->prepare("INSERT INTO contact ( Username,Email,Message,Date ) VALUES(:zuser,:zemail,:zmessage,now() )");
                    $stmt->execute(array(
                        'zuser' => $filteruser,
                        'zemail' =>$filteremail,
                        'zmessage' =>$filtermessage,
                    ));
                        echo '<div class="alert alert-success text-center">Thencks for your submition</div>';
                    }else{
                        echo $Errors;
                    }
                }
ob_end_flush()
?>