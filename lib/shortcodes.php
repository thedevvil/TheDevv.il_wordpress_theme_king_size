<?php
/**
 * @KingSize 2012
 **/

//Enabling Shortcodes in Widgets
 add_filter('widget_text', 'do_shortcode');

// one third div
add_shortcode('one_third', 'one_third');
function one_third( $atts, $content = null ) { 
    return '<div class="one_third">'.do_shortcode($content).'</div>';  
}  


// one third div last
add_shortcode('one_third_last', 'one_third_last');
function one_third_last( $atts, $content = null ) {  
   return '<div class="one_third right">'.do_shortcode($content).'</div><div class="clearboth"></div>';  
}  


// one half div
add_shortcode('one_half', 'one_half');
function one_half( $atts, $content = null ) { 
    return '<div class="one_half">'.do_shortcode($content).'</div>';  
}  


// one half div
add_shortcode('one_half_last', 'one_half_last');
function one_half_last( $atts, $content = null ) { 
    return '<div class="one_half right">'.do_shortcode($content).'</div><div class="clearboth"></div>';  
}  


//two thirds div
add_shortcode('two_thirds', 'two_thirds');
function two_thirds( $atts, $content = null ) { 
    return '<div class="two_thirds">'.do_shortcode($content).'</div>';  
}  

//two thirds div last
add_shortcode('two_thirds_last', 'two_thirds_last');
function two_thirds_last( $atts, $content = null ) {  
    return '<div class="two_thirds right">'.do_shortcode($content).'</div>
     <div class="clearboth"></div><div class="clearboth"></div>';  
}  

//img_floated_left image
add_shortcode('img_floated_left', 'img_floated_left');
function img_floated_left( $atts, $content = null ) {
	extract(shortcode_atts(array(  
	 "src" => 'http://www.kingsizetheme.com/wp-content/themes/kingsize/images/gallery/thumbs/3column.jpg',
	 "alt" => ''	
	), $atts));  
    return '<img class="img_floated_left"  src="'.$src.'"  alt="'.$alt.'"/>';  
}  

//img_floated_right image
add_shortcode('img_floated_right', 'img_floated_right');
function img_floated_right( $atts, $content = null ) {
	extract(shortcode_atts(array(  
	 "src" => 'http://www.kingsizetheme.com/wp-content/themes/kingsize/images/gallery/thumbs/3column.jpg',
	 "alt" => ''	
	), $atts));  
    return '<img class="img_floated_right"  src="'.$src.'"  alt="'.$alt.'"/>';  
} 

//button
add_shortcode('button', 'button');
function button($atts, $content = null) {  
     extract(shortcode_atts(array(  
         "to" => '#',
         "color" => 'black'  
     ), $atts));  
     return '<a class="button '.$color.'" href="'.$to.'">'.$content.'</a>';  
 }  


// info box
add_shortcode('info_box', 'info_box');
function info_box($atts, $content = null) {  
     return '<div class="message_box info_box">
<p class="message_box_sign info_box_sign">Info</p>
'.do_shortcode($content).'
</div>';
}  


// warning box
add_shortcode('warning_box', 'warning_box');
function warning_box($atts, $content = null) {  
     return '<div class="message_box warning_box">
<p class="message_box_sign warning_box_sign">Warning</p>
'.do_shortcode($content).'
</div>';
}  

// error box
add_shortcode('error_box', 'error_box');
function error_box($atts, $content = null) {  
     return '<div class="message_box error_box">
<p class="message_box_sign error_box_sign">Error</p>
'.do_shortcode($content).'
</div>';
} 


// download box
add_shortcode('download_box', 'download_box');
function download_box($atts, $content = null) {  
     return '<div class="message_box download_box">
<p class="message_box_sign download_box_sign">Download</p>
'.do_shortcode($content).'
</div>';
} 


// blockquote
add_shortcode('blockquote', 'blockquote');
function blockquote( $atts, $content = null ) {  
    return '<blockquote>'.do_shortcode($content).'</blockquote>';  
} 

//tooltip_link
add_shortcode('tooltip_link', 'tooltip_link');
function tooltip_link($atts, $content = null) {  
     extract(shortcode_atts(array(  
         "title" => '',
         "to" => '#'  
     ), $atts));  
     return '<a class="tooltip_link" title="'.$title.'"  href="'.$to.'">'.$content.'</a>';  
	
 }  


/*
General shortcode functions of KingSize theme V4
*/

