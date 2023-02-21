<?php
/* Template Name: Restricted Access: Members Area */

$access = current_user_can('member') || current_user_can('manage_options');
if ( !is_user_logged_in() || !$access) {
	include 'member-login.php';
	exit(0);
}

get_header();
?>


<?php get_template_part( 'header-parts/search', 'brand' ); ?>

			<div id="main" class="offset">
				
				<div class="row">
					<div class="col-md-9">

						<div id="content">
							<div class="tab-area" id="tabs-1">
								
								<ul class="nav nav-tabs">
									<li role="presentation" class="active"><a href="#tab-01">Training and Assessment</a></li>
									<li role="presentation"><a href="#tab-03">Quality Documents</a></li>
								</ul>
		
								<div class="tab-pane active" id="tab-01">
									<ul class="books">
										
									<?php
									// WP_Query arguments
									$args = array ('post_type' => 'training_slide', 'post_status' => 'publish', 'posts_per_page'  => -1 );
									$training = new WP_Query( $args );
									if ( $training->have_posts() ) { while ( $training->have_posts() ) { $training->the_post(); ?>
									
											<li>
											
												<div class="row">
													<div class="col-md-2">
		
														<div class="img">
															<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'training-manual-thumb' ); } ?>
														</div>
		
													</div>
													<div class="col-md-9">
														
														<div class="descr">
															<h3><?php the_title(); ?></h3>
															<p><?php the_excerpt(); ?></p>
														</div>
		
													</div>
													<div class="col-md-1">
		
														<?php if (has_field($post->ID, 'download')) : ?>
														
															<?php $download_id = get_post_meta($post->ID, 'download', true); echo do_shortcode('[ddownload id="'.$download_id.'" style="button" button="black" text="Download"]'); ?>
				
														<?php endif; ?>
		
													</div>
												</div>
													
														
														
												
												
											</li>
											
											
									<?php } } wp_reset_postdata(); ?>
									
									</ul>
								</div>
																
								<div class="tab-pane" id="tab-03">
									<ul class="books">
									<?php
									// WP_Query arguments
									$args = array ('post_type' => 'quality', 'post_status' => 'publish', 'posts_per_page'  => -1 );
									$quality = new WP_Query( $args );
									if ( $quality->have_posts() ) { while ( $quality->have_posts() ) { $quality->the_post(); ?>
											<li>
											
												<div class="row">
													<div class="col-md-2">
														
														<div class="img">
															<?php
																if ( has_post_thumbnail() ) { the_post_thumbnail( 'training-manual-thumb' );
															} else {
																echo '<img src="'. get_bloginfo('template_url') .'/images/hetas-training-download.jpg" class="attachment-training-manual-thumb wp-post-image" alt="Training-centre-image" title="Training-centre-image">';
															}?>
														</div>
		
													</div>
													<div class="col-md-9">
		
														<div class="descr">
															<h3><?php the_title(); ?></h3>
															<p><?php the_excerpt(); ?></p>
														</div>
													
													</div>
													<div class="col-md-1">
		
														<?php if (has_field($post->ID, 'download')) : ?>
																								
															<?php
																
																$download_id = get_post_meta($post->ID, 'download', true);
																if (is_numeric($download_id)) {
																	echo do_shortcode('[ddownload id="'.$download_id.'" style="button" button="black" text="Download"]');
																} else { ?>
																	<a href="<?php custom_field($post->ID, 'download'); ?>" class="btn" target="_blank">Download &raquo;</a>
																<?php }
																
																
															?>
														
														<?php endif; ?>
													
													</div>
												</div>
		
											</li>
									<?php } } wp_reset_postdata(); ?>
									</ul>
								</div>
		
							</div>
						</div>

					</div>
					<div class="col-md-3">

						<aside>
							<div class="faq">
							
							<?php
							// Create a new instance
							$training_side_content = new WP_Query('page_id=1843');?>
							<?php while( $training_side_content->have_posts() ) : $training_side_content->the_post();?>
							
								<h3 class="trhead"><?php the_title ();?></h3>
							    
							    <?php the_excerpt() ;?>
							
							<?php endwhile;?>
							<?php wp_reset_postdata();?>
							</div>
						</aside>
						
					</div>
				</div>
				
			</div><!-- /main -->
<?php get_footer();?>