<?php

function wps_highlight_results(){
	$key = get_query_var('s');
	$teaser = wp_trim_words( get_the_content(), 50, '...' );
	$replace = '<strong class="search-key">'.$key.'</strong>';
	$teaser_text = str_replace($key, $replace, $teaser);
	return $teaser_text;
}

function search_filter($query) {
  if ( !is_admin() && $query->is_main_query() ) {
    if ($query->is_search) {
      $query->set('orderby', array ('type'));
      $query->set('post_type', array( 'post', 'page' ));
	  $query->set( 'posts_per_page', 50 );
    }
  }
}

add_action('pre_get_posts','search_filter');

add_filter( 'manage_business_posts_columns', 'set_custom_edit_business_columns' );
add_action( 'manage_business_posts_custom_column' , 'custom_business_column', 10, 2 );

function set_custom_edit_business_columns($columns) {
    $columns['lat'] = __( 'Lat', 'your_text_domain' );
    $columns['lng'] = __( 'Lng', 'your_text_domain' );

    return $columns;
}

function custom_business_column( $column, $post_id ) {
    switch ( $column ) {

        case 'lat' :
            $lat = get_post_meta( $post_id , 'inst_lat', true );
            if ( $lat )
                echo $lat;
            else
                'no lat';
            break;

        case 'lng' :
            $lng = get_post_meta( $post_id , 'inst_lng' , true );
            if ( $lng )
                echo $lng;
            else
                'no lat';
            break;

    }
}


add_filter( 'manage_fuel_posts_columns', 'set_custom_edit_fuel_columns' );
add_action( 'manage_fuel_posts_custom_column' , 'custom_fuel_column', 10, 2 );

function set_custom_edit_fuel_columns($columns) {
    $columns['lat'] = __( 'Lat', 'your_text_domain' );
    $columns['lng'] = __( 'Lng', 'your_text_domain' );

    return $columns;
}

function custom_fuel_column( $column, $post_id ) {
    switch ( $column ) {

        case 'lat' :
            $lat = get_post_meta( $post_id , 'inst_lat', true );
            if ( $lat )
                echo $lat;
            else
                'no lat';
            break;

        case 'lng' :
            $lng = get_post_meta( $post_id , 'inst_lng' , true );
            if ( $lng )
                echo $lng;
            else
                'no lat';
            break;

    }
}
/*
function hetas_header_redirect() {
	if ( !is_user_logged_in()) {
	get_template_part('holding');
	exit(0);
	}
}
add_filter('wp_headers', 'hetas_header_redirect');
*/

/*
function remove_all_business_posts() {
	$args = array(
		'post_type' => 'business',
		'posts_per_page' => -1,
		'post_status' => 'any'
	);
	$businesses = get_posts($args);
	$postids = array();
	foreach ($businesses as $business) {
		$postids[] = $business->ID;
	}
	//echo '<pre>'; print_r($postids); echo '</pre>'; wp_die();
	foreach ($postids as $postid) {
		wp_delete_post( $postid, true );
	}

}
add_action('init', 'remove_all_business_posts');
*/

add_filter('the_title', 'hetas_replace_h005br');
function hetas_replace_h005br($title){
	$title = str_replace('H005BR', 'H005DE', $title);
	return $title;
}

function installer_user_check() {
	$access = current_user_can('hetas_installer') || current_user_can('operative_responsible_person') || current_user_can('operative') || current_user_can('manage_options');
	if ( !is_user_logged_in() || !$access) {
		wp_die('Sorry! Your user access level does not allow you to access this area.');
	}
}

//include ('settings.php');

// include('custom-types.php');

// security
remove_action('wp_head', 'wp_generator');

// end security


// create a role for members to login
add_role('member', 'Member\'s Area User');

// redirect login logo upon click
add_filter( 'login_headerurl', 'my_custom_login_url' );
function my_custom_login_url($url) {
    return get_bloginfo('siteurl');
}

//This snippet allows you to change the logo you see when you login to WordPress(http://website.com/wp-admin). Just put the snippet in functions.php, and then add your login image to a folder called images in your theme folder.


