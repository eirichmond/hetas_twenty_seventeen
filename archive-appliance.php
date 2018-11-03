<?php
get_header();

/* update the query for any search terms that have been supplied */
//$temp = $wp_query; $wp_query= null;
$update = array(
	'posts_per_page' => 100,
	'paged' => $paged
);

if (isset($_GET['manufacturer']) && $_GET['manufacturer']) {
	$update['tax_query'][] = array(
		'taxonomy' => 'manufacturers',
		'terms' => $_GET['manufacturer'],
		'field' => 'slug',
	);
}


/*
if (isset($_GET['product-type']) && $_GET['product-type']) {
	$update['meta_query'][] = array(
		'key' => 'product_type',
		'value' => $_GET['product-type']
	);
}
*/

if (isset($_GET['appliance-type']) && $_GET['appliance-type']) {
	$update['tax_query'][] = array(
		'taxonomy' => 'appliance_type',
		'terms' => $_GET['appliance-type'],
		'field' => 'slug',
	);
}

if (isset($_GET['fuel-type']) && $_GET['fuel-type']) {
	$update['tax_query'][] = array(
		'taxonomy' => 'fuel_types',
		'terms' => $_GET['fuel-type'],
		'field' => 'slug',
	);
}

if (isset($_GET['fuel-operation']) && $_GET['fuel-operation']) {
	$update['tax_query'][] = array(
		'taxonomy' => 'appliance_feature_icons',
		'terms' => $_GET['fuel-operation'],
		'field' => 'slug',
	);
}

if (isset($_GET['output']) && $_GET['output']) {
	$op = explode("/", $_GET['output']);
	$update['meta_query'][] = array(
		'key' => 'output_value',
		'value' => array(intval($op[0]), intval($op[1])),
		'type' => 'numeric',
		'compare' => 'BETWEEN'
	);
/*
	$update['meta_query'][] = array(
		'key' => 'output_value',
		'value' => $op[1],
		'compare' => '<',
	);
*/
}

if (isset($_GET['model']) && $_GET['model']) {
	$update['meta_query'][] = array(
		'key' => 'app_model_name',
		'value' => '' . $_GET['model'] . '',
		'compare' => 'LIKE'
	);
}
 
if (isset($_GET['efficiency']) && $_GET['efficiency']) {
	$update['meta_query'][] = array(
		'key' => 'app_sap_efficiency',
		'value' => array( intval($_GET['efficiency']), 100 ),
		'type' => 'numeric',
		'compare' => 'BETWEEN'
	);
}

if (isset($_GET['style']) && $_GET['style']) {
	$update['meta_query'][] = array(
		'key' => $_GET['style'],
		'value' => "Yes"
	);
}

if (isset($_GET['primary-air-control']) && $_GET['primary-air-control']) {
	$update['tax_query'][] = array(
		'taxonomy' => 'appliance_feature_icons',
		'terms' => $_GET['primary-air-control'],
		'field' => 'slug',
	);
}

if (isset($_GET['hearth-requirement']) && $_GET['hearth-requirement']) {
	$update['tax_query'][] = array(
		'taxonomy' => 'appliance_feature_icons',
		'terms' => $_GET['hearth-requirement'],
		'field' => 'slug',
	);
}

if (isset($_GET['refueling']) && $_GET['refueling']) {
	$update['tax_query'][] = array(
		'taxonomy' => 'appliance_feature_icons',
		'terms' => $_GET['refueling'],
		'field' => 'slug',
	);
}

if (isset($_GET['loading-function']) && $_GET['loading-function']) {
	$update['tax_query'][] = array(
		'taxonomy' => 'appliance_feature_icons',
		'terms' => $_GET['loading-function'],
		'field' => 'slug',
	);
}

if (isset($_GET['auto_ignition']) && $_GET['auto_ignition'] == "yes") {
	$update['meta_query'][] = array(
		'key' => 'auto_ignition',
		'value' => "Yes"
	);
}

if (isset($_GET['external_installation']) && $_GET['external_installation'] == "yes") {
	$update['meta_query'][] = array(
		'key' => 'external_installation',
		'value' => "Yes"
	);
}

if (isset($_GET['accumulator_required']) && $_GET['accumulator_required'] == "yes") {
	$update['meta_query'][] = array(
		'key' => 'accumulator_required',
		'value' => "Yes"
	);
}

