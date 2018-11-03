<div class="navigation-container">
	
	<nav class="navbar navbar-default">
		
		<div class="container-fluid">
			
			<div class="navbar-brand">
				<div class="site-branding">
					<?php if ( has_custom_logo() ) { ?>
						<?php the_custom_logo(); ?>
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
					<?php } else { ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
						endif;
					
						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
						<?php
						endif; ?>
						
					<?php } ?>
				</div><!-- .site-branding -->
			</div>

					<form role="search" method="get" id="searchform" class="searchform navbar-form navbar-left" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<div class="input-group">
							<input type="text" class="form-control" value="<?php echo get_search_query(); ?>" name="s" id="s" />
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
							</span>
						</div><!-- /input-group -->
					</form>
	
			<!-- Brand and toggle get grouped for better mobile display -->
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
	

			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'nav navbar-nav navbar-right', 'container' => 'div', 'items_wrap' => '<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"><ul class="%1$s" id="%2$s">%3$s</ul></div>', 'container_class' => 'container-fluid', 'walker' => new WPDocs_Walker_Nav_Menu() ) ); ?>
		
		</div>
		
	</nav><!-- #site-navigation -->


</div>


