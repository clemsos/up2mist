<?php
/*
 * Template for displaying full width pages
 *
 * Template Name: Full Width
 */
get_header( );
?>

			<div id="primary" class="<?php echo UP2MIST_FULLWIDTH;?> site-content">
				<div id="content" role="main">
					<?php while ( have_posts() ) : the_post();
					?>
			
					<?php get_template_part( 'content', 'page' );?>
			
					<?php comments_template( '', true );?>
			
					<?php endwhile; // end of the loop.?>
				</div><!-- #content -->
			</div><!-- #primary .site-content -->
<?php get_footer( );?>
