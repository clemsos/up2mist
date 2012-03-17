<?php
/*
 * up2mist gallery template
 */
function up2mist_gallery($output, $attr) {
    global $post;

    static $instance = 0;
    $instance++;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( ! $attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract( shortcode_atts( array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post -> ID,
        'itemtag' => 'li',
        'icontag' => 'div',
        'captiontag' => 'p',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => ''
    ), $attr ) );

    $id = intval( $id );
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( ! empty( $include ) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array(
            'include' => $include,
            'post_status' => 'inherit',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'order' => $order,
            'orderby' => $orderby
        ) );

        $attachments = array( );
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val -> ID] = $_attachments[$key];
        }
    } elseif ( ! empty( $exclude ) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array(
            'post_parent' => $id,
            'exclude' => $exclude,
            'post_status' => 'inherit',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'order' => $order,
            'orderby' => $orderby
        ) );
    } else {
        $attachments = get_children( array(
            'post_parent' => $id,
            'post_status' => 'inherit',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'order' => $order,
            'orderby' => $orderby
        ) );
    }

    if ( empty( $attachments ) )
        return '';

    if ( is_feed( ) ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
        return $output;
    }

    $itemtag = tag_escape( $itemtag );
    $captiontag = tag_escape( $captiontag );
    $columns = intval( $columns );
    $itemwidth = $columns > 0 ? floor( 100 / $columns ) : 100;
    $float = is_rtl( ) ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $gallery_style = $gallery_div = '';
    if ( apply_filters( 'use_default_gallery_style', true ) )
        $gallery_style = '';

    $size_class = sanitize_html_class( $size );
    $gallery_div = "<ul id='$selector' class='thumbnails gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>\n";
    $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        $link = isset( $attr['link'] ) && 'file' == $attr['link'] ? wp_get_attachment_link( $id, $size, false, false ) : wp_get_attachment_link( $id, $size, true, false );
        
        $output .= "\t\t<{$itemtag} class='gallery-item'>\n";
        $output .= "\t\t<{$icontag} class='gallery-icon'>\n";
        $output .= "\t\t$link\n";
        $output .= "\t\t</{$icontag}>\n";
        $output .= "\t\t</{$itemtag}>\n";

        /*$output .= "<{$itemtag} class='gallery-item'>";
        $output .= "
            <{$icontag} class='gallery-icon'>
                $link
            </{$icontag}>";
        if ( $captiontag && trim( $attachment -> post_excerpt ) ) {
            $output .= "
                <{$captiontag} class='caption wp-caption-text gallery-caption'>
                " . wptexturize( $attachment -> post_excerpt ) . "
                </{$captiontag}>";
        }
        $output .= "</{$itemtag}>";
        if ( $columns > 0 && ++$i % $columns == 0 )
            $output .= '';*/
    }

    $output .= "\t\t</ul>";

    return $output;
}

add_filter( 'post_gallery', 'up2mist_gallery', 10, 2 );
?>
