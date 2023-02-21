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

<?php if (get_current_blog_id() == 1) {
	get_template_part( 'header-parts/search', 'brand' );
}  ?>


	<div class="row">

		<?php do_action('hetas_before_main_content'); ?>

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );
			
				endwhile; // End of the loop.
				?>
						
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php do_action('hetas_after_main_content'); ?>

		<?php do_action('hetas_sidebar_content'); ?>

	</div>

<?php get_footer(); ?>
