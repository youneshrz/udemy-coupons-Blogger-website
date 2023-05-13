<?php
ob_start();
session_start();
if(isset($_SESSION['admin'])){
include 'include/init.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap-4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Posts</title>
</head>
<body>
<?php 
// $posts=getallfrom('*','posts',"",'','Post_id','asc' );
    include_once 'include/navbar.php';
     // pagination ========
$pageno =isset($_GET['pageno'])? $_GET['pageno']: '1';
$no_of_records_per_page = 8;
$start = ($pageno-1) * $no_of_records_per_page;
$posts=$con->prepare(" SELECT * from posts order by Post_id desc  LIMIT  $start,$no_of_records_per_page ");
$posts->execute();
$posts=$posts->fetchAll(); 

 ////
//pagination=======
$nomber_total_recored=$con->prepare(" SELECT * from posts ");
$nomber_total_recored->execute();
$nomber_total_recored=$nomber_total_recored->rowCount();
$nomber_total_pages=ceil($nomber_total_recored/$no_of_records_per_page);
///fin pagination===============
///
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
            <h2 class="text-center">Table  Posts</h2>
            <a href="add_post.php" class="btn btn-warning float-right">New Post</a>
                <table class="table table-dark  table-hover table-bordered ">
                    <thead>
                    <tr class="title">
                        <th>#ID</th> <th>POST TITLE</th> <th>DEDCRIPTION</th><th>ARTICLE</th> <th>LINK</th><th>IMAGE</th><th>TIME END</th><th>DISCOUNT</th><th>PRICE</th><th>OPTION</th> <th>VISITS</th> <th>DATE</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($posts as $post){  ?>
                        
                        <tr class="Delete<?php echo  $post["Post_id"];  ?>">
                            <td> <?php echo  $post["Post_id"]; ?></td>
                            <td> <?php echo  $post["Post_title"] ?></td>
                            <td> <?php echo  substr($post["Description"],0,100).'...'; ?></td>
                            <td> <?php echo  substr($post["Article"],0,100).'...'; ?></td>
                            <td> <?php echo  substr($post["Link"],0,50).'...'; ?></td>
                            <td> <img style="width:50px" class='img-responsive' src="<?php echo 'image/'.$post['Image']; ?>" /></td>
                            <td> <?php echo  $post["Time_end"] ?></td>
                            <td> <?php echo  $post["Discount"] ?></td>
                            <td> <?php echo  $post["Price"] ?></td>
                            <td class="text-right">
                                <a ><button  href="post_option.php?do=Approve" data-id="<?php echo  $post["Post_id"]?>" class="btn <?php if( $post['Approve']== 0 ){ echo 'btn-success' ;}else{ echo 'btn-danger' ;} ?> badge-pill approve">Approve</button></a>
                                <a href="add_post.php?do=Edit&id=<?php echo  $post["Post_id"]  ?>"><button class="btn btn-primary badge-pill">Edit</button></a>
                                <a ><button  href="post_option.php?do=Delete" data-id="<?php echo  $post["Post_id"]?>" class="btn btn-danger badge-pill delete">Delete</button></a>
                            </td>
                            <td> <?php echo  $post["Visits"] ?></td>
                            <td> <?php echo  $post["Date"] ?></td>
                            
                        </tr>
                        <?php } ?>
                    </tbody>
                    
                </table>
            </div> 
            <?php 
            //pagination
            if($nomber_total_recored > $no_of_records_per_page ){
                ?>              
                <div class="col-12 mt-1">
                    <div class="pagination">
                    <?php if($pageno <= 1){
                        }else{ ?>
                        <div class="pagination-right">
                            <a href="?pageno=1"><span class="first-page"> << </span></a>
                            <a href="?pageno=<?php echo $pageno -1 ; ?>"><span class="perv-page">perv</span></a>
                        </div>
                        <?php } 
                        echo '<div class="current-page">';
                        for($i=1;$i<=$nomber_total_pages;$i++){ ?>
                            <a href="?pageno=<?php echo $i ; ?>"><span class="current-page"><?php echo $i ; ?></span></a>
                        <?php
                        }
                        echo '</div>';
                        if($pageno == $nomber_total_pages){
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
    <!--<script src="js/jquery-3.2.1.slim.min.js"></script> -->
    <script src="js/popper.min.js"></script>
    <script src="../bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
<?php 
}else{ header('location:login.php') ;}
ob_end_flush(); ?>