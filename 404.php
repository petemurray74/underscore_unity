<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package unity
 * @since unity 1.0
 */

get_header(); ?>

				

	<div id="content" class="row" role="main">
	<section id="primary" class="content-area">
		<div class="eight columns">	

			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'unity' ); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p><?php _e( 'It looks like nothing was found at this location.', 'unity' ); ?></p>


				</div><!-- .entry-content -->
			</article><!-- #post-0 .post .error404 .not-found -->

		</div><!-- #content .site-content -->
	</section>	
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>