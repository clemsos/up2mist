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
			<footer id="colophon" class="site-footer" role="contentinfo">
				<div class="site-info">
					<?php up2mist_footer_inside( );?>
					<p class="copy">
						<small>&copy; <?php echo date( 'Y' );?> <?php bloginfo( 'name' );?></small>
					</p>
				</div><!-- .site-info -->
			</footer><!-- .site-footer .site-footer -->
			</div><!-- #page .hfeed .site -->
			<?php wp_footer( );?>

</body>
</html>
