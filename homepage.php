<?php
/**
 * The Homepage template file.
 Template Name: Homepage
 *
 * @package up2mist
 * @since up2mist 1.0
 */

get_header( );
?>

	<div id="primary" class="<?php echo UP2MIST_PRIMARY;?> site-content">
		<div id="content" role="main">
		<?php 
		query_posts('post_type=post&order=DESC&orderby=date&posts_per_page=1');
		if ( have_posts() ) :
		?>

		<?php /* Start the Loop */?>
		<?php while ( have_posts() ) : the_post();
		?>
		<section class="hero-unit">
			<article class="row">
				<div class='span3'>
					<?php the_post_thumbnail() ?>
				</div>
				<div class='span3'>
					<h2><?php the_title() ?></h2>
					<p><?php the_excerpt() ?></p>
					<p>
					<a class="btn btn-primary btn-large">
					Read the post
					</a>
					</p>
				</div>
			</article>
		</section>
		<?php endwhile; wp_reset_postdata(); ?>
		
		<section class='row tools'>
		<?php 
		query_posts('post_type=tool&order=DESC&orderby=date&posts_per_page=10');
		if ( have_posts() ) while ( have_posts() ) : the_post(); 
		?>
		<article class="span2">
			<div class='thumbnail'>
				<a href="<?php the_permalink(); ?>">
				<img src="<?php print_custom_field('logo:to_image_src'); ?>" />
				</a>
				<h3><?php the_title(); ?></h3>
				<p><?php print_custom_field('headline'); ?></p>
			</div>
		</article>
		<?php endwhile;?>
		</section>

		<?php up2mist_content_nav( );?>

		<?php endif;?>
		</div><!-- #content -->
	</div><!-- #primary .site-content -->
<?php get_sidebar( );?>
<?php get_footer( );?>
