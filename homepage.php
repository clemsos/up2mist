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
		
		<section id="featured" class="carousel">
		<div class="carousel-inner">
		
		<?php
		
		$i =0;
		$args = array(
			'post_type'=>'post',
			'order'=>'DESC',
			'orderby'=>'date',
			'posts_per_page'=>3,
			'meta_query' => array(
						array(
						    'key' => 'featured',
						    'value' => '1',
						    'compare' => 'LIKE'
						)
					)
		);
		
		 query_posts($args);
		
		if ( have_posts() ) :
		?>

		<?php /* Start the Loop */?>
		<?php while ( have_posts() ) : the_post();
		?>
		<article class="item <?php if($i==0) echo 'active'?> hero-unit slide">
			<div class="row">
			<?php 
			if(get_the_post_thumbnail()) {
				echo "
				<div class='span3'>" 
				. get_the_post_thumbnail() .
				"</div>
				<div class='span4'>";
			} else {
				echo "<div class='span6'>";
			} ?>
				<h2><?php the_title() ?></h2>
				<p><?php the_excerpt() ?></p>
				<p>
				<a href="<?php the_permalink() ?>" class="btn btn-info btn-large">
				Read the post
				</a>
				</p>
			</div><!--span -->
			</div><!--row -->
		</article>
		<?php $i++ ?>
		<?php endwhile; wp_reset_postdata(); ?>
		</div><!--carousel-inner -->
		<!-- Carousel nav -->
		  <a class="carousel-control left" href="#featured" data-slide="prev">&lsaquo;</a>
		  <a class="carousel-control right" href="#featured" data-slide="next">&rsaquo;</a>
		</section>
		
		
		<section id="tools" class="carousel">
		<div class="carousel-inner">
		<?php
		$j =0;
		
		$args = array(
			'post_type'=>'tool',
			'order'=>'DESC',
			'orderby'=>'date',
			'posts_per_page'=>12
		);
		query_posts($args);
		
		if ( have_posts() ) while ( have_posts() ) : the_post(); 
		?>
		
		<?php 
		// add carousel item every 4 
		$close = 0;
		if($j==0)  {
			echo '<div class="item active row slide">';
		} elseif ($j == 4 || $j == 8 || $j == 12 ) {
			echo '</div>';
			echo '<div class="item row slide">';
			$close =1;
		}
		?>
		<article class="span2">
			<div class='thumbnail'>
				<a href="<?php the_permalink(); ?>">
				  <img src="<?php print_custom_field('logo:to_image_src'); ?>" />
				</a>
				<a href="<?php the_permalink() ?>">
				  <h5><i class="icon-eye-open"></i>  <?php the_title(); ?></h5>
				</a>
				<small><?php print_custom_field('headline'); ?></small>
			

			</div>
			
			
		</article>
		<?php $j++ ?>
		<?php endwhile; wp_reset_postdata(); ?>
		<?php endif; ?>
		</div><!-- close final div -->
		</div><!-- Inner Carousel -->
		<!-- Carousel nav -->
		<a class="carousel-control left" href="#tools" data-slide="prev">&lsaquo;</a>
		<a class="carousel-control right" href="#tools" data-slide="next">&rsaquo;</a>
		</section>
		
		<section class="posts">
		<?php 
		query_posts('post_type=post&order=DESC&orderby=date&posts_per_page=4');
		if ( have_posts() ) while ( have_posts() ) : the_post(); 
		?>

		<?php
		get_template_part( 'content', get_post_format( ) );
		?>

		<?php endwhile;?>
		</section>
		<?php up2mist_content_nav( );?>


		</div><!-- #content -->
	</div><!-- #primary .site-content -->
<?php get_sidebar( );?>
<?php get_footer( );?>
