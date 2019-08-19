<?php
// Create a new instance
$homepageloop = array(
	'post_type' => 'page',
	'meta_query' => array(
		array(
			'key' => 'include_on_homepage',
			'value' => 1,
		)
	),
	'orderby' => 'DESC'
);
$hetasguide = new WP_Query( $homepageloop ); ?>


<div class="row">

	<div class="col-md-6">

		<?php $i=0; while( $hetasguide->have_posts() ) : $hetasguide->the_post();?>


			    <?php if ($i%2==0) { // if counter is multiple of 3 ?>
				    <div class="row">
					    <div class="hpgrid">
					    <?php } ?>

							<div class="col-md-6">
							    <h4><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Go to %s'), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
							    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Go to %s'), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'home-page-thumb' ); } ?></a>
							</div>

					    <?php $i++; ?>

					    <?php if($i%2==0) { // if counter is multiple of 3 ?>
						</div>
				    </div>
			    <?php } ?>


		<?php endwhile;?>
		<?php wp_reset_postdata();?>



	</div>

	<div class="col-md-6">
		<?php
			//if( function_exists( 'ninja_forms_display_form' ) ){ ninja_forms_display_form( 3 ); }
			Ninja_Forms()->display( 3, false );
		?>
	</div>

</div>