<?php

if ( have_posts() ) {
the_post();
	$manuemail = get_custom_field($post->ID, 'app_manufacturer_email');
	$app_title = get_the_title();
rewind_posts();
}


?>

<?php get_header(); ?>


	<?php get_template_part( 'header-parts/search', 'brand' ); ?>
		
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
									$hetas_ecodesign = get_custom_field($post->ID, 'hetas_eco_design');
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
									<?php if ($hetas_ecodesign == 'Yes') { ?>
										<img src="<?php echo bloginfo('template_url'); ?>/images/HETAS-Ecodesign-Compliant-Logo.jpg" alt="HETAS Ecodesign Compliant Logo" />
									<?php } ?>
									
								</div>
							</div>
							<div class="col-md-7">
	
								<div class="entity">
									<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
										<?php the_content(); ?>
									</div>
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
													<?php if ($hetas_approved != 'Yes' && $defra_approved != 'Yes' && $mcs_approved != 'Yes' && $hetas_ecodesign == 'Yes') { ?>
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

<!--
<script>
	$("#applianceForm").validate();
</script>
-->

<?php get_footer();?>