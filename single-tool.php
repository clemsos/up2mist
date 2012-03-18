<?php
/**
 * Sample template for displaying single tool posts.
 * Save this file as as single-tool.php in your current theme.
 *
 * This sample code was based off of the Starkers Baseline theme: http://starkerstheme.com/
 */

get_header(); ?>

<div id="primary" class="<?php echo UP2MIST_PRIMARY;?> site-content">
	<div id="content" role="main">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>



<div class="row">

	<div class="span3">
		<a href="#" class="thumbnail">
			<img src="<?php print_custom_field('logo:to_image_src'); ?>" />
		</a>
	
		<table>
			<tbody>
				<tr>
				<td>Website</td>
				<td><a href="<?php print_custom_field('officialurl'); ?>"><?php print_custom_field('officialurl'); ?></a></td>
				</tr>
				<tr>
				<td>Blog</td>
				<td>
				<a href="<?php print_custom_field('blogurl'); ?>"><?php print_custom_field('blogurl'); ?></a></td>
				</tr>
				<tr>
				<td>Status on <?php print_custom_field('lasttest'); ?></td>
				<td>
				<?php 
				  $tool_status = get_custom_field('status');
				    switch ($tool_status) {
					case 'available':
					    echo '<span class="label label-success">Available</span>';
					    break;
					case 'broken':
					    echo '<span class="label label-important">Broken</span>';
					    break;
					case 'on-project':
					    echo '<span class="label label-info">On Project</span>';
					    break;
					    
					    case 'not-sustained':
					    echo '<span class="label">Not Sustained</span>';
					    break;
					}
				
				
				?>
				</td>
				</tr>
			</tbody>
		</table>
	</div>



	<div class="span5">
		<div class="page-header">
		<h1><?php the_title(); ?></h1>
		<small><?php print_custom_field('headline'); ?></small>

		</div>
		<?php print_custom_field('description'); ?><br />




		
		<?php
		// screenshots
		$media_array = get_custom_field('media:to_array');
		if($media_array) {
			foreach ($media_array as $med_id) {
			   print CCTM::filter($med_id, 'to_image_src');
			}
		}
		?>
		
		<?php
		// screenshots
		$img_array = get_custom_field('screenshots:to_array', 'to_image_tag');
		if($img_array) {
			echo '<strong>Screenshots</strong> ';
			foreach ($img_array as $img) {
			print $img;
			}
		}
		?>

<br />


	</div>

    </div>

<?php endwhile; // end of the loop. ?>
	</div><!-- #content -->
</div><!-- #primary .site-content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
