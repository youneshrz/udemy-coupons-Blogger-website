<?php  
ob_start();
$base_url=' http://localhost:8080/site%20udomy';
include_once 'connect.php';
include_once 'include/function.php';
    // title of page
    $site=$con->prepare( " SELECT * from settings where Id= 1");
    $site->execute();
    $site=$site->fetch();
    $title='Classfreecourses-Privacy Policy';
    $description=  $site['Site_description'];
    $image=$base_url."/logo1.png";
    $_url=$base_url.'/privacy-policy';
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
<div class="h5-filter" id="all" style="display:none"></div>
<main class="main-content" style="background:var(--grey);border-radius:3px;padding:7px">
<h1> PRIVACY POLICY</h1>
<h2>1. PURPOSE OF POLICY</h2>
<p>ClassFreeCourses.me (us, we, Non-Profit Organization) is committed to respecting the privacy rights of visitors and other users of this site. We created this Privacy Policy (this Policy) to give you confidence as you visit and use the Site, and to demonstrate our commitment to fair information practices. This Policy is only applicable to the Site, and not to any other websites that you may be able to access from the Site, each of which may have data collection and use practices and policies that differ materially from this Policy.</p>
<h2>2. SECURITY</h2>
<p>The Site has security measures in place to prevent the loss, misuse, and alteration of the information that we obtain from you, but we make no assurances about our ability to prevent any such loss to you or to any third party arising out of any such loss, misuse, or alteration.</p>
<h2>3.THIRD PARTY WEBSITES</h2>
<p>From time-to-time, the Site may contain links to other websites. If you choose to visit those websites, it is important to understand our privacy practices and terms of use do not extend to those sites. It is your responsibility to review the privacy policies at those websites to confirm that you understand and agree with their practices.</p>
<h2>4. CONTACTING US</h2>
<p>If you have any questions about this Policy or our practices related to this Site, please feel contact us</p>
<h2>5. UPDATES AND CHANGES</h2>
<p>We reserve the right, at any time, to add to, change, update, or modify this Policy to reflect changes in our Privacy Policy. We shall post any such changes on the Site in a conspicuous area. You may then choose whether you wish to accept said policy changes or discontinue using the Site. Any such change, update, or modification will be effective 30 days after posting on the Site. It is your responsibility to review this Policy from time to time to ensure that you continue to agree with all of its terms.
(a) If you have signed up for email communications from us, we will notify you of the privacy policy changes by email as well.</p>
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