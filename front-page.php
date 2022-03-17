<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hetas_Twenty_Seventeen
 */

get_header(); ?>


<?php if ( !wp_is_mobile() ) {
	get_template_part( 'front-page/carousel', 'slider' );
} ?>

<?php if (get_current_blog_id() == 1) {
		get_template_part( 'header-parts/search', 'nav' );
}  ?>

<?php the_content(); ?>

<?php edit_post_link('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit', '<p>', '</p>'); ?>

<?php //get_template_part( 'front-page/main', 'description' ); ?>

<?php //get_template_part( 'front-page/home', 'widgets' ); ?>

<?php //get_template_part( 'front-page/other' ); ?>

<?php
	get_footer();
?>