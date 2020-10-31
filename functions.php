<?php
/**
 * newcavendish functions and definitions
 *
 * @package WordPress
 * @subpackage newcavendish
 */

include(TEMPLATEPATH . '/modules.php');

add_theme_support ( 'post-thumbnails' );

/**
 * newcavendish setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since newcavendish 1.0
 */
function newcavendish_setup() {

	load_theme_textdomain( 'newcavendish', get_template_directory() . '/languages' );

	// Enable support for Post Thumbnails
	add_theme_support( 'post-thumbnails' );

	show_admin_bar(false);

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus ( array (
		'primary' => 'Top primary menu'
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	* See http://codex.wordpress.org/Post_Formats
	*/
	add_theme_support( 'post-formats', array(
		'aside', 'status', 'link', 'image' //, 'video', 'gallery', 'audio', 'quote', 'chat'
	) );

	/* This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'twentyfourteen_custom_background_args', array(
	'default-color' => 'f5f5f5',
	) ) );*/

	/* This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );*/
}

add_action( 'after_setup_theme', 'newcavendish_setup' );

/**
 * Append page slugs to the body class
 * NB: Requires init via add_filter('body_class', 'add_slug_to_body_class');
 *
 * @param
 *        	array
 * @return array
 */
function newcavendish_bodyclasses($classes) {
	global $post;
	if (is_page ()) {
		$classes [] = sanitize_html_class ( $post->post_name );
	} elseif (is_singular ('post')) {
		$classes [] = sanitize_html_class ( 'events' );
		$classes [] = sanitize_html_class ( $post->post_name );
	} elseif (is_singular ()) {
		$classes [] = sanitize_html_class ( $post->post_name );
	}
	return $classes;
}

add_filter ( 'body_class', 'newcavendish_bodyclasses' );

/**
 * Append page slugs to the body class
 * NB: Requires init via add_filter('body_class', 'add_slug_to_body_class');
 *
 * @param
 *        	array
 * @return array
 * @author Keir Whitaker
 */
function newcavendish_postclasses( $classes ) {
	if ( is_singular() ) {
		array_push( $classes, 'singular-post' );
	} else {
		array_push( $classes, 'archived-post' );
	}
	return $classes;
}
//add_filter( 'post_class', 'newcavendish_postclasses' );

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Fourteen 1.0
 */
function newcavendish_scripts() {
	// Load our main stylesheet.
	wp_enqueue_style ( 'newcavendish-style', get_stylesheet_uri () );

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', ( 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js' ), false, null, true );
	//wp_register_script( 'jquery', ( get_template_directory_uri () . '/js/jquery-local.js' ), false, null, true );
	wp_enqueue_script( 'jquery' );

	wp_enqueue_script ( 'newcavendish', get_template_directory_uri () . '/js/basic.js', array ('jquery') );

}
add_action ( 'wp_enqueue_scripts', 'newcavendish_scripts' );


/*
 * Register posts
*/
function registrar_posttype($nombre,$titulo,$icon = 'dashicons-book',$public=true) { //en general título es el nombre en plural.
	if($public) $supports = array('title','editor','thumbnail');
	else $supports = array('title','excerpt','thumbnail');
	$args = array(
			'labels' => array(
					'name' => ucfirst($titulo),
					'singular_name' => ucfirst($nombre) ,
					'add_new' => "Add $nombre",
					'add_new_item' => "Add new $nombre",
					'new_item' => 'Add new' /*,*/
			),
			'label' => ucfirst($nombre),
			'public' => $public,
			'has_archive' => $public,
			'publicly_queryable' => $public,
			'show_ui' => true,
			'query_var' => $public,
			'menu_icon' => $icon,
			'rewrite' => array('slug' => $nombre, 'with_front' => false),
			'capability_type' => 'post',
			//'taxonomies' => array('post_tag'),
			'hierarchical' => false,
			'menu_position' => 5,
			'supports' => $supports
	);
	register_post_type( $nombre , $args );
}
function alltheposttypes() {
	registrar_posttype('menu','menus','dashicons-clipboard',true);
	registrar_posttype('slide','Home slider','dashicons-slides',false);
	registrar_posttype('module','Modules','dashicons-screenoptions',false);
	//register_taxonomy("section", "module", array("hierarchical" => false, "label" => "Sections", "singular_label" => "Section", "rewrite" => true, "show_ui" => false, 'query_var' => true));
	register_taxonomy('category',array('attachment','module'),array("hierarchical" => true,"label" => __("Pages"), "rewrite" => false, "show_ui" => true, 'show_admin_column' => true, 'query_var' => false));
	//register_taxonomy_for_object_type('category', 'module');
}
add_action('init', 'alltheposttypes');

function rename_post_label() {
	add_submenu_page( 'upload.php', 'See site gallery', 'Gallery', 'edit_posts', 'upload.php?taxonomy=category&term=gallery&post_type=attachment&mode=list');
	global $menu;
	global $submenu;
	$menu[5][0] = 'Events';
	$submenu['edit.php'][5][0] = 'Events';
	$submenu['edit.php'][10][0] = 'Add Event';
	echo '';
}
add_action( 'admin_menu', 'rename_post_label' );