if (isset($_GET['defra-exempt']) && $_GET['defra-exempt'] == "yes") {
	$update['meta_query'][] = array(
		'key' => 'app_clean_air_exempt',
		'value' => "Yes"
	);
}

if (isset($_GET['mcs-approved']) && $_GET['mcs-approved'] == "yes") {
	$update['meta_query'][] = array(
		'key' => 'app_mcs_approved',
		'value' => "Yes"
	);
}

if (isset($_GET['sia_ecodesign_ready']) && $_GET['sia_ecodesign_ready'] == "yes") {
	$update['meta_query'][] = array(
		'key' => 'sia_ecodesign_ready',
		'value' => "Yes"
	);
}

if (isset($_GET['hetas-approved']) && $_GET['hetas-approved'] == "yes") {
	$update['meta_query'][] = array(
		'key' => 'hetas_approved',
		'value' => "Yes"
	);
}

if (isset($_GET['external-air-supply']) && $_GET['external-air-supply'] == "yes") {
	$update['meta_query'][] = array(
		'key' => 'app_external_air_supply',
		'value' => "Yes"
	);
}

if (isset($_GET['emissions-certification']) && $_GET['emissions-certification'] == "yes") {
	$update['meta_query'][] = array(
		'key' => 'app_emissions_cert',
		'value' => "Yes"
	);
}

$prem_list = array(
	'order' => 'ASC',
	'meta_key' => 'app_listing_type',
	'orderby' => 'meta_value_num'
);


/* update the search query */
global $wp_query;

$total_pages = $wp_query->max_num_pages; 

$args = array_merge( $wp_query->query, $update, $prem_list );

if (count($update['tax_query']) > 1) {
	$update['tax_query']['relation'] = 'AND';
	$update['tax_query'] = array_reverse($update['tax_query']);
}

if (count($update['meta_query']) > 1) {
	$update['meta_query']['relation'] = 'AND';
	$update['meta_query'] = array_reverse($update['meta_query']);
}



if ($update) {
	
	$prem_posts = new WP_Query( $args );

}

