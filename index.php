<?php 
ob_start();
$base_url=' http://localhost:8080/site%20udomy';
include_once 'connect.php';
include_once 'include/function.php';
// title of page
$site=$con->prepare( " SELECT * from settings where Id= 1");
$site->execute();
$site=$site->fetch();
$title='Classfreecourses | Home';
$description=  $site['Site_description'];
$image=$base_url."/logo1.png";
$_url=$base_url;
$canonical= $base_url;
$index='index';
$follow='follow';
include_once 'include/header.php';
    // query//       
    $query =" SELECT * from posts where Approve=0  ";
    // pagination ========
$pageno=isset($_GET['pageno'])? $_GET['pageno']: '1';
if(empty($pageno)){
    $pageno=1;
}
$no_of_records_per_page = 19;
$start = ($pageno-1) * $no_of_records_per_page;

    if(isset($_GET['submit'])){       
        $cats=[];
        $cats=isset($_GET['catname'])? $_GET['catname'] :'' ;
        
        $discount1=isset($_GET['discount1'])?$_GET['discount1'] :'' ;
        $discount2=isset($_GET['discount2'])?$_GET['discount2'] :'' ;
        if( !empty($cats) ){
            $cat_filter= implode(",", $cats);
            $query .=" and Catid IN(".$cat_filter.") ";
        }      
        if( !empty($discount1) ){
            $query .=" and Discount between 50 and 100  ";           
        }
        if( !empty($discount2) ){
            $query .=" and Discount=0 or Discount=100   ";           
        }        
    }
     // start qeury ////
    $posts=$con->prepare($query."order by Post_id desc  LIMIT  $start,$no_of_records_per_page ");
    $posts->execute();
    $total=$posts->rowCount();
    $posts=$posts->fetchAll(); 

     ////
    //pagination=======
$nomber_total_recored=$con->prepare($query);
$nomber_total_recored->execute();
$nomber_total_recored=$nomber_total_recored->rowCount();
$nomber_total_pages=ceil($nomber_total_recored/$no_of_records_per_page);
if((isset($_GET['catname'])) || (isset($_GET['discount1'])) || (isset($_GET['discount2']))  ){
    $curent_url=$_SERVER['REQUEST_URI'];
}else{
    $curent_url= 'index';
}
    ///fin pagination===============

    //// start countor visits function ///
    visits("settings",'Id=1',"{$site['Visits']}");
    /////fin //
/*$start=microtime(true);
echo $start;*/
    ?>
<div class="col-12 col-md-8">
<div class="img-header">
<section>
    
