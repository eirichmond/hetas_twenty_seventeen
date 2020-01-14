<?php
get_header();
/*
Template Name: Search Appliance
*/

$appliance_types = get_terms('appliance_type');
$product_types = get_terms('product_type');
$fuel_types = get_terms('fuel_types');
$brands = get_terms('manufacturers');


$meta_key = 'app_model_name';

$all_models = $wpdb->get_col( $wpdb->prepare(
	"
	SELECT      key1.meta_value
	FROM        $wpdb->postmeta key1
	WHERE       key1.meta_key = %s
	",
	$meta_key
) );

$model_titles = array_unique($all_models);

sort($model_titles);

$js_m_titles = json_encode($model_titles);

?>

<script>
var models = <?php echo $js_m_titles; ?>;

jQuery(document).ready(function(){
	jQuery( "#model" ).autocomplete({
	  source: models
	});
});

</script>

<?php get_template_part( 'header-parts/search', 'nav' ); ?>

<div class="hsp">
	<div class="row">
		<div class="col-md-9 app-search">

			<div class="hetasform">

				<form action="/appliance/" method="get">

					<h3>Find a Product</h3>
					<div class="row">
						<div class="col-md-6">

							<div class="form-group">
								<label for="manufacturer">Manufacturer's Name</label>
								<select id="manufacturer" name="manufacturer" class="form-control">
								    <option value=""> - all - </option>
								    <?php foreach($brands as $tag) { ?>
									<option value="<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></option>
									<?php } ?>
								</select>
							</div>

							<div class="form-group">
								<label for="appliance-type">Product Type</label>
								<select id="appliance-type" name="appliance-type" class="form-control">
								    <option value=""> - all - </option>
								    <?php foreach($appliance_types as $tag) { ?>
									<option value="<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></option>
									<?php } ?>
								</select>
							</div>

						</div>
						<div class="col-md-6">

							<div class="form-group">
								<label for="model">Model Name</label>
								<input class="form-control text" type="text" name="model" id="model">
							</div>

							<div class="form-group">
								<label for="fuel-type">Fuel Type</label>
								<select id="fuel-type" name="fuel-type" class="form-control">
								    <option value=""> - all - </option>
								    <?php foreach($fuel_types as $tag) { ?>
									<option value="<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></option>
									<?php } ?>
								</select>
							</div>

						</div>

					</div>

					<h3 class="midtit">Design Filters</h3>
					<div class="row">
						<div class="col-md-6">

							<div class="form-group">
								<label for="style">Style</label>
								<select id="style" name="style" class="form-control">
								    <option value=""> - all - </option>
									<option value="freestanding">Freestanding</option>
									<option value="inset">Inset</option>
								</select>
							</div>

							<div class="form-group">
								<label for="fuel-operation">Fuel Operation</label>
								<select id="fuel-operation" name="fuel-operation" class="form-control">
								    <option value=""> - all - </option>
									<option value="intermittent-logs">Intermittent Logs</option>
									<option value="continuous-logs">Continuous Logs</option>
									<option value="intermittent-mineral">Intermittent Mineral</option>
									<option value="continuous-mineral">Continuous Mineral</option>
								</select>
							</div>

							<div class="form-group">
								<label for="refueling">Refueling</label>
								<select id="refueling" name="refueling" class="form-control">
								    <option value=""> - all - </option>
									<option value="manual-refuel">Manual Refuel</option>
									<option value="automatic-refuel">Automatic Refuel</option>
								</select>
							</div>

							<div class="form-group">
								<label for="efficiency">Efficiency more than ></label>
								<select id="efficiency" name="efficiency" class="form-control">
								    <option value=""> - any - </option>
									<option value="50">50</option>
									<option value="60">60</option>
									<option value="70">70</option>
									<option value="80">80</option>
									<option value="90">90</option>
								</select>
							</div>


						</div>
						<div class="col-md-6">

							<div class="form-group">
								<label for="primary-air-control">Primary Air Control</label>
								<select id="primary-air-control" name="primary-air-control" class="form-control">
								    <option value=""> - all - </option>
									<option value="manual-air-control">Manual Air Control</option>
									<option value="automatic-air-control">Automatic Air Control</option>
									<option value="thermostatic-air-control">Thermostatic Air Control</option>
								</select>
							</div>

							<div class="form-group">
								<label for="hearth-requirement">Hearth Requirement</label>
								<select id="hearth-requirement" name="hearth-requirement" class="form-control">
								    <option value=""> - all - </option>
									<option value="constructional">Constructional</option>
									<option value="superimposed">Superimposed</option>
								</select>
							</div>

							<div class="form-group">
								<label for="loading-function">Loading Function</label>
								<select id="loading-function" name="loading-function" class="form-control">
								    <option value=""> - all - </option>
									<option value="front-loading">Front Loading</option>
									<option value="top-loading">Top Loading</option>
								</select>
							</div>

							<div class="form-group">
								<label for="output">Output between</label>
								<select id="output" name="output"  class="form-control">
								    <option value=""> - any - </option>
									<option value="2.5/5">2.5 and 5</option>
									<option value="5/7.5">5 and 7.5</option>
									<option value="7.5/10">7.5 and 10</option>
									<option value="10/15">10 and 15</option>
									<option value="15/20">15 and 20</option>
									<option value="20/99">20 and above</option>
								</select>
							</div>

						</div>

					</div>


					<h3 class="midtit">Additional Filters</h3>
					<div class="row">

						<div class="col-md-3">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="auto_ignition" value="yes">
									Auto Ignition
								</label>
							</div>
						</div>

						<div class="col-md-3">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="external_installation" value="yes">
									External Installation
								</label>
							</div>
						</div>

						<div class="col-md-3">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="accumulator_required" value="yes">
									Accumulator Required
								</label>
							</div>
						</div>

						<div class="col-md-3">
						</div>

					</div>

					<h3 class="midtit">Certification Status</h3>
					<div class="row">

						<div class="col-md-3">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="defra-exempt"  value="yes">
									DEFRA Exempted
								</label>
							</div>
						</div>

						<div class="col-md-3">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="mcs-approved" value="yes">
									MCS Certified
								</label>
							</div>
						</div>

						<div class="col-md-3">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="sia_ecodesign_ready" value="yes">
									SIA EcoDesign Ready
								</label>
							</div>
						</div>

						<div class="col-md-3">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="hetas-approved" value="yes" checked>
									HETAS Approved
								</label>
							</div>
						</div>

					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-submit">Search</button>
					</div>

				</form>
			</div>

		</div>
		<div class="col-md-3 app-nav">

			<a title="Permanent Ventilators" href="<?php echo get_option('het_covents_pdf'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/co-alarms-vents.jpg" alt="Permanent Ventilators" ></a>
			<a title="Ancillary Products" href="<?php echo get_option('het_linkupsys_pdf'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/heat-genie.jpg" alt="Ancillary Products" ></a>
			<a title="CO Alarms & Analysers" href="<?php echo get_option('het_codetectors_pdf'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/co-alarm.jpg" alt="CO Alarms & Analysers" ></a>

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