//Change the alt text for login image
function change_wp_login_title()
{
    return 'Square One Web and Design';
}add_filter('login_headertext', 'change_wp_login_title');

//Change the footer link in the admin area
function remove_footer_admin () {
  return 'Web site design and development by <a href="http://www.squareonemd.co.uk">Square One</a>.';
}
add_filter('admin_footer_text', 'remove_footer_admin');

//Change the header logo in the admin area
function custom_admin_logo() {
  echo '<style type="text/css">
          #header-logo { width:32px; height:32px; background-image: url(http://www.squareonemd.co.uk/wproute/admin-logo.png) !important; }
        </style>';
}
add_action('admin_head', 'custom_admin_logo');

// Only show adminbar to administrators!
if (!current_user_can('administrator')) :
  show_admin_bar(false);
endif;

// email registration
function yoursite_wp_mail_from($content_type) {
  return 'info@hetas.co.uk';
}
add_filter('wp_mail_from','yoursite_wp_mail_from');

function yoursite_wp_mail_from_name($name) {
  return 'Hetas Registration';
}
add_filter('wp_mail_from_name','yoursite_wp_mail_from_name');

/*
if ( !function_exists('wp_new_user_notification') ) {
    function wp_new_user_notification( $user_id, $plaintext_pass = '' ) {
        $user = new WP_User($user_id);

        $user_login = stripslashes($user->user_login);
        $user_email = stripslashes($user->user_email);

        $message  = sprintf(__('New user registration on your blog %s:'), get_option('blogname')) . "\r\n\r\n";
        $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
        $message .= sprintf(__('E-mail: %s'), $user_email) . "\r\n";

        @wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), get_option('blogname')), $message);

        if ( empty($plaintext_pass) )
            return;

        $message  = __('Hi there,') . "\r\n\r\n";
        $message .= sprintf(__("Welcome to %s! Here's how to log in:"), get_option('blogname')) . "\r\n\r\n";
        $message .= wp_login_url() . "\r\n";
        $message .= sprintf(__('Username: %s'), $user_login) . "\r\n";
        $message .= sprintf(__('Password: %s'), $plaintext_pass) . "\r\n\r\n";
        $message .= sprintf(__('If you have any problems, please contact me at %s.'), get_option('admin_email')) . "\r\n\r\n";
        $message .= __('Adios!');

        wp_mail($user_email, sprintf(__('[%s] Your username and password'), get_option('blogname')), $message);

    }
}
*/
///////////////////////////////////////////////////////

/*
function kill_installers_in_admin($user) {
	if (current_user_can('hetas_installer')) {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
}
add_action('admin_init', 'kill_installers_in_admin');
*/

function hetas_scripts() {
//	wp_enqueue_script( 'cycle-script', get_template_directory_uri() . '/js/jquery.cycle.js', array( 'jquery' ), '10072014', true );
//	wp_enqueue_script( 'jquery.validate.js', get_template_directory_uri() . '/js/jquery.validate.js', array( 'jquery' ), '10072014' );
/*
	wp_enqueue_script( 'mockjax-script', get_template_directory_uri() . '/js/jquery.mockjax.js', array( 'jquery' ));
	wp_enqueue_script( 'autocomplete-script', get_template_directory_uri() . '/js/jquery.autocomplete.js', array( 'jquery' ));
	wp_enqueue_script( 'countries-script', get_template_directory_uri() . '/js/countries.js', array( 'jquery' ));
*/
// 	wp_enqueue_script( 'demo-script', get_template_directory_uri() . '/js/demo.js', array( 'jquery' ));
//	wp_enqueue_script( 'jquery-ui-autocomplete', '','', false );

/*
	if (!is_page_template( array('search-installer.php','search-servicing.php') )) {
		wp_enqueue_style( 'jquery-base-css', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );
	}
*/

//	wp_enqueue_script( 'jquery-ui-tooltip');
// 	wp_enqueue_script( 'demo-script', get_template_directory_uri() . '/js/demo.js', array( 'jquery' ));
}
add_action( 'wp_enqueue_scripts', 'hetas_scripts' );



