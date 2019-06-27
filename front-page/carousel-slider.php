<?php
$args = array(
	'post_type' => 'featured_slider',
	'posts_per_page' => -1,
	'post_status' => 'publish'
);

$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		<li data-target="#carousel-example-generic" data-slide-to="1"></li>
		<li data-target="#carousel-example-generic" data-slide-to="2"></li>
	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox">

		<?php $i = 0; while ( $the_query->have_posts() ) : $the_query->the_post(); ?>


		  	<?php $id = get_the_ID(); $link_group = get_post_meta($id, 'link_to', true);
			  	$linkto = get_featured_permalink(get_the_ID());
		  	?>

			<div class="<?php echo carousel_first_active_class($i); ?>">
				<?php if ( has_post_thumbnail() ) { the_post_thumbnail('home-feature'); } ?>
				<div class="carousel-caption">

			    	<?php if ($linkto) { ?>
				    	<h1 class="cc-lead">
					    	<a href="<?php echo get_permalink($linkto); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					    </h1>
			    	<?php } else { ?>
				    	<h1 class="cc-lead"><?php the_title(); ?></h1>
			    	<?php } ?>

					<div class="cc-body">
						<?php the_content(); ?>
					</div>

				</div>
			</div>

		<?php $i++; endwhile; ?>
		<?php wp_reset_postdata(); ?>

	</div>

	<!-- Controls -->
<!--
	<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
-->
</div>

<?php endif; ?>