?>


	<?php get_template_part( 'header-parts/search', 'nav' ); ?>
		
		<?php if ( $prem_posts->have_posts() ) : ?> 
			<div class="heading">
				<h2>The following appliances have been found:</h2>
			</div>
			
			
			<div id="main">
				<div id="content">
					
					
					<ul class="search-results">
						<?php while ( $prem_posts->have_posts() ) : $prem_posts->the_post(); ?>
						
							<?php
							$image = get_custom_field($post->ID, 'app_appliance_image');
							$list_type = get_custom_field($post->ID, 'app_listing_type');
							$attachment = get_page_by_title( $image,'OBJECT','attachment' );
							$hetas_approved = get_custom_field($post->ID, 'hetas_approved');
							$defra_approved = get_custom_field($post->ID, 'app_clean_air_exempt');
							$sia_ecodesign = get_custom_field($post->ID, 'sia_ecodesign_ready');
							$app_mcs_approved = get_custom_field($post->ID, 'app_mcs_approved');
							
							?>
							<?php if ($list_type == 1) { ?>
							
							
							
								<li class="premium">
								
								<div class="row">
									<div class="col-md-2">
									<?php if (!empty($attachment)) { ?>
										<div class="img">
											<?php echo wp_get_attachment_image( $attachment->ID, 'appliance-thumb'); ?>
										</div>
									<?php } else { ?>
										<div class="img">
											<img src="<?php echo bloginfo ('template_url'); ?>/images/hetas-logo.png" alt="<?php echo $image; ?>" />
										</div>
									<?php } ?>
									</div>
									
									<div class="col-md-10">
											
										<div class="descr">
											
											<div class="row">
												<div class="col-md-10">
													<div class="info-block">
														<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
														<p><?php the_excerpt(); ?></p>
														<ul class="app-certs">
														<?php if ($hetas_approved == 'Yes') { ?>
															<li>
																<img src="<?php echo bloginfo('template_url'); ?>/images/approved_appliance_logo-sm.jpg" alt="HETAS Approved" />
															</li>
														<?php } ?>
														<?php if ($defra_approved == 'Yes') { ?>
															<li>
																<img src="<?php echo bloginfo('template_url'); ?>/images/defra_logo-sm.jpg" alt="defra logo" />
															</li>
														<?php } ?>
														<?php if ($app_mcs_approved == 'Yes') { ?>
															<li>
																<img src="<?php echo bloginfo('template_url'); ?>/images/mcs-logo.jpg" alt="mcs logo" />
															</li>
														<?php } ?>
														<?php if ($sia_ecodesign == 'Yes') { ?>
															<li>
																<img src="<?php echo bloginfo('template_url'); ?>/images/sia_ecodesign_logo-sm.jpg" alt="CE logo" />
															</li>
														<?php } ?>
														</ul>
			
													</div>
												</div>
												
												<div class="col-md-2">
													<div class="cell">
														<ul>
															<?php echo get_the_term_list( $post->ID, 'fuel_types', '<li>', '</li><li>', '</li>' ); ?>
														</ul>
														<a href="<?php the_permalink(); ?>" class="btn btn-primary">Details &raquo;</a>
													</div>
												</div>
											</div>
											
											
										</div>
									
									</div>
									
								</div>
								</li>
								
								
								
							<?php } elseif ($list_type == 2) { ?>
								<li class="standard">
									<div class="row">
										<div class="col-md-2">

										<?php if (!empty($attachment)) { ?>
											<div class="img">
												<?php echo wp_get_attachment_image( $attachment->ID, 'appliance-thumb'); ?>
											</div>
										<?php } else { ?>
											<div class="img">
												<img src="<?php echo bloginfo ('template_url'); ?>/images/hetas-logo.png" alt="<?php echo $image; ?>" />
											</div>
										<?php } ?>
											
<!--
										<?php if (!empty($image)) { ?>
											<?php $upload_dir = wp_upload_dir(); ?>
											
											<div class="img">
												<img src="<?php echo $upload_dir['baseurl']; ?>/<?php echo $image; ?>.png" alt="Standard HETAS listed Appliance" />
											</div>
										<?php } else { ?>
											<div class="img">
												<img src="<?php echo bloginfo ('template_url'); ?>/images/hetas-logo.png" alt="<?php echo $image; ?>" />
											</div>
										<?php } ?>
-->
										
										
										</div>
										<div class="col-md-10">
											<div class="descr">

												<div class="row">
													<div class="col-md-10">
	
														<div class="info-block">
															<h3><?php the_title(); ?></h3>
															<p><?php the_excerpt(); ?></p>
														</div>
														
													</div>
													
													<div class="col-md-2">
	
														<div class="cell">
															<ul>
																<?php echo get_the_term_list( $post->ID, 'fuel_types', '<li>', '</li><li>', '</li>' ); ?>
															</ul>
															
															<?php if (has_field($post->ID, 'docs')) : ?>
																<?php $metas = get_custom_field($post->ID, 'docs'); ?>
																<?php foreach ($metas as $k => $v) { ?>
																	<a href="<?php echo $v['imageurl']; ?>" class="btn standard" target="_blank"><?php echo $v['caption']; ?></a>
																<?php } ?>
															<?php endif; ?>
				
														</div>
													
													</div>
													
													
												</div>
												
												
											</div>
										</div>
									</div>
								</li>
							<?php } elseif ($list_type == 3) { ?>
								<li class="basic">
									<div class="descr">
										<div class="info-block">
											<h3><?php the_title(); ?></h3>
										</div>
										<div class="cell">
											
											<?php if (has_field($post->ID, 'docs')) : ?>
												<?php $metas = get_custom_field($post->ID, 'docs'); ?>
												<?php foreach ($metas as $k => $v) { ?>
													<a href="<?php echo $v['imageurl']; ?>" class="btn standard" target="_blank"><?php echo $v['caption']; ?></a>
												<?php } ?>
											<?php endif; ?>

										</div>
									</div>
								</li>
							<?php } ?>
						<?php endwhile; ?>
					</ul>



					<?php get_template_part( 'inc/app_nav' ); ?>
					



				</div>



			<?php else: ?>
			<div id="main">
				<div id="content">
					<p>Sorry, no appliances could be found.</p>
				</div>
			<?php endif; ?>
			
			
			</div><!-- /main -->
<?php get_footer();?>