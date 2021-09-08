<?php
get_header();
$call_crm = new Dynamics_crm('Dynamics_crm', '1.0.0');
$boiler_competences = $call_crm->get_boiler_maintenance_competencies();
$comps = wp_list_pluck( $boiler_competences->value, 'van_name' );
$competencies = get_terms(array(
	'taxonomy' => 'competencies',
	'name' => $comps
));
$rhi_manufacturers = $call_crm->get_all_rhi_manufacturers();
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
						
						<h3>Find HETAS Approved Boiler Maintenance</h3>

						<form class="cmxform" id="geocode" method="get" action="/business/">

							<div class="form-group">
								<label for="competencies">By Boiler Maintenance Competencies</label>
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
								    <?php foreach($rhi_manufacturers->value as $rhi_manufacturer) { ?>
									<option value="<?php echo $rhi_manufacturer->van_rhimanufacturerid; ?>"><?php echo $rhi_manufacturer->van_name; ?></option>
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