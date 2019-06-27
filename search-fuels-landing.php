<?php
	
/*
Template Name: Search Fuels Landing
*/

get_header();
$types = get_terms('types');
$ens = get_terms('enplus');
?>

<?php get_template_part( 'header-parts/search', 'nav' ); ?>

<div class="hsp">
	<div class="row">
		
		<div class="col-md-6">
			<div class="box halfuser search-wood">
				<a href="https://woodsure.co.uk/wood-fuel-suppliers/" target="_blank">
					<h3>Wood Fuel Search</h3>
					<div class="row">
						<div class="col-md-10">
							<p>Click here</p>
						</div>
						<div class="col-md-2">
							<img class="hrlogin" src="<?php bloginfo ('template_url'); ?>/images/greenlog.png">
						</div>
					</div>
				</a>
			</div>
		</div>
		
		<div class="col-md-6">
			<div class="box halfuser search-mineral">
				<a href="<?php echo get_permalink(239447) ;?>">
					<h3>Solid Mineral Fuels Search</h3>
					<div class="row">
						<div class="col-md-10">
							<p>Click here</p>
						</div>
						<div class="col-md-2">
							<img class="hrlogin" src="<?php bloginfo ('template_url'); ?>/images/charclog.png">
						</div>
					</div>
				</a>
			</div>
		</div>
		
	</div>	
</div>
	
	
<div class="row">
	<div class="col-md-9">
	
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
	<div class="col-md-3">
		
		<?php get_sidebar('page'); ?>
		
	</div>
</div>

<?php get_footer();?>