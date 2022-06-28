<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hetas_Twenty_Seventeen
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head();
if(!is_user_logged_in()) {
	wp_redirect( '/wp-admin/' );
	exit;
}
?>

<script type='text/javascript'>
(function (d, t) {
  var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
  bh.type = 'text/javascript';
  bh.src = 'https://www.bugherd.com/sidebarv2.js?apikey=grp7tithbbqjzhrxtqcr6a';
  s.parentNode.insertBefore(bh, s);
  })(document, 'script');
</script>


</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'hetas_twenty_seventeen' ); ?></a>


	<header id="masthead" class="site-header container" role="banner">

		<?php wp_nav_menu( array(
		    'theme_location' => is_user_logged_in() ? 'members-logged-in' : 'members-logged-out',
		    'menu_class' => 'loggers',
		    'container' => false,
		) ); ?>

		<div class="row">
			<div class="col-md-12">

				<?php get_template_part( 'header-parts/header', 'nav' ); ?>

			</div>
		</div>


	</header><!-- #masthead -->

	<div id="content" class="site-content container">
