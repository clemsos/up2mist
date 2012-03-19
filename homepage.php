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
				<div class='span5'>";
			} else {
				echo "<div class='span8'>";
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
		} elseif ($j == 3 || $j == 6 || $j == 9 || $j == 12 ) {
			echo '</div>';
			echo '<div class="item row slide">';
			$close =1;
		}
		?>
		<article class="span3">
				<a class='thumbnail tool' 
				href="<?php the_permalink(); ?>"
				rel="popover" 
				data-content="<?php print_custom_field('headline'); ?>"
				data-original-title="<i class='icon-eye-open'></i>  <?php the_title(); ?>">
				  <img src="<?php print_custom_field('logo:to_image_src'); ?>" />
				</a>
				
				
				
				<a href="<?php the_permalink() ?>">
				  <h5><i class="icon-eye-open"></i>  <?php the_title(); ?></h5>
				</a>
				<small></small>
			

			
			
			
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
		
		<section class="cols row">
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

		?>
		<section id="recent" class="span7 tabbable tabs-left row">
		
			<header class="page-header entry-header">
				<h6>Recent post</h6>
			</header>


			<ul id="recent-nav" class="span2 nav nav-tabs">
			
				<?php 
				//first query to build nav
				$i =0;
				query_posts($args);
				if ( have_posts() ) while ( have_posts() ) : the_post(); 
				?>
			
				<li class="tab">
				<a <?php if($i==0) echo'class="active"'?> data-toggle="tab" href="#post-<?php the_ID( );?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'up2mist' ), the_title_attribute( 'echo=0' ) );?>" rel="bookmark"><?php the_title( );?></a>
				</li>
				<?php
				$i++;
				 endwhile; wp_reset_postdata(); ?>
			</ul>
			
			<div class="tab-content span4 ">

			<?php
			// second query to build content
			$i=0;
			query_posts($args);
			if ( have_posts() ) while ( have_posts() ) : the_post(); 
			
			?>
			<?php 
			$myclass='tab-pane';
			if($i==0) $myclass="tab-pane active"; ?>
			
			<article id="post-<?php the_ID( );?>" <?php post_class( $myclass); ?> >
				
				<h3>
					<a class="toggle" href="#collapse-<?php the_ID( );?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'up2mist' ), the_title_attribute( 'echo=0' ) );?>" rel="bookmark"><?php the_title( );?></a>
				</h3>
				<?php the_excerpt()?>
				<button href="<?php the_permalink() ?>" class="btn btn-primary">Read</button>
				
			</article>
			<?php 
			$i++;
			endwhile;?>
			</div><!-- class-content -->
		</section>
		
		

		
		<section class="span2">
			<header class="page-header entry-header">
			<h6>Other updates</h6>
			</header>
			<small>Here can go some updates or important announcement</small>
		</section>

		</section>
		<?php up2mist_content_nav( );?>


		</div><!-- #content -->
	</div><!-- #primary .site-content -->
<?php get_sidebar( );?>
<?php get_footer( );?>
