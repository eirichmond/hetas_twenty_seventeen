<aside role="complementary">
	<div class="faq">
		<?php
		// Create a new instance
		$training_side_content = new WP_Query('page_id=1843');?>
		<?php while( $training_side_content->have_posts() ) : $training_side_content->the_post();?>
			<h3><?php the_title ();?></h3>
		    <?php the_content() ;?>
		<?php endwhile;?>
		<?php wp_reset_postdata();?>
	</div>
</aside>			


