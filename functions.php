<?php

// function to pretty print arrays
function pr($array=null) {
	print "<pre><code>"; print_r($array); print "</code></pre>";
}

/*-----------------------------------------------------------------------------------*/
/*  Enqueues scripts for front-end
/*-----------------------------------------------------------------------------------*/
add_action('wp_enqueue_scripts', 'child_add_scripts');

function child_add_scripts() {
	wp_register_script(
		'brainfall',
		get_stylesheet_directory_uri() . '/js/brainfall.js',
		false,
		null,
		true
	);
	wp_enqueue_script( 'brainfall', array('jquery') );
}

function get_action_url($q_id) {
	return "?Q=" . $q_id;
}

?>