<?php  
ob_start();
include 'include/init.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap-4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>categories</title>
</head>
<body>
<?php
$cats=getallfrom('*','categories',"",'','Cat_id','asc' );
include_once 'include/navbar.php';
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="add-category">
                    <label for=""><?php if(isset($_GET['do'])=='Edit'){ echo 'Edit' ;}else{ echo 'Add' ;} ?>  New Category  </label>
                    <form  method="post" <?php if(isset($_GET['do'])=='Edit'){ echo 'class="form-edit-category"' ;}else{ echo 'class="form-add-category"' ;} ?> >
                        <input type="hidden" name="catid" <?php if(isset($_GET['do'])=='Edit'){ echo 'value="'.$_GET['id'].'"' ;} ?> > 
                        <input class="input_catname" type="text" name="category" <?php if(isset($_GET['do'])=='Edit'){ echo 'value="'.$_GET['catname'].'"' ;} ?> >
                        <button  class="btn btn-primary" type="submit"><?php if(isset($_GET['do'])=='Edit'){ echo 'Edit' ;}else{ echo 'Add' ;} ?></button>
                        <?php if(isset($_GET['do'])=='Edit'){ echo '<a class="btn btn-warning" href="categories.php">Cancel</a>' ;} ?>
                    </form>
                </div>
                <hr>
                <section class="msg"></section>
                <h2 class="text-center">Table  Categories</h2>
                <table class="table table-dark  table-hover table-bordered ">
                    <thead>
                    <tr class="title">
                        <th>CATEGORY</th> <th>OPTIONS</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cats as $cat){  ?>
                        
                        <tr class="Delete<?php echo $cat['Cat_id'] ;?> ">
                            <td> <?php echo  $cat["Cat_name"] ?></td>
                            <td class="text-right">
                                <a href="?do=Edit&catname=<?php echo  $cat["Cat_name"]  ?>&id=<?php echo  $cat["Cat_id"]  ?>"><button class="btn btn-primary badge-pill">Edit</button></a>
                                <a ><button  href="category_option.php?do=Delete" data-id="<?php echo $cat['Cat_id']?>" class="btn btn-danger badge-pill delete">Delete</button></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    
                </table>
            </div>

        </div>
    </div>
    <!--<script src="js/jquery-3.2.1.slim.min.js"></script>-->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="../bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>