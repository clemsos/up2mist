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
			<?php do_action( 'up2mist_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'up2mist' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'up2mist' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'up2mist' ), 'up2mist', '<a href="http://automattic.com/" rel="designer">Automattic</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- .site-footer .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>
