<?php
/*
	Template Name: Sage temporary
*/
get_header(); ?>

		<?php get_template_part( 'header-parts/search', 'nav' ); ?>

			<div id="main">
				<div class="clearfix">
					<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
						<div id="content-fullw">
							<div class="article" id="post-<?php the_ID(); ?>">
								<?php the_content(); ?>


								<div class="row">
									<div class="col-md-4">
										<div class="box halfuser" id="registrant">
											<a href="/wp-admin/" target="_blank">
												<h1>HETAS <br>Registrant</h1>
												<div class="row">
													<div class="col-md-8">
														<p>Click here</p>
													</div>
													<div class="col-md-4">
														<img class="hrlogin" src="<?php bloginfo ('template_url'); ?>/images/redlog.png">
													</div>
												</div>
											</a>
										</div>

									</div>
									<div class="col-md-4">
										<div class="box halfuser" id="training-center">
											<a href="<?php bloginfo ('url'); ?>/members-area/">

												<h1>Training <br>Centre</h1>

												<div class="row">
													<div class="col-md-8">
														<p>Login here</p>
													</div>
													<div class="col-md-4">
														<img class="tlogin" src="<?php bloginfo ('template_url'); ?>/images/greenlog.png">
													</div>
												</div>
											</a>
										</div>
									</div>
									<div class="col-md-4">
										<div class="box halfuser" id="technical-area">
											<a href="<?php bloginfo ('url'); ?>/members-area/">
												<h1>Technical <br>Area</h1>
												<div class="row">
													<div class="col-md-8">
														<p>Login here</p>
													</div>
													<div class="col-md-4">
														<img class="tlogin" src="<?php bloginfo ('template_url'); ?>/images/orangelog.png">
													</div>
												</div>
											</a>
										</div>
									</div>

								</div>




							</div>
						</div>
					<?php endwhile; ?>
					<?php next_posts_link('Older Entries'); ?>
					<?php previous_posts_link('Newer Entries'); ?>
					<?php else : ?>
					<h2>Nothing Found</h2>
					<?php endif; ?>

					<?php //get_sidebar('page'); ?>

				</div>
			</div><!-- /main -->
<?php get_footer();?>