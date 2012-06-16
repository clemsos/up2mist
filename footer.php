<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package up2mist
 * @since up2mist 1.0
 */
?>

		</div><!-- #main -->
			</div><!-- #page -->
			<div class="container">
			<footer id="colophon" class="row site-footer" role="contentinfo">
			
				<div id="about-box"class="span3 box">
				<header class="page-header entry-header">
				<h3>About</h3>
				</header>
				<?php if ( ! dynamic_sidebar( 'footer-left' ) ) :?>
							<?php if ( current_user_can( 'edit_posts' ) ) :?>
							<?php printf( __( 'Please select some widgets for "Footer Left" <a href="%1$s">Get started here</a>.', 'up2mist' ), admin_url( 'widgets.php' ) );?>
							<?php endif; // end sidebar top?>
						<?php endif; // end sidebar top?>
				</div>
				
				<div class="span4 well box">
					<header class="page-header entry-header">
						<h3>Find us online</h3>
					</header>
					<?php if ( ! dynamic_sidebar( 'footer-center' ) ) :?>
							<?php if ( current_user_can( 'edit_posts' ) ) :?>
							<?php printf( __( 'Please select some widgets for "Footer Left" <a href="%1$s">Get started here</a>.', 'up2mist' ), admin_url( 'widgets.php' ) );?>
							<?php endif; // end sidebar top?>
						<?php endif; // end sidebar top?>
				</div><!-- .site-info -->
				
				<div class="span4 well box">
						<h3>Contact us</h3>

					<form>
						<label>Email</label>
						<input type="text" class="span3" placeholder="Write your email…">
						<input type="text" class="span3" placeholder="Write subject…">
						<textarea class="input-xlarge" id="textarea" rows="3"></textarea>
						<label class="checkbox">
						  <input type="checkbox"> Regsiter me to newsletter
						</label>
						<button type="submit" class="btn">Submit</button>
					</form>
					
				</div>
				
				
			</footer><!-- .site-footer .site-footer -->
			<p class="copy">
				<small> <?php bloginfo( 'name' );?> Theme designed by <a href="http://clementrenaud.com">Clément Renaud</a> - Released under <a href="http://sharism.org">Sharing Agreement</a> - <?php echo date( 'Y' );?></small>
				</p>

			</div><!-- #page .hfeed .site -->

			<?php wp_footer( );?>

</body>
</html>