function rename_post_formats() {
    global $current_screen;
    if ( $current_screen->id == 'post' ) { ?>
        <script type="text/javascript">
        jQuery('document').ready(function() {
			(function( $ ) {
				$('label.post-format-standard').text('Event with image');
				$('label.post-format-aside').text('Event without image');
				$('label.post-format-status').text('Review');
				$('label.post-format-image').text('Just image');
			})(jQuery);
        });
        </script>
<?php }
}
add_action('admin_footer', 'rename_post_formats');
/*
 * Convert strings into colours
*/
function str_to_color($str) {
	// return 'hsl('. intval('0x'.md5($str))%255 .', 90%, 45%)';
	return '#' . substr ( md5 ( $str ), 0, 6 );
}

add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);
function posts_columns_thumbnail($defaults){
	$defaults['the_post_thumbs'] = __('Content');
	return $defaults;
}
function posts_custom_columns($column_name, $id){
	if($column_name === 'the_post_thumbs'){
		global $post;
		$module_function = 'module_' . str_replace('-','_',$post->post_name);
		if(function_exists($module_function)) echo $module_function.'()';
		else echo the_post_thumbnail( array(100,100));
	}
}
add_filter('manage_posts_columns', 'posts_columns_thumbnail', 5);
add_filter('manage_module_posts_columns', 'posts_columns_thumbnail', 5);
add_filter('manage_slide_posts_columns', 'posts_columns_thumbnail', 5);

/*
 * the_compulsory_thumbnail
*/
function the_compulsory_thumbnail($size = 'thumbnail',$display = 'echo', $postid = false) {
	if(!$postid) $postid = get_the_ID();
	if ( has_post_thumbnail($postid) and $postid) {
		$id = get_post_thumbnail_id($postid);
	} else {
		/*Search img in content */
		$content = apply_filters('the_content',get_post_field('post_content', $post_id));
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
		$found_imgurl = $matches[1][0];
		if(!$found_imgurl) {
			/*If no image present in content, get first attached image*/
			$attachments = get_children(array('post_parent' => $postid, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order'));
			if ($attachments) {
				if ( is_array($attachments) ) {
				 $count = count($attachments);
				 $first_attachment = array_shift($attachments);
				 $id = $first_attachment->ID;
				}
			}/* else {
			$id = 662;
			}*/
		}
	}
	if($display == 'echo') echo !$found_imgurl ? wp_get_attachment_image($id, $size) : '<img src="'.$found_imgurl.' alt="" />';
	elseif($display == 'return') {
		$src = !$found_imgurl ? wp_get_attachment_image_src($id, $size) : array($found_imgurl);
		return $src[0]; }
}

function newcavendish_getParagraphs($cadena, $count = 3, $tipo = false) {
	//Functionlities: getting a number of paragraphs and getting a number of characters stripping the images
	$arrCadena = explode('</p>', $cadena);
	$totalP = count($arrCadena);
	if ($totalP>3) {
		$TEXTO = '';
		global $post;

		if (stripos($arrCadena[$totalP-1], "<script")!== false)
			$scriptTrue = 1;
		else
			$scriptTrue = 2;

		if ($tipo==1) {

			for ($i=0;  $i<$totalP; $i++ ) {
				if ($i==$scriptTrue)
					$TEXTO .= str_replace('<p', '<p id="read-more-'.$post->ID.'"',  $arrCadena[$i]);
				else
					$TEXTO .= $arrCadena[$i];
			}

		} else {

			$DivScript = '';
			if (stripos($arrCadena[$totalP-1], "<div")!== false) {
				$DivScript .= substr($arrCadena[$totalP-1], stripos($arrCadena[$totalP-1], "<div"));
			} else if (stripos($arrCadena[$totalP-1], "<script")!== false) {
				$DivScript .= substr($arrCadena[$totalP-1], stripos($arrCadena[$totalP-1], "<script"));
			}

			$TEXTO = $arrCadena[0].'</p>'.$arrCadena[1];
			if ($scriptTrue==2)
				$TEXTO .= $arrCadena[2];
			$TEXTO .= ' &nbsp;<a class="moretag" href="'. get_permalink($post->ID) . '#read-more-'.$post->ID.'">...Read more...</a></p>' . $DivScript;
		}
	} else {
		$TEXTO = $cadena;
	}


	return $TEXTO;
}

add_filter( 'wp_title', 'baw_hack_wp_title_for_home' );
function baw_hack_wp_title_for_home( $title )
{
  if( empty( $title ) && ( is_home() || is_front_page() ) ) {
    return __( 'The Cavendish' ) . ' | ' . get_bloginfo( 'description' );
  }
  return $title;
}

function newcavendish_add_editor_styles() {
	add_editor_style( 'editor-style.css' );
}
add_action( 'after_setup_theme', 'newcavendish_add_editor_styles' );

function custom_admin_login_logo() { ?>
	<style type="text/css">
		.login #login h1 {
			background: url( <?php echo get_template_directory_uri().'/images/The_Cavendish-Marylebone.png'; ?> ) center no-repeat; background-size:contain;
			height: 160px
		}
		.login #login h1 a {display: none}
		.wp-core-ui .button-primary {
			background: #8C704E !important;
			border-color: #8C704E;
		}
		body {
			background-image: url( <?php echo get_template_directory_uri().'/images/blue_leather.png'; ?> );
	   }
	</style>
<?php }
add_action( 'login_enqueue_scripts', 'custom_admin_login_logo' );

add_action( 'save_post', 'refresh_speedlight_cache' );

function refresh_speedlight_cache( $post_id ) {
	//Find the static cache file:
	$file = '../z-home-cache.php';
	if(file_exists($file )) unlink($file);
}
