<?php
/**
 * The template for displaying image attachments.
 *
 * @package up2mist
 * @since up2mist 1.0
 */

get_header( );
?>

			<div id="primary" class="<?php echo UP2MIST_PRIMARY;?> offset2 site-content image-attachment">
				<div id="content" role="main">
					<?php while ( have_posts() ) : the_post();
					?>
			
					<article id="post-<?php the_ID( );?>" <?php post_class( );?>>
						<header class="page-header entry-header">
							<h1 class="entry-title"><?php the_title( );?></h1>
							<div class="entry-meta">
								<?php
								$metadata = wp_get_attachment_metadata( );
								?>
								<span class="entry-date"> <i class="icon-calendar" title="<?php echo __( 'Published', 'up2mist' );?>"></i>
									<time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) );?>" pubdate>
										<?php echo esc_html( get_the_date( ) );?>
									</time> </span>
								<span class="entry-size"> <i class="icon-picture" title="<?php echo __( 'at', 'up2mist' );?>"></i> <a href="<?php echo wp_get_attachment_url( );?>" title="Link to full-size image"><?php echo $metadata['width'];?>&times; <?php echo $metadata['height'];?></a> </span>
								<span class="entry-gallery"> <i class="icon-info-sign" title="<?php echo __( 'in', 'up2mist' );?>"></i> <a href="<?php echo get_permalink( $post -> post_parent );?>" title="Return to <?php echo get_the_title( $post -> post_parent );?>" rel="gallery"><?php echo get_the_title( $post -> post_parent );?></a> </span>
							</div><!-- .entry-meta -->
						</header><!-- .entry-header -->
						<nav id="image-navigation">
							<ul class="pager">
								<li class="previous previous-image">
									<?php previous_image_link( false, __( '&larr; Previous', 'up2mist' ) );?>
								</li>
								<li class="next next-image">
									<?php next_image_link( false, __( 'Next &rarr;', 'up2mist' ) );?>
								</li>
							</ul>
						</nav><!-- #image-navigation -->
						<div class="entry-content clearfix">
							<div class="entry-attachment">
								<div class="attachment">
									<?php
									/**
									 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
									 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
									 */
									$attachments = array_values( get_children( array(
										'post_parent' => $post -> post_parent,
										'post_status' => 'inherit',
										'post_type' => 'attachment',
										'post_mime_type' => 'image',
										'order' => 'ASC',
										'orderby' => 'menu_order ID'
									) ) );
									foreach ( $attachments as $k => $attachment ) {
										if ( $attachment -> ID == $post -> ID )
											break;
									}
									$k++;
									// If there is more than 1 attachment in a gallery
									if ( count( $attachments ) > 1 ) {
										if ( isset( $attachments[$k] ) )
											// get the URL of the next image attachment
											$next_attachment_url = get_attachment_link( $attachments[$k] -> ID );
										else
											// or get the URL of the first image attachment
											$next_attachment_url = get_attachment_link( $attachments[0] -> ID );
									} else {
										// or, if there's only 1 image, get the URL of the image
										$next_attachment_url = wp_get_attachment_url( );
									}
									?>
			
									<a href="<?php echo $next_attachment_url;?>" title="<?php echo esc_attr( get_the_title( ) );?>" rel="attachment"><?php
									$attachment_size = apply_filters( 'up2mist_attachment_size', 1200 );
									echo wp_get_attachment_image( $post -> ID, array(
										$attachment_size,
										$attachment_size
									) );
									// filterable image width with, essentially, no limit for image height.
									?></a>
								</div><!-- .attachment -->
								<?php if ( ! empty( $post->post_excerpt ) ) :
								?>
								<div class="entry-caption">
									<?php the_excerpt( );?>
								</div>
								<?php endif;?>
							</div><!-- .entry-attachment -->
							<?php the_content( );?>
							<?php wp_link_pages( array(
									'before' => '<div class="page-links">' . __( 'Pages:', 'up2mist' ),
									'after' => '</div>'
								) );
							?>
						</div><!-- .entry-content -->
						<footer class="entry-meta">
							<?php if ( comments_open() && pings_open() ) : // Comments and trackbacks open
							?>
							<?php printf( __( '<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a> or leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'up2mist' ), get_trackback_url( ) );?>
							<?php elseif ( ! comments_open() && pings_open() ) : // Only trackbacks open?>
							<?php printf( __( 'Comments are closed, but you can leave a trackback: <a class="trackback-link" href="%s" title="Trackback URL for your post" rel="trackback">Trackback URL</a>.', 'up2mist' ), get_trackback_url( ) );?>
							<?php elseif ( comments_open() && ! pings_open() ) : // Only comments open?>
							<?php _e( 'Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Post a comment">post a comment</a>.', 'up2mist' );?>
							<?php elseif ( ! comments_open() && ! pings_open() ) : // Comments and trackbacks closed?>
							<?php _e( 'Both comments and trackbacks are currently closed.', 'up2mist' );?>
							<?php endif;?>
							<?php
							if ( get_edit_post_link( ) )
								echo '<a href="' . get_edit_post_link( ) . '" class="btn pull-right edit-link">' . '<i class="icon-pencil"></i>' . __( 'Edit', 'up2mist' ) . '</a>';
							?>
						</footer><!-- .entry-meta -->
					</article><!-- #post-<?php the_ID(); ?> -->
					<?php comments_template( );?>
			
					<?php endwhile; // end of the loop.?>
				</div><!-- #content -->
			</div><!-- #primary .site-content -->
<?php get_footer( );?>
