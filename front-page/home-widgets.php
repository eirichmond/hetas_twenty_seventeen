<div class="hpwidgets">
	<div class="row">
	
		<?php $widgets = get_homepage_widgets(get_the_id()); ?>
	
		<?php foreach ($widgets as $widget) { ?>
			<div class="col-md-3">
				<div class="hpwidget <?php echo esc_attr( $widget['layout'] ); ?>" style="background-color:<?php echo esc_attr( $widget['background'] ); ?>;">
					<img src="<?php echo get_template_directory_uri(); ?>/image/Screen-Shot-2013-04-15-at-16.10.30.png" alt="Screen-Shot-2013-04-15-at-16.10.30" width="259" height="224" />
					<div class="text <?php echo esc_attr( $widget['layout'] ); ?>" style="background-color:<?php echo esc_attr( $widget['background'] ); ?>;">
						<?php echo apply_filters( 'the_content', $widget['text'] ); ?>
					</div>
				</div>
			</div>
		<?php } ?>
	
	</div>
</div>