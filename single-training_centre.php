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

<?php get_template_part( 'header-parts/search', 'brand' ); ?>


	<div class="row">

		<div class="col-md-9">

			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
		
					<?php
					while ( have_posts() ) : the_post();
		
						get_template_part( 'template-parts/content', 'page' );
				
					endwhile; // End of the loop.
					?>
					
					<?php if (is_page('1879')) {
						//insert_cform('2');
						if( function_exists( 'ninja_forms_display_form' ) ){ ninja_forms_display_form( 4 ); }
					} ?>
		
				</main><!-- #main -->
			</div><!-- #primary -->
			
		</div>
		<div class="col-md-3">
			
			<?php get_sidebar('page'); ?>
			
		</div>

	
	</div>

<?php get_footer(); ?>
