<?php
/*
 * up2mist templates
 */

/*
 * up2mist page navigation
 */
function up2mist_content_nav($before = false, $after = false) {
    global $wpdb, $wp_query;

    if ( is_home( ) || is_archive( ) || is_search( ) ) {
        $request = $wp_query -> request;
        $posts_per_page = intval( get_query_var( 'posts_per_page' ) );
        $paged = intval( get_query_var( 'paged' ) );
        $numposts = $wp_query -> found_posts;
        $max_page = $wp_query -> max_num_pages;
        if ( $numposts <= $posts_per_page ) {
            return;
        }
        if ( empty( $paged ) || $paged == 0 ) {
            $paged = 1;
        }
        $pages_to_show = 7;
        $pages_to_show_minus_1 = $pages_to_show - 1;
        $half_page_start = floor( $pages_to_show_minus_1 / 2 );
        $half_page_end = ceil( $pages_to_show_minus_1 / 2 );
        $start_page = $paged - $half_page_start;
        if ( $start_page <= 0 ) {
            $start_page = 1;
        }
        $end_page = $paged + $half_page_end;
        if ( ($end_page - $start_page) != $pages_to_show_minus_1 ) {
            $end_page = $start_page + $pages_to_show_minus_1;
        }
        if ( $end_page > $max_page ) {
            $start_page = $max_page - $pages_to_show_minus_1;
            $end_page = $max_page;
        }
        if ( $start_page <= 0 ) {
            $start_page = 1;
        }
        
        echo '<nav id="post-pagination" class="pagination">' . "\n";
        echo $before;

        echo '<ul>' . "\n";
        if ( $paged > 1 ) {
            $first_page_text = "&laquo";
            echo "\t" . '<li class="prev">' . "\n";
            echo "\t\t" . '<a href="' . get_pagenum_link( ) . '" title="First">' . $first_page_text . '</a>' . "\n";
            echo "\t" . '</li>' . "\n";
        }

        $prevposts = get_previous_posts_link( '&larr; Previous' );
        
        if ( $prevposts ) {
            echo "\t" . '<li>' . $prevposts . '</li>' . "\n";
        } else {
            echo "\t" . '<li class="disabled">' . "\n";
            echo "\t\t" . '<a href="#">&larr; Previous</a>' . "\n";
            echo "\t" . '</li>' . "\n";
        }

        for ( $i = $start_page; $i <= $end_page; $i++ ) {
            if ( $i == $paged ) {
                echo "\t" . '<li class="active">' . "\n";
                echo "\t\t" . '<a href="#">' . $i . '</a>' . "\n";
                echo "\t" . '</li>' . "\n";
            } else {
                echo "\t" . '<li>' . "\n";
                echo "\t\t" . '<a href="' . get_pagenum_link( $i ) . '">' . $i . '</a>' . "\n";
                echo "\t" . '</li>' . "\n";
            }
        }
        echo "\t" . '<li class="next">' . "\n";
        next_posts_link( 'Next &rarr;' );
        echo "\t" . '</li>' . "\n";
        if ( $end_page < $max_page ) {
            $last_page_text = "&raquo;";
            echo "\t" . '<li class="next">' . "\n";
            echo "\t\t" . '<a href="' . get_pagenum_link( $max_page ) . '" title="Last">' . $last_page_text . '</a>' . "\n";
            echo "\t" . '</li>' . "\n";
        }
        echo '</ul>' . "\n";
        echo $after . "\n";
        echo '</nav>' . "\n";
    } elseif ( is_single( ) ) {
        echo '<nav id="post-navigation">' . "\n";
        echo $before . "\n";
        echo '<ul class="pager">' . "\n";
        previous_post_link( "\t" . '<li class="previous">%link</li>' . "\n", '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'up2mist' ) . '</span> %title' );
        next_post_link( "\t" . '<li class="next">%link</li>' . "\n", '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'up2mist' ) . '</span>' );
        echo '</ul>' . "\n";
        echo $after . "\n";
        echo '</nav>' . "\n";
    }
}

/*
 * Prints HTML with meta information for the current post-date/time and author.
 */
function up2mist_posted_on() {
    //printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'up2mist' ), esc_url( get_permalink( ) ), esc_attr( get_the_time( ) ), esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date( ) ), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_attr( sprintf( __( 'View all posts by %s', 'up2mist' ), get_the_author( ) ) ), esc_html( get_the_author( ) ) );

    $html = "\t" . '<i class="icon-calendar"></i>' . "\n";
    $html .= "\t" . '<a href="' . get_permalink( ) . '" title="' . get_the_time( ) . '" rel="bookmark"><time class="entry-date" datetime="' . get_the_date( 'c' ) . '" pubdate>' . esc_html( get_the_date( ) ) . '</time></a>' . "\n";
    $html .= "\t" . '<i class="icon-user"></i>' . "\n";
    $html .= "\t" . '<span class="author vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" title="' . __( 'View all posts by ', 'up2mist' ) . get_the_author( ) . '" rel="author">' . get_the_author( ) . '</a></span>' . "\n";

    echo $html;
}

/*
 * Template for comments and pingbacks.
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function up2mist_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) {
        case 'pingback':
        case 'trackback':
            echo '<li class="post pingback">' . "\n";
            echo '<p>' . _e( 'Pingback:', 'up2mist' ) . comment_author_link( ) . edit_comment_link( __( '(Edit)', 'up2mist' ), ' ' ) . '</p>' . "\n";
            break;
        default:
            echo '<li ';
            comment_class( );
            echo ' id="li-comment-';
            comment_ID( );
            echo '">' . "\n";
            echo "\t" . '<article class="clearfix" id="comment-';
            comment_ID( );
            echo '" class="comment">' . "\n";
            echo "\t" . '<div class="comment-author vcard pull-left">' . "\n";
            echo "\t" . get_avatar( $comment, 80 );
            //printf( __( '%s <span class="says">says:</span>', 'up2mist' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link( ) ) );
            echo '</div><!-- .comment-author .vcard -->' . "\n";

            if ( $comment -> comment_approved == '0' ) {
                echo "\t" . '<div class="alert fade in">' . "\n";
                echo '<a class="close" data-dismiss="alert" href="#">&times;</a>' . "\n";
                echo __( 'Your comment is awaiting moderation.', 'up2mist' ) . "\n";
                echo '</div>' . "\n";
            }

            echo "\t" . '<div class="comment-meta commentmetadata">' . "\n";
            echo '<i class="icon-user"></i>' . "\n";
            echo '<cite class="fn">' . get_comment_author_link( ) . '</cite>' . "\n";
            echo '<i class="icon-calendar"></i>' . "\n";
            echo "\t" . '<a href="' . esc_url( get_comment_link( $comment -> comment_ID ) ) . '">' . "\n";
            echo "\t" . '<time pubdate datetime="';
            comment_time( 'c' );
            echo '">' . "\n";
            /* translators: 1: date, 2: time */
            printf( __( '%1$s at %2$s', 'up2mist' ), get_comment_date( ), get_comment_time( ) );

            echo "\t" . '</time></a>' . "\n";
            edit_comment_link( __( '(Edit)', 'up2mist' ), ' ' );
            echo "\t" . '</div><!-- .comment-meta .commentmetadata -->' . "\n";
            echo '<div class="comment-content">' . "\n";
            comment_text( );
            echo '</div>' . "\n";
            echo '<div class="reply">' . "\n";
            comment_reply_link( array_merge( $args, array(
                'depth' => $depth,
                'max_depth' => $args['max_depth']
            ) ) );
            echo '</div><!-- .reply -->' . "\n";
            echo '</article><!-- #comment-## -->' . "\n";
            break;
    }
}

