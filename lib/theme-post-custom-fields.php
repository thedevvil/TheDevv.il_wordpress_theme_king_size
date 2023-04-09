<?php
/**
 * @KingSize 2011
 *
**
 * The PHP code for setup Theme post custom fields.
 */

/*
	Begin creating custom post fields 
*/
$post_postmetas = 
	array (
		/*
			Begin Post custom fields
		*/
		array("section" => "Custom Background", "id" => "kingsize_post_background",  "title" => "Custom Background" , "desc" => "Upload a custom background that overrides the default.",'extras' => 'getimage','type' => 'text'),

		array("section" => "Featured Images", "name" => "Featured Images Lightbox Options", "id" => "kingsize_featured_img_lightbox", "type" => "select", "title" => "Enable/Disable Lightbox on Featured Image", "items" => array("enable"=>"Enable Lightbox", "disable"=>"Disable Lightbox"),'desc'=>'By default Featured Images will open the post when clicked. Here you can choose to Enable/Disable the image lightbox options.'),
		
		/* Define the Featured Image Height override v4 */
		array("section" => "Featured Image Height", "name" => "Featured Image Height", "id" => "kingsize_post_featured_img_height",  "title" => "Featured Image Height",'type' => 'text','desc'=>'Customize the Featured Image height for this individual post. Insert only the numerical size (ie., 400). Default size is 460px by 180px.'),
		
		/* Background Slider Categories V4 */
		array("section" => "Background Slider Category ID", "name" => "Background Slider Category ID", "id" => "kingsize_post_background_slider_id",  "title" => "Background Slider Category ID",'type' => 'text','desc'=>'Instead of a Single Background Image which can be uploaded/assigned above, here you can assign a Slider Category to display. To display a Slider as your Background, first create the Category via "Slider" and then go add/create your new Background Images.'),

		/* Video background options */
		array("section" => "Override Video background", "name" => "Custom Page Video Background", "id" => "kingsize_post_video_background",  "title" => "Override Video background", 'type' => 'text', 'desc'=>'Enter the URL of the Background Video<B>(Youtube/Vimeo/MP4)</B> you want to use on this page being created.It will override the page background image(if any).'),

		array("section" => "Autoplay Video", "name" => "Autoplay Video", "id" => "kingsize_post_autoplay_video",  "title" => "Autoplay Video", 'type' => 'checkbox', 'desc'=>'If checked video will autoplay.'),

		array("section" => "Controlbar Video", "name" => "Controlbar Video", "id" => "kingsize_post_controlbar_video",  "title" => "Controlbar Video", 'type' => 'checkbox', 'desc'=>'If checked hide the controlbar.'),

		array("section" => "Repeat video", "name" => "Repeat Video", "id" => "kingsize_post_repeat_video",  "title" => "Repeat video", 'type' => 'checkbox', 'desc'=>'If checked video will repeat.'),

		
		/* Hide the content and Menu option v4*/
		array("section" => "Hide the body content", "name" => "Hide the body content", "id" => "post_hide_content",  "title" => "Hide the body content", 'type' => 'checkbox', 'desc'=>'If checked will hide the body content on page load.'),

		array("section" => "Hide the Menu", "name" => "Hide the Menu", "id" => "post_hide_menu",  "title" => "Hide the Menu", 'type' => 'checkbox', 'desc'=>'If checked will hide the menu on page load.'),
		
		/*Turn off the sidebar v4*/
		array("section" => "Disable the Sidebar", "name" => "Disable the Sidebar", "id" => "post_sidebar_hide",  "title" => "Hide the Sidebar", 'type' => 'checkbox', 'desc'=>'If checked will hide the sidebar on this post.'),

		/*
			End Post custom fields
		*/
		
	);
