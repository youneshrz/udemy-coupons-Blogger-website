<div class="col-12 col-md-4">
<div class="ads">
<h6>ads</h6>
</div>
<hr>
<div class="lates-blogs">
<div id="target"><span class="target">Popular courses</span></div>
<div class="blogs-content">
<?php                          
                        $blogs=$con->prepare("SELECT * from posts where Approve=0 order by Visits desc  LIMIT 3");
                        $blogs->execute();
                        $blogs=$blogs->fetchAll();                                      
                        foreach($blogs as $blog){      
                            $time_left=time_left($blog['Time_end']);                                              
                    ?>
<div class="mt-2" <?php if($time_left=="Time left"){ echo ' style="display:none !important;"';} ?>>
<div class="blog">
<div class="blog-img">
<a  href="<?php echo $base_url; ?>/cours/<?php echo preg_replace('([^A-Za-z0-9]+)','-',$blog['Post_title'])?>/<?php echo $blog['Post_id'] ?> ">
<img src="<?php echo $base_url; ?>/admin/image/<?php echo $blog['Image']; ?>" alt="<?php echo $blog['Post_title']; ?>">
</a>
</div>
<div class="blog-description" style="width:100%">
<a  href="<?php echo $base_url; ?>/cours/<?php echo preg_replace('([^A-Za-z0-9]+)','-',$blog['Post_title'])?>/<?php echo $blog['Post_id'] ?> "><?php echo substr($blog['Post_title'],0,100); ?>...</a>
<span>Read more <i class="fa fa-caret-right"></i></span>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
<hr>
<div class="ads">
<h6>ads</h6>
</div>
<br>
<div class="subscripe-email">
<div class="social-media">
<h3>Don’t want to miss your favourite free courses! Join our throught social media </h3>
<div class="link-social-media">
<a href="https://www.facebook.com/Classfreecourses-100863172206271/"><span class=""> <img src="<?php echo $base_url; ?>/facebook.png" alt="facebook" srcset=""></span></a>
<a href="https://www.instagram.com/classfreecourses/"><span class=""> <img src="<?php echo $base_url; ?> /instagram.png" alt="instagram" srcset=""></span></a>
<a href="https://twitter.com/classfreecourse?s=09"><span class=""> <img src="<?php echo $base_url; ?>/twitter.png" alt="twitter" srcset=""></span></a>
<a href="https://chat.whatsapp.com/JWTFXUP0Jzu8Np5KJNbiK4"><span class=""> <img src="<?php echo $base_url; ?>/whatsapp.png" alt="whatsapp" srcset=""></span></a>
<a href=""><span class=""> <img src="<?php echo $base_url; ?>/telegram.png" alt="telegram" srcset=""></span></a>
</div>
</div>
</div>
<div class="popular-tags">
<div class="popular-tags-title"><span>Popular tags</span></div>
<?php // get tags from databas and suparite by espace
                                $tags=$con->prepare( " SELECT Site_keyword from settings where Id= 1");
                                $tags->execute();
                                $tags=$tags->fetch();
                                $filter= explode(',', $tags['Site_keyword']);
                                foreach($filter as $filtr) {
                                    $tag=str_replace(' ','',$filtr);
                                    echo '<a class="tags" href="'.$base_url.'/tags/'.preg_replace('([^A-Za-z0-9]+)','-',$tag).'">' . $tag . '</a> ' ;
                                }
                            ?>
</div>
</div>