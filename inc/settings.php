<?php

$themename = "HETAS";
$shortname = "het";

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "Choose a category"); 

$options = array (
 
array( "name" => $themename." Options",
	"type" => "title"),
 
// for the homepage 
array(
	"name" => "Homepage",
	"type" => "section"
	),
array(
	"type" => "open"
	),

array( "name" => "Homepage main message under header image",
	"desc" => "Enter the text here.",
	"id" => $shortname."_homepage_text",
	"type" => "textarea",
	"std" => ""),
	
array( "name" => "Fuel Product Text",
	"desc" => "Enter the text here.",
	"id" => $shortname."_homepage_fueltxt",
	"type" => "textarea",
	"std" => ""),
	
array( "name" => "Retailers Text",
	"desc" => "Enter the text here.",
	"id" => $shortname."_homepage_rettex",
	"type" => "textarea",
	"std" => ""),
	
array( "name" => "Installers Text",
	"desc" => "Enter the text here.",
	"id" => $shortname."_homepage_instxt",
	"type" => "textarea",
	"std" => ""),
	
array( "name" => "Chimney Sweeps Text",
	"desc" => "Enter the text here.",
	"id" => $shortname."_homepage_cstxt",
	"type" => "textarea",
	"std" => ""),
	
array( "name" => "Appliance Text",
	"desc" => "Enter the text here.",
	"id" => $shortname."_homepage_apptxt",
	"type" => "textarea",
	"std" => ""),
	
/*
array( "name" => "Homepage featured category",
	"desc" => "Choose a category from which featured posts are drawn",
	"id" => $shortname."_feat_cat",
	"type" => "select",
	"options" => $wp_cats,
	"std" => "Choose a category"),

array( "name" => "Homepage specials category",
	"desc" => "Choose a category from which specials posts are drawn",
	"id" => $shortname."_specials_cat",
	"type" => "select",
	"options" => $wp_cats,
	"std" => "Choose a category"),

array( "name" => "Inner page services category",
	"desc" => "Choose a category from which services posts are drawn",
	"id" => $shortname."_services_cat",
	"type" => "select",
	"options" => $wp_cats,
	"std" => "Choose a category"),
*/
	

array( "type" => "close"),

// for fuels section
array(
	"name" => "Fuels Search Page",
	"type" => "section"
	),
array(
	"type" => "open"
	),

array(
	"name" => "Approved Mineral Fuels PDF",
	"desc" => "Paste the file path for this pdf from the media library",
	"id" => $shortname."_fuels_pdf",
	"type" => "text",
	"std" => ""
	),

array(
	"name" => "CO and Alarms PDF",
	"desc" => "Paste the file path for this pdf from the media library",
	"id" => $shortname."_covents_pdf",
	"type" => "text",
	"std" => ""
	),

array(
	"name" => "CO Detectors PDF",
	"desc" => "Paste the file path for this pdf from the media library",
	"id" => $shortname."_codetectors_pdf",
	"type" => "text",
	"std" => ""
	),

array(
	"name" => "Link Up Systems PDF",
	"desc" => "Paste the file path for this pdf from the media library",
	"id" => $shortname."_linkupsys_pdf",
	"type" => "text",
	"std" => ""
	),

/*
array(
	"name" => "Header opening times",
	"desc" => "Enter your opening times that appears on the header.",
	"id" => $shortname."_header_ot",
	"type" => "text",
	"std" => ""
	),
*/

/*
array(
	"name" => "Header address",
	"desc" => "Enter your address that appears on the header.",
	"id" => $shortname."_header_address",
	"type" => "text",
	"std" => ""
	),
*/
	
/* array( "name" => "Custom CSS",
	"desc" => "Want to add any custom CSS code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green}",
	"id" => $shortname."_custom_css",
	"type" => "textarea",
	"std" => ""), */		
 	
/*
array( "name" => "Testimonials category",
	"desc" => "Choose a category from which testimonial posts are drawn",
	"id" => $shortname."_testimonials_cat",
	"type" => "select",
	"options" => $wp_cats,
	"std" => "Choose a category"),
*/
		
array(
	"type" => "close"
	),
	
/*
array(
	"name" => "Messages",
	"type" => "section"
	),
array(
	"type" => "open"
	),

array(
	"name" => "First message heading",
	"desc" => "Enter the call to action that appears on the header.",
	"id" => $shortname."_firstheading_msg",
	"type" => "text",
	"std" => ""
	),

array(
	"name" => "First message",
	"desc" => "Enter the call to action that appears on the header.",
	"id" => $shortname."_first_msg",
	"type" => "textarea",
	"std" => ""
	),

array(
	"name" => "Second message heading",
	"desc" => "Enter the call to action that appears on the header.",
	"id" => $shortname."_secondheading_msg",
	"type" => "text",
	"std" => ""
	),

array(
	"name" => "Second message",
	"desc" => "Enter the call to action that appears on the header.",
	"id" => $shortname."_second_msg",
	"type" => "textarea",
	"std" => ""
	),

array(
	"name" => "Third message heading",
	"desc" => "Enter the call to action that appears on the header.",
	"id" => $shortname."_thirdheading_msg",
	"type" => "text",
	"std" => ""
	),

array(
	"name" => "Third message",
	"desc" => "Enter the call to action that appears on the header.",
	"id" => $shortname."_third_msg",
	"type" => "textarea",
	"std" => ""
	),

array(
	"type" => "close"
	),
*/
	
/*

array( "name" => "Footer",
	"type" => "section"),
array( "type" => "open"),
	
array( "name" => "Footer copyright text",
	"desc" => "Enter text used in the right side of the footer. It can be HTML",
	"id" => $shortname."_footer_text",
	"type" => "text",
	"std" => ""),
	
array( "name" => "Google Analytics Code",
	"desc" => "You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.",
	"id" => $shortname."_ga_code",
	"type" => "textarea",
	"std" => ""),	
	
array( "name" => "Custom Favicon",
	"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
	"id" => $shortname."_favicon",
	"type" => "text",
	"std" => get_bloginfo('url') ."/favicon.ico"),	
	
array( "name" => "Feedburner URL",
	"desc" => "Feedburner is a Google service that takes care of your RSS feed. Paste your Feedburner URL here to let readers see it in your website",
	"id" => $shortname."_feedburner",
	"type" => "text",
	"std" => get_bloginfo('rss2_url')),

 
array( "type" => "close")
*/
 
);


