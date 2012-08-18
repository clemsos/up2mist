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
		
		
		<div id="topgroup" class="row">
		
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
		<section id="latest-report" class="span2">
		
		<?php while ( have_posts() ) : the_post(); 
		?>
		<article>

			<header class="titlebox">
			<a href="<?php bloginfo('url') ?>/reports">Reports
				<small> More</small>
			</a>
			<div class="btn-group span2">
			
			</header>
			<h3><a href="<?php the_permalink() ?>"><?php the_title()?></a></h3>
			<div class="post-content">
				<?php the_excerpt() ?></div>
			
			
			<a href="<?php the_permalink(); ?>" class="btn btn-primary">Read</a>
		        <?php if ( get_custom_field('reportpdf')): ?>
		        <a href="<?php echo get_custom_field('reportpdf') ?>" class="btn btn-success">Download</a>
		        <?php endif; ?>
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
		<section id="featured" class="span6 carousel">
		<div class="carousel-inner">
		
		<?php /* Start the Loop */?>
		<?php while ( have_posts() ) : the_post();
		?>
		<article class="item <?php if($i==0) echo 'active'?> hero-unit slide">
			<div class="row">
				
				<?php 
				if ( has_post_thumbnail() ) {
						echo '<div class="span3">'. get_the_post_thumbnail() .'</div>';
					} else {
						echo '<div class="span6 hasthumb">';
					} 
				?>	

				<div class="<?php if( has_post_thumbnail() ) echo span3 ?> text">
				
				<header class="page-header entry-header">
				<h1>
				<a href="<?php the_permalink( );?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'up2mist' ), the_title_attribute( 'echo=0' ) );?>" rel="bookmark"><?php the_title( );?></a>
				</h1>
				
				<h6 class="post-category"><?php the_category(' / '); ?>
				<span><em>&bull; </em><span>
				<span class="post-meta">
				        <span class="post-author">
				        <a
                    href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="Posts by <?php the_author(); ?>"><?php the_author(); ?>
                                        </a>
                                        </span>
                                        <em>&bull; </em>
                                        <span
                        class="post-date"><?php the_time(__('M j, Y')) ?>
                                        </span>
                                </span>
                                </h6>
            		        
			</header>
				
				
				
				<p><?php the_excerpt() ?></p>
				
				<?php 
				if ( !has_post_thumbnail() ) {
		        		// echo '<a href="' . get_permalink() .'" class="btn btn-info alert alert-info">Read the post</a>';
		        		echo '<div class="clear"></div>';
		        		echo '</div>'; 
		        	} ?>
			</div><!--span -->
			</div><!--row -->
		</article>
		<?php $i++ ?>
		<?php endwhile; wp_reset_postdata(); ?>
		</div><!--carousel-inner -->
		<!-- Carousel nav -->
		  <a class="carousel-control left rounded" href="#featured" data-slide="prev">&lsaquo;</a>
		  <a class="carousel-control right rounded" href="#featured" data-slide="next">&rsaquo;</a>
		</section>
		<?php endif; ?>
		
		</div>


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
		
		<div id="toolstrip"></div>
		<section id="tools" class="carousel">
		
		<header>
		<div class="">
		        <a href="<?php bloginfo('url')/tools ?> ">Tools <small>  Browse collection</small></a>
		</div>
		</header>
		<div class="carousel-inner">
		
		
		<?php while ( have_posts() ) : the_post(); 
		?>
		
		<?php 
		// add carousel item every 4 
		$close = 0;
		if($j==0)  {
			echo '<div class="item active row slide">';
		} elseif ($j == 4 || $j == 8 || $j == 12 || $j == 16 ) {
			echo '</div>';
			echo '<div class="item row slide">';
			$close =1;
		}
		?>
		<article class="span2 shadowed">
				<a class="tool" 
				href="<?php the_permalink(); ?>"
				rel="popover" 
				data-content="<?php print_custom_field('headline'); ?>"
				data-original-title="<i class='icon-eye-open'></i>  <?php the_title(); ?>">
				  <?php if( get_custom_field("logo") ) {
				  	echo '<img src="';
				  	print_custom_field('logo:to_image_src') ;
				  	echo '" />';
				  } else {
				  	echo '<img src="http://placehold.it/350x350" />';
				  }
				  ?>

				</a>
				<div class="titlebox">
				        <h3>
				                <a href="<?php the_permalink(); ?>">
				                         <?php the_title(); ?>
				                </a>
				        </h3>
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
		<section id="recent" class="span7 row">
			
			<div class="">

			<?php
			// second query to build content
			$i=0;
			query_posts($args);
			if ( have_posts() ) while ( have_posts() ) : the_post(); 
			?>

			
			<article id="post-<?php the_ID( );?>" <?php post_class( $myclass." shawdowbox" ); ?> >
			<header class="page-header entry-header">
				<h6 class="post-category"><?php the_category(' / '); ?>
				<div class="post-meta"><span class="post-author"><a
                    href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="Posts by <?php the_author(); ?>"><?php the_author(); ?></a></span>
                                   <em>&bull; </em><span
                        class="post-date"><?php the_time(__('M j, Y')) ?></span>
            </div>
            </h6>
            		<h2>
				<a href="<?php the_permalink( );?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'up2mist' ), the_title_attribute( 'echo=0' ) );?>" rel="bookmark"><?php the_title( );?></a>
			</h2>
			</header>

			<div class="post-content">
				<?php the_excerpt()?>
				<button href="<?php the_permalink() ?>" class="btn btn-primary alert alert-info">Read</button>
				<div class="clear"><div>
			</div>
			</article>
			<?php 
			$i++;
			endwhile;?>
			</div><!-- class-content -->
		</section>
		
		

		
		<section class="span2">
			<header class="page-header entry-header">
			<h6>Curated</h6>
			</header>
			<?php if ( ! dynamic_sidebar( 'home-curated' ) ) :?>
							<?php if ( current_user_can( 'edit_posts' ) ) :?>
							<?php printf( __( 'Please select some widgets for "Home (Curated)"<br /> <a href="%1$s">Get started here</a>.', 'up2mist' ), admin_url( 'widgets.php' ) );?>
							<?php endif; // end sidebar top?>
						<?php endif; // end sidebar top?>
		</section>

		</section>
		<?php up2mist_content_nav( );?>


		</div><!-- #content -->
	</div><!-- #primary .site-content -->
<?php get_sidebar( );?>
<?php get_footer( );?>
