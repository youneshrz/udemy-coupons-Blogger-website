<br>
<footer>
<div>
<span id="top-page"><i class="fa fa-angle-double-up"></i></span>
</div>
<br>
<div class="ads">
ads
</div>
<div class="container">
<div class="row">
<div class="col-12 col-sm-6">
<form id="contact" action="" method="post" class="contact-form">
<strong>CONTACT US</strong>
<input type="text" class="form-control" name="username" placeholder="Entre your Username" required>
<input type="email" class="form-control" name="email" placeholder=" Entre your Email " required>
<textarea name="message" id="" required placeholder="Write your message"></textarea>
<button type="submit">Send</button><div class="msg mt-2"></div>
</form>
</div>
<div class="col-12 col-sm-6">
<div class="information-footer">
<strong>INFORMATION</strong>
<ul>
<li><a href="<?php echo $base_url; ?>/">Home</a></li>
<li><a href="<?php echo $base_url; ?>/about">About</a></li>
<li><a href="<?php echo $base_url; ?>/privacy-policy">privacy-policy</a></li>
<li><a href="<?php echo $base_url; ?>/terms-of-us">terms of us</a></li>
<li><a href="<?php echo $base_url; ?>/sitemap">Sitmap</a></li>
</ul>
</div>
</div>
</div>
</div>
<hr style='margin-bottom:0px'>
<div class="footer-bottom text-center">
Copyright © <?php echo date('Y'); ?> CLASSFREECOURSES.ME
</div>
</footer>
<script type="text/javascript" src="<?php echo $base_url; ?>/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>/js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $base_url; ?>/js/script.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>