<?php get_header(); ?>
	<div id="content" class="row" role="main">
		<div class="eight columns">	

			
			<?php if ( have_posts() ) : ?>

				<?php unity_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>
					

				<?php endwhile; ?>
				
				<?php unity_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'index' ); ?>

			<?php endif; ?>
			
		</div>
		
		
		
		
		<div id="sidebar" class="four columns">									
			<?php get_sidebar(); // default sidebar  ?>		
		</div>	
	</div><!-- #content -->
<?php get_footer(); ?>