<h1 style="font-weight: bold;color: #343a40;">Get [100%]off Free udemy courses coupons code with Certificate.</h1>
<p style="font-size: 18px;font-weight: bold;padding: 10px;margin-top: 25px;">
free udemy courses with certificate,without spend money you will find udemy free coupons courses daily updated  
</p>
<!--<img style="width:100%" class="img-responsive" src="<?php echo $base_url; ?>/header_3.png" alt="Image for identifeir the web site">-->
</section>
<br>
<div class="ads">
ads
</div>
</div>
<div class="row">
<h5 class="form-control h5-filter">Filter <i class="fa fa-chevron-up rotation"></i></h5>
<form class="filter-form" action="<?php echo $base_url; ?>/" method="get">
<div class="section-filter">
<div class="filter-by-category">
<h4> By Categories</h4>
<div class="filter-select">
<span class="mb-1">
<input type="checkbox" value="all" id="all">
<label style="margin:0px" class="ml-1 label" for="all">All</label>
</span>
<?php 
                                    $cats=getallfrom('*','categories','','','Cat_id','');
                                    foreach($cats as $cat){
                                        $checked=[];
                                        if(isset($_GET['catname'])){
                                            $checked=$_GET['catname'];
                                        }
                                ?>
<span class="mb-1">
<input class="categories" type="checkbox" value="<?php echo $cat['Cat_id'] ?>" name="catname[]" id="<?php echo $cat['Cat_name'] ?>"<?php if(in_array($cat['Cat_id'],$checked)){ echo "checked";} ?>>
<label style="margin:0px" class="ml-1 label" for="<?php echo $cat['Cat_name'] ?>"><?php echo $cat['Cat_name'] ?></label>
</span>
<?php  } ?>
</div>
</div>
<div class="filter-by-discount ml-1">
<h4> By Discount</h4>
<div class="filter-select">
<span class="mb-1"> <input type="checkbox" value="100" name="discount2" id="discount2" <?php isset($_GET['discount2'])?  print("checked")  : '' ?>><label class="ml-2 label" for="discount2"> 100%</label></span>
<span class="mb-1"><input type="checkbox" value=">50" name="discount1" id="discount1" <?php isset($_GET['discount1'])?  print("checked") : '' ?>><label class="ml-2 label" for="discount1"> > 50%</label></span>
</div>
</div>
</div>
<button class="mb-1" name="submit" type="submit">filter</button>
</form>
<?php         

                if( $nomber_total_recored >0){
                    /*if(!file_exists("cache/user.cache") || time()-filemtime("cache/user.cache") > 1*60){
                        file_put_contents("cache/user.cache",serialize($posts)); 
                    }else{
                        $posts=unserialize(file_get_contents("cache/user.cache"));
                        echo 'cache';
                    }*/
                    foreach($posts as $post){                          
                       $sql=$con->prepare("SELECT * FROM categories WHERE Cat_id={$post['Catid']}");
                        $sql->execute();
                        $category=$sql->fetch();
                        $time_left=time_left($post['Time_end'])
                    ?>
<div class="col-12 col-sm-6 col-lg-4 col-xl-3 d-flex align-items-stretch" <?php if($time_left=="Time left"){ echo ' style="display:none !important;"';} ?>>
<div class="course">
<div>
<div class="course-img">
<span class="time-left"><?php echo $time_left; ; ?></span>
<a href="cours/<?php echo  preg_replace('([^A-Za-z0-9]+)','-',$post['Post_title']); ?>/<?php echo $post['Post_id']; ?> "><img src="<?php echo $base_url; ?>/admin/image/<?php echo $post['Image']; ?>" alt="<?php echo $post['Post_title']; ?>"> </a>
</div>
<section>
<div class="course-title">
<h2>    <a href="cours/<?php echo  preg_replace('([^A-Za-z0-9]+)','-',$post['Post_title']); ?>/<?php echo $post['Post_id']; ?> "><?php echo $post['Post_title']; ?>  </a> </h2>
</div>
<div class="overlay">
<div class="overlay-content">
<span style="font-size:small"><?php echo $category['Cat_name']; ?> </span>
<?php if($post['Discount']==0){

                                            }else{
                                            echo '<span style="text-decoration: line-through;">'.$post['Price'].'$</span>';
                                            echo '<span class="price-final">';
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
                    echo '<div class="alert alert-info text-center mt-1" style="width:100%;">  indefined courses </div>';
                }          
                if($nomber_total_recored > $no_of_records_per_page ){
                ?>
<div class="col-12">
<div class="pagination">
<?php if($pageno <= 1){
                        }else{ ?>
<div class="pagination-right">
<a href="<?php  echo $curent_url; ?>?&pageno=1"><span style="padding:2px 5px" class="first-page"><i class="fa fa-angle-double-left"></i> </span></a>
<a href="<?php  echo $curent_url; ?>?&pageno=<?php echo $pageno -1 ; ?>"><span class="perv-page">prev</span></a>
</div>
<?php } ?>
<?php if($pageno == $nomber_total_pages){
                        }else{ ?>
<div class="pagination-left">
<a href="<?php  echo $curent_url; ?>?&pageno=<?php echo $pageno +1 ; ?>"><span class="next-page">next</span></a>
<a href="<?php echo  $curent_url; ?>?&pageno=<?php echo $nomber_total_pages ?>"><span style="padding:2px 5px" class="last-page"><i class="fa fa-angle-double-right"></i> </span></a>
</div>
<?php }?>
</div>
</div>
<?php } ?>
<br>
</div>
<br>
</div>
<?php include_once 'include/sidebar.php'; ?>
</div>
</div>
<?php include_once 'include/footer.php'; 
/*$end=microtime(true)-$start;
echo $end;*/
?>