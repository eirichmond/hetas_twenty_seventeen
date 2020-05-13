<?php

/**
 * Template Name: HETAS Homepage
 */

get_header();

if ( !wp_is_mobile() ) {
	get_template_part( 'front-page/carousel', 'slider' );
}

get_template_part( 'header-parts/search', 'nav' );

the_content();

get_footer();

?>