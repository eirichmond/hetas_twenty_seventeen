<?php get_header(); ?>

	<?php if (get_current_blog_id() == 1) {
		get_template_part( 'header-parts/search', 'nav' );
	}  ?>
	
		<?php do_action('hetas_before_main_content'); ?>
			<div class="clearfix">
				<?php if (have_posts()) : ?> 
				<?php while (have_posts()) : the_post(); ?> 
					<div id="content">
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
							
							<?php the_content('Read Full Article'); ?> 



							<?php hetas_post_related_posts($post->ID); ?>
							

						<?php get_template_part( 'content', 'single' ); ?>
						<?php comments_template( '', true ); ?>


						</article>
					</div>
					

				<?php endwhile; ?> 
				<?php next_posts_link('Older Entries'); ?> 
				<?php previous_posts_link('Newer Entries'); ?> 
				<?php else : ?> 
				<h2>Nothing Found</h2>
				<?php endif; ?>	
				
				
				
			</div>

		<?php do_action('hetas_after_main_content'); ?>
		
		<?php do_action('hetas_sidebar_content'); ?>
		
<?php get_footer();?>


