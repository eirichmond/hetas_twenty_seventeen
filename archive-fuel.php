<?php
get_header();

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
	'posts_per_page' => '-1',
	'meta_key' => 'fuels_locality', 
	'meta_value' => 'Local',
	'post_status' => 'publish'
);

if ($tax_query) {
	$update = array_merge($args, $tax_query);
} else {
	$update = $args;
}


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

$google_api_key = hetas_gm_api_key();

?>

<?php get_template_part( 'header-parts/search', 'nav' ); ?>

			<?php if ($has_location) : ?> 
				<div class="heading">
					<h2>The following fuel producers have been found:</h2>
				</div>
			<?php endif; ?>
			
			
			<div class="row">
				
				<div class="col-md-9">
				
					<div id="content">

					<?php if ( have_posts() && $has_location) : ?> 

					<ul class="search-results" id="fuels">
					    <?php foreach ($posts as $post) : ?>
							<li>
								<h3><?php custom_field($post->ID, 'fuels_company'); ?> <?php if ($has_location): ?> - <?php echo $post->distance; ?> miles away <?php endif ?></h3>
								<div class="row">
									
									<div class="col-md-6">
										
										<?php $image = get_custom_field($post->ID, 'fuels_logo'); ?>
										<?php if ($image) : ?>
										
											<div class="img">
												<img src="/wp-content/mediauploads/<?php echo $image; ?>.jpg" alt="<?php the_title(); ?>" >
											</div>
										
										<?php endif; ?>
										
										<ul>
										    <?php if (has_field($post->ID, 'fuels_address')) : ?>
									            <li><?php custom_field($post->ID, 'fuels_address'); ?></li>
									        <?php endif; ?> 
									        <?php if (has_field($post->ID, 'fuels_town')) : ?>
									            <li><?php custom_field($post->ID, 'fuels_town'); ?></li>
									        <?php endif; ?>
									        <?php if (has_field($post->ID, 'fuels_county')) : ?>
									            <li><?php custom_field($post->ID, 'fuels_county'); ?></li>
									        <?php endif; ?>
									        <?php if (has_field($post->ID, 'fuels_postcode')) : ?>
									            <li><?php custom_field($post->ID, 'fuels_postcode'); ?></li>
									       	<?php endif; ?>
									        <?php if (has_field($post->ID, 'fuels_tel')) : ?>
									            <li>Tel: <a href="tel:<?php custom_field($post->ID, 'fuels_tel'); ?>"><?php custom_field($post->ID, 'fuels_tel'); ?></a></li>
									        <?php endif; ?>
									        <?php if (has_field($post->ID, 'fuels_web')) : ?>
									            <li><a href="http://<?php custom_field($post->ID, 'fuels_web'); ?>" target="_blank" /><?php custom_field($post->ID, 'fuels_web'); ?></a></li>
									       	<?php endif; ?>
										</ul>
										
										<h4>Fuels offered include:</h4>
										<ul>
										    <?php echo get_the_term_list( $post->ID, 'types', '<li>', '</li><li>', '</li>' ); ?>
										</ul>
										
									    <?php if (has_field($post->ID, 'fuels_email')) : ?>
										<a href="mailto:<?php custom_field($post->ID, 'fuels_email'); ?>" class="btn">Contact &raquo;</a>
										<?php endif; ?>
										
										<?php edit_post_link('edit this page...','<div class="editlink">','</div>'); ?>
										
									</div>
									<div class="col-md-6">
										
<!--
										<div class="map fuel">
											
											<iframe width="100%" height="350" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php custom_field($post->ID, 'fuels_postcode'); ?>%20&key=<?php echo '-'.$google_api_key; ?>" allowfullscreen></iframe>

											<a href="https://maps.google.co.uk/maps?q=<?php custom_field($post->ID, 'fuels_postcode'); ?>" target="_blank"><img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php custom_field($post->ID, 'inst_lat'); ?>,<?php custom_field($post->ID, 'inst_lng'); ?>&amp;zoom=11&amp;size=360x360&amp;sensor=false&amp;markers=color:green|<?php custom_field($post->ID, 'inst_lat'); ?>,<?php custom_field($post->ID, 'inst_lng'); ?>"></a>
										</div>
									
