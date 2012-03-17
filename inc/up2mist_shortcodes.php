<?php
/*
 * up2mist shortcodes
 */

function caption_shortcode($atts, $content = null) {
	extract( shortcode_atts( array( 'class' => 'caption', ), $atts ) );

	return '<span class="' . esc_attr( $class ) . '">' . $content . '</span>';
}

function up2mist_hero_unit($atts, $content = null) {

	$output = '<div class="hero-unit">' . "\n";
	$output .= $content . "\n";
	$output .= '</div>' . "\n";

	return $output;
}

add_shortcode( 'hero-unit', 'up2mist_hero_unit' );
?>
