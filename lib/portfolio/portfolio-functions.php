<?php
function kingsize_video($postid) {
	
	$video_url = get_post_meta($postid, 'kingsize_video_url', true);
	$height = get_post_meta($postid, 'kingsize_video_height', true);
	$embeded_code = get_post_meta($postid, 'kingsize_embed_code', true);
	
	if($height == '')
		$height = 300;

	if(trim($embeded_code) == '') 
	{
		
		if(preg_match('/youtube/', $video_url)) 
		{
			
			if(preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $video_url, $matches))
			{
				/*$output = '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="460" height="'.$height.'" src="http://www.youtube.com/embed/'.$matches[1].'" frameborder="0" allowFullScreen></iframe>';*/

				$output = '<object width="460" height="'.$height.'"><param name="movie" value="http://www.youtube.com/v/'.$matches[1].'"></param>
				<param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/'.$matches[1].'" type="application/x-shockwave-flash" wmode="transparent" width="460" height="'.$height.'"></embed></object>';

				
			}
			else 
			{
				$output = __('Sorry that seems to be an invalid <strong>YouTube</strong> URL. Please check it again.', 'framework');
			}
			
		}
		elseif(preg_match('/vimeo/', $video_url)) 
		{
			
			if(preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $matches))
			{
				$output = '<iframe src="http://player.vimeo.com/video/'.$matches[1].'" width="460" height="'.$height.'" frameborder="0"></iframe>';
			}
			else 
			{
				$output = __('Sorry that seems to be an invalid <strong>Vimeo</strong> URL. Please check it again. Make sure there is a string of numbers at the end.', 'framework');
			}
			
		}
		else 
		{
			$output = __('Sorry that is an invalid YouTube or Vimeo URL.', 'framework');
		}
		
		echo $output;
		
	}
	else
	{
		echo stripslashes(htmlspecialchars_decode($embeded_code));
	}
	
}

function kingsize_get_the_post_thumbnail_url($id = null, $size = 'full') {
    //if no post thumbnail is set, return empty string
    if(!has_post_thumbnail($id))
        return '';

    //get the post thumbnail
    $text = get_the_post_thumbnail($id, $size);

    //initialize the variables
    $src = '';
    $matches = array();

    //set the match string
    $src_pattern = '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i';

    //match it
    if(preg_match($src_pattern, $text, $matches)) {
        $src = $matches[1];
    }

    return trim($src);
}

function kingsize_thumb_box($postid) {
	global $no_of_page_columns;

	$lightbox = "true";
	
	$image_portfolio = get_post_meta($postid, 'upload_image', true);

	$video_thumb_image = get_post_meta($postid, 'upload_image_thumb', true);
	$video = get_post_meta($postid, 'kingsize_video_url', true);
	$height = get_post_meta($postid, 'kingsize_video_height', true);
	$embed = trim(get_post_meta($postid, 'kingsize_embed_code', true));
	
	if($height=='')
		$lightbox_height = 350;
	else
		$lightbox_height = $height + 20;

	if($image_portfolio != '')
		$overview_image = $image_portfolio;
	elseif($video_thumb_image!='')
		$overview_image = $video_thumb_image;
	else
		$overview_image = kingsize_get_the_post_thumbnail_url($postid);
	

	//// Getting the number of columns	
	if(empty($no_of_page_columns))
		$no_of_page_columns = "2columns";

	if($no_of_page_columns=="2columns")
		$url_post_img = wm_image_resize('330','220', $overview_image);
	elseif($no_of_page_columns=="3columns")
		$url_post_img = wm_image_resize('220','140', $overview_image);
	elseif($no_of_page_columns=="4columns")
		$url_post_img = wm_image_resize('160','110', $overview_image);
	elseif($no_of_page_columns=="grid")
		$url_post_img = wm_image_resize('112','112', $overview_image);
	////// End number of columns /////

	//getting the thumbnail
	if($overview_image == '')
	{
		$thumb = get_the_post_thumbnail($postid, 'thumbnail-post');
	}
	else
	{
		$thumb = '<img src="'.$url_post_img.'" alt="'.get_the_title().'" title="'.get_the_title().'"/>';
	}
	
	//SETTING of the portfolio thumbnail link 
	if(get_post_meta( $postid, 'portfolios_thumbnail_link', true ) != '') :
		$lightbox = 'false';
		$permalink = get_post_meta( $postid, 'portfolios_thumbnail_link', true );
	else :
		$lightbox = 'true';	
		$permalink = get_permalink( $postid );
	endif;

	//SETTING of Lightbox on Portfolio write up panel
	if(get_post_meta( $postid, 'portfolios_lightbox_disable', true ) == 'disable') :
		$lightbox = 'false';
	else :
		$lightbox = 'true';		
	endif;
	
	//CHECKING of lightbox effect is enabled or not
	if($lightbox == 'true') {			

		if($embed != '')
		{
			$output = '<a rel="prettyPhoto[gallery-'.$postid.']" title="'.get_the_title($postid).'" href="'.get_template_directory_uri().'/lib/portfolio/kingsize-portfolio-video.php?id='.$postid.'&iframe=true&width=auto&height=auto" class="video">'.$thumb.'</a>';
		}
		elseif($video != '' && $embed == '') 
		{
			$output = '<a rel="prettyPhoto[gallery-'.$postid.']" title="'.get_the_title($postid).'" href="'.$video.'" class="video">'.$thumb.'</a>';
		}
		else
		{
			//getting the file name
			if (!is_readable($overview_image)) {
				$overview_image_name = substr($overview_image, 0,-strlen(strrchr($overview_image, '-')) );
				$overview_image_extension = substr($overview_image, strrpos($overview_image, '.')+1);
				$image_path  = 	$overview_image_name.".".$overview_image_extension;
			}
			else{
				$image_path  = 	$overview_image;
			}
			
			$output = '<a rel="prettyPhoto[gallery-'.$postid.']" title="'.get_the_title($postid).'" href="'.$image_path.'" class="image">'.$thumb.'</a>';			
		}	
		#### Getting the attachments image items for portfoio V4 ####
			$args = array('post_type' => 'attachment', 'post_parent' => $postid,  'orderby' => menu_order, 'order' => ASC); 
			$attachments = get_children($args); 
			
			if ($attachments) { 
				foreach ($attachments as $attachment) { 
					
					$post_title = $attachment->post_title."<p>".strip_tags($attachment->post_content)."</p>";
					$url_post_img = wm_image_resize('330','220', wp_get_attachment_url($attachment->ID));

					$output .= '<ul style="display:none;"><li><a href="'.wp_get_attachment_url($attachment->ID).'" title="'.$post_title.'" rel="prettyPhoto[gallery-'.$postid.']"><img  src="'.$url_post_img.'" alt="'.$attachment->post_title.'" title="'.$attachment->post_title.'"/></a></li></ul>';
			   }
			}
		#### End attachments image items for portfoio V4 #######
	}
	else {			
		$output = '<a title="'.get_the_title($postid).'" href="'.$permalink.'" class="custom-port">'.$thumb.'</a>';
	}
	
	echo $output;
}

?>