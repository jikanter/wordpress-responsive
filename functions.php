<?php
/**
 * boomshaka functions and definitions
 *
 * @package boomshaka
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'boomshaka_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * DS: ^ Does this apply to us?
 * JK: Yes, typically we run at the init hook, because that is where we can hack post types
 * 
 */
function boomshaka_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on boomshaka, use a find and replace
	 * to change 'boomshaka' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'boomshaka', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
  // Note: We are not using this anywhere, we default to the wordpress machinary.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'boomshaka' ),
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
		'aside', 'image', 'video', 'quote', 'link'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'boomshaka_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
  
}
endif; // boomshaka_setup
add_action( 'after_setup_theme', 'boomshaka_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function boomshaka_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'boomshaka' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'boomshaka_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function boomshaka_scripts() {
	wp_enqueue_style( 'boomshaka-style', get_stylesheet_uri() );

	wp_enqueue_script( 'boomshaka-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'boomshaka-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'boomshaka_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/* legacy functions. May not work right given the migration to underscores based theme */
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

add_action( 'customize_register', 'boomshaka_create_custom_gallery_uploader');
function boomshaka_create_custom_gallery_uploader($wp_customize) {
	// set up our gallery uploader
	$wp_customize->add_setting('custom_gallery_create', array(
		'default' => 'background-image: url("/uploads/2014/07/gallery-initial-content.jpg")',
		'transport' => 'refresh'
	));
	
}

add_action( 'customize_preview_init', 'boomshaka_load_customize_theme_scripts' );
function boomshaka_load_customize_theme_scripts()
{
	// load our customization for global artist site changes
	wp_enqueue_script( 'customize' , get_template_directory_uri() . '/customize.js', array('jquery', 'customize-preview'), '', true );
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

add_action( 'init', 'boomshaka_payment_init' );
function boomshaka_payment_init() {
  
  $body_classes = get_body_class();
  
  for ($i = 0; $i < sizeof($body_classes); $i++) {
    if ($body_classes[$i] == 'boomshaka-payment') {
      require_once(dirname(__FILE__) . '/inc/payment.php');
    }
  }
}

function show_payment_form() { 
  return $boomshaka_payment->form;
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
		/*if (is_admin() && (strcasecmp(__FILE__, 'customize.php') != -1)) { 
			// we are in the artist customization section, do nothing.
		}*/
	
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
		wp_enque_script("/wp-content/themes/boomshaka/scripts/customize.js");
		
	}
}

/* returns true if the custom boomshaka category is loaded, false otherwise */
function boomshaka_category_loaded_p() { 
  $body_classes = get_body_classes();
  $loadedp = false;
  for ($i = 0; $i < sizeof($body_classes); $i++) {
    if ($body_classes[$i] == "boomshaka") { 
      $loadedp = true;
    } 
  }
  return $loadedp;
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
							'name' => __('Pieces', 'post type general name', 'boomshaka'),
							'singular_name' => __('Piece', 'post type singular name', 'boomshaka'),
							'add_new' => __('Create', 'boomshaka' ),
              'add_new_item' => __('Create a Piece', 'boomshaka' ),
              'edit_item' => __('Edit Piece', 'boomshaka' ),
              'new_item'  => __('New Piece', 'boomshaka' ),
              'view_item' => __('View Piece', 'boomshaka' ),
              'search_items' => __('Search Pieces', 'boomshaka' ),
              'not_found' => __('No Pieces found', 'boomshaka' ),
              'not_found_in_trash' => __('No Pieces found in trash', 'boomshaka') ),
						'public' => true,
						'has_archive' => true,
						'hierarchical' => false,
						'show_ui' => true,
						'show_in_menu' => true,
						'show_in_menu_bar' => true,
            'show_in_nav_menus' => true,
						'menu_position' => 1,
						'supports' => array('title', 'editor', 'author', 'thumbnail',
						                    'exerpt', 'trackbacks', 'custom-fields',
											'revisions', 'page-attributes', 'page-formats'),
						'taxonomies' => array('category', 'post_tag', 'gallery', 'series'),
	));
	// register the gallery taxonomy for piece. This needs to be associated with a gallery
	// some time later because there will be too many pieces to make this hierarchical
	register_taxonomy('gallery', 'piece',  array('label' => __('Galleries')));
  register_taxonomy('series',  'piece',  array('label' => __('Series')));
  // register post status as sold
  
  /* Boomshaka Commerce Section - Hooks in to WooCommerce 2.1.2 - (c) WooThemes - All rights reserved */
  remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
  remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
  
  function boomshaka_artist_sales_before_main_content() {
    echo('<section class="site-content" id="boomshaka-artist-piece-sales">');
  }
  add_action('woocommerce_before_main_content', 'boomshaka_artist_sales_before_main_content', 10);
  
  function boomshaka_artist_sales_after_main_content() { 
    echo('</section>');
  }
  add_action('woocommerce_after_main_content', 'boomshaka_artist_sales_after_main_content', 10);
  
  // add woocommerce theme support
  add_theme_support('woocommerce');
}

