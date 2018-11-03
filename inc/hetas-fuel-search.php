<?php
function hetas_fuel_search( $query ) {

    if ( is_admin() || ! $query->is_main_query() )
        return;

    if ( is_post_type_archive( 'fuel' ) ) {
	    
		$tax_query = array();
		
		if (isset($_GET['fuel-type']) && !empty($_GET['fuel-type'])){
			if (isset($_GET['enplus']) && !empty($_GET['enplus'])) {
				$tax_query['tax_query']['relation'] = 'AND';
				$tax_query['tax_query'][0]['taxonomy'] = 'types';
				$tax_query['tax_query'][0]['field'] = 'slug';
				$tax_query['tax_query'][0]['terms'] = $_GET['fuel-type'];
				$tax_query['tax_query'][1]['taxonomy'] = 'enplus';
				$tax_query['tax_query'][1]['field'] = 'slug';
				$tax_query['tax_query'][1]['terms'] = $_GET['enplus'];
			} else {
				$tax_query['tax_query'][0]['taxonomy'] = 'types';
				$tax_query['tax_query'][0]['field'] = 'slug';
				$tax_query['tax_query'][0]['terms'] = $_GET['fuel-type'];
			}
		} elseif (isset($_GET['enplus']) && !empty($_GET['enplus'])){
				$tax_query['tax_query'][0]['taxonomy'] = 'enplus';
				$tax_query['tax_query'][0]['field'] = 'slug';
				$tax_query['tax_query'][0]['terms'] = $_GET['enplus'];
		}
		
		$args = array(
			'post_type' => 'fuel',
			'posts_per_page' => '15',
			'meta_key' => 'fuels_locality', 
			'meta_value' => 'Local',
			'post_status' => 'publish'
		);
		
		$update = array_merge($args, $tax_query);
		//$postslist = get_posts( $merged );
		
		/*
		echo '<pre>';
		print_r($merged);
		echo '</pre>';
		
		echo '<pre>';
		print_r($postslist);
		echo '</pre>';
		
		
		wp_die();
		*/
		
		/* update the query for any search terms that have been supplied */
		
		$sc_gds = new sc_GeoDataStore();
		
		$distance_to_search = 50; /* miles */
		
		/*
		$update = array(
			'posts_per_page' => '15',
			'meta_key' => 'fuels_locality', 
			'meta_value' => 'Local'
		);
		*/
		
		$has_location = false;
		$location = false;
		
		if (isset($_GET['postcode']) && $_GET['postcode']) {
			$location = geocode_postcode($_GET['postcode']);
		}
		
		if (isset($_GET['lat']) && $_GET['lat'] && isset($_GET['lng']) && $_GET['lng']) {
			$location = array($_GET['lat'], $_GET['lng']);
		}
		
		if ($location) {
		    /* we need to order the posts by distance from $location */
		    $ids = $sc_gds->getPostIDsOfInRange('fuel', $distance_to_search, $location[0], $location[1]);
		    $update['post__in'] = $ids;
		}
		
		$has_location = (bool) $location;
		
		$terms = array();
		foreach($_GET as $key=>$value) {
		    if ($value == "filter") {
		        $terms[] = $key;
		    }
		}
		
		
		if ($terms) {
		    $update['competencies'] = join(",", $terms);
		}
		
		if (isset($_GET['types']) && $_GET['types']) {
			$update['types'] = $_GET['types'];
		}
		
		if (isset($_GET['enplus']) && $_GET['enplus']) {
			$update['enplus'] = $_GET['enplus'];
		}
		
		/* update the search query */
		global $wp_query;
		$args = array_merge( $wp_query->query, $update );
		
		
		if ($update) {
			query_posts( $args );
		}
		
		// fetch all the posts
		$posts = array();
		while ( have_posts() ) : the_post(); 
			$post->distance = intval(distance($location[0], $location[1], get_custom_field($post->ID, 'inst_lat'), get_custom_field($post->ID, 'inst_lng') ) );
			$posts[] = $post;
		endwhile;
		
		// sort them by distance
		function compare_distance($a, $b) {
		    return $a->distance < $b->distance;
		}
		usort($posts, "compare_distance");
		$posts = array_reverse($posts);
		
		// grab the top 15 closest
		$posts = array_slice($posts, 0, 15);

	    //echo '<pre>'; print_r($query); echo '</pre>'; wp_die();

        return;
    }
}
add_action( 'pre_get_posts', 'hetas_fuel_search', 1 );
