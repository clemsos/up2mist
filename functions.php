<?php
/*
 * up2mist functions and definitions
 */

/* Define theme constants */
define( 'UP2MIST_URI', get_template_directory_uri( ) );
define( 'UP2MIST_DIR', get_template_directory( ) );
define( 'UP2MIST_RESPONSIVE', TRUE );
define( 'UP2MIST_PRIMARY', 'span9' );
define( 'UP2MIST_SECONDARY', 'span3' );
define( 'UP2MIST_FULLWIDTH', 'span12' );
define( 'UP2MIST_NAVCLASS', 'navbar' );

/* Set the content width based on the theme's design and stylesheet. */
if ( ! isset( $content_width ) )
	$content_width = 770;
/* pixels */

add_action( 'after_setup_theme', 'up2mist_setup' );


function up2mist_setup() {

	/* Load up2mist template files */
	/* locate_template( $template_names, $load, $require_once ) */
	require_once (UP2MIST_DIR . '/inc/up2mist_hooks.php');
	require_once (UP2MIST_DIR . '/inc/up2mist_functions.php');
	require_once (UP2MIST_DIR . '/inc/up2mist_templates.php');
	require_once (UP2MIST_DIR . '/inc/up2mist_navmenu.php');
	require_once (UP2MIST_DIR . '/inc/up2mist_gallery.php');
	//require_once (UP2MIST_DIR . '/inc/up2mist_shortcodes.php');

	/* Make theme available for translation */
	load_theme_textdomain( 'up2mist', get_template_directory( ) . '/languages' );

	$locale = get_locale( );
	$locale_file = get_template_directory( ) . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once ($locale_file);

	/* Add default posts and comments RSS feed links to head */
	add_theme_support( 'automatic-feed-links' );

	/* Add suppot for post-thumbnails */
	add_theme_support( 'post-thumbnails' );

	/* This theme uses wp_nav_menu() in one location. */
	register_nav_menus( 
			array( 
			'primary' => __( 'Primary Menu', 'up2mist' ), 
			'sidebar-menu' => __( 'Sidebar Menu', 'up2mist' )
			) 
			);

	/* Add support for the Aside and Gallery Post Formats */
	add_theme_support( 'post-formats', array( 'aside', ) );

	/* Add featured image size */
	add_image_size( 'featured_fullwidth', 1170, 9999 );
	add_image_size( 'featured_large', 770, 9999 );
	
	/* Add callback for custom TinyMCE editor stylesheets. */
	add_editor_style('editor-style.css');

}

/* Load stylesheets */
function up2mist_load_styleheets() {

	$html = "<link href='http://fonts.googleapis.com/css?family=Signika+Negative:300,400,600,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Asap:400,700,400italic,700italic' rel='stylesheet' type='text/css'>";
		
	$html .= "\t" . '<link rel="stylesheet" href="' . UP2MIST_URI . '/css/bootstrap.css' . '">' . "\n";

	if ( UP2MIST_RESPONSIVE ) {
		$html .= "\t" . '<link rel="stylesheet" href="' . UP2MIST_URI . '/css/bootstrap-responsive.min.css' . '">' . "\n";
	}

	$html .= "\t" . '<link rel="stylesheet" href="' . UP2MIST_URI . '/style.css' . '">' . "\n";
	
	

	echo $html;
}

add_action( 'up2mist_stylesheets', 'up2mist_load_styleheets' );

