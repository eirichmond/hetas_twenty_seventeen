<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hetas_Twenty_Seventeen
 */

?>

	</div><!-- #content -->

	
</div><!-- #page -->

<footer id="colophon" class="site-footer container" role="contentinfo">
	
	<div class="row">
		<div class="col-md-4">

			<aside id="primary" class="widget-area" role="complementary">
				<?php dynamic_sidebar( 'footer-1' ); ?>
			</aside><!-- #secondary -->

		</div>
		<div class="col-md-4">
			
			<aside id="secondary" class="widget-area" role="complementary">
				<?php dynamic_sidebar( 'footer-2' ); ?>
			</aside><!-- #secondary -->

		</div>
		<div class="col-md-4">
			
			<aside id="tertiary" class="widget-area" role="complementary">
				<?php dynamic_sidebar( 'footer-3' ); ?>
			</aside><!-- #secondary -->

		</div>
	</div>
	
	<div class="row">
		<div class="ownership">
			<p>&copy; Copyright <?php echo date('Y'); ?> <?php echo bloginfo( 'name' ); ?>. All Rights Reserved.</p>
		</div>
	</div>

</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
