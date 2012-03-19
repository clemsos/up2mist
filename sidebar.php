<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package up2mist
 * @since up2mist 1.0
 */
?>
			<div id="secondary" class="<?php echo UP2MIST_SECONDARY;?> widget-area" role="complementary">
				
				
				
				<?php do_action( 'before_sidebar' );?>
				
				<section id="main-sidebar" class="well">
					
					
					
					<aside class="branding-sidebar">
					<a class="brand" href="<?php echo home_url( );?>/"> <?php bloginfo( 'name' );?></a>
					<div></div>

					</aside>
					
					
					<div class="tabbable">
					
					<ul class="nav nav-tabs">
					  <li class="active"><a href="#sidebar-menu" data-toggle="tab">Menu</a></li>
					  <li class=""><a href="#search" data-toggle="tab">Search</a></li>
					  <li class=""><a href="#sns" data-toggle="tab">SNS</a></li>
					  <li class=""><a href="#widget" data-toggle="tab">Widgets</a></li>
					</ul>
					
					
					<div class="tab-content">
					
						<aside id="search" class="tab-pane widget widget_search">
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
					
						<div id="sns" class="tab-pane">
						<?php if ( ! dynamic_sidebar( 'sns-top' ) ) :?>
							<?php if ( current_user_can( 'edit_posts' ) ) :?>
							<?php printf( __( 'Please select some widgets for "SNS Top" <a href="%1$s">Get started here</a>.', 'up2mist' ), admin_url( 'widgets.php' ) );?>
							<?php endif; // end sidebar top?>
						<?php endif; // end sidebar top?>
						</div>
						
						<div id="widget" class="tab-pane">
						<?php if ( ! dynamic_sidebar( 'sidebar-top' ) ) :?>
							<?php if ( current_user_can( 'edit_posts' ) ) :?>
							<?php printf( __( 'Please select some widgets for "SIDEBAR Top" <a href="%1$s">Get started here</a>.', 'up2mist' ), admin_url( 'widgets.php' ) );?>
							<?php endif; // end sidebar top?>
						<?php endif; // end sidebar top?>
						</div>
					</div><!-- end tab-content -->
					</div><!-- end tabbable -->
				
				</section>
				
				
				
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
			</div><!-- #secondary .widget-area -->