/* Enqueue scripts and styles */
function up2mist_enqueue_scripts() {

	/* wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer ); */
	wp_enqueue_script( 'modernizr', UP2MIST_URI . '/js/modernizr.custom-2.5.3.min.js', false, '2.5.3' );
	wp_enqueue_script( 'bootstrap', UP2MIST_URI . '/js/bootstrap.min.js', array( 'jquery' ), '2.0.2' );


	// add custom script
	wp_enqueue_script( 'script', UP2MIST_URI . '/js/script.js' );


	if ( is_singular( ) && comments_open( ) && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	


}

add_action( 'wp_enqueue_scripts', 'up2mist_enqueue_scripts' );

/* Register widgetized area and update sidebar with default widgets */
function up2mist_widgets_init() {


	register_sidebar( array(
		'name' => __( 'Sidebar Top', 'up2mist' ),
		'id' => 'sidebar-top',
		'before_widget' => '	<aside id="%1$s" class="widget %2$s">
					<ul class="nav nav-list">',
		'after_widget' => "	</ul>
					</aside>",
		'before_title' => '<li class="nav-header">',
		'after_title' => '</li><li class="divider"></li></ul>'
	) );

	register_sidebar( array(
		'name' => __( 'Sidebar Bottom', 'up2mist' ),
		'id' => 'sidebar-1',
		'before_widget' => '	<aside id="%1$s" class="widget %2$s">
					<ul class="nav nav-list">',
		'after_widget' => "	</ul>
					</aside>",
		'before_title' => '<li class="nav-header">',
		'after_title' => '</li><li class="divider"></li></ul>'
	) );

}

add_action( 'widgets_init', 'up2mist_widgets_init' );

/* add all specific widgets */
class GetConnected extends WP_Widget {

    function GetConnected() {
        parent::WP_Widget(false, $name = 'Custom Social Links');
    }

    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        ?>
            <?php echo $before_widget; ?>
                <?php if ( $title )
                    echo $before_title . $title . $after_title;  else echo '<div class="widget-body clear">'; ?>

                    <!-- RSS -->
                    <div class="getconnected_rss">
                    <a href="<?php echo ( get_option('feedburner_url') )? get_option('feedburner_url') : get_bloginfo('rss2_url'); ?>">RSS Feed</a>
                    <?php echo (get_option('feedburner_url') && function_exists('feedcount'))? feedcount( get_option('feedburner_url') ) : ''; ?>
                    </div>
                    <!-- /RSS -->

                    <!-- Twitter -->
                    <?php if ( get_option('twitter_url') ) : ?>
                    <div class="getconnected_twitter">
                    <a href="<?php echo get_option('twitter_url'); ?>">Twitter</a>
                    <span><?php if ( function_exists('twittercount') ) twittercount( get_option('twitter_url') ); ?> followers</span>
                    </div>
                    <?php endif; ?>
                    <!-- /Twitter -->

                    <!-- Facebook -->
                    <?php if ( get_option('fb_url') ) : ?>
                    <div class="getconnected_fb">
                    <a href="<?php echo get_option('fb_url'); ?>">Facebook</a>
                    <span><?php echo get_option('fb_text'); ?></span>
                    </div>
                    <?php endif; ?>
                    <!-- /Facebook -->

                    <!-- Flickr -->
                    <?php if ( get_option('flickr_url') ) : ?>
                    <div class="getconnected_flickr">
                    <a href="<?php echo get_option('flickr_url'); ?>">Flickr group</a>
                    <span><?php echo get_option('flickr_text'); ?></span>
                    </div>
                    <?php endif; ?>
                    <!-- /Flickr -->

                    <!-- Behance -->
                    <?php if ( get_option('behance_url') ) : ?>
                    <div class="getconnected_behance">
                    <a href="<?php echo get_option('behance_url'); ?>">Behance</a>
                    <span><?php echo get_option('behance_text'); ?></span>
                    </div>
                    <?php endif; ?>
                    <!-- /Behance -->

                    <!-- Delicious -->
                    <?php if ( get_option('delicious_url') ) : ?>
                    <div class="getconnected_delicious">
                    <a href="<?php echo get_option('delicious_url'); ?>">Delicious</a>
                    <span><?php echo get_option('delicious_text'); ?></span>
                    </div>
                    <?php endif; ?>
                    <!-- /Delicious -->

                    <!-- Stumbleupon -->
                    <?php if ( get_option('stumbleupon_url') ) : ?>
                    <div class="getconnected_stumbleupon">
                    <a href="<?php echo get_option('stumbleupon_url'); ?>">Stumbleupon</a>
                    <span><?php echo get_option('stumbleupon_text'); ?></span>
                    </div>
                    <?php endif; ?>
                    <!-- /Stumbleupon -->

                    <!-- Tumblr -->
                    <?php if ( get_option('tumblr_url') ) : ?>
                    <div class="getconnected_tumblr">
                    <a href="<?php echo get_option('tumblr_url'); ?>">Tumblr</a>
                    <span><?php echo get_option('tumblr_text'); ?></span>
                    </div>
                    <?php endif; ?>
                    <!-- /Tumblr -->

                    <!-- Vimeo -->
                    <?php if ( get_option('vimeo_url') ) : ?>
                    <div class="getconnected_vimeo">
                    <a href="<?php echo get_option('vimeo_url'); ?>">Vimeo</a>
                    <span><?php echo get_option('vimeo_text'); ?></span>
                    </div>
                    <?php endif; ?>
                    <!-- /Vimeo -->

                    <!-- Youtube -->
                    <?php if ( get_option('youtube_url') ) : ?>
                    <div class="getconnected_youtube">
                    <a href="<?php echo get_option('youtube_url'); ?>">Youtube</a>
                    <span><?php echo get_option('youtube_text'); ?></span>
                    </div>
                    <?php endif; ?>
                    <!-- /Youtube -->

            <?php echo $after_widget; ?>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        
        update_option('feedburner_url', $_POST['feedburner_url']);
        update_option('twitter_url', $_POST['twitter_url']);
        update_option('fb_url', $_POST['fb_url']);
        update_option('flickr_url', $_POST['flickr_url']);
        update_option('behance_url', $_POST['behance_url']);
        update_option('delicious_url', $_POST['delicious_url']);
        update_option('stumbleupon_url', $_POST['stumbleupon_url']);
        update_option('tumblr_url', $_POST['tumblr_url']);
        update_option('vimeo_url', $_POST['vimeo_url']);
        update_option('youtube_url', $_POST['youtube_url']);
        
        update_option('fb_text', $_POST['fb_text']);
        update_option('flickr_text', $_POST['flickr_text']);
        update_option('behance_text', $_POST['behance_text']);
        update_option('delicious_text', $_POST['delicious_text']);
        update_option('stumbleupon_text', $_POST['stumbleupon_text']);
        update_option('tumblr_text', $_POST['tumblr_text']);
        update_option('vimeo_text', $_POST['vimeo_text']);
        update_option('youtube_text', $_POST['youtube_text']);
        
        return $instance;
    }

    function form($instance) {

        $title = esc_attr($instance['title']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

            <script type="text/javascript">
                (function($) {
                    $(function() {
                        $('.social_options').hide();
                        $('.social_title').toggle(
                            function(){ $(this).next().slideDown(100) },
                            function(){ $(this).next().slideUp(100) }
                        );
                    })
                })(jQuery)
            </script>

            <div style="margin-bottom: 5px;">
                <a href="javascript: void(0);" class="social_title" style="font-size: 13px; display: block; margin-bottom: 5px;">FeedBurner</a>
                <p class="social_options">
                    <label for="feedburner_url"><?php _e('FeedBurner feed url:'); ?></label>
                    <input type="text" name="feedburner_url" id="feedburner_url" class="widefat"
                           value="<?php echo get_option('feedburner_url'); ?>"/>
                </p>
            </div>

            <div style="margin-bottom: 5px;">
                <a href="javascript: void(0);" class="social_title" style="font-size: 13px; display: block; margin-bottom: 5px;">Twitter</a>
                <p class="social_options">
                    <label for="twitter_url">Profile url:</label>
                    <input type="text" name="twitter_url" id="twitter_url" class="widefat" value="<?php echo get_option('twitter_url'); ?>"/>
                </p>
            </div>

            <div style="margin-bottom: 5px;">
                <a href="javascript: void(0);" class="social_title" style="font-size: 13px; display: block; margin-bottom: 5px;">Facebook</a>
                <p class="social_options">
                    <label for="fb_url">Profile url:</label>
                    <input type="text" name="fb_url" id="fb_url" class="widefat" value="<?php echo get_option('fb_url'); ?>"/>
                    <label for="fb_text">Description:</label>
                    <input type="text" name="fb_text" id="fb_text" class="widefat" value="<?php echo get_option('fb_text'); ?>"/>
                </p>
            </div>

            <div style="margin-bottom: 5px;">
                <a href="javascript: void(0);" class="social_title" style="font-size: 13px; display: block; margin-bottom: 5px;">Flickr</a>
                <p class="social_options">
                    <label for="flickr_url">Profile url:</label>
                    <input type="text" name="flickr_url" id="flickr_url" class="widefat" value="<?php echo get_option('flickr_url'); ?>"/>
                    <label for="flickr_text">Description:</label>
                    <input type="text" name="flickr_text" id="flickr_text" class="widefat" value="<?php echo get_option('flickr_text'); ?>"/>
                </p>
            </div>

            <div style="margin-bottom: 5px;">
                <a href="javascript: void(0);" class="social_title" style="font-size: 13px; display: block; margin-bottom: 5px;">Behance</a>
                <p class="social_options">
                    <label for="behance_url">Profile url:</label>
                    <input type="text" name="behance_url" id="behance_url" class="widefat" value="<?php echo get_option('behance_url'); ?>"/>
                    <label for="behance_text">Description:</label>
                    <input type="text" name="behance_text" id="behance_text" class="widefat" value="<?php echo get_option('behance_text'); ?>"/>
                </p>
            </div>

            <div style="margin-bottom: 5px;">
                <a href="javascript: void(0);" class="social_title" style="font-size: 13px; display: block; margin-bottom: 5px;">Delicious</a>
                <p class="social_options">
                    <label for="delicious_url">Profile url:</label>
                    <input type="text" name="delicious_url" id="delicious_url" class="widefat" value="<?php echo get_option('delicious_url'); ?>"/>
                    <label for="delicious_text">Description:</label>
                    <input type="text" name="delicious_text" id="delicious_text" class="widefat" value="<?php echo get_option('delicious_text'); ?>"/>
                </p>
            </div>

            <div style="margin-bottom: 5px;">
                <a href="javascript: void(0);" class="social_title" style="font-size: 13px; display: block; margin-bottom: 5px;">Stumbleupon</a>
                <p class="social_options">
                    <label for="stumbleupon_url">Profile url:</label>
                    <input type="text" name="stumbleupon_url" id="stumbleupon_url" class="widefat" value="<?php echo get_option('stumbleupon_url'); ?>"/>
                    <label for="stumbleupon_text">Description:</label>
                    <input type="text" name="stumbleupon_text" id="stumbleupon_text" class="widefat" value="<?php echo get_option('stumbleupon_text'); ?>"/>
                </p>
            </div>

            <div style="margin-bottom: 5px;">
                <a href="javascript: void(0);" class="social_title" style="font-size: 13px; display: block; margin-bottom: 5px;">Tumblr</a>
                <p class="social_options">
                    <label for="tumblr_url">Profile url:</label>
                    <input type="text" name="tumblr_url" id="tumblr_url" class="widefat" value="<?php echo get_option('tumblr_url'); ?>"/>
                    <label for="tumblr_text">Description:</label>
                    <input type="text" name="tumblr_text" id="tumblr_text" class="widefat" value="<?php echo get_option('tumblr_text'); ?>"/>
                </p>
            </div>

            <div style="margin-bottom: 5px;">
                <a href="javascript: void(0);" class="social_title" style="font-size: 13px; display: block; margin-bottom: 5px;">Vimeo</a>
                <p class="social_options">
                    <label for="vimeo_url">Profile url:</label>
                    <input type="text" name="vimeo_url" id="vimeo_url" class="widefat" value="<?php echo get_option('vimeo_url'); ?>"/>
                    <label for="vimeo_text">Description:</label>
                    <input type="text" name="vimeo_text" id="vimeo_text" class="widefat" value="<?php echo get_option('vimeo_text'); ?>"/>
                </p>
            </div>

            <div style="margin-bottom: 5px;">
                <a href="javascript: void(0);" class="social_title" style="font-size: 13px; display: block; margin-bottom: 5px;">Youtube</a>
                <p class="social_options">
                    <label for="youtube_url">Profile url:</label>
                    <input type="text" name="youtube_url" id="youtube_url" class="widefat" value="<?php echo get_option('youtube_url'); ?>"/>
                    <label for="youtube_text">Description:</label>
                    <input type="text" name="youtube_text" id="youtube_text" class="widefat" value="<?php echo get_option('youtube_text'); ?>"/>
                </p>
            </div>
        <?php
    }

}
add_action('widgets_init', create_function('', 'return register_widget("GetConnected");'));

class Recentposts_thumbnail extends WP_Widget {

    function Recentposts_thumbnail() {
        parent::WP_Widget(false, $name = 'Custom Recent Posts');
    }

    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        ?>
            <?php echo $before_widget; ?>
            <?php if ( $title ) echo $before_title . $title . $after_title;  else echo '<div class="widget-body clear">'; ?>

            <?php
                global $post;
                if (get_option('rpthumb_qty')) $rpthumb_qty = get_option('rpthumb_qty'); else $rpthumb_qty = 5;
                $q_args = array(
                    'numberposts' => $rpthumb_qty,
                );
                $rpthumb_posts = get_posts($q_args);
                foreach ( $rpthumb_posts as $post ) :
                    setup_postdata($post);
            ?>

                <a href="<?php the_permalink(); ?>" class="rpthumb clear">
                    <?php if ( has_post_thumbnail() && !get_option('rpthumb_thumb') ) {
                        the_post_thumbnail('mini-thumbnail');
                        $offset = 'style="padding-left: 65px;"';
                    }
                    ?>
                    <span class="rpthumb-title" <?php echo $offset; ?>><?php the_title(); ?></span>
                    <span class="rpthumb-date" <?php echo $offset; unset($offset); ?>><?php the_time(__('M j, Y')) ?></span>
                </a>

            <?php endforeach; ?>

            <?php echo $after_widget; ?>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        update_option('rpthumb_qty', $_POST['rpthumb_qty']);
        update_option('rpthumb_thumb', $_POST['rpthumb_thumb']);
        return $instance;
    }

    function form($instance) {
        $title = esc_attr($instance['title']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
            <p><label for="rpthumb_qty">Number of posts:  </label><input type="text" name="rpthumb_qty" id="rpthumb_qty" size="2" value="<?php echo get_option('rpthumb_qty'); ?>"/></p>
            <p><label for="rpthumb_thumb">Hide thumbnails:  </label><input type="checkbox" name="rpthumb_thumb" id="rpthumb_thumb" <?php echo (get_option('rpthumb_thumb'))? 'checked="checked"' : ''; ?>/></p>
        <?php
    }

}
add_action('widgets_init', create_function('', 'return register_widget("Recentposts_thumbnail");'));


/* change excerpt length */
function custom_excerpt_length( $length ) {
	return 20;
}
//add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );




/*  Create excerpts from any text */

function excerpt($text, $limit) {
  $excerpt = explode(' ', $text, $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
 
function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }	
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

?>
