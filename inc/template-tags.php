<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Hetas_Twenty_Seventeen
 */

if ( ! function_exists( 'hetas_twenty_seventeen_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function hetas_twenty_seventeen_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'hetas_twenty_seventeen' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'hetas_twenty_seventeen' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span> <span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'hetas_twenty_seventeen_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function hetas_twenty_seventeen_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'hetas_twenty_seventeen' ) );
		if ( $categories_list && hetas_twenty_seventeen_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'hetas_twenty_seventeen' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ' ', 'hetas_twenty_seventeen' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'hetas_twenty_seventeen' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

/*
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		// translators: %s: post title
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'hetas_twenty_seventeen' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}
*/

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'hetas_twenty_seventeen' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function hetas_twenty_seventeen_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'hetas_twenty_seventeen_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'hetas_twenty_seventeen_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so hetas_twenty_seventeen_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so hetas_twenty_seventeen_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in hetas_twenty_seventeen_categorized_blog.
 */
function hetas_twenty_seventeen_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'hetas_twenty_seventeen_categories' );
}
add_action( 'edit_category', 'hetas_twenty_seventeen_category_transient_flusher' );
add_action( 'save_post',     'hetas_twenty_seventeen_category_transient_flusher' );


/**
 * Returns classes for carousell.
 *
 * @param int
 * @return string
 */
function carousel_first_active_class($index) {
	$class = 'item';
	if($index <= 0) {
		$class .= ' active';
	}
	return $class;
}


/**
 * Returns featured slider ID.
 *
 * @param int	the post id
 * @return int	the post/page id to link to
 */
function get_featured_permalink($id) {
	$link_group = get_post_meta($id, 'link_to', true);
	
	if ($link_group == 'Page') {
		$link = 'page_link';
	}
	if ($link_group == 'Post') {
		$link = 'post_link';
	}
	
	$link_to = get_post_meta($id, $link, true);
	
	return $link_to;
}

/**
 * Returns homepage widets.
 *
 * @param int	the post id
 * @return array	the widgets */

function get_homepage_widgets($id) {
	$array = array();
	$widgets = get_post_meta( $id, 'widget', true );
	for ($i = 0; $i < $widgets; $i++) {
		$array[$i]['layout'] = get_post_meta( $id, 'widget_'.$i.'_layout', true );
		$array[$i]['background'] = get_post_meta( $id, 'widget_'.$i.'_background_colour', true );
		$array[$i]['image'] = get_post_meta( $id, 'widget_'.$i.'_image', true );
		$array[$i]['text'] = get_post_meta( $id, 'widget_'.$i.'_text_area', true );
	}
	return $array;
}

/**
 * Returns Google Map Api key.
 *
 * @return string	the Google api key from the Hetas account as provided by Alun Williams
 */
function hetas_gm_api_key() {
	return 'AIzaSyDTBgIiALPDB_Z1C61Jma09ybxncZVgfqA';
}


function hetas_post_related_posts($post_id) {

	//for use in the loop, list 5 post titles related to first tag on current post
	$tags = wp_get_post_tags($post_id);
	if ($tags) {

		echo '<section class="related-posts">';

		echo '<h3>Related News Items</h3>';

		$post_ids = array();
		foreach($tags as $tag) {
			$term_id = $tag->term_id;
			$args = array(
				'tag__in' 			=> array($term_id),
				'post__not_in' 		=> array($post_id),
				'posts_per_page' 	=> 1
			);
			$posts = get_posts($args);
			$post_ids[] = $posts[0]->ID;
		}

		$post_ids = array_filter($post_ids);

		$args = array(
			'post__in' => $post_ids,
			'post_status' => 'publish',
			'order' => 'DESC'
		);

		$related_hetas_posts = new WP_Query($args);
		if( $related_hetas_posts->have_posts() ) {
			while ($related_hetas_posts->have_posts()) : $related_hetas_posts->the_post(); ?>

				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			
			<?php
			endwhile;
		}
		echo '</section>';
		wp_reset_query();

	}

}