<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hetas_Twenty_Seventeen
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
	
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'hetas_twenty_seventeen' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2><!-- .comments-title -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'hetas_twenty_seventeen' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'hetas_twenty_seventeen' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'hetas_twenty_seventeen' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'hetas_twenty_seventeen' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'hetas_twenty_seventeen' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'hetas_twenty_seventeen' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'hetas_twenty_seventeen' ); ?></p>
	<?php
	endif;
	
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	
	$consent = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
	
	$fields =  array(
	
	  'author' =>
	    '<p class="comment-form-author form-group"><label for="author">' . __( 'Name', 'domainreference' ) .
	    ( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
	    '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
	    '" size="30"' . $aria_req . ' /></p>',
	
	  'email' =>
	    '<p class="comment-form-email form-group"><label for="email">' . __( 'Email', 'domainreference' ) .
	    ( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
	    '<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
	    '" size="30"' . $aria_req . ' /></p>',
	
	  'url' =>
	    '<p class="comment-form-url form-group"><label for="url">' . __( 'Website', 'domainreference' ) . '</label>' .
	    '<input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
	    '" size="30" /></p>',
	);
	
	$fields['cookies'] =  '<p class="comment-form-cookies-consent checkbox">
	<label for="wp-comment-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . __( 'Save my name, email, and website in this browser for the next time I comment.' ) . '</label></p>';
	
	$comments_form = array(
		'comment_field' => '<p class="comment-form-comment form-group"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
		'class_submit' => 'btn btn-primary',
		'fields' => $fields,
	);
	comment_form($comments_form);
	?>

</div><!-- #comments -->
