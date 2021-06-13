<?php

class BitTestWidget extends WP_Widget {

	function __construct() {

		$widget_options = array(
			'classname' => 'bittest_widget',
			'description' => 'Displays a BitTest instance',
		);

		parent::__construct( 'bittest_widget', 'BitTest Widget', $widget_options );

	}

	function widget($args, $instance) {

		require_once('view.php');

		$title = !empty($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';
		
		$numar1 = !empty($instance['numar1']) && is_numeric($instance['numar1']) ? $instance['numar1'] : 10;
		
		$numar2 = !empty($instance['numar2']) && is_numeric($instance['numar2']) ? $instance['numar2'] : 100;

		$output = $args['before_widget'];
		$output .= $args['before_title'].$title.$args['after_title'];
		$output .= BitTestView::generate_view($numar1, $numar2);
		$output .= $args['after_widget'];

		echo $output;

	}

	function form($instance) {

		$title = !empty($instance['title']) ? $instance['title'] : '';
		$numar1 = !empty($instance['numar1']) ? $instance['numar1'] : 10;
		$numar2 = !empty($instance['numar2']) ? $instance['numar2'] : 100;

		$output = '';
		
		// start title
		
		$output .= '<p>';
			$output .= '<label for="'.$this->get_field_id('title').'">Title:</label><br />';
			$output .= '<input class="widefat" type="text" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" value="'.esc_attr($title).'" />';
		$output .= '</p>';
		
		// end title
		
		// start numar1
		
		$output .= '<p>';
			$output .= '<label for="'.$this->get_field_id('numar1').'">Numar1:<br /><i>introduceti un numar intreg</i></label><br />';
			$output .= '<input class="widefat" type="text" id="'.$this->get_field_id('numar1').'" name="'.$this->get_field_name('numar1').'" value="'.esc_attr($numar1).'" />';
		$output .= '</p>';
		
		// end numar1
		
		// start numar2
		
		$output .= '<p>';
			$output .= '<label for="'.$this->get_field_id('numar2').'">Numar2:<br /><i>introduceti un numar intreg mai mare decat numarul 1</i></label><br />';
			$output .= '<input class="widefat" type="text" id="'.$this->get_field_id('numar2').'" name="'.$this->get_field_name('numar2').'" value="'.esc_attr($numar2).'" />';
		$output .= '</p>';
		
		// end numar2

		echo $output;

	}

	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['numar1'] = strip_tags($new_instance['numar1']);
		$instance['numar2'] = strip_tags($new_instance['numar2']);

		return $instance;

	}

}
