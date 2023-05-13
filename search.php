<?php 
if(isset($_GET['q'])){
$base_url=' http://localhost:8080/site%20udomy';
$search=$_GET['q'];
include_once 'connect.php';
include_once 'include/function.php';
$title='Classfreecourses-'.$search;
    $site=$con->prepare( " SELECT * from settings where Id= 1");
    $site->execute();
    $site=$site->fetch();
    $description=  $site['Site_description'];
    $image=$base_url."/logo1.png";
    $_url=$base_url.'/search/'.$search;
    $canonical= $_url;
    $index='noindex';
    $follow='follow';
include_once 'include/header.php'; ?>
<div class="col-12 col-md-8">
<div class="small-nav">
<a href="index.php">Home</a> <i class="fa fa-chevron-right color-chevron"></i> Search
</div>
<br>
<?php           
                // pagination ========
$pageno =isset($_GET['pageno'])? $_GET['pageno']: '1';
if(empty($pageno)){
    $pageno=1;
}
$no_of_records_per_page = 19;
$start = ($pageno-1) * $no_of_records_per_page;
                $stmt=$con->prepare("SELECT * FROM posts WHERE Approve=0  AND Post_title LIKE '%$search%' OR Tags LIKE '%$search%' order by Post_id desc limit  $start,$no_of_records_per_page  ");
                $stmt->execute();
                $rows=$stmt->fetchAll();
               //pagination=======
               $nomber_total_recored=$con->prepare("SELECT * FROM posts WHERE Approve=0  AND Post_title LIKE '%$search%' OR Tags LIKE '%$search%' order by Post_id desc ");
$nomber_total_recored->execute();
$nomber_total_recored=$nomber_total_recored->rowCount();
$nomber_total_pages=ceil($nomber_total_recored/$no_of_records_per_page);
    ///fin pagination===============
    echo  "<span style='color: #6c757d'>".$search." ( ".$nomber_total_recored . " )  resultats. </span>" ;
    ?>
<div class="img-header">
<div class="ads">
ads
</div>
</div>
<div class="h5-filter" id="all" style="display:none"></div>
<div class="row">
<?php 
                if($nomber_total_recored>0){
                foreach($rows as $post){ 
                    $sql=$con->prepare("SELECT * FROM categories WHERE Cat_id={$post['Catid']}");
                    $sql->execute();
                    $category=$sql->fetch();
                    $time_left=time_left($post['Time_end']);
                ?>
<div class="col-12 col-sm-6 col-lg-4 col-xl-3 d-flex align-items-stretch" <?php if($time_left=="Time left"){ echo ' style="display:none !important;"';} ?>>
<div class="course">
<div >
<div class="course-img">
<span class="time-left"><?php echo time_left($post['Time_end']) ; ?></span>
<a href="<?php echo $base_url; ?>/cours/<?php echo preg_replace('([^A-Za-z0-9]+)','-',$post['Post_title']); ?>/<?php echo $post['Post_id']; ?> ">
<img src="<?php echo $base_url; ?>/admin/image/<?php echo $post['Image']; ?>" alt="<?php echo $post['Post_title']; ?>">
</a>
</div>
<section>
<div class="course-title">
<h2><a  href="<?php echo $base_url; ?>/cours/<?php echo preg_replace('([^A-Za-z0-9]+)','-',$post['Post_title']); ?>/<?php echo $post['Post_id']; ?> "> <?php echo $post['Post_title']; ?></a> </h2>
</div>
<div class="overlay">
<div class="overlay-content">
<span style="font-size:small"><?php echo $category['Cat_name']; ?> </span>
<?php if($post['Discount']==0){

                                        }else{
                                        echo '<span style="text-decoration: line-through;">'.$post['Price'].'$</span>';
                                        echo '<span>';
                                            if($post['Discount']==100){ echo 'FREE';}else{echo $post['Price']-(($post['Price']*$post['Discount'])/100).'$';}
                                        echo '</span>'; 
                                    }?>
</div>
</div>
<div class="course-detail">
<span class="time-ago"><?php echo time_ago($post['Date']) ?></span><span class="discount"><?php if($post['Discount']==0){echo 'FREE';}else{ echo '-'.$post['Discount'].'%';}  ?></span>
</div>
</section>
</div>
</div>
</div>
<?php }
                }else{
                    echo "<div style='width:100%;' class=' alert alert-info text-center'> There are no resultats Matching with ''".$search."'' </div>";
                }
            
            if($nomber_total_recored > $no_of_records_per_page ){
                ?>
<div class="col-12">
<div class="pagination">
<?php if($pageno <= 1){
                        }else{ ?>
<div class="pagination-right">
<a href="<?php echo $base_url; ?>/search/<?php echo $search ?>/1"><span class="first-page"> << </span></a>
<a href="<?php echo $base_url; ?>/search/<?php echo $search ?>/<?php echo $pageno -1 ; ?>"><span class="perv-page">prev</span></a>
</div>
<?php } ?>
<?php if($pageno == $nomber_total_pages){
                        }else{ ?>
<div class="pagination-left">
<a href="<?php echo $base_url; ?>/search/<?php echo $search ?>/<?php echo $pageno+1 ; ?>"><span class="next-page">next</span></a>
<a href="<?php echo $base_url; ?>/search/<?php echo $search ?>/<?php echo $nomber_total_pages ?>"><span class="last-page"> >> </span></a>
</div>
<?php }?>
</div>
</div>
<?php } ?>
<br>
</div>
</div>
<?php include_once 'include/sidebar.php'; ?>
</div>
</div>
<?php
include_once 'include/footer.php';
                        }
?>