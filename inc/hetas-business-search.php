<?php
function hetas_business_search( $query ) {

    if ( is_admin() || ! $query->is_main_query() )
        return;

    if ( is_post_type_archive( 'business' ) ) {
	    $terms = array();
	    if (isset($_GET['dry-stove']) && !empty($_GET['dry-stove'])) {
		    $terms[] = 'dry-stove-room-heater-cooker';
	    }
	    if (isset($_GET['stove-with-boiler']) && !empty($_GET['stove-with-boiler'])) {
		    $terms[] = 'stove-room-heater-cooker-including-boiler';
	    }
	    if (isset($_GET['flues-chimneys']) && !empty($_GET['flues-chimneys'])) {
		    $terms[] = 'factory-madesystem-chimney-internal-or-external';
		    $terms[] = 'flue-liner-or-external-factory-madesystem-chimney';
	    }
	    if (isset($_GET['biomass-wet-system']) && !empty($_GET['biomass-wet-system'])) {
		    $terms[] = 'biomass-boiler';
		    $terms[] = 'pellet-stove-boiler';
		    $terms[] = 'mcs-biomass-installation';
	    }
	    if (isset($_GET['heating-systems']) && !empty($_GET['heating-systems'])) {
		    $terms[] = 'biomass-boiler';
		    $terms[] = 'pellet-stove-boiler';
		    $terms[] = 'stove-room-heater-cooker-including-boiler';
		    $terms[] = 'install-a-heating-system';
		    $terms[] = 'mcs-biomass-installation';
		    $terms[] = 'mcs-solar-thermal-installation';
		    $terms[] = 'solar-thermal-installation';
	    }
	    if (isset($_GET['plumbing-sanitary-ware']) && !empty($_GET['plumbing-sanitary-ware'])) {
		    $terms[] = 'plumbing-and-sanitary-ware';
	    }
	    if (isset($_GET['mcs-biomass']) && !empty($_GET['mcs-biomass'])) {
		    $terms[] = 'mcs-biomass-installation';
	    }
	    if (isset($_GET['mcs-solar-thermal']) && !empty($_GET['mcs-solar-thermal'])) {
		    $terms[] = 'mcs-solar-thermal-installation';
	    }
	    if (isset($_GET['service-maintenance']) && !empty($_GET['service-maintenance'])) {
		    $terms[] = 'service-and-maintenance';
	    }
        // Display 50 posts for a custom post type called 'movie'
        $query->set( 'posts_per_page', -1 );
		$unique_terms = array_unique($terms);
		$tax_query = array(
			array(
				'taxonomy' => 'competencies',
				'field'    => 'slug',
				'terms'    => $unique_terms,
	        )
		);
		
        $query->set( 'tax_query', $tax_query);

	    //echo '<pre>'; print_r($query); echo '</pre>'; wp_die();

        return;
    }
}
add_action( 'pre_get_posts', 'hetas_business_search', 1 );
