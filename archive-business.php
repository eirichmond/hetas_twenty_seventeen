
<?php

get_header(); ?>

<?php
	
/* update the query for any search terms that have been supplied */

if (isset($_GET['regid']) && $_GET['regid']) {
	$metavalue = $_GET['regid'];
	$posts = array();
	$the_query = new WP_Query( array(
		'posts_per_page' => '-1',
		'post_type' => 'business',
		'meta_key' => 'inst_id',
		'meta_value' => $metavalue,
		'tax_query' => array(
			array(
				'taxonomy' => 'business-status',
				'field' => 'id',
				'terms' => array(488,518)
			)
		)
		)
	);
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			//$post->distance = distance($location[0], $location[1], get_custom_field($post->ID, 'inst_lat'), get_custom_field($post->ID, 'inst_lng') );
			$posts[] = $post;
		}
	}
	/* Restore original Post Data */
	wp_reset_postdata();
} elseif (isset($_GET['businessname']) && $_GET['businessname']) {
	$metabusinessname = $_GET['businessname'];
	$posts = array();
	$the_query = new WP_Query( array(
		'posts_per_page' => '-1',
		'post_type' => 'business',
		'meta_query' => array(
			array(
				'key' => 'inst_company',
				'value' => $metabusinessname,
				'compare' => 'LIKE'
			)
		),
		'tax_query' => array(
			array(
				'taxonomy' => 'business-status',
				'field' => 'id',
				'terms' => array(488,518)
			)
		)
		)
	);
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			//$post->distance = distance($location[0], $location[1], get_custom_field($post->ID, 'inst_lat'), get_custom_field($post->ID, 'inst_lng') );
			$posts[] = $post;
		}
	}
	/* Restore original Post Data */
	wp_reset_postdata();
} else {
		
/*
	$posts = array();
	$the_query = new WP_Query( array(
		'posts_per_page' => '-1',
		'post_type' => 'business',
		'tax_query' => array(
			array(
				'taxonomy' => 'business-status',
				'field' => 'id',
				'terms' => array(488,518)
			)
		)
		)
	);
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			//$post->distance = distance($location[0], $location[1], get_custom_field($post->ID, 'inst_lat'), get_custom_field($post->ID, 'inst_lng') );
			$posts[] = $post;
		}
	}
	wp_reset_postdata();
*/
	
	$distance_to_search = 50; /* miles */
	$location = false;
	
	$update = array(
		'posts_per_page' => '-1'
	);
	
	if (isset($_GET['postcode']) && $_GET['postcode']) {
		$location = geocode_postcode($_GET['postcode']);
	}
		
	if (isset($_GET['lat']) && $_GET['lat'] && isset($_GET['lng']) && $_GET['lng']) {
		$location = array($_GET['lat'], $_GET['lng']);
	}
	
	if (!$location) {
	    echo "<p>Unable to locate your postcode.</p>";
	    get_footer();
	    exit(0);
	} else {
		$sc_gds = new sc_GeoDataStore();
	    /* we need to order the posts by distance from $location */

	    $ids = $sc_gds->getPostIDsOfInRange('business', $distance_to_search, $location[0], $location[1]);
	    
	    $update['post__in'] = $ids;
	}
	
	
	$filter = array(
		'dry-stove' => array('dry-stove-room-heater-cooker'),
		'stove-with-boiler' => array('stove-room-heater-cooker-including-boiler'),
		'flues-chimneys' => array('factory-madesystem-chimney-internal-or-external', 'flue-liner-or-external-factory-madesystem-chimney','specialist-flue-liner-installation'),
		'biomass-wet-system' => array('biomass-boiler', 'pellet-stove-boiler','mcs-biomass-installation'),
		'heating-systems' => array('biomass-boiler', 'pellet-stove-boiler','stove-room-heater-cooker-including-boiler','install-a-heating-system','mcs-biomass-installation','mcs-solar-thermal-installation','solar-thermal-installation'),
		'plumbing-sanitary-ware' => array('plumbing-and-sanitary-ware'),
		'mcs-biomass' => array('mcs-biomass-installation'),
		'mcs-solar-thermal' => array('mcs-solar-thermal-installation'),
		//'service-maintenance' => array('service-and-maintenance-dry-appliances','service-and-maintenance-biomass-systems','service-and-maintenance-wet-systems'),
		'service-and-maintenance-dry-appliances' => array('service-and-maintenance-dry-appliances'),
		'service-and-maintenance-wet-systems' => array('service-and-maintenance-wet-systems'),
		'service-and-maintenance-biomass-systems' => array('service-and-maintenance-biomass-systems'),
		'chimney-sweep' => array('hetas-approved-chimney-sweep-apics', 'hetas-approved-chimney-sweep-gomcs', 'hetas-approved-chimney-sweep-nacs', 'hetas-approved-chimney-sweep-sweep-safe'),
		'retailer' => array('hetas-approved-retail-advisor')
/*
		'dry-stove-room-heater-cooker' => array('dry-stove'),
		'biomass-boiler' => array('biomass-wet-system', 'heating-systems'),
		'pellet-stove-boiler' => array('biomass-wet-system', 'heating-systems'),
		'stove-room-heater-cooker-including-boiler' => array('stove-with-boiler', 'heating-systems'),
		'factory-madesystem-chimney-internal-or-external' => array('flues-chimneys'),
		'flue-liner-or-external-factory-madesystem-chimney' => array('flues-chimneys'),
		'specialist-flue-liner-installation' => array('flues-chimneys', 'flues-chimneys'),
		'install-a-heating-system' => array('heating-systems'),
		'plumbing-and-sanitary-ware' => array('plumbing-sanitary-ware'),
		'mcs-biomass-installation' => array('biomass-wet-system', 'heating-systems', 'mcs-biomass'),
		'mcs-solar-thermal-installation' => array('heating-systems', 'mcs-solar-thermal'),
		'solar-thermal-installation' => array('heating-systems'),
		'service-and-maintenance' => array('service-maintenance'),
*/
	);
	
	$terms = array();
	foreach($_GET as $key=>$value) {
		
	    if ($value == "filter") {
	        $terms[] = $filter[$key];
	    }
	}

	$taxterms = array();
	foreach ($terms as $term) {
		foreach ($term as $t) {
			$taxterms[] = $t;
		}
	}
	
	$unique = array_unique($taxterms);
	
	if (!$terms) {
		$update['post__in'] = array ( 0 ); /* this will cause an empty result set */
	} else {
	    $update['competencies'] = join(",", $unique);
	}
	
	$update['business-status'] = "Live,Live PRA 3 Month";
	
	/* update the search query */
	global $wp_query;
	$args = array_merge( $wp_query->query, $update );
	
	if ($update) {
		query_posts( $args );
	}

	// fetch all the posts
	$posts = array();
	while ( have_posts() ) : the_post(); 
		$post->distance = distance($location[0], $location[1], get_custom_field($post->ID, 'inst_lat'), get_custom_field($post->ID, 'inst_lng') );
		$posts[] = $post;
	endwhile;
	
	// sort them by distance
	function compare_distance($a, $b) {
	    return $a->distance < $b->distance;
	}
	usort($posts, "compare_distance");
	
	
	
	// grab the top 15 closest
	$posts = array_reverse($posts);
	$posts = array_slice($posts, 0, 15);
	
	
	// a variable for results
	if (isset($_GET['retailer'])) {
		$result = 'Retailers';
	}
	
	if (isset($_GET['stove-with-boiler']) || ($_GET['dry-stove']) || ($_GET['biomas-systems']) || ($_GET['service-and-maintenance'])) {
		$result = 'Installers';
	}
	
	if (isset($_GET['chimney-sweep'])) {
		$result = 'Chimney Sweeps';
	}
}
$google_api_key = hetas_gm_api_key();