-->
										
									</div>
	
								</div>
							</li>
                        <?php endforeach; ?>
					</ul>

		    		<?php else: ?>
					    <?php if ($has_location): ?>
					    	<p class="notfound">Sorry, no fuel suppliers could be found within <?php echo $distance_to_search; ?> miles.</p>
					    <?php endif ?>
					    
					<?php endif; ?>


					<div class="heading">
						<h2>The following national fuel producers have been found:</h2>
					</div>

					<ul class="search-results" id="fuels">
						<?php 
							/* start a new query, this is for all the places not listed above */ 

							$query = array(
								'post_type' => 'fuel',
								'posts_per_page' => -1
							);
							
							if ($has_location) {
								
								$query['meta_query'] = array(
									array(
										'meta_key' => 'fuels_locality',
										'meta_value' => 'National'
									)
								);
								
							}

							if (isset($_GET['fuel-type']) && $_GET['fuel-type']) {
								$query['tax_query'][0]['taxonomy'] = 'types';
								$query['tax_query'][0]['field'] = 'slug';
								$query['tax_query'][0]['terms'] = $_GET['fuel-type'];
							}

							if (isset($_GET['enplus']) && $_GET['enplus']) {
								$query['enplus'] = $_GET['enplus'];
							}
							
							query_posts($query);
							

						?>
						
						<?php if ( have_posts() ) : ?>
						
					    <?php while ( have_posts() ) : the_post() ; ?>
						<li>
							<h3><?php the_title(); ?></h3>
							
							<div class="row">
								<div class="col-md-6">

									<?php $image = get_custom_field($post->ID, 'fuels_logo'); ?>
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="img">
											<?php the_post_thumbnail('fuel-logo'); ?>
										</div>
									<?php } elseif ($image) { ?>
										<div class="img">
											<img src="/wp-content/mediauploads/<?php echo $image; ?>.jpg" alt="<?php the_title(); ?>" >
										</div>
									<?php } ?>
									
									<ul>
									    <?php if (has_field($post->ID, 'fuels_address')) : ?>
								            <li><?php custom_field($post->ID, 'fuels_address'); ?></li>
								        <?php endif; ?> 
								        <?php if (has_field($post->ID, 'fuels_town')) : ?>
								            <li><?php custom_field($post->ID, 'fuels_town'); ?></li>
								        <?php endif; ?>
								        <?php if (has_field($post->ID, 'fuels_county')) : ?>
								            <li><?php custom_field($post->ID, 'fuels_county'); ?></li>
								        <?php endif; ?>
								        <?php if (has_field($post->ID, 'fuels_postcode')) : ?>
								            <li><?php custom_field($post->ID, 'fuels_postcode'); ?></li>
								       	<?php endif; ?>
								        <?php if (has_field($post->ID, 'fuels_tel')) : ?>
								            <li>Tel: <a href="tel:<?php custom_field($post->ID, 'fuels_tel'); ?>"><?php custom_field($post->ID, 'fuels_tel'); ?></a></li>
								        <?php endif; ?>
								        <?php if (has_field($post->ID, 'fuels_web')) : ?>
								            <li><a href="http://<?php custom_field($post->ID, 'fuels_web'); ?>" target="_blank" /><?php custom_field($post->ID, 'fuels_web'); ?></a></li>
								       	<?php endif; ?>
									</ul>

									<h4>Fuels offered include:</h4>
									<ul>
									    <?php echo get_the_term_list( $post->ID, 'types', '<li>', '</li><li>', '</li>' ); ?>
									</ul>
									
									<?php edit_post_link('edit this page...','<div class="editlink">','</div>'); ?> 

								    <?php if (has_field($post->ID, 'fuels_email')) : ?>
								    
										<a href="mailto:<?php custom_field($post->ID, 'fuels_email'); ?>" class="btn btn-dark">Contact &raquo;</a>
									<?php endif; ?>

								</div>
								
								<div class="col-md-6">

<!--
									<div class="map fuel">

									<iframe width="100%" height="350" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php custom_field($post->ID, 'fuels_postcode'); ?>%20&key=<?php echo '-'.$google_api_key; ?>" allowfullscreen></iframe>

										
										<a href="https://maps.google.co.uk/maps?q=<?php custom_field($post->ID, 'fuels_postcode'); ?>"><img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php custom_field($post->ID, 'inst_lat'); ?>,<?php custom_field($post->ID, 'inst_lng'); ?>&amp;zoom=11&amp;size=360x360&amp;sensor=false&amp;markers=color:green|<?php custom_field($post->ID, 'inst_lat'); ?>,<?php custom_field($post->ID, 'inst_lng'); ?>"></a>
									</div>
-->

								</div>
								
																
							</div>
						</li>
	                    <?php endwhile; ?>

						<?php else : ?>
					    	<p class="notfound">Sorry, no fuel suppliers could be found nationally.</p>
						<?php endif; ?>	                    
					</ul>
			
				</div>
				
				</div>
				<div class="col-md-3">
					<?php get_sidebar('searchresults'); ?>
				</div>

			</div><!-- /row -->
			
<?php get_footer();?>;