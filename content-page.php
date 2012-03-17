<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package up2mist
 * @since up2mist 1.0
 */
?>

			<article id="post-<?php the_ID( );?>" <?php post_class( );?>>
				<?php up2mist_before_post( );?>
				<header class="page-header entry-header">
					<h1 class="entry-title"><?php the_title( );?></h1>
				</header><!-- .entry-header -->
				<div class="entry-content clearfix">
					<?php the_content( );?>
					<?php wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'up2mist' ),
							'after' => '</div>'
						) );
					?>
					<?php
					if ( get_edit_post_link( ) )
						echo '<a href="' . get_edit_post_link( ) . '" class="btn pull-right edit-link">' . '<i class="icon-pencil"></i>' . __( 'Edit', 'up2mist' ) . '</a>';
					?>
				</div><!-- .entry-content -->
			</article><!-- #post-<?php the_ID(); ?> -->
