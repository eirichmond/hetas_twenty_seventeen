<?php get_header(); ?>

	<?php get_template_part( 'header-parts/search', 'nav' ); ?>
	
	
		<main id="main" class="site-main col-md-9" role="main">
			<div class="clearfix">
				<?php if (have_posts()) : ?> 
				<?php while (have_posts()) : the_post(); ?> 
					<div id="content">
						<div class="article" id="post-<?php the_ID(); ?>">
							<header class="entry-header">
								<h1><?php the_title(); ?></h1> 

								<div class="entry-meta">
									<?php hetas_twenty_seventeen_posted_on(); ?>
								</div><!-- .entry-meta -->

							</header>
							<div class="featimg">
								<?php 
								if ( has_post_thumbnail() ) {
									the_post_thumbnail('full-width');
								}
								?>
							</div>
							
<!-- 							<p class="meta"><span>Posted on</span> <?php the_time('F jS, Y'); ?> <span>by</span> <?php the_author(); ?></p>  -->
							<?php the_content('Read Full Article'); ?> 
<!-- 							<p><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', '); ?> <?php comments_popup_link('No Comments;', '1 Comment', '% Comments'); ?></p>  -->
							

						<?php get_template_part( 'content', 'single' ); ?>
						<?php comments_template( '', true ); ?>


						</div>
					</div>
					

				<?php endwhile; ?> 
				<?php next_posts_link('Older Entries'); ?> 
				<?php previous_posts_link('Newer Entries'); ?> 
				<?php else : ?> 
				<h2>Nothing Found</h2>
				<?php endif; ?>	
				
				
				
			</div>
		</main><!-- /main -->
		
		<div class="col-md-3">
			<?php get_sidebar(); ?>
		</div>
		
<?php get_footer();?>


