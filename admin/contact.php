<?php
session_start();
include 'include/init.php';
if(isset($_SESSION['admin'])){
    
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../bootstrap-4.0.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <title>Articles</title>
    </head>
    <body>
    <?php
    // $articles=getallfrom('*','articles',"",'','Article_id','asc' ); 
    include_once 'include/navbar.php';
     // pagination ========
$pageno =isset($_GET['pageno'])? $_GET['pageno']: '1';
$no_of_records_per_page = 5;
$start = ($pageno-1) * $no_of_records_per_page;
$articles=$con->prepare(" SELECT * from contact order by Contact_id desc  LIMIT  $start,$no_of_records_per_page ");
$articles->execute();
$articles=$articles->fetchAll(); 

 ////
//pagination=======
$nomber_total_recored=$con->prepare(" SELECT * from contact ");
$nomber_total_recored->execute();
$nomber_total_recored=$nomber_total_recored->rowCount();
$nomber_total_pages=ceil($nomber_total_recored/$no_of_records_per_page);
///fin pagination===============
///
    ?>
        
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                <h2 class="text-center">Table  contact</h2>
                    <table class="table table-dark  table-hover table-bordered ">
                        <thead>
                        <tr class="title">
                            <th>#ID</th> <th>USERNAME</th> <th>EMAIL</th><th>MESSAGE</th> <th>DATE</th> <th>OPTION</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($articles as $article){  ?>                       
                            <tr class="Delete<?php echo  $article["Contact_id"]; ?> ">
                                <td> <?php echo  $article["Contact_id"]; ?></td>
                                <td> <?php echo  substr($article["Username"],0,100); ?></td>
                                <td> <?php echo  $article["Email"]; ?></td>
                                <td> <?php echo   substr($article["Message"],0,100); ?></td>
                                <td> <?php echo   $article["Date"]; ?></td>
                                <td class="text-right">
                                <a ><button  href="contact_option.php?do=Delete" data-id="<?php echo  $article["Contact_id"]?>" class="btn btn-danger badge-pill delete">Delete</button></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>                  
                    </table>
                </div>
                <?php 
                //pagination
                if($nomber_total_recored > $no_of_records_per_page ){
                    ?>              
                    <div class="col-12 mt-4">
                        <div class="pagination">
                        <?php if($pageno <= 1){
                            }else{ ?>
                            <div class="pagination-right">
                                <a href="?pageno=1"><span class="first-page"> << </span></a>
                                <a href="?pageno=<?php echo $pageno -1 ; ?>"><span class="perv-page">perv</span></a>
                            </div>
                            <?php } ?>
                            <?php if($pageno == $nomber_total_pages){
                            }else{ ?>
                            <div class="pagination-left">
                                <a href="?pageno=<?php echo $pageno+1 ; ?>"><span class="next-page">next</span></a>
                                <a href="?pageno=<?php echo $nomber_total_pages ?>"><span class="last-page"> >> </span></a>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                    <?php } ?>           
            </div>
        </div>
        <script src="js/jquery-3.4.1.min.js "></script>
        <script src="js/popper.min.js"></script>
        <script src="../bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
    </body>
    </html>
    <?php
}else{
    header('location:login.php');
}
ob_end_flush(); ?>