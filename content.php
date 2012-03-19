<?php
/**
 * @package up2mist
 * @since up2mist 1.0
 */
?>

			<article id="post-<?php the_ID( );?>" <?php post_class( );?>>
				<?php up2mist_before_post( );?>
				<header class="page-header entry-header">
					<h1 class="entry-title"><a href="<?php the_permalink( );?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'up2mist' ), the_title_attribute( 'echo=0' ) );?>" rel="bookmark"><?php the_title( );?></a></h1>
					<?php if ( 'post' == get_post_type() ) :
					?>
					<div class="entry-meta clearfix">
						<?php up2mist_posted_on( );?>
					</div><!-- .entry-meta -->
					<?php endif;?>
					
				</header><!-- .entry-header -->
				<?php if ( is_search() || is_home()) : // Only display Excerpts for Search
				?>
				<div class="entry-summary">
					<?php the_excerpt( );?>
				</div><!-- .entry-summary -->
				
				<?php elseif ( 'report' == get_post_type() ):
				?>

				<?php  if(get_custom_field('reportpdf')) : ?>
					<div class="hero-unit">
					  <h2>Get the full report here</h2>
					   <?php the_excerpt() ?>
					    <a href="<?php echo get_custom_field('reportpdf') ?>" class="btn btn-success btn-large">
					      Download
					    </a>
					  </p>
					</div>
				<?php endif;?>
				
				<?php else :?>
				<div class="entry-content clearfix">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'up2mist' ) );?>
					<?php wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'up2mist' ),
							'after' => '</div>'
						) );
					?>
				</div><!-- .entry-content -->
				<?php endif;?>
			
				<footer class="entry-meta clearfix">
					<?php
					if ( 'post' == get_post_type( ) ) {// Hide category and tag text for pages on Search
						/* translators: used between list items, there is a space after the comma */
						$categories_list = get_the_category_list( __( ', ', 'up2mist' ) );
			
						if ( $categories_list ) {
							echo '<i class="icon-flag"></i>' . "\n";
							echo "\t" . $categories_list . "\n";
						}// End if categories
			
						/* translators: used between list items, there is a space after the comma */
						$tags_list = get_the_tag_list( '', __( ', ', 'up2mist' ) );
						if ( $tags_list ) {
							echo '<i class="icon-tag"></i>' . "\n";
							;
							echo "\t" . $tags_list . "\n";
						} // End if $tags_list
					}// End if 'post' == get_post_type()
			
					if ( comments_open( ) || ('0' != get_comments_number( ) && ! comments_open( )) ) {
						echo '<i class="icon-comment"></i>' . "\n";
						;
						comments_popup_link( __( 'Leave a comment', 'up2mist' ), __( '1 Comment', 'up2mist' ), __( '% Comments', 'up2mist' ) );
					}
			
					if ( get_edit_post_link( ) )
						echo '<a href="' . get_edit_post_link( ) . '" class="btn pull-right edit-link">' . '<i class="icon-pencil"></i>' . __( 'Edit', 'up2mist' ) . '</a>';
					?>
				</footer><!-- #entry-meta -->
			</article><!-- #post-<?php the_ID(); ?> -->
