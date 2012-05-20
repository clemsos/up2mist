<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package up2mist
 * @since up2mist 1.0
 */
?>
			<div id="secondary" class="<?php echo UP2MIST_SECONDARY;?>" role="complementary">
				
				
				
				<?php do_action( 'before_sidebar' );?>
				
				<section id="main-sidebar" class="well">
					
					
					
					<aside class="branding-sidebar">
					<a class="brand" href="<?php echo home_url( );?>/"> <?php bloginfo( 'name' );?></a>
					<div></div>

					</aside>
					
					
					<aside id="search" class="widget widget_search">
						<?php get_search_form( ); ?>
					</aside>
					
					<?php wp_nav_menu( 
						array(
						'theme_location' => 'sidebar-menu',
						'container' => false,
						'items_wrap' => '
							<aside id="sidebar-menu" class="active tab-pane %2$s">
								<ul class="nav nav-list">
								%3$s
								</ul>
							</aside>',
						'walker' => new Fabric_Nav_Walker()
						) 
					);
					?>

					<div id="top-widgets" class="widget-area">
						<?php if ( ! dynamic_sidebar( 'sidebar-top' ) ) :?>
							<?php if ( current_user_can( 'edit_posts' ) ) :?>
							<?php printf( __( 'Please select some widgets for "SIDEBAR Top" <a href="%1$s">Get started here</a>.', 'up2mist' ), admin_url( 'widgets.php' ) );?>
							<?php endif; // end sidebar top?>
						<?php endif; // end sidebar top?>
						<div class="clear">
					</div>
				
				</section>
				
				<section id="widget-sidebar" class="widget-area">
				
				<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) :
				?>
				
					<aside id="archives" class="widget">
						<h1 class="widget-title"><?php _e( 'Archives', 'up2mist' );?></h1>
						<ul>
							<?php wp_get_archives( array( 'type' => 'monthly' ) );?>
						</ul>
					</aside>
					<aside id="meta" class="widget">
						<h1 class="widget-title"><?php _e( 'Meta', 'up2mist' );?></h1>
						<ul>
							<?php wp_register( );?>
							<li>
								<?php wp_loginout( );?>
							</li>
							<?php wp_meta( );?>
						</ul>
					</aside>
				<?php endif; // end sidebar widget area?>
				</section>
			</div><!-- #secondary .widget-area -->
