<?php
/*
* Template name: Wineclub
*/ 
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Wine Club | The Cavendish</title>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/full.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script>

$('body').css('visibility', 'visible').hide().fadeIn("slow");
</script>

<style>
body{background-color:#246e8b;background-size:cover;background-repeat:repeat-y;visibility:none;}
.logo-image{width:15%;margin:0px auto;margin-top:4%;}
.headline{width:35%;margin:0px auto;margin-top:2%;}
img{width:100%;}
.bottom-text{color:#ffffff; font-family:georgia, serif; width:35%;margin:0px auto;margin-top:3%;text-align:center;}
.bottom-text h3{font-style:italic;font-weight:normal;font-size:1.5vw;color:#ffffff;}
.bottom-text a{color:#ffffff;text-decoration:none;}
.bottom-text p{width:70%;margin:6% auto 0;font-size:1.1vw;}
@media screen and (max-width: 1124px) {
	.logo-image{width:50%;}
	.headline{width:60%;margin:0px auto;margin-top:4%;}
	.bottom-text{width:65%;}
	.bottom-text h3{font-size:4vw;}
	.bottom-text p{font-size:3vw;}
	body{background-size:100%;}
}
</style>
</head>

<body class="wine-club">
<div class="logo-image"><a href="http://35newcavendish.co.uk/"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" /></a></div>
<div class="headline"><img src="<?php bloginfo('template_directory'); ?>/images/headline-text.png" /></div>
<div class="bottom-text">
	<h3>All the exceptional wines you have come to expect from us, available online.</h3>
    <p>Join The Cavendish Wine Club and get exclusive discounts on every purchase.</p>
    <p>Email <a href="mailto:wineclub@35newcavendish.co.uk">wineclub@35newcavendish.co.uk</a> to register and receive a launch invite.</p>
</body>
</html>
