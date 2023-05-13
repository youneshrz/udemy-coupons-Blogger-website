<?php  
ob_start();
$base_url=' http://localhost:8080/site%20udomy';
include_once 'connect.php';
include_once 'include/function.php';
    // title of page
    $site=$con->prepare( " SELECT * from settings where Id= 1");
    $site->execute();
    $site=$site->fetch();
    $title='Classfreecourses-About us';
    $description=  $site['Site_description'];
    $image=$base_url."/logo1.png";
    $_url=$base_url.'/about';
    $canonical= $_url;
    $index='noindex';
    $follow='follow';
    include_once 'include/header.php';
?>
<div class="col-12 col-md-8">
<div class="small-nav">
<a href="<?php echo $base_url; ?>/">Home</a> <i class="fa fa-chevron-right color-chevron"></i> About us </span>
</div>
<hr>
<div class="ads">
ads
</div>
<div class="h5-filter" id="all"></div>
<main class="main-content" style="background:var(--grey);border-radius:3px;padding:7px">
<h1>About us.</h1>
<h3>What our offering</h3>
<p style="padding-left:15px">
CLASS FREE COURSES provide 100% Free Udemy Courses with Certificate and this is Udemy free Coupon Courses.
These Udemy coupon have two days validity only. When the coupon course, has published,
It will expire in two days (from published date), after you can’t get that courses for Free.
You have to wait for that course and it will be published soon in <strong> classfreecourses</strong>. Once you have enrolled these courses,
you can get life time access. After completion of course, you will get certificate from Udemy.
</p>
<h2>How these Courses is helpful for People?</h2>
<ul style="margin-left:35px">
<li style="list-style:disc">If you not interested to pay money for education these courses will help you.</li>
<li style="list-style:disc">You can improve skills without paying money.</li>
<li style="list-style:disc">If you looking for job add these certificate in resume which will increase the value of you resume.</li>
<li style="list-style:disc">It is very easy to learn anything from youtube but we can’t Certificate. But here you can learn and also you can get certificate</li>
</ul>
<hr>
<div class="ads">
ads
</div>
<h2 style="text-align:center;color:var(--success)">Don’t want to miss your favourite free courses! Join our crew.</h2>
<div class="subscripe-email">
<div class="social-media">
<div class="link-social-media">
<a href="https://www.facebook.com/Classfreecourses-100863172206271/"><span class=""> <img style="width:60px" src="facebook.png" alt="facebook" srcset=""></span></a>
<a href="https://www.instagram.com/classfreecourses/"><span class=""> <img style="width:60px" src="instagram.png" alt="instagram" srcset=""></span></a>
<a href="https://www.instagram.com/classfreecourses/"><span class=""> <img style="width:60px" src="twitter.png" alt="twitter" srcset=""></span></a>
<a href="https://chat.whatsapp.com/JWTFXUP0Jzu8Np5KJNbiK4"><span class=""> <img style="width:60px" src="whatsapp.png" alt="whatsapp" srcset=""></span></a>
<a href=""><span class=""> <img style="width:60px" src="telegram.png" alt="telegram" srcset=""></span></a>
</div>
</div>
</div>
</main>
</div>
<?php include_once 'include/sidebar.php'; ?>
</div>
</div>
</div>
<?php
include_once 'include/footer.php';
?>