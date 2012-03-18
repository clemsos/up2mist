<?php
/*
 * up2mist functions and definitions
 */

/* Define theme constants */
define( 'UP2MIST_URI', get_template_directory_uri( ) );
define( 'UP2MIST_DIR', get_template_directory( ) );
define( 'UP2MIST_RESPONSIVE', TRUE );
define( 'UP2MIST_PRIMARY', 'span8' );
define( 'UP2MIST_SECONDARY', 'span4' );
define( 'UP2MIST_FULLWIDTH', 'span12' );
define( 'UP2MIST_NAVCLASS', 'navbar' );

/* Set the content width based on the theme's design and stylesheet. */
if ( ! isset( $content_width ) )
	$content_width = 770;
/* pixels */

add_action( 'after_setup_theme', 'up2mist_setup' );

function up2mist_setup() {

	/* Load up2mist template files */
	/* locate_template( $template_names, $load, $require_once ) */
	require_once (UP2MIST_DIR . '/inc/up2mist_hooks.php');
	require_once (UP2MIST_DIR . '/inc/up2mist_functions.php');
	require_once (UP2MIST_DIR . '/inc/up2mist_templates.php');
	require_once (UP2MIST_DIR . '/inc/up2mist_navmenu.php');
	require_once (UP2MIST_DIR . '/inc/up2mist_gallery.php');
	//require_once (UP2MIST_DIR . '/inc/up2mist_shortcodes.php');

	/* Make theme available for translation */
	load_theme_textdomain( 'up2mist', get_template_directory( ) . '/languages' );

	$locale = get_locale( );
	$locale_file = get_template_directory( ) . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once ($locale_file);

	/* Add default posts and comments RSS feed links to head */
	add_theme_support( 'automatic-feed-links' );

	/* Add suppot for post-thumbnails */
	add_theme_support( 'post-thumbnails' );

	/* This theme uses wp_nav_menu() in one location. */
	register_nav_menus( array( 'primary' => __( 'Primary Menu', 'up2mist' ), ) );

	/* Add support for the Aside and Gallery Post Formats */
	add_theme_support( 'post-formats', array( 'aside', ) );

	/* Add featured image size */
	add_image_size( 'featured_fullwidth', 1170, 9999 );
	add_image_size( 'featured_large', 770, 9999 );
	
	/* Add callback for custom TinyMCE editor stylesheets. */
	add_editor_style('editor-style.css');

}

/* Load stylesheets */
function up2mist_load_styleheets() {

	$html = "\t" . '<link rel="stylesheet" href="' . UP2MIST_URI . '/css/bootstrap.css' . '">' . "\n";

	if ( UP2MIST_RESPONSIVE ) {
		$html .= "\t" . '<link rel="stylesheet" href="' . UP2MIST_URI . '/css/bootstrap-responsive.min.css' . '">' . "\n";
	}

	$html .= "\t" . '<link rel="stylesheet" href="' . UP2MIST_URI . '/style.css' . '">' . "\n";

	echo $html;
}

add_action( 'up2mist_stylesheets', 'up2mist_load_styleheets' );

/* Enqueue scripts and styles */
function up2mist_enqueue_scripts() {

	/* wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer ); */
	wp_enqueue_script( 'modernizr', UP2MIST_URI . '/js/modernizr.custom-2.5.3.min.js', false, '2.5.3' );
	wp_enqueue_script( 'bootstrap', UP2MIST_URI . '/js/bootstrap.min.js', array( 'jquery' ), '2.0.2' );

	if ( is_singular( ) && comments_open( ) && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}

add_action( 'wp_enqueue_scripts', 'up2mist_enqueue_scripts' );

/* Register widgetized area and update sidebar with default widgets */
function up2mist_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'up2mist' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}

add_action( 'widgets_init', 'up2mist_widgets_init' );
?>
