<?php
/**
 * @KingSize 2012
 * Fullscreen video background
 **/
?>
<?php
if((is_single() || is_page()) && get_post_meta( $wp_query->post->ID, 'kingsize_page_video_background', true )!=''){	//page background

$video_url = get_post_meta( $wp_query->post->ID, 'kingsize_page_video_background', true );

	    if(preg_match('/vimeo/', $video_url)) /// VIMEO VIDEO
		{
			if(preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $matches))
			{
				if(get_post_meta( $wp_query->post->ID, 'kingsize_page_autoplay_video', true ))
					$autoplay = 1;
				else
					$autoplay = 0;

				if(get_post_meta( $wp_query->post->ID, 'kingsize_page_repeat_video', true )) 
					$loop_vimeo = 1;
				else
					$loop_vimeo = 0;

				$output = '<!-- Fullscreen vimeo video background -->';
				$output .= '<div id="backgroundvimeo">
								<iframe frameborder="0" src="http://player.vimeo.com/video/'.$matches[1].'?title=0&amp;byline=0&amp;portrait=0&amp;autoplay='.$autoplay.'&amp;loop='.$loop_vimeo.'" webkitallowfullscreen="" allowfullscreen=""></iframe>
						  </div>';
				$output .= '<!--vimeo video Background ends here-->';

			}
			else 
			{
				$output = __('Sorry that seems to be an invalid <strong>Vimeo</strong> URL. Please check it again. Make sure there is a string of numbers at the end.', 'framework');
			}

			echo $output;

		}
		else //YOUTUBE OR MP4 CUSTOM URL VIDEO
		{
		?>
		<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/jwplayer.js'></script>
		<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/swfobject.js'></script>
		<style type="text/css" media="all" scoped="scoped">
			.grid{display:none;}
		</style>

		<!-- Fullscreen video background -->
		<div id='mediaspace'></div>
		<script type='text/javascript'>
		  jwplayer('mediaspace').setup({
			'flashplayer': "<?php echo get_template_directory_uri();?>/js/player.swf",
			'file': "<?php echo $video_url;?>",			
			'stretching': 'fill',
			<?php
			if(get_post_meta( $wp_query->post->ID, 'kingsize_page_autoplay_video', true )) {
			?>
			'autostart': 'true',
			<?php
			}
			else {
			?>
			'autostart': 'false',
			<?php
			}
			?>
			<?php
			if(get_post_meta( $wp_query->post->ID, 'kingsize_page_controlbar_video', true )) {
			?>
			'controlbar': 'none',
			<?php
			}
			else {
			?>
			'controls': { 'visible': true },
			<?php
			}
			if(get_post_meta( $wp_query->post->ID, 'kingsize_page_repeat_video', true )) {
			?>
			'repeat': 'always',
			<?php
			}
			?>
			'icons': 'false',
			'width': '100%',
			'height': '100%'
		  });
		</script>
		<!--Fullscreen Background ends here-->
		<?php
		}
		?>
<?php
}
elseif((is_single() || is_page()) && get_post_meta( $wp_query->post->ID, 'kingsize_post_video_background', true )!=''){	//post background

	$video_url = get_post_meta( $wp_query->post->ID, 'kingsize_post_video_background', true );

		if(preg_match('/vimeo/', $video_url)) /// VIMEO VIDEO
		{
			if(preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $matches))
			{
				if(get_post_meta( $wp_query->post->ID, 'kingsize_post_autoplay_video', true ))
					$autoplay = 1;
				else
					$autoplay = 0;

				if(get_post_meta( $wp_query->post->ID, 'kingsize_post_repeat_video', true )) 
					$loop_vimeo = 1;
				else
					$loop_vimeo = 0;

				$output = '<!-- Fullscreen vimeo video background -->';
				$output .= '<div id="backgroundvimeo">
								<iframe frameborder="0" src="http://player.vimeo.com/video/'.$matches[1].'?title=0&amp;byline=0&amp;portrait=0&amp;autoplay='.$autoplay.'&amp;loop='.$loop_vimeo.'" webkitallowfullscreen="" allowfullscreen=""></iframe>
						  </div>';
				$output .= '<!--vimeo video Background ends here-->';

			}
			else 
			{
				$output = __('Sorry that seems to be an invalid <strong>Vimeo</strong> URL. Please check it again. Make sure there is a string of numbers at the end.', 'framework');
			}

			echo $output;

		}
		else //YOUTUBE OR MP4 CUSTOM URL VIDEO
		{
		?>
		<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/jwplayer.js'></script>
		<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/swfobject.js'></script>
		<style type="text/css" media="all" scoped="scoped">
			.grid{display:none;}
		</style>

		<!-- Fullscreen video background -->
		<div id='mediaspace'></div>
		<script type='text/javascript'>
		  jwplayer('mediaspace').setup({
			'flashplayer': "<?php echo get_template_directory_uri();?>/js/player.swf",
			'file': "<?php echo $video_url;?>",			
			'stretching': 'fill',
			<?php
			if(get_post_meta( $wp_query->post->ID, 'kingsize_post_autoplay_video', true )) {
			?>
			'autostart': 'true',
			<?php
			}
			else {
			?>
			'autostart': 'false',
			<?php
			}
			?>
			<?php
			if(get_post_meta( $wp_query->post->ID, 'kingsize_post_controlbar_video', true )) {
			?>
			'controlbar': 'none',
			<?php
			}
			else {
			?>
			'controls': { 'visible': true },
			<?php
			}
			if(get_post_meta( $wp_query->post->ID, 'kingsize_post_repeat_video', true )) {
			?>
			'repeat': 'always',
			<?php
			}
			?>
			'icons': 'false',
			'width': '100%',
			'height': '100%'
		  });
		</script>
		<!--Fullscreen Background ends here-->
		<?php
		}
		?>
