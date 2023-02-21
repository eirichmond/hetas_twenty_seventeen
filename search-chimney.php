<?php
get_header();
/*
Template Name: Search Chimney Sweeps
*/
?>

<?php get_template_part( 'header-parts/search', 'brand' ); ?>

<div class="hsp">
	<div class="row">
		<div class="col-md-6 chim-search">
			<div class="hetasform">
				<h3>Find HETAS Approved Chimney Sweeps</h3>
				<form action="/business/" method="get" id="geocode">
					
					<input type="hidden" name="chimney-sweep" value="filter">
					
					<div class="form-group">
						<label for="postcode">By postcode</label>
						<input class="form-control postcodeUK" type="text" id="postcode" name="postcode" required />
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-submit">Search</button>
					</div>
	
				</form>
			</div>
		</div>
		<div class="col-md-6 chim-nav">
			<a title="View by Log fuels" class="grid" href="#"><img src="<?php bloginfo('template_url'); ?>/images/genmap.jpg" alt="image description" ></a>
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