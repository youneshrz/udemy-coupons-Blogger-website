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
    include_once 'include/navbar.php';
    $do=isset($_GET['do'])? $_GET['do']:'0';
        if($do=='Edit'){
            $postid=$_GET['id'];
            $posts=$con->prepare(" SELECT * from posts where Post_id={$postid}" ); 
            $posts->execute();
            $post=$posts->fetch();
        }
    ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                <h2 class="text-center"><?php if($do=='Edit'){ echo 'Edit' ;}else{ echo 'New' ;} ?>  Post</h2>
                <hr>
                    <div class="add-post">
                        <form action="<?php if($do=='Edit'){ echo 'post_option.php?do=Edit';}else{ echo 'post_option.php?do=Insert' ;} ?> " method="post"  enctype="multipart/form-data">
                            <input class="form-control" name="title" type="text" value="<?php if($do=='Edit'){ echo $post["Post_title"] ;} ?>" placeholder="Enter Title Of Post">
                            <select class="form-control" name="catname">
                                <?php if($do=='Edit'){ 
                                    $cats= getallfrom('*','categories',"","",'Cat_id'); 
                                    foreach($cats as $cat){
                                        echo "<option value='". $cat['Cat_id']."'";if($cat['Cat_id']==$post['Catid']){ echo 'selected'; } echo ">". $cat['Cat_name']."</option>";  
                                        }           
                                    }else{
                                        echo '<option value="">...</option>';
                                        $cats=getallfrom('*','categories','','','Cat_id','asc') ;
                                        foreach($cats as $cat){
                                        echo "<option value='".$cat['Cat_id']."'>"; echo $cat['Cat_name'] ; echo "</option>";
                                        }
                                        } ?>        
                            </select>

                            <input class="form-control" name="description" type="text" value="<?php if($do=='Edit'){ echo $post["Description"] ;} ?>" placeholder=" Enter Description">
                            <input class="form-control" name="link" type="text" value="<?php if($do=='Edit'){ echo $post["Link"] ;} ?>" placeholder=" Enter Link Of Botton">
                            <input class="form-control" name="image" type="file" value="<?php  ?>" placeholder=" ">
                            <input class="form-control" name="postid" type="hidden" value="<?php if($do=='Edit'){ echo $post["Post_id"] ;} ?>">
                            <input class="form-control" name="tags" type="text" value="<?php if($do=='Edit'){ echo $post["Tags"] ;} ?>" placeholder="Enter All Tags ">
                            <input class="form-control" name="date" type="date" value="<?php if($do=='Edit'){ echo $post["Time_end"] ;} ?>" placeholder=" Time End">
                            <input class="form-control" name="price" type="nember" value="<?php if($do=='Edit'){ echo $post["Price"] ;} ?>" placeholder=" Price">
                            <input class="form-control" name="discount" type="nember" value="<?php if($do=='Edit'){ echo $post["Discount"] ;} ?>" placeholder=" Discount">
                            <textarea id="editor" name="editor" id="" cols="30" rows="10"> <?php if($do=='Edit'){ echo $post["Article"] ;} ?> </textarea>
                            <button class="btn btn-success form-control" type="submit">Save</button>
                        </form>
                        <div class="msg"></div>
                    </div>
                    <hr>
                </div>         
            </div>
        </div>
        <script src="ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('editor');
            //var editordata=editor.getData();
        </script>
        <script src="js/jquery-3.2.1.slim.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="../bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
        
        <script src="js/script.js"></script>
    </body>
    </html>
    <?php 
}else{ header('location:login.php') ;}
ob_end_flush(); ?>