<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package unity
 * @since unity 1.0
 */

get_header(); ?>


	<div id="content" class="row" role="main">
		<section id="primary" class="content-area">
			<div class="eight columns">	
			

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'unity' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header><!-- .page-header -->

				<?php unity_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'search' ); ?>

				<?php endwhile; ?>

				<?php unity_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</section><!-- #primary .content-area -->
		
		<div id="sidebar" class="four columns">									
			<?php get_sidebar(); // default sidebar  ?>		
		</div>	
	</div><!-- #content -->
<?php get_footer(); ?>