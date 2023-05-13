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
        <title>Setting</title>
    </head>
    <body>
    <?php $settings=getallfrom('*','settings',"",'','Id','asc' ); 
    include_once 'include/navbar.php';
    ?> 
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                <h2 class="text-center">Table  site settings</h2>
                    <table class="table table-dark  table-hover table-bordered ">
                        <thead>
                        <tr class="title">
                            <th>#ID</th> <th>SITE NAME</th> <th>SITE TITLE</th><th>SITE DESCRIPTION</th> <th>SITE KEYWORD</th> <th>VISITS</th> <th>OPTION</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($settings as $setting){  ?>                       
                            <tr>
                                <td> <?php echo  $setting["Id"]; ?></td>
                                <td> <?php echo  $setting["Site_name"]; ?></td>
                                <td> <?php echo  $setting["Site_title"]; ?></td>
                                <td> <?php echo  $setting["Site_description"]; ?></td>
                                <td> <?php echo   $setting["Site_keyword"]; ?></td>
                                <td> <?php echo   $setting["Visits"]; ?></td>
                                <td class="text-right">
                                    <a href="update_site.php?do=Edit&id=<?php echo $setting["Id"]; ?>"><button class="btn btn-primary badge-pill">Edit</button></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>                  
                    </table>
                </div>         
            </div>
        </div>
        <script src="js/jquery-3.4.1.min.js "></script>
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