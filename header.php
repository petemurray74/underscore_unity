<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package unity
 * @since unity 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'unity' ), max( $paged, $page ) );

	?></title>

	<!-- Basic Meta Data -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta charset="utf-8" />
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico" />
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=device-width" />

	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
		
	
	<?php wp_head(); ?>
	
	
</head>
<body <?php body_class(); ?>>
<div id="wrapper" class="row">

	<div class="twelve columns">
		<header id="masthead" class="site-header" role="banner">
		
		<div id="header">
			<hgroup>
			<div id="brand">
				<div class="row">
					<div class="eight columns">
						<div id="blog-title">
						<?php bloginfo( 'name' ); ?>
						</div>
						<div id="blog-description" >
						<h2><?php bloginfo( 'description' ); ?></h2>
						</div>
					</div>	
				</div>
				
				<div class="row"><div class="twelve columns gap"></div></div>
			</div><!--end brand-->
			</hgroup>
			<nav role="navigation" class="site-navigation main-navigation">			
			<div class="row">
				<div id="access" class="twelve columns"> <!-- navigation --->
					<h1 class="assistive-text"><?php _e( 'Menu', 'unity' ); ?></h1>
					<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'unity' ); ?>"><?php _e( 'Skip to content', 'unity' ); ?></a></div>

					<?php
						wp_nav_menu( array( 
						'theme_location' => 'primary',
						'menu_class' => 'nav-bar',
						'walker' => new description_walker()
						) );
					?>					
				</div>	
			</div>	
			</nav><!-- .site-navigation .main-navigation -->
		</div><!--end header-->
		</header>
		<div class="row"><div class="twelve columns gap"></div></div>
		<div id="main">