<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>
	<div id="content" class="row">
		<div class="twelve columns">	
			<?php  if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			 
			<?php 
			/* gets theme-child/content-page or content.php or parent/content-page or content.php in THAT order */
			get_template_part( 'content', 'page' ); ?> 
			
			<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

			
			
		</div>
	</div><!-- #content -->
	<div class="row"><div class="twelve columns gap"><hr /></div></div>
	<div id="home-sidebar" class="row">									
			<?php get_sidebar('home'); // home sidebar  ?>
	</div>	

<?php get_footer(); ?>

