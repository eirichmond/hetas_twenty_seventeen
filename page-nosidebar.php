<?php
/**

 Template Name: No Sidebar

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

<?php get_template_part( 'header-parts/search', 'brand' ); ?>


	<div class="row">

		<div class="col-md-12">

			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
		
					<?php
					while ( have_posts() ) : the_post();
		
						get_template_part( 'template-parts/content', 'page' );
				
					endwhile; // End of the loop.
					?>
							
				</main><!-- #main -->
			</div><!-- #primary -->
			
		</div>
	
	</div>

<?php get_footer(); ?>
