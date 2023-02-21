<div class="navigation-container">
	
	<nav class="navbar navbar-default">
		
		<div class="container-fluid">
			
			<div class="navbar-brand">
				<div class="site-branding">
					<img src="<?php echo bloginfo('template_url'); ?>/images/cropped-cropped-hetas-logo-test-92x56.png" alt="MCS HETAS Approved" />

						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title-in"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title-in"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
						endif;
					
						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description-in"><?php echo $description; /* WPCS: xss ok. */ ?></p>
						<?php
						endif; ?>

				</div><!-- .site-branding -->
			</div>
		
		</div>
		
	</nav><!-- #site-navigation -->


</div>


