<?php
/**
 * The page template to display all reports.
 *
Template Name: Reports
 *
 * @package up2mist
 * @since up2mist 1.0
 */

get_header( );
?>

<div id="primary" class="<?php echo UP2MIST_PRIMARY;?> site-content">
	<div id="content" role="main">
	<?php 
	$args = array(
			'post_type'=>'report',
			'order'=>'DESC',
			'orderby'=>'date',
			'posts_per_page'=>12
		);
	query_posts($args);
	$i =0;
	
	if ( have_posts() ) :
	while ( have_posts() ) : the_post(); 
	?>
	
		
	

	<article class="report <?php if ($i == 0)  echo 'report-lead hero-unit'?>" >
		<header class="page-header entry-header">
			<h1><?php the_title( );?></h1>
		</header><!-- .entry-header -->
		   <?php the_excerpt() ?>
		<footer class="row">
		<div class="btn-group span2">
		<a href="<?php the_permalink(); ?>" class="btn btn-primary <?php if ($i == 0)  echo 'btn-large'?>">Read</a>
		
		<?php if ( get_custom_field('reportpdf')): ?>
			<a href="<?php echo get_custom_field('reportpdf') ?>" class="btn btn-success <?php if ($i == 0)  echo 'btn-large'?>">Download</a>
		<?php endif; // end if download button?>
		</div>
		</footer>

	</article>
	
	<?php $i++ ?>
	<?php endwhile;?>

	<?php up2mist_content_nav( );?>

	<?php elseif ( current_user_can( 'edit_posts' ) ) :?>

	<article id="post-0" class="post no-results not-found">
		<header class="page-header entry-header">
			<h1 class="entry-title"><?php _e( 'No posts to display', 'up2mist' );?></h1>
		</header><!-- .entry-header -->
		<div class="entry-content clearfix">
			<p>
				<?php printf( __( 'Ready to publish your first report? <a href="%1$s">Get started here</a>.', 'up2mist' ), admin_url( 'post-new.php?post_type=report' ) );?>
			</p>
		</div><!-- .entry-content -->
	</article><!-- #post-0 -->
	<?php endif;?>
</div><!-- #content -->
</div><!-- #primary .site-content -->
<?php get_sidebar( );?>
<?php get_footer( );?>
