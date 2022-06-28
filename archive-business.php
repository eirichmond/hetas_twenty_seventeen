
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
				'terms' => array(5412,5414)
				// 'terms' => array(488,518) // pre CRM update
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
				'terms' => array(5412)
				// 'terms' => array(488,518) // pre CRM update
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

} elseif(isset($_GET['bypass']) && $_GET['bypass'] == 'postcode') {
	$update = array(
		'post_type' => 'business',
		'posts_per_page' => '-1',
		'meta_query' => array(
			array(
				'key' => 'inst_display',
				'value' => '1',
				'compare' => '='
			)
		),
	);

	if(isset($_GET["filter"]) && $_GET["filter"] == 'boiler-maintenance') {
		$meta_array = array(
			'key' => 'rhi_manufacturers',
			'compare' => 'EXISTS'
		);
		$update['meta_query'][] = $meta_array;
	};

	if(isset($_GET["nationwide-search"]) && $_GET["nationwide-search"] == '1') {
		$distance_to_search = 600;
		$meta_array = array(
			'key' => 'nationwide_search',
			'value' => '1',
			'compare' => '='
		);
		//$update['meta_query']['relation'] = 'OR';
		$update['meta_query'][] = $meta_array;
	};








	$filter = array(
		'habms-domestic-installations' => array('habms-domestic-installations'),
		'habms-large-non-domestic-installations-1000-kw' => array('habms-large-non-domestic-installations-1000-kw'),
		'habms-medium-non-domestic-installations-200-to-1000kw' => array('habms-medium-non-domestic-installations-200-to-1000kw'),
		'habms-small-non-domestic-installations-200kw' => array('habms-small-non-domestic-installations-200kw')
	);

	$terms = array();
	foreach($_GET as $key=>$value) {

	    if ($value == "filter") {
	        $terms[] = $filter[$key];
	    }

		if ($value == "boiler-maintenance") {
			if(!empty($_GET["competencies"])) {
				$terms[] = $filter[$_GET["competencies"]];
			} else {
				$terms[] = array('habms-domestic-installations', 'habms-small-non-domestic-installations-200kw', 'habms-medium-non-domestic-installations-200-to-1000kw', 'habms-large-non-domestic-installations-1000-kw');
			}
			
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

	//$update['business-status'] = "Live,Live PRA 3 Month";
	


	/* update the search query */
	global $wp_query;
	$args = array_merge( $wp_query->query, $update );
	
		//var_dump($ids);


	if ($update) {
		query_posts( $args );
	}








	$posts = array();
	$the_query = new WP_Query( $update );


	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			//$post->distance = distance($location[0], $location[1], get_custom_field($post->ID, 'inst_lat'), get_custom_field($post->ID, 'inst_lng') );
			$posts[] = $post;
		}
	}

	$posts = apply_filters('nationwide_by_manufacturer_filter', $posts, $_GET);

	/* Restore original Post Data */
	wp_reset_postdata();

	
} else {

	$distance_to_search = 50; /* miles */
	$location = false;

	$update = array(
		'posts_per_page' => '-1',
		'meta_query' => array(
			array(
				'key' => 'inst_display',
				'value' => '1',
				'compare' => '='
			)
		),
	);

	if(isset($_GET["filter"]) && $_GET["filter"] == 'boiler-maintenance') {
		$meta_array = array(
			'key' => 'rhi_manufacturers',
			'compare' => 'EXISTS'
		);
		$update['meta_query'][] = $meta_array;
	};

	// if(isset($_GET["nationwide-search"]) && $_GET["nationwide-search"] == '1') {
	// 	$distance_to_search = 600;
	// 	$meta_array = array(
	// 		'key' => 'nationwide_search',
	// 		'value' => '1',
	// 		'compare' => '='
	// 	);
	// 	//$update['meta_query']['relation'] = 'OR';
	// 	$update['meta_query'][] = $meta_array;
	// };




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
		'service-and-maintenance-dry-appliances' => array('service-and-maintenance-dry-appliances'),
		'service-and-maintenance-wet-systems' => array('service-and-maintenance-wet-systems'),
		'service-and-maintenance-biomass-systems' => array('service-and-maintenance-biomass-systems'),
		'chimney-sweep' => array('hetas-approved-chimney-sweep-apics', 'hetas-approved-chimney-sweep-gomcs', 'hetas-approved-chimney-sweep-nacs', 'hetas-approved-chimney-sweep-sweep-safe', 'hetas-approved-chimney-sweep-de', 'chimney-sweep-biomass-facilities', 'chimney-sweep-camera-surveys','chimney-sweep-power-sweeping'),
		'retailer' => array('hetas-approved-retail-advisor'),
		'habms-domestic-installations' => array('habms-domestic-installations'),
		'habms-large-non-domestic-installations-1000-kw' => array('habms-large-non-domestic-installations-1000-kw'),
		'habms-medium-non-domestic-installations-200-to-1000kw' => array('habms-medium-non-domestic-installations-200-to-1000kw'),
		'habms-small-non-domestic-installations-200kw' => array('habms-small-non-domestic-installations-200kw')
	);

	$terms = array();
	foreach($_GET as $key=>$value) {

	    if ($value == "filter") {
	        $terms[] = $filter[$key];
	    }

		if ($value == "boiler-maintenance") {
			if(!empty($_GET["competencies"])) {
				$terms[] = $filter[$_GET["competencies"]];
			} else {
				$terms[] = array('habms-domestic-installations', 'habms-small-non-domestic-installations-200kw', 'habms-medium-non-domestic-installations-200-to-1000kw', 'habms-large-non-domestic-installations-1000-kw');
			}
			
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

	//$update['business-status'] = "Live,Live PRA 3 Month";
	


	/* update the search query */
	global $wp_query;
	$args = array_merge( $wp_query->query, $update );
	
		//var_dump($ids);


	if ($update) {
		query_posts( $args );
	}

	// fetch all the posts
	$posts = array();
	while ( have_posts() ) : the_post();
		$post->distance = distance($location[0], $location[1], get_custom_field($post->ID, 'inst_lat'), get_custom_field($post->ID, 'inst_lng') );
		$posts[] = apply_filters('check_rhi_manufacturer', $post, $_GET);
	endwhile;
	$posts = array_filter($posts);
	if(in_array('boiler-maintenance', $_GET)) {
		$posts = apply_filters('nationwide_by_manufacturer_filter', $posts, $_GET);
	}

	

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

	if(isset($_GET['filter']) && $_GET['filter'] == 'boiler-maintenance') {
		$result = 'Businesses';
	}
}

?>

<?php get_template_part( 'header-parts/search', 'nav' ); ?>

<div class="heading">
	<h2>The following <?php echo $result; ?> have been found:</h2>
</div>




<div class="row">
	<div class="col-md-9">

		<?php if ( $posts ) : ?>

			<div id="main">
				<div id="content">
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


								</div>
								<div class="col-md-6">

									<h4>Areas of work:</h4>

									<?php
									$terms = get_the_terms( $post->ID, 'competencies' );
									$terms = reorder_biomass_competencies($terms);
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

									<?php if (has_field($post->ID, 'rhi_manufacturers')) : $rhi_manufacturers = get_post_meta($post->ID, 'rhi_manufacturers'); ?>
										<h4>Manufacturers:</h4>
										<ul>
											<?php foreach($rhi_manufacturers[0] as $k => $value) { ?>
												<li><?php echo esc_attr( $value['van_name'] ); ?></li>
											<?php } ?>
										</ul>

									<?php endif; ?>

									<?php if (has_field($post->ID, 'inst_email')) : ?>
									<a href="mailto:<?php custom_field($post->ID, 'inst_email'); ?>" class="btn btn-dark">Contact &raquo;</a>
									<?php endif; ?>

								</div>
							</div>

						</li>
						<?php endforeach; ?>
					</ul>
				</div>


			</div><!-- /main -->

		<?php else: ?>
			<?php if(isset($_GET['filter']) && $_GET['filter'] == 'boiler-maintenance') { ?>
				<p>There are no businesses local to this postcode, please try our <a href="/search-boiler-maintenance/?search=nationwide">nationwide provider search.</a></p>
			<?php } else { ?>
				<p>Sorry, no businesses could be found.</p>
			<?php } ?>
		<?php endif; ?>

	</div>

	<div class="col-md-3">
	<?php get_sidebar('searchresults'); ?>
	</div>

</div><!-- /row -->

<?php get_footer();?>