// pull jQuery from google
/*
if( !is_admin()){
   wp_deregister_script('jquery');
   wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"), false, '1.7.2');
   wp_enqueue_script('jquery');
}
*/


// Load scripts into the footer so jquery is loaded first
/*
add_action( 'wp_footer', 'hetas_er_footer' );

function hetas_er_footer () {
	if (is_page(array(27,32,36,39,42))) {
		echo '<script type="text/javascript" src="' . get_bloginfo('template_url') . '/js/form.js"></script>';
	}
    echo '<script type="text/javascript" src="' . get_bloginfo('template_url') . '/js/jquery.flexslider-min.js"></script>';
    echo '<script type="text/javascript" src="' . get_bloginfo('template_url') . '/js/jquery.ui.core.min.js"></script>';
    echo '<script type="text/javascript" src="' . get_bloginfo('template_url') . '/js/jquery.ui.widget.min.js"></script>';
    echo '<script type="text/javascript" src="' . get_bloginfo('template_url') . '/js/jquery.ui.tabs.min.js"></script>';
    echo '<script type="text/javascript" src="' . get_bloginfo('template_url') . '/js/jquery.ui.accordion.min.js"></script>';
    echo '<script type="text/javascript" src="' . get_bloginfo('template_url') . '/js/jquery.colorbox.js"></script>';
    echo '<script type="text/javascript" src="' . get_bloginfo('template_url') . '/js/scripts.js"></script>';
}
*/

// load form validation in appliance single
/*
add_action( 'wp_head', 'hetas_form_validator' );

function hetas_form_validator () {
	if (is_singular('appliance')) {
		echo '<script type="text/javascript" src="' . get_bloginfo('template_url') . '/js/jquery.validate.js"></script>';
	}
}

add_action( 'init', 'register_hetas_menu' );
*/

function register_hetas_menu() {

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
	    'primary' => 'Primary Navigation',
	    'installers' => 'Installers Navigation',
	    'footer-1' => 'Footer Navigation Column 1',
	    'footer-2' => 'Footer Navigation Column 2',
	) );

}

// Register some sidebars

function hetas_widgets_init() {
/*
    register_sidebar( array(
        'name' => __( 'Main Sidebar' ),
        'id' => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => "</aside>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
*/
    register_sidebar( array(
        'name' => __( 'Footer Address' ),
        'id' => 'sidebar-footer1',
        'before_widget' => '<div id="%1$s" class="contact-box %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="contact-box">',
        'after_title' => '</div>',

    ) );
    register_sidebar( array(
        'name' => __( 'Footer MenuA' ),
        'id' => 'sidebar-footer2',
        'before_widget' => '<div id="%1$s" class="col %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="col">',
        'after_title' => '</div>',

    ) );
    register_sidebar( array(
        'name' => __( 'Footer MenuB' ),
        'id' => 'sidebar-footer3',
        'before_widget' => '<div id="%1$s" class="col %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="col">',
        'after_title' => '</div>',

    ) );
    register_sidebar( array(
        'name' => __( 'Installers Sidebar' ),
        'id' => 'sidebar-installers',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',

    ) );
}
add_action( 'widgets_init', 'hetas_widgets_init' );


// Clean up the <head>
function removeHeadLinks() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');

function new_excerpt_more( $more ) {

	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">Read More...</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more');


// Shorten your content using
// content('10'); to output your limited content

function content($num) {
$theContent = get_the_content();
$output = preg_replace('/<img[^>]+./','', $theContent);
$output = preg_replace( '/<blockquote>.*<\/blockquote>/', '', $output );
$output = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $output );
$limit = $num+1;
$content = explode(' ', $output, $limit);
array_pop($content);
$content = implode(" ",$content)."...";
echo $content;
}

// adds the link Home to the nav menu
function addHomeMenuLink($menuItems, $args)
{
    if('primary' == $args->theme_location)
    {
        if ( is_front_page() )
            $class = 'class="current-menu-item"';
        else
            $class = '';
        $homeMenuItem = '<li ' . $class . '>' .
                        $args->before .
                        '<a href="' . home_url( '/' ) . '" title="Home">' .
                            $args->link_before .
                            'Home' .
                            $args->link_after .
                        '</a>' .
                        $args->after .
                        '</li>';
        $menuItems = $homeMenuItem . $menuItems;
    }
    return $menuItems;
}
add_filter( 'wp_nav_menu_items', 'addHomeMenuLink', 10, 2 );