/**
 * Outputs a complete commenting form for use within a template.
 */
function up2mist_comment_form($post_id = null) {
    global $id;

    if ( null === $post_id )
        $post_id = $id;
    else
        $id = $post_id;

    $commenter = wp_get_current_commenter( );
    $user = wp_get_current_user( );
    $user_identity = ! empty( $user -> ID ) ? $user -> display_name : '';

    $req = get_option( 'require_name_email' );
    $aria_req = ($req ? " aria-required='true'" : '');

    if ( comments_open( ) ) {
        do_action( 'comment_form_before' );
        echo '<div id="respond">' . "\n";
        if ( get_option( 'comment_registration' ) && ! is_user_logged_in( ) ) {
            //echo $args['must_log_in'];
            echo '<div class="alert fade in must-log-in">';
            echo '<a class="close" data-dismiss="alert" href="#">&times;</a>' . "\n";
            echo sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) );
            echo '</div>' . "\n";
            do_action( 'comment_form_must_log_in_after' );
			echo '</div><!-- #respond -->' . "\n";
        } else {
            echo '<form class="form-horizontal" action="' . site_url( '/wp-comments-post.php' ) . '" method="post" id="commentform">' . "\n";
            echo '<legend id="reply-title">';
            comment_form_title( __( 'Leave a Reply', 'up2mist' ), __( 'Leave a Reply to %s', 'up2mist' ) );
            echo '<small class="pull-right">';
            cancel_comment_reply_link( __( 'Cancel reply', 'up2mist' ) );
            echo '</small></legend>' . "\n";

            echo '<div class="alert alert-info fade in comment-notes">' . "\n";
            echo '<a class="close" data-dismiss="alert" href="#">&times;</a>' . "\n";
            echo __( 'Your email address will not be published.' );
            echo '</div>' . "\n";

            echo '<fieldset>' . "\n";
            do_action( 'comment_form_top' );
            if ( is_user_logged_in( ) ) {
                //echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );
                echo '<div class="logged-in-as">' . "\n";
                echo sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) );
                echo '</div>' . "\n";
                do_action( 'comment_form_logged_in_after', $commenter, $user_identity );
            } else {
                //echo $args['comment_notes_before'];
                do_action( 'comment_form_before_fields' );
                echo '<div class="control-group comment-form-author">' . "\n";
                echo '<label for="author">' . __( 'Name' ) . '</label> ' . "\n";
                echo '<input class="text span3" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' >' . "\n";
                echo($req ? '<span class="label label-info required">required</span>' : '');
                echo '</div>' . "\n";

                echo '<div class="control-group comment-form-email">' . "\n";
                echo '<label for="email">' . __( 'Email' ) . '</label> ' . "\n";
                echo '<input class="text span3" id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '"' . $aria_req . ' >' . "\n";
                echo($req ? '<span class="label label-info required">required</span>' : '');
                echo '</div>' . "\n";

                echo '<div class="control-group comment-form-url">' . "\n";
                echo '<label for="url">' . __( 'Website' ) . '</label>' . "\n";
                echo '<input class="text span3" id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" >' . "\n";
                echo '</div>' . "\n";

                do_action( 'comment_form_after_fields' );
            }
            //echo apply_filters( 'comment_form_field_comment', $args['comment_field'] );
            echo '<div class="control-group comment-form-comment">' . "\n";
            echo '<label for="comment">' . _x( 'Comment', 'noun' ) . '</label>';
            echo '<textarea class="span3" id="comment" name="comment" aria-required="true"></textarea>';
            echo '</div>';

            //echo $args['comment_notes_after'];
            echo '<div class="help-block form-allowed-tags">' . "\n";
            echo __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:' ) . "\n";
            echo '<code>' . allowed_tags( ) . '</code>' . "\n";
            echo '</div>' . "\n";

            echo '<div class="form-actions form-submit">' . "\n";
            echo '<input class="btn btn-primary" name="submit" type="submit" id="submit" value="Post Comment" >' . "\n";
            comment_id_fields( $post_id );
            echo '</div>' . "\n";
            do_action( 'comment_form', $post_id );
            echo '</fieldset>' . "\n";
            echo '</form>' . "\n";
            echo '</div><!-- #respond -->' . "\n";
            do_action( 'comment_form_after' );
        }
    } else {
        do_action( 'comment_form_comments_closed' );
    }
}
?>