?>

<?php get_template_part( 'header-parts/search', 'nav' ); ?>

<div class="heading">
	<h2>The following <?php echo $result; ?> have been found:</h2>
</div>



		    
<div class="row">
	<div class="col-md-9">
	
		<div id="main">
			<div id="content">
				
				<?php if ( $posts ) : ?> 
				
					<ul class="search-results" id="business">
					    <?php foreach ($posts as $post) : ?>
						<li>
							<h3><?php the_title(); ?></h3>
							
							<div class="row">
								<div class="col-md-6">
									<ul>
									    <?php if (has_field($post->ID, 'inst_address_1')) : ?>
								            <li><?php custom_field($post->ID, 'inst_address_1'); ?></li>
								        <?php endif; ?> 
								        <?php if (has_field($post->ID, 'inst_address_2')) : ?>
								            <li><?php custom_field($post->ID, 'inst_address_2'); ?></li>
								        <?php endif; ?>
								        <?php if (has_field($post->ID, 'inst_address_3')) : ?>
								            <li><?php custom_field($post->ID, 'inst_address_3'); ?></li>
								        <?php endif; ?>
								        <?php if (has_field($post->ID, 'inst_town')) : ?>
								            <li><?php custom_field($post->ID, 'inst_town'); ?></li>
								        <?php endif; ?>
								        <?php if (has_field($post->ID, 'inst_county')) : ?>
								            <li><?php custom_field($post->ID, 'inst_county'); ?></li>
								        <?php endif; ?>
								        <?php if (has_field($post->ID, 'inst_postcode')) : ?>
								            <li><?php custom_field($post->ID, 'inst_postcode'); ?></li>
								        <?php endif; ?>
								        <?php if (has_field($post->ID, 'inst_phone')) : ?>
								            <li>Tel: <?php custom_field($post->ID, 'inst_phone'); ?></li>
								        <?php endif; ?>
								        <?php if (has_field($post->ID, 'inst_mobile')) : ?>
								            <li>Mob: <?php custom_field($post->ID, 'inst_mobile'); ?></li>
								        <?php endif; ?>
								        <?php if (has_field($post->ID, 'inst_fax')) : ?>
								            <li>Fax: <?php custom_field($post->ID, 'inst_fax'); ?></li>
								        <?php endif; ?>
								        <?php if (has_field($post->ID, 'inst_website')) : ?>
								            <li>Website: <a href="<?php custom_field($post->ID, 'inst_website'); ?>" target="_blank" title="website" ><?php custom_field($post->ID, 'inst_website'); ?></a></li>
								        <?php endif; ?>
								        <?php if ($post->distance) : ?>
								        <li><?php echo intval($post->distance) > 1 ? intval($post->distance) . " miles away" : "less than a mile away"; ?></li>
								        <?php endif; ?>
									</ul>
									
									<h4>Areas of work:</h4>
									
									<?php
									$terms = get_the_terms( $post->ID, 'competencies' );
									if ( $terms && ! is_wp_error( $terms ) ) : 
										$competencies = array();
										foreach ( $terms as $term ) {
											$competencies[] = $term->name;
										}
									?>
										<ul>
											<?php 
											foreach ($competencies as $competencie) {
												echo '<li>' . $competencie . '</li>';
											}
											?>
										</ul>
									<?php endif; ?>	
									
								    <?php if (has_field($post->ID, 'inst_email')) : ?>
									<a href="mailto:<?php custom_field($post->ID, 'inst_email'); ?>" class="btn btn-dark">Contact &raquo;</a>
									<?php endif; ?>
	
								</div>
								<div class="col-md-6">
									<div class="map retailer">
										
										<iframe width="100%" height="350" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php custom_field($post->ID, 'inst_postcode'); ?>%20&key=<?php echo '-'.$google_api_key; ?>" allowfullscreen></iframe>
	
										
	<!-- 									<a href="https://maps.google.co.uk/maps?q=<?php custom_field($post->ID, 'inst_postcode'); ?>" target="_blank"><img src="https://maps.googleapis.com/maps/api/staticmap?center=<?php custom_field($post->ID, 'inst_lat'); ?>,<?php custom_field($post->ID, 'inst_lng'); ?>&amp;zoom=11&amp;size=360x360&amp;sensor=false&amp;markers=color:green|<?php custom_field($post->ID, 'inst_lat'); ?>,<?php custom_field($post->ID, 'inst_lng'); ?>&key=<?php echo esc_attr( $google_api_key ); ?>"></a> -->
										
									</div>
								</div>
							</div>
								
						</li>
	                    <?php endforeach; ?>
					</ul>

				<?php else: ?>
				
					<p>Sorry, no businesses could be found.</p>
					
				<?php endif; ?>
				
			</div>


		</div><!-- /main -->
			
	</div>
	
	<div class="col-md-3">
		<?php get_sidebar('searchresults'); ?>
	</div>

</div><!-- /row -->			

<?php get_footer();?>