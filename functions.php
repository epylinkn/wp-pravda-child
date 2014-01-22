<?php
define('DEBUG', false);

include_once('models/personality_quiz.php');

function debug($l) {
  if (DEBUG) { echo $l; }
}
// pretty print arrays
function pr($array=null, $title='') {
  return "<pre><code>" . $title . ' > ' . print_r($array, true) . "</code></pre>";
}

/*----------------------------------------------------------------------------*/
/*  Enqueues scripts for front-end
/*----------------------------------------------------------------------------*/
add_action('wp_enqueue_scripts', 'child_add_scripts');

function is_checked($a, $b) {
  echo ($a == $b) ? 'checked=checked' : '';
}

function child_add_scripts() {
  wp_register_script(
                     'backbone',
                     get_stylesheet_directory_uri() . '/js/backbone-min.js',
                     false,
                     null,
                     true
                     );
  wp_register_script(
                     'brainfall',
                     get_stylesheet_directory_uri() . '/js/brainfall.js',
                     array('backbone'),
                     null,
                     true
                     );
  wp_enqueue_script( 'backbone', array('jquery') );
  wp_enqueue_script( 'brainfall', array('jquery') );
}

?>
