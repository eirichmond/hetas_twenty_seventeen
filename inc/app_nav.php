<div class="clearer">

<?php //echo '<pre>'; print_r($wp_query) ; echo '</pre>';?>

<br>

			<?php if ($paged > 1) { ?>
	
			<nav id="nav-posts">
				<div class="next"><?php next_posts_link('View more >>'); ?></div>
				<div class="prev"><?php previous_posts_link('<< Previous'); ?></div>
			</nav>
	
			<?php } else { ?>
	
			<nav id="nav-posts">
				<div class="prev"><?php next_posts_link('View more >>'); ?></div>
			</nav>
	
			<?php } ?>
	
			<?php wp_reset_query(); ?>
</div>