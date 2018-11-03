<?php get_header(); ?>

		<?php get_template_part( 'header-parts/search', 'nav' ); ?>

			<div id="main">
				<div class="clearfix">
					<?php if (have_posts()) : ?> 
					<?php while (have_posts()) : the_post(); ?> 
						<div id="content">
							<div class="article" id="post-<?php the_ID(); ?>">
								<h1><?php the_title(); ?></h1>
								<?php the_content(); ?>
							</div>
						</div>
					<?php endwhile; ?> 
					<?php next_posts_link('Older Entries'); ?> 
					<?php previous_posts_link('Newer Entries'); ?> 
					<?php else : ?> 
					<h2>Nothing Found</h2>
					<?php endif; ?>	
					
					<?php get_sidebar('page'); ?>
					
				</div>
			</div><!-- /main -->
<?php get_footer();?>