<?php

installer_user_check();

get_header();
?>

	<?php include('installers-nav.php'); ?>
		


	<div id="main" class="offset">
		
		<div class="row">
			
			<div class="col-md-12">
				<div id="content">
					
					<?php
					if ( has_post_thumbnail() ) {
						echo '<div class="featured">';
						the_post_thumbnail(array(100,100));
						echo '</div>';
					}
					?>
					<div class="installers-conent">
						<?php the_content(); ?>
					</div>
									
<!--
					<?php 
					
					$args = array(
						'post_type' => 'installers',
						'post_status' => 'publish',
						'posts_per_page' => -1,
					);
					$the_query = new WP_Query( $args ); ?>
					
					<?php if ( $the_query->have_posts() ) : ?>
					
					  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					  
					  <div class="installers-conent">

						<?php
						if ( has_post_thumbnail() ) {
							echo '<div class="featured">';
							the_post_thumbnail(array(100,100));
							echo '</div>';
						}
						?>

					  
							<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							<p><?php the_excerpt(); ?></p>
							
					  </div>
					  <?php endwhile; ?>
					  <?php wp_reset_postdata(); ?>
					
					<?php else:  ?>
					  <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
					<?php endif; ?>
-->

				</div>
			</div>

		</div>

	</div><!-- /main -->
				
				
<?php get_footer();?>