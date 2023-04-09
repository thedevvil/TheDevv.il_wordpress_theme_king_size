jQuery(document).ready(function() {
	
	jQuery('#upload_image_button_thumb').click(function() {
		
		window.send_to_editor = function(html) 
		
		{
			imgurl = jQuery('img',html).attr('src');
			jQuery('#upload_image_thumb').val(imgurl);
			tb_remove();
		}
	 
	 
		tb_show('', 'media-upload.php?&post_id=0&amp;option_image_upload=1&amp;type=image&amp;TB_iframe=1');
		return false;
		
	});
 
	jQuery('#upload_image_button').click(function() {
		
		window.send_to_editor = function(html) 
		
		{
			imgurl = jQuery('img',html).attr('src');
			jQuery('#upload_image').val(imgurl);
			tb_remove();
		}
	 
	 
		tb_show('', 'media-upload.php?&post_id=0&amp;option_image_upload=1&amp;type=image&amp;TB_iframe=1');
		return false;
		
	});
	 

	jQuery('#upload_image_button_background').click(function() {
		
		window.send_to_editor = function(html) 
		
		{
			imgurl = jQuery('img',html).attr('src');
			jQuery('#kingsize_portfolio_background').val(imgurl);
			tb_remove();
		}
	 
	 
		tb_show('', 'media-upload.php?&post_id=0&amp;option_image_upload=1&amp;type=image&amp;TB_iframe=1');
		return false;
		
	});
	

	
	


});
