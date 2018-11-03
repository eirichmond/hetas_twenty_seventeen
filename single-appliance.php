<?php

if ( have_posts() ) {
the_post();
	$manuemail = get_custom_field($post->ID, 'app_manufacturer_email');
	$app_title = get_the_title();
rewind_posts();
}

//echo bloginfo('template_url') . '/other.php';

/*
*/

if(isset($_POST['submitted'])) {

require_once('recaptchalib.php');
$privatekey = "6LfqN9sSAAAAAOH9ADDsXtqSd16K7jHDbUTRvyMz";
$resp = recaptcha_check_answer ($privatekey,
                            $_SERVER["REMOTE_ADDR"],
                            $_POST["recaptcha_challenge_field"],
                            $_POST["recaptcha_response_field"]);

if (!$resp->is_valid) {
// What happens when the CAPTCHA was entered incorrectly
die ("<div style='width: 60%; background: orange; margin: 150px auto; padding: 20px;'><h2 style='color:white; margin:0px;padding:0px;font-family:sans-serif;'>The reCAPTCHA wasn't entered correctly.<br><br> Please go back and try it again.</h2></div>");

} else {

	if(trim($_POST['contactName']) === '') {
		$nameError = 'Please enter your name.';
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}

	if(trim($_POST['email']) === '')  {
		$emailError = 'Please enter your email address.';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['telNumber']) === '') {
		$telError = 'Please enter your telephone number.';
		$hasError = true;
	} else {
		$tel = trim($_POST['telNumber']);
	}

	if(trim($_POST['comments']) === '') {
		$commentError = 'Please enter a message.';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}

	if(!isset($hasError)) {
		$emailTo = $manuemail;
		if (!isset($emailTo) || ($emailTo == '') ){
			$emailTo = $manuemail;
		}
		$subject = '[Referral from HETAS] About '.$app_title;
		$body = "Name: $name \n\nEmail: $email \n\nTelephone: $tel \n\nMessage: $comments";
		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		wp_mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

} // end recaptcha

}


?>

