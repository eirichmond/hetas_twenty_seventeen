<?php
/**
 * Hetas Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Hetas_Twenty_Seventeen
 */

if ( ! function_exists( 'hetas_twenty_seventeen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hetas_twenty_seventeen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Hetas Twenty Seventeen, use a find and replace
	 * to change 'hetas_twenty_seventeen' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'hetas_twenty_seventeen', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

    set_post_thumbnail_size( 250, 250 ); // Normal post thumbnails
    add_image_size( 'page-thumbnail', 292, 9999 ); // Permalink thumbnail size
    add_image_size( 'home-page-thumb', 200, 9999 ); // Permalink thumbnail size
    add_image_size( 'full-width', 700, 9999 ); // Permalink thumbnail size
    add_image_size( 'half-width', 300, 9999 ); // Permalink thumbnail size
    add_image_size( 'training-manual-thumb', 92, 131 ); // Permalink thumbnail size
    add_image_size( 'training-centre-logo', 200, 350 ); // Permalink thumbnail size
    add_image_size( 'commercial-adverts', 200, 9999 ); // Permalink thumbnail size
    add_image_size( 'appliance-thumb', 9999, 100 ); // Permalink thumbnail size
    add_image_size( 'appliance-feature', 200, 9999 ); // Permalink thumbnail size
    add_image_size( 'home-feature', 1200, 350, true ); // Permalink thumbnail size
    add_image_size( 'fuel-logo', 210, 9999 ); // Permalink thumbnail size

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'hetas_twenty_seventeen' ),
		'secondary' => esc_html__( 'Secondary', 'hetas_twenty_seventeen' ),
		'members-logged-in' => esc_html__( 'Registered', 'hetas_twenty_seventeen' ),
	    'members-logged-out' => esc_html__( 'Unregistered', 'hetas_twenty_seventeen' ),

	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'hetas_twenty_seventeen_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support( 'custom-header' );

	$defaults = array(
        'height'      => 62,
        'width'       => 101,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
}
endif;
add_action( 'after_setup_theme', 'hetas_twenty_seventeen_setup' );

function add_logout_to_menu($items, $args) {
	if ($args->theme_location == 'members-logged-in') {
		$items .= '<li class="menu-item"><a href="' . wp_logout_url() . '">Log out</a></li>';
	}
    return $items;
}
add_filter('wp_nav_menu_items', 'add_logout_to_menu', 10, 2);

function menu_filters($sorted_menu_items, $args) {
	if ($args->theme_location == 'members-logged-in') {
		if (current_user_can('hetas_installer')) {
			unset($sorted_menu_items[1]);
		}
		if (current_user_can('member')) {
			unset($sorted_menu_items[2]);
		}
	}
	return $sorted_menu_items;
}
add_filter('wp_nav_menu_objects','menu_filters',10,2);

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hetas_twenty_seventeen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hetas_twenty_seventeen_content_width', 640 );
}
add_action( 'after_setup_theme', 'hetas_twenty_seventeen_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hetas_twenty_seventeen_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'hetas_twenty_seventeen' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'hetas_twenty_seventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Page Sidebar', 'hetas_twenty_seventeen' ),
		'id'            => 'page-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'hetas_twenty_seventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'hetas_twenty_seventeen' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'hetas_twenty_seventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'hetas_twenty_seventeen' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'hetas_twenty_seventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'hetas_twenty_seventeen' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'hetas_twenty_seventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'hetas_twenty_seventeen_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hetas_twenty_seventeen_scripts() {

	wp_enqueue_style( 'hetas_twenty_seventeen-style', get_stylesheet_uri() );

	wp_enqueue_script( 'hetas_twenty_seventeen-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20170525', true );
	wp_enqueue_script( 'hetas_twenty_seventeen-init-bootstrap', get_template_directory_uri() . '/js/init-bootstrap.js', array(), '20170525', true );

	wp_enqueue_script( 'hetas_twenty_seventeen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20170525', true );

	wp_enqueue_script( 'hetas_twenty_seventeen-bootstrap', get_template_directory_uri() . '/bootstrap-sass/assets/javascripts/bootstrap.min.js', array('jquery'), '20170525', true );

	//wp_enqueue_script( 'hetas_twenty_seventeen-ninjaforms', get_template_directory_uri() . '/js/ninjaforms.js', array('jquery'), '20170525', true );
	if(is_page( array('find-fuels','find-woodfuels','find-retailer','find-installer','find-servicing','find-chimney-sweep','find-appliance') )) {
		$google_api_key = hetas_gm_api_key();
		wp_enqueue_script( 'jquery.validate.js', get_template_directory_uri() . '/js/jquery.validate.js', array( 'jquery' ), '20170525' );
		wp_enqueue_script( 'jquery.validate-additional-methods', get_template_directory_uri() . '/js/jquery.validate-additional-methods.js', array( 'jquery' ), '20170525' );
		wp_enqueue_script( 'validate-scripts', get_template_directory_uri() . '/js/validate-scripts.js', array( 'jquery' ), '20170525', true );
		wp_enqueue_script( 'google', 'https://maps.googleapis.com/maps/api/js?key='.$google_api_key );
	}
	wp_enqueue_script( 'jquery-ui-autocomplete', '','', false );
	wp_enqueue_script( 'jquery-ui-accordion', '','', false );
	wp_enqueue_script( 'jquery-ui-tabs', '','', false );
	wp_enqueue_script( 'colorbox', get_template_directory_uri() . '/js/jquery.colorbox.js', array( 'jquery' ), '20170525', true );

	wp_enqueue_script( 'hetas_twenty_seventeen-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '20170525', true);
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


}
add_action( 'wp_enqueue_scripts', 'hetas_twenty_seventeen_scripts' );

/*
	Add google maps to the footer
*/
/*
function hetas_footer_hook() {
	// @TODO put this in a conditional so it doesnt render on every page
    echo '
	<script type="text/javascript">
	function loadScript() {
		var script = document.createElement("script");
		script.type = "text/javascript";
		script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCXLdzQAHX56JE5sz6k81OXh-krjoNYpsM&sensor=true&callback=initialize";
		document.body.appendChild(script);
	}

	window.onload = loadScript;
	</script>
    ';
}
add_action( 'wp_footer', 'hetas_footer_hook' );
*/

// add hook
add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2 );
// filter_hook function to react on sub_menu flag
function my_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {

  if ( isset( $args->sub_menu ) ) {
    $root_id = 0;

    // find the current menu item
    foreach ( $sorted_menu_items as $menu_item ) {
      if ( $menu_item->current ) {
        // set the root id based on whether the current menu item has a parent or not
        //$root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;
        $root_id = $menu_item->ID;
        break;
      }
    }

    // find the top level parent
    if ( ! isset( $args->direct_parent ) ) {
      // $prev_root_id = $root_id;
      $prev_root_id = $root_id;
      while ( $prev_root_id != 0 ) {
        foreach ( $sorted_menu_items as $menu_item ) {


          if ( $menu_item->ID == $prev_root_id ) {

            $prev_root_id = $menu_item->menu_item_parent;
            // don't set the root_id to 0 if we've reached the top of the menu
            //if ( $prev_root_id != 0 ) $root_id = $menu_item->menu_item_parent;

            // hack to show third tier
            if ( $prev_root_id != 0 ) $root_id = $menu_item->ID;
            break;
          }
        }
      }
    }
    $menu_item_parents = array();
    foreach ( $sorted_menu_items as $key => $item ) {
      // init menu_item_parents
      if ( $item->ID == $root_id ) $menu_item_parents[] = $item->ID;
      if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {
        // part of sub-tree: keep!
        $menu_item_parents[] = $item->ID;
      } else if ( ! ( isset( $args->show_parent ) && in_array( $item->ID, $menu_item_parents ) ) ) {
        // not part of sub-tree: away with it!
        unset( $sorted_menu_items[$key] );
      }
    }

    return $sorted_menu_items;
  } else {
    return $sorted_menu_items;
  }
}

// to be removed once converted to ACF
/*
include_once 'metaboxes/setup.php';
include_once 'metaboxes/ta-manufacturers-spec.php';
*/


/**
 * Include all legacy
 */
//require get_template_directory() . '/inc/settings.php';
require get_template_directory() . '/inc/legacy-code.php';
require get_template_directory() . '/inc/required-legacy-code.php';

/**
 * Include all ninjaforms funcitons
 */
require get_template_directory() . '/inc/ninjaforms.php';

/**
 * All menu functions and classes
 */
require get_template_directory() . '/inc/menu-functions.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



// $userdata = array(
// 	'user_login'  =>  '12345abcde',
// 	'first_name' => 'First',
// 	'last_name' => 'Last',
// 	'user_email' => '12345abcde@12345abcde.com',
// 	'user_pass'   =>  'lksjdflkjlkdsjflksjdfsdf'
// );
// wp_insert_user($userdata);

// $userdata2 = array(
// 	'user_login'  =>  '67890abcde',
// 	'first_name' => 'First',
// 	'last_name' => 'Last',
// 	'user_pass'   =>  'lksjdflkjlkdsjflksjdfsdf'
// );
// wp_insert_user($userdata2);