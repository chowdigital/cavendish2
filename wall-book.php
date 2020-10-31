<div class="wall wall-empty"><div class="wrapper"></div>
	<section class="subsection show">
<?php if (have_posts()): while (have_posts()) : the_post(); ?>
<?php //Prepare post vars
	$singular = is_singular();
	$thumb = the_compulsory_thumbnail('large','return'); //force thumb just when force content
	unset($format_normal,$format_image);
	if(has_post_format('image')) $format_image = true;
	else $format_normal = true; //standard, aside, page...
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('place'); ?>>
			<div class="contact_info">
			</div>
			<? the_field('code'); ?>
	</article>
	
<?php endwhile; ?>

<?php else: ?>
	<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'newcavendish' ); ?></p>
	<div class="search-area"><?php get_search_form(); ?></div>
<?php endif; ?>
	</section>
</div>