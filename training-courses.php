<?php
/*
	Template Name: Training Courses
*/
get_header(); ?>

<?php get_template_part( 'header-parts/search', 'brand' ); ?>

	<div class="row">

		<div class="col-md-9">
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
							'post_type' => 'course',
							'posts_per_page' => -1
						);
						// Create a new instance
						$hcourses = new WP_Query($args);
						$theids = array();
						?>
						<?php if ($hcourses->have_posts()) : ?>


						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

							<?php while( $hcourses->have_posts() ) : $hcourses->the_post();?>
							
								
								
								
								
								
								
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="heading<?php echo esc_attr( $post->ID );?>">
										<h4 class="panel-title">
											<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo esc_attr( $post->ID );?>" aria-expanded="true" aria-controls="collapse<?php echo esc_attr( $post->ID );?>"><?php the_title(); ?></a>
										</h4>
									</div>
									<div id="collapse<?php echo esc_attr( $post->ID );?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo esc_attr( $post->ID );?>">
										<div class="panel-body">
											
											<div class="img"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'training-manual-thumb' ); } ?></div>

											<?php the_content(); ?>
										</div>
									</div>
								</div>
																	    
							
							<?php endwhile; endif; ?>
							<?php wp_reset_postdata();?>

						</div>
						
						
					</div>
				</div>
			</div><!-- /main -->
		</div>
			
		<div class="col-md-3">
			<?php get_sidebar('page'); ?>
		</div>
	
	</div>

<?php get_footer();?>