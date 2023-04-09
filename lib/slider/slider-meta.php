<?php
/*
* @KingSize 2012
** Add image upload metaboxes to Slider items **
*/

#-----------------------------------------------------------------#
#####################  Define Metabox Fields  #####################
#-----------------------------------------------------------------#

$prefix = 'kingsize_';

$slider_meta_box_settings = array(
	'id' => 'kingsize-meta-box-settings',
	'title' => 'Slider Settings',
	'page' => 'slider',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(

	/* Video background options V4 */
		array("name" => "Custom 'Learn More' Link", "id" => "kingsize_slider_link",  'type' => 'text', 'desc'=>'Insert the URL you want to be used as the <b>Learn More</b> link.'),

		array("name" => "Custom 'Learn More' Text", "id" => "kingsize_slider_link_text",  'type' => 'text', 'desc'=>'Insert the text you want to use instead of the default <b>Learn More</b> text.'),

		array('name' => 'Open in new window','desc' => 'If checked slider link will open in new window.','id' => 'kingsize_slider_link_open','type' => 'checkbox','std' => ''),	
	
	),
	
);


add_action('admin_menu', 'kingsize_slider_add_box');
/*------------------------------------------------------------------*/
#####################  Add metabox to edit page  #####################
/*------------------------------------------------------------------*/
 
function kingsize_slider_add_box() {
	global $meta_box, $slider_meta_box_settings;

	add_meta_box($slider_meta_box_settings['id'], $slider_meta_box_settings['title'], 'kingsize_slider_show_box_settings', $slider_meta_box_settings['page'], $slider_meta_box_settings['context'], $slider_meta_box_settings['priority']);

	//-----
}



function kingsize_slider_show_box_settings() {
	global $slider_meta_box_settings, $post;
 	
	echo '<p style="padding:10px 0 0 0;">'.__('To customize your Slider Options, go to "Appearance > KingSize Options > Home Settings". To attach an image, use the "Featured Image" option and assign your slider image. Each Slide Post created acts as an individual Slider Image. Within the write-panel you may include a Custom Link and Custom Link text (default says "Learn More") if you wish to link your slider items to another page.', 'framework').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="kingsize_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($slider_meta_box_settings['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) { 
			

			//fields	
			case 'checkbox':			
				$checked = $meta == '1' ? "checked" : "";				
			
				echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
				echo "<input type='checkbox' name='".$field['id']."' id='".$field['id']."' value='1' $checked />";
			break;

			//If Text		
			case 'text':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;

			//If Select		
			case 'select':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';

			echo '<select name="'.$field['id'].'" id="'.$field['id'].'" style="width:200px">';
				foreach ($field['options'] as $key_opt=>$option) { ?>
					 <option value="<?php echo $key_opt;?>" <?php if ( $meta == $key_opt) { echo ' selected="selected"'; } elseif ($option == $field['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
					<?php } 
			echo '</select>';
			
			break;
 
 
			//If Button	
			case 'button':
				echo '<input style="float: left;" type="button" class="button" name="', $field['id'], '" id="', $field['id'], '"value="', $meta ? $meta : $field['std'], '" />';
				echo 	'</td>',
			'</tr>';
			
			break;
		}

	}
 
	echo '</table>';
}
//------
 
add_action('save_post', 'kingsize_slider_save_data');


/*-----------------------------------------------------------------------*/
#####################  Save data when post is edited  #####################
/*-----------------------------------------------------------------------*/
 
function kingsize_slider_save_data($post_id) {
	global $meta_box, $slider_meta_box_settings, $meta_box_video;
 
	// verify nonce
	if (!wp_verify_nonce($_POST['kingsize_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}
 
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
 
	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
 
	foreach ($meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

	foreach ($slider_meta_box_settings['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

	//----
}

