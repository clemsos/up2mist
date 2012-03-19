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
			<footer id="colophon" class="row site-footer" role="contentinfo">
			
				<div class="span3 well box">
				<header class="page-header entry-header">
				<h3>About</h3>
				</header>
				<p>
				Visual.ly wants to make it simple for designers to find interesting, well-paying, and satisfying work in the field of data visualization. So we're considering launching a global marketplace (as an extension of our existing community) where you'll be able to display your work, get feedback, and get connected to brands, agencies, and companies looking for infographics of all kinds.
				</p>
				</div>
				
				<div class="span4 well box">
					<header class="page-header entry-header">
						<h3>More</h3>
					</header>
					<?php up2mist_footer_inside( );?>
				</div><!-- .site-info -->
				
				<div class="span3 well box">
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
				<small>&copy; <?php echo date( 'Y' );?> <?php bloginfo( 'name' );?> | designed by <a href="http://clemsos.com">Clément Renaud</a></small>
				</p>
			</div><!-- #page .hfeed .site -->
			<?php wp_footer( );?>

</body>
</html>
