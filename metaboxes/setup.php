<?php

include_once WP_CONTENT_DIR . '/wpalchemy/MetaBox.php';
include_once WP_CONTENT_DIR . '/wpalchemy/MediaAccess.php';

 
// global styles for the meta boxes
function add_metabox_scripts() {
	if (is_admin()) wp_enqueue_style('wpalchemy-metabox', get_stylesheet_directory_uri() . '/metaboxes/meta.css');
}
add_action('admin_enqueue_scripts', 'add_metabox_scripts');

$wpalchemy_media_access = new WPAlchemy_MediaAccess();

/* eof */