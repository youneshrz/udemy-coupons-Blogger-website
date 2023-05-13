<?php
include_once "connect.php";
include_once 'include/function.php';
    // title of page
    $title='Classfreecourses | Sitemap';
    $cats=getallfrom('*','categories','','','Cat_id','');
    $posts=getallfrom('*','posts',"where Approve=0",'','Post_id','asc');
    $base_url='http://localhost/site%20udomy';
    header("Content-type:application/xml;charset=utf-8");
//echo '<?xml version="1.0" encoding="UTF-8" ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"> 
<?php
//echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        echo '<url>';
            echo '<loc> '.$base_url.'/index </loc>';
            echo '<changfreq>daily</changfreq>';
        echo '</url>';
        echo '<url>';
            echo '<loc>'.$base_url.'/index#contact </loc>';
            echo '<changfreq>daily</changfreq>';
        echo '</url>';
        echo '<url>';
            echo '<loc>'.$base_url.'/about </loc>';
            echo '<changfreq>daily</changfreq>';
        echo '</url>';
    foreach($posts as $post){
        echo '<url>';
            echo '<loc> '.$base_url.'/cours/' .preg_replace('([^A-Za-z0-9]+)','-',$post['Post_title']).'/'.$post['Post_id'].'</loc>';
            echo '<changfreq>daily</changfreq>';
        echo '</url>';
    }
    foreach($cats as $cat){
        echo '<url>';
            echo '<loc> '.$base_url.'/category/'.str_replace(' ','-',str_replace(' & ','_',$cat['Cat_name'])).'</loc>';
            echo '<changfreq>daily</changfreq>';
        echo '</url>';
    }
    $tags=$con->prepare( " SELECT Site_keyword from settings where Id= 1");
    $tags->execute();
    $tags=$tags->fetch();
    $filter= explode(',', $tags['Site_keyword']);
    foreach($filter as $filtr) {
        $tag=str_replace(' ','',$filtr);
        echo '<url>';
            echo '<loc>'.$base_url.'/tags/'.$tag.' </loc> ' ;
            echo '<changfreq>daily</changfreq>';
        echo '</url>';
    }
echo '</urlset>';

?>