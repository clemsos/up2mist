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
		// display latest report
		
		$args = array(
			'post_type'=>'report',
			'order'=>'DESC',
			'orderby'=>'date',
			'posts_per_page'=>1
		);
		query_posts($args);
		
		if ( have_posts() ) : 
		?>
		<section id="latest-report" class="alert alert-block">
		<a class="close" data-dismiss="alert">×</a>
		<?php while ( have_posts() ) : the_post(); 
		?>
		<article class="row">
			<div class="span5">
			
			<h3> 
				<strong>Read our last report : </strong>
				<a href="<?php the_permalink() ?>"><small><?php the_title()?> </small></a>
			</h3>
			</div>
			<div class="btn-group span2">
			<a href="<?php the_permalink(); ?>" class="btn btn-primary">Read</a>
		
		<?php if ( get_custom_field('reportpdf')): ?>
		<a href="<?php echo get_custom_field('reportpdf') ?>" class="btn btn-success">Download</a>
		<?php endif; ?>
			</div>
		</article>
		<?php endwhile; wp_reset_postdata(); ?>
		</section>
		<?php endif; ?>
		
		
		<?php
		// featured post carousel
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
		<section id="featured" class="carousel">
		<div class="carousel-inner">
		
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
				echo "<div class='span7'>";
			} ?>
				<h2><a href="<?php the_permalink() ; ?>"><?php the_title() ?></a></h2>
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
		<?php endif; ?>


		<?php
		// tools slideshow 
		$j =0;
		
		$args = array(
			'post_type'=>'tool',
			'order'=>'DESC',
			'orderby'=>'date',
			'posts_per_page'=>12
		);
		query_posts($args);
		
		if ( have_posts() ) : ?>
		
		<section id="tools" class="carousel">
		<div class="carousel-inner">
		
		
		<?php while ( have_posts() ) : the_post(); 
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
		$args = array(
			'post_type'=>'post',
			'order'=>'DESC',
			'orderby'=>'date',
			'posts_per_page'=>5,
			'meta_query' => array(
						array(
						    'key' => 'featured',
						    'value' => '0',
						    'compare' => 'LIKE'
						)
					)
		);
		
		query_posts($args);
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
