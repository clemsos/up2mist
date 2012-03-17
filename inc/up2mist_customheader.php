<?php
/*
 * up2mist custom header
 */
function up2mist_custom_header_setup() {
	// The default header text color
	define( 'NO_HEADER_TEXT', true );
	define( 'HEADER_TEXTCOLOR', '' );

	// By leaving empty, we allow for random image rotation.
	define( 'HEADER_IMAGE', '' );

	// The height and width of your custom header.
	// Add a filter to up2mist_header_image_width and up2mist_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'up2mist_header_image_width', 1170 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'up2mist_header_image_height', 240 ) );

	// Turn on random header image rotation by default.
	add_theme_support( 'custom-header', array( 'random-default' => true ) );

	// Add a way for the custom header to be styled in the admin panel that controls custom headers
	add_custom_image_header( 'up2mist_header_style', 'up2mist_admin_header_style', 'up2mist_admin_header_image' );
	
	$default_headers = array(
		'up2mist' => array(
			'url' => UP2MIST_URI . '/img/up2mist_default_header_1170x240.png',
			'thumbnail_url' => UP2MIST_URI . '/img/up2mist_default_header_thumbnail_260x53.png',
			'description' => __( 'up2mist default', 'up2mist' )
			)
		);
	
	register_default_headers( $default_headers );
	
}
add_action( 'after_setup_theme', 'up2mist_custom_header_setup' );

/**
 * Styles the header image and text displayed on the blog
 */
function up2mist_header_style() {
	
}

/**
* Styles the header image displayed on the Appearance > Header admin panel.
*
* Referenced via add_custom_image_header() in up2mist_setup().
*/
function up2mist_admin_header_style() {
?>
<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1, #desc {
	}
	#headimg h1 {
	}
	#headimg h1 a {
	}
	#desc {
	}
	#headimg img {
	}


</style>
<?php
}

/**
* Custom header image markup displayed on the Appearance > Header admin panel.
*
* Referenced via add_custom_image_header() in up2mist_setup().
*/
function up2mist_admin_header_image() {
?>
<div id="headimg">
	<?php
	if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
		$style = ' style="display:none;"';
	else
		$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
	?>
	<h1><a id="name"<?php echo $style;?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) );?>"><?php bloginfo( 'name' );?></a></h1>
	<div id="desc"<?php echo $style;?>>
		<?php bloginfo( 'description' );?>
	</div>
	<?php $header_image = get_header_image();
if ( ! empty( $header_image ) ) {
	?><img src="<?php echo esc_url( $header_image );?>" alt="" />
	<?php }?>
</div>
<?php }?>
