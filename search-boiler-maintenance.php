<?php
get_header();
$competencies = get_current_biomass_competencies();
$rhi_manufacturers = get_current_biomass_rhi_manufactures();
/*
Template Name: Search Boiler Maintenance
*/
?>

<?php get_template_part( 'header-parts/search', 'nav' ); ?>

<div class="hsp">
	<div class="row">
		<div class="col-md-6 serv-search">
			
			<!-- Nav tabs -->
			<ul class="nav nav-tabs hbg" role="tablist">
				<li role="presentation" class="active"><a href="#findbusiness" aria-controls="findbusiness" role="tab" data-toggle="tab">Find Business</a></li>
			</ul>
			
			<!-- Tab panes -->
			<div class="tab-content">
				
				<div role="tabpanel" class="tab-pane fade in active" id="findbusiness">
					<div class="hetasform hybrid">
						
						<h3>Find HETAS Approved Biomass Maintenance (HABMS)</h3>

						<form class="cmxform" id="geocode" method="get" action="/business/">

							<div class="form-group">
								<label for="competencies">By Biomass Category</label>
								<select id="competencies" name="competencies" class="form-control">
								    <option value=""> - all - </option>
								    <?php foreach($competencies as $boiler_competency) { ?>
									<option value="<?php echo $boiler_competency->slug; ?>"><?php echo $boiler_competency->name; ?></option>
									<?php } ?>
								</select>
							</div>


							<div class="form-group">
								<label for="boiler_maintenance_manufacturers">By Manufacturer</label>
								<select id="boiler_maintenance_manufacturers" name="boiler_maintenance_manufacturers" class="form-control">
								    <option value=""> - all - </option>
								    <?php foreach($rhi_manufacturers as $rhimanufacturerid => $rhi_manufacturer) { ?>
									<option value="<?php echo esc_attr( $rhimanufacturerid ); ?>"><?php echo esc_attr( $rhi_manufacturer ); ?></option>
									<?php } ?>
								</select>
							</div>


														
							<div class="form-group">
								
								<label for="postcode">By postcode</label>
								<input id="postcode" class="form-control postcodeUK" name="postcode" type="text" placeholder="Enter your postcode (required)" required>
	
							</div>
							
							<input type="hidden" name="filter" value="boiler-maintenance">
							
							<div class="form-group">
								<button type="submit" class="btn btn-submit">Search</button>
							</div>
							
						</form>
					</div>
				</div>

			</div>
								
		</div>
	
		<div class="col-md-6 serv-nav">
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