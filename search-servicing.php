<?php
get_header();
/*
Template Name: Search Servicing
*/
?>

<?php get_template_part( 'header-parts/search', 'nav' ); ?>

<div class="hsp">
	<div class="row">
		<div class="col-md-6 serv-search">
			
			<!-- Nav tabs -->
			<ul class="nav nav-tabs hbg" role="tablist">
				<li role="presentation" class="active"><a href="#findbusiness" aria-controls="findbusiness" role="tab" data-toggle="tab">Find Business</a></li>
				<li role="presentation"><a href="#checkbusiness" aria-controls="checkbusiness" role="tab" data-toggle="tab">Check Business</a></li>
			</ul>
			
			<!-- Tab panes -->
			<div class="tab-content">
				
				<div role="tabpanel" class="tab-pane fade in active" id="findbusiness">
					<div class="hetasform hybrid">
						
						<h3>Find HETAS Approved Servicing</h3>

						<form class="cmxform" id="geocode" method="get" action="/business/">
														
							<div class="form-group">
								
								<label for="postcode">By postcode</label>
								<input id="postcode" class="form-control postcodeUK" name="postcode" type="text" placeholder="Enter your postcode (required)" required>
	
							</div>
							
							<span class="lbl">Servicing Type</span>
							
							<div class="checkbox">
								<label>
									<input type="checkbox" name="service-and-maintenance-dry-appliances" value="filter" checked>
									Service & Maintenance - Dry appliances
								</label>
							</div>
							
							<div class="checkbox">
								<label>
									<input type="checkbox" name="service-and-maintenance-wet-systems" value="filter" checked>
									Service & Maintenance - Wet systems
								</label>
							</div>
							
							<div class="checkbox">
								<label>
									<input type="checkbox" name="service-and-maintenance-biomass-systems" value="filter" checked>
									Service & Maintenance - Biomass systems
								</label>
							</div>

							
							<div class="form-group">
								<button type="submit" class="btn btn-submit">Search</button>
							</div>
							
						</form>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="checkbusiness">
					<div class="hetasform hybrid">
						
						<h3>Check for HETAS Registration</h3>
						<form action="/business/" method="get" id="geocode">
							
							
							<div class="form-group">
								
								<label for="regid">Registration Number</label>
								<input id="regid" class="form-control" name="regid" type="text">
	
							</div>
							
							<h3 style="text-align:center;margin-bottom:0px;">OR</h3>
							
							<div class="form-group">
								
								<label for="businessname">Business Name</label>
								<input id="businessname" class="form-control" name="businessname" type="text">
	
							</div>
							
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