<?php

/*
 * For purposes of Ajax this is the only wordpress page template in the theme
 */
//Prepare document header
if($_GET["method"] != "ajax" ) {
	get_header();
	echo '<main role="main">';
} else {
	$answer['title'] = wp_title(false,false);
	$answer['bodyclasses'] = implode(' ',get_body_class($class));
	ob_start();
}

//Prepare document content
if(is_front_page() || is_page(2) || is_page('events') || is_page('press'))
	get_template_part('wall','home');
elseif(is_post_type_archive('menu'))
	get_template_part('wall','menulist');
elseif(is_page('menu-slider'))
	get_template_part('wall','menuslider');
elseif(is_page('gallery'))
	get_template_part('wall','gallery');
elseif(is_page('location'))
	get_template_part('wall','location');
elseif(is_page('book-a-table'))
	get_template_part('wall','book');
else
	get_template_part('wall');

//Prepare document footer
if($_GET["method"] != "ajax" ) {
	//echo date("h:i:s");
	echo '</main>';
	get_footer();
} else {
	$answer['contents'] = ob_get_contents();
	ob_end_clean();
	echo json_encode($answer);
} ?>
