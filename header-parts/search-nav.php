<div class="search-area border">
	<div class="btn-group btn-group-justified" role="group" aria-label="Search">
		<div class="btn-group" role="group">
			<a href="<?php echo get_permalink(27) ;?>" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search find-fuels" aria-hidden="true"></span> Fuels</a>
		</div>
		<div class="btn-group" role="group">
			<a href="<?php echo get_permalink(32) ;?>" type="button" class="btn btn-orange"><span class="glyphicon glyphicon-search find-retailers" aria-hidden="true"></span> Retailer</a>
		</div>
		<div class="btn-group" role="group">
			<a href="<?php echo get_permalink(36) ;?>" type="button" class="btn btn-redorange"><span class="glyphicon glyphicon-search find-installers" aria-hidden="true"></span> Installer</a>
		</div>
		<div class="btn-group" role="group">
			<a href="<?php echo get_permalink(234546) ;?>" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search find-servicing" aria-hidden="true"></span> Servicing</a>
		</div>
		<div class="btn-group" role="group">
			<a href="<?php echo get_permalink(263080) ;?>" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search find-servicing" aria-hidden="true"></span> Boiler Maintenance</a>
		</div>
		<div class="btn-group" role="group">
			<a href="<?php echo get_permalink(39) ;?>" type="button" class="btn btn-orange"><span class="glyphicon glyphicon-search find-chimney-sweep" aria-hidden="true"></span> Chimney Sweep</a>
		</div>
		<div class="btn-group" role="group">
			<a href="<?php echo get_permalink(42) ;?>" type="button" class="btn btn-redorange"><span class="glyphicon glyphicon-search find-product" aria-hidden="true"></span> Product</a>
		</div>
	</div>

</div>

<?php if (!is_home() || !is_front_page()) {

	if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('<p id="breadcrumbs">','</p>');
	}

} ?>

