<?php if(is_page('events')) {
	$category_id = 3;
	echo "<div class=\"wall wall-events\"><div class=\"wrapper\">";
} elseif(is_page('press')) {
	$category_id = 13;
	echo "<div class=\"wall wall-press\"><div class=\"wrapper\">";
} else {
	$category_id = 2;
	echo "<div class=\"wall wall-home\"><div class=\"wrapper\">";
	/*
	 * Slider
	 */
	$slides = array( 'post_type' => 'slide', 'posts_per_page' => 10, 'order' => 'DESC' );
	$slides = get_posts( $slides );
	$i = 0;
	echo '<div class="slider post-45">';
	foreach ( $slides as $post ) : $i++; ?>
		<div class="slide <?php if($i == 1) echo 'current'; ?>" data-full="<?php echo the_compulsory_thumbnail('large','return',$post->ID);?>">
			<?php if($i == 1) echo '<span>'. the_compulsory_thumbnail('medium','echo',$post->ID).'</span>'; ?>
		</div>
	<?php endforeach; 
	echo '<div class="logo"></div></div>';
	
	/*
	 * Text
	*/
		$home_id = 2;
		$post = get_post($home_id);
		echo '<div class="intro">'.apply_filters('the_content', $post->post_content).'</div>'; 
}

/*
 * Blocks
 */
$modules = array( 'post_type' => 'module', 'posts_per_page' => -1, 'category' => $category_id );
$modules = get_posts( $modules );
echo '<div class="module-container">';
foreach ( $modules as $post ) : setup_postdata( $post ); ?>
	<h2 class="module-title module-title-<?php echo $post->post_name; ?>"><?php the_title(); ?></h2>
	<?php
		$module_function = 'module_' . str_replace('-','_',$post->post_name);
		if(function_exists($module_function)) 
			$module_function();
		elseif(get_field('link')) {
			$link = get_field('link');
			echo '<div class="module-content module-window module-'.$post->post_name.'"><a href="'.$link.'" target="_blank"><strong>'.$post->post_title.'</strong>';
			the_post_thumbnail('medium');
			echo '</a></div>';
		}	
		elseif(has_post_thumbnail()) {
			$link = has_excerpt() ? get_the_excerpt() : get_permalink( $post->ID );
			echo '<div class="module-content module-window module-'.$post->post_name.'"><a href="'.$link.'"><strong>'.$post->post_title.'</strong>';
			the_post_thumbnail('medium');
			echo '</a></div>';
		}
		else echo '<div class="module-content">Please, choose an image <br>and write a link <br>for this module</div>';		
	?>
<?php endforeach; 
echo '</div>';
wp_reset_postdata();

if(is_page('press')) echo '<div id="press-contact">'.apply_filters('the_content',get_the_content()).'</div>';
?>
	</div><section class="subsection"></section>
</div>