?>
<?php
//Apply a custom Background to this specific Post
function post_create_meta_box() {
 
	global $post_postmetas;
	if ( function_exists('add_meta_box') && isset($post_postmetas) && count($post_postmetas) > 0 ) {  
		add_meta_box( 'post_metabox', 'Kingsize Post Options', 'post_new_meta_box', 'post', 'normal', 'high' );  
	}

} 
function post_new_meta_box() {
	global $post, $post_postmetas;
	
	echo '<p style="padding:10px 0 0 0;">'.__('Want to apply a unique background to this specific post? You can upload or insert the URL of the image you want here.', 'framework').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	echo '<table class="form-table">';
	
	$meta_section = '';

	foreach ( $post_postmetas as $postmeta ) {

		$meta_id = $postmeta['id'];
		$meta_title = $postmeta['title'];
		
		$meta_type = '';
		if(isset($postmeta['type']))
		{
			$meta_type = $postmeta['type'];
		}
		
		if(empty($meta_section) OR $meta_section != $postmeta['section'])
		{
			$meta_section = $postmeta['section'];
			
			echo "";
		}
		$meta_section = $postmeta['section'];

		if ($meta_type == 'checkbox') {
			$checked = get_post_meta($post->ID, $meta_id, true) == '1' ? "checked" : "";
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $meta_id, '"><strong>', $meta_title, '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $postmeta['desc'].'</span></label></th>',
				'<td>';
			echo "<input type='checkbox' name='$meta_id' id='$meta_id' value='1' $checked />";
		}
		else if ($meta_type == 'select') {
				echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $meta_id, '"><strong>', $meta_title, '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $postmeta['desc'].'</span></label></th>',
				'<td>';

			echo "<select name='$meta_id' id='$meta_id' style='width:75%; margin-right: 20px; float:left;'>";
			echo '<option value="">'.$meta_title.'</option>';

			if(!empty($postmeta['items']))
			{
				foreach ($postmeta['items'] as $key_item=>$item)
				{
					$kingsize_page_columns = get_post_meta($post->ID, $meta_id);
				
					if(isset($kingsize_page_columns[0]) && $key_item == $kingsize_page_columns[0])
					{
						$css_string = 'selected';
					}
					else
					{
						$css_string = '';
					}
					echo '<option value="'.$key_item.'" '.$css_string.'>'.$item.'</option>';
				
				}
			}
			
			echo "</select></p>";
		}
		else {
				//text	

			 $extras = $postmeta['extras'];

			// class here			
			$class = ' class="code"';
			if($extras == "getimage" OR $extras == "getvideo") 			 
				$class = ' class="uploadbutton"'; 
			

			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $meta_id, '"><strong>', $meta_title, '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $postmeta['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $meta_id, '" id="', $meta_id, '" value="', wp_specialchars( get_post_meta($post->ID, $meta_id, true), 1 ),'" size="30" style="width:75%; margin-right: 20px; float:left;" '.$class.'/>';
			?>
			
			<?php
			if($extras == "getimage" OR $extras == "getvideo") 	{
			?>
			<!-- media upload -->
			<input type="file" name="upload_<?php echo $meta_id;?>" id="upload_<?php echo $meta_id;?>" style="border:1px solid #eeeeee;width:75%; margin-right: 20px; float:left;" size="45"/>
			<!-- end media upload -->
			<?php } ?>

			<input type="hidden" name="<?php echo $meta_id; ?>_noncename" id="<?php echo $meta_id; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />

			</tr>
	<?php
		}
	}

	echo '</table>';
}

function post_save_postdata( $post_id ) {

	global $post_postmetas;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( isset($_POST['myplugin_noncename']) && !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename(__FILE__) )) {
		return $post_id;
	}

	// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want to do anything

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

	// Check permissions

	if ( isset($_POST['post_type']) && 'post' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}

	// OK, we're authenticated

	if ( $parent_id = wp_is_post_revision($post_id) )
	{
		$post_id = $parent_id;
	}

	foreach ( $post_postmetas as $postmeta ) {
	
		if ($_POST[$postmeta['id']]) {
			post_update_custom_meta($post_id, $_POST[$postmeta['id']], $postmeta['id']);
		}

		if ($_POST[$postmeta['id']] == "") {
			delete_post_meta($post_id, $postmeta['id']);
		}
	}

	 // file upload //		
		if ($_FILES["upload_kingsize_post_background"]["type"]){

			$special_chars = array (' ','`','"','\'','\\','/'," ","#","$","%","^","&","*","!","~","`","\"","'","'","=","?","/","[","]","(",")","|","<",">",";","\\",",");
			$filename = str_replace($special_chars,'',$_FILES['upload_kingsize_post_background']['name']);
			//$filename = time() . $filename;
			
			$directory = dirname(__FILE__) . "/images/upload/";
			$directory = str_replace("lib/","",$directory);		
			@move_uploaded_file($_FILES["upload_kingsize_post_background"]["tmp_name"],
			$directory . $filename);
			@chmod($directory . $filename, 0644);
			$uploaded_image_path = get_option('siteurl'). "/wp-content/themes/". get_option('template')."/images/upload/". $filename;

			//updating the meta value of background 
			post_update_custom_meta($post_id, $uploaded_image_path, "kingsize_post_background");

	}	
	/// ennd file upload //

}

function post_update_custom_meta($postID, $newvalue, $field_name) {

	if (!get_post_meta($postID, $field_name)) {
		add_post_meta($postID, $field_name, $newvalue);
	} else {
		update_post_meta($postID, $field_name, $newvalue);
	}

}

//init
add_action('admin_menu', 'post_create_meta_box'); 
add_action('save_post', 'post_save_postdata'); 

/*
	End creating custom fields
*/

?>
