<?php

/* non hooked, utility functions */

function artist_site_generate() {
	// return the js widgets that comprise the javascript component of the site
	// this at the beginning a write-only interface with wordpress, so the functions supported should be simple, 
	// and abstracted enough to support wordpress updates with minimal intervention.
}

function artist_interface_init() { 
	// initialize the simple interface. Tee off the site generation if 
	// $boomshaka_category is undefined. 
	// Note: This will be called by artist site front end
	global $boomshaka_category;
	if (!$boomshaka_category) { 
		artist_site_generate();
	}
	// if $boomshaka_category is not defined, do nothing. we will read back the interface directly from wordpress 
	// and transform interface using js.
}

function boomshaka_custom_pings( $comment )
{
	$GLOBALS['comment'] = $comment;
?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php 
}

/* Hooked actions or filters. Keep these below functions that are not hooked into from the wordpress machinery */

add_action( 'after_setup_theme', 'boomshaka_setup' );
function boomshaka_setup()
{
	load_theme_textdomain( 'boomshaka', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 640;
	register_nav_menus(
		array( 'main-menu' => __( 'Main Menu', 'boomshaka' ) )
	);
}

add_action( 'customize_preview_init', 'boomshaka_load_customize_theme_scripts' );
function boomshaka_load_customize_theme_scripts()
{
	// load our customization for global artist site changes
	wp_enqueue_script( 'customize' , get_template_directory_uri() . '/customize.js', array('jquery', 'customize-preview'),
					  '',  
				  	  true );
}

add_filter( 'the_title', 'boomshaka_title' );
function boomshaka_title( $title ) {
	if ( $title == '' ) {
		return '&rarr;';
	} else {
		return $title;
	}
}

add_filter( 'wp_title', 'boomshaka_filter_wp_title' );
function boomshaka_filter_wp_title( $title )
{
	return $title . esc_attr( get_bloginfo( 'name' ) );
}

add_action( 'widgets_init', 'boomshaka_widgets_init' );
function boomshaka_widgets_init()
{
	register_sidebar( array ('name' => __( 'Sidebar Widget Area', 'boomshaka' ),
			   				 'id' => 'primary-widget-area',
							 'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							 'after_widget' => "</li>",
							 'before_title' => '<h3 class="widget-title">',
							 'after_title' => '</h3>', ) );
}


function boomshaka_gallery_init() { 
	
	// Get the piece
	
	// Display the piece according to artists specifications. Depends on $boomshaka_category
	
	// to display the piece according to artist specifications, we need
	 
	
}
/* boomshaka actions. output an artists page depending on whether we are in 'site' or 'blog' mode 
   in blog mode, do nothing. pass $_GET['bm'] in to change the mode. Probably will not want to use $_GET
   to affect look of site. 
*/
add_action( 'init', 'boomshaka_init' );
function boomshaka_init()
{
	// if it's a piece, piece detail, or piece purchase, initialize our hooks
	// make sure we are either using the 'boomshaka' theme, or have initialized a custom body class 
	
	if (is_category(array('piece', 'piece_detail', 'piece_purchase'))) { 
		
		// initialize our look, include custom artist code
		boomshaka_gallery_init();

		// If we are in piece_purchase initialize the ecommerce machinery
		if (is_category('piece_purchase')) { /* boomshaka_store_init(); */}
		// are we in customize.php, because we do nothing then as well.
		if (is_admin() && (strcasecmp(__FILE__, 'customize.php') != -1)) { 
			// we are in the artist customization section, do nothing.
		}
	
	}
	// otherwise do nothing, and use the regular blog machinary
}

add_action('customize_controls_init', 'boomshaka_artist_customization_init' );
function boomshaka_artist_customization_init() { 
	// This is the function that initializes the boomshaka artist customization interface.
	// This function makes the 
	global $boomshaka_category;
	$boomshaka_category = $_GET['category'];
	/*if ($boomshaka_category != 'customize') { 
		WP_Die( __('These aren\'t the droids you are looking for') );
	}*/
	// append to the body class the boomshaka customize. 
	$body_class .= ' boomshaka';
	if (!$boomshaka_scripts_loaded) { 
		// enqueue the customizer
		wp_enqueue_script( 'customize' , get_template_directory_uri() . '/customize.js' );
	}
}


/* right after customization is initialized, initialize a view of the artists pieces via js
 * additionally, if the 
 */
add_action( 'customize_control_print_scripts', 'artist_customize_control_print_scripts' );
function artist_customize_control_print_scripts()
{
	global $wp_customize, $boomshaka_category;
	// if we are in the boomshaka theme
	if ( ($wp_customize->theme()->display('Name') == 'boomshaka') && ($boomshaka_category) ) { 
		if ($boomshaka_category != 'customize') { $boomshaka_category = 'customize'; }
		boomshaka_artist_customization_init();
	}
}

add_filter( 'get_comments_number', 'boomshaka_comments_number' );
function boomshaka_comments_number( $count )
{
	if ( !is_admin() ) {
		global $id;
		$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}

// TODO: build custom post types for archive, gallery, piece
add_action('init', 'boomshaka_create_post_types' );
function boomshaka_create_post_types() {
	register_post_type( 'archive', array( 
						'labels' => array(
							'name' => __( 'Archives' ),
							'singular_name' => __( 'Archive' ),
							'add_new' => __('Build'), ),
						'public' => false,
						'has_archive' => true,
						'exclude_from_search' => true,
						'show_in_nav_menus' => false,
						'show_ui' => true,
						'show_in_menu' => true,
						'show_in_menu_bar' => true,
						'menu_position' => 3					
	));
	register_post_type('gallery', array( 
					   'labels' => array(
						   'name' => __('Galleries'),
						   'singular_name' => __('Gallery'),
						   'add_new' => __('Build'),
						   'parent_item' => __('Archive Page:'),
					       'parent_item_colon' => __('Archive Page:') ),
					   'public' => true,
					   'has_archive' => true,
					   'hierarchical' => true,
					   'show_ui' => true,
					   'show_in_menu' => true,
					   'show_in_menu_bar' => true,
					   'menu_position' => 2,
					   'parents' => 'archive',
					   'supports' => array('title', 'editor', 'author', 
					   					   'exerpt', 'trackbacks', 'custom-fields', 
										   'revisions', 'page-attributes', 'page-formats'),
						'taxonomies' => array('category', 'series')
		
	));
	// register the series taxonomy for gallery
	register_taxonomy('series', 'gallery');
	register_post_type('piece', array(
					   'labels' => array(
							'name' => __('Pieces'),
							'singular_name' => __('Piece'),
							'add_new' => __('Create') ),
						'public' => true,
						'has_archive' => true,
						'hierarchical' => false,
						'show_ui' => true,
						'show_in_menu' => true,
						'show_in_menu_bar' => true,
						'menu_position' => 1,
						'supports' => array('title', 'editor', 'author',
						                    'exerpt', 'trackbacks', 'custom-fields',
											'revisions', 'page-attributes', 'page-formats'),
						'taxonomies' => array('category', 'post_tag', 'gallery'),
	));
	// register the gallery taxonomy for piece. This needs to be associated with a gallery
	// some time later because there will be too many pieces to make this hierarchical
	register_taxonomy('gallery', 'piece', 
		array('label' => __('Galleries')));
}

