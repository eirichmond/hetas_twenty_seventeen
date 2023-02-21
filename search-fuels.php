<?php
	
/*
Template Name: Search Fuels
*/

get_header();
$types = get_terms('types');
$ens = get_terms('enplus');
?>

<?php get_template_part( 'header-parts/search', 'brand' ); ?>

<div class="hsp">
	<div class="row">
		<div class="col-md-6 fuel-search">
			
			<div class="hetasform">
				<h3>Find Quality Assured Fuels</h3>
				<form action="/fuel/" method="get" id="geocode">
					
					
					<div class="form-group">
						<label for="fuelSearchPostcode">By location</label>
						<input type="text" name="postcode" id="fuelSearchPostcode" class="form-control postcodeUK" placeholder="Enter your postcode (required)" required>
					</div>
					
					<div class="form-group">
						<label for="fuel-type">Fuel Type</label>
		
						<select id="fuel-type" name="fuel-type" class="form-control">
						    <option value=""> - all - </option>
						    <?php foreach($types as $tag) { ?>
							<option value="<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></option>
							<?php } ?>
						</select>
						
					</div>
						
					<div class="form-group">
						<label for="enplus">ENPlus</label>
		
						<select id="enplus" name="enplus" class="form-control">
						    <option value=""> - all - </option>
						    <?php foreach($ens as $en) { ?>
							<option value="<?php echo $en->slug; ?>"><?php echo $en->name; ?></option>
							<?php } ?>
						</select>
						
					</div>
					<button type="submit" class="btn btn-submit">Search</button>
		
				</form>
			
			</div>
	
		</div>

		<div class="col-md-6 fuel-nav">
			<a href="#" class="grid"><img src="<?php bloginfo('template_url'); ?>/images/genmap.jpg" alt="image description" ></a>
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