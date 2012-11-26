<?php 

add_action( 'after_setup_theme', 'unity_setup' );

if ( ! function_exists( 'unity_setup' ) ):

function unity_setup() {
	register_nav_menu( 'primary', __( 'Primary Menu', 'unity' ) );
	add_editor_style();
	
	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	//require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	//require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on unity, use a find and replace
	 * to change 'unity' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'unity', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );
	
	}
endif; // unity_setup

/************* REMOVE HEADER FLUFF *****************/


remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version


/************* ENQUEUE CSS AND JS *****************/

function theme_styles()  
{ 
    // Bring in Open Sans from Google fonts

    wp_register_style( 'lato', 'http://fonts.googleapis.com/css?family=Lato:400,900');
    wp_register_style( 'foundation', get_template_directory_uri() . '/foundation/stylesheets/foundation.min.css', array(), '3.0', 'all' );
    
    wp_enqueue_style( 'lato' );
	wp_enqueue_style( 'foundation' );
}

add_action('wp_enqueue_scripts', 'theme_styles');

/************* ENQUEUE JS *************************/

/* pull jquery from google's CDN. If it's not available, grab the local copy. Code from wp.tutsplus.com :-) */

$url = 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'; // the URL to check against  
$test_url = @fopen($url,'r'); // test parameters  
if( $test_url !== false ) { // test if the URL exists  

    function load_external_jQuery() { // load external file  
        wp_deregister_script( 'jquery' ); // deregisters the default WordPress jQuery  
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'); // register the external file  
        wp_enqueue_script('jquery'); // enqueue the external file  
    }  

    add_action('wp_enqueue_scripts', 'load_external_jQuery'); // initiate the function  
} else {  

    function load_local_jQuery() {  
        wp_deregister_script('jquery'); // initiate the function  
        wp_register_script('jquery', bloginfo('template_url').'/foundation/javascripts/jquery.min.js', __FILE__, false, '1.7.2', true); // register the local file  
        wp_enqueue_script('jquery'); // enqueue the local file  
    }  

    add_action('wp_enqueue_scripts', 'load_local_jQuery'); // initiate the function  
}  

/* load modernizr from foundation */
function modernize_it(){
    wp_register_script( 'modernizr', get_template_directory_uri() . '/foundation/javascripts/modernizr.foundation.js' ); 
    wp_enqueue_script( 'modernizr' );
}
add_action( 'wp_enqueue_scripts', 'modernize_it' );

function foundation_js(){
    wp_register_script( 'foundation-navigation', get_template_directory_uri() . '/foundation/javascripts/jquery.foundation.navigation.js' ); 
    wp_enqueue_script( 'foundation-navigation', 'jQuery', '1.1', true );
}
add_action('wp_enqueue_scripts', 'foundation_js');

function unity_js(){
    wp_register_script( 'unity-js', get_template_directory_uri() . '/js/scripts.js', 'jQuery', '1.0', true);
    wp_enqueue_script( 'unity-js' );
}
add_action('wp_enqueue_scripts', 'unity_js');

/*from underscores */
function unity_scripts() {
	wp_enqueue_style( 'unity-style', get_stylesheet_uri() );
	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'unity_scripts' );

// END head scripts 

// CUSTOM ADMIN MENU LINK FOR ALL SETTINGS
function all_settings_link() {
add_options_page(__('All Settings'), __('All Settings'), 'administrator', 'options.php');
}
add_action('admin_menu', 'all_settings_link');

// ADD A FAVICON
function favicon() { ?>
	<link rel="shortcut icon" href="<?php echo bloginfo('stylesheet_directory') ?>/images/favicon.ico" />
<?php }
add_action('wp_head', 'favicon');


function unity_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'unity' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'unity' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'unity' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'unity' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// Home page sidebar. Only appears on home page
	register_sidebar( array(
		'name' => __( 'Homepage sidebar', 'unity' ),
		'id' => 'home-widget-area',
		'description' => __( 'These widgets only appear on the homepage', 'unity' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name'=>'FooterSidebar1',
	'id' => 'footer-sidebar-1',
	'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
	'after_widget' => '</li>',
	'before_title' => '<h3 class="footer-widget-title">',
	'after_title' => '</h3>',
	));
	
	register_sidebar(array(
	'name'=>'FooterSidebar2',
	'id' => 'footer-sidebar-2',
	'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
	'after_widget' => '</li>',
	'before_title' => '<h3 class="footer-widget-title">',
	'after_title' => '</h3>',
	));
	
	

}
/** Register sidebars by running unity_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'unity_widgets_init' );


/** remove guff from header **/
remove_action('wp_head','wlwmanifest_link');
remove_action('wp_head','rsd_link' );
remove_action('wp_head','adjacent_posts_rel_link_wp_head');
remove_action('wp_head','wp_generator');



/**------------ MAKE MENU SYSTEM WORK FOR FOUNDATION ------------------**/


//Replaces "current-menu-item" with "active"
function current_to_active($text){
        $replace = array(
                //List of menu item classes that should be changed to "active"
                'current_page_item' => 'active',
                'current_page_parent' => 'active',
                'current_page_ancestor' => 'active',
        );
        $text = str_replace(array_keys($replace), $replace, $text);
                return $text;
        }
add_filter ('wp_nav_menu','current_to_active');


// Remove height/width attributes on images so they can be responsive
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

// add the 'has-flyout' class to any li's that have children and add the arrows to li's with children
class description_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth, $args)
      {
            global $wp_query;
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
            
            $class_names = $value = '';
            
            // If the item has children, add the dropdown class for foundation
            if ( $args->has_children ) {
                $class_names = "has-flyout ";
            }
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            
            $class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
            $class_names = ' class="'. esc_attr( $class_names ) . '"';
           
            $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
            // if the item has children add these two attributes to the anchor tag
            // if ( $args->has_children ) {
            //     $attributes .= 'class="dropdown-toggle" data-toggle="dropdown"';
            // }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
            $item_output .= $args->link_after;
            // if the item has children add the caret just before closing the anchor tag
            if ( $args->has_children ) {
                $item_output .= '</a><a href="#" class="flyout-toggle"><span> </span></a>';
            }
            else{
                $item_output .= '</a>';
            }
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
            
        function start_lvl(&$output, $depth) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class=\"flyout\">\n";
        }
            
        function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output )
            {
                $id_field = $this->db_fields['id'];
                if ( is_object( $args[0] ) ) {
                    $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
                }
                return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
            }       
}


/**------------ IMAGE CAPTIONS ------------------**/

add_filter('img_caption_shortcode', 'my_img_caption_shortcode_filter',10,3);

/**
 * Filter to replace the [caption] shortcode text with HTML5 compliant code
 *
 * @return text HTML content describing embedded figure
 **/
function my_img_caption_shortcode_filter($val, $attr, $content = null)
{
	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> '',
		'width'	=> '',
		'caption' => ''
	), $attr));
	
	if ( 1 > (int) $width || empty($caption) )
		return $val;

	$capid = '';
	if ( $id ) {
		$id = esc_attr($id);
		$capid = 'id="figcaption_'. $id . '" ';
		$id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
	}

	return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '" zstyle="width: '
	. (10 + (int) $width) . 'px">' . do_shortcode( $content ) . '<figcaption ' . $capid 
	. 'class="wp-caption-text">' . $caption . '</figcaption></figure>';
}

?>