<?php get_header(); ?>
	<div id="content" class="row paddout">
		<div class="eight columns">	

			<?php  if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				
				<?php unity_content_nav( 'nav-above' ); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php unity_content_nav( 'nav-below' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>				
				
				
			<?php endwhile; // end of the loop. ?>
		</div>
		<div id="sidebar" class="four columns">									
			<?php get_sidebar(); // default sidebar  ?>
			
		</div>	
	</div><!-- #content -->
<?php get_footer(); ?>