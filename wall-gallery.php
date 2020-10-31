<div class="wall wall-empty"><div class="wrapper"></div>
	<section class="subsection show">
		<article id="post-gallery">
			<div id="view">
			<ul id="auto-wall" class="gallery"><?php
				$posts = array( 'post_type' => 'attachment', 'posts_per_page' => -1, 'cat' => 7 );
				$posts = get_posts( $posts );
				foreach ( $posts as $post ) : ?>
					<li data-src="<?php $src = wp_get_attachment_image_src($post->ID, 'full'); echo $src[0]; ?>" data-html="<h1 class='image-title'><?php echo str_replace(array('_','-'),' ',$post->post_title);?></h1>">
						<a href="#">
							<?php echo wp_get_attachment_image($post->ID, 'thumbnail'); ?>
						</a>
					</li><?php endforeach;
			?></ul>
			</div>
		</article>
	</section>
</div>
