<?php
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

            <title>Admins</title>
        </head>
        <body>
        <?php $admins=getallfrom('*','admins',"",'','User_id','asc' );
            include_once 'include/navbar.php';
        ?>
        <div class="container">
                <div class="row"> 
                    <div class="col-sm-12">
                    <h2 class="text-center">Table  Admins</h2>
                    <a href="add_admin.php" class="btn btn-warning float-right">New Admin</a>
                        <table class="table table-dark  table-hover table-bordered ">
                            <thead>
                            <tr class="title">
                                <th>#ID</th> <th>USERNAME</th> <th>PASSWORD</th><th>EMAIL</th><th>OPTION</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach($admins as $admin){  ?>
                                
                                <tr class="Delete<?php echo  $admin["User_id"];  ?>">
                                    <td> <?php echo  $admin["User_id"]; ?></td>
                                    <td> <?php echo  $admin["Username"] ?></td>                          
                                    <td> <?php echo  $admin["Password"] ?></td> 
                                    <td> <?php echo  $admin["Email"] ?></td>                         
                                    <!--<td> <img style="width:50px;display:non" class='img-responsive' src="<?php //echo 'image/'.$admin['Image'].''; ?>" /></td>  -->                        
                                    <td class="text-right">
                                        <a href="add_admin.php?do=Edite&id=<?php echo  $admin["User_id"]  ?>"><button class="btn btn-primary badge-pill">Edit</button></a>
                                        <a ><button  href="admin_option.php?do=Delete" data-id="<?php echo  $admin["User_id"]?>" class="btn btn-danger badge-pill delete">Delete</button></a>
                                    </td>                      
                                </tr>
                                <?php } ?>
                            </tbody>
                            
                        </table>
                    </div>       
                </div>
            </div>

            <script src="js/jquery-3.4.1.min.js "></script>
            <!--<script src="js/jquery-3.2.1.slim.min.js"></script> -->
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