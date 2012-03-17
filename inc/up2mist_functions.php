<?php
/*
 * up2mist theme functions
 */

function up2mist_featured_image() {
	global $post;
	$minsize = is_page_template( 'page-fullwidth.php' ) ? 1170 : 770;

	if ( is_singular( ) && has_post_thumbnail( $post -> ID ) && ($image = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ), 'post-thumbnail' )) && $image[1] >= $minsize ) {
		$imgsize = is_page_template( 'page-fullwidth.php' ) ? 'featured_fullwidth' : 'featured_large';

		$html = "\t\t" . '<div class="featured-image">' . "\n";
		$html .= "\t\t\t" . get_the_post_thumbnail( $post -> ID, $imgsize ) . "\n";
		$html .= "\t\t" . '</div>' . "\n";

		echo $html;
	}
}

add_action( 'up2mist_before_post', 'up2mist_featured_image' );

function up2mist_header_image() {
	$header_image = get_header_image( );
	if ( ! empty( $header_image ) ) {
		$html = '<div id="header-image" class="clearfix">' . "\n";
		$html .= '<a href="' . esc_url( home_url( '/' ) ) . '">';
		$html .= '<img src="' . esc_url( $header_image ) . '" alt="">';
		$html .= '</a>' . "\n";
		$html .= '</div>' . "\n";

		echo $html;
	}
}

add_action( 'up2mist_inside_header', 'up2mist_header_image' );

function up2mist_img_caption_shortcode($output, $attr, $content = null) {

	// Allow plugins/themes to override the default caption template.
	//$output = apply_filters( 'img_caption_shortcode', '', $attr, $content );
	if ( $output != '' )
		return $output;

	extract( shortcode_atts( array(
		'id' => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	), $attr ) );

	if ( 1 > (int)$width || empty( $caption ) )
		return $content;

	if ( $id )
		$id = 'id="' . esc_attr( $id ) . '" ';

	$output = '<div ' . $id . 'class="wp-caption ' . esc_attr( $align ) . '" style="width: ' . (int)$width . 'px">' . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';

	return $output;
}

add_filter( 'img_caption_shortcode', 'up2mist_img_caption_shortcode', 10, 3 );

function up2mist_get_attachment_link($html) {
	$html = str_replace( '<a', '<a class="thumbnail"', $html );
	return $html;
	//return apply_filters( 'wp_get_attachment_link', "<a href='$url' title='$post_title'>$link_text</a>", $id, $size, $permalink, $icon, $text );
}

add_filter( 'wp_get_attachment_link', 'up2mist_get_attachment_link', 10, 1 );

function up2mist_body_classes($classes) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( UP2MIST_NAVCLASS == 'navbar navbar-fixed-top' ) {
		$classes[] = 'navbar-fixed';
	}

	return $classes;
}

add_filter( 'body_class', 'up2mist_body_classes' );
?>
