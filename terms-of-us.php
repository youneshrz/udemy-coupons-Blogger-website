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
<h1>Terms and Conditions</h1>
<p>Welcome to Classfreecourses!</p>
<p>These terms and conditions outline the rules and regulations for the use of classfreecourses is Website,
located at http://classfreecourses.me By accessing this website we assume you accept these terms and conditions. Do not continue to
use classfreecourses if you do not agree to take all of the terms and conditions stated on this page.
Our Terms and Conditions were created with the help of the Terms And Conditions Generator and the Free Terms & Conditions Generator.<br>
The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer
Notice and all Agreements: "Client", "You" and "Your" refers to you, the person log on this website
and compliant to the Company’s terms and conditions. "The Company", "Ourselves", "We", "Our" and "Us", refers to our Company. "Party",
"Parties", or "Us", refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment
necessary to undertake the process of our assistance to the Client in the most appropriate manner for
the express purpose of meeting the Client’s needs in respect of provision of the Company’s stated services,
in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other
words in the singular, plural,
capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.</p>
<h2>Cookies</h2>
<p>We employ the use of cookies. By accessing classfreecourses, you agreed to use cookies in agreement with the classfreecourses is Privacy Policy.<br>
Most interactive websites use cookies to let us retrieve the user’s details for each visit. Cookies are used by
our website to enable the functionality of certain areas to make it easier for people visiting our website.
Some of our affiliate/advertising partners may also use cookies.</p>
<h2>License</h2>
<p>Unless otherwise stated, classfreecourses and/or its licensors own the intellectual property rights for all material on classfreecourses.
All intellectual property rights are reserved. You may access this from classfreecourses for your own personal use subjected to
restrictions set in these terms and conditions.<br>
You must <br>
<ul>
<li>Republish material from classfreecourses</li>
<li>Sell, rent or sub-license material from classfreecourses</li>
<li>Reproduce, duplicate or copy material from classfreecourses</li>
<li>Redistribute content from classfreecourses</li>
</ul>
</p>
<h2>iFrames</h2>
<p>Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.</p>
<h2>Content Liability</h2>
<p>We shall not be hold responsible for any content that appears on your Website. You agree to protect and defend us against all claims that is rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of, any third party rights.</p>
<h2>Your Privacy</h2>
<p>Please read Privacy Policy</p>
<h2>Reservation of Rights</h2>
<p>We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amen these terms and conditions and it’s linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.</p>
<h2>Removal of links from our website</h2>
<p>If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.</p>
<p>We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.</p>
<h2>Disclaimer</h2>
<p>To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website. Nothing in this disclaimer will:
<ul>
<li>limit or exclude our or your liability for death or personal injury;</li>
<li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;</li>
<li>limit any of our or your liabilities in any way that is not permitted under applicable law; or</li>
<li>exclude any of our or your liabilities that may not be excluded under applicable law.</li>
</ul>
</p>
<p>The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.</p>
<p>As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.</p>
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