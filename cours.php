<?php  
ob_start();
$base_url=' http://localhost:8080/site%20udomy';
include_once 'connect.php';
include_once 'include/function.php';

$posts=$con->prepare("SELECT * from posts where Approve=0 and Post_id={$_GET['id']}");
$posts->execute();
$post=$posts->fetch(); 
$row=$posts->rowCount();
if($row>0){
// title of page
$title=$post['Post_title'];
$description=  $post['Description'];
$image=$base_url.'/admin/image/'.$post['Image'];
$_url=$base_url.'/coures/'.preg_replace('([^A-Za-z0-9]+)','-',$post['Post_title']).'/'.$post['Post_id'];
$canonical= $_url;
$index='index';
$follow='follow';
include_once 'include/header.php';

//// start countor visits function ///
visits("posts","Post_id={$post['Post_id']}","{$post['Visits']}");
/////fin //
?>
<div class="col-12 col-md-8">
<div id="all" class="h5-filter" style="display:none"></div>
<div class="small-nav">
<?php 
                $catname=$con->prepare("SELECT * from categories where Cat_id={$post['Catid']}");
                $catname->execute();
                $catname=$catname->fetch(); 
                ?>
<a href="<?php echo $base_url; ?>/">Home</a> <i class="fa fa-chevron-right color-chevron"></i> <a href="<?php echo $base_url; ?>/search/"><?php echo $catname['Cat_name'] ?></a> <i class="fa fa-chevron-right color-chevron"></i> <span class="direction"> <?php echo $post['Post_title'] ?></span>
</div>
<div class="img-header">
<div class="ads">
ads
</div>
<br>
<h1 class="post-title text-center"><?php echo $post['Post_title']; ?></h1>
<section style="text-align:center">
    <div class="button-share-social-media">
        <a href="https://www.facebook.com/sharer.php?u=<?php echo $canonical ?>" >
            <i class="fab fa-facebook"></i>
        </a>
        <a href="https://twitter.com/share?url=<?php echo $canonical ?>&text=<?php echo $post['Post_title']; ?>"  >
            <i class="fab fa-twitter"></i>
        </a>
        <a href="https://pinterest.com/pin/create/bookmarklet/?media=<?php echo $base_url; ?>/admin/image/<?php echo $post['Image']; ?>&url=<?php echo $base_url.'/'.$canonical ?>&description=<?php echo $post['Post_title']; ?>"  >
            <i class="fab fa-pinterest"></i>
        </a>
        <a href="https://www.linkedin.com/shareArticle?url=<?php echo $canonical ?>&title=<?php echo $post['Post_title']; ?>"  >
            <i class="fab fa-linkedin"></i>
        </a>
        <a href="https://api.whatsapp.com/send?text=<?php echo $post['Post_title']; ?> <?php echo  $canonical ?>" >
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
<img src="<?php echo $base_url; ?>/admin/image/<?php echo $post['Image']; ?>" alt="<?php echo $post['Post_title']; ?>">
</section>
<br>
</div>
<div class="h5-filter"></div>
<main>
<p class="description"><strong><?php echo $post['Description']; ?></strong></p>
<div class="ads" style="background:#f7a67b">
ads
</div>
<section>
<article class="article-content">
<?php echo $post['Article']; ?>
</article>
</section>
</main>
<?php
$new_date =time();
$old_date=strtotime($post['Time_end']);
 if($post['Time_end']=='0000-00-00 00:00:00'){

 }else if($old_date<=$new_date){
?>
<div class="notice" style="background:#4caf5087;display:flex;padding: 10px 8px;">
    <strong style="margin-right: 8px;"><i style="color:#1033f3;">NOTICE:</i></strong>
    <p style="font-size: 15px;"> We are very sorry if the coupon does not work for you because these coupons are temporary,
        so you should follow the following link <a href="https://classfreecourses.com/">Click Here</a>
        to get the latest exclusive and 100% effective offers.
    </p>
</div>
<?php
}
?>
<div class="ads" style="background:#f7a67b">
ads
</div>
<br>
<div class="card">
<h5 class="card-header"><span>Related Courses</span></h5>
<div class="card-body">
<div class="row">
<?php                          
                        $articles=$con->prepare("SELECT * from posts where Approve=0 and Catid={$post['Catid']} and Post_id!={$post['Post_id']}  LIMIT 4");
                        $articles->execute();
                        $articles=$articles->fetchAll();                                              
                        foreach($articles as $blog){                                                 
                    ?>
<div class="col-6 d-flex align-items-stretch">
<div style="width:100%" href="<?php echo $base_url; ?>/cours/<?php echo  preg_replace('([^A-Za-z0-9]+)','-',$blog['Post_title']);?>/<?php echo $blog['Post_id'] ?> ">
<div class="sumilar-course">
<div class="course">
<a href="<?php echo $base_url; ?>/cours/<?php echo  preg_replace('([^A-Za-z0-9]+)','-',$blog['Post_title']);?>/<?php echo $blog['Post_id'] ?> " >
<img src="<?php echo $base_url; ?>/admin/image/<?php echo $blog['Image']; ?>" alt="<?php echo $blog['Post_title']; ?>">
</a>
<div class="sumilar-course-title">
<h2><a href="<?php echo $base_url; ?>/cours/<?php echo  preg_replace('([^A-Za-z0-9]+)','-',$blog['Post_title']);?>/<?php echo $blog['Post_id'] ?> " ><?php echo $blog['Post_title']; ?></a></h2>
</div>

<div class="sumilar-course-date"> <?php  echo $blog_time=date('Y-m-d',strtotime($blog['Date'])); ?> </div>

</div>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
</div>
<?php }else{
            // title of page
            $title=//$post['Post_title'];
            $description= // $post['Description'];
            $image=//$base_url.'/admin/image/'.$post['Image'];
            $_url=//$base_url.'/coures/'.preg_replace('([^A-Za-z0-9]+)','-',$post['Post_title']).'/'.$post['Post_id'];
            $canonical= // $_url;
            $index=//'index';
            $follow=//'follow';
            include_once 'include/header.php';?>
<div class="col-12 col-md-8">
<div id="all" class="h5-filter" style="display:none"></div>
<div class="alert alert-info">Sorry this cours does not existing now,Go to home and see lates courses <a href="<?php echo $base_url.'/'; ?>">Home</a></div>
</div>
<?php } ?>
<?php include_once 'include/sidebar.php'; ?>
</div>
</div>
</div>
<?php
include_once 'include/footer.php';
?>