function mytheme_add_admin() {
 
global $themename, $shortname, $options;
 
if ( isset($_GET['page']) && $_GET['page'] == basename(__FILE__) ) {
 
	if ( 'save' == $_REQUEST['action'] ) {
 
		foreach ($options as $value) {
		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
 
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
 
	header("Location: admin.php?page=settings.php&saved=true");
die;
 
} 
else if( 'reset' == $_REQUEST['action'] ) {
 
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
 
	header("Location: admin.php?page=settings.php&reset=true");
die;
 
}
}
 
add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');
}

function mytheme_add_init() {

$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/functions/functions.css", false, "1.0", "all");
wp_enqueue_script("rm_script", $file_dir."/functions/rm_script.js", false, "1.0");

}
function mytheme_admin() {
 
global $themename, $shortname, $options;
$i=0;
 
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
 
?>
<div class="wrap rm_wrap">
<h2><?php echo $themename; ?> Settings</h2>
 
<div class="rm_opts">
<form method="post">
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?>
 
<?php break;
 
case "close":
?>
 
</div>
</div>
<br />

 
<?php break;
 
case "title":
?>
<p>To easily use the <?php echo $themename;?> theme, you can use the menu below.</p>

 
<?php break;
 
case 'text':
?>

<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
<?php
break;
 
case 'textarea':
?>

<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
  
<?php
break;
 
case 'select':
?>

<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>

	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php
break;
 
case "checkbox":
?>

<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />


	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; 
case "section":

$i++;

?>

<div class="rm_section">
<div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/functions/images/trans.png" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save changes" />
</span><div class="clearfix"></div></div>
<div class="rm_options">

 
<?php break;
 
}
}
?>
 
<input type="hidden" name="action" value="save" />
</form>
<!--
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
-->
</div> 
 

<?php
}
?>
<?php
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>