// add thumbnail support with additional images sizes
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
    add_image_size( 'home-feature', 1056, 350, true ); // Permalink thumbnail size
    add_image_size( 'fuel-logo', 210, 9999 ); // Permalink thumbnail size

function custom_in_post_images( $args )
{
	$custom_images = array(
		'full-width' => 'Full Width Image',
		'half-width' => 'Half Width Image'
	);
	return array_merge( $args, $custom_images );
}
add_filter( 'image_size_names_choose', 'custom_in_post_images' );

/* redirect back to the members area login screen if the login failed */
add_action( 'wp_login_failed', 'member_login_failed' );
function member_login_failed($user) {
   $ref = $_SERVER['HTTP_REFERER'];
   if ( !empty($ref) && !strstr($ref, 'wp-login') && !strstr($ref,'wp-admin') ) {
      wp_redirect( $ref . '?login=no' );
      exit;
   }
}

/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */
function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	global $user;

	if ( isset( $user->roles ) && is_array( $user->roles ) ) {

		//echo '<pre>'; print_r($user->roles); echo '</pre>'; wp_die();

		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return $redirect_to;
		} elseif ( in_array( 'member', $user->roles ) ) {
			return home_url().'/members-area/';
		} elseif ( in_array( 'hetas_installer', $user->roles ) ) {
			return home_url() . '/technical-area/';
		} else {
			return home_url();
		}
	} else {
		return $redirect_to;
	}
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

/* meta fields / taxonomy shortcuts */

function has_field($post_id, $name) {
    return (boolean) get_post_meta($post_id, $name, true);
}
function get_custom_field($post_id, $name) {
    $meta = get_post_meta($post_id, $name, true);
    if ($meta) {
        return $meta;
    } else {
        return;
    }
}
function custom_field($post_id, $name) {
    echo get_custom_field($post_id, $name);
}

function has_tax($post_id, $name) {
    return (boolean) wp_get_object_terms($post_id, $name);
}
function has_terms($terms, $taxonomy, $post) {
    foreach ($terms as $term) {
        if (has_term($term, $taxonomy, $post)) return true;
    }
    return false;
}
function custom_taxonomy($post_id, $name, $links=false) {
    if ($name == "appliance_type_code") {
        $html = strtoupper(get_the_term_list($post_id, $name, '', ', ', ''));
    } else {
        $html = get_the_term_list($post_id, $name, '', ', ', '');
    }
    if (!$links && !is_object($html)) {
        /* do we want the links? no, so strip the html out */
        $html = strip_tags($html);
        echo $html;
    }

}

// add a custom WP_Query argument to filter on post_title with LIKE
// commented out as clueless to what this actually does
// add_filter( 'posts_where', 'query_post_title_like', 10, 2 );
// function query_post_title_like( $where, &$wp_query ) {
//     global $wpdb;
//     if ( $post_title_like = $wp_query->get( 'post_title_like' ) ) {
//         $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'' . esc_sql( like_escape( $post_title_like ) ) . '%\'';
//     }
//     return $where;
// }

// Wpalchemy setup
/*
include_once 'metaboxes/setup.php';
include_once 'metaboxes/appliance-spec.php';
include_once 'metaboxes/pellet-spec.php';
include_once 'metaboxes/open-fire-spec.php';
include_once 'metaboxes/chimney-spec.php';
include_once 'metaboxes/cooker-spec.php';
include_once 'metaboxes/boiler-spec.php';
include_once 'metaboxes/download-spec.php';
include_once 'metaboxes/globalpage-spec.php';
include_once 'metaboxes/installer-spec.php';
include_once 'metaboxes/fuels-spec.php';
include_once 'metaboxes/trainingcentres-spec.php';
include_once 'metaboxes/advertising-spec.php';
include_once 'metaboxes/media-spec.php';
include_once 'metaboxes/interactive-spec.php';
include_once 'metaboxes/publicdisplay-spec.php';
include_once 'metaboxes/changed-spec.php';
include_once 'metaboxes/ta-manufacturers-spec.php';
*/

