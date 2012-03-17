<?php
/**
 * @package up2mist
 * @since up2mist 1.0
 */
?>

			<article id="post-<?php the_ID( );?>" <?php post_class( );?>>
				<?php up2mist_before_post( );?>
				<header class="page-header entry-header">
					<h1 class="entry-title"><?php the_title( );?></h1>
					<div class="entry-meta clearfix">
						<?php up2mist_posted_on( );?>
					</div><!-- .entry-meta -->
				</header><!-- .entry-header -->
				<div class="entry-content clearfix">
					<?php the_content( );?>
					<?php wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'up2mist' ),
							'after' => '</div>'
						) );
					?>
				</div><!-- .entry-content -->
				<footer class="entry-meta clearfix">
					<?php
					/* translators: used between list items, there is a space after the comma */
					$category_list = get_the_category_list( __( ', ', 'up2mist' ) );
					/* translators: used between list items, there is a space after the comma */
					$tag_list = get_the_tag_list( '', ', ' );
			
					if ( '' != $category_list ) {
						// This blog only has 1 category so we just need to worry about tags in the meta text
						if ( '' != $tag_list ) {
							$out = '<i class="icon-tag"></i>' . "\n";
							;
							$out .= $tag_list . "\n";
							;
							$out .= '<i class="icon-bookmark"></i>' . "\n";
							;
							$out .= '<a href="' . get_permalink( ) . '" title="Permalink to ' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">permalink</a>' . "\n";
							;
						} else {
							$out = '<i class="icon-bookmark"></i>' . "\n";
							;
							$out .= '<a href="' . get_permalink( ) . '" title="Permalink to ' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">permalink</a>' . "\n";
							;
						}
			
					} else {
						// But this blog has loads of categories so we should probably display them here
						if ( '' != $tag_list ) {
							$out = '<i class="icon-flag"></i>' . "\n";
							;
							$out .= $category_list . "\n";
							;
							$out .= '<i class="icon-tags"></i>' . "\n";
							;
							$out .= $tag_list . "\n";
							;
							$out .= '<i class="icon-bookmark"></i>' . "\n";
							;
							$out .= '<a href="' . get_permalink( ) . '" title="Permalink to ' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">permalink</a>' . "\n";
							;
						} else {
							$out = '<i class="icon-flag"></i>' . "\n";
							;
							$out .= $category_list . "\n";
							;
							$out .= '<i class="icon-bookmark"></i>' . "\n";
							;
							$out .= '<a href="' . get_permalink( ) . '" title="Permalink to ' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">permalink</a>' . "\n";
							;
						}
					}// end check for categories on this blog
					echo $out;
			
					if ( get_edit_post_link( ) )
						echo '<a href="' . get_edit_post_link( ) . '" class="btn pull-right edit-link">' . '<i class="icon-pencil"></i>' . __( 'Edit', 'up2mist' ) . '</a>';
					?>
				</footer><!-- .entry-meta -->
			</article><!-- #post-<?php the_ID(); ?> -->
