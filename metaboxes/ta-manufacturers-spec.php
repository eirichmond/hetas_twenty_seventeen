<?php

$public_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_ta_access',
	'title' => 'Content Access',
	'types' => array('installers'), // added only for pages and to custom post type "events"
	'context' => 'side', // same as above, defaults to "normal"
	'mode' => WPALCHEMY_MODE_EXTRACT,
	'priority' => 'low', // same as above, defaults to "high"
	'template' => get_stylesheet_directory() . '/metaboxes/ta-manufacturers-meta.php'
));

/* eof */