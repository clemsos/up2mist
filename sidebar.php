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
					<aside id="search" class="widget widget_search">
						<?php get_search_form( ); ?>
					</aside>
				
					<?php wp_nav_menu( 
						array(
						'theme_location' => 'sidebar-menu',
						'container' => false,
						'items_wrap' => '
							<aside class="%2$s">
								<ul id="%1$s" class="nav nav-list">
								%3$s
								</ul>
							</aside>',
						'walker' => new Fabric_Nav_Walker()
						) 
					);
					?>
				<?php if ( ! dynamic_sidebar( 'sidebar-top' ) ) :
				?>
				<?php endif; // end sidebar top?>
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
