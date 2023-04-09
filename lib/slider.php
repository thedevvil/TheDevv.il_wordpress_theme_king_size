<?php
/**
 * @KingSize 2012
 * Full-width Background Image Form theme-background.php
 **/
?>
<?php
		// Slide Order	
		if($data['wm_slider_display'] == "Custom ID Order") {
			$slider_orderby = "menu_order";	
			$slider_order = "ASC";
		}
		elseif($data['wm_slider_display'] == "Random Order") {
			$slider_orderby = "rand";	
			$slider_order = "";
		}
		elseif($data['wm_slider_display'] == "ASC (by Date)") {
			$slider_orderby = "date";	
			$slider_order = "ASC";
		}
		else { 
			$slider_orderby = "date";
			$slider_order = "DESC";
		}

		//Custom category
		//thanks to http://stackoverflow.com/questions/1155565/query-multiple-custom-taxonomy-terms-in-wordpress-2-8
		//http://richardsweeney.com/wordpress-3-0-custom-queries-post-types-and-taxonomies/
		//$post_cats = wp_get_object_terms(get_the_ID(), 'slider-category', array('fields' => 'ids'));
		
		if(get_post_meta($wp_query->post->ID, 'kingsize_post_background_slider_id', true ) != '') { //post
			$home_page_cat = get_post_meta($wp_query->post->ID, 'kingsize_post_background_slider_id', true );
			$home_page_cat_arr = explode(",",$home_page_cat);
		}
		elseif(get_post_meta($wp_query->post->ID, 'kingsize_page_background_slider_id', true ) != '') { //page
			$home_page_cat = get_post_meta($wp_query->post->ID, 'kingsize_page_background_slider_id', true );
			$home_page_cat_arr = explode(",",$home_page_cat);
		}
		elseif(get_post_meta($wp_query->post->ID, 'kingsize_portfolio_background_slider_id', true ) != '') { //portfolio
			$home_page_cat = get_post_meta($wp_query->post->ID, 'kingsize_portfolio_background_slider_id', true );
			$home_page_cat_arr = explode(",",$home_page_cat);
		}
		else{ //home page
			$home_page_cat = $data['wm_slider_hp_category'];
			$home_page_cat_arr = explode(",",$home_page_cat);
		}

		///Number of slider to show
		if($data['wm_slider_show_number'] > 0)	
			$slide_show_number = $data['wm_slider_show_number'];
		else
			$slide_show_number = -1;

		if($home_page_cat != '') :
			$args=array(
				"tax_query" => array(
					array(
						"taxonomy" => "slider-category",
						"field" => "id",
						"terms" => $home_page_cat_arr
					)
				),
				'post_type' => array('slider'),
				'order' => $slider_order,
				'orderby' => $slider_orderby,
				'posts_per_page' => $slide_show_number,
			);		
		else :
			$args=array(
				'post_type' => array('slider'),
				'order' => $slider_order,
				'orderby' => $slider_orderby,
				'posts_per_page' => $slide_show_number,
			);		
		endif;
		
		$slider_img = "";
		query_posts($args);
		
		global $cnt_slider;
		$cnt_slider = 0;

		if (have_posts()) : 
			while (have_posts()) : 
				the_post();
				
				$cnt_slider++; 

				$slider_link = get_post_meta($post->ID, 'kingsize_slider_link', true ); //slider link
				
				$slider_link_text = get_post_meta($post->ID, 'kingsize_slider_link_text', true );//slider text				
				if(empty($slider_link_text)){
					$slider_link_text = 'Learn more';
				}
				$target_link_open = get_post_meta($post->ID, 'kingsize_slider_link_open', true );//slider text				

				if($target_link_open)
					$link_open = " target='_BLANK'";
				
				
				//getting the image for slider
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 

				if($data['wm_slider_contents'] == 'Display Title & Description'){

					if(!empty($slider_link)){
						if(strip_tags($post->post_content) != "") : //if content
							$slider_img .= '{image : "'.$image[0].'", title : "<h2>'.htmlentities(stripslashes($post->post_title)).'</h2><br /><p>'.htmlentities(stripslashes(strip_tags($post->post_content))).'</p><br /><a href=\''.$slider_link.'\' '.$link_open.'>'.__($slider_link_text, true).'  &rarr;</a>", url: "'.get_permalink( $post->ID ).'"},';
						else :
							$slider_img .= '{image : "'.$image[0].'", title : "<h2>'.htmlentities(stripslashes($post->post_title)).'</h2>", url: "'.get_permalink( $post->ID ).'"},';
						endif;
					}
					else{
						if(strip_tags($post->post_content) != "") : //if content
							$slider_img .= '{image : "'.$image[0].'", title : "<h2>'.htmlentities(stripslashes($post->post_title)).'</h2><br /><p>'.htmlentities(stripslashes(strip_tags($post->post_content))).'</p>", url: "'.get_permalink( $post->ID ).'"},';
						else :
							$slider_img .= '{image : "'.$image[0].'", title : "<h2>'.htmlentities(stripslashes($post->post_title)).'</h2>", url: "'.get_permalink( $post->ID ).'"},';
						endif;
					}

				}else{
					$slider_img .= '{image : "'.$image[0].'"},';
				}


			endwhile; 
	   else :
			$slider_img = '{image : "'.$data['wm_background_image'].'"},';
	   endif; 
	   wp_reset_query(); 

	   ########### Slider transition type #########
		   $transition = 1;
	   if($data['wm_slider_transition_type'] == 'Fade') 
	   	   $transition = 1;
	   elseif($data['wm_slider_transition_type'] == 'Slide Top') 
	   	   $transition = 2;
	   elseif($data['wm_slider_transition_type'] == 'Slide Right') 
	   	   $transition = 3;
	   elseif($data['wm_slider_transition_type'] == 'Slide Bottom') 
	   	   $transition = 4;
	   elseif($data['wm_slider_transition_type'] == 'Slide Left') 
	   	   $transition = 5;
	   elseif($data['wm_slider_transition_type'] == 'Carousel Right') 
	   	   $transition = 6;
	   elseif($data['wm_slider_transition_type'] == 'Carousel Left') 
	   	   $transition = 7;
	   ########### End Slider transition type #########
?>
		
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/supersized.3.2.6.min.js"></script>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/theme/supersized.shutter.min.js"></script>
	    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.min.js"></script>
	    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/supersized.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/theme/supersized.shutter.css" type="text/css" media="screen" />
		
		<script type="text/javascript">
			
			jQuery(function($){
				
				$.supersized({
				
					// Functionality
					slide_interval          :   <?php echo $data['wm_slider_seconds'];?>,		// Length between transitions
					transition              :   <?php echo  $transition;?>, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	<?php echo $data['wm_slider_transition_seconds'];?>,		// Speed of transition
															   
					// Components							
					slide_links				:	'false',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
					slides 					:  	[			// Slideshow Images
														<?php
														echo $slider_img;
														?>
				
												]
					
				});
		    });
		    
		</script>
<!-- End scripts for background slider end here -->