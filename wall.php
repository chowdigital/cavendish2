<div class="wall wall-empty"><div class="wrapper"></div>
	<section class="subsection show">
<?php if (!is_404() && have_posts()): while (have_posts()) : the_post(); ?>
<?php //Prepare post vars
	$singular = is_singular();
	$thumb = the_compulsory_thumbnail('large','return'); //force thumb just when force content
	unset($format_normal,$format_image);
	if(has_post_format('image')) $format_image = true;
	else $format_normal = true; //standard, aside, page...
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<h1>
			<?php $thumb_link = get_the_permalink(); ?>
			<?php if(!$singular) echo "<a href=\"$thumb_link\">";
			elseif(is_singular('menu')) {
				previous_post_link('<div style="float:right">%link</div>', '&gt;');
				next_post_link('<div style="float:left">%link</div>', '&lt;');
			} ?>
				<strong><?php the_title(); ?></strong>
			<?php if(!$singular) echo "</a>"; ?>
		</h1>
		<div class="post-content">
			<?php the_content(); ?>
		</div>
		<?php wp_link_pages(array('before' => '<div class="post-pages">'.__('Pages:'),'after' => '</div>', 'next_or_number' => 'number')); ?>
		<?php if(is_singular('post')) echo '<a href="'.get_bloginfo('url').'/events/">Events</a> - <a href="'.get_bloginfo('url').'/press/">Press</a>'; ?>
		<?php
			if(is_single() AND get_post_format()=='status') $close_url = get_bloginfo('url').'/press/';
			elseif(is_single()) $close_url = get_bloginfo('url').'/events/';
			else $close_url = get_bloginfo('url').'/';
			?>
		<a class="close" href="<?php echo $close_url; ?>"><strong>X</strong> Close</a>
	</article>


<?php endwhile; ?>

<?php else: ?>
	<article id="post-notfound" <?php post_class(); ?>>
		<h1><?php if(is_404()) echo 'Error 404:'; ?> Not found</h1>
		<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'newcavendish' ); ?></p>
		<div class="search-area"><?php get_search_form(); ?></div>
		<br />
	</article>
<?php endif; ?>
	</section>
</div>