<?php
}
elseif((is_single() || is_page()) && get_post_meta( $wp_query->post->ID, 'kingsize_portfolio_video_background', true )!=''){	//portfolio background

		$video_url = get_post_meta( $wp_query->post->ID, 'kingsize_portfolio_video_background', true );

		if(preg_match('/vimeo/', $video_url)) /// VIMEO VIDEO
		{
			if(preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $matches))
			{
				if(get_post_meta( $wp_query->post->ID, 'kingsize_portfolio_autoplay_video', true ))
					$autoplay = 1;
				else
					$autoplay = 0;

				if(get_post_meta( $wp_query->post->ID, 'kingsize_portfolio_repeat_video', true )) 
					$loop_vimeo = 1;
				else
					$loop_vimeo = 0;

				$output = '<!-- Fullscreen vimeo video background -->';
				$output .= '<div id="backgroundvimeo">
								<iframe frameborder="0" src="http://player.vimeo.com/video/'.$matches[1].'?title=0&amp;byline=0&amp;portrait=0&amp;autoplay='.$autoplay.'&amp;loop='.$loop_vimeo.'" webkitallowfullscreen="" allowfullscreen=""></iframe>
						  </div>';
				$output .= '<!--vimeo video Background ends here-->';

			}
			else 
			{
				$output = __('Sorry that seems to be an invalid <strong>Vimeo</strong> URL. Please check it again. Make sure there is a string of numbers at the end.', 'framework');
			}

			echo $output;

		}
		else //YOUTUBE OR MP4 CUSTOM URL VIDEO
		{
		?>

		<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/jwplayer.js'></script>
		<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/swfobject.js'></script>
		<style type="text/css" media="all" scoped="scoped">
			.grid{display:none;}
		</style>		

	<!-- Fullscreen video background -->
		<div id='mediaspace'></div>
		<script type='text/javascript'>
		  jwplayer('mediaspace').setup({
			'flashplayer': "<?php echo get_template_directory_uri();?>/js/player.swf",
			'file': "<?php echo $video_url;?>",
			'stretching': 'fill',
			<?php
			if(get_post_meta( $wp_query->post->ID, 'kingsize_portfolio_autoplay_video', true )) {
			?>
			'autostart': 'true',
			<?php
			}
			else {
			?>
			'autostart': 'false',
			<?php
			}
			?>
			<?php
			if(get_post_meta( $wp_query->post->ID, 'kingsize_portfolio_controlbar_video', true )) {
			?>
			'controlbar': 'none',
			<?php
			}
			else {
			?>
			'controls': { 'visible': true },
			<?php
			}
			if(get_post_meta( $wp_query->post->ID, 'kingsize_portfolio_repeat_video', true )) {
			?>
			'repeat': 'always',
			<?php
			}
			?>
			'icons': 'false',
			'width': '100%',
			'height': '100%'
		  });
		</script>
		<!--Fullscreen Background ends here-->
		<?php
		}
		?>
<?php
}
elseif(is_home()) { //If Home page then show the video background

	if( $data['wm_background_type'] == 'Video Background' ) {	
		
		#### Home Page Video background ######
		global $data;
		$video_autoplay = $data['wm_autoplay_video'];

		$video_url = $data['wm_video_url']; //VIDEO URL
		
		
		if(preg_match('/vimeo/', $video_url)) /// VIMEO VIDEO
		{
			if(preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $matches))
			{
				if($video_url)
					$autoplay = 1;
				else
					$autoplay = 0;

				$output = '<!-- Fullscreen vimeo video background -->';
				$output .= '<div id="backgroundvimeo">
								<iframe frameborder="0" src="http://player.vimeo.com/video/'.$matches[1].'?title=0&amp;byline=0&amp;portrait=0&amp;autoplay='.$autoplay.'&amp;loop=0" webkitallowfullscreen="" allowfullscreen=""></iframe>
						  </div>';
				$output .= '<!--vimeo video Background ends here-->';

			}
			else 
			{
				$output = __('Sorry that seems to be an invalid <strong>Vimeo</strong> URL. Please check it again. Make sure there is a string of numbers at the end.', 'framework');
			}

			echo $output;

		}
		else //YOUTUBE OR MP4 CUSTOM URL VIDEO
		{
		?>
		<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/jwplayer.js'></script>
		<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/swfobject.js'></script>

		<!-- Fullscreen video background -->
		<div id='mediaspace'></div>
		<script type='text/javascript'>
		  jwplayer('mediaspace').setup({
			'flashplayer': "<?php echo get_template_directory_uri();?>/js/player.swf",
			'file': "<?php echo $video_url;?>",
			'stretching': 'fill',
			<?php
			if($video_autoplay) {
			?>
			'autostart': 'true',
			<?php
			}
			else {
			?>
			'autostart': 'false',
			<?php
			}
			?>
			<?php
			if($data['wm_controlbar_video']) {
			?>
			'controlbar': 'none',
			<?php
			}
			else {
			?>
			'controls': { 'visible': true },
			<?php
			}
			if($data['wm_repeat_video']) {
			?>
			'repeat': 'always',
			<?php
			}
			?>
			'icons': 'false',
			'width': '100%',
			'height': '100%'
		  });
		</script>
		<!--Fullscreen Background ends here-->
		<?php
		}
		?>
<?php
	}
}
else { //default
	
	include (TEMPLATEPATH . '/lib/background_slider.php'); 

}
?>