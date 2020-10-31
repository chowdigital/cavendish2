<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NKXDPJC');</script>
	<!-- End Google Tag Manager -->
	<!-- Global site tag (gtag.js) - Google Ads: 793133620 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-793133620"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-793133620');
  gtag('config', 'UA-124522047-1');

  gtag('config', 'AW-793133620/c-4HCO3YwocBELSEmfoC', {
    'phone_conversion_number': '020 7487 3030'
  });
</script>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<script>var SITE_URL = '<?php echo bloginfo('url'); ?>';</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-124522047-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-124522047-1');
</script>
	<?php wp_head(); ?>
	<script>if( /Android.+mobile|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) == false) {document.write('<script src="<?php echo get_stylesheet_directory_uri() ?>/js/desktop.js">\x3C/script>\x3Clink rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/full.css?ver=4.0" type="text/css"/>'); document.documentElement.className = "preload";document.querySelector("meta[name=viewport]").setAttribute('content', 'width=1400,user-scalable=0');}</script>
	<!--[if lt IE 9]><script src="<?php echo get_stylesheet_directory_uri() ?>/js/html5shiv.js"></script><script>var ie8=1;</script><![endif]-->

<script>
		jQuery(document).ready(function($){

			/* toggle nav */
			$(".menu-item-has-children").on("click", function(){
				$(".sub-menu").slideToggle();
				$(this).toggleClass("active");
			});

		});
	</script>



</head>
<?php if($_GET["method"] != "ajax" AND !is_front_page() && !is_page(2) && !is_page('events') && !is_page('press') ) $class='open'; ?>
<body <?php body_class($class.' preload'); ?> data-url="http://<?php echo $_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']; ?>" itemscope="itemscope" itemtype="http://schema.org/Restaurant">
	<!-- Google Tag Manager (noscript) -->
	<noscript>
		<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKXDPJC" height="0" width="0" style="display:none;visibility:hidden">
		</iframe>
	</noscript>
	<!-- End Google Tag Manager (noscript) -->
	<header class="header" role="banner">
		<div class="wrapper">
			<a id="logo" href="<?php echo home_url(); ?>/" title="Back to home" itemprop="url">
				<img src="<?php echo get_stylesheet_directory_uri() ?>/images/The_Cavendish-Marylebone.png" alt="<?php bloginfo('name'); ?>"  itemprop="logo"/>
			</a>
			<nav>
				<button id="menu-icon"><span class="bar1"></span><span class="bar2"></span><span class="bar3"></span></button>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_id'=>'top-menu', 'container_class'=>'menu-wrap' ) ); ?>
			</nav>
			<div id="social-icon"><b></b><b></b><b></b><i></i><i></i></div>
			<ul id="social">
				<li><a href="<?php echo home_url(); ?>/sign-up-to-the-newsletter/" class="social-nl"><i>Sign up to the newsletter</i></a></li>
				<li><a href="https://www.facebook.com/pages/35-New-Cavendish/1547377145481349?sk=info" target="_blank" class="social-fb"><i class="icon-facebook"></i> <strong>Facebook</strong></a></li>
				<li><a href="https://twitter.com/35newcavendish" target="_blank" class="social-tw"><i class="icon-twitter"></i> <strong>Twitter</strong></a></li>
				<li><a href="http://instagram.com/35newcavendish" target="_blank" class="social-ig"><i class="icon-instagram"></i> <strong>Instagram</strong></a></li>
			</ul>
		</div>
	</header>
	<!-- /header -->
