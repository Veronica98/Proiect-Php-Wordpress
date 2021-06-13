<?php

/**
*   Plugin Name: BitTest
*   Plugin URI: http://www.bitacad.net
*   Description: Un plugin care va activa un shortcode si un widget ce ne permit sa calculam si sa afisam valoarea factorialului pentru un numar.
*   Version: 1.0
*   Author: Bit Academy
*   Author URI: http://www.bitacad.net
*   License: http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

// no direct access

if (!defined('ABSPATH')) { die; }

function bittest_add_css() {

	wp_register_style('bittest-css', plugins_url('/theme/css/frontend.css', __FILE__));

	wp_enqueue_style('bittest-css');

}

function bittest_add_js() {

	wp_register_script('bittest-js', plugins_url('/theme/js/frontend.js', __FILE__), array('jquery'));

	wp_enqueue_script('bittest-js');

}

function bittest_shortcode($atts) {

	require_once('inc/view.php');

	//var_dump($atts);

	$atts = shortcode_atts(array('numar1' => 10, 'numar2' => 100), $atts, 'bittest');
	
	$numar1 = $atts['numar1'];
	$numar2 = $atts['numar2'];
	
	$output = BitTestView::generate_view($numar1, $numar2);

	return $output;

}

function bittest_widget() {

	require_once('inc/widget.php');

	register_widget('BitTestWidget');

}

add_action('wp_enqueue_scripts', 'bittest_add_css');
add_action('wp_enqueue_scripts', 'bittest_add_js');

add_action('widgets_init', 'bittest_widget');
add_shortcode('bittest', 'bittest_shortcode');

//===== SHORTCODE USER SEARCH =====//

add_shortcode('add_user', 'custom_add_user');

function custom_add_user($atts) {
	
	$current_user=wp_get_current_user();
	if(in_array("administrator", $current_user->roles)){
		global $wpdb;
		
		require_once('inc/model.php');
		require_once('inc/view.php');
		
		$input_uname = !empty($_GET['uname']) ? $_GET['uname'] : false;
		$input_upass = !empty($_GET['upass']) ? $_GET['upass'] : false;
		$input_uemail = !empty($_GET['uemail']) ? $_GET['uemail'] : false;
		
		
		$model_obj = new BitTestModel($input_uname,$input_upass,$input_uemail,$wpdb);
		$results = $model_obj->add_user($input_uname,$input_upass,$input_uemail);
		$users=$model_obj->get_users_data();
		
		$output = BitTestView::generate_add_user($users);
		
		return $output;
	} 
	return false;
	
}






















