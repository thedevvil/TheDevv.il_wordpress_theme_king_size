<?php /**
 * @KingSize 2012
 *
 * The PHP code for setup Theme page custom fields.
 */

/*
	Begin creating custom fields
*/
#### DropDown for the porfolio PAGE  CATEGORY ####
define('TERM_TAXONOMY', $wpdb->prefix . 'term_taxonomy');
define('TERMS', $wpdb->prefix . 'terms');
define('POSTS', $wpdb->prefix . 'posts');
define('TERM_RELATIONSHIPS', $wpdb->prefix . 'term_relationships');


$arr_cat_portfolio = array();
$arr_cat_portfolio = $wpdb->get_results("SELECT terms.name,term_taxonomy_id,terms.term_id FROM ".TERM_TAXONOMY." taxonomy,".TERMS." terms 
WHERE terms.term_id = taxonomy.term_id AND taxonomy = 'portfolio-category' ORDER BY terms.name");
$arr_dropdown_portfolio_cat = array();
if(count($arr_cat_portfolio)) :
	foreach($arr_cat_portfolio as $portfolio_cat){
		$arr_dropdown_portfolio_cat[$portfolio_cat->term_id] = $portfolio_cat->name;
		//$arr_dropdown_portfolio_cat[$portfolio_cat->term_taxonomy_id] = $portfolio_cat->name;
	}
endif;
######## End DropDown for the porfolio PAGE  CATEGORY ############

#### DropDown for the porfolio PAGE  ORDERBY V4 ####
$arr_dropdown_portfolio_orderby =  array("default"=>"Default DESC (by Date)", "rand"=>"Random Order", "custom_id"=>"Custom ID Order", "asc_order"=>"ASC (by Date)");
#### End DropDown for the porfolio PAGE  ORDERBY V4 ####

$page_postmetas = 
	array (
		/*
			Begin Page custom fields
		*/

		array("section" => "Portfolio Categories", "name" => "Portfolio Categories", "id" => "kingsize_page_porfolio_category", "type" => "select", "title" => "Select a Portfolio Category for Portfolio pages", "items" => $arr_dropdown_portfolio_cat, 'desc'=>'To create different / unlimited Portfolios, create "<a href="edit-tags.php?taxonomy=portfolio-category&post_type=portfolio">Portfolio Categories</a>" and assign them here when creating the Portfolio page.'),

		/* PORTFOLIO ORDERBY V4 */
		array("section" => "Portfolio ORDERBY", "name" => "Portfolio OrderBy", "id" => "kingsize_page_porfolio_orderby", "type" => "select", "title" => "Select a Portfolio ORDERBY for Portfolio items", "items" => $arr_dropdown_portfolio_orderby, 'desc'=>'To create order in which they want these portfolio items displayed on this specific Portfolio Page.'),
		/* End PORTFOLIO ORDERBY V4 */


		array("section" => "Gallery Layouts", "name" => "Gallery Page Layouts", "id" => "kingsize_page_columns", "type" => "select", "title" => "Select a Gallery Layout for your Gallery pages", "items" => array("2columns"=>"2 Column Layout", "3columns"=>"3 Column Layout", "4columns"=>"4 Column Layout", "grid"=>"The Grid Layout"),'desc'=>'When creating your Gallery Pages using the Gallery Template, assign which Layout / Style you want them to use when being displayed.'),

		array("section" => "Override background", "name" => "Custom Page Background", "id" => "kingsize_page_background",  "title" => "Override background",'extras' => 'getimage','type' => 'text','desc'=>'Enter the URL of the Background Image you want to use on this page being created. You can also browse your computer and upload the specific background image desired.'),
		
		/* Background Slider Categories V4 */
		array("section" => "Background Slider Category ID", "name" => "Background Slider Category ID", "id" => "kingsize_page_background_slider_id",  "title" => "Background Slider Category ID",'type' => 'text','desc'=>'Instead of a Single Background Image which can be uploaded/assigned above, here you can assign a Slider Category to display. To display a Slider as your Background, first create the Category via "Slider" and then go add/create your new Background Images.'),
		/* End of Background Slider Category */
		
		/* Video background options V4 */
		array("section" => "Override Video background", "name" => "Custom Page Video Background", "id" => "kingsize_page_video_background",  "title" => "Override Video background", 'type' => 'text', 'desc'=>'Enter the URL of the Background Video<B>(Youtube/Vimeo/MP4)</B> you want to use on this page being created.It will override the page background image(if any).'),

		array("section" => "Autoplay Video", "name" => "Autoplay Video", "id" => "kingsize_page_autoplay_video",  "title" => "Autoplay Video", 'type' => 'checkbox', 'desc'=>'If checked video will autoplay.'),

		array("section" => "Controlbar Video", "name" => "Controlbar Video", "id" => "kingsize_page_controlbar_video",  "title" => "Controlbar Video", 'type' => 'checkbox', 'desc'=>'If checked hide the controlbar.'),

		array("section" => "Repeat video", "name" => "Repeat Video", "id" => "kingsize_page_repeat_video",  "title" => "Repeat video", 'type' => 'checkbox', 'desc'=>'If checked video will repeat.'),

		/* Hide the content and Menu option v4*/
		array("section" => "Hide the body content", "name" => "Hide the body content", "id" => "page_hide_content",  "title" => "Hide the body content", 'type' => 'checkbox', 'desc'=>'If checked will hide the body content on page load.'),

		array("section" => "Hide the Menu", "name" => "Hide the Menu", "id" => "page_hide_menu",  "title" => "Hide the Menu", 'type' => 'checkbox', 'desc'=>'If checked will hide the menu on page load.'),

		/*Turn off the sidebar v4*/
		/*array("section" => "Disable the Sidebar", "name" => "Disable the Sidebar", "id" => "page_sidebar_hide",  "title" => "Hide the Sidebar", 'type' => 'checkbox', 'desc'=>'If checked will hide the sidebar on this page.'),*/
		
		/*
			End Page custom fields
		*/
		
	);

function page_create_meta_box() {
	global $page_postmetas;
	if ( function_exists('add_meta_box') && isset($page_postmetas) && count($page_postmetas) > 0 ) {  
		add_meta_box( 'page_metabox', 'Kingsize Page Options', 'page_new_meta_box', 'page', 'normal', 'high' );  
	}
}  

function page_new_meta_box() {
	global $post, $page_postmetas;

	echo '<p style="padding:10px 0 0 0;">'.__('These below settings are for controlling the page option.', 'framework').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
	echo '<table class="form-table">';
	
	$meta_section = '';

	foreach ( $page_postmetas as $postmeta ) {

		$meta_id = $postmeta['id'];
		$meta_title = $postmeta['title'];
		$meta_name = $postmeta['name'];
		
		$meta_type = '';
		if(isset($postmeta['type']))
		{
			$meta_type = $postmeta['type'];
		}
		

		//fields	
		if ($meta_type == 'checkbox') {
			$checked = get_post_meta($post->ID, $meta_id, true) == '1' ? "checked" : "";
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $meta_id, '"><strong>', $meta_name, '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $postmeta['desc'].'</span></label></th>',
				'<td>';
			echo "<input type='checkbox' name='$meta_id' id='$meta_id' value='1' $checked />";

			
		}
		else if ($meta_type == 'select') { //select

			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $meta_id, '"><strong>', $meta_name, '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $postmeta['desc'].'</span></label></th>',
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
			
			echo "</select>";
		}
		else {
			//text	

			 $extras = $postmeta['extras'];

			// class here			
			$class = ' class="code"';
			if($extras == "getimage" OR $extras == "getvideo") 			 
				$class = ' class="uploadbutton"'; 
			

			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $meta_id, '"><strong>', $meta_name, '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $postmeta['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $meta_id, '" id="', $meta_id, '" value="', wp_specialchars( get_post_meta($post->ID, $meta_id, true), 1 ),'" size="30" style="width:75%; margin-right: 20px; float:left;" '.$class.'/>';
			?>
			
			<?php
			if($extras == "getimage" OR $extras == "getvideo") 	{
			?>
			<!-- media upload -->
			<input type="file" name="upload_<?php echo $meta_id;?>" id="upload_<?php echo $meta_id;?>"  size="45" style="border:1px solid #eeeeee;width:75%; margin-right: 20px; float:left;"/>
			<!-- end media upload -->			
			<?php } ?>

			<input type="hidden" name="<?php echo $meta_id; ?>_noncename" id="<?php echo $meta_id; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />

			</tr>

			
			<?php
		}
	}
	
	echo '</table>';

}


################################################################
 function kingsize_add_edit_form_multipart_encoding() {

    echo ' enctype="multipart/form-data"';
}
add_action('post_edit_form_tag', 'kingsize_add_edit_form_multipart_encoding');
################################################################

function page_save_postdata( $post_id ) {

	global $page_postmetas;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( isset($_POST['myplugin_noncename']) && !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename(__FILE__) )) {
		return $post_id;
	}

	// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want to do anything

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

	// Check permissions

	if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
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

	foreach ( $page_postmetas as $postmeta ) {
	
		if ($_POST[$postmeta['id']]) {
			page_update_custom_meta($post_id, $_POST[$postmeta['id']], $postmeta['id']);
		}

		if ($_POST[$postmeta['id']] == "") {
			delete_post_meta($post_id, $postmeta['id']);
		}
	}

	 // file upload //		
		if ($_FILES["upload_kingsize_page_background"]["type"]){

			$special_chars = array (' ','`','"','\'','\\','/'," ","#","$","%","^","&","*","!","~","`","\"","'","'","=","?","/","[","]","(",")","|","<",">",";","\\",",");
			$filename = str_replace($special_chars,'',$_FILES['upload_kingsize_page_background']['name']);
			//$filename = time() . $filename;
			
			$directory = dirname(__FILE__) . "/images/upload/";
			$directory = str_replace("lib/","",$directory);		
			@move_uploaded_file($_FILES["upload_kingsize_page_background"]["tmp_name"],
			$directory . $filename);
			@chmod($directory . $filename, 0644);
			$uploaded_image_path = get_option('siteurl'). "/wp-content/themes/". get_option('template')."/images/upload/". $filename;

			//updating the meta value of background 
			page_update_custom_meta($post_id, $uploaded_image_path, "kingsize_page_background");

		}	
	/// ennd file upload //

}

function page_update_custom_meta($postID, $newvalue, $field_name) {

	if (!get_post_meta($postID, $field_name)) {
		add_post_meta($postID, $field_name, $newvalue);
	} else {
		update_post_meta($postID, $field_name, $newvalue);
	}

}

//init
add_action('admin_menu', 'page_create_meta_box'); 
add_action('save_post', 'page_save_postdata'); 
/*
	End creating custom fields
*/
?>
