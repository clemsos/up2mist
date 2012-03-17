<?php
/*
 * up2mist theme hooks
 */

/* Hooks located in header.php */
function up2mist_stylesheets() {
	do_action( 'up2mist_stylesheets' );
}

function up2mist_before_page() {
	do_action( 'up2mist_before_page' );
}

function up2mist_before_header() {
	do_action( 'up2mist_before_header' );
}

function up2mist_inside_header() {
	do_action( 'up2mist_inside_header' );
}

function up2mist_before_main() {
	do_action( 'up2mist_before_main' );
}

/* Hooks located in content files */
function up2mist_before_post() {
	do_action( 'up2mist_before_post' );
}

/* Hooks located in footer.php */
function up2mist_footer_inside() {
	do_action( 'up2mist_footer_inside' );
}
?>
