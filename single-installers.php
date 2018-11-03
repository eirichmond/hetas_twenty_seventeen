<?php

installer_user_check();

$access = check_technical_access($post->ID);

$ta_no_access_text = get_post_meta($post->ID, 'no_permission_to_view');

get_header(); ?>

		<?php include('installers-nav.php'); ?>

			<div id="main">
				<div class="clearfix">
					<?php if (have_posts()) : ?> 
					<?php while (have_posts()) : the_post(); ?> 
						<div id="content">
							<div class="article" id="post-<?php the_ID(); ?>">
								

								<?php if ($access || current_user_can( 'administrator')) { ?>
								
									<h1><?php the_title(); ?></h1>
									<?php the_content(); ?>
									
								<?php } else { ?>
								
									<?php if ($ta_no_access_text) { ?>
										<div class="noaccess">
											<p><?php echo esc_html( $ta_no_access_text[0] ); ?></p>
											<p><a href="/technical-area/">&larr; return to main menu</a></p>
										</div>
									<?php } else { ?>
										<div class="noaccess">
											<p>Your account does not allow access to this content.</p>
											<p><a href="/technical-area/">&larr; return to main menu</a></p>
										</div>
									<?php } ?>
									
								
								<?php } ?>
								
							</div>
						</div>
					<?php endwhile; ?> 
					<?php next_posts_link('Older Entries'); ?> 
					<?php previous_posts_link('Newer Entries'); ?> 
					<?php else : ?> 
					<h2>Nothing Found</h2>
					<?php endif; ?>	
					
					<?php get_sidebar('installers'); ?>
					
				</div>
			</div><!-- /main -->
<?php get_footer();?>