/*
// a textbox area for wpalchemy
$repeating_textareas = new WPAlchemy_MetaBox(array(
	'id' => '_repeating_textareas_meta',
	'title' => 'Home Page Widget',
	'template' => dirname ( __FILE__ ). '/metaboxes/repeating-textarea.php',
	'init_action' => 'kia_metabox_init',
	'hide_editor'	=> true,
	'include_template' => 'home.php'
));
*/

function kia_metabox_init(){
	// I prefer to enqueue the styles only on pages that are using the metaboxes
	wp_enqueue_style('wpalchemy-metabox', get_stylesheet_directory_uri() . '/metaboxes/meta.css');

	//make sure we enqueue some scripts just in case ( only needed for repeating metaboxes )
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-widget');
	wp_enqueue_script('jquery-ui-mouse');
	wp_enqueue_script('jquery-ui-sortable');

	// special script for dealing with repeating textareas
	wp_register_script('kia-metabox',get_stylesheet_directory_uri() . '/metaboxes/kia-metabox.js',array('jquery','editor'), '1.0');

	// needs to run AFTER all the tinyMCE init scripts have printed since we're going to steal their settings
	add_action('after_wp_tiny_mce','kia_metabox_scripts',999);
}

function kia_metabox_scripts(){
	wp_print_scripts('kia-metabox');
}

/*
 * Recreate the default filters on the_content
 * this will make it much easier to output the meta content with proper/expected formatting
*/
add_filter( 'meta_content', 'wptexturize'        );
add_filter( 'meta_content', 'convert_smilies'    );
add_filter( 'meta_content', 'convert_chars'      );

//use my override wpautop
if(function_exists('override_wpautop')){
add_filter( 'meta_content', 'override_wpautop'            );
} else {
add_filter( 'meta_content', 'wpautop'            );
}
add_filter( 'meta_content', 'shortcode_unautop'  );
add_filter( 'meta_content', 'prepend_attachment' );

// end custom meta

// add the import appliance menu
    add_action( 'admin_menu', 'appliance_import_menu' );
    function appliance_import_menu() {
    	add_submenu_page('edit.php?post_type=appliance', 'Appliances', 'Import CSV', 'manage_options', 'appliance-import', 'appliance_import');

    }
    function appliance_import() {
    	if ( !current_user_can( 'manage_options' ) )  {
    		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    	}
    	echo '<br/><div class="wrap">';
        echo '<iframe src="/wp-updater/upload-appliances.php" width="1024" height="768" style="border: 1px solid #E1E1E1; border-radius: 5px;"></iframe>';
        echo '</div>';
    }

// add the import installer menu
    add_action( 'admin_menu', 'installer_import_menu' );
    function installer_import_menu() {
    	add_submenu_page('edit.php?post_type=business', 'Business', 'Import CSV', 'manage_options', 'installer-import', 'installer_import');

    }
    function installer_import() {
    	if ( !current_user_can( 'manage_options' ) )  {
    		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    	}
    	echo '<br/><div class="wrap">';
        echo '<iframe src="/wp-updater/upload-installers.php" width="1024" height="768" style="border: 1px solid #E1E1E1; border-radius: 5px;"></iframe>';
        echo '</div>';
    }

// add the import fuels menu
    add_action( 'admin_menu', 'fuel_import_menu' );
    function fuel_import_menu() {
        add_submenu_page('edit.php?post_type=fuel', 'Fuels', 'Import CSV', 'manage_options', 'fuel-import', 'fuel_import');

    }
    function fuel_import() {
        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }
        echo '<br/><div class="wrap">';
        echo '<iframe src="/wp-updater/upload-fuels.php" width="1024" height="768" style="border: 1px solid #E1E1E1; border-radius: 5px;"></iframe>';
        echo '</div>';
    }

