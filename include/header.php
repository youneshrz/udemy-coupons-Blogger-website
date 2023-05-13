<!DOCTYPE html>
<html lang=en>
<head>
<meta name=description content=<?php echo $description; ?> />
<meta property=og:locale content="en_US" />
<meta property=og:type content="article"/>
<meta property=og:title content="<?php echo $title ?>"/>
<meta property=og:description content="<?php echo $description; ?>"/>
<meta property=og:image content="<?php echo $image ;?>"/>
<meta property=og:url content=" <?php echo $_url; ?>"/>
<meta property=og:classfreecourses.com content="classfreecourses.com"/>
<meta name=twitter:card content="summary" />
<meta name=robots content="<?php echo $index.','.$follow ; ?>">
<link rel=canonical href="<?php echo $canonical; ?>">
<link rel="shortcut icon" href="<?php echo $base_url ?>/logo1.png" type=image/x-icon>
<meta charset=UTF-8>
<meta name=viewport content="width=device-width, initial-scale=1.0">
<link type=text/css rel=stylesheet href="<?php echo $base_url; ?>/bootstrap-4.0.0/dist/css/bootstrap.min.css">
<link type=text/css rel=stylesheet href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
<link type=text/css rel=stylesheet href="<?php echo $base_url; ?>/css/style.css">
<title> <?php echo $title ?></title>
</head>
<body>
<nav class=navbar>
<div class=brand><a href="<?php echo $base_url; ?>/"><img src="<?php echo $base_url; ?>/logo1.png" alt=CLASSFREECOURSES.COM><span><i>Classfreecourses</i></span></a></div>
<div class=nav-links>
<div class=search>
<form action="<?php echo $base_url; ?>/search" method=get>
<input class type=search name=q id placeholder="Tap Your Keyword And Press Entre ... ">
</form>
<span class=icon-search><i class="fa fa-search"></i></span>
</div>
<div class=links>
<ul class="link hide">
<li><a href="<?php echo $base_url; ?>/">Home</a></li>
<li><a href=#contact>Contact Us</a></li>
<li class=dropdown><a href=#>Categories <i class="fa fa-chevron-down rotation" style=font-size:14px;color:#ffff></i></a>
<ul>
<?php $cats=getallfrom('*','categories','','','Cat_id',''); 
                                foreach($cats as $cat){ 
                                    echo ' <li class="dropdown-li" >
                                                <a href=" '.$base_url.'/category/'.str_replace(' ','-',str_replace(' & ','_',$cat['Cat_name'])).'">'.$cat['Cat_name'].'</a>
                                            </li>';
                                }
                                ?>
</ul>
</li>
</ul>
<div class=burger>
<span class=line></span>
<span class=line></span>
<span class=line></span>
</div>
</div>
</div>
</nav>
<div class=container-fluid>
<div class=search-mobile>
<form action=search method=get>
<input class type=search name=q id placeholder="Tap Your Keyword And Press Entre ...">
</form>
</div>
<br>
<div class=row>