/* contact Form shortcode*/
// [contact email="email@address.com" message="Thank you for writing us! We'll be in touch real soon."]
function shortcode_contactFrm($atts, $content = null)
{
  
  extract(shortcode_atts(array(
		'email' => false,
		'message' => false
    ), $atts));

   $email = ($email) ? $email  : '';
   $message = ($message) ? $message  : '';
	
	$output = "";
	$output =
		 '<!-- Post -->
			<div class="post">
					
				<form method="post" action="php/contact-send.php" id="contact_form">

				<p><label class="form_label" for="form_name">'. __("Name", "kslang").'</label>
					<input id="form_name" type="text" name="name" class="textbox" value="" /></p>
					
				<p><label class="form_label" for="form_email">'. __("E-mail", "kslang").'</label>
					<input id="form_email" type="text" name="email" class="textbox" value="" /></p>
					
				<p><label class="form_label" for="form_message">'. __("Message", "kslang").'</label>
					<textarea id="form_message" rows="5" cols="25" name="message" class="textbox"></textarea></p>
		
				<input id="form_submit" type="submit" name="submit" value="'. __("Send message", "kslang").'" />

				<input  name="input_to_email" type="hidden" value="'.$email.'" />
				
				<!-- hidden input for basic spam protection -->
				<div class="hide">
					<label for="spamCheck">Do not fill out this field</label>
					<input id="spamCheck" name="spam_check" type="text" value="" />
				</div>	
						
				</form>	
				<!-- contact form ends here-->	
		
				<!-- This div will be shown if mail was sent successfully -->		
				<div class="hide success">
					<p>'. __($message, "kslang") .'</p>
				</div>
				<br /><br />
			</div>	
			<!-- Post ends here -->';

	return $output;
}

add_shortcode('contact', 'shortcode_contactFrm');


//toggle shortcode
add_shortcode('toggle', 'shortcode_toggle');
function shortcode_toggle($atts, $content = null) {
	extract(shortcode_atts(array(
        'title'      => '',
    ), $atts));

	$out .= '<div class="toggle_wrap toggle_alt"><div class="toggle_box"><a class="toggle" href="#">' .$title. '</a>';
	$out .= '<div class="hide"><p>';
	$out .= do_shortcode($content);
	$out .= '</p></div></div></div>';

   return $out;
}

//toggle basic shortcode
add_shortcode('toggle_basic', 'shortcode_toggle_basic');
function shortcode_toggle_basic($atts, $content = null) {
	extract(shortcode_atts(array(
        'title'      => '',
    ), $atts));

	$out .= '<div class="toggle_wrap"><div class="toggle_box"><a class="toggle" href="#">' .$title. '</a>';
	$out .= '<div class="hide"><p>';
	$out .= do_shortcode($content);
	$out .= '</p></div></div></div>';

   return $out;
}

//basic accordion
add_shortcode('accordion_basic', 'shortcode_accordion_basic');
function shortcode_accordion_basic($atts, $content = null) {
	extract(shortcode_atts(array(
        'title'      => '',
    ), $atts));

	$out .= '<div class="accordion"><div class="accordion_head"><a href="#">' .$title. '</a></div>';
	$out .= '<div class="accordion_content">';
	$out .= do_shortcode($content);
	$out .= '</div></div>';

   return $out;
}

//accordion
add_shortcode('accordion', 'shortcode_accordion');
function shortcode_accordion($atts, $content = null) {
	extract(shortcode_atts(array(
        'title'      => '',
    ), $atts));

	$out .= '<div class="accordion"><div class="accordion_head"><a href="#">' .$title. '</a></div>';
	$out .= '<div class="accordion_content">';
	$out .= do_shortcode($content);
	$out .= '</div></div>';

   return $out;
}

//accordion active
add_shortcode('accordion_active', 'shortcode_accordion_active');
function shortcode_accordion_active($atts, $content = null) {
	extract(shortcode_atts(array(
        'title'      => '',
    ), $atts));

	$out .= '<div class="accordion"><div class="accordion_head active_acc"><a href="#">' .$title. '</a></div>';
	$out .= '<div class="accordion_content">';
	$out .= do_shortcode($content);
	$out .= '</div></div>';

   return $out;
}


//// Tabs Shortcode
//Example [tabs] [tab title="Title 1"]Insert your text here[/tab] [tab title="Title 2"]Insert your text here[/tab] [tab title="Title 3"]Insert your text //here[/tab] [/tabs]