// add the filter for the geodata store meta keys
    add_filter('sc_geodatastore_meta_keys', 'installer_geodata');
    function installer_geodata($keys) {
        $keys['lat'][] = "inst_lat";
        $keys['lng'][] = "inst_lng";
        return $keys;
    }


$postcode_cache = array();
function geocode_postcode($pc) {

    global $postcode_cache;

    if (isset($postcode_cache[$pc])) return $postcode_cache[$pc];

    //$url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . str_replace(" ", "", $pc) . "&sensor=false";
    //$url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . str_replace(" ", "", $pc) . "&key=AIzaSyAuLJBNa3gDUvo9e9-7qkFivuqrKA6SrKE";
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . str_replace(" ", "", $pc) . "&key=AIzaSyDTBgIiALPDB_Z1C61Jma09ybxncZVgfqA";

    $data =  json_decode(file_get_contents($url), true);

    $lat = $data['results'][0]['geometry']['location']['lat'];
    $lng = $data['results'][0]['geometry']['location']['lng'];
    $ret = array($lat, $lng);
    if ($ret) $postcode_cache[$pc] = $ret;

    return $ret;
}

$postcode_cache = array();
function geocode_postcode_meta($pc) {
    global $postcode_cache;
    if (isset($postcode_cache[$pc])) return $postcode_cache[$pc];

    $url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . str_replace(" ", "", $pc) . "&sensor=false";
    //$url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . str_replace(" ", "", $pc) . "&key=AIzaSyAuLJBNa3gDUvo9e9-7qkFivuqrKA6SrKE";
    //$url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . str_replace(" ", "", $pc) . "&key=AIzaSyBjBgdPC2eP0ybNEE9R3mnIk1TFNVDENS4";

    $data =  json_decode(file_get_contents($url), true);
    $lat = $data['results'][0]['geometry']['location']['lat'];
    $lng = $data['results'][0]['geometry']['location']['lng'];
    $ret = array($lat, $lng);
    if ($ret) $postcode_cache[$pc] = $ret;

    return $ret;
}


function distance($lat1, $lng1, $lat2, $lng2, $miles = true)
{
	$pi80 = M_PI / 180;
	$lat1 *= $pi80;
	$lng1 *= $pi80;
	$lat2 *= $pi80;
	$lng2 *= $pi80;

	$r = 6372.797; // mean radius of Earth in km
	$dlat = $lat2 - $lat1;
	$dlng = $lng2 - $lng1;
	$a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
	$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
	$km = $r * $c;

	return ($miles ? ($km * 0.621371192) : $km);
}


// Implement Custom Header features.
require get_template_directory() . '/inc/hetas-business-search.php';

// this should be put in a pre get posts function
// require get_template_directory() . '/inc/hetas-fuel-search.php';

function list_feature_icons($post_id) {
	$terms = wp_get_post_terms( $post_id, 'appliance_feature_icons' ); ?>

	<ul class="feature-icons">
		<?php foreach ($terms as $term) { ?>
			<li><a href="/appliance-by-feature/<?php echo esc_attr( $term->slug ) ;?>" title="filter by: <?php echo esc_attr( $term->name ) ;?>"><img src="<?php echo get_template_directory_uri() . '/images/feature-icons/' .  esc_attr($term->slug) .'.png';?>"></a></li>
		<?php } ?>
	</ul>

<?php }

function check_technical_access($post_id){

	$ta_access = get_post_meta($post_id, '_ta_access_fields', true);

	// die early if no access has been set
	if (empty($ta_access)) {
		return true;
	}

	$userdata = get_user_by( 'id', get_current_user_id() );
	$args = array(
		'posts_per_page'   => -1,
		'meta_key'         => 'inst_email',
		'meta_value'       => $userdata->user_email,
		'post_type'        => 'business',
		'post_status'      => 'publish'
	);
	$posts_array = get_posts( $args );

	$terms = wp_get_object_terms( $posts_array[0]->ID, 'competencies' );

	$competencies = wp_list_pluck( $terms, 'slug' );

	$result = array();
	foreach ($ta_access as $access) {
		if (in_array($access, $competencies)) {
			$result[] = true;
		}
	}

	if (!empty($result)) {
		return true;
	} else {
		return false;
	}

}