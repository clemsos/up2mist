<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package up2mist
 * @since up2mist 1.0
 */
?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes( );?>>
	<!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' );?>">
		<meta name="viewport" content="width=device-width">
		<title><?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;

		wp_title( '|', true, 'right' );

		// Add the blog name.
		bloginfo( 'name' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && (is_home( ) || is_front_page( )) )
			echo " | $site_description";

		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'up2mist' ), max( $paged, $page ) );
			?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" >
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' );?>">
		<?php up2mist_load_styleheets( );?>
		<?php wp_head( );?>
	</head>
	<body <?php body_class( );?>>
		<?php up2mist_before_page( );?>
		<div id="page" class="rounded-corners container hfeed site">
			<?php up2mist_before_header( );?>
			<header id="masthead" class="site-header" role="banner">
			<a class="branding" href="<?php echo home_url( );?>/"> <?php bloginfo( 'name' );?></a>
				<div class="navbar-fixed-top navbar <?php echo UP2MIST_NAVCLASS; ?>">
					<div class="navbar-inner">
						<div class="container">
							<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span></a>
							<a class="brand" href="<?php echo home_url( );?>/"> <?php bloginfo( 'name' );?></a>
							<nav role="navigation" class="nav-collapse site-navigation main-navigation pull-right">
								<?php wp_nav_menu( array(
									'theme_location' => 'primary',
									'container' => false,
									'items_wrap' => '<ul id="%1$s" class="nav %2$s">%3$s</ul>',
									'walker' => new Fabric_Nav_Walker()
								) );
								?>
							<span class="pull-right">
							<?php do_action('icl_language_selector'); ?>
							</span>
							</nav>


						</div>
					</div>
				</div><!-- .navbar -->
				<?php up2mist_inside_header( );?>
			</header><!-- #masthead .site-header -->
			<?php up2mist_before_main( );?>
			<div id="main" class="row">