<?php get_header(); ?>

	<?php get_template_part( 'header-parts/search', 'nav' ); ?>
		
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> 

				<div class="heading">
					<h1><?php the_title(); ?></h1>
				</div>
				
				<div id="main">
					<div id="content">
	
						<div class="row">
							<div class="col-md-3">
								<div class="view">
									<?php
									$image = get_custom_field($post->ID, 'app_appliance_image');
									$hetas_approved = get_custom_field($post->ID, 'hetas_approved');
									$mcs_approved = get_custom_field($post->ID, 'app_mcs_approved');
									$ce_marked = get_custom_field($post->ID, 'app_ce_cert');
									$sia_ecodesign = get_custom_field($post->ID, 'sia_ecodesign_ready');
									$hetas_eco_design = get_custom_field($post->ID, 'hetas_eco_design');
									$defra_approved = get_custom_field($post->ID, 'app_clean_air_exempt');
									$attachment = get_page_by_title( $image,'OBJECT','attachment' );
									?>
									
									<?php if (!empty($attachment)) { ?>
										<div class="img">
											<img src="<?php echo wp_get_attachment_url($attachment->ID); ?>" alt="<?php echo $image; ?>" />
										</div>
									<?php } else { ?>
										<div class="img">
											<img src="<?php echo bloginfo ('template_url'); ?>/images/hetas-logo.png" alt="<?php echo $image; ?>" />
										</div>
									<?php } ?>
			
									<?php if ($hetas_approved == 'Yes') { ?>
										<img src="<?php echo bloginfo('template_url'); ?>/images/approved_appliance_logo.jpg" alt="HETAS Approved" />
									<?php } ?>
									<?php if ($defra_approved == 'Yes') { ?>
										<img src="<?php echo bloginfo('template_url'); ?>/images/defra_logo.jpg" alt="defra logo" />
									<?php } ?>
									<?php if ($mcs_approved == 'Yes') { ?>
										<img src="<?php echo bloginfo('template_url'); ?>/images/hetas_mcs_combined.jpg" alt="MCS HETAS Approved" />
									<?php } ?>
									<?php if ($sia_ecodesign == 'Yes') { ?>
										<img src="<?php echo bloginfo('template_url'); ?>/images/sia_ecodesign_logo.jpg" alt="CE logo" />
									<?php } ?>
									<?php if ($hetas_eco_design == 'Yes') { ?>
										<img src="<?php echo bloginfo('template_url'); ?>/images/ecoDesignComp.jpeg" alt="HETAS Eco Design" />
									<?php } ?>
									
								</div>
							</div>
							<div class="col-md-7">
	
								<div class="entity">
									
									<p><strong><?php custom_taxonomy($post->ID, 'appliance_type'); ?></strong></p>
									<p>Burns: <strong><?php custom_taxonomy($post->ID, 'fuel_types'); ?></strong></p>
									
									<p><?php custom_taxonomy($post->ID, 'appliance_fuel_options'); ?></p>
			
									<?php
									$hetas_approved = get_custom_field($post->ID, 'hetas_approved');
									$mcs_approved = get_custom_field($post->ID, 'app_mcs_approved');
									$sia_ecodesign = get_custom_field($post->ID, 'sia_ecodesign_ready');
									$defra_approved = get_custom_field($post->ID, 'app_clean_air_exempt');

									if ($hetas_approved != 'Yes' && $defra_approved != 'Yes' && $mcs_approved != 'Yes' && $sia_ecodesign == 'Yes') { ?>
									
									<?php } else { ?>
										<div class="data-area">
											
											<?php if (has_terms( array('b22','b31','b32','e1','e2','e3'), 'appliance_type_code', $post->ID)) : ?>
											
												<table class="data">
													<tr>
														<th>&nbsp;</th>
														<td><strong>Rated Output Room (kW)</strong></td>
														<td><strong>Gross Efficiency (%)</strong></td>
														<td><strong>Net Efficiency (%)</strong></td>
														<td><strong>Refuel Period (h)</strong></td>
													</tr>
													<tr>
														<th>Burning<br>Wood</th>
														<td><strong><?php custom_field($post->ID, 'full_load_output_room_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'app_refuel_period_wood'); ?></strong></td>
													</tr>
													<tr>
														<th>Burning<br>Mineral Fuel</th>
														<td><strong><?php custom_field($post->ID, 'full_load_output_mineral'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_mineral'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_mineral'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'refuel_period_mineral'); ?></strong></td>
													</tr>
												</table>
											
											<?php endif; ?>
					
											<?php if (has_terms( array('e4'), 'appliance_type_code', $post->ID)) : ?>
											
												<table class="data">
													<tr>
														<th>&nbsp;</th>
														<td><strong>Rated Output Room (kW)</strong></td>
														<td><strong>Gross Efficiency (%)</strong></td>
														<td><strong>Net Efficiency (%)</strong></td>
														<td><strong>Refuel Period (h)</strong></td>
													</tr>
													<tr>
														<th>Full Load<br>Pellet</th>
														<td><strong><?php custom_field($post->ID, 'full_load_output_room_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_burn_rate_wood'); ?></strong></td>
													</tr>
													<tr>
														<th>Part Load<br>Pellet</th>
														<td><strong><?php custom_field($post->ID, 'part_load_output_room_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'part_load_gross_efficiency_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'part_load_net_efficiency_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'part_load_burn_rate_wood'); ?></strong></td>
													</tr>
												</table>
											
											<?php endif; ?>
					
											<?php if (has_terms( array('e5'), 'appliance_type_code', $post->ID)) : ?>
											
												<table class="data">
													<tr>
														<th>&nbsp;</th>
														<td><strong>Heat Capacity Room (kWh)</strong></td>
														<td><strong>Gross Efficiency (%)</strong></td>
														<td><strong>Net Efficiency (%)</strong></td>
														<td><strong>Heat Release (h)</strong></td>
													</tr>
													<tr>
														<th>Burning<br>wood</th>
														<td><strong><?php custom_field($post->ID, 'full_load_output_room_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'app_refuel_period_wood'); ?></strong></td>
													</tr>
													<tr>
														<th>Burning<br>Mineral Fuel</th>
														<td><strong><?php custom_field($post->ID, 'full_load_output_mineral'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_mineral'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_mineral'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'refuel_period_mineral'); ?></strong></td>
													</tr>
												</table>
											
											<?php endif; ?>
				
											<?php if (has_terms( array('f1','f2','f3','g12','g13','g21'), 'appliance_type_code', $post->ID)) : ?>
											
												<table class="data">
													<tr>
														<th>&nbsp;</th>
														<td><strong>Rated Output Room (kW)</strong></td>
														<td><strong>Rated Output Water (kW)</strong></td>
														<td><strong>Gross Efficiency (%)</strong></td>
														<td><strong>Net Efficiency (%)</strong></td>
														<td><strong>Refuel Period (h)</strong></td>
													</tr>
													<tr>
														<th>Burning<br>wood</th>
														<td><strong><?php custom_field($post->ID, 'full_load_output_room_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_output_water_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'app_refuel_period_wood'); ?></strong></td>
													</tr>
													<tr>
														<th>Burning<br>Mineral Fuel</th>
														<td><strong><?php custom_field($post->ID, 'full_load_output_mineral'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_output_water_mineral'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_mineral'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_mineral'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'refuel_period_mineral'); ?></strong></td>
													</tr>
												</table>
											
											<?php endif; ?>
											
											<?php if (has_terms( array('f4'), 'appliance_type_code', $post->ID)) : ?>
											
												<table class="data">
														<tr>
															<th>&nbsp;</th>
															<td><strong>Rated Output Room (kW)</strong></td>
															<td><strong>Rated Output Water (kW)</strong></td>
															<td><strong>Gross Efficiency (%)</strong></td>
															<td><strong>Net Efficiency (%)</strong></td>
															<td><strong>Refuel Period (h)</strong></td>
														</tr>
														<tr>
															<th>Full Load<br>Pellet</th>
															<td><strong><?php custom_field($post->ID, 'full_load_output_room_wood'); ?></strong></td>
															<td><strong><?php custom_field($post->ID, 'full_load_output_water_wood'); ?></strong></td>
															<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_wood'); ?></strong></td>
															<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_wood'); ?></strong></td>
															<td><strong><?php custom_field($post->ID, 'full_load_burn_rate_wood'); ?></strong></td>
														</tr>
														<tr>
															<th>Part Load<br>Pellet</th>
															<td><strong><?php custom_field($post->ID, 'part_load_output_room_wood'); ?></strong></td>
															<td><strong><?php custom_field($post->ID, 'part_load_output_water_wood'); ?></strong></td>
															<td><strong><?php custom_field($post->ID, 'part_load_gross_efficiency_wood'); ?></strong></td>
															<td><strong><?php custom_field($post->ID, 'part_load_net_efficiency_wood'); ?></strong></td>
															<td><strong><?php custom_field($post->ID, 'part_load_burn_rate_wood'); ?></strong></td>
														</tr>
													</table>
											
											<?php endif; ?>
					
											<?php if (has_terms( array('g21','g22','g23'), 'appliance_type_code', $post->ID)) : ?>
											
												<table class="data">
												<tr>
													<th>&nbsp;</th>
													<td><strong>Rated Output Room (kW)</strong></td>
													<td><strong>Rated Output Water (kW)</strong></td>
													<td><strong>Gross Efficiency (%)</strong></td>
													<td><strong>Net Efficiency (%)</strong></td>
													<td><strong>Refuel Period (h)</strong></td>
												</tr>
												<tr>
													<th>Winter Wood</th>
													<td><strong><?php custom_field($post->ID, 'rated_output_winter_room_wood'); ?></strong></td>
													<td><strong><?php custom_field($post->ID, 'rated_output_winter_water_wood'); ?></strong></td>
													<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_wood'); ?></strong></td>
													<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_wood'); ?></strong></td>
													<td><strong><?php custom_field($post->ID, 'refuel_period_winter_wood'); ?></strong></td>
												</tr>
												<tr>
													<th>Summer Wood</th>
													<td><strong><?php custom_field($post->ID, 'rated_output_summer_room_wood'); ?></strong></td>
													<td><strong><?php custom_field($post->ID, 'rated_output_summer_water_wood'); ?></strong></td>
													<td><strong><?php custom_field($post->ID, 'part_load_gross_efficiency_wood'); ?></strong></td>
													<td><strong><?php custom_field($post->ID, 'part_load_net_efficiency_wood'); ?></strong></td>
													<td><strong><?php custom_field($post->ID, 'refuel_period_summer_wood'); ?></strong></td>
												</tr>
												<tr>
													<th>Winter Mineral</th>
													<td><strong><?php custom_field($post->ID, 'rated_output_winter_room_mineral'); ?></strong></td>
													<td><strong><?php custom_field($post->ID, 'rated_output_winter_water_mineral'); ?></strong></td>
													<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_mineral'); ?></strong></td>
													<td><strong><?php custom_field($post->ID, 'part_load_net_efficiency_wood'); ?></strong></td>
													<td><strong><?php custom_field($post->ID, 'refuel_period_winter_mineral'); ?></strong></td>
												</tr>
												<tr>
													<th>Summer Mineral</th>
													<td><strong><?php custom_field($post->ID, 'rated_output_summer_room_mineral'); ?></strong></td>
													<td><strong><?php custom_field($post->ID, 'rated_output_summer_water_mineral'); ?></strong></td>
													<td><strong><?php custom_field($post->ID, 'part_load_gross_efficiency_mineral'); ?></strong></td>
													<td><strong><?php custom_field($post->ID, 'part_load_net_efficiency_mineral'); ?></strong></td>
													<td><strong><?php custom_field($post->ID, 'refuel_period_summer_mineral'); ?></strong></td>
												</tr>
											</table>
											
											<?php endif; ?>
											
											<?php if (has_terms( array('j2','j4'), 'appliance_type_code', $post->ID)) : ?>
				
												<table class="data">
													<tr>
														<th>&nbsp;</th>
														<td><strong>Rated Output Water (kW)</strong></td>
														<td><strong>Gross Efficiency (%)</strong></td>
														<td><strong>Net Efficiency (%)</strong></td>
														<td><strong>Burn Rate (kg/h)</strong></td>
													</tr>
													<tr>
														<th>Burning<br>Wood</th>
														<td><strong><?php custom_field($post->ID, 'full_load_output_water_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_burn_rate_wood'); ?></strong></td>
													</tr>
													<tr>
														<th>Burning<br>Smokeless</th>
														<td><strong><?php custom_field($post->ID, 'full_load_output_water_mineral'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_mineral'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_mineral'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'refuel_period_mineral'); ?></strong></td>
													</tr>
												</table>
				
											<?php endif; ?>
											
											<?php if (has_terms( array('j5','j6',), 'appliance_type_code', $post->ID)) : ?>
											
												<table class="data">
													<tr>
														<th>&nbsp;</th>
														<td><strong>Rated Output Water (kW)</strong></td>
														<td><strong>Gross Efficiency (%)</strong></td>
														<td><strong>Net Efficiency (%)</strong></td>
														<td><strong>Burn Rate (kg/h)</strong></td>
													</tr>
													<tr>
														<th>Full Load<br>Pellet</th>
														<td><strong><?php custom_field($post->ID, 'full_load_output_water_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_gross_efficiency_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_net_efficiency_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'full_load_burn_rate_wood'); ?></strong></td>
													</tr>
													<tr>
														<th>Part Load<br>Pellet</th>
														<td><strong><?php custom_field($post->ID, 'part_load_output_water_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'part_load_gross_efficiency_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'part_load_net_efficiency_wood'); ?></strong></td>
														<td><strong><?php custom_field($post->ID, 'part_load_burn_rate_wood'); ?></strong></td>
													</tr>
												</table>
											
											<?php endif; ?>
				
											<?php list_feature_icons($post->ID); ?>
					
										</div>
									<?php } ?>
										<dl class="dlist">
											<dt>HETAS No</dt>
											<dd><?php custom_taxonomy($post->ID, 'appliance_type_code'); ?><?php custom_field($post->ID, 'app_id'); ?></dd>
											<?php if (has_field($post->ID, 'app_manufacturer')) : ?>
												<dt>Manufacturer:</dt>
												<dd><?php custom_field($post->ID, 'app_manufacturer'); ?></dd>
											<?php endif; ?>
										
											<?php if (has_field($post->ID, 'system')) : ?>
												<dt>System:</dt>
												<dd><?php custom_field($post->ID, 'system'); ?></dd>
											<?php endif; ?>
										
											<?php if (has_field($post->ID, 'certificate_reference')) : ?>
												<dt>Certificate No:</dt>
												<dd><?php custom_field($post->ID, 'certificate_reference'); ?></dd>
											<?php endif; ?>
										
											<?php if (has_field($post->ID, 'ecolabel_class_rating')) : ?>
												<dt>EcoLabel Class Rating:</dt>
												<dd><?php custom_field($post->ID, 'ecolabel_class_rating'); ?></dd>
											<?php endif; ?>
										
											<?php if (has_field($post->ID, 'app_manufacturers_remarks')) : ?>
												<dt>Manufacturers Remarks:</dt>
												<dd><?php custom_field($post->ID, 'app_manufacturers_remarks'); ?></dd>
											<?php endif; ?>
										
				
											
											<?php if (has_field($post->ID, 'app_sap_efficiency')) : ?>
												<dt>Combined SAP efficiency:</dt>
												<dd><?php custom_field($post->ID, 'app_sap_efficiency'); ?> %</dd>
											<?php endif; ?>
				
											<?php if (has_field($post->ID, 'chimney_flue_sizes')) : ?>
												<dt>Flue Sizes:</dt>
												<dd><?php custom_field($post->ID, 'chimney_flue_sizes'); ?></dd>
											<?php endif; ?>
											<?php if (has_field($post->ID, 'chimney_designated')) : ?>
												<dt>Designated:</dt>
												<dd><?php custom_field($post->ID, 'chimney_designated'); ?></dd>
											<?php endif; ?>
											<?php if (has_field($post->ID, 'chimney_firestop')) : ?>
												<dt>Firestop:</dt>
												<dd><?php custom_field($post->ID, 'chimney_firestop'); ?></dd>
											<?php endif; ?>
											
				
											<?php if (has_field($post->ID, 'chimney_tested')) : ?>
												<dt>Tested:</dt>
												<dd><?php custom_field($post->ID, 'chimney_tested'); ?></dd>
											<?php endif; ?>
											
											<?php if (has_field($post->ID, 'chimney_ce_mark_certificate')) : ?>
												<dt>CE Mark Certificate:</dt>
												<dd><?php custom_field($post->ID, 'chimney_ce_mark_certificate'); ?></dd>
											<?php endif; ?>
											
											<?php if (has_field($post->ID, 'chimney_testing_remarks')) : ?>
												<dt>Testing Remarks:</dt>
												<dd><?php custom_field($post->ID, 'chimney_testing_remarks'); ?></dd>
											<?php endif; ?>
											
											<?php if (has_tax($post->ID, 'fuel_types')) : ?>
												<dt>Fuel Types:</dt>
												<dd><?php custom_taxonomy($post->ID, 'fuel_types'); ?></dd>
											<?php endif; ?>
											
											<?php if (has_tax($post->ID, 'appliance_operations')) : ?>
												<dt>Appliance Operations:</dt>
												<dd><?php custom_taxonomy($post->ID, 'appliance_operations'); ?></dd>
											<?php endif; ?>
											
											
										</dl>
										
										<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
											<?php the_content(); ?>
										</div>
										
										<?php if (has_field($post->ID, 'app_manufacturer_email')) : ?>
											<div class="feedback">
			
												<h3>Contact Manufacturer</h3>
												<?php if(isset($emailSent) && $emailSent == true) { ?>
													<div class="thanks">
														<p>Thanks, your message was successfully sent to the Manufacturer.</p>
													</div>
												<?php } else { ?>
												
												<?php if(isset($hasError) || isset($captchaError)) { ?>
													<p class="error">Sorry, an error occured.<p>
												<?php } ?>
					
												<form action="<?php the_permalink(); ?>" id="applianceForm" method="post">
													<label for="contactName">Name:</label>
													<input type="text" name="contactName" id="contactName" class="form-control" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="text required requiredField" />
													<?php if($nameError != '') { ?>
														<span class="error"><?=$nameError;?></span>
													<?php } ?>
					
													<label for="email">Email</label>
													<input type="text" name="email" id="email" class="form-control" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="text required requiredField email" />
													<?php if($emailError != '') { ?>
														<span class="error"><?=$emailError;?></span>
													<?php } ?>
													
													<label for="telNumber">Telephone:</label>
													<input type="text" name="telNumber" id="telNumber" class="form-control" value="<?php if(isset($_POST['telNumber'])) echo $_POST['telNumber'];?>" class="text required requiredField" />
													<?php if($nameError != '') { ?>
														<span class="error"><?=$nameError;?></span>
													<?php } ?>
					
					
													<label for="commentsText">Message:</label>
													<textarea name="comments" id="commentsText" rows="3" class="text required requiredField form-control"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
													<?php if($commentError != '') { ?>
														<span class="error"><?=$commentError;?></span>
													<?php } ?>
													
													<?php
														require_once('recaptchalib.php');
														$publickey = "6LfqN9sSAAAAALpiHnXxOxqx73I1GSoHOUhC2zzP"; // you got this from the signup page
														echo recaptcha_get_html($publickey);
					  								?>
					
													<input class="btn-submit btn btn-submit" type="submit" value="Submit">
													
													<input type="hidden" name="submitted" id="submitted" value="true" />
												</form>
												<?php } ?>
												
											</div>
										<?php endif; ?>
									
								</div>
	
							</div>
							<div class="col-md-2">
								
								<aside>
									<div class="logo-box">
										<?php $image = get_custom_field($post->ID, 'app_manufacturer_logo'); ?>
										<?php if ( has_post_thumbnail() ) { 
													the_post_thumbnail( 'appliance-feature' ); 
												} elseif ($image) { ?>
													<img src="/wp-content/mediauploads/<?php echo $image; ?>.png" alt="<?php custom_field($post->ID, 'app_manufacturer'); ?> Logo" >
												<?php } ?>
									</div>
									
									
									<?php if (has_field($post->ID, 'app_manufacturer_address_1')) : ?>
										<div class="contact-cell">
											<address>
												<span><?php custom_field($post->ID, 'app_manufacturer_address_1'); ?></span>
												<?php if (has_field($post->ID, 'app_manufacturer_address_2')) : ?>
													<span><?php custom_field($post->ID, 'app_manufacturer_address_2'); ?></span>
												<?php endif; ?>
												<?php if (has_field($post->ID, 'app_manufacturer_city')) : ?>
													<span><?php custom_field($post->ID, 'app_manufacturer_city'); ?></span>
												<?php endif; ?>
												<?php if (has_field($post->ID, 'app_manufacturer_county')) : ?>
													<span><?php custom_field($post->ID, 'app_manufacturer_county'); ?></span>
												<?php endif; ?>
												<?php if (has_field($post->ID, 'app_manufacturer_postcode')) : ?>
													<span><?php custom_field($post->ID, 'app_manufacturer_postcode'); ?></span>
												<?php endif; ?>
												
												
											</address>
											<dl>
					
												
												<?php if (has_field($post->ID, 'app_appliance_web-link')) : ?>
													<?php if ($hetas_approved != 'Yes' && $defra_approved != 'Yes' && $mcs_approved != 'Yes' && $sia_ecodesign == 'Yes') { ?>
														<dd><span style="color: #666;"><?php custom_field($post->ID, 'app_appliance_web-link'); ?></span></dd>
													<?php } else { ?>
														<dd><a target="_blank" href="http://<?php custom_field($post->ID, 'app_appliance_web-link'); ?>">Visit Manufacturer's website</a></dd>
													<?php } ?>
												<?php endif; ?>
											</dl>
										</div>
									<?php endif; ?>
									
									
										<?php if (has_field($post->ID, 'docs')) : ?>
										
										<div class="media-deets">
											<ul>
					
												<?php $metas = get_custom_field($post->ID, 'docs'); ?>
												
												<?php foreach ($metas as $k => $v) { ?>
										
													<li>
														<a href="<?php echo $v['imageurl']; ?>" target="_blank">
															<span class="media-title"><?php echo $v['caption']; ?></span>
														</a>
													</li>
					
												<?php } ?>
											
											</ul>
										</div>
													
										<?php endif; ?>
									
				
									
									
								</aside>
	
							</div>
							
						</div>
	
						
						
						
						
						
						
						
						
					</div>
					
				</div><!-- /main -->
			<?php endwhile; endif; ?>

<script>
	$("#applianceForm").validate();
</script>

<?php get_footer();?>