<?php
session_start();
include 'include/init.php';
if(isset($_SESSION['admin'])){ ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../bootstrap-4.0.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <title>Dashboared</title>
    </head>
    <body>
        <?php 
        $ends=$con->prepare(" SELECT * from posts where now() >= Time_end and Time_end!=0  order by Post_id asc");
        $ends->execute();
        $number_courses_end=$ends->rowCount();
        $ends=$ends->fetchAll();
        $stmt2= $con->prepare("SELECT sum(Visits) FROM posts");
        $stmt2->execute();  
        $vues =$stmt2->fetchColumn();
        include_once 'include/navbar.php'; ?>
        <div class="container">
            <div class="row">
                <!-- start cared header -->
                <div class="col-sm-3 ">
                    <div class="bg-1 text-center">
                        <div>
                            <h3><strong>Total Posts</strong></h3>
                            <div class="bg1-num"><span class="num-color" > <?php echo $total_posts=countItems('Post_id','posts'); ?></span></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 ">
                    <div class="bg-2  text-center">
                        <div>
                            <h3><strong> Posts End</strong></h3>
                            <div class="bg2-num"><span class="num-color" > <?php echo $number_courses_end;  ?></span></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="bg-3  text-center">
                        <div>
                            <h3><strong>Posts Active</strong></h3>
                            <div class="bg3-num"><span class="num-color" > <?php echo $total_posts-$number_courses_end ; ?></span></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="bg-4  text-center">
                        <div>
                            <h3><strong>Total Vues</strong></h3>
                            <div class="bg4-num"><span class="num-color"  > <?php echo $vues; ?></span></div>
                        </div>
                    </div>
                </div>
                <!-- fin carde hadear -->
                <!-- start model posts option -->
                <div class="col-12 mt-3">
                <div class="card mb-1">
                    <h5 class="card-header">
                        <div>Keyboared</div> <div class="button"><button  class="multi_delete mr-2 bg-danger "><i></i>DELETE</button><button class="bg-info delete_multi"><a href="add_post.php" style="color:white"><i></i>ADD NOW</a></button></div></h5>                
                        <div class="card-body">  
                        <div class="post-line mb-1 ">
                                    <div class="content">                              
                                        <h5 class="title">All</h5>
                                    </div>
                                    <div class="option">
                                    <input  style="width:18px;height:18px;cursor:pointer;" type="checkbox" value="all" id="checked_all" >
                                    </div>
                                </div>                           
                            <?php                                                                        
                            foreach($ends as $end){                                                 
                            ?>                 
                                <div class="post-line mb-1 ">
                                    <div class="content">
                                        <span class="post_id mr-2">#<?php echo $end['Post_id']; ?></span>
                                        <img style="width:40px" src="<?php echo 'image/'.$end['Image'] ; ?>" alt="">
                                        <h5 class="title"><?php echo substr($end['Post_title'],0,50); ?></h5>
                                    </div>
                                    <div class="option">
                                    <input class="select_all" style="width:18px;height:18px;cursor:pointer;" type="checkbox" value="<?php echo $end['Post_id']; ?>" name="delete[]" id="checked" >
                                    </div>
                                </div>
                            <?php  } ?>                         
                            
                        </div>
                </div> 
                </div>
                <!-- fin model posts -->


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