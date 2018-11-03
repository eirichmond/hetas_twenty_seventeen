<div class="sidechildmenu">
	<?php wp_nav_menu(
		array(
			'menu' => 'Main Menu',
			'sub_menu' => true,
			//'show_parent' => true,
			//'direct_parent' => true
		)
	); ?>
</div>


<?php if ( is_active_sidebar( 'page-sidebar' ) ) : ?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'page-sidebar' ); ?>
	</div><!-- #secondary -->
<?php endif; ?>

	
<aside id="lastest-posts" class="lastest-posts" role="complementary">
		<?php
		// Create a new instance
		$hetasnews = array(
			'post_type' => 'post',
			'orderby' => 'DESC',
			'posts_per_page' => 3
		 );
		$newsloop = new WP_Query( $hetasnews ); ?>						
		<?php if( $newsloop->have_posts() ) : ?>
		
			<div class="info-box">
				<?php while( $newsloop->have_posts() ) : $newsloop->the_post();?>
				<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
				<p><?php the_excerpt(); ?></p>
				<br />
				<?php endwhile; ?>
			</div>
			
		<?php wp_reset_postdata();
		endif;?>
			
</aside>
					
									
