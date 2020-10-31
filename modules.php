<?php
/*
 * Block functions
*/

function module_all_menus() {
	$menus = array( 'post_type' => 'menu', 'posts_per_page' => -1 );
	$menus = get_posts( $menus );
	foreach ( $menus as $post ) : $image_attributes = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'medium'); ?>
	<article class="module-content module-window module-menu module-<?php echo $post->post_name; ?>" data-full="<?php echo $image_attributes[0];?>" data-height="<?php echo $image_attributes[2];?>">
		<h1><a href="<?php echo get_permalink( $post->ID ); ?>" class="menu-link"><span>&gt;</span> <strong><?php echo $post->post_title; ?></strong></a></h1>
	</article><?php endforeach; 
}
function module_all_events() { // <-- this is the original events template 
	$posts = array( 'post_type' => 'post', 'posts_per_page' => -1 );
	$posts = get_posts( $posts );
	foreach ( $posts as $post ) : setup_postdata( $post );
		$image_attributes = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'medium');
		$format = get_post_format($post->ID);
		if(in_array($format,array('','aside','link','image'))) :
			?>
			<article class="module-content <?php if($format=='link') echo 'module-window '; elseif($format=='') echo 'module-white '; ?>module-event"><?php
				if($format=='link' ) { 
					echo '<a href="'.get_permalink( $post->ID ).'" data-full="'. $image_attributes[0] .'" data-height="'. $image_attributes[2] .'">';
					if($format=='link') echo '<strong>'.str_replace('/','<br />',$post->post_title).'</strong>'; 
					echo '</a>';
				}
				if($format=='' || $format=='aside' ) { 
					echo '<h1><a href="'.get_permalink( $post->ID ).'">';
					if($format=='') echo '<figure class="event-thumb" data-full="'. $image_attributes[0] .'" data-height="'. $image_attributes[2] .'"></figure>';
					echo '<strong><!--'.date('d/m/y',strtotime($post->post_date)).'<br />-->'.str_replace('/','<br />',$post->post_title).'</strong></a></h1>';
					the_excerpt();
				}
				if($format=='image' ) {
					echo '<img src="'.$image_attributes[0].'" height="'.$image_attributes[2].'" alt="'.$post->post_title.'">'; 
				} ?>
			</article><?php
		endif;
	endforeach; 
}
function module_all_reviews() { // <-- this is the new reviews template, when those replaced events 
	$posts = array( 'post_type' => 'post', 'posts_per_page' => -1 );
	$posts = query_posts( $posts );
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		$image_attributes = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'medium');
		$format = get_post_format($post->ID);
		$link = has_excerpt($post->ID) ? get_the_excerpt() : get_permalink( $post->ID );
		if(in_array($format,array('status','image'))) :
		?>
		<article class="module-content <?php if($format=='status') echo 'module-white '; ?>module-event"><?php
			if($format=='status' ) { 
				echo '<h1>';
				echo '<figure class="event-thumb" data-full="'. $image_attributes[0] .'" data-height="'. $image_attributes[2] .'"></figure>';
				echo '<strong><time>'.get_the_date('d/m/y').'</time><br />'.str_replace('/','<br />',get_the_title()).'</strong></h1>';
				the_content();
			}
			if($format=='image' ) {
				echo '<img src="'.$image_attributes[0].'" height="'.$image_attributes[2].'" alt="'.$post->post_title.'">'; 
			} ?>
		</article><?php endif;
	endwhile; endif; wp_reset_query();
}
function module_last_event() {
	$posts = array( 'post_type' => 'post', 'posts_per_page' => 1, 
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'tax_query' => array( array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					//Exclude all but standard and aside (that is events)
					'terms' => array('post-format-gallery', 'post-format-link', 'post-format-image', 'post-format-quote', 'post-format-status', 'post-format-audio', 'post-format-chat', 'post-format-video'),
		            'operator' => 'NOT IN'
					) )
	);
	$posts = get_posts( $posts );
	foreach ( $posts as $post ) : setup_postdata( $post );
	$image_attributes = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'medium');
	$link = get_permalink( $post->ID ); ?>
	<div class="module-content module-event module-last-event">
		<?php if(!$image_attributes[0]) echo '<h2 class="events-link">Events</h2>'; ?>
		<article>
			<h1><a href="<?php echo $link; ?>" class="menu-link">
				<?php if($image_attributes[0]) echo '<img src="'.$image_attributes[0].'" height="'.$image_attributes[2].'" alt="'.$post->post_title.'" />'; ?>
				<strong><?php echo /*date('d/m/y',strtotime($post->post_date)).'<br />'. */$post->post_title; ?></strong>
			</a></h1>
			<?php the_excerpt(); ?>
		</article>
		<a href="<?php echo get_bloginfo('url').'/events/'; ?>" class="more">View all Events</a>
	</div><?php endforeach; 
}
function module_last_review() {
	$posts = array( 'post_type' => 'post', 'posts_per_page' => 1, 
		  'tax_query' => array(
			array(
			  'taxonomy' => 'post_format',
			  'field' => 'slug',
			  'terms' => 'post-format-status'
			)
		  )
	);
	$posts = get_posts( $posts );
	foreach ( $posts as $post ) : setup_postdata( $post );
	$image_attributes = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'medium'); 
	$link = get_bloginfo('url').'/press/'; ?>
	<div class="module-content module-event module-last-event module-white">
		<h2 class="events-link" style=""><a href="<?php echo $link; ?>">Press:</a></h2>
		<article>
			<h1><a href="<?php echo $link; ?>" class="menu-link">
				<?php if($image_attributes[0]) echo '<img src="'.$image_attributes[0].'" height="'.$image_attributes[2].'" alt="'.$post->post_title.'" />'; ?>
				<strong>
					<?php echo date('d/m/y',strtotime($post->post_date)).'<br />'.$post->post_title; ?>
				</strong>
			</a></h1>
			<?php the_excerpt(); ?>
		</article>
		<a href="<?php echo $link; ?>" class="more">Read more </a>
	</div><?php endforeach; 
}
function module_twitter() {?>
	<div class="module-content module-twitter">
		<div class="icon-twitter"></div>
		<?php echo do_shortcode('[timeline name="35newcavendish" count="1"]'); ?>
	</div>
<?php  }

