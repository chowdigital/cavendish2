<div class="wall wall-empty"><div class="wrapper"></div>
	<section class="subsection show">
		<article id="post-<?php the_ID(); ?>" <?php post_class('menu-list'); ?>>
			<ul>
			<?php // Left Menu list
			$menus = array( 'post_type' => 'menu', 'posts_per_page' => -1 );
			$menus = get_posts( $menus );
				foreach ( $menus as $post ) : ?>
				<li>
					<h2><a href="<?php echo get_permalink( $post->ID ); ?>" class="menu-link"><?php echo $post->post_title; ?> <span>&gt;</span></a></h2>
				</li><?php endforeach; ?>
			</ul>
			<?php // Right Extra link module
			$modules = array( 'post_type' => 'module', 'posts_per_page' => 1, 'category' => 8 );
			$modules = get_posts( $modules );
			if($modules) { foreach ( $modules as $post ) : setup_postdata( $post ); ?>
				<?php $image_attributes = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'medium'); ?>
					<div class="module-content module-window module-menu module-<?php echo $post->post_name; ?> menu-extra-link show" style="background-image:url(<?php echo $image_attributes[0];?>)">
						<h1><a href="<?php echo get_the_excerpt(); ?>" class="menu-link"><strong><?php echo $post->post_title; ?></strong></a></h1>
					</div>
			<?php endforeach;
			} else echo '<div class="menu-extra-link" style="background:#fff"></div>'; ?>
		</article>
	</section>
</div>