<?php
/*
Template Name: Homepage 2-col
*/
?>

<?php get_header(); ?>
	<div id="content" class="row">
		<div class="eight columns">	
			<?php  if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<?php 
				/* gets theme-child/content-page or content.php or parent/content-page or content.php in THAT order */
				get_template_part( 'content', 'page' ); ?> 
				
				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

			
			
		</div>
	<!-- #content -->
		<div id="sidebar" class="four columns">								
			<?php get_sidebar('home'); // default sidebar  ?>
		</div>	
	</div>	

<?php get_footer(); ?>