<?php
/*
	Template Name: Training Centres Map
*/

// Create a new instance

$args = array(
	'post_type' => 'training_centre',
	'posts_per_page' => -1
);

$posts = query_posts($args);

$pageid = '2215';

wp_reset_query();


get_header(); ?>

<?php get_template_part( 'header-parts/search', 'brand' ); ?>


	<div class="row">

		<div class="col-md-9">

			<div id="main">
				<div class="clearfix">
					<?php while (have_posts()) : the_post(); ?> 
						<div id="content">
							<div class="article" id="post-<?php the_ID(); ?>">
								<h1><?php echo get_the_title($pageid); ?></h1>
								<?php get_page($pageid);?>
								
								<p><?php echo apply_filters('the_content', get_page($pageid)->post_content); ?></p>
								
								<script type="text/javascript">
									// Set the Map variable
									var map;
									function initialize() {	
									    var myOptions = {
									    
									    zoom: 6,
									 	panControl: false,
										zoomControl: false,
									   mapTypeId: google.maps.MapTypeId.ROADMAP
									};
									var all = [
											<?php
											foreach ($posts as $post ){
												$tc_ref_code = get_custom_field($post->ID, 'tc_ref_code'); 
												$tc_address_1 = get_custom_field($post->ID, 'tc_address_1'); 
												$tc_address_2 = get_custom_field($post->ID, 'tc_address_2'); 
												$tc_address_3 = get_custom_field($post->ID, 'tc_address_3'); 
												$tc_city_town = get_custom_field($post->ID, 'tc_city_town'); 
												$tc_county = get_custom_field($post->ID, 'tc_county'); 
												$tc_postcode = get_custom_field($post->ID, 'tc_postcode'); 
												$tc_tel_no = get_custom_field($post->ID, 'tc_tel_no'); 
												$tc_email_add = get_custom_field($post->ID, 'tc_email_add'); 
												$tc_web_add = get_custom_field($post->ID, 'tc_web_add'); 
												$tc_lat = get_custom_field($post->ID, 'tc_latitude'); 
												$tc_long = get_custom_field($post->ID, 'tc_longitude'); 
												
												$terms = get_the_terms( $post->ID, 'course_codes' );
												
												$permalink = get_permalink($post->ID);
												
												$courses = array();
												if ( $terms && ! is_wp_error( $terms ) ) {
													foreach ( $terms as $term ) {
													//print_r($term);
														$courses[] = $term->name;
													}
												}
												
												$course_list = implode(', ', $courses); 
												//	$location = geocode_postcode($tc_postcode);
												
												$title = get_the_title();
												
												$data = array($title,$tc_address_1,$tc_city_town,$tc_county,$tc_postcode,$tc_lat,$tc_long,$tc_tel_no,$tc_email_add,$permalink);
												$comma_separated = implode('","', $data);
												
												echo '["'.$comma_separated.'",["'.$course_list.'"]],';
												//echo '<pre>'; print_r($data); echo '</pre>';
											};?>	
											];
									var infoWindow = new google.maps.InfoWindow;
									map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
									// Set the center of the map
									var pos = new google.maps.LatLng(54.596, -4.086);
									map.setCenter(pos);
									function infoCallback(infowindow, marker) { 
									    return function() {
									    infowindow.open(map, marker);
									};
									}			
									function setMarkers(map, all) {	
										for (var i in all) {	
									        var name 	= all[i][0];
									        var address = all[i][1];
									        var city 	= all[i][2];
									        var state 	= all[i][3];
									        var zip 	= all[i][4];
									        var lat 	= all[i][5];
									        var lng 	= all[i][6];
									        var tel 	= all[i][7];
									        var email 	= all[i][8];
									        var web 	= all[i][9];
									        var courses = all[i][10];
									        var latlngset;
									        latlngset = new google.maps.LatLng(lat, lng);
									        var marker = new google.maps.Marker({  
									          map: map,  title: city,  position: latlngset  
									        });
									        var content = '<div class="map-content"><h3>' + name + '</h3>' + address + '<br />' + city + ', ' + state + ' ' + zip + '<br />' + tel + '<br /><br /><h3>Available Courses include:</h3>' + courses + '<br /><br /><a href="' + web + '" target="_blank">Read More</a><br /></div>'; // currently not needed. <a href="http://maps.google.com/?daddr=' + address + ' ' + city + ', ' + state + ' ' + zip + '" target="_blank">Get Directions</a>		
									        var infowindow = new google.maps.InfoWindow();
									          infowindow.setContent(content);
									          google.maps.event.addListener(
									            marker, 
									            'click', 
									            infoCallback(infowindow, marker)
									          );
									      }
									    }			
									    // Set all markers in the all variable
									    setMarkers(map, all);
									  };
									  // Initializes the Google Map
									  google.maps.event.addDomListener(window, 'load', initialize);
							
								</script>
							
							    <div id="map_canvas" style="width:100%; height:800px"></div>

								
							</div>
						</div>
					<?php endwhile; ?> 
										
				</div>
			</div><!-- /main -->
			
		</div>
		<div class="col-md-3">
			
			<?php get_sidebar('page'); ?>
			
		</div>
			
	<script type="text/javascript">
	function loadScript() {
		var script = document.createElement("script");
		script.type = "text/javascript";
		script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCXLdzQAHX56JE5sz6k81OXh-krjoNYpsM&sensor=true&callback=initialize";
		document.body.appendChild(script);
	}
	
	window.onload = loadScript;
	</script>

<?php get_footer();?>