function shortcode_tabs($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'title' => '#',
		'type' => ''
	), $atts));

	if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
		
	} else {
	
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
		
		if($type == 'basic')
			$output = '<ul class="tabs tabs_alt">';
		else
			$output = '<ul class="tabs">';
		
		$rand_num  = rand(); //generating randum number

		for($i = 0; $i < count($matches[0]); $i++) {
			//$output .= '<li><a href="#tab'.preg_replace('/[^a-zA-Z0-9]/', '', $matches[3][$i]['title'] ).'">' . $matches[3][$i]['title'] . '</a></li>';
			$output .= '<li><a href="#tab'.$rand_num.'">' . $matches[3][$i]['title'] . '</a></li>';
		}
		
		$output .= '</ul>';

		if($type == 'basic')
			$output .= '<div class="tab_container tab_container_alt">';
		else
			$output .= '<div class="tab_container">';

		for($i = 0; $i < count($matches[0]); $i++) {
			//$output .= '<div id="tab'.preg_replace('/[^a-zA-Z0-9]/', '', $matches[3][$i]['title']).'" class="tab_content">'.do_shortcode(trim($matches[5][$i])).'</div>';
			$output .= '<div id="tab'.$rand_num.'" class="tab_content">'.do_shortcode(trim($matches[5][$i])).'</div>';
		}

		$output .= '</div>';
		
		return '<div class="tabs_wrap">'.$output.'</div>';
	}
	
}
add_shortcode("tabs", "shortcode_tabs");

//tables
//define the type="" is required -- example: [table type=""] HTML table coding inserted inside here [/table]
add_shortcode('table', 'shortcode_table');
function shortcode_table($atts, $content = null) {
	extract(shortcode_atts(array(
		'title'     =>  '',
        'type'      => ''
    ), $atts));

	$out .= '<table class="' .$type. '">';
	$out .= do_shortcode($content);
	$out .= '</table>';

   return $out;
}


//Google Map ShortCodes
//[googlemap width="600" height="300" src="http://maps.google.com/maps?q=Heraklion,+Greece&hl=en&ll=35.327451,25.140495&spn=0.233326,0.445976& sll=37.0625,-95.677068&sspn=57.161276,114.169922& oq=Heraklion&hnear=Heraklion,+Greece&t=h&z=12"]
function shortcode_googlemap($atts, $content = null) {
   extract(shortcode_atts(array(
      "width" => '640',
      "height" => '480',
      "src" => ''
   ), $atts));
   return '<iframe width="'.$width.'" height="'.$height.'" src="'.$src.'&output=embed" ></iframe>';
}
add_shortcode("googlemap", "shortcode_googlemap");



//Videos 
//[video url="http://youtu.be/wOUgRif7JRc" name="youtube-video" width="420" height="243"]
function shortcode_video($atts, $content = null) {

    extract(shortcode_atts(array(
		'name' => '',
        'url' => '',
		'html5_1' => '',
        'html5_2' => '',
        'priority' => 'flash',
        'image' => '',
        'width' => '560',
        'height' => '315',
        'controlbar' => 'bottom',
        'autostart' => 'false',
        'icons' => 'true',
        'stretching' => 'fill',
        'align' => 'alignnone',
        'plugins' => '',
        'skin' => get_template_directory_uri().'/js/mediaplayer/fs39/fs39.xml',
        'player' => get_template_directory_uri().'/js/mediaplayer/player.swf'        
    ), $atts));
	
	
	// Remove spaces from video name
	$name = preg_replace('/[^a-zA-Z0-9]/', '', $name);

	// Video Type	
	$vimeo = strpos($url,"vimeo.com");
	$yt1 = strpos($url,"youtube.com");
	$yt2 = strpos($url,"youtu.be");
	
	ob_start(); ?>

	<div class="shortcode-video <?php echo $align; ?>">
	
		<div class="shortcode-video-inner">
						
			<?php if($vimeo) { ?>
										
				<?php if($autostart == "false") {
					$autostart = "0";
				} elseif($autostart == "true") {
					$autostart = "1";
				}
		
				// Vimeo Clip ID
				if(preg_match('/www.vimeo/',$url)) {							
					$vimeoid = trim($url,'http://www.vimeo.com/');
				} else {							
					$vimeoid = trim($url,'http://vimeo.com/');
				}				
		
				?>
				
				<iframe src="http://player.vimeo.com/video/<?php echo $vimeoid; ?>?byline=0&amp;portrait=0&amp;autoplay=<?php echo $autostart; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				
			<?php } else { ?>
				
			 <div id="video-<?php echo $name; ?>"></div>
				<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/jwplayer.js'></script>
				<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/swfobject.js'></script>
				<script>
					jwplayer("video-<?php echo $name; ?>").setup({
						<?php if($image) { $image = wm_image_resize('', $image, $width, $height, true); ?>image: "<?php echo $image[url]; ?>",<?php } ?>
						icons: "<?php echo $icons; ?>",
						autostart: "<?php echo $autostart; ?>",
						stretching: "<?php echo $stretching; ?>",
						controlbar: "<?php echo $controlbar; ?>",
						skin: "<?php echo $skin; ?>",
						height: <?php echo $height; ?>,
						width: <?php echo $width; ?>,
						screencolor: "000000",
						modes:
							[
							<?php if($priority == "flash") { ?>
								{type: "flash", src: "<?php echo $player; ?>", config: {file: "<?php echo $url; ?>"}},					
								{type: "html5", config: {file: "<?php echo $url; ?>", file: "<?php echo $html5_1; ?>", file: "<?php echo $html5_2; ?>"}}
							<?php } else { ?>
								{type: "html5", config: {file: "<?php echo $url; ?>", file: "<?php echo $html5_1; ?>", file: "<?php echo $html5_2; ?>"}},	
								{type: "flash", src: "<?php echo $player; ?>", config: {file: "<?php echo $url; ?>"}}
							<?php } ?>
							],
						plugins: {<?php echo $plugins; ?>}
					});
				</script>
			
			<?php } ?>
		
		</div>

	</div>

<?php 

	$output = ob_get_contents();
	ob_end_clean(); 
	
	return $output;
}
add_shortcode('video', 'shortcode_video');

