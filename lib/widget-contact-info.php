<?php
/**
* @KingSize 2011
* The PHP code for setup Theme widget Contact info.
* Begin creating widget Contact info
* Contact Us
*/
class kingsize_contactinfo_widget extends WP_Widget {
	function kingsize_contactinfo_widget() {
		$widget_ops = array('classname' => 'widget_kingsize_contactinfo', 'description' => 'Sidebar contact info widget' );
		$this->WP_Widget('', 'KingSize Contact Info', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;		
		
		if ($instance['title'] == ''){
			$instance['title'] = 'Contact Info';
		}

		echo '<h3>'. $instance['title'] .'</h3>';
		echo '<div class="sidebar_item">';
		echo '<ul class="contact_list">';	 
		if ($instance['contactinfo_phone'] != ''){
			echo '<li class="contact_phone">'. $instance['contactinfo_phone'] .'</li>';
		}
		
		if ($instance['contactinfo_fax'] != ''){
			echo '<li class="contact_fax">'. $instance['contactinfo_fax'] .'</li>';
		}
		
		if ($instance['contactinfo_email'] != ''){
			echo '<li class="contact_email">' .$instance['contactinfo_email']. '</li>';
		}
			
		if ($instance['contactinfo_address'] != ''){
			echo '<li class="contact_address">'. $instance['contactinfo_address'] .', '. $instance['contactinfo_city'] .'</li>';
		}
		echo '</ul>';	

		// The map generation
		if ($instance['contactinfo_address'] != '' && $instance['contactinfo_city']!= ''){
			echo '<a href="#?custom=true&width=400&height=300" class="mapclick"  rel="prettyPhoto" title="'.$instance['contactinfo_address'] .','. $instance['contactinfo_city'].'"><img src="http://maps.google.com/maps/api/staticmap?center='.$instance['contactinfo_address'] .','. $instance['contactinfo_city'].'&amp;zoom=15&amp;markers='.$instance['contactinfo_address'] .','. $instance['contactinfo_city'].'&amp;size=240x233&amp;sensor=false" alt="map" class="map" width="230"/></a>';	
		}	

		echo '</div>';
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['contactinfo_phone'] = strip_tags($new_instance['contactinfo_phone']);
		$instance['contactinfo_fax'] = strip_tags($new_instance['contactinfo_fax']);
		$instance['contactinfo_email'] = strip_tags($new_instance['contactinfo_email']);
		$instance['contactinfo_city'] = strip_tags($new_instance['contactinfo_city']);
		$instance['contactinfo_address'] = strip_tags($new_instance['contactinfo_address']);
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'contactinfo_phone' => '', 'contactinfo_fax' => '', 'contactinfo_email' => '', 'contactinfo_city' => '', 'contactinfo_address' => '' ) );
		$title = strip_tags($instance['title']);
		$contactinfo_phone = strip_tags($instance['contactinfo_phone']);		
		$contactinfo_fax = strip_tags($instance['contactinfo_fax']);		
		$contactinfo_email = strip_tags($instance['contactinfo_email']);		
		$contactinfo_city = strip_tags($instance['contactinfo_city']);		
		$contactinfo_address = strip_tags($instance['contactinfo_address']);		

		echo '<p><label for="'. $this->get_field_id('title').'">Title: <input class="widefat" id="'. $this->get_field_id('title').'" name="'. $this->get_field_name('title').'" type="text" value="'. attribute_escape($title).'" /></label></p>';

		echo '<p><label for="'. $this->get_field_id('contactinfo_phone').'">Phone: <input class="widefat" id="'.$this->get_field_id('contactinfo_phone').'" name="'. $this->get_field_name('contactinfo_phone').'" type="text" value="'. attribute_escape($contactinfo_phone).'" /></label></p>';			

		echo '<p><label for="'. $this->get_field_id('contactinfo_fax').'">Fax: <input class="widefat" id="'.$this->get_field_id('contactinfo_fax').'" name="'. $this->get_field_name('contactinfo_fax').'" type="text" value="'. attribute_escape($contactinfo_fax).'" /></label></p>';			

		echo '<p><label for="'. $this->get_field_id('contactinfo_email').'">Email: <input class="widefat" id="'.$this->get_field_id('contactinfo_email').'" name="'. $this->get_field_name('contactinfo_email').'" type="text" value="'. attribute_escape($contactinfo_email).'" /></label></p>';			

		echo '<p><label for="'. $this->get_field_id('contactinfo_city').'">Address: <input class="widefat" id="'.$this->get_field_id('contactinfo_city').'" name="'. $this->get_field_name('contactinfo_city').'" type="text" value="'. attribute_escape($contactinfo_city).'" /></label></p>';	

		echo '<p><label for="'. $this->get_field_id('contactinfo_address').'">City: <input class="widefat" id="'.$this->get_field_id('contactinfo_address').'" name="'. $this->get_field_name('contactinfo_address').'" type="text" value="'. attribute_escape($contactinfo_address).'" /></label></p>';	

	}
}	

register_widget('kingsize_contactinfo_widget');
?>