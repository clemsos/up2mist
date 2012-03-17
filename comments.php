<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to up2mist_comment() which is
 * located in the functions.php file.
 *
 * @package up2mist
 * @since up2mist 1.0
 */
?>
			<div id="comments" class="comments-area">
				<?php if ( post_password_required() ) :
				?>
				<p class="nopassword">
					<?php _e( 'This post is password protected. Enter the password to view any comments.', 'up2mist' );?>
				</p>
			</div><!-- #comments .comments-area -->
			<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
			endif;
				?>
			
				<?php // You can start editing here -- including this comment!?>
			
				<?php if ( have_comments() ) : ?>
					<h2 class="comments-title">
						<?php
						printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number( ), 'up2mist' ), number_format_i18n( get_comments_number( ) ), '<span>' . get_the_title( ) . '</span>' );
						?>
					</h2>
			
					<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
					<nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
						<h1 class="assistive-text"><?php _e( 'Comment navigation', 'up2mist' );?></h1>
						<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'up2mist' ) );?></div>
						<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'up2mist' ) );?></div>
					</nav>
					<?php endif; // check for comment navigation?>
			
					<ol class="commentlist">
						<?php
						/* Loop through and list the comments. Tell wp_list_comments()
						 * to use up2mist_comment() to format the comments.
						 * If you want to overload this in a child theme then you can
						 * define up2mist_comment() and that will be used instead.
						 * See up2mist_comment() in functions.php for more.
						 */
						wp_list_comments( array( 'callback' => 'up2mist_comment' ) );
						?>
					</ol>
			
					<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
					<nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
						<h1 class="assistive-text"><?php _e( 'Comment navigation', 'up2mist' );?></h1>
						<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'up2mist' ) );?></div>
						<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'up2mist' ) );?></div>
					</nav>
					<?php endif; // check for comment navigation?>
			
				<?php endif; // have_comments()?>
			
				<?php
					// If comments are closed and there are no comments, let's leave a little note, shall we?
					if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
			
			?>
			<div class="alert fade in nocomments">
				<a class="close" data-dismiss="alert" href="#">&times;</a>
				<?php _e( 'Comments are closed.', 'up2mist' );?>
			</div>
			<?php endif;?>
			
			<?php up2mist_comment_form( );?>
			
			</div><!-- #comments .comments-area -->
