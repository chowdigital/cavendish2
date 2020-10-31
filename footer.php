		<footer>
			<div class="wrapper">
			<h2 itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"><span itemprop="streetAddress">35 New Cavendish St</span><br />
			Marylebone, <span itemprop="addressLocality">London</span> <span itemprop="postalCode">W1G 9TR</span><br /></h2>
			<h2><a itemprop="telephone" href="tel:(+44)02074873030">020 7487 3030</a></h2>
			<h2><a itemprop="email" href="mailto:info@35newcavendish.co.uk">info@35newcavendish.co.uk</a></h2>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container'=>'div') ); ?>

			<p><br />
				&copy; <?php echo date("Y") ?> The Cavendish Marylebone<br />
				Website by <a href="http://spinachdesign.com">Spinach Design!</a>
			</p>
			<?php wp_footer(); ?>
			</div>
		</footer>

		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-55904128-1', 'auto');
		  ga('send', 'pageview');
			
         // get menus to change correctly
		 jQuery(document).ready(function(){
		  //jQuery('.menu-link').off();
		 });
		</script>
		<?php wp_footer(); ?>
	</body>
</html>
