<? /*
  * Template name: Booking
*/ ?>

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
			<div id="map_canvas" class="map-test" style="width:100%" onload="initialize()">
				<a href="https://www.google.com/maps/place/The+Cavendish+Pub/@51.5190206,-0.15037,19z/data=!3m1!4b1!4m5!3m4!1s0x48761ad23537c223:0x70ca17932ab3ad5f!8m2!3d51.5190206!4d-0.1498228" target="_blank"><?php the_post_thumbnail('large'); ?></a>
			</div>
			<div class="contact_info">
				<?php the_content(); ?>
			</div>
		<?php wp_link_pages(array('before' => '<div class="post-pages">'.__('Pages:'),'after' => '</div>', 'next_or_number' => 'number')); ?>
		<?php if(is_singular('post')) echo '<a href="'.get_bloginfo('url').'/events/">Back to events</a>'; ?>
	</article>

<?php endwhile; ?>

<?php else: ?>
	<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'newcavendish' ); ?></p>
	<div class="search-area"><?php get_search_form(); ?></div>
<?php endif; ?>
	</section>
</div>
