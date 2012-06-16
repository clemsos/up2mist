<?php
/**
 * The template to display all tools.
 *
Template Name: Tools list
 *
 * @package up2mist
 * @since up2mist 1.0
 */

get_header( );
?>

<div id="primary" class="<?php echo UP2MIST_PRIMARY;?> site-content">
	<div id="content" role="main">
	<?php 
	query_posts('post_type=tool&order=DESC&orderby=date&posts_per_page=10');
	 
	if ( have_posts() ) :
	while ( have_posts() ) : the_post(); 
	?>
	
	
	<article class='toolrow'>
	<div class="page-header">
			<a href='<?php the_permalink() ?>'>
			<h1><?php the_title(); ?>
				<small><?php print_custom_field('headline'); ?></small>
			</h1>
	</div>
		
	<div class="row">


		<div class="span3">
			<a href="<?php the_permalink() ?>" class="thumbnail">
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
		<?php
		
		 $my_text = get_custom_field('description');
		 $my_excerpt =  excerpt($my_text,100) ;
		 echo $my_excerpt;
		 
		 ?>
		 
		</div>
	</div>
	</article>

	<?php endwhile;?>

	<?php up2mist_content_nav( );?>

	<?php elseif ( current_user_can( 'edit_posts' ) ) :?>

	<article id="post-0" class="post no-results not-found">
		<header class="page-header entry-header">
			<h1 class="entry-title"><?php _e( 'No posts to display', 'up2mist' );?></h1>
		</header><!-- .entry-header -->
		<div class="entry-content clearfix">
			<p>
				<?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'up2mist' ), admin_url( 'post-new.php' ) );?>
			</p>
		</div><!-- .entry-content -->
	</article><!-- #post-0 -->
	<?php endif;?>
</div><!-- #content -->
</div><!-- #primary .site-content -->
<?php get_sidebar( );?>
<?php get_footer( );?>
