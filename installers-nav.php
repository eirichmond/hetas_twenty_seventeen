			<div class="search-area border instamenu">
				<div class="holder">
				
					<?php
					$menu_setup = array(
					'theme_location' => 'installers',
					'container'       => 'nav',
					'container_class' => 'mainmenu installers'
					);
					wp_nav_menu($menu_setup); ?>

				</div>
			</div><!-- /search-area -->
			
			<?php if (!is_home() ) {

				if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<p id="breadcrumbs">','</p>');
				}
							
			} ?>
