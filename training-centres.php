<?php
/*
	Template Name: Training Centres
*/

get_header(); ?>

		<?php include('search-nav.php');?>

			<div id="main">
				<div class="clearfix">
				
					<div id="content">
						<?php if (have_posts()) : ?> 
						<?php while (have_posts()) : the_post(); ?> 
								<div class="article" id="post-<?php the_ID(); ?>">
									<h1><?php the_title(); ?></h1>
									<?php the_content(); ?>
								</div>
						<?php endwhile; ?> 
						<?php next_posts_link('Older Entries'); ?> 
						<?php previous_posts_link('Newer Entries'); ?> 
						<?php else : ?> 
						<h2>Nothing Found</h2>
						<?php endif; ?>	
						
						<?php
						$args = array(
							'post_type' => 'training_centre',
							'posts_per_page' => -1
						);
						// Create a new instance
						$hcourses = new WP_Query($args);?>
						<?php if ($hcourses->have_posts()) : ?>



						<div id="accordion">
						<?php while( $hcourses->have_posts() ) : $hcourses->the_post(); ?>
						<?php
							$ifgmap = get_custom_field($post->ID, 'tc_gmap_code');
							$permaids[] = $post->ID;

						?>

								<h2><a href="#"><?php the_title(); ?></a></h2>
								
								<div>
								
									<div class="left">

										
										<?php if ( has_post_thumbnail() ) { ?>
											<div class="img tclogo">											
												<?php the_post_thumbnail( 'training-centre-logo' ); ?>
											</div>
										<?php } ?>
																				
										<div class="avacourse">
	
											<?php
											$terms = get_the_terms( $post->ID, 'course_codes' );
																	
											if ( $terms && ! is_wp_error( $terms ) ) : 
											
												$draught_links = array();
											
												foreach ( $terms as $term ) {
												//print_r($term);
													$draught_links[] = $term->slug;
												}
												echo '<p>Available Courses:</p><ul>';
												foreach ($draught_links as $draught_link) {
													$args = array(
													'post_type' => 'course',
													'tax_query' => array(
														array(
															'taxonomy' => 'course_codes',
															'field' => 'slug',
															'terms' => $draught_link
															)
														),
													'post_status' => 'publish'
													);
													$myposts = get_posts( $args );
													
													foreach ( $myposts as $mypost ) {
														$id = $mypost->ID;
														$cids[] = $id;
														$course_title = $mypost->post_title;
														echo '<li><a href="';
														//echo get_permalink($id);
														echo '#inline_content' . $id . '';
														echo '" class="inline" title="'.$course_title.'">';
														echo $course_title;
														echo '</a></li>';
													}
													
												}
												//$on_draught = join( ", ", $draught_links );
												echo '</ul>';
												
											endif;
											
											?>
	
										</div>
										
									</div>
									
									<div class="right">
										
										<?php if ($ifgmap) : ?>

											<div class="gmap-rwd">
																						
												<?php echo $ifgmap; ?>
												
											</div>
										
										<?php endif; ?>
									
									</div>

									<a href="#inline_content<?php echo $post->ID; ?>" class="btn inline" title="<?php the_title(); ?>">Centre details</a>
																		
								</div>
						    
						
						<?php endwhile; endif; ?>
						<?php wp_reset_postdata();?>
						</div>

						<?php 
						$results = array_unique($cids);
						
						foreach ($results as $result) : ?>
						
							<div style="display:none">
							
								<div id="inline_content<?php echo $result; ?>" style="padding:10px; background:#fff;">
									<?php 
										/*
										$post_object = get_post( $theid );
										echo $post_object->post_content;
										*/
										$args = array(
											'p' => $result,
											'post_type' => 'course'
										);
										$query = new WP_Query( $args );
										
										// the Loop
										while ($query->have_posts()) : $query->the_post();
											the_content();
										endwhile;
										wp_reset_postdata();
									 ?>
								</div>
								
							</div>
	
						<?php endforeach; ?>
						

						<?php foreach ($permaids as $permaid) : ?>
						
							<div style="display:none">
							
								<div id="inline_content<?php echo $permaid; ?>" style="padding:10px; background:#fff;">
									<?php 
										/*
										$post_object = get_post( $theid );
										echo $post_object->post_content;
										*/
										$args = array(
											'p' => $permaid,
											'post_type' => 'training_centre'
										);
										$query = new WP_Query( $args );
										
										// the Loop
										while ($query->have_posts()) : $query->the_post();
											the_content();
										endwhile;
										wp_reset_postdata();
									 ?>
								</div>
								
							</div>
	
						<?php endforeach; ?>
						
					</div>

					<?php get_sidebar('page'); ?>
					
				</div>
			</div><!-- /main -->
<?php get_footer();?>