//related post
//[related_posts limit="5"]
function shortcode_related_posts( $atts ) {
	extract(shortcode_atts(array(
	    'limit' => '5',
	), $atts));
 
	global $wpdb, $post, $table_prefix;
 
	if ($post->ID) {
		$retval = '<ul class="related_posts">';
 		// Get tags
		$tags = wp_get_post_tags($post->ID);
		$tagsarray = array();
		foreach ($tags as $tag) {
			$tagsarray[] = $tag->term_id;
		}
		$tagslist = implode(',', $tagsarray);
 
		// Do the query
		$q = "SELECT p.*, count(tr.object_id) as count
			FROM $wpdb->term_taxonomy AS tt, $wpdb->term_relationships AS tr, $wpdb->posts AS p WHERE tt.taxonomy ='post_tag' AND tt.term_taxonomy_id = tr.term_taxonomy_id AND tr.object_id  = p.ID AND tt.term_id IN ($tagslist) AND p.ID != $post->ID
				AND p.post_status = 'publish'
				AND p.post_date_gmt < NOW()
 			GROUP BY tr.object_id
			ORDER BY count DESC, p.post_date_gmt DESC
			LIMIT $limit;";
 
		$related = $wpdb->get_results($q);
 		if ( $related ) {
			foreach($related as $r) {
				$retval .= '<li><a title="'.wptexturize($r->post_title).'" href="'.get_permalink($r->ID).'">'.wptexturize($r->post_title).'</a></li>';
			}
		} else {
			$retval .= '
	<li>No related posts found</li>';
		}
		$retval .= '</ul>';
		return $retval;
	}
	return;
}
add_shortcode('related_posts', 'shortcode_related_posts');

//one_half dropcaps
//[one_half_dropcaps]Content go here [/one_half_dropcaps]
function shortcode_one_half_dropcaps( $atts, $content = null ) {  
    return '<div class="one_half dropcaps"> <p>'.do_shortcode($content).'</p></div>';  
}  
add_shortcode('one_half_dropcaps', 'shortcode_one_half_dropcaps');


//<!-- 1/2 width div (add class="one_half") -->
//[one_half_alt_last_dropcaps]Content go here [/one_half_alt_last_dropcaps]
function shortcode_one_half_alt_last_dropcaps( $atts, $content = null ) {  
    return '<div class="one_half last dropcaps_alt"><p>'.do_shortcode($content).'</p></div><div class="clearboth"></div>';  
}  
add_shortcode('one_half_alt_last_dropcaps', 'shortcode_one_half_alt_last_dropcaps');

//highlights
//[my_highlight color="yellow" font="#000000"]Content go here [/my_highlight]
function shortcode_highlight($atts, $content = null) {
extract(shortcode_atts(array(
    'color' => 'yellow',
    'font' => '#000000'
  ), $atts));
  return "<FONT style=\"BACKGROUND-COLOR: $color; color: $font\">$content</font>";
}
add_shortcode('my_highlight','